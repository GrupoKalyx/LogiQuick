
var map = L.map('map').setView([-32.8755548, -56.0201525], 7); // Latitud y Longitud de Uruguay

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
}).addTo(map);

var AlmacenOrigen = new L.LatLng(-34.85, -56.2);
var AlmacenDestino = new L.LatLng(-32.82, -56.027);

var marcadores = L.layerGroup([L.marker(AlmacenOrigen), L.marker(AlmacenDestino)]).addTo(map);

var ruta = L.Routing.control({
        waypoints: [
                AlmacenOrigen,
                AlmacenDestino
        ],
        routeWhileDragging: true,
        language: "es"
}).addTo(map);

map.fitBounds(marcadores.getBounds());
