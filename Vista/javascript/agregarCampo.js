document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("agregarCampo").addEventListener("click", function () {

        var nuevoDiv = document.createElement("div");
        nuevoDiv.className = "form__group";


        var nuevoLabel = document.createElement("label");
        nuevoLabel.className = "form__label";
        nuevoLabel.textContent = "Paquete:";


        var nuevoSelect = document.createElement("select");
        nuevoSelect.className = "form__select";
        nuevoSelect.name = "bulto[]";


        var opcionDefault = document.createElement("option");
        opcionDefault.value = "";
        opcionDefault.textContent = "Seleccionar paquete";
        nuevoSelect.appendChild(opcionDefault);

        // ajax
        fetch("http://localhost/logiquick/Control/controladorPaquetes.php?function=listarSinLote")
            .then(response => response.json()) // Parsea la respuesta  JSON
            .then(paquetes => {

                paquetes.forEach(function (paquete) {
                    var nuevaOpcion = document.createElement("option");
                    nuevaOpcion.value = paquete.numBulto;
                    nuevaOpcion.textContent = paquete.numBulto;
                    nuevoSelect.appendChild(nuevaOpcion);
                });
            })
            .catch(error => {
                console.error("Error:", error);
            });


        nuevoDiv.appendChild(nuevoLabel);
        nuevoDiv.appendChild(nuevoSelect);


        var paquetesContainer = document.getElementById("paquetesContainer");
        paquetesContainer.appendChild(nuevoDiv);
    });
});