require('./bootstrap')
try {
    window.Popper = require('popper.js').default;
    // window.$ = window.jQuery = require('jquery');
    
    require('bootstrap');

    // Basic Plugin
    require('jquery.nicescroll');
    require('jquery-validation');

    // stisla js
    require('./vendor/stisla/stisla');
    require('./vendor/stisla/scripts');
} catch (e) {}