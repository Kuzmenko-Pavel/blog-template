require(['vendor/jquery', 'vendor/flexmenu', './shady_header', 'vendor/mdl',
        './set_count_post_view', './read_later', './subscription'],
    function ($, flexmenu, shadyHeader, mdl, set_count_post_view, read_later, subscription) {
        $.ajaxSetup({cache: false});
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
            set_count_post_view();
            read_later();
            subscription();
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
        (function ( window, document ) {
            'use strict';

            var supportedBrowser = false,
                loaded = false;

            if ( document.querySelector ) {
                if ( window.addEventListener ) {
                    supportedBrowser = true;
                }
            }

            /** @namespace wp */
            window.wp = window.wp || {};

            if ( !! window.wp.receiveEmbedMessage ) {
                return;
            }

            window.wp.receiveEmbedMessage = function( e ) {
                var data = e.data;
                if (data === undefined || data === null){
                    return;
                }
                if ( ! ( data.secret || data.message || data.value ) ) {
                    return;
                }

                if ( /[^a-zA-Z0-9]/.test( data.secret ) ) {
                    return;
                }

                var iframes = document.querySelectorAll( 'iframe[data-secret="' + data.secret + '"]' ),
                    blockquotes = document.querySelectorAll( 'blockquote[data-secret="' + data.secret + '"]' ),
                    i, source, height, sourceURL, targetURL;

                for ( i = 0; i < blockquotes.length; i++ ) {
                    blockquotes[ i ].style.display = 'none';
                }

                for ( i = 0; i < iframes.length; i++ ) {
                    source = iframes[ i ];

                    if ( e.source !== source.contentWindow ) {
                        continue;
                    }

                    source.removeAttribute( 'style' );

                    /* Resize the iframe on request. */
                    if ( 'height' === data.message ) {
                        height = parseInt( data.value, 10 );
                        if ( height > 1000 ) {
                            height = 1000;
                        } else if ( ~~height < 200 ) {
                            height = 200;
                        }

                        source.height = height;
                    }

                    /* Link to a specific URL on request. */
                    if ( 'link' === data.message ) {
                        sourceURL = document.createElement( 'a' );
                        targetURL = document.createElement( 'a' );

                        sourceURL.href = source.getAttribute( 'src' );
                        targetURL.href = data.value;

                        /* Only continue if link hostname matches iframe's hostname. */
                        if ( targetURL.host === sourceURL.host ) {
                            if ( document.activeElement === source ) {
                                window.top.location.href = data.value;
                            }
                        }
                    }
                }
            };

            function onLoad() {
                if ( loaded ) {
                    return;
                }

                loaded = true;

                var isIE10 = -1 !== navigator.appVersion.indexOf( 'MSIE 10' ),
                    isIE11 = !!navigator.userAgent.match( /Trident.*rv:11\./ ),
                    iframes = document.querySelectorAll( 'iframe.wp-embedded-content' ),
                    iframeClone, i, source, secret;

                for ( i = 0; i < iframes.length; i++ ) {
                    source = iframes[ i ];

                    if ( ! source.getAttribute( 'data-secret' ) ) {
                        /* Add secret to iframe */
                        secret = Math.random().toString( 36 ).substr( 2, 10 );
                        source.src += '#?secret=' + secret;
                        source.setAttribute( 'data-secret', secret );
                    }

                    /* Remove security attribute from iframes in IE10 and IE11. */
                    if ( ( isIE10 || isIE11 ) ) {
                        iframeClone = source.cloneNode( true );
                        iframeClone.removeAttribute( 'security' );
                        source.parentNode.replaceChild( iframeClone, source );
                    }
                }
            }

            if ( supportedBrowser ) {
                window.addEventListener( 'message', window.wp.receiveEmbedMessage, false );
                document.addEventListener( 'DOMContentLoaded', onLoad, false );
                window.addEventListener( 'load', onLoad, false );
            }
        })( window, document );

    });