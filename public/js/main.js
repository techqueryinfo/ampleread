$(".ample-menu ul li:first-child").click(function () {
    var activeClass = $(this).hasClass("active");
    if (activeClass) {
        $(this).removeClass("active");
        $(".ample-sub-menu").removeClass("active");
    }
    if (!activeClass) {
        $(this).addClass("active");
        $(".ample-sub-menu").addClass("active");

    }
});
$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        nav: true,
        loop: true,
        margin: 10,
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,

            },
            768: {
                items: 2,
                loop: false,
                margin: 15
            },
            992: {
                items: 3,
                loop: false,
                margin: 15
            },
            1180: {
                items: 4,
                loop: false,
                margin: 20
            },
            1480: {
                items: 5,
                loop: false,
                margin: 15
            }
        }
    });

});
function Setactive(x) {
    var y = $(x).attr("class");
    var z = $(x).attr("id");
    if (y == "ample-login") {
        $(x).addClass("ample-login-active");
        $(x).removeClass("ample-login");
        $(x).siblings().addClass("ample-login");
        $(x).siblings().removeClass("ample-login-active");

    }
    if ((z == "ampleLogin") && (y == "ample-login")) {
        $(".ample-login-section").hide();
        $(".ample-register-section").show();
    }
    if ((z == "ampleSignin") && (y == "ample-login")) {
        $(".ample-login-section").show();
        $(".ample-register-section").hide();
    }

}
function Showforgot() {
    $(".ample-login-section,.ample-register-section,.ample-signup-login-text").hide();
    $(".ample-forgot-password").show();
}
$(".btn-signup").click(function () {
    //alert("signup");
    $(".ample-signup-login-text,.ample-login-section").show();
    $(".ample-register-section,.ample-forgot-password").hide();
    $("#ampleLogin").addClass("ample-login");
    $("#ampleLogin").removeClass("ample-login-active");

    $("#ampleSignin").addClass("ample-login-active");
    $("#ampleSignin").removeClass("ample-login");

});
$(".btn-signin").click(function () {
//alert("signin");
    $(".ample-signup-login-text,.ample-register-section").show();
    $(".ample-login-section,.ample-forgot-password").hide();

    $("#ampleLogin").addClass("ample-login-active");
    $("#ampleLogin").removeClass("ample-login");

    $("#ampleSignin").addClass("ample-login");
    $("#ampleSignin").removeClass("ample-login-active");
});
$(".js-example-basic-single").select2();

$(".sign-in-manage-left .unit").click(function(){
    $(".sign-in-manage-left .unit").removeClass("active");
    $(this).addClass("active");
});

$("#status").select2();
