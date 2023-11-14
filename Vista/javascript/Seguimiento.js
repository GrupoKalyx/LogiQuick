document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('http://localhost/Logiquick/Control/controladorPaquetes.php?function=listar', {
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
            

           
            celdaId.textContent = paquete.numBulto;
            celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;

            fila.setAttribute('data-id', paquete.numBulto);

            
            fila.addEventListener('click', async function () {
                eliminarMapa();
                const idRastreo = paquete.idRastreo
                console.log(idRastreo);

                try {
                    
                    const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`, {
                        headers: {
                            'Cache-Control': 'no-cache'
                        }
                    });
                    const almacen = await response.json();
                    console.log(almacen)

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