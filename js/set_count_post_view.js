define(['vendor/jquery'], function ($) {
    return function () {
        if (window.a2a_config && window.a2a_config.post_id && window.a2a_config.ajax_site_url){
            $.post(window.a2a_config.ajax_site_url, {
                action: 'spc',
                post_id: window.a2a_config.post_id,
                nonce_code : window.a2a_config.nonce
            } );
        }
    };
});