document.addEventListener('DOMContentLoaded', async function () {
    let numBultoSeleccionado = null;

    try {
        const response = await fetch(`http://localhost/logiquick/Control/controladorPaquetes.php?function=PaqueteAsignadoDelivery&ci=${ci}}`, {
            headers: {
                'Cache-Control': 'no-cache'
            }
        });
        const paquetes = await response.text();
        const jsonString = paquetes.match(/\[.*\]/);

        if (jsonString) {
            const paquetesArray = JSON.parse(jsonString[0]);

            const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

            paquetesArray.forEach(async paquete => {

               
                if (paquete.fecha_llegada !== null || paquete.fecha_llegada === null) {
                    const fila = tabla.insertRow();
                    const celdaId = fila.insertCell();
                    const celdaDireccion = fila.insertCell();

                    celdaId.textContent = paquete.numBulto;
                    celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;

                    fila.setAttribute('data-id', paquete.numBulto);

                    fila.addEventListener('click', async function () {
                        eliminarMapa();
                        const idRastreo = paquete.idRastreo;
                        console.log(idRastreo);

                    
                        const numBultoClicado = await obtenerNumBultoDesdeFila(this);

                        if (numBultoClicado !== null) {
                            console.log('numBulto clicado:', numBultoClicado);
                            numBultoSeleccionado = numBultoClicado;

                            
                            try {

                                const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`, {
                                    headers: {
                                        'Cache-Control': 'no-cache'
                                    }
                                });
                                const almacen = await response.json();
                                console.log(almacen);

                                if (almacen && almacen.lat && almacen.lng) {

                                    marcarRutaEnMapa(paquete.lat, paquete.lng, almacen.lat, almacen.lng);
                                } else {
                                    console.error('Datos de latitud y longitud inválidos para el almacén o el paquete.');
                                }
                            } catch (error) {
                                console.error('Error al obtener datos del almacén:', error);
                            }
                        } else {
                            console.error('No se pudo obtener el numBulto desde la fila.');
                        }
                    });
                }
            });
        }
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

        const destinoMarker = L.marker([latitudDestino, longitudDestino], { name: 'Destino' }).addTo(map); // Marcador del destino con nombre
        const almacenMarker = L.marker([latitudAlmacen, longitudAlmacen], { name: 'Almacén' }).addTo(map); // Marcador del almacén con nombre

        destinoMarker.bindTooltip('Destino', { permanent: true, direction: 'top' });
        almacenMarker.bindTooltip('Almacén', { permanent: true, direction: 'top' });

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

    async function obtenerNumBultoDesdeFila(fila) {
        const numBultoCell = fila.querySelector('td:first-child');
        if (numBultoCell) {
            return numBultoCell.innerText.trim();
        } else {
            console.error('No se ha encontrado la celda de numBulto en la fila.');
            return null;
        }
    }

    const buttonsSalida = document.querySelectorAll('.empezar-viaje-btn');

    buttonsSalida.forEach(button => {
        button.addEventListener('click', async function () {
            if (numBultoSeleccionado !== null) {
                console.log('Empezar Viaje para numBulto:', numBultoSeleccionado);

                try {
                    await marcarSalida(numBultoSeleccionado);
                } catch (error) {
                    console.error('Error al realizar la solicitud:', error);
                }
            } else {
                console.error('No hay un numBulto seleccionado.');
            }
        });
    });

    async function marcarSalida(numBulto) {
        try {
            const response = await axios.get(`http://localhost/LogiQuick/Control/controladorEntregan.php?function=MarcarSalida&numBulto=${numBulto}`);
            console.log(response.data);
        } catch (error) {
            console.error('Error al marcar la salida:', error);
        }
    }

    const buttonsLlegada = document.querySelectorAll('.finalizar-viaje-btn');

    buttonsLlegada.forEach(button => {
        button.addEventListener('click', async function () {
            if (numBultoSeleccionado !== null) {
                console.log('Finalizar Viaje para numBulto:', numBultoSeleccionado);

                try {
                    await marcarLlegada(numBultoSeleccionado);
                } catch (error) {
                    console.error('Error al realizar la solicitud:', error);
                }
            } else {
                console.error('No hay un numBulto seleccionado.');
            }
        });
    });

    async function marcarLlegada(numBulto) {
        try {
            const response = await axios.get(`http://localhost/LogiQuick/Control/controladorEntregan.php?function=MarcarLlegada&numBulto=${numBulto}`);
            console.log(response.data);
        } catch (error) {
            console.error('Error al marcar la llegada:', error);
        }
    }
});
