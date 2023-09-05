
const traductorBtn = document.getElementById('traductor-btn');


traductorBtn.addEventListener('click', () => {
    // Obtén el nombre del archivo actual (por ejemplo, "index.php")
    const currentFileName = window.location.pathname.split('/').pop();

    // Verifica el nombre del archivo actual usando el if
    if (currentFileName === 'loginAdmin.php') {
        window.location.href = 'Eng/LoginAdminEng.php';
    } else if (currentFileName === 'loginAdminEng.php') {
        window.location.href = '../loginAdmin.php';
    } else if (currentFileName === 'indexAdmin.php') {
        window.location.href = 'Eng/indexAdminEng.php';
    } else if (currentFileName === 'indexAdminEng.php') {
        window.location.href = '../indexAdmin.php';
    }
});