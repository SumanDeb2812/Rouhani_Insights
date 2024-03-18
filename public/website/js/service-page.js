let logo_div_service = document.getElementById('logo-div-service');
let nav_home_btn = document.getElementById('nav-home-btn');

function openNavSer() {
    setTimeout(() => {
        logo_div_service.style.left = "0";
    }, 500);
}

window.addEventListener('load', () => {
    setTimeout(() => {
        nav_home_btn.style.opacity = "1";
    }, 500);
});

window.addEventListener('load', () => {
    if(window.pageYOffset < 100){
        openNavSer();
    }
});

window.addEventListener('scroll', () => {
    if (window.pageYOffset > 100) {
        logo_div_service.style.left = "-300px";
    } else {
        logo_div_service.style.left = "0";
    }
});