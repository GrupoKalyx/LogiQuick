document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('http://localhost/LogiQuick/Control/controladorVan.php?function=listar', {
            headers: {
                'Cache-Control': 'no-cache'
            }
        });
        
        const lotes = await response.json();
        const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];

        lotes.forEach(async lote => {

            const fila = tabla.insertRow();
            const celdaIdLote = fila.insertCell();
            const celdaDireccion = fila.insertCell();
            const celdaDireccionAlmacen = fila.insertCell();

            celdaIdLote.textContent = lote.idLote;
            celdaDireccion.textContent = lote.idAlmacen

            fila.setAttribute('data-idLote', lote.idLote);

            fila.addEventListener('click', async function () {
                eliminarMapa();
                const idLote = this.getAttribute('data-idLote');
                console.log(idLote);

                try {
                    const response = await fetch(`http://localhost/LogiQuick/Control/controladorVan.php?function=mostrarAlmacenDeLote&idLote=${idLote}`, {
                        headers: {
                            'Cache-Control': 'no-cache'
                        }
                    });
                    const almacen = await response.json();
                    celdaDireccionAlmacen.textContent = almacen.num + ' ' + almacen.calle + ', ' + almacen.localidad;
                    console.log(almacen);

                    if (almacen && almacen.lat && almacen.lng) {
                        marcarRutaEnMapa(almacen.lat, almacen.lng);
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

    function marcarRutaEnMapa(latitudAlmacen, longitudAlmacen) {

        const almacenCentralLat = "-34.9035086";
        const almacenCentralLng = "-56.1947728"


        map = L.map('map').setView([almacenCentralLat, almacenCentralLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        const destinoMarker = L.marker([latitudAlmacen, longitudAlmacen]).addTo(map);

      

        L.Routing.control({
            waypoints: [
                L.latLng(almacenCentralLat, almacenCentralLng),
                L.latLng(latitudAlmacen, longitudAlmacen)
            ],
            routeWhileDragging: true,
            show: true,
            language: 'es'
        }).addTo(map);
    }
});

         
