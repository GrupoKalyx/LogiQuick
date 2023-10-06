

async function obtenerDatosDelPaquete(idRastreo) {
        try {
            const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=rastrear&idRastreo=' + idRastreo);
            const resultado = await response.json();
            return resultado;
        } catch (error) {
            console.error('Error en la solicitud:', error);
            throw error; // Lanza el error para que pueda ser manejado por el código que llama a esta función
        }
    }

    

    document.getElementById('tracking__form').addEventListener('submit', async function (event) {
        event.preventDefault();
    
        document.getElementById('ventanaEmergente').style.display = 'block';
    
        document.querySelector('.ventana__cerrar').addEventListener('click', function () {
            document.getElementById('ventanaEmergente').style.display = 'none';
        });
    
        var idRastreo = document.getElementById('idRastreo').value;

    try {
        
        // Hacer la solicitud para obtener los datos del paquete
        const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=rastrear&idRastreo=' + idRastreo);
        const resultado = await response.json();

        var resultadoDiv = document.getElementById('resultado');
        if (!resultado) {
            resultadoDiv.textContent = "El paquete no existe o no está registrado aún.";
        } else {
            // Asignar los valores a la variable direccion
            var direccion = resultado.num + ' ' + resultado.calle + ', ' + resultado.departamento + ', Uruguay';
            resultadoDiv.textContent = "Dirección de entrega: " + direccion;

            // Hacer la solicitud para geocodificar la dirección
            const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24'; // Reemplaza con tu clave de API de OpenCage Data
            const apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(direccion)}&key=${apiKey}`;
            const geocodingResponse = await fetch(apiUrl);
            const geocodingData = await geocodingResponse.json();

            if (geocodingData.results && geocodingData.results.length > 0) {
                const location = geocodingData.results[0].geometry;
                var latitudDestino = location.lat;
                var longitudDestino = location.lng;
               
                // Coordenadas de la Plaza Independencia en Montevideo, Uruguay
                var latitudPlazaIndependencia = -34.903555;
                var longitudPlazaIndependencia = -56.188554;

                // Crea el mapa y muestra la ruta desde la Plaza Independencia hasta la dirección del paquete
                var map = L.map('map').setView([latitudDestino, longitudDestino], 13); // Coordenadas de la dirección del paquete y nivel de zoom iniciales

                // Crea el marcador para la dirección del paquete
                var destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);

                // Crea el control de enrutamiento con la Plaza Independencia como origen
                L.Routing.control({
                    waypoints: [
                        L.latLng(latitudPlazaIndependencia, longitudPlazaIndependencia),
                        L.latLng(latitudDestino, longitudDestino)
                    ],
                    routeWhileDragging: true,
                   
                }).addTo(map);
                
            } else {
                console.error('No se encontraron coordenadas para la dirección proporcionada.');
            }
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
});
    