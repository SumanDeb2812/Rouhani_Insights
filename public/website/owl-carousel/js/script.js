$(document).ready(function(){
    $('.owl-partners').owlCarousel({
        items: 4,
        margin: 100,
        loop: true,
        autoplay: true,
        smartSpeed: 1000,
        responsive:{
            0:{
                items: 1,
                dots: false,
            },
            576:{
                items:2,
            },
            768:{
                items:3,
            },
            992:{
                items:4
            }
        }
    });

    $('.owl-about').owlCarousel({
        items: 1,
        animateOut: 'fadeOut',
        loop: true,
        autoplay: true,
        smartSpeed: 2000,
        dots: false,
        margin: 50,
        lazyLoad: true,
    });

    $('.owl-pc').owlCarousel({
        items: 1,
        margin: 200,
        smartSpeed: 1000,
    });

    // $('.owl-testi').owlCarousel({
    //     items: 2,
    //     loop: true,
    //     autoplay: true,
    //     smartSpeed: 1000,
    //     dots: false,
    //     responsive:{
    //         0:{
    //             items:1,
    //             margin:50
    //         },
    //         992:{
    //             items:2
    //         }
    //     }
    // });
  });