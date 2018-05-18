require(['vendor/jquery', 'vendor/flexmenu', './shady_header', 'vendor/mdl'], function ($, flexmenu, shadyHeader, mdl) {
    //ServiceWorker
    // if ('serviceWorker' in navigator) {
    //     navigator.serviceWorker.register('service-worker.js');
    // }
    //BLOG MENU START
    $(document).ready(function () {
        $('#topMenu .menu-list').flexMenu({
            linkText: 'Еще',
            linkTextAll: 'Еще'
        });
    });

    $(document).on('mouseup touchend', function (e) {
        if (!$(e.target).closest('.flexMenu-popup, .flexMenu-popup *, .flexMenu-viewMore > a').length) {
            $('.flexMenu-popup').slideUp(300);
        }
    });

    //MDL
    $(window).on("load resize", function () {
        if ('classList' in document.createElement('div') &&
            'querySelector' in document &&
            'addEventListener' in window && Array.prototype.forEach) {
            mdl.upgradeAllRegistered();
        } else {
            mdl.upgradeElement = function () {
            };
            mdl.register = function () {
            };
        }
    });

    //BLOG FOOTER
    $(window).on("load resize", function () {
        var fh = $('.footer').height();
        $('body').css("paddingBottom", fh);
    });

    //BLOG HEADER
    $(window).scroll(function () {
        shadyHeader();
    });
});