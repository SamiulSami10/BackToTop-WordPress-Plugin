jQuery(document).ready(function ($) {
    var btn = $('#back-to-top');

    // Get scroll speed from admin settings (ms per 1000px)
    var scrollSpeedInput = (typeof bttb_settings !== 'undefined' && bttb_settings.speed) ? parseInt(bttb_settings.speed) : 600;

    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.fadeIn();
        } else {
            btn.fadeOut();
        }
    });

    btn.click(function () {
        var currentScroll = $(window).scrollTop();

        // Calculate duration so that the scroll speed matches admin input
        // Formula: duration = (distance / 1000px) * input speed
        var duration = (currentScroll / 1000) * scrollSpeedInput;

        $('html, body').animate({ scrollTop: 0 }, duration);
    });
});
