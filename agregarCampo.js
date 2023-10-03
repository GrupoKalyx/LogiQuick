document.getElementById("agregarCampo").addEventListener("click", function() {
    // Crea un nuevo div para el nuevo campo de selección y label
    var nuevoDiv = document.createElement("div");
    nuevoDiv.className = "form__group";

    // Crea un nuevo label
    var nuevoLabel = document.createElement("label");
    nuevoLabel.className = "form__label";
    nuevoLabel.textContent = "Paquete:";

    // Crea un nuevo campo de selección
    var nuevoSelect = document.createElement("select");
    nuevoSelect.className = "form__select";
    nuevoSelect.name = "bulto[]";

    // Crea una opción por defecto
    var opcionDefault = document.createElement("option");
    opcionDefault.value = "";
    opcionDefault.textContent = "Seleccionar paquete";
    nuevoSelect.appendChild(opcionDefault);

    // Agrega el nuevo label y campo de selección al nuevo div
    nuevoDiv.appendChild(nuevoLabel);
    nuevoDiv.appendChild(nuevoSelect);

    // Obtiene el contenedor de paquetes y agrega el nuevo div al final
    var paquetesContainer = document.getElementsByClassName("form");
    paquetesContainer.appendChild(nuevoDiv);
});



