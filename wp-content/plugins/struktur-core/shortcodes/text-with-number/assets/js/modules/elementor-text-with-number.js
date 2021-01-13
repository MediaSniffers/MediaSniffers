(function($) {
    'use strict';

    var elementorTextWithNumber = {};
    qodef.modules.elementorTextWithNumber = elementorTextWithNumber;

    elementorTextWithNumber.qodeInitelementorTextWithNumber = qodeInitelementorTextWithNumber;

    elementorTextWithNumber.qodeOnWindowLoad = qodefOnWindowLoad;

    $(window).load(qodefOnWindowLoad);

    /*
     ** All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodeInitelementorTextWithNumber();
    }

    function qodeInitelementorTextWithNumber(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_text_with_number.default', function() {
                qodef.modules.common.qodefAddAppearClass().init();
            } );
        });
    }

})(jQuery);