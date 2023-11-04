// document.addEventListener('DOMContentLoaded', async function () {
//     try {
//         const response = await fetch('http://localhost/LogiQuick/Control/controladorVan.php?function=listar', {
//             headers: {
//                 'Cache-Control': 'no-cache'
//             }
//         });
        
//         const lotes = await response.json();
//         const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

//         lotes.forEach(async lote => {

//             const fila = tabla.insertRow();
//             const celdaIdLote = fila.insertCell();
//             const celdaDireccion = fila.insertCell();
//             const celdaDireccionAlmacen = fila.insertCell();

//             celdaIdLote.textContent = lote.idLote;
//             celdaDireccion.textContent = lote.idAlmacen

//             fila.setAttribute('data-idLote', lote.idLote);

//             fila.addEventListener('click', async function () {
//                 eliminarMapa();
//                 const idLote = this.getAttribute('data-idLote');
//                 console.log(idLote);

//                 try {
//                     const response = await fetch(`http://localhost/LogiQuick/Control/controladorVan.php?function=mostrarAlmacenDeLote&idLote=${idLote}`, {
//                         headers: {
//                             'Cache-Control': 'no-cache'
//                         }
//                     });
//                     const almacen = await response.json();
//                     celdaDireccionAlmacen.textContent = almacen.num + ' ' + almacen.calle + ', ' + almacen.localidad + ', ' + almacen.departamento;
//                     console.log(almacen);

//                     if (almacen && almacen.lat && almacen.lng) {
//                         marcarRutaEnMapa(almacen.lat, almacen.lng);
//                     } else {
//                         console.error('Datos de latitud y longitud inválidos para el almacén o el paquete.');
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

    // function eliminarMapa() {
    //     if (map) {
    //         map.remove();
    //         map = null;
    //     }
//     }

//     function marcarRutaEnMapa(latitudAlmacen, longitudAlmacen) {

//         const almacenCentralLat = "-34.9035086";
//         const almacenCentralLng = "-56.1947728"


//         map = L.map('map').setView([almacenCentralLat, almacenCentralLng], 13);

//         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//             attribution: '© OpenStreetMap contributors'
//         }).addTo(map);

//         const destinoMarker = L.marker([latitudAlmacen, longitudAlmacen]).addTo(map);

      

//         L.Routing.control({
//             waypoints: [
//                 L.latLng(almacenCentralLat, almacenCentralLng),
//                 L.latLng(latitudAlmacen, longitudAlmacen)
//             ],
//             routeWhileDragging: true,
//             show: true,
//             language: 'es'
//         }).addTo(map);
//     }
// });

         













document.addEventListener('DOMContentLoaded', async function () {
    let map = null; 
    let controlRutas = null; // Variable para almacenar el control de rutas

    try {
        const response = await fetch('http://localhost/LogiQuick/Control/controladorLotesAlmacenesRutas.php?function=listar', {
            headers: {
                'Cache-Control': 'no-cache'
            }
        });

        const lotesAlmacenRutas = await response.json();
        const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

        lotesAlmacenRutas.forEach(async loteAlmacenRuta => {
            const fila = tabla.insertRow();
            const celdaIdLote = fila.insertCell();
            const celdaIdAlmacen = fila.insertCell();
            const celdaNumRuta = fila.insertCell(); 

            celdaIdLote.textContent = loteAlmacenRuta.idLote;

            const almacen = await obtenerDetallesAlmacen(loteAlmacenRuta.idAlmacen);
            const direccion = `${almacen[0].num} ${almacen[0].calle}, ${almacen[0].localidad}, ${almacen[0].departamento}`;
            celdaIdAlmacen.textContent = direccion;

            const ruta = await obtenerDetallesRuta(loteAlmacenRuta.numRuta);
            const departamentosRuta = ruta[0].departamentos.split(',').map(dep => dep.trim());

            celdaNumRuta.textContent = departamentosRuta.join(', ');

            fila.setAttribute('data-idLote', loteAlmacenRuta.idLote);
            fila.setAttribute('data-idAlmacen', loteAlmacenRuta.idAlmacen);
            fila.setAttribute('data-numRuta', departamentosRuta);

            fila.addEventListener('click', async function () {
                eliminarMapa(); // Eliminar el mapa existente al hacer clic en una fila
    
                const departamentosRuta = celdaNumRuta.textContent.split(',').map(dep => dep.trim());
    
                const almacenesCoincidentes = await Promise.all(departamentosRuta.map(async departamento => {
                    const almacenesEnDepartamento = await obtenerAlmacenesPorDepartamento(departamento);
                    return almacenesEnDepartamento;
                }));

                const coordenadasAlmacenes = almacenesCoincidentes.flat().map(almacen => [almacen.lat, almacen.lng]);

                // Obtener los paquetes asociados al lote
                const paquetesPorLote = await muestraPaquetesAsociados(loteAlmacenRuta.idLote);

                const coordenadasPaquetes = [];

                if (paquetesPorLote.length > 0) {
                    paquetesPorLote.forEach(async (paquete) => {
                        // Obtener el departamento del paquete
                        const departamentoPaquete = paquete.departamento;

                        // Verificar si el departamento del paquete está en los departamentos de la ruta
                        if (departamentosRuta.includes(departamentoPaquete)) {
                            const coordenadasPaquete = await codificarCoordenadas(paquete.direccion);
                            coordenadasPaquetes.push([coordenadasPaquete.latitud, coordenadasPaquete.longitud]);
                        }
                    });
                }

                if (coordenadasAlmacenes.length > 0 || coordenadasPaquetes.length > 0) {
                    // Establecer el centro del mapa en las coordenadas del primer almacén
                    const centro = coordenadasAlmacenes.length > 0 ? coordenadasAlmacenes[0] : coordenadasPaquetes[0];
                    map = L.map('map').setView(centro, 8.5);
    
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    const iconoPersonalizadoAlmacen = L.icon({
                        iconUrl: '../../assets/AlmacenIcon.png',
                        iconSize: [40, 40],
                        iconAnchor: [25, 50],
                        popupAnchor: [0, -50]
                    });

                    const iconoPersonalizadoPaquete = L.icon({
                        iconUrl: '../../assets/PaqueteIcon.png',
                        iconSize: [40, 40],
                        iconAnchor: [25, 50],
                        popupAnchor: [0, -50]
                    });

                    const plazaIndependenciaCoordenadas = [-34.903611, -56.188056];
                    const iconoPersonalizadoCamion = L.icon({
                        iconUrl: '../../assets/CamionIcon.png',
                        iconSize: [40, 40],
                        iconAnchor: [25, 50],
                        popupAnchor: [0, -50]
                    })

                    // Agregar marcadores para los almacenes en el mapa
                    coordenadasAlmacenes.forEach(coordenada => {
                        L.marker(coordenada, { icon: iconoPersonalizadoAlmacen }).addTo(map)
                            .bindPopup(`Almacén - Latitud: ${coordenada[0]}, Longitud: ${coordenada[1]}`);
                    });

                    const plazaMarker = L.marker(plazaIndependenciaCoordenadas, { icon: iconoPersonalizadoCamion }).addTo(map)
                    .bindPopup('CENTRAL QUICKCARRY');

                    // Agregar marcadores para los paquetes en el mapa
                    coordenadasPaquetes.forEach(coordenada => {
                        L.marker(coordenada, { icon: iconoPersonalizadoPaquete }).addTo(map)
                            .bindPopup(`Paquete - Latitud: ${coordenada[0]}, Longitud: ${coordenada[1]}`);
                    });
                } else {
                    console.error('No se encontraron almacenes o paquetes para los departamentos proporcionados.');
                }
            });
        });
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
    function eliminarMapa() {
        if (map) {
            map.remove();
            map = null;
        }
    }

    async function codificarCoordenadas(direccion) {
        const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24'; // Reemplaza 'TU_CLAVE_DE_API' con tu clave de API de OpenCageData
        const response = await fetch(`https://api.opencagedata.com/geocode/v1/json?q=${direccion}&key=${apiKey}`);
        const data = await response.json();

        if (data.results && data.results.length > 0) {
            const primeraCoincidencia = data.results[0];
            const coordenadas = {
                latitud: primeraCoincidencia.geometry.lat,
                longitud: primeraCoincidencia.geometry.lng
            };
            return coordenadas;
        } else {
            throw new Error('No se encontraron coordenadas para la dirección proporcionada.');
        }
    }
    
    async function obtenerDetallesAlmacen(idAlmacen) {
        const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarDetallesAlmacen&idAlmacen=${idAlmacen}`);
        const almacen = await response.json();
        return almacen;
    }
    
    async function obtenerDetallesRuta(numRuta) {
        const response = await fetch(`http://localhost/LogiQuick/Control/controladorRutas.php?function=mostrarDetallesRuta&numRuta=${numRuta}`);
        const ruta = await response.json();
        return ruta;
    }

    async function obtenerAlmacenesPorDepartamento(departamento) {
        try {
            const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarAlmacenPorDepartamento&departamento=${departamento}`);
            const almacenes = await response.json();
            return almacenes;
        } catch (error) {
            console.error('Error al obtener almacenes por departamento:', error);
            return [];
        }
    }
    async function muestraPaquetesAsociados(idLote) {
        try {
            const response = await fetch(`http://localhost/LogiQuick/Control/controladorLotes.php?function=muestraPaquetesAsociados&idLote=${idLote}`);
            const paquetes = await response.json();
            return paquetes;
        } catch (error) {
            console.error('Error al obtener paquetes por lote:', error);
            return [];
        }
    }
});










// document.addEventListener('DOMContentLoaded', async function () {
//     try {
//         const response = await fetch('http://localhost/LogiQuick/Control/controladorLotesAlmacenesRutas.php?function=listar', {
//             headers: {
//                 'Cache-Control': 'no-cache'
//             }
//         });

//         const lotesAlmacenRutas = await response.json();
//         const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

//         // Arreglo para almacenar las coordenadas de la ruta
//         const coordenadasRuta = [];

//         lotesAlmacenRutas.forEach(async loteAlmacenRuta => {
//             const fila = tabla.insertRow();
//             const celdaIdLote = fila.insertCell();
//             const celdaIdAlmacen = fila.insertCell();
//             const celdaNumRuta = fila.insertCell(); 
            
//             celdaIdLote.textContent = loteAlmacenRuta.idLote;
            
//             // Obtener detalles del almacén y asignar la dirección a celdaIdAlmacen
//             const almacen = await obtenerDetallesAlmacen(loteAlmacenRuta.idAlmacen);
//             const direccionAlmacen = `${almacen[0].num} ${almacen[0].calle}, ${almacen[0].localidad}, ${almacen[0].departamento}`;
//             celdaIdAlmacen.textContent = direccionAlmacen;

//             // Obtener detalles de la ruta y asignar la dirección a celdaNumRuta
//             const ruta = await obtenerDetallesRuta(loteAlmacenRuta.numRuta);
//             const puntosRuta = ruta[0].departamentos.split(','); // Dividir los puntos separados por comas
//             celdaNumRuta.textContent = ruta[0].departamentos;

//             // Codificar cada punto de la ruta a coordenadas utilizando OpenCageData
//             const coordenadasPuntos = await Promise.all(puntosRuta.map(async punto => {
//                 return await obtenerCoordenadas(punto.trim()); // Trim para eliminar espacios en blanco alrededor de cada punto
//             }));

//             coordenadasRuta.push(coordenadasPuntos);

//             fila.setAttribute('data-idLote', loteAlmacenRuta.idLote);
//             fila.setAttribute('data-idAlmacen', loteAlmacenRuta.idAlmacen);
//             fila.setAttribute('data-numRuta', loteAlmacenRuta.numRuta);

//             fila.addEventListener('click', async function () {
//                 eliminarMapa();
//                 const idLote = this.getAttribute('data-idLote');
//                 const idAlmacen = this.getAttribute('data-idAlmacen');
//                 const numRuta = this.getAttribute('data-numRuta');

//                 // Realizar solicitud adicional para obtener detalles del lote, almacén y ruta
//                 const [lote, almacen, ruta] = await Promise.all([
//                     obtenerDetallesLote(idLote),
//                     obtenerDetallesAlmacen(idAlmacen),
//                     obtenerDetallesRuta(numRuta)
//                 ]);

//                 console.log(lote, almacen, ruta);

//                 // Realizar las operaciones necesarias con los datos obtenidos.
//                 // ...
//             });
//         });

//         // Crear el mapa y agregar una capa de OpenStreetMap
//         const map = L.map('map').setView([coordenadasRuta[0][0].lat, coordenadasRuta[0][0].lng], 13);
//         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//             attribution: '© OpenStreetMap contributors'
//         }).addTo(map);

//         // Marcar los puntos en el mapa y unirlos para trazar la ruta
//         coordenadasRuta.forEach(coordenadasPuntos => {
//             coordenadasPuntos.forEach(coordenada => {
//                 L.marker([coordenada.lat, coordenada.lng]).addTo(map)
//                     .bindPopup(`Coordenadas: ${coordenada.lat}, ${coordenada.lng}`);
//             });

//             // Unir los puntos para trazar la ruta
//             const rutaLinea = L.polyline(coordenadasPuntos.map(coordenada => [coordenada.lat, coordenada.lng]), { color: 'red' }).addTo(map);
//         });

//     } catch (error) {
//         console.error('Error en la solicitud:', error);
//     }

//     async function obtenerDetallesLote(idLote) {
//         const response = await fetch(`http://localhost/LogiQuick/Control/controladorLotes.php?function=muestraPaquetesAsociados&idLote=${idLote}`);
//         const lote = await response.json();
//         return lote;
//     }
    
//     async function obtenerDetallesAlmacen(idAlmacen) {
//         const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarDetallesAlmacen&idAlmacen=${idAlmacen}`);
//         const almacen = await response.json();
//         return almacen;
//     }
    
//     async function obtenerDetallesRuta(numRuta) {
//         const response = await fetch(`http://localhost/LogiQuick/Control/controladorRutas.php?function=mostrarDetallesRuta&numRuta=${numRuta}`);
//         const ruta = await response.json();
//         return ruta;
//     }

//     let map = null;

//     function eliminarMapa() {
//          if (map) {
//             map.remove();
//             map = null;
//         }
//      }
// });

// async function obtenerCoordenadas(direccion) {
//     const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24'; // Reemplaza esto con tu clave de API
//     const response = await fetch(`https://api.opencagedata.com/geocode/v1/json?q=${direccion}&key=${apiKey}`);
//     const data = await response.json();
//     if (data.results && data.results.length > 0) {
//         const coordenadas = data.results[0].geometry;
//         return { lat: coordenadas.lat, lng: coordenadas.lng };
//     }
//     return null;
    

    
// }



