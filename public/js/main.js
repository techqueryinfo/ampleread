$(".ample-menu ul li:first-child").click(function () {
    var activeClass=$(this).hasClass("active");
    if(activeClass){
        $(this).removeClass("active");
        $(".ample-sub-menu").removeClass("active");
    }
    if(!activeClass){
        $(this).addClass("active");
        $(".ample-sub-menu").addClass("active");

    }
});

$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        nav:true,
        loop: true,
        margin: 10,
        dots:false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 3,

            },
            768:{
                items:3,
                loop: false,
                margin: 15
            },
            992:{
                items:4,
                loop: false,
                margin: 15
            },
            1180: {
                items:5,
                loop: false,
                margin: 20
            },
            1480:{
                items:6,
                loop: false,
                margin: 15
            }
        }
    });

});



