document.addEventListener('DOMContentLoaded', async function () {
    let map = null;
    let idLoteSeleccionado = null;

    try {
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
                    // Agregar una condición para mostrar solo filas con fecha_llegada igual a null
                    if (loteConductor.fecha_llegada === null) {
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

                            const idLoteClicado = obtenerIdLoteDesdeFila(this);

                            // Verifica si se obtuvo un idLote válido
                            if (idLoteClicado !== null) {
                                console.log('idLote clicado:', idLoteClicado);
                                idLoteSeleccionado = idLoteClicado;

                                // Resto del código...
                            } else {
                                console.error('No se pudo obtener el idLote desde la fila.');
                            }

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
                    }
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

    // Resto del código...





    //PARA EL BOTON
  

    function obtenerIdLoteDesdeFila(fila) {
        const idLoteCell = fila.querySelector('td:first-child'); // Suponiendo que el primer td contiene el idLote
        if (idLoteCell) {
            return idLoteCell.innerText.trim();
        } else {
            console.error('No se ha encontrado la celda de idLote en la fila.');
            return null;
        }
    }
 
    const buttonSalida = document.querySelectorAll('.empezar-viaje-btn');

    buttonSalida.forEach(button => {
        button.addEventListener('click', async function () {
            if (idLoteSeleccionado !== null) {
                console.log('Empezar Viaje para idLote:', idLoteSeleccionado);

                try {
                    
                    await marcarSalida(idLoteSeleccionado);
                } catch (error) {
                    console.error('Error al realizar la solicitud:', error);
                }
            } else {
                console.error('No hay un idLote seleccionado.');
            }
        });
    });
    
    async function marcarSalida(idLote) {
        try {
            const response = await axios.get(`http://localhost/LogiQuick/Control/controladorLlevan.php?function=MarcarSalida&idLote=${idLote}`);
            console.log(response.data);
        } catch (error) {
            console.error('Error al marcar la salida:', error);
        }
    }

    const buttonLlegada = document.querySelectorAll('.finalizar-viaje-btn');

    buttonLlegada.forEach(button => {
        button.addEventListener('click', async function () {
            if (idLoteSeleccionado !== null) {
                console.log('Finalizar Viaje para idLote:', idLoteSeleccionado);

                try {
                    
                    await marcarLlegada(idLoteSeleccionado);
                } catch (error) {
                    console.error('Error al realizar la solicitud:', error);
                }
            } else {
                console.error('No hay un idLote seleccionado.');
            }
        });
    });
    
    async function marcarLlegada(idLote) {
        try {
            const response = await axios.get(`http://localhost/LogiQuick/Control/controladorLlevan.php?function=MarcarLlegada&idLote=${idLote}`);
            console.log(response.data);
        } catch (error) {
            console.error('Error al marcar la salida:', error);
        }
    }

    
});


