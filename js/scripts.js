var msgEnvoi = document.getElementById("msgTxtEnvoi");
var commentaireEvent = document.getElementById("commentaire");

var profil = document.getElementById("profil");
profil.style.display = "none";
function afficherProfil(){
    if(profil.style.display = "none"){
        profil.style.display = "block";
    } else {
        profil.style.display = "none";
    }
}


commentaireEvent.style.display = "none";
function montrercommentaire(){
    
}

document.getElementById('annees').onclick = function() {
    document.getElementById("pets").selectedIndex = 3;
}

msgEnvoi.style.display = "none";
function boutonEnvoi(){
    msgEnvoi.style.display = "block";
}

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            offset: 74,
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});
