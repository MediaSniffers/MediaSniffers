(function($) {
    'use strict';

    var elementorCallToAction = {};
    qodef.modules.elementorCallToAction = elementorCallToAction;

    elementorCallToAction.qodeInitElementorCallToAction = qodeInitElementorCallToAction;

    elementorCallToAction.qodeOnWindowLoad = qodefOnWindowLoad;

    $(window).load(qodefOnWindowLoad);

    /*
     ** All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodeInitElementorCallToAction();
    }

    function qodeInitElementorCallToAction(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_call_to_action.default', function() {
                qodef.modules.common.qodefAddAppearClass().init();
            } );
        });
    }

})(jQuery);