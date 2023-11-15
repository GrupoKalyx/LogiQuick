// script.js

document.addEventListener('DOMContentLoaded', function () {
  // Función para agregar un nuevo campo de lote
  function agregarCampoLote() {
    var contenedor = document.getElementById('contenedor-campos');

    // Crear un nuevo elemento de selección para el lote
    var nuevoCampoLote = document.createElement('select');
    nuevoCampoLote.className = 'form__select';
    nuevoCampoLote.name = 'idLote[]';
    nuevoCampoLote.required = true;
    nuevoCampoLote.style.marginBottom = '20px'; // Añadir margen de 20px

    // Clonar las opciones del primer campo de lote y agregarlas al nuevo campo
    var opcionesOriginales = document.getElementById('idLote').options;
    for (var i = 0; i < opcionesOriginales.length; i++) {
      var opcionClone = opcionesOriginales[i].cloneNode(true);
      nuevoCampoLote.appendChild(opcionClone);
    }

    // Agregar el nuevo campo de lote al contenedor
    contenedor.appendChild(nuevoCampoLote);
  }

  // Agregar un event listener al botón para detectar clics
  var agregarCampoBtn = document.getElementById('agregarCampoFuncionarioCentral');
  agregarCampoBtn.addEventListener('click', agregarCampoLote);
});
