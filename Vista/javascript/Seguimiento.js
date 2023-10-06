// document.addEventListener('DOMContentLoaded', async function () {
//         try {
//                 // Realizar una solicitud AJAX para obtener datos de paquetes desde el servidor
//                 const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=listar');
//                 const resultado = await response.json();

              
//                 const tabla = document.getElementById('paquetesTable').getElementsByTagName('tbody')[0];

                
//                 resultado.forEach(paquete => {
                       
//                         const fila = tabla.insertRow();

                       
//                         const celdaId = fila.insertCell();
//                         const celdaDireccion = fila.insertCell();

                       
//                         celdaId.textContent = paquete.id;
//                         celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;

                       
//                         celdaDireccion.addEventListener('click', function () {
                               
//                                 marcarRutaEnMapa(paquete.num, paquete.calle, paquete.departamento);
//                         });
//                 });
//         } catch (error) {
//                 console.error('Error en la solicitud:', error);
//         }
// });


// async function marcarRutaEnMapa(num, calle, departamento) {
       
//         const direccionCompleta = num + ' ' + calle + ', ' + departamento + ', Uruguay';

//         // Limpiar el mapa antes de agregar una nueva ruta
        

        
//         const apiKey = '3111bb8dce164ee18ff3bfcf4a4bfc24'; 
//         const apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(direccionCompleta)}&key=${apiKey}`;

//         try {
//                 const geocodingResponse = await fetch(apiUrl);
//                 const geocodingData = await geocodingResponse.json();

//                 if (geocodingData.results && geocodingData.results.length > 0) {
                        
//                         const location = geocodingData.results[0].geometry;
//                         const latitudDestino = location.lat;
//                         const longitudDestino = location.lng;
                        

                       
//                         const latitudPlazaIndependencia = -34.903555;
//                         const longitudPlazaIndependencia = -56.188554;

                  
//                         const map = L.map('map').setView([latitudDestino, longitudDestino], 13);

//                         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                         attribution: '© OpenStreetMap contributors'
//                         }).addTo(map);
                       
//                         const destinoMarker = L.marker([latitudDestino, longitudDestino]).addTo(map);
//                         const plazaIndependenciaMarker = L.marker([latitudPlazaIndependencia, longitudPlazaIndependencia]).addTo(map);

//                         // Limpiar el mapa antes de agregar una nueva ruta
  


//                         L.Routing.control({
//                                 waypoints: [
//                                         L.latLng(latitudPlazaIndependencia, longitudPlazaIndependencia),
//                                         L.latLng(latitudDestino, longitudDestino)
//                                 ],
//                                 routeWhileDragging: true,
//                                 show: true,
//                                 language: 'es'
//                         }).addTo(map);
//                 } else {
//                         console.error('No se encontraron coordenadas para la dirección proporcionada.');
//                 }
//         } catch (error) {
//                 console.error('Error en la solicitud de geocodificación:', error);
//         }
// }



document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=listar');
        const paquetes = await response.json();
        const tabla = document.getElementById('paquetesTable').getElementsByTagName('tbody')[0];

        paquetes.forEach(paquete => {
            const fila = tabla.insertRow();
            const celdaId = fila.insertCell();
            const celdaDireccion = fila.insertCell();

            // Insertar la ID del paquete en la celda correspondiente
            celdaId.textContent = paquete.numBulto;

            // Insertar la dirección del paquete en la celda correspondiente
            celdaDireccion.textContent = paquete.num + ' ' + paquete.calle + ', ' + paquete.departamento;

            // Asignar un atributo de datos con la ID del paquete para referencia futura si es necesario
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

            // Crear el mapa y mostrar la ruta hasta la dirección del paquete
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

    

