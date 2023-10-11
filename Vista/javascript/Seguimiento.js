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
//         try {
//             const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=listar');
//             const paquetes = await response.json();
//             const tabla = document.getElementById('paquetesTable').getElementsByTagName('tbody')[0];

//             paquetes.forEach(async paquete => {

//                 const fila = tabla.insertRow();
//                 const celdaId = fila.insertCell();
//                 const celdaDireccion = fila.insertCell();

//                 async function obtenerDatosAlmacen() {
//                     const almacen = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${paquete.idRastreo}`);
//                     return almacen.json();
//                 }

//                 celdaId.textContent = paquete.numBulto;
//                 celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;

//                 fila.setAttribute('data-id', paquete.id);

//                 fila.addEventListener('click', async function () {
//                     eliminarMapa();
//                     const almacenes = await obtenerDatosAlmacen(paquete.idRastreo);
//                     console.log(almacenes);
//                     if (Array.isArray(almacenes) && almacenes.length > 0) {
//                         for (const almacen of almacenes) {
//                             // Obtener datos del almacén si es necesario
//                             // await obtenerDatosAlmacen(almacen.id); // Llama a obtenerDatosAlmacen si es necesario

//                             // Marcar la ruta en el mapa
//                             marcarRutaEnMapa(paquete.lat, paquete.lng, almacen.lat, almacen.lng);
//                         }
//                     } else {
//                         console.error('No se encontraron coordenadas para el almacén o el paquete.');
//                     }
//                 });
//             });
//         } catch (error) {
//             console.error('Error en la solicitud:', error);
//         }

//         let map = null;

//         async function eliminarMapa() {
//             if (map) {
//                 map.remove();
//                 map = null;
//             }
//         }

//         async function marcarRutaEnMapa(latitudDestino, longitudDestino, latitudAlmacen, longitudAlmacen) {
//             map = L.map('map').setView([latitudDestino, longitudDestino], 13);

//             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                 attribution: '© OpenStreetMap contributors'
//             }).addTo(map);

//             const destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);

//             L.Routing.control({
//                 waypoints: [
//                     L.latLng(latitudAlmacen, longitudAlmacen),
//                     L.latLng(latitudDestino, longitudDestino)
//                 ],
//                 routeWhileDragging: true,
//                 show: true,
//                 language: 'es'
//             }).addTo(map);
//         }


//     });




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

//                 try {
//                     const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${paquete.idRastreo}`);
//                     const almacenes = await response.json();

//                     if (Array.isArray(almacenes) && almacenes.length > 0) {
//                         almacenes.forEach(almacen => {

//                             if (almacen.lat && almacen.lng) {
//                                 marcarRutaEnMapa(paquete.lat, paquete.lng, almacen.lat, almacen.lng);

//                             } else {
//                                 console.error('Datos de latitud y longitud inválidos para el almacén o el paquete.');
//                             }
//                         });
//                     } else {
//                         console.error('No se encontraron coordenadas para el almacén o el paquete.');
//                     }
//                 } catch (error) {
//                     console.error('Error al obtener datos del almacén:', error);
//                 }
//             });
//         });
//     } catch (error) {
//         console.error('Error en la solicitud:', error);
//     }

//     let map = null;

//     function eliminarMapa() {
//         if (map) {
//             map.remove();
//             map = null;
//         }
//     }

//     function marcarRutaEnMapa(latitudDestino, longitudDestino, latitudAlmacen, longitudAlmacen) {
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


// });

document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=listar', {
            headers: {
                'Cache-Control': 'no-cache'
            }
        });
        const paquetes = await response.json();
        const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

        paquetes.forEach(async paquete => {

            const fila = tabla.insertRow();
            const celdaId = fila.insertCell();
            const celdaDireccion = fila.insertCell();
            // const celdaRastreo = fila.insertCell();

            // celdaRastreo.textContent = paquete.idRastreo
            celdaId.textContent = paquete.numBulto;
            celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;

            fila.setAttribute('data-id', paquete.numBulto);

            // Usar un closure para mantener el valor específico de paquete.idRastreo en el contexto del addEventListener
            fila.addEventListener('click', async function () {
                eliminarMapa();
                const idRastreo = paquete.idRastreo
                console.log(idRastreo);

                try {
                    // Hacer el fetch del almacén asociado al paquete clickeado
                    const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`, {
                        headers: {
                            'Cache-Control': 'no-cache'
                        }
                    });
                    const almacen = await response.json();
                    console.log(almacen)

                    if (almacen && almacen.lat && almacen.lng) {
                        // Si se encontraron coordenadas para el almacén, marcar la ruta en el mapa
                        marcarRutaEnMapa(paquete.lat, paquete.lng, almacen.lat, almacen.lng);
                    } else {
                        console.error('Datos de latitud y longitud inválidos para el almacén o el paquete.');
                    }
                } catch (error) {
                    console.error('Error al obtener datos del almacén:', error);
                }
            });
        });
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }

    let map = null;

    function eliminarMapa() {
        if (map) {
            map.remove();
            map = null;
        }
    }

    function marcarRutaEnMapa(latitudDestino, longitudDestino, latitudAlmacen, longitudAlmacen) {
        map = L.map('map').setView([latitudAlmacen, longitudAlmacen], 13);

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


});