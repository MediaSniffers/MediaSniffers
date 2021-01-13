(function($) {
    'use strict';

    var elementorSectionTitle = {};
    qodef.modules.elementorSectionTitle = elementorSectionTitle;

    elementorSectionTitle.qodeInitElementorSectionTitle = qodeInitElementorSectionTitle;

    elementorSectionTitle.qodeOnWindowLoad = qodefOnWindowLoad;

    $(window).load(qodefOnWindowLoad);

    /*
     ** All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodeInitElementorSectionTitle();
    }

    function qodeInitElementorSectionTitle(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_section_title.default', function() {
                qodef.modules.common.qodefAddAppearClass().init();
            } );
        });
    }

})(jQuery);