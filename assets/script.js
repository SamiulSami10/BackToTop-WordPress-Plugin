jQuery(document).ready(function ($) {
    var btn = $('#back-to-top');

    // Show/hide on scroll
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.fadeIn();
        } else {
            btn.fadeOut();
        }
    });

    // Scroll to top
    btn.click(function () {
        $('html, body').animate({ scrollTop: 0 }, 600);
    });
});
