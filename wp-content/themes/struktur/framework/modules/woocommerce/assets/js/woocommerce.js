(function($) {
    'use strict';

    var woocommerce = {};
    qodef.modules.woocommerce = woocommerce;

    woocommerce.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitQuantityButtons();
        qodefInitSelect2();
	    qodefInitSingleProductLightbox();
	    qodefBottomLineFortabs();
    }
	
	/*
	All functions to be called on $(window).load() should be in this function
*/
	function qodefOnWindowLoad() {
		qodefInitProductListAnimatedShortcode();
		qodefElementorProductListAnimated();
	}
	
    /*
    ** Init quantity buttons to increase/decrease products for cart
    */
	function qodefInitQuantityButtons() {
		$(document).on('click', '.qodef-quantity-minus, .qodef-quantity-plus', function (e) {
			e.stopPropagation();
			
			var button = $(this),
				inputField = button.siblings('.qodef-quantity-input'),
				step = parseFloat(inputField.data('step')),
				max = parseFloat(inputField.data('max')),
				minus = false,
				inputValue = parseFloat(inputField.val()),
				newInputValue;
			
			if (button.hasClass('qodef-quantity-minus')) {
				minus = true;
			}
			
			if (minus) {
				newInputValue = inputValue - step;
				if (newInputValue >= 1) {
					inputField.val(newInputValue);
				} else {
					inputField.val(0);
				}
			} else {
				newInputValue = inputValue + step;
				if (max === undefined) {
					inputField.val(newInputValue);
				} else {
					if (newInputValue >= max) {
						inputField.val(max);
					} else {
						inputField.val(newInputValue);
					}
				}
			}
			
			inputField.trigger('change');
		});
	}
	
    /*
    ** Init select2 script for select html dropdowns
    */
	function qodefInitSelect2() {
		var orderByDropDown = $('.woocommerce-ordering .orderby');
		if (orderByDropDown.length) {
			orderByDropDown.select2({
				minimumResultsForSearch: Infinity
			});
		}
		
		var variableProducts = $('.qodef-woocommerce-page .qodef-content .variations td.value select');
		if (variableProducts.length) {
			variableProducts.select2();
		}
		
		var shippingCountryCalc = $('#calc_shipping_country');
		if (shippingCountryCalc.length) {
			shippingCountryCalc.select2();
		}
		
		var shippingStateCalc = $('.cart-collaterals .shipping select#calc_shipping_state');
		if (shippingStateCalc.length) {
			shippingStateCalc.select2();
		}
		
		var defaultMonsterWidgets = $('.widget.widget_archive select, .widget.widget_categories select, .widget.widget_text select');
		if (defaultMonsterWidgets.length && typeof defaultMonsterWidgets.select2 === 'function') {
			defaultMonsterWidgets.select2();
		}
	}
	
	/*
	 ** Init Product Single Pretty Photo attributes
	 */
	function qodefInitSingleProductLightbox() {
		var item = $('.qodef-woo-single-page.qodef-woo-single-has-pretty-photo .images .woocommerce-product-gallery__image');
		
		if(item.length) {
			item.children('a').attr('data-rel', 'prettyPhoto[woo_single_pretty_photo]');
			
			if (typeof qodef.modules.common.qodefPrettyPhoto === "function") {
				qodef.modules.common.qodefPrettyPhoto();
			}
		}
	}
	
	function qodefInitProductListAnimatedShortcode() {
		
		var productListAnimatedHolder = $('.qodef-pl-holder:not(.qodef-pl-animation-disabled)');
		
		if(productListAnimatedHolder.length) {
			productListAnimatedHolder.each(function(){
				var productList = $(this),
					productListItem = productList.find('.qodef-pli');
				
				productList.animate({opacity: 1}, 1000, 'easeInOutQuad');
				
				console.log(productListItem.length);
				
				productListItem.appear(function(){
					$(this).addClass('qodef-pli-animated');
				},{accX: 0, accY: 0});
			});
		}
	}
	
	function qodefBottomLineFortabs() {
		var firstLevelMenus = $('.woocommerce-tabs > ul');
		
		if (firstLevelMenus.length) {
			firstLevelMenus.each(function(){
				var mainMenu = $(this);
				
				mainMenu.append('<li class="qodef-product-tabs-line"></li>');
				
				var menuLine = mainMenu.find('.qodef-product-tabs-line'),
					menuItems = mainMenu.find('> li:not(.qodef-product-tabs-line)'),
					initialOffset;
				
				if (menuItems.filter('.active').length) {
					initialOffset = menuItems.filter('.active').offset().left;
					menuLine.css('width', menuItems.filter('.active').outerWidth());
				} else {
					initialOffset = menuItems.first().offset().left;
					menuLine.css('width', menuItems.first().outerWidth());
				}
				
				//initial positioning
				menuLine.css('left',  initialOffset - mainMenu.offset().left);
				//menuLine.css('top',  Math.floor(menuItems.first().find('.item_text').offset().top - mainMenu.offset().top + menuItems.first().find('.item_text').height() + lineTopOffset));
				
				//fx on
				menuItems.mouseenter(function(){
					var menuItem = $(this),
						menuItemWidth = menuItem.outerWidth(),
						mainMenuOffset = mainMenu.offset().left,
						menuItemOffset = menuItem.offset().left - mainMenuOffset;
					
					menuLine.css('width', menuItemWidth);
					menuLine.css('left', menuItemOffset);
				});
				
				//fx off
				menuItems.mouseleave(function(){
					
					var menuItem = $(this),
						menuItemWidth = menuItem.outerWidth(),
						mainMenuOffset = mainMenu.offset().left,
						menuItemOffset = menuItem.offset().left - mainMenuOffset;
					
					if(menuItem.hasClass('active')){
						menuLine.css('width', menuItemWidth);
						menuLine.css('left', menuItemOffset);
					} else{
						var activeLi = menuItems.filter('.active'),
							activeWidth = activeLi.outerWidth(),
							activeLeft = activeLi.offset().left - mainMenuOffset;
						
						menuLine.css('width', activeWidth);
						menuLine.css('left', activeLeft);
					}
				});
				
			});
		}
	}

	function qodefElementorProductListAnimated(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction('frontend/element_ready/qodef_product_list.default', function () {
				qodefInitProductListAnimatedShortcode();
			});
		});
	}

})(jQuery);