jQuery(document).ready(function ($) {
    var btn = $('#back-to-top');
    var scrollSpeed = (typeof bttb_settings !== 'undefined' && bttb_settings.speed) ? bttb_settings.speed : 600;

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.fadeIn();
        } else {
            btn.fadeOut();
        }
    });

    btn.click(function () {
        $('html, body').animate({ scrollTop: 0 }, scrollSpeed);
    });
});
