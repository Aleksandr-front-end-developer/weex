(function($) {
	'use strict';
	
	
    $(window).on('load', mkdfOnWindowLoad);
    
    /*
     All functions to be called on $(window).load() should be in this function
    */
    function mkdfOnWindowLoad() {
        mkdfElementorCallToActionButton();
    }


    function mkdfElementorCallToActionButton(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/mkdf_call_to_action.default', function() {
                mkdf.modules.button.mkdfButton().init();
            } );
        });
    }
	
})(jQuery);