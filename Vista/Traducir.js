
const traductorBtn = document.getElementById('traductor-btn');


traductorBtn.addEventListener('click', () => {
    // Obtén el nombre del archivo actual (por ejemplo, "index.html")
    const currentFileName = window.location.pathname.split('/').pop();

    // Verifica el nombre del archivo actual usando el if
    if (currentFileName === 'Login.html') {
        window.location.href = '/indexEng/LoginEng.html';
    } else if (currentFileName === 'FunExternoCentral.html') {
        window.location.href = '/indexEng/FunExternoCentralEng.html';
    } else if (currentFileName === 'FuncionarioCentral.html') {
        window.location.href = '/indexEng/FuncionarioCentralEng.html';
    } else if (currentFileName === 'Camionero.html') {
        window.location.href = '/indexEng/CamioneroEng.html';
    } else if (currentFileName === '/Referencias/LoteACamion.html') {
        window.location.href = '/indexEng/LoteACamionEng.html';
    } else if (currentFileName === '/Referencias/IngresarPaquete.html') {
        window.location.href = '/indexEng/IngresarPaqueteEng.html';
    } else if (currentFileName === '/Referencias/indexadmin.php') {
        window.location.href = '/indexEng/IndexAdminEng.html';
    } else if (currentFileName === '/Referencias/CamioneroACamion.html') {
        window.location.href = '/indexEng/CamioneroACamionEng.html';
    } else if (currentFileName === '/Referencias/AsignacionDeLotes.html') {
        window.location.href = '/indexEng/AsignacionDeLotesEng.html';
    } else {
        window.location.href = 'index.html'; // Redirección predeterminada en caso de no coincidir con ninguna opción
    }
});