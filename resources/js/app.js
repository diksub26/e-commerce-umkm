require('./bootstrap')
try {
    window.Popper = require('popper.js').default;
    // window.$ = window.jQuery = require('jquery');
    
    require('bootstrap');

    // Basic Plugin
    require('jquery.nicescroll');
    require('jquery-validation');

    require('datatables.net-bs4');
    require('datatables.net-buttons-bs4');
    require('./vendor/datatables/buttons.server-side');

    // stisla js
    require('./vendor/stisla/stisla');
    require('./vendor/stisla/scripts');
} catch (e) {}

window.beFormValidation = function(id, rules){
    var initValidationBootstrap = function(){
        jQuery('#' + id).validate({
            ignore: [],
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e){
                jQuery(e).parents('.form-group').append(error);
            },
            highlight: function(e){
                jQuery(e).closest('.form-control').removeClass('is-invalid').addClass('is-invalid');
            },
            success: function(e){
                jQuery(e).closest('.form-control').removeClass('is-invalid');
                jQuery(e).remove();
            },
            rules: rules,
            submitHandler: function(form){
                return true;
            }
        })
    };
    return {
        init: function () {
            // Init Bootstrap Forms Validation
            initValidationBootstrap();
        }
    };
}