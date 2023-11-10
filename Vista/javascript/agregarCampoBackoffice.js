function agregarCampo(event) {
    event.preventDefault();


    var contenedor = document.getElementById("contenedor-campos");


    var numCampos = contenedor.querySelectorAll('.form__input').length;


    var nuevoCampo = document.createElement("input");
    nuevoCampo.className = "form__input";
    nuevoCampo.type = "text";


    nuevoCampo.id = "paquete[]";
    nuevoCampo.name = "paquete[]";


    var textoPaquete = document.createTextNode("Paquete " + (numCampos + 1));
    var saltoLinea = document.createElement("br");

    // Agregar elementos al contenedor
    contenedor.appendChild(textoPaquete);
    contenedor.appendChild(saltoLinea);
    contenedor.appendChild(nuevoCampo);
    contenedor.appendChild(saltoLinea.cloneNode());
}