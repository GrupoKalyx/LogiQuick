function agregarDepartamentoCampo() {
    var selectHtml = document.getElementById("depart").outerHTML;
    
    var nuevoCampo = document.createElement("div");
    nuevoCampo.className = "departamento__field"; // Agrega una clase
    nuevoCampo.innerHTML = selectHtml;

    document.getElementById("departamentosContainer").appendChild(nuevoCampo.firstChild);
}
