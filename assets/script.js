jQuery(document).ready(function ($) {
    var btn = $('#back-to-top');

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.fadeIn();
        } else {
            btn.fadeOut();
        }
    });

    btn.click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1000); // fixed 1500ms
    });
});
