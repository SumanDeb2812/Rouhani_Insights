document.addEventListener('DOMContentLoaded', function(){
//Seasonal ad show and hide
let welcome_message = document.getElementById('welcome_message');
let welcome_img = document.getElementById('welcome_img');
window.addEventListener('load', function () {
    welcome_message.style.display = "flex";
    welcome_img.style.animationName = "message-anim";
});

function closeAd() {
    welcome_message.style.display = "none";
}

setTimeout(() => {
    closeAd();
}, 7000);

// JS for collapsable navbar

let open_menu = document.getElementById('open_menu');
let close_menu = document.getElementById('close_menu');
let collapsable_nav = document.getElementById('collapsable_nav');

function openMenu() {
    collapsable_nav.style.right = '0';
}
function closeMenu() {
    collapsable_nav.style.right = '-100%';
}

//Scroll to top button

let scrollToTop = document.getElementById('scrollToTop');

window.addEventListener('scroll', function () {
    if (window.pageYOffset >= 200) {
        scrollToTop.style.display = "flex";
    } else {
        scrollToTop.style.display = "none";
    }
});

//Slider animation

let slider = document.querySelector('.header-slider');
let slide1 = slider.querySelector('.slide1');
let slideText1 = slider.querySelector('#slide-text1');
let slide2 = slider.querySelector('.slide2');
let slideText2 = slider.querySelector('#slide-text2');
let slide3 = slider.querySelector('.slide3');
let slideText3 = slider.querySelector('#slide-text3');
let prvBtn = slider.querySelector('#prv-btn');
let nxtBtn = slider.querySelector('#nxt-btn');

//first slider animation

function firstSlider() {
    slide1.classList.add('active-slide');
    textSlide1 = setTimeout(() => {
        slideText1.classList.add('slide-title');
    }, 1000);
    slide2.classList.remove('active-slide');
    slideText2.classList.remove('slide-title');
    slide3.classList.remove('active-slide');
    slideText3.classList.remove('slide-title');
    clearTimeout(textSlide2);
    clearTimeout(textSlide3);
}

//first slider already load when page loades

window.addEventListener('load', () => {
    firstSlider();
});

//second slider animation

function secondSlider() {
    slide2.classList.add('active-slide');
    textSlide2 = setTimeout(() => {
        slideText2.classList.add('slide-title');
    }, 1000);
    slide1.classList.remove('active-slide');
    slideText1.classList.remove('slide-title');
    slide3.classList.remove('active-slide');
    slideText3.classList.remove('slide-title');
    clearTimeout(textSlide1);
    clearTimeout(textSlide3);
}

//third slider animation

function thirdSlider() {
    slide3.classList.add('active-slide');
    textSlide3 = setTimeout(() => {
        slideText3.classList.add('slide-title');
    }, 1000);
    slide1.classList.remove('active-slide');
    slideText1.classList.remove('slide-title');
    slide2.classList.remove('active-slide');
    slideText2.classList.remove('slide-title');
    clearTimeout(textSlide2);
    clearTimeout(textSlide1);
}

// auto sliding

function startSliding() {
    startSlide2 = setInterval(() => {
        secondSlider();
    }, 5000);
    startSlide3 = setInterval(() => {
        thirdSlider();
    }, 10000);
    startSlide1 = setInterval(() => {
        firstSlider();
    }, 15000);
}
startSliding();

//auto sliding pause when mouse hover

function stopSliding() {
    clearInterval(startSlide2);
    clearInterval(startSlide3);
    clearInterval(startSlide1);
}
slider.addEventListener('mouseout', () => {
    startSliding();
});
slider.addEventListener('mouseover', () => {
    stopSliding();
});

//next btn for next slide

prvBtn.addEventListener('click', () => {
    if (slide1.classList.contains('active-slide')) {
        firstSlider();
    }
    else if (slide2.classList.contains('active-slide')) {
        firstSlider();
    }
    else {
        secondSlider();
    }
});

//previous button for previous slide

nxtBtn.addEventListener('click', () => {
    if (slide3.classList.contains('active-slide')) {
        thirdSlider();
    }
    else if (slide2.classList.contains('active-slide')) {
        thirdSlider();
    }
    else {
        secondSlider();
    }
});

// JS for login form validation

function validateLoginForm() {
    let input_user = document.getElementById('input-user').value;
    let input_password = document.getElementById('input-password').value;
    let error_login = document.getElementById('login-error');

    if (input_user == '') {
        error_login.innerHTML = 'Username required';
        return false;
    }
    if (input_password == '') {
        error_login.innerHTML = "Password required";
        return false;
    }
    else {
        error_login.innerHTML = '';
        return true;
    }
};

// Top of navbar design animation

let logo_div = document.getElementById('logo-div');
let logo_div_2 = document.getElementById('.logo-div-2');

function openNav() {
    setTimeout(() => {
        logo_div.style.left = "0";
        logo_div_2.style.right = "0";
    }, 500);
}

if (window.pageYOffset < 100) {
    window.addEventListener('load', () => {
        openNav();
    });
}

// On scroll navbar animation

let nav_ul = document.getElementById("nav-ul");
let navbar = document.getElementById('navbar');
let logo_small = document.getElementById('logo-small');

window.addEventListener('scroll', () => {
    if (window.pageYOffset > 100) {
        logo_div_2.style.right = "-300px";
        logo_div.style.left = "-300px";
        navbar.style.top = "-40px";
        nav_ul.classList.add('ul-after-scroll');
        open_menu.classList.add('mobile-nav-after-scroll');
    }
    else {
        logo_div_2.style.right = "0";
        logo_div.style.left = "0";
        navbar.style.top = "0";
        nav_ul.classList.remove('ul-after-scroll');
        open_menu.classList.remove('mobile-nav-after-scroll');
    }

    if (window.pageYOffset > 200) {
        logo_small.style.opacity = "1";
    } else {
        logo_small.style.opacity = "0";
    }
});


//contact us form bar animation

let bar1 = document.getElementById('bar1');
let bar2 = document.getElementById('bar2');
let bar1_1 = document.getElementById('bar1-1');
let bar1_2 = document.getElementById('bar1-2');

window.addEventListener('scroll', function () {
    if (window.pageYOffset > 4900 && window.pageYOffset < 5400) {
        bar1.style.transform = 'translateY(-150px)';
        bar1_1.style.transform = 'translateY(80px)';
        this.setTimeout(() => {
            bar2.style.transform = 'translateY(-60px)';
            bar1_2.style.transform = 'translateY(140px)';
        }, 200);
    } else {
        bar1.style.transform = 'translateY(-350px)';
        bar1_1.style.transform = 'translateY(350px)';
        this.setTimeout(() => {
            bar2.style.transform = 'translateY(-300px)';
            bar1_2.style.transform = 'translateY(350px)';
        }, 200);
    }
})

});

