define(['vendor/jquery', 'vendor/jquery.ajaxchimp'], function ($) {
    return function () {
        $('#subscriptionForm').on("submit", function(e){
            var email = document.querySelector('#email-subscription');
            var name = document.querySelector('#name-subscription');
            e.preventDefault();
            if (email && email.MaterialTextfield && email.MaterialTextfield.input_.validity && name && name.MaterialTextfield && name.MaterialTextfield.input_.validity){
                $("#subscriptionForm").ajaxChimp({
                    url: 'https://yottos.us3.list-manage.com/subscribe/post?u=4e331c48ac31944931664297c&amp;id=3dd923028f',
                    callback: function (resp) {
                        $('#thanksSubscriptionMsg').text(resp.msg);
                        $('#subscriptionForm').removeClass('show');
                        $('#thanksSubscription').addClass('show');
                    }
                });
            }
        });
        $('.closeSubscription').click(function(){
            $('#subscriptionForm').removeClass('show');
            $('#thanksSubscription').removeClass('show');
        });
        $(document).on("click", "#subscriptionDrop", function(e){
            e.stopPropagation();
            $('#subscriptionForm').toggleClass('show');
        });
        $(document).on("click touchend", function(e) {
            if(!$(e.target).is("#subscriptionDrop") && !$(e.target).parents().is("#subscriptionForm")){
                $('#subscriptionForm').removeClass('show');
                $('#thanksSubscription').removeClass('show');
            }
        });
    };
});