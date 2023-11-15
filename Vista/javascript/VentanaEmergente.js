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
        const resultado = await obtenerDatosPaquete(idRastreo);
        const resultado2 = await obtenerEstadoPaquete(idRastreo);
        const resultado3 = await obtenerDatosAlmacen(idRastreo);

        var resultadoDiv = document.getElementById('resultado');
        var resultado2Div = document.getElementById('resultado2');

        if (resultado && resultado !== 0) {
            var direccion = resultado.num + ' ' + resultado.calle + ', ' + resultado.departamento + ', Uruguay';
            var direccionAlmacen = resultado3.num + ' ' + resultado3.calle + ', ' + resultado3.departamento + ', Uruguay';

            resultadoDiv.textContent = "Dirección de entrega: " + direccion;
            resultado2Div.textContent = "Estado del Paquete: " + resultado2;

            var latitudDestino = parseFloat(resultado.lat);
            var longitudDestino = parseFloat(resultado.lng);

            var latitudOrigen = parseFloat(resultado3.lat);
            var longitudOrigen = parseFloat(resultado3.lng);

            var map = L.map('map').setView([latitudDestino, longitudDestino], 13);

            const iconoPersonalizadoAlmacen = L.icon({
                iconUrl: '../assets/AlmacenIcon.png',
                iconSize: [40, 40],
                iconAnchor: [20, 40], 
                popupAnchor: [0, -40] 
            });

            const iconoPersonalizadoPaquete = L.icon({
                iconUrl: '../assets/PaqueteIcon.png',
                iconSize: [40, 40],
                iconAnchor: [20, 40], 
                popupAnchor: [0, -40] 
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([latitudDestino, longitudDestino], { icon: iconoPersonalizadoPaquete }).addTo(map);
            L.marker([latitudOrigen, longitudOrigen], { icon: iconoPersonalizadoAlmacen }).addTo(map);

           
        } else {
            document.getElementById('ventanaEmergente').style.display = 'block';
            document.getElementById('map').style.display = 'none';
            document.querySelector('.ventana__cerrar').addEventListener('click', function () {
                document.getElementById('ventanaEmergente').style.display = 'none';
                document.getElementById('map').style.display = 'none';
            });
            resultadoDiv.textContent = "El paquete no existe o no está registrado aún.";
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
});

function obtenerDatosPaquete(idRastreo) {
    return fetch(`http://localhost/kalyx/Control/controladorPaquetes.php?function=rastrear&idRastreo=${idRastreo}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
        });
}

function obtenerEstadoPaquete(idRastreo) {
    return fetch(`http://localhost/kalyx/Control/controladorPaquetes.php?function=mostrarEstado&tipoId=idRastreo&idRastreo=${idRastreo}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
        });
}

function obtenerDatosAlmacen(idRastreo) {
    return fetch(`http://localhost/kalyx/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
        });
}
