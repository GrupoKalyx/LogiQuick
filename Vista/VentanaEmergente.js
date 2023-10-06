

// Agregar un evento submit al formulario
document.getElementById('tracking__form').addEventListener('submit', function(event) {
    // Evitar que el formulario se envíe normalmente
    event.preventDefault();

    document.getElementById('ventanaEmergente').style.display = 'block';

    document.querySelector('.ventana__cerrar').addEventListener('click', function() {
        document.getElementById('ventanaEmergente').style.display = 'none';
    });


    // Hacer una solicitud AJAX para obtener el resultado de la función verificar en controladorPaquetes
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/logiquick/Control/controladorPaquetes.php?function=existe&tipoId=', true);

    // Hacer una solicitud AJAX para obtener el resultado de la función rastrear en controladorPaquetes
    var xhr2 = new XMLHttpRequest();
    xhr2.open('GET', 'http://localhost/logiquick/Control/controladorPaquetes.php?function=rastrear', true);
    xhr2.onreadystatechange = function () {
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            // Parsear el JSON recibido
            var resultado = xhr2.responseText;

            // Mostrar el resultado en el modal
            var resultadoDiv = document.getElementById('resultado');
            resultadoDiv.textContent = "Estado del paquete: " + resultado; 
        }
    };
    xhr.send();
});


