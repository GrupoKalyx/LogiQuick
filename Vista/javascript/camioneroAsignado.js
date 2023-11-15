async function obtenerDatos() {
        try {
            const response = await fetch('http://localhost/kalyx/Control/controladorConducen.php?function=listar', {
                headers: {
                    'Cache-Control': 'no-cache'
                }
            });
            const camioneros = await response.json();
            const tabla = document.getElementById('Table').getElementsByTagName('tbody')[0];
    
            camioneros.forEach(async camion => {
                const fila = tabla.insertRow();
                const celdaCi = fila.insertCell();
                const celdaCamion = fila.insertCell();
    
                celdaCi.textContent = camion.ci;
                celdaCamion.textContent = camion.matricula;
            });
        } catch (error) {
            console.error('Error al obtener los datos:', error);
        }
    }
    
    obtenerDatos(); 
    