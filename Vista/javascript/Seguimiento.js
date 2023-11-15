document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('http://localhost/kalyx/Control/controladorPaquetes.php?function=PaquetesSinEntregar', {
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

                const fila = tabla.insertRow();
                const celdaId = fila.insertCell();
                const celdaDireccion = fila.insertCell();

                celdaId.textContent = paquete.numBulto;
                celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;

                fila.setAttribute('data-id', paquete.numBulto);

                fila.addEventListener('click', function () {
                    eliminarMapa();
                    marcarPuntoEnMapa(paquete.lat, paquete.lng);
                });
            });
        } // Cierra el bloque if
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

    function marcarPuntoEnMapa(latitud, longitud) {
        map = L.map('map').setView([latitud, longitud], 13);

        const destinoMarker = L.marker([latitud, longitud], { name: 'Destino' }).addTo(map); // Marcador del destino con nombre
        destinoMarker.bindTooltip('Destino', { permanent: true, direction: 'top' });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([latitud, longitud]).addTo(map);
    }
});
