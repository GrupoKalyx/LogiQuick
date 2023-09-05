
const traductorBtn = document.getElementById('traductor-btn');


traductorBtn.addEventListener('click', () => {
    // Obtén el nombre del archivo actual (por ejemplo, "index.php")
    const currentFileName = window.location.pathname.split('/').pop();

    // Verifica el nombre del archivo actual usando el if
    if (currentFileName === 'login.php') {
        window.location.href = '/indexEng/LoginEng.php';
    } else if (currentFileName === 'FunExternoCentral.php') {
        window.location.href = '/indexEng/FunExternoCentralEng.php';
    } else if (currentFileName === 'FuncionarioCentral.php') {
        window.location.href = '/indexEng/FuncionarioCentralEng.php';
    } else if (currentFileName === 'Camionero.php') {
        window.location.href = '/indexEng/CamioneroEng.php';
    } else if (currentFileName === '/Referencias/LoteACamion.php') {
        window.location.href = '/indexEng/LoteACamionEng.php';
    } else if (currentFileName === '/Referencias/IngresarPaquete.php') {
        window.location.href = '/indexEng/IngresarPaqueteEng.php';
    } else if (currentFileName === '/Referencias/CamioneroACamion.php') {
        window.location.href = '/indexEng/CamioneroACamionEng.php';
    } else if (currentFileName === '/Referencias/AsignacionDeLotes.php') {
        window.location.href = '/indexEng/AsignacionDeLotesEng.php';
    } else {
        window.location.href = 'login.php'; // Redirección predeterminada en caso de no coincidir con ninguna opción
    }
});
