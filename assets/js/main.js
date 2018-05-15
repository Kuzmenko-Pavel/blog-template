//=======YOTTOS JAVASCRIPT=======//
var $ = jQuery;

$(window).on("load resize", function () {
    var fh = $('.footer').height();
    $('body').css("paddingBottom", fh);
});

$(function () {
    $("img").error(function () {
        $(this).hide();
    });
    /**
     * Check the validity state and update field accordingly.
     *
     * @public
     */
    MaterialTextfield.prototype.checkValidity = function () {
        if (this.input_.validity.valid) {
            this.element_.classList.remove(this.CssClasses_.IS_INVALID);
        } else {
            if (this.element_.getElementsByTagName('input')[0].value.length > 0) {
                this.element_.classList.add(this.CssClasses_.IS_INVALID);
            }
        }
    };
    $('#topMenu .menu-list').flexMenu({
        linkText: 'Еще',
        linkTextAll: 'Еще'
    });

    $(document).on('mouseup touchend', function (e) {
        if (!$(e.target).closest('.flexMenu-popup, .flexMenu-popup *, .flexMenu-viewMore > a').length) {
            $('.flexMenu-popup').slideUp(300);
        }
    });

    shadyHeader();

    $(window).scroll(function () {
        shadyHeader();
    });


    // Dropdown
    $('.dropdown-submenu .dropdown-toggle').on("click", function (e) {

        $(this).closest('.dropdown').toggleClass('open');

        e.stopPropagation();
        e.preventDefault();

    });


    //SmoothScroll
    function shadyHeader() {

        var header = $('header'),
            headerPos = header.offset().top,
            breakpoint = $(window).innerHeight() - 80;

        if (headerPos > breakpoint) {
            header.addClass('shady');
        } else {
            header.removeClass('shady');
        }
    }


    // Popup
    $('.popup-link').click(function (e) {
        e.preventDefault();
        var targetPopup = this.hash,
            $parentPopup = $(this).closest('.show');
        $(targetPopup).parent('.popup-wrap').addClass('show');
        if ($parentPopup.length !== 0) {
            $parentPopup.removeClass('show');
        }
        return false;
    });

    $(document).on("click", ".close-btn", function () {
        $(this).closest('.popup-wrap').removeClass('show');
    });

    $(document).on("mouseup touchend", function (e) {
        if (!$(e.target).is(".popup") && !$(e.target).parents().is(".popup")) {
            $(".popup-wrap").removeClass("show");
        }
    });
    $('#readLater').on("submit", function (e) {
        e.preventDefault();
        $('#readLater').hide();
        $('#thanks').show();
    });
    $('#closeReadLater').click(function () {
        $('#readLater').closest('.popup-wrap').removeClass('show');
    });
    $('#subscriptionForm').on("submit", function (e) {
        e.preventDefault();
        $('#subscriptionForm').hide();
        $('#thanksSubscription').addClass('show');
    });
    $('#closeSubscription').click(function () {
        $('.subscription').remove();
    });
    $(document).on("click", ".delete-file", function (e) {
        e.preventDefault();
        var inputReplace = $('<input type="file" name="files" id="files" class="newInput" onchange="javascript:updateList();" multiple>');
        var input = $('#files');
        input.replaceWith(inputReplace);
        updateList();
    });


});


function updateList() {
    var input = document.getElementById('files');
    var output = document.getElementById('fileList');

    var fileList = [];
    fileList = input.files;
    output.innerHTML = '';
    for (var i = 0; i < fileList.length; i++) {
        output.innerHTML += '<span class="file-item"><span>' + fileList.item(i).name + '</span><a href="#" class="delete-file"><i class="material-icons">&#xE5CD;</i></a></span>';
    }
}


$(function () {
    $(document).on("change", "#files", function () {
        updateList();
    });
});
// Easy Social Share Buttons Scripts
var essb = (function (document, window) {

    function getSocialShareCounts (shareUrl, shareElements) {

        // Set up vars
        var ajaxUrl = easy_social_share_buttons_ajax_vars.easy_social_share_buttons_ajax_url,
            data = {
                action: 'essb_get_social_counts',
                url: shareUrl,
                essb_ajax_nonce: easy_social_share_buttons_ajax_vars.easy_social_share_buttons_ajax_nonce
            },
            params = Object.keys(data).map(
                function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
            ).join('&'),
            xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");

        // Send ajax post
        xhr.open('POST', ajaxUrl);
        xhr.onreadystatechange = function() {
            if (xhr.readyState>3 && xhr.status==200) { processShareData(xhr.responseText, shareElements); }
        };
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }

    function addClass (el, className) {
        if (el.classList) {
            el.classList.add(className);
        } else {
            el.className += ' ' + className;
        }
    }

    function processShareData(res, shareElements) {
        var data = JSON.parse(res);

        for (var i = shareElements.length - 1; i >= 0; i--) {
            appendShareCounts(data, shareElements[i]);
        };
    }

    function appendShareCounts (data, shareGroupEl) {
        var className = 'ess-social-count--is-ready',
            el;

        el = shareGroupEl.querySelector('.ess-social-count--facebook');

        if (el !== null) {
            el.innerHTML = data.facebook;
            addClass(el, className);
        }

        el = shareGroupEl.querySelector('.ess-social-count--gplus');

        if (el !== null) {
            el.innerHTML = data.google;
            addClass(el, className);
        }

        el = shareGroupEl.querySelector('.ess-social-count--pinterest');

        if (el !== null) {
            el.innerHTML = data.pinterest;
            addClass(el, className);
        }
    }

    function init () {
        var elements = document.querySelectorAll('.ess-buttons--count'),
            shareButtonGroups = [];

        // Find all share button groups on page
        Array.prototype.forEach.call(elements, function(el, i){
            var shareUrl = el.getAttribute('data-ess-count-url');

            if (shareButtonGroups.length > 0) {
                for (var k = shareButtonGroups.length - 1; k >= 0; k--) {
                    if ( shareUrl === shareButtonGroups[k].url ) {
                        shareButtonGroups[k].elements.push(el);
                    } else {
                        shareButtonGroups.push({
                            url: shareUrl,
                            elements: [el]
                        });
                    }
                }
            } else {
                shareButtonGroups.push({
                    url: shareUrl,
                    elements: [el]
                });
            }
        });

        for (var i = shareButtonGroups.length - 1; i >= 0; i--) {
            getSocialShareCounts(shareButtonGroups[i].url, shareButtonGroups[i].elements);
        };
    }

    // Run code when document is ready
    // in case the document is already rendered
    if (document.readyState != 'loading') init();
    // modern browsers
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', init);
    // IE <= 8
    else document.attachEvent('onreadystatechange', function(){
            if (document.readyState == 'complete') init();
        });
}(document, window));