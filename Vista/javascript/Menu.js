// Obtén referencias a los elementos del DOM
const navMenu = document.querySelector('.nav__links--menu');
const navMenuButton = document.querySelector('.nav__img');
const navCloseButton = document.querySelector('.nav__close');

// Función para mostrar el menú
function mostrarMenu() {
    navMenu.classList.add('nav__links--show');
    document.documentElement.style.overflowY = 'hidden'; // Evita el desplazamiento de la página cuando el menú está abierto
}

// Función para cerrar el menú
function cerrarMenu() {
    navMenu.classList.remove('nav__links--show');
    document.documentElement.style.overflowY = 'auto'; // Restaura el desplazamiento de la página cuando el menú está cerrado
}

// Evento de clic para abrir el menú
navMenuButton.addEventListener('click', mostrarMenu);

// Evento de clic para cerrar el menú
navCloseButton.addEventListener('click', cerrarMenu);
