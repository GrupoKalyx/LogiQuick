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
                eliminarMapa(); 

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
                       
                        const departamentoPaquete = paquete.departamento;

                 
                        if (departamentosRuta.includes(departamentoPaquete)) {
                            const coordenadasPaquete = await codificarCoordenadas(paquete.direccion);
                            coordenadasPaquetes.push([coordenadasPaquete.latitud, coordenadasPaquete.longitud]);
                        }
                    });
                }

                if (coordenadasAlmacenes.length > 0 || coordenadasPaquetes.length > 0) {
                
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

                  
                    coordenadasAlmacenes.forEach(coordenada => {
                        L.marker(coordenada, {
                                icon: iconoPersonalizadoAlmacen
                            }).addTo(map)
                            .bindPopup(`Almacén - Latitud: ${coordenada[0]}, Longitud: ${coordenada[1]}`);
                    });

                    const plazaMarker = L.marker(plazaIndependenciaCoordenadas, {
                            icon: iconoPersonalizadoCamion
                        }).addTo(map)
                        .bindPopup('CENTRAL QUICKCARRY');

                 
                    coordenadasPaquetes.forEach(coordenada => {
                        L.marker(coordenada, {
                                icon: iconoPersonalizadoPaquete
                            }).addTo(map)
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
//     let map = null;

//     try {
//         const ci = "57019460"

//         const responseConductor = await fetch(`http://localhost/LogiQuick/Control/controladorLlevan.php?function=LoteDeConductor&ci=57019460`, {
            
//             headers: {
//                 'Cache-Control': 'no-cache'
//             }
           
//         });
         
//         const lotesConductor = await responseConductor.json();

//         const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

//         lotesConductor.forEach(async loteConductor => {
//             const fila = tabla.insertRow();
//             const celdaIdLote = fila.insertCell();
//             const celdaIdAlmacen = fila.insertCell();
//             const celdaNumRuta = fila.insertCell();

//             celdaIdLote.textContent = loteConductor.idLote;
//             celdaIdAlmacen.textContent = loteConductor.idAlmacen;
//             celdaNumRuta.textContent = loteConductor.numRuta;

//             fila.addEventListener('click', async function () {
//                 eliminarMapa();

//                 const departamentosRuta = celdaNumRuta.textContent.split(',').map(dep => dep.trim());

//                 const almacenesCoincidentes = await Promise.all(departamentosRuta.map(async departamento => {
//                     const almacenesEnDepartamento = await obtenerAlmacenesPorDepartamento(departamento);
//                     return almacenesEnDepartamento;
//                 }));

//                 const coordenadasAlmacenes = almacenesCoincidentes.flat().map(almacen => [almacen.lat, almacen.lng]);

//                 const paquetesPorLote = await muestraPaquetesAsociados(loteConductor.idLote);

//                 const coordenadasPaquetes = [];

//                 if (paquetesPorLote.length > 0) {
//                     paquetesPorLote.forEach(async (paquete) => {
//                         const departamentoPaquete = paquete.departamento;

//                         if (departamentosRuta.includes(departamentoPaquete)) {
//                             const coordenadasPaquete = await codificarCoordenadas(paquete.direccion);
//                             coordenadasPaquetes.push([coordenadasPaquete.latitud, coordenadasPaquete.longitud]);
//                         }
//                     });
//                 }

//                 if (coordenadasAlmacenes.length > 0 || coordenadasPaquetes.length > 0) {
//                     const centro = coordenadasAlmacenes.length > 0 ? coordenadasAlmacenes[0] : coordenadasPaquetes[0];
//                     map = L.map('map').setView(centro, 8.5);

//                     L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                         attribution: '© OpenStreetMap contributors'
//                     }).addTo(map);

//                     const iconoPersonalizadoAlmacen = L.icon({
//                         iconUrl: '../../assets/AlmacenIcon.png',
//                         iconSize: [40, 40],
//                         iconAnchor: [25, 50],
//                         popupAnchor: [0, -50]
//                     });

//                     const iconoPersonalizadoPaquete = L.icon({
//                         iconUrl: '../../assets/PaqueteIcon.png',
//                         iconSize: [40, 40],
//                         iconAnchor: [25, 50],
//                         popupAnchor: [0, -50]
//                     });

//                     const plazaIndependenciaCoordenadas = [-34.903611, -56.188056];
//                     const iconoPersonalizadoCamion = L.icon({
//                         iconUrl: '../../assets/CamionIcon.png',
//                         iconSize: [40, 40],
//                         iconAnchor: [25, 50],
//                         popupAnchor: [0, -50]
//                     });

//                     coordenadasAlmacenes.forEach(coordenada => {
//                         L.marker(coordenada, {
//                             icon: iconoPersonalizadoAlmacen
//                         }).addTo(map)
//                             .bindPopup(`Almacén - Latitud: ${coordenada[0]}, Longitud: ${coordenada[1]}`);
//                     });

//                     const plazaMarker = L.marker(plazaIndependenciaCoordenadas, {
//                         icon: iconoPersonalizadoCamion
//                     }).addTo(map)
//                         .bindPopup('CENTRAL QUICKCARRY');

//                     coordenadasPaquetes.forEach(coordenada => {
//                         L.marker(coordenada, {
//                             icon: iconoPersonalizadoPaquete
//                         }).addTo(map)
//                             .bindPopup(`Paquete - Latitud: ${coordenada[0]}, Longitud: ${coordenada[1]}`);
//                     });
//                 } else {
//                     console.error('No se encontraron almacenes o paquetes para los departamentos proporcionados.');
//                 }
//             });
//         });
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
// });
