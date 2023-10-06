document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=listar');
        const paquetes = await response.json();
        const tabla = document.getElementById('paquetesTable').getElementsByTagName('tbody')[0];

        paquetes.forEach(paquete => {
            const fila = tabla.insertRow();
            const celdaId = fila.insertCell();
            const celdaDireccion = fila.insertCell();

            celdaId.textContent = paquete.numBulto;

            celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;


            fila.setAttribute('data-id', paquete.id);

            fila.addEventListener('click', function () {
                eliminarMapa();
                marcarRutaEnMapa(paquete.num, paquete.calle, paquete.departamento);
            });
        });
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
});


let map = null;

async function eliminarMapa() {
    if (map) {
        map.remove();
        map = null;
    }
}

async function marcarRutaEnMapa(num, calle, departamento) {
    const direccionCompleta = num + ' ' + calle + ', ' + departamento + ', Uruguay';
    const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24';
    const apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(direccionCompleta)}&key=${apiKey}`;

    try {
        const geocodingResponse = await fetch(apiUrl);
        const geocodingData = await geocodingResponse.json();

        if (geocodingData.results && geocodingData.results.length > 0) {
            const location = geocodingData.results[0].geometry;
            const latitudDestino = location.lat;
            const longitudDestino = location.lng;

            map = L.map('map').setView([latitudDestino, longitudDestino], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);
            const latitudPlazaIndependencia = -34.903555;
            const longitudPlazaIndependencia = -56.188554;

            L.Routing.control({
                waypoints: [
                    L.latLng(latitudPlazaIndependencia, longitudPlazaIndependencia),
                    L.latLng(latitudDestino, longitudDestino)
                ],
                routeWhileDragging: true,
                show: true,
                language: 'es'
            }).addTo(map);
        } else {
            console.error('No se encontraron coordenadas para la dirección proporcionada.');
        }
    } catch (error) {
        console.error('Error en la solicitud de geocodificación:', error);
    }
}