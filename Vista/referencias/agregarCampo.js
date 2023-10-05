document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("agregarCampo").addEventListener("click", function() {
        // Crea un nuevo div para el nuevo campo de selección y label
        var nuevoDiv = document.createElement("div");
        nuevoDiv.className = "form__group";

        // Crea un nuevo label
        var nuevoLabel = document.createElement("label");
        nuevoLabel.className = "form__label";
        nuevoLabel.textContent = "Paquete:";

        // Crea un nuevo select
        var nuevoSelect = document.createElement("select");
        nuevoSelect.className = "form__select";
        nuevoSelect.name = "bulto[]";

        // crea una opción vacia
        var opcionDefault = document.createElement("option");
        opcionDefault.value = "";
        opcionDefault.textContent = "Seleccionar paquete";
        nuevoSelect.appendChild(opcionDefault);

        // ajax
        fetch("http://localhost/logiquick/Control/controladorPaquetes.php?function=listarSinLote")
            .then(response => response.json()) // Parsear la respuesta como JSON
            .then(paquetes => {
                // Agregar las opciones al select
                paquetes.forEach(function(paquete) {
                    var nuevaOpcion = document.createElement("option");
                    nuevaOpcion.value = paquete.numBulto;
                    nuevaOpcion.textContent = paquete.numBulto;
                    nuevoSelect.appendChild(nuevaOpcion);
                });
            })
            .catch(error => {
                console.error("Error:", error);
            });

        // Agrega el nuevo label y select
        nuevoDiv.appendChild(nuevoLabel);
        nuevoDiv.appendChild(nuevoSelect);

        // agrega el nuevo div al final
        var paquetesContainer = document.getElementById("paquetesContainer");
        paquetesContainer.appendChild(nuevoDiv);
    });
});
