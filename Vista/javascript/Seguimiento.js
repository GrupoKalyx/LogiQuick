// document.addEventListener('DOMContentLoaded', async function () {
//     try {
//         const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=listar');
//         const paquetes = await response.json();
//         const tabla = document.getElementById('paquetesTable').getElementsByTagName('tbody')[0];
        

//         paquetes.forEach(paquete => {
//             const fila = tabla.insertRow();
//             const celdaId = fila.insertCell();
//             const celdaDireccion = fila.insertCell();

//             celdaId.textContent = paquete.numBulto;

//             celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;


//             fila.setAttribute('data-id', paquete.id);

//             fila.addEventListener('click', function () {
//                 eliminarMapa();
//                 marcarRutaEnMapa(paquete.num, paquete.calle, paquete.departamento);
//             });
//         });
//     } catch (error) {
//         console.error('Error en la solicitud:', error);
//     }
// });


// let map = null;

// async function eliminarMapa() {
//     if (map) {
//         map.remove();
//         map = null;
//     }
// }

// async function marcarRutaEnMapa(num, calle, departamento) {
//     const direccionCompleta = num + ' ' + calle + ', ' + departamento + ', Uruguay';
//     const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24';
//     const apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(direccionCompleta)}&key=${apiKey}`;

//     try {
//         const geocodingResponse = await fetch(apiUrl);
//         const geocodingData = await geocodingResponse.json();

//         if (geocodingData.results && geocodingData.results.length > 0) {
//             const location = geocodingData.results[0].geometry;
//             const latitudDestino = location.lat;
//             const longitudDestino = location.lng;

//             map = L.map('map').setView([latitudDestino, longitudDestino], 13);

//             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                 attribution: '© OpenStreetMap contributors'
//             }).addTo(map);

//             const destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);
//             const latitudPlazaIndependencia = -34.903555;
//             const longitudPlazaIndependencia = -56.188554;

//             L.Routing.control({
//                 waypoints: [
//                     L.latLng(latitudPlazaIndependencia, longitudPlazaIndependencia),
//                     L.latLng(latitudDestino, longitudDestino)
//                 ],
//                 routeWhileDragging: true,
//                 show: true,
//                 language: 'es'
//             }).addTo(map);
//         } else {
//             console.error('No se encontraron coordenadas para la dirección proporcionada.');
//         }
//     } catch (error) {
//         console.error('Error en la solicitud de geocodificación:', error);
//     }
// }




// document.addEventListener('DOMContentLoaded', async function () {
//     try {
//         const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=listar');
//         const paquetes = await response.json();
//         const tabla = document.getElementById('paquetesTable').getElementsByTagName('tbody')[0];

       

//         const response2 = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`);
//         const almacenes = await response2.json
    
        

//         paquetes.forEach(paquete => {
//             const fila = tabla.insertRow();
//             const celdaId = fila.insertCell();
//             const celdaDireccion = fila.insertCell();

//             celdaId.textContent = paquete.numBulto;
//             celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;

//             fila.setAttribute('data-id', paquete.id);

//             fila.addEventListener('click', function () {
//                 eliminarMapa();
//                 marcarRutaEnMapa(paquete.lat, paquete.lng, almacenes.lat, almacenes.lng);
//             });
//         });
//     } catch (error) {
//         console.error('Error en la solicitud:', error);
//     }


// let map = null;

// async function eliminarMapa() {
//     if (map) {
//         map.remove();
//         map = null;
//     }
// }

// async function marcarRutaEnMapa(latitudDestino, longitudDestino, latitudAlmacen, longitudAlmacen) {
//     map = L.map('map').setView([latitudDestino, longitudDestino], 13);

//     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//         attribution: '© OpenStreetMap contributors'
//     }).addTo(map);

//     const destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);
    


//     L.Routing.control({
//         waypoints: [
//             L.latLng(latitudAlmacen, longitudAlmacen),
//             L.latLng(latitudDestino, longitudDestino)
//         ],
//         routeWhileDragging: true,
//         show: true,
//         language: 'es'
//     }).addTo(map);
// }

// async function obtenerDatosAlmacen(idRastreo) {
//     const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`);
//     return response.json();
// }
// });

    // document.addEventListener('DOMContentLoaded', async function () {
    //     try {
    //         const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=listar');
    //         const paquetes = await response.json();
    //         const tabla = document.getElementById('paquetesTable').getElementsByTagName('tbody')[0];

    //         paquetes.forEach(async paquete => {
    //             const fila = tabla.insertRow();
    //             const celdaId = fila.insertCell();
    //             const celdaDireccion = fila.insertCell();

    //             celdaId.textContent = paquete.numBulto;
    //             celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;

    //             fila.setAttribute('data-id', paquete.id);

    //             fila.addEventListener('click', async function () {
    //                 eliminarMapa();
    //                 const almacenes = await obtenerDatosAlmacen(paquete.idRastreo);
    //                 console.log(almacenes);
    //                 if (almacenes && almacenes.lat && almacenes.lng) {
    //                     marcarRutaEnMapa(paquete.lat, paquete.lng, almacenes.lat, almacenes.lng);
    //                 } else {
    //                     console.error('No se encontraron coordenadas para el almacén o el paquete.');
    //                 }
    //             });
    //         });
    //     } catch (error) {
    //         console.error('Error en la solicitud:', error);
    //     }

    //     let map = null;

    //     async function eliminarMapa() {
    //         if (map) {
    //             map.remove();
    //             map = null;
    //         }
    //     }

    //     async function marcarRutaEnMapa(latitudDestino, longitudDestino, latitudAlmacen, longitudAlmacen) {
    //         map = L.map('map').setView([latitudDestino, longitudDestino], 13);

    //         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //             attribution: '© OpenStreetMap contributors'
    //         }).addTo(map);

    //         const destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);

    //         L.Routing.control({
    //             waypoints: [
    //                 L.latLng(latitudAlmacen, longitudAlmacen),
    //                 L.latLng(latitudDestino, longitudDestino)
    //             ],
    //             routeWhileDragging: true,
    //             show: true,
    //             language: 'es'
    //         }).addTo(map);
    //     }

    //     async function obtenerDatosAlmacen(idRastreo) {
    //         const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`);
    //         return response.json();
    //     }
    // });


    document.addEventListener('DOMContentLoaded', async function () {
        try {
            const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=listar');
            const paquetes = await response.json();
            const tabla = document.getElementById('paquetesTable').getElementsByTagName('tbody')[0];
    
            const resultados = await Promise.all(paquetes.map(async paquete => {
                const almacenes = await obtenerDatosAlmacen(paquete.idRastreo);
                return { paquete, almacenes };
            }));
    
            for (const { paquete, almacenes } of resultados) {
                const fila = tabla.insertRow();
                const celdaId = fila.insertCell();
                const celdaDireccion = fila.insertCell();
    
                celdaId.textContent = paquete.numBulto;
                celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;
    
                fila.setAttribute('data-id', paquete.numBulto); // Utilizando numBulto como identificador en la fila
    
                fila.addEventListener('click', async function () {
                    eliminarMapa();
                    console.log(almacenes)
                    if (almacenes && almacenes.lat && almacenes.lng) {
                        marcarRutaEnMapa(paquete.lat, paquete.lng, almacenes.lat, almacenes.lng);
                    } else {
                        console.error('Datos de latitud y longitud inválidos para el almacén o el paquete.');
                    }
                });
            }
        } catch (error) {
            console.error('Error en la solicitud:', error);
        }
    
        let map = null;
    
        async function eliminarMapa() {
            if (map) {
                map.remove();
                map = null;
            }
        }
    
        async function marcarRutaEnMapa(latitudDestino, longitudDestino, latitudAlmacen, longitudAlmacen) {
            map = L.map('map').setView([latitudDestino, longitudDestino], 13);
    
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
    
            const destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);
    
            L.Routing.control({
                waypoints: [
                    L.latLng(latitudAlmacen, longitudAlmacen),
                    L.latLng(latitudDestino, longitudDestino)
                ],
                routeWhileDragging: true,
                show: true,
                language: 'es'
            }).addTo(map);
        }
    
        async function obtenerDatosAlmacen(idRastreo) {
            try {
                const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`);
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error al obtener datos del almacén:', error);
                return null;
            }
        }
    });
    