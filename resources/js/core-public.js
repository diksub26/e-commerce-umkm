try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    
    require('bootstrap');

    // Basic Plugin
    require('jquery-validation');
} catch (e) {}