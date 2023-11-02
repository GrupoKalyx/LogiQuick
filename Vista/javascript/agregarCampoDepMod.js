function DepartamentoCampoMod() {
        var selectHtml = document.getElementById("departMod").outerHTML;
    
        var nuevoCampo = document.createElement("div");
        nuevoCampo.className = "departamento__field"; // Agrega una clase
        nuevoCampo.innerHTML = selectHtml;
    
        document.getElementById("departamentosContainer2").appendChild(nuevoCampo.firstChild);
    }
    