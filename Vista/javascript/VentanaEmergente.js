document.getElementById('tracking__form').addEventListener('submit', async function (event) {
    event.preventDefault();

    var mapDiv = document.createElement('div');
    mapDiv.id = 'map';
    var generadorDiv = document.querySelector('#map__generador');
    generadorDiv.appendChild(mapDiv);

    document.getElementById('ventanaEmergente').style.display = 'block';

    document.querySelector('.ventana__cerrar').addEventListener('click', function () {
        document.getElementById('ventanaEmergente').style.display = 'none';
        document.getElementById('map').style.display = 'none';
    });

    async function obtenerDatosPaquete(idRastreo) {
        const response = await fetch(`http://localhost/LogiQuick/Control/controladorPaquetes.php?function=rastrear&idRastreo=${idRastreo}`);
        return response.json();
    }
    
    async function obtenerEstadoPaquete(idRastreo) {
        const response =  await fetch(`http://localhost/LogiQuick/Control/controladorPaquetes.php?function=mostrarEstado&tipoId=idRastreo&idRastreo=${idRastreo}`);
        return response.json();
    }
    async function obtenerDatosAlmacen(idRastreo) {
        const response = await fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`);
        return response.json();
    }

    var idRastreo = document.getElementById('idRastreo').value;

    try {
        const resultado = await obtenerDatosPaquete(idRastreo);
        const resultado2 = await obtenerEstadoPaquete(idRastreo);
        const resultado3 = await obtenerDatosAlmacen(idRastreo);
        console.log(resultado3)

        var resultadoDiv = document.getElementById('resultado');
        var resultado2Div = document.getElementById('resultado2');

        if (!resultado) {
            resultadoDiv.textContent = "El paquete no existe o no está registrado aún.";
        } else {
            var direccion = resultado.num + ' ' + resultado.calle + ', ' + resultado.departamento + ', Uruguay';
            var direccionAlmacen = resultado3.num + ' ' + resultado3.calle + ', ' + resultado3.departamento + ', Uruguay';

            resultadoDiv.textContent = "Dirección de entrega: " + direccion;
            resultado2Div.textContent = "Estado del Paquete: " + resultado2;

            var latitudDestino = resultado.lat; // Usar el valor de latitud desde la tabla de paquetes
            var longitudDestino = resultado.lng; // Usar el valor de longitud desde la tabla de paquetes

            var latitudOrigen = resultado3.lat; // Usar el valor de latitud desde la tabla de almacenes
            var longitudOrigen = resultado3.lng; // Usar el valor de longitud desde la tabla de almacenes

            var map = L.map('map').setView([latitudDestino, longitudDestino], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([latitudDestino, longitudDestino]).addTo(map);

            L.Routing.control({
                waypoints: [
                    L.latLng(latitudOrigen, longitudOrigen), // Coordenadas del almacén como punto de origen
                    L.latLng(latitudDestino, longitudDestino)
                ],
                routeWhileDragging: true,
                show: false,
                language: "es"
            }).addTo(map);
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
});

function obtenerDatosPaquete(idRastreo) {
    const response = fetch(`http://localhost/LogiQuick/Control/controladorPaquetes.php?function=rastrear&idRastreo=${idRastreo}`);
    return response.json();
}

function obtenerEstadoPaquete(idRastreo) {
    const response =  fetch(`http://localhost/LogiQuick/Control/controladorPaquetes.php?function=mostrarEstado&tipoId=idRastreo&idRastreo=${idRastreo}`);
    return response.json();
}
function obtenerDatosAlmacen(idRastreo) {
    const response = fetch(`http://localhost/LogiQuick/Control/controladorAlmacenes.php?function=mostrarUltimo&idRastreo=${idRastreo}`);
    return response.json();
}
