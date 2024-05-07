$(document).ready(function () {
    showMoreTrigger();
    // titleFixed();

    $(window).on("scroll", function () {
        // titleFixed();
    });

    $(window).on("resize", function () {
        // showMoreTrigger();
    });
});

function titleFixed() {
    if (isElementAtTop("main-card")) {
        $(".fixed-header").fadeIn();
        $(".bg-header").fadeIn();
    } else {
        $(".fixed-header").fadeOut();
        $(".bg-header").fadeOut();
    }
}

function showMoreTrigger() {
    if (isDesktop()) {
        $(".name-plant").show();
        $(".show-more-btn").hide();
    } else {
        $(".name-plant").hide();
        $(".show-more-btn").show();
        $("#show-less-trigger").hide();
    }
}

function isElementAtTop(elementId) {
    var elementTop = $("." + elementId).offset().top;
    var scrollTop = $(window).scrollTop();
    return elementTop <= scrollTop;
}

function isDesktop() {
    return window.innerWidth > 768;
}

// Functional Feature - Sesuaikan dengan manifest
function closeShowMore() {
    $(".show-more-content").fadeOut();
    $("#show-less-trigger").hide();
    $("#show-more-trigger").show();

    setTimeout(function () {
        $(".show-more-btn .icon").css({
            rotate: "45deg",
            marginTop: "-2px",
        });
    }, 400);
}

function openShowMore() {
    $(".show-more-content").fadeIn();
    $("#show-less-trigger").show();
    $("#show-more-trigger").hide();

    setTimeout(function () {
        $(".show-more-btn .icon").css({
            rotate: "225deg",
            marginTop: "3px",
        });
    }, 200);
}
