define(['vendor/jquery', 'vendor/jquery.form'], function ($) {
    return function () {
        $('.popup-link').click(function(e){
            e.preventDefault();
            var targetPopup = this.hash,
                $parentPopup = $(this).closest('.show');
            $(targetPopup).parent('.popup-wrap').addClass('show');
            if ($parentPopup.length !== 0) {
                $parentPopup.removeClass('show');
            }
            return false;
        });

        $(document).on("click", ".close-btn", function(){
            $(this).closest('.popup-wrap').removeClass('show');
        });

        $(document).on("click touchend", function(e) {
            if(!$(e.target).is(".popup") && !$(e.target).parents().is(".popup")){
                $(".popup-wrap").removeClass("show");
            }
        });

        $('#readLater').on("submit", function(e){
            e.preventDefault();
            var email = document.querySelector('#email-readLater');
            // if($('#g-recaptcha-response').val()) {
            if (email && email.MaterialTextfield && email.MaterialTextfield.input_.validity){
                $("#readLater").ajaxSubmit({
                    url: a2a_config.ajax_site_url,
                    type: 'post',
                    data: {action: 'rl',
                           post_id: window.a2a_config.post_id,
                           nonce_code : window.a2a_config.nonce
                    }
                });
                $('#readLater').hide();
                $('#thanks').show();
            }
            // }
        });

        $('#closeReadLater').click(function(){
            $('#readLater').closest('.popup-wrap').removeClass('show');
        });

    };
});