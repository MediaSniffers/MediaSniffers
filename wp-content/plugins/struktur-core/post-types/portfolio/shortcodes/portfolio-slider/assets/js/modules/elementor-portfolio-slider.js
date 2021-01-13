(function($) {
    'use strict';

    var elementorPortfolioSlider = {};
    qodef.modules.elementorPortfolioSlider = elementorPortfolioSlider;

    elementorPortfolioSlider.qodeInitElementorPortfolioSlider = qodeInitElementorPortfolioSlider;

    elementorPortfolioSlider.qodeOnWindowLoad = qodefOnWindowLoad;

    $(window).load(qodefOnWindowLoad);

    /*
     ** All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodeInitElementorPortfolioSlider();
    }

    function qodeInitElementorPortfolioSlider(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_portfolio_slider.default', function() {
                qodef.modules.portfolioList.qodefInitPortfolioHoverArrow();
                qodef.modules.portfolioList.qodefPortfolioFollowInfo().init();
            } );
        });
    }

})(jQuery);