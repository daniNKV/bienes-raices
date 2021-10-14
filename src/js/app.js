document.addEventListener('DOMContentLoaded', function() {

    eventListeners();

    darkMode();
})


function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
    const navbar = document.querySelector('.navbar')
    console.log('click')
    if(navbar.classList.contains('mostrar')) {
        navbar.classList.remove('mostrar')
    }else {
        navbar.classList.add('mostrar')
    }
}

function darkMode() {
    const botonDarkMode = document.querySelector('.dark-mode-boton')
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)')

    if(prefiereDarkMode.matches) {
        document.body.classList.toggle('dark-mode')
    }

    prefiereDarkMode.addEventListener('change', () => {
        document.body.classList.toggle('dark-mode')
    } )
    botonDarkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode')
    })
}

//# sourceMappingURL=bundle.min.js.map


