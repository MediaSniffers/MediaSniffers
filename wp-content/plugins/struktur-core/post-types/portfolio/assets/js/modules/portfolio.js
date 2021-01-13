(function($) {
	'use strict';
	
	var portfolio = {};
	qodef.modules.portfolio = portfolio;
	
	portfolio.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefPortfolioSingleFollow().init();
	}
	
	var qodefPortfolioSingleFollow = function () {
		var info = $('.qodef-follow-portfolio-info .qodef-portfolio-single-holder .qodef-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.qodef-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				mediaHolderOffset = mediaHolder.offset().top,
				mediaHolderItemSpace = parseInt(mediaHolder.find('.qodef-ps-image:last-of-type').css('marginBottom'), 10),
				header = $('.header-appear, .qodef-fixed-wrapper'),
				headerHeight = header.length ? header.height() : 0;
			
			var stickyHolderPosition = function () {
				if (mediaHolderHeight >= infoHolderHeight) {
					var scrollValue = qodef.scroll;
					
					//Calculate header height if header appears
					if (scrollValue > 0 && header.length) {
						headerHeight = header.height();
					}
					
					var headerMixin = headerHeight + qodefGlobalVars.vars.qodefAddForAdminBar;
					if (scrollValue >= mediaHolderOffset - headerMixin) {
						if (scrollValue + infoHolderHeight >= mediaHolderHeight + mediaHolderOffset - mediaHolderItemSpace - headerMixin) {
							info.stop().animate({
								marginTop: mediaHolderHeight - mediaHolderItemSpace - infoHolderHeight
							});
							//Reset header height
							headerHeight = 0;
						} else {
							info.stop().animate({
								marginTop: scrollValue - mediaHolderOffset + headerMixin
							});
						}
					} else {
						info.stop().animate({
							marginTop: 0
						});
					}
				}
			};
		}
		
		return {
			init: function () {
				if (info.length) {
					stickyHolderPosition();
					$(window).scroll(function () {
						stickyHolderPosition();
					});
				}
			}
		};
	};
	
})(jQuery);