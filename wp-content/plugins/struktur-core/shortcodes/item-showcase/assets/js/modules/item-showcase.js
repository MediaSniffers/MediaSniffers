(function($) {
	'use strict';
	
	var itemShowcase = {};
	qodef.modules.itemShowcase = itemShowcase;
	
	itemShowcase.qodefInitItemShowcase = qodefInitItemShowcase;
	itemShowcase.qodefElementorInitItemShowcase = qodefElementorInitItemShowcase;
	
	itemShowcase.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitItemShowcase();
	}

	function qodefOnWindowLoad() {
		qodefElementorInitItemShowcase();
	}
	
	/**
	 * Init item showcase shortcode
	 */
	function qodefInitItemShowcase() {
		var itemShowcase = $('.qodef-item-showcase-holder');
		
		if (itemShowcase.length) {
			itemShowcase.each(function(){
				var thisItemShowcase = $(this),
					leftItems = thisItemShowcase.find('.qodef-is-left'),
					rightItems = thisItemShowcase.find('.qodef-is-right'),
					itemImage = thisItemShowcase.find('.qodef-is-image');
				
				//logic
				leftItems.wrapAll( "<div class='qodef-is-item-holder qodef-is-left-holder' />");
				rightItems.wrapAll( "<div class='qodef-is-item-holder qodef-is-right-holder' />");
				thisItemShowcase.animate({opacity:1},200);
				
				setTimeout(function(){
					thisItemShowcase.appear(function(){
						itemImage.addClass('qodef-appeared');
						thisItemShowcase.on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
							function(e) {
								if(qodef.windowWidth > 1200) {
									itemAppear('.qodef-is-left-holder .qodef-is-item');
									itemAppear('.qodef-is-right-holder .qodef-is-item');
								} else {
									itemAppear('.qodef-is-item');
								}
							});
					},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
				},100);
				
				//appear animation trigger
				function itemAppear(itemCSSClass) {
					thisItemShowcase.find(itemCSSClass).each(function(i){
						var thisListItem = $(this);
						setTimeout(function(){
							thisListItem.addClass('qodef-appeared');
						}, i*150);
					});
				}
			});
		}
	}

	/**
	 * Elementor
	 */
	function qodefElementorInitItemShowcase(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_item_showcase.default', function() {
				qodefInitItemShowcase();
			} );
		});
	}
	
})(jQuery);