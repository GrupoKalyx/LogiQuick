document.getElementById('tracking__form').addEventListener('submit', function (event) {
    event.preventDefault();

    document.getElementById('ventanaEmergente').style.display = 'block';

    document.querySelector('.ventana__cerrar').addEventListener('click', function () {
        document.getElementById('ventanaEmergente').style.display = 'none';
    });

    var idRastreo = document.getElementById('idRastreo').value;

    // Hacer una solicitud AJAX usando fetch
    fetch('http://localhost/logiquick/Control/controladorPaquetes.php?function=rastrear&idRastreo=' + idRastreo)
        .then(function(response) {
            return response.json(); // Parsea la respuesta JSON
        })
        .then(function(resultado) {
            var resultadoDiv = document.getElementById('resultado');
            if (resultado == undefined || resultado == null) {
                resultadoDiv.textContent = "El paquete no existe o no está registrado aún.";
            } else {
                resultadoDiv.textContent = "Dirección de entrega: " + resultado.calle + " " + resultado.num + ", en " + resultado.localidad + ", " + resultado.departamento;
            }
        })
        .catch(function(error) {
            console.error('Error en la solicitud:', error);
        });
});


