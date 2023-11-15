// script.js

document.addEventListener('DOMContentLoaded', function () {
        // Función para agregar un nuevo campo de paquete
        function agregarCampoPaquete() {
          var contenedor = document.getElementById('contenedor-campos');
      
          // Crear un nuevo elemento de selección
          var nuevoCampo = document.createElement('select');
          nuevoCampo.className = 'form__select';
          nuevoCampo.name = 'bulto[]';
          nuevoCampo.required = true;
          nuevoCampo.style.marginBottom = '20px'; // Añadir margen de 20px
      
          // Clonar las opciones del primer campo y agregarlas al nuevo campo
          var opcionesOriginales = document.getElementById('bulto').options;
          for (var i = 0; i < opcionesOriginales.length; i++) {
            var opcionClone = opcionesOriginales[i].cloneNode(true);
            nuevoCampo.appendChild(opcionClone);
          }
      
          // Agregar el nuevo campo al contenedor
          contenedor.appendChild(nuevoCampo);
        }
      
        // Agregar un event listener al botón para detectar clics
        var agregarCampoBtn = document.getElementById('agregarCampoPaquete');
        agregarCampoBtn.addEventListener('click', agregarCampoPaquete);
      });
      