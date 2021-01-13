(function($) {
    'use strict';

    var elementorPricingTable = {};
    qodef.modules.elementorPricingTable = elementorPricingTable;

    elementorPricingTable.qodeInitElementorPricingTable = qodeInitElementorPricingTable;

    elementorPricingTable.qodeOnWindowLoad = qodefOnWindowLoad;

    $(window).load(qodefOnWindowLoad);

    /*
     ** All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodeInitElementorPricingTable();
    }

    function qodeInitElementorPricingTable(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_pricing_table.default', function() {
                qodef.modules.common.qodefAddAppearClass().init();
            } );
        });
    }

})(jQuery);