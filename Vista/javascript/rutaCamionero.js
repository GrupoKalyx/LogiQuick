
// document.addEventListener('DOMContentLoaded', async function () {
//     let map = null;

//     try {
//         const ci = "57019460"

//         const responseConductor = await fetch(`http://localhost/LogiQuick/Control/controladorLlevan.php?function=LoteDeConductor&ci=${ci}`, {
//             headers: {
//                 'Cache-Control': 'no-cache'
//             }
//         });

//         const responseText = await responseConductor.text();
//         console.log(responseText);  // Verifica el contenido real de la respuesta

//         // Intenta extraer el JSON de la cadena
//         const jsonString = responseText.match(/\[.*\]/); // Esto asume que el JSON está entre corchetes
//         if (jsonString) {
//             try {
//                 const lotesConductor = JSON.parse(jsonString[0]);
//                 console.log(lotesConductor);

//                 const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

//                 for (const loteConductor of lotesConductor) {
//                     const fila = tabla.insertRow();
//                     const celdaIdLote = fila.insertCell();
//                     const celdaIdAlmacen = fila.insertCell();
//                     const celdaNumRuta = fila.insertCell();

//                     celdaIdLote.textContent = loteConductor.idLote;

//                     // Obtén los detalles de Almacén y Ruta
//                     const detallesAlmacen = await obtenerDetallesAlmacen(loteConductor.idLote);
//                     const detallesRuta = await obtenerDetallesRuta(loteConductor.idLote);

//                     // Asigna los datos a las celdas
//                     celdaIdAlmacen.textContent = detallesAlmacen.idAlmacen; // Ajusta según tu estructura real
//                     celdaNumRuta.textContent = detallesRuta.numRuta; // Ajusta según tu estructura real

//                     fila.addEventListener('click', async function () {
//                         eliminarMapa();

//                         const departamentosRuta = celdaNumRuta.textContent.split(',').map(dep => dep.trim());

//                         const almacenesCoincidentes = await Promise.all(departamentosRuta.map(async departamento => {
//                             const almacenesEnDepartamento = await obtenerAlmacenesPorDepartamento(departamento);
//                             return almacenesEnDepartamento;
//                         }));

//                         const coordenadasAlmacenes = almacenesCoincidentes.flat().map(almacen => [almacen.lat, almacen.lng]);

//                         const paquetesPorLote = await muestraPaquetesAsociados(loteConductor.idLote);

//                         const coordenadasPaquetes = [];

//                         if (paquetesPorLote.length > 0) {
//                             paquetesPorLote.forEach(async (paquete) => {
//                                 const departamentoPaquete = paquete.departamento;

//                                 if (departamentosRuta.includes(departamentoPaquete)) {
//                                     const coordenadasPaquete = await codificarCoordenadas(paquete.direccion);
//                                     coordenadasPaquetes.push([coordenadasPaquete.latitud, coordenadasPaquete.longitud]);
//                                 }
//                             });
//                         }

//                         if (coordenadasAlmacenes.length > 0 || coordenadasPaquetes.length > 0) {
//                             const centro = coordenadasAlmacenes.length > 0 ? coordenadasAlmacenes[0] : coordenadasPaquetes[0];
//                             map = L.map('map').setView(centro, 8.5);

//                             L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                                 attribution: '© OpenStreetMap contributors'
//                             }).addTo(map);

//                             const iconoPersonalizadoAlmacen = L.icon({
//                                 iconUrl: '../../assets/AlmacenIcon.png',
//                                 iconSize: [40, 40],
//                                 iconAnchor: [25, 50],
//                                 popupAnchor: [0, -50]
//                             });

//                             const iconoPersonalizadoPaquete = L.icon({
//                                 iconUrl: '../../assets/PaqueteIcon.png',
//                                 iconSize: [40, 40],
//                                 iconAnchor: [25, 50],
//                                 popupAnchor: [0, -50]
//                             });

//                             const plazaIndependenciaCoordenadas = [-34.903611, -56.188056];
//                             const iconoPersonalizadoCamion = L.icon({
//                                 iconUrl: '../../assets/CamionIcon.png',
//                                 iconSize: [40, 40],
//                                 iconAnchor: [25, 50],
//                                 popupAnchor: [0, -50]
//                             });

//                             coordenadasAlmacenes.forEach(coordenada => {
//                                 L.marker(coordenada, {
//                                     icon: iconoPersonalizadoAlmacen
//                                 }).addTo(map)
//                                     .bindPopup(`Almacén - Latitud: ${coordenada[0]}, Longitud: ${coordenada[1]}`);
//                             });

//                             const plazaMarker = L.marker(plazaIndependenciaCoordenadas, {
//                                 icon: iconoPersonalizadoCamion
//                             }).addTo(map)
//                                 .bindPopup('CENTRAL QUICKCARRY');

//                             coordenadasPaquetes.forEach(coordenada => {
//                                 L.marker(coordenada, {
//                                     icon: iconoPersonalizadoPaquete
//                                 }).addTo(map)
//                                     .bindPopup(`Paquete - Latitud: ${coordenada[0]}, Longitud: ${coordenada[1]}`);
//                             });
//                         } else {
//                             console.error('No se encontraron almacenes o paquetes para los departamentos proporcionados.');
//                         }
//                     });
//                 }
//             } catch (error) {
//                 console.error('Error al analizar JSON:', error);
//             }
//         } else {
//             console.error('No se encontró JSON válido en la respuesta.');
//         }
//     } catch (error) {
//         console.error('Error en la solicitud:', error);
//     }

//     function eliminarMapa() {
//         if (map) {
//             map.remove();
//             map = null;
//         }
//     }

//     async function codificarCoordenadas(direccion) {
//         const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24';
//         const response = await fetch(`https://api.opencagedata.com/geocode/v1/json?q=${direccion}&key=${apiKey}`);
//         const data = await response.json();

//         if (data.results && data.results.length > 0) {
//             const primeraCoincidencia = data.results[0];
//             const coordenadas = {
//                 latitud: primeraCoincidencia.geometry.lat,
//                 longitud: primeraCoincidencia.geometry.lng
//             };
//             return coordenadas;
//         } else {
//             throw new Error('No se encontraron coordenadas para la dirección proporcionada.');
//         }
//     }

//     async function obtenerAlmacenesPorDepartamento(departamento) {
//         try {
//             const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarAlmacenPorDepartamento&departamento=${departamento}`);
//             const almacenes = await response.json();
//             return almacenes;
//         } catch (error) {
//             console.error('Error al obtener almacenes por departamento:', error);
//             return [];
//         }
//     }

//     async function muestraPaquetesAsociados(idLote) {
//         try {
//             const response = await fetch(`http://localhost/LogiQuick/Control/controladorLotes.php?function=muestraPaquetesAsociados&idLote=${idLote}`);
//             const paquetes = await response.json();
//             return paquetes;
//         } catch (error) {
//             console.error('Error al obtener paquetes por lote:', error);
//             return [];
//         }
//     }

//     async function obtenerDetallesAlmacen(idLote) {
//         const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarDetallesAlmacen&idLote=${idLote}`);
//         const almacen = await response.json();
//         return almacen;
//     }

//     async function obtenerDetallesRuta(idLote) {
//         const response = await fetch(`http://localhost/LogiQuick/Control/controladorRutas.php?function=mostrarDetallesRuta&idLote=${idLote}`);
//         const ruta = await response.json();
//         return ruta;
//     }
// });



// document.addEventListener('DOMContentLoaded', async function () {
//     try {
//         const ci = "57019460";
//         const responseConductor = await fetch(`http://localhost/LogiQuick/Control/controladorLlevan.php?function=LoteDeConductor&ci=${ci}`, {
//             headers: {
//                 'Cache-Control': 'no-cache'
//             }
//         });

//         const responseText = await responseConductor.text();
//         const jsonString = responseText.match(/\[.*\]/);

//         if (jsonString) {
//             const lotesConductor = JSON.parse(jsonString[0]);
//             const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

//             for (const loteConductor of lotesConductor) {
//                 try {
//                     const fila = tabla.insertRow();
//                     fila.insertCell().textContent = loteConductor.idLote;

//                     const detallesAlmacen = await obtenerDetallesAlmacen(loteConductor.idLote);
//                     const detallesRuta = await obtenerDetallesRuta(loteConductor.idLote);

//                     fila.insertCell().textContent = detallesAlmacen.idAlmacen;
//                     fila.insertCell().textContent = detallesRuta.numRuta;
//                 } catch (error) {
//                     console.error('Error al obtener detalles:', error);
//                 }
//             }
//         } else {
//             console.error('No se encontró JSON válido en la respuesta.');
//         }
//     } catch (error) {
//         console.error('Error en la solicitud:', error);
//     }

//     async function obtenerDetallesAlmacen(idLote) {
//         const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarDetallesAlmacen&idLote=${idLote}`);
//         const almacen = await response.json();
//         return almacen;
//     }

//     async function obtenerDetallesRuta(idLote) {
//         const response = await fetch(`http://localhost/LogiQuick/Control/controladorRutas.php?function=mostrarDetallesRuta&idLote=${idLote}`);
//         const ruta = await response.json();
//         return ruta;
//     }
// });


document.addEventListener('DOMContentLoaded', async function () {
    let map = null;

    try {
        const ci = await fetch ('http://localhost/LogiQuick/Control/controladorTokens.php?function=getCi');
        const responseConductor = await fetch(`http://localhost/LogiQuick/Control/controladorLlevan.php?function=LoteDeConductor&ci=${ci}`, {
            headers: {
                'Cache-Control': 'no-cache'
            }
        });

        const responseText = await responseConductor.text();
        console.log(responseText);

        const jsonString = responseText.match(/\[.*\]/);

        if (jsonString) {
            const lotesConductor = JSON.parse(jsonString[0]);
            console.log(lotesConductor);

            const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

            await Promise.all(lotesConductor.map(async loteConductor => {
                try {
                    const fila = tabla.insertRow();
                    const idLoteCell = fila.insertCell();
                    idLoteCell.innerText = loteConductor.idLote;

                    const [detallesAlmacen, detallesRuta] = await Promise.all([
                        obtenerDetallesAlmacen(loteConductor.idLote),
                        obtenerDetallesRuta(loteConductor.idLote)
                    ]);

                    const direccionAlmacenCell = fila.insertCell();
                    direccionAlmacenCell.innerText = `${detallesAlmacen[0].calle}, ${detallesAlmacen[0].num}, ${detallesAlmacen[0].localidad}`;

                    const departamentosRutaCell = fila.insertCell();
                    departamentosRutaCell.innerText = detallesRuta[0].departamentos;

                    fila.addEventListener('click', async function () {
                        eliminarMapa();

                        const departamentosRuta = departamentosRutaCell.textContent.split(',').map(dep => dep.trim());

                        const almacenesEnRuta = await Promise.all(departamentosRuta.map(async departamento => {
                            const almacenesEnDepartamento = await obtenerAlmacenesPorDepartamento(departamento);
                            return almacenesEnDepartamento;
                        }));

                        const coordenadasAlmacenes = almacenesEnRuta.flat().map(almacen => [almacen.lat, almacen.lng]);

                        if (coordenadasAlmacenes.length > 0) {
                            const centro = coordenadasAlmacenes[0];
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

                            const iconoPersonalizadoAlmacenDestino = L.icon({
                                iconUrl: '../../assets/AlmacenDestinoIcon.png',
                                iconSize: [40, 40],
                                iconAnchor: [25, 50],
                                popupAnchor: [0, -50]
                            });

                            coordenadasAlmacenes.forEach(coordenada => {
                                L.marker(coordenada, {
                                    icon: iconoPersonalizadoAlmacen
                                }).addTo(map)
                                    .bindPopup(`Almacén - Latitud: ${coordenada[0]}, Longitud: ${coordenada[1]}`);
                            });

                            
                            // Agregar marcador para la central de QuickCarrty en Plaza Independencia
                            const plazaIndependenciaCoordenadas = [-34.903611, -56.188056];
                            const iconoCentralQuickCarry = L.icon({
                                iconUrl: '../../assets/CamionIcon.png',
                                iconSize: [40, 40],
                                iconAnchor: [25, 50],
                                popupAnchor: [0, -50]
                            });

                            L.marker(plazaIndependenciaCoordenadas, {
                                icon: iconoCentralQuickCarry
                            }).addTo(map)
                                .bindPopup('CENTRAL QUICKCARRY');
                        } else {
                            console.error('No se encontraron almacenes para los departamentos proporcionados.');
                        }
                    });
                } catch (error) {
                    console.error('Error al obtener detalles:', error);
                }
            }));
        } else {
            console.error('No se encontró JSON válido en la respuesta.');
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }

    function eliminarMapa() {
        if (map) {
            map.remove();
            map = null;
        }
    }

    async function obtenerDetallesAlmacen(idLote) {
        const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarDetallesAlmacen&idLote=${idLote}`);
        const almacen = await response.json();
        return almacen;
    }

    async function obtenerDetallesRuta(idLote) {
        const response = await fetch(`http://localhost/LogiQuick/Control/controladorRutas.php?function=mostrarDetallesRuta&idLote=${idLote}`);
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
});