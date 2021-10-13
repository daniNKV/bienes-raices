document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
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


//# sourceMappingURL=bundle.min.js.map