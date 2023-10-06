const traductorBtn = document.getElementById('traductor-btn');
traductorBtn.addEventListener('click', () => {
    // el nombre del archivo actual
    const currentFileName = window.location.pathname.split('/').pop();

    // Verifica el nombre del archivo  usando el if
    switch (currentFileName) {
        case 'login.php':
            window.location.href = 'indexEng/LoginEng.html';
            break;

        case 'FunExtCentral.php':
            window.location.href = 'indexEng/FunExtCentralEng.html';
        break;

        default:
            break;
    }
    
    
    if (currentFileName === 'FuncionarioCentral.html') {
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