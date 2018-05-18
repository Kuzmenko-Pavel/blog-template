define(['vendor/jquery'], function ($) {
    return function () {
        var header = $('header'),
            headerPos = header.offset().top,
            breakpoint = $(window).innerHeight() - 80;
        if (headerPos > breakpoint) {
            header.addClass('shady');
        } else {
            header.removeClass('shady');
        }
    };
});