document.addEventListener("DOMContentLoaded", function () {
    var contadorCampos = 1; // Contador para asignar nombres únicos a los campos

    document.getElementById("agregarCampo").addEventListener("click", function () {
        var nuevoDiv = document.createElement("div");
        nuevoDiv.className = "form__group";

        var nuevoLabel = document.createElement("label");
        nuevoLabel.className = "form__label";
        nuevoLabel.textContent = "Paquete " + contadorCampos + ":";

        var nuevoInput = document.createElement("input");
        nuevoInput.className = "form__input";
        nuevoInput.type = "text";
        nuevoInput.name = "paquete" + contadorCampos; // Asigna un nombre único al campo
        nuevoInput.value = ""; // Establece un valor predeterminado

        // Incrementar el contador para asignar un nombre único al siguiente campo
        contadorCampos++;

        nuevoDiv.appendChild(nuevoLabel);
        nuevoDiv.appendChild(nuevoInput);

        var paquetesContainer = document.getElementById("contenedor-campos");
        paquetesContainer.appendChild(nuevoDiv);
    });
});
