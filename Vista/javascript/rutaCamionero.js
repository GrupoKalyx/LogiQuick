document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('http://localhost/logiquick/Control/controladorLotes.php?function=listar', {
            headers: {
                'Cache-Control': 'no-cache'
            }
        });
        const lotes = await response.json();
        const tabla = document.getElementById('lotesTable').getElementsByTagName('tbody')[0];

        lotes.forEach(async lote => {

            const fila = tabla.insertRow();
            const celdaIdLote = fila.insertCell();
            const celdaDireccion = fila.insertCell();

            celdaIdLote.textContent = lote.idLote;
            celdaDireccion.textContent = lote.direccion;

            fila.setAttribute('data-idLote', lote.idLote);

            fila.addEventListener('click', async function () {
                eliminarMapa();
                const idLote = this.getAttribute('data-idLote');
                console.log(idLote);

                try {
                    const response = await fetch(`http://localhost/LogiQuick/Control/controladorLotes.php?function=mostrarAsociado&idLote=${idLote}`, {
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
});

         
