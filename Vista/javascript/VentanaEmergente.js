document.getElementById('tracking__form').addEventListener('submit', function (event) {
    event.preventDefault();

    document.getElementById('ventanaEmergente').style.display = 'block';

    document.querySelector('.ventana__cerrar').addEventListener('click', function () {
        document.getElementById('ventanaEmergente').style.display = 'none';
    });



    var idRastreo = document.getElementById('idRastreo').value;

    
    fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=rastrear&idRastreo=' + idRastreo)
        .then(function(response) {
            return response.json(); // parsea la respuesta JSON
        })
        .then(function(resultado) {
            var resultadoDiv = document.getElementById('resultado');
            if (resultado == undefined || resultado == null) {
                resultadoDiv.textContent = "El paquete no existe o no está registrado aún.";
            } else {
                resultadoDiv.textContent = "Dirección de entrega: " + resultado.calle + " " + resultado.num + ", en " + resultado.localidad + ", " + resultado.departamento;
                
            }
        })
        .catch(function(error) {
            console.error('Error en la solicitud:', error);
        });
    });


// var direccion = resultado.num + ' ' + resultado.calle + ', ' + resultado.departamento + ', Uruguay';

//     // Realiza la geocodificación utilizando Nominatim para obtener las coordenadas de la dirección del paquete
//     fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + direccion)
//         .then(function(response) {
//             return response.json(); // parsea la respuesta JSON
//         })
//         .then(function(data) {
//             if (data && data.length > 0) {
//                 // Obtiene las coordenadas de la dirección del paquete
//                 var latitudDestino = parseFloat(data[0].lat);
//                 var longitudDestino = parseFloat(data[0].lon);

//                 // Coordenadas de la Plaza Independencia en Montevideo, Uruguay
//                 var latitudPlazaIndependencia = -34.903555;
//                 var longitudPlazaIndependencia = -56.188554;

//                 // Crea el mapa y muestra la ruta desde la Plaza Independencia hasta la dirección del paquete
//                 var map = L.map('map').setView([latitudDestino, longitudDestino], 13); // Coordenadas de la dirección del paquete y nivel de zoom iniciales

//                 // Crea el marcador para la dirección del paquete
//                 var destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);

//                 // Crea el control de enrutamiento con la Plaza Independencia como origen
//                 L.Routing.control({
//                     waypoints: [
//                         L.latLng(latitudPlazaIndependencia, longitudPlazaIndependencia),
//                         L.latLng(latitudDestino, longitudDestino)
//                     ],
//                     routeWhileDragging: true,
//                     geocoder: L.Control.Geocoder.nominatim(),
//                     
//                 }).addTo(map);
//             } else {
//                 console.error('No se encontraron coordenadas para la dirección proporcionada.');
//             }
//         })
//         .catch(function(error) {
//             console.error('Error en la solicitud:', error);
//         });
//     });




    
        
