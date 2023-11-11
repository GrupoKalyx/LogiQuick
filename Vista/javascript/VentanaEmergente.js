// document.getElementById('tracking__form').addEventListener('submit', async function (event) {
//     event.preventDefault();

//     var mapDiv = document.createElement('div');
//     mapDiv.id = 'map';
//     var generadorDiv = document.querySelector('#map__generador');
//     generadorDiv.appendChild(mapDiv);

//     document.getElementById('ventanaEmergente').style.display = 'block';

//     document.querySelector('.ventana__cerrar').addEventListener('click', function () {
//         document.getElementById('ventanaEmergente').style.display = 'none';
//         document.getElementById('map').style.display = 'none';
//     });


//     var idRastreo = document.getElementById('idRastreo').value;

//     try {
      

//         const resultado = await obtenerDatosPaquete(idRastreo);
//         const resultado2 = await obtenerEstadoPaquete(idRastreo);
//         const resultado3 = await obtenerDatosAlmacen(idRastreo);

//         function obtenerDatosPaquete(idRastreo) {
//             const response = fetch(`http://localhost/LogiQuick/Control/controladorPaquetes.php?function=rastrear&idRastreo=${idRastreo}`);
//             return response.json();
//         }
        
//         function obtenerEstadoPaquete(idRastreo) {
//             const response =  fetch(`http://localhost/LogiQuick/Control/controladorPaquetes.php?function=mostrarEstado&tipoId=idRastreo&idRastreo=${idRastreo}`);
//             return response.json();
//         }
//         function obtenerDatosAlmacen(idRastreo) {
//             const response = fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`);
//             return response.json();
//         }

//         var resultadoDiv = document.getElementById('resultado');
//         var resultado2Div = document.getElementById('resultado2');

//         if (!resultado) {
//             resultadoDiv.textContent = "El paquete no existe o no está registrado aún.";
//         } else {
//             var direccion = resultado.num + ' ' + resultado.calle + ', ' + resultado.departamento + ', Uruguay';
//             var direccionAlmacen = resultado3.num + ' ' + resultado3.calle + ', ' + resultado3.departamento + ', Uruguay';

//             resultadoDiv.textContent = "Dirección de entrega: " + direccion;
//             resultado2Div.textContent = "Estado del Paquete: " + resultado2;

//             var latitudDestino = resultado.lat; // Usar el valor de latitud desde la tabla de paquetes
//             var longitudDestino = resultado.lng; // Usar el valor de longitud desde la tabla de paquetes

//             var latitudOrigen = resultado3.lat; // Usar el valor de latitud desde la tabla de almacenes
//             var longitudOrigen = resultado3.lng; // Usar el valor de longitud desde la tabla de almacenes

//             var map = L.map('map').setView([latitudDestino, longitudDestino], 13);

//             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                 attribution: '© OpenStreetMap contributors'
//             }).addTo(map);

//             L.marker([latitudDestino, longitudDestino]).addTo(map);

//             L.Routing.control({
//                 waypoints: [
//                     L.latLng(latitudOrigen, longitudOrigen), // Coordenadas del almacén como punto de origen
//                     L.latLng(latitudDestino, longitudDestino)
//                 ],
//                 routeWhileDragging: true,
//                 show: false,
//                 language: "es"
//             }).addTo(map);
//         }
//     } catch (error) {
//         console.error('Error en la solicitud:', error);
//     }
// });



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

        function obtenerDatosPaquete(idRastreo) {
            return fetch(`http://localhost/LogiQuick/Control/controladorPaquetes.php?function=rastrear&idRastreo=${idRastreo}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud: ' + response.statusText);
                    }
                    return response.json();
                });
        }

        function obtenerEstadoPaquete(idRastreo) {
            return fetch(`http://localhost/LogiQuick/Control/controladorPaquetes.php?function=mostrarEstado&tipoId=idRastreo&idRastreo=${idRastreo}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud: ' + response.statusText);
                    }
                    return response.json();
                });
        }

        function obtenerDatosAlmacen(idRastreo) {
            return fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud: ' + response.statusText);
                    }
                    return response.json();
                });
        }

        var resultadoDiv = document.getElementById('resultado');
        var resultado2Div = document.getElementById('resultado2');

        if (!resultado) {
            resultadoDiv.textContent = "El paquete no existe o no está registrado aún.";
        } else {
            var direccion = resultado.num + ' ' + resultado.calle + ', ' + resultado.departamento + ', Uruguay';
            var direccionAlmacen = resultado3.num + ' ' + resultado3.calle + ', ' + resultado3.departamento + ', Uruguay';

            resultadoDiv.textContent = "Dirección de entrega: " + direccion;
            resultado2Div.textContent = "Estado del Paquete: " + resultado2;

            var latitudDestino = parseFloat(resultado.lat); // Usar el valor de latitud desde la tabla de paquetes
            var longitudDestino = parseFloat(resultado.lng); // Usar el valor de longitud desde la tabla de paquetes

            var latitudOrigen = parseFloat(resultado3.lat); // Usar el valor de latitud desde la tabla de almacenes
            var longitudOrigen = parseFloat(resultado3.lng); // Usar el valor de longitud desde la tabla de almacenes

            var map = L.map('map').setView([latitudDestino, longitudDestino], 13);

            const iconoPersonalizadoAlmacen = L.icon({
                iconUrl: '../assets/AlmacenIcon.png',
                iconSize: [40, 40],
                iconAnchor: [20, 40], // Punto donde el icono se conecta con el mapa
                popupAnchor: [0, -40] // Punto donde aparece el pop-up en relación con el icono
            });

            const iconoPersonalizadoPaquete = L.icon({
                iconUrl: '../assets/PaqueteIcon.png',
                iconSize: [40, 40],
                iconAnchor: [20, 40], // Punto donde el icono se conecta con el mapa
                popupAnchor: [0, -40] // Punto donde aparece el pop-up en relación con el icono
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([latitudDestino, longitudDestino], { icon: iconoPersonalizadoPaquete }).addTo(map);
            L.marker([latitudOrigen, longitudOrigen], { icon: iconoPersonalizadoAlmacen }).addTo(map);

            // L.Routing.control({
            //     waypoints: [
            //         L.latLng(latitudOrigen, longitudOrigen), // Coordenadas del almacén como punto de origen
            //         L.latLng(latitudDestino, longitudDestino)
            //     ],
            //     routeWhileDragging: true,
            //     show: false,
            
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
});
