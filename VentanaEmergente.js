

// Agregar un evento submit al formulario
document.getElementById('tracking__form').addEventListener('submit', function(event) {
    // Evitar que el formulario se envíe normalmente
    event.preventDefault();

    document.getElementById('ventanaEmergente').style.display = 'block';

    document.querySelector('.ventana__cerrar').addEventListener('click', function() {
        document.getElementById('ventanaEmergente').style.display = 'none';
    });


    // Hacer una solicitud AJAX para obtener el resultado de la función rastrear en controladorPaquetes
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/logiquick/Control/controladorPaquetes.php?function=rastrear', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parsear el JSON recibido
            var resultado = xhr.responseText;

            // Mostrar el resultado en el modal
            var resultadoDiv = document.getElementById('resultado');
            resultadoDiv.textContent = "Estado del paquete: " + resultado; 
        }
    };
    xhr.send();
});


