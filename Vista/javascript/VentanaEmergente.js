document.addEventListener('DOMContentLoaded', function () {



    document.getElementById('tracking__form').addEventListener('submit', async function (event) {
        event.preventDefault();

        var mapDiv = document.createElement('div');
        mapDiv.id = 'map';
        var generadorDiv = document.querySelector('#map__generador');
        generadorDiv.appendChild(mapDiv);

        document.getElementById('ventanaEmergente').style.display = 'block';

        document.querySelector('.ventana__cerrar').addEventListener('click', function () {

            document.getElementById('ventanaEmergente').style.display = 'none';
            document.getElementById('map').style.display = 'none';

        });




        ocument.addEventListener('DOMContentLoaded', function () {



            document.getElementById('tracking__form').addEventListener('submit', async function (event) {
                event.preventDefault();
        
                var mapDiv = document.createElement('div');
                mapDiv.id = 'map';
                var generadorDiv = document.querySelector('#map__generador');
                generadorDiv.appendChild(mapDiv);
        
                document.getElementById('ventanaEmergente').style.display = 'block';
        
                document.querySelector('.ventana__cerrar').addEventListener('click', function () {
        
                    document.getElementById('ventanaEmergente').style.display = 'none';
                    document.getElementById('map').style.display = 'none';
        
                });
        
        
        
        
                var idRastreo = document.getElementById('idRastreo').value;
        
                try {
                    const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=rastrear&idRastreo=' + idRastreo);
                    const resultado = await response.json();
        
                    const response2 = await fetch(`http://localhost/logiquick/Control/controladorPaquetes.php?function=mostrarEstado&tipoId=idRastreo&idRastreo=${idRastreo}`);
                    const resultado2 = await response2.json();
        
                    const response3 = await fetch(`http://localhost/logiquick/Control/controladorAlmacenes.php?function=mostrarActual&idRastreo=${idRastreo}`)
                    const resultado3 = await response3.json();
        
                    var resultadoDiv = document.getElementById('resultado');
                    var resultado2Div = document.getElementById('resultado2');
        
                    if (!resultado) {
                        resultadoDiv.textContent = "El paquete no existe o no está registrado aún.";
                    } else {
                        var direccion = resultado.num + ' ' + resultado.calle + ', ' + resultado.departamento + ', Uruguay';
                        var direccionAlmacen = resultado3.N_puerta + ' ' + resultado.calle + ', ' + resultado.departamento + ', Uruguay';
        
                        resultadoDiv.textContent = "Dirección de entrega: " + direccion;
                        resultado2Div.textContent = "Estado del Paquete: " + resultado2;
        
        
                        // Geocodificar la dirección del paquete
                        const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24';
                        const apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(direccion)}&key=${apiKey}`;
                        const geocodingResponse = await fetch(apiUrl);
                        const geocodingData = await geocodingResponse.json();
        
                        // Geocodificar la dirección del almacén
                        const apiUrl2 = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(direccionAlmacen)}&key=${apiKey}`;
                        const geocodingResponse2 = await fetch(apiUrl2);
                        const geocodingData2 = await geocodingResponse2.json();
        
                        // Verificar si se encontraron coordenadas para ambas direcciones
                        if (geocodingData.results && geocodingData.results.length > 0 && geocodingData2.results && geocodingData2.results.length > 0) {
                            const location = geocodingData.results[0].geometry;
                            var latitudDestino = location.lat;
                            var longitudDestino = location.lng;
        
                            const location2 = geocodingData2.results[0].geometry;
                            var latitudOrigen = location2.lat;
                            var longitudOrigen = location2.lng;
        
                      
        
                            var map = L.map('map').setView([latitudDestino, longitudDestino], 13);
        
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '© OpenStreetMap contributors'
                            }).addTo(map);
        
                            var destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);
        
                            L.Routing.control({
                                waypoints: [
                                    L.latLng(latitudOrigen, longitudOrigen), // Coordenadas del almacén como punto de origen
                                    L.latLng(latitudDestino, longitudDestino)
                                ],
                                routeWhileDragging: true,
                                show: false,
                                language: "es"
                            }).addTo(map);
                        } else {
                            console.error('No se encontraron coordenadas para la dirección proporcionada.');
                        }
                    }
                } catch (error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        });
        
    });
});