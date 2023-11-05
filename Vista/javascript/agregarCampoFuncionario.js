document.addEventListener("DOMContentLoaded", function() {
        var agregarCampoBtn = document.getElementById("agregarCampoFuncionario");
        var contenedorCampos = document.getElementById("contenedor-campos");
      
        function agregarCampo() {
          var nuevoCampo = document.createElement("select");
          nuevoCampo.className = "form__select";
          nuevoCampo.name = "bulto[]";
      
          var opcionPredeterminada = document.createElement("option");
          opcionPredeterminada.value = "";
          opcionPredeterminada.text = "Seleccionar paquete";
          nuevoCampo.appendChild(opcionPredeterminada);
      

          var espacio = document.createElement("div");
          espacio.style.marginBottom = "20px"; 
          contenedorCampos.appendChild(espacio);
          contenedorCampos.appendChild(nuevoCampo);
        
          
          var xhr = new XMLHttpRequest();
          xhr.open("GET", "../../../Control/controladorPaquetes.php?function=listarSinLote", true);
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
              var paquetes = JSON.parse(xhr.responseText);
      
             
              paquetes.forEach(function(paquete) {
                var opcion = document.createElement("option");
                opcion.value = paquete.numBulto;
                opcion.text = paquete.numBulto;
                nuevoCampo.appendChild(opcion);
              });
            }
          };
          xhr.send();
      
          contenedorCampos.appendChild(nuevoCampo);
        }
      
        agregarCampoBtn.addEventListener("click", function() {
          agregarCampo();
        });
      });

      
      