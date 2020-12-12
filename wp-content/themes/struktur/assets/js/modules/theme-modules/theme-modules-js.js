(function($) {
	"use strict";

    var blog = {};
    qodef.modules.blog = blog;

    blog.qodefOnDocumentReady = qodefOnDocumentReady;
    blog.qodefOnWindowLoad = qodefOnWindowLoad;
    blog.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitAudioPlayer();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
	    qodefInitBlogPagination().init();
    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {
	    qodefInitBlogPagination().scroll();
    }

    /**
    * Init audio player for Blog list and single pages
    */
    function qodefInitAudioPlayer() {
	    var players = $('audio.qodef-blog-audio');
	
	    if (players.length) {
		    players.mediaelementplayer({
			    audioWidth: '100%'
		    });
	    }
    }
	
	/**
	 * Initializes blog pagination functions
	 */
	function qodefInitBlogPagination(){
		var holder = $('.qodef-blog-holder');
		
		var initLoadMorePagination = function(thisHolder) {
			var loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisHolder);
			});
		};
		
		var initInifiteScrollPagination = function(thisHolder) {
			var blogListHeight = thisHolder.outerHeight(),
				blogListTopOffest = thisHolder.offset().top,
				blogListPosition = blogListHeight + blogListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisHolder.hasClass('qodef-blog-pagination-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > blogListPosition) {
				initMainPagFunctionality(thisHolder);
			}
		};
		
		var initMainPagFunctionality = function(thisHolder) {
			var thisHolderInner = thisHolder.children('.qodef-blog-holder-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
				maxNumPages = thisHolder.data('max-num-pages');
			}
			
			if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
				thisHolder.addClass('qodef-blog-pagination-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisHolder),
				loadingItem = thisHolder.find('.qodef-blog-pag-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			var nonceHolder = thisHolder.find('input[name*="qodef_blog_load_more_nonce_"]');
			
			loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
			loadMoreDatta.blog_load_more_nonce = nonceHolder.val();
			
			if(nextPage <= maxNumPages){
				loadingItem.addClass('qodef-showing');
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'struktur_select_blog_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: qodefGlobalVars.vars.qodefAjaxUrl,
					success: function (data) {
						nextPage++;
						
						thisHolder.data('next-page', nextPage);

						var response = $.parseJSON(data),
							responseHtml =  response.html;

						thisHolder.waitForImages(function(){
							if(thisHolder.hasClass('qodef-grid-masonry-list')){
								qodefInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
								qodef.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('article'), thisHolderInner.find('.qodef-masonry-grid-sizer').width());
							} else {
								qodefInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);
							}
							
							setTimeout(function() {
								qodefInitAudioPlayer();
								qodef.modules.common.qodefOwlSlider();
								qodef.modules.common.qodefFluidVideo();
                                qodef.modules.common.qodefInitSelfHostedVideoPlayer();
                                qodef.modules.common.qodefSelfHostedVideoSize();
								
								if (typeof qodef.modules.common.qodefStickySidebarWidget === 'function') {
									qodef.modules.common.qodefStickySidebarWidget().reInit();
								}

                                // Trigger event.
                                $( document.body ).trigger( 'blog_list_load_more_trigger' );

							}, 400);
						});
						
						if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll-started')) {
							thisHolder.removeClass('qodef-blog-pagination-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisHolder.find('.qodef-blog-pag-load-more').hide();
			}
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisHolderInner.isotope('layout');
			}, 600);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisHolderInner.append(responseHtml);
		};
		
		return {
			init: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-blog-pagination-load-more')) {
							initLoadMorePagination(thisHolder);
						}
						
						if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			},
			scroll: function() {
				if(holder.length) {
					holder.each(function() {
						var thisHolder = $(this);
						
						if(thisHolder.hasClass('qodef-blog-pagination-infinite-scroll')) {
							initInifiteScrollPagination(thisHolder);
						}
					});
				}
			}
		};
	}

})(jQuery);
(function ($) {
	"use strict";
	
	var footer = {};
    qodef.modules.footer = footer;
	
	footer.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	 
	function qodefOnWindowLoad() {
		uncoveringFooter();
	}
	
	function uncoveringFooter() {
		var uncoverFooter = $('body:not(.error404) .qodef-footer-uncover');

		if (uncoverFooter.length && !qodef.htmlEl.hasClass('touch')) {

			var footer = $('footer'),
				footerHeight = footer.outerHeight(),
				content = $('.qodef-content');
			
			var uncoveringCalcs = function () {
				content.css('margin-bottom', footerHeight);
				footer.css('height', footerHeight);
			};


			//set
			uncoveringCalcs();
			
			$(window).resize(function () {
				//recalc
				footerHeight = footer.find('.qodef-footer-inner').outerHeight();
				uncoveringCalcs();
			});
		}
	}
	
})(jQuery);
(function($) {
	"use strict";
	
	var header = {};
	qodef.modules.header = header;
	
	header.qodefSetDropDownMenuPosition     = qodefSetDropDownMenuPosition;
	header.qodefSetDropDownWideMenuPosition = qodefSetDropDownWideMenuPosition;
	header.qodefBottomLineForMenu = qodefBottomLineForMenu();
	
	header.qodefOnDocumentReady = qodefOnDocumentReady;
	header.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefSetDropDownMenuPosition();
		setTimeout(function(){
			qodefDropDownMenu();
		}, 100);
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefSetDropDownWideMenuPosition();
	}
	
	/**
	 * Set dropdown position
	 */
	function qodefSetDropDownMenuPosition() {
		var menuItems = $('.qodef-drop-down > ul > li.narrow.menu-item-has-children');
		
		if (menuItems.length) {
			menuItems.each(function (i) {
				var thisItem = $(this),
					menuItemPosition = thisItem.offset().left,
					dropdownHolder = thisItem.find('.second'),
					dropdownMenuItem = dropdownHolder.find('.inner ul'),
					dropdownMenuWidth = dropdownMenuItem.outerWidth(),
					menuItemFromLeft = qodef.windowWidth - menuItemPosition;
				
				if (qodef.body.hasClass('qodef-boxed')) {
					menuItemFromLeft = qodef.boxedLayoutWidth - (menuItemPosition - (qodef.windowWidth - qodef.boxedLayoutWidth ) / 2);
				}
				
				var dropDownMenuFromLeft; //has to stay undefined because 'dropDownMenuFromLeft < dropdownMenuWidth' conditional will be true
				
				if (thisItem.find('li.sub').length > 0) {
					dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
				}
				
				dropdownHolder.removeClass('right');
				dropdownMenuItem.removeClass('right');
				if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
					dropdownHolder.addClass('right');
					dropdownMenuItem.addClass('right');
				}
			});
		}
	}
	
	/**
	 * Set dropdown wide position
	 */
	function qodefSetDropDownWideMenuPosition(){
		var menuItems = $(".qodef-drop-down > ul > li.wide");
		
		if(menuItems.length) {
			menuItems.each( function(i) {
                var menuItem = $(this);
				var menuItemSubMenu = menuItem.find('.second');
				
				if(menuItemSubMenu.length && !menuItemSubMenu.hasClass('left_position') && !menuItemSubMenu.hasClass('right_position')) {
					menuItemSubMenu.css('left', 0);
					
					var left_position = menuItemSubMenu.offset().left;
					
					if(qodef.body.hasClass('qodef-boxed')) {
                        //boxed layout case
                        var boxedWidth = $('.qodef-boxed .qodef-wrapper .qodef-wrapper-inner').outerWidth();
						left_position = left_position - (qodef.windowWidth - boxedWidth) / 2;
						menuItemSubMenu.css({'left': -left_position, 'width': boxedWidth});

					} else if(qodef.body.hasClass('qodef-wide-dropdown-menu-in-grid')) {
                        //wide dropdown in grid case
                        menuItemSubMenu.css({'left': -left_position + (qodef.windowWidth - qodef.gridWidth()) / 2, 'width': qodef.gridWidth()});

                    }
                    else {
                        //wide dropdown full width case
                        menuItemSubMenu.css({'left': -left_position, 'width': qodef.windowWidth});

					}
				}
			});
		}
	}
	
	function qodefDropDownMenu() {
		var menu_items = $('.qodef-drop-down > ul > li');
		
		menu_items.each(function() {
			var thisItem = $(this);
			
			if(thisItem.find('.second').length) {
				thisItem.waitForImages(function(){
					var dropDownHolder = thisItem.find('.second'),
						dropDownHolderHeight = !qodef.menuDropdownHeightSet ? dropDownHolder.outerHeight() : 0;
					
					if(thisItem.hasClass('wide')) {
						var tallest = 0,
							dropDownSecondItem = dropDownHolder.find('> .inner > ul > li');
						
						dropDownSecondItem.each(function() {
							var thisHeight = $(this).outerHeight();
							
							if(thisHeight > tallest) {
								tallest = thisHeight;
							}
						});
						
						dropDownSecondItem.css('height', '').height(tallest);
						
						if (!qodef.menuDropdownHeightSet) {
							dropDownHolderHeight = dropDownHolder.outerHeight();
						}
					}
					
					if (!qodef.menuDropdownHeightSet) {
						dropDownHolder.height(0);
					}
					
					if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
						thisItem.on("touchstart mouseenter", function() {
							dropDownHolder.css({
								'height': dropDownHolderHeight,
								'overflow': 'visible',
								'visibility': 'visible',
								'opacity': '1'
							});
						}).on("mouseleave", function() {
							dropDownHolder.css({
								'height': '0px',
								'overflow': 'hidden',
								'visibility': 'hidden',
								'opacity': '0'
							});
						});
					} else {
						if (qodef.body.hasClass('qodef-dropdown-animate-height')) {
							var animateConfig = {
								interval: 0,
								over: function () {
									setTimeout(function () {
										dropDownHolder.addClass('qodef-drop-down-start').css({
											'visibility': 'visible',
											'height': '0',
											'opacity': '1'
										});
										dropDownHolder.stop().animate({
											'height': dropDownHolderHeight
										}, 400, 'easeInOutQuint', function () {
											dropDownHolder.css('overflow', 'visible');
										});
									}, 100);
								},
								timeout: 100,
								out: function () {
									dropDownHolder.stop().animate({
										'height': '0',
										'opacity': 0
									}, 100, function () {
										dropDownHolder.css({
											'overflow': 'hidden',
											'visibility': 'hidden'
										});
									});
									
									dropDownHolder.removeClass('qodef-drop-down-start');
								}
							};
							
							thisItem.hoverIntent(animateConfig);
						} else {
							var config = {
								interval: 0,
								over: function () {
									setTimeout(function () {
										dropDownHolder.addClass('qodef-drop-down-start').stop().css({'height': dropDownHolderHeight});
									}, 150);
								},
								timeout: 150,
								out: function () {
									dropDownHolder.stop().css({'height': '0'}).removeClass('qodef-drop-down-start');
								}
							};
							
							thisItem.hoverIntent(config);
						}
					}
				});
			}
		});
		
		$('.qodef-drop-down ul li.wide ul li a').on('click', function(e) {
			if (e.which === 1){
				var $this = $(this);
				
				setTimeout(function() {
					$this.mouseleave();
				}, 500);
			}
		});
		
		qodef.menuDropdownHeightSet = true;
	}
	
	/*
 ** Underlining effect for first level for Main Menu
 */
	function qodefBottomLineForMenu() {
		var firstLevelMenus = $('.qodef-main-menu > ul');
		
		if (firstLevelMenus.length) {
			firstLevelMenus.each(function(){
				var mainMenu = $(this);
				
				mainMenu.append('<li class="qodef-main-menu-line"></li>');
				
				var menuLine = mainMenu.find('.qodef-main-menu-line'),
					menuItems = mainMenu.find('> li.menu-item'),
					initialOffset;
				
				if (menuItems.filter('.qodef-active-item').length) {
					initialOffset = menuItems.filter('.qodef-active-item').offset().left;
					menuLine.css('width', menuItems.filter('.qodef-active-item').outerWidth());
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
				mainMenu.mouseleave(function(){
					if (menuItems.filter('.qodef-active-item').length) {
						menuLine.css('width', menuItems.filter('.qodef-active-item').outerWidth());
					} else {
						menuLine.css('width', menuItems.first().outerWidth());
					}
					
					menuLine.css('left', initialOffset - mainMenu.offset().left);
				});
				
			});
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var sidearea = {};
    qodef.modules.sidearea = sidearea;

    sidearea.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefSideArea();
    }
	
	/**
	 * Show/hide side area
	 */
    function qodefSideArea() {
		var wrapper = $('.qodef-wrapper'),
			sideMenu = $('.qodef-side-menu'),
			sideMenuButtonOpen = $('a.qodef-side-menu-button-opener'),
			cssClass,
			//Flags
			slideFromRight = false,
			slideWithContent = false,
			slideUncovered = false;
		
		if (qodef.body.hasClass('qodef-side-menu-slide-from-right')) {
			$('.qodef-cover').remove();
			cssClass = 'qodef-right-side-menu-opened';
			wrapper.prepend('<div class="qodef-cover"/>');
			slideFromRight = true;
		} else if (qodef.body.hasClass('qodef-side-menu-slide-with-content')) {
			cssClass = 'qodef-side-menu-open';
			slideWithContent = true;
		} else if (qodef.body.hasClass('qodef-side-area-uncovered-from-content')) {
			cssClass = 'qodef-right-side-menu-opened';
			slideUncovered = true;
		}
		
		$('a.qodef-side-menu-button-opener, a.qodef-close-side-menu').on('click', function (e) {
			e.preventDefault();
	
	        if (!sideMenuButtonOpen.hasClass('opened')) {
		        sideMenuButtonOpen.addClass('opened');
		        qodef.body.addClass(cssClass);
		
		        if (slideFromRight) {
			        $('.qodef-wrapper .qodef-cover').on('click', function () {
				        qodef.body.removeClass('qodef-right-side-menu-opened');
				        sideMenuButtonOpen.removeClass('opened');
			        });
		        }
		
		        if (slideUncovered) {
			        sideMenu.css({
				        'visibility': 'visible'
			        });
		        }
		
		        var currentScroll = $(window).scrollTop();
		        $(window).scroll(function () {
			        if (Math.abs(qodef.scroll - currentScroll) > 400) {
				        qodef.body.removeClass(cssClass);
				        sideMenuButtonOpen.removeClass('opened');
				        if (slideUncovered) {
					        var hideSideMenu = setTimeout(function () {
						        sideMenu.css({'visibility': 'hidden'});
						        clearTimeout(hideSideMenu);
					        }, 400);
				        }
			        }
		        });
            } else {
	            sideMenuButtonOpen.removeClass('opened');
	            qodef.body.removeClass(cssClass);
	
	            if (slideUncovered) {
		            var hideSideMenu = setTimeout(function () {
			            sideMenu.css({'visibility': 'hidden'});
			            clearTimeout(hideSideMenu);
		            }, 400);
	            }
            }
	
	        if (slideWithContent) {
		        e.stopPropagation();
		
		        wrapper.on('click', function () {
			        e.preventDefault();
			        sideMenuButtonOpen.removeClass('opened');
			        qodef.body.removeClass('qodef-side-menu-open');
		        });
	        }
        });

        if(sideMenu.length){
            qodef.modules.common.qodefInitPerfectScrollbar().init(sideMenu);
        }
    }

})(jQuery);

(function ($) {
	"use strict";
	
	var subscribePopup = {};
	qodef.modules.subscribePopup = subscribePopup;
	
	subscribePopup.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefSubscribePopup();
	}
	
	function qodefSubscribePopup() {
		var popupOpener = $('.qodef-subscribe-popup-holder'),
			popupClose = $('.qodef-sp-close');
		
		if (popupOpener.length) {
			var popupPreventHolder = popupOpener.find('.qodef-sp-prevent'),
				disabledPopup = 'no';
			
			if (popupPreventHolder.length) {
				var isLocalStorage = popupOpener.hasClass('qodef-sp-prevent-cookies'),
					popupPreventInput = popupPreventHolder.find('.qodef-sp-prevent-input'),
					preventValue = popupPreventInput.data('value');
				
				if (isLocalStorage) {
					disabledPopup = localStorage.getItem('disabledPopup');
					sessionStorage.removeItem('disabledPopup');
				} else {
					disabledPopup = sessionStorage.getItem('disabledPopup');
					localStorage.removeItem('disabledPopup');
				}
				
				popupPreventHolder.children().on('click', function (e) {
					if ( preventValue !== 'yes' ) {
						preventValue = 'yes';
						popupPreventInput.addClass('qodef-sp-prevent-clicked').data('value', 'yes');
					} else {
						preventValue = 'no';
						popupPreventInput.removeClass('qodef-sp-prevent-clicked').data('value', 'no');
					}
					
					if (preventValue === 'yes') {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'yes');
						} else {
							sessionStorage.setItem('disabledPopup', 'yes');
						}
					} else {
						if (isLocalStorage) {
							localStorage.setItem('disabledPopup', 'no');
						} else {
							sessionStorage.setItem('disabledPopup', 'no');
						}
					}
				});
			}
			
			if (disabledPopup !== 'yes') {
				if (qodef.body.hasClass('qodef-sp-opened')) {
					qodef.body.removeClass('qodef-sp-opened');
					qodef.modules.common.qodefEnableScroll();
				} else {
					qodef.body.addClass('qodef-sp-opened');
					qodef.modules.common.qodefDisableScroll();
				}
				
				popupClose.on('click', function (e) {
					e.preventDefault();
					
					qodef.body.removeClass('qodef-sp-opened');
					qodef.modules.common.qodefEnableScroll();
				});
				
				//Close on escape
				$(document).keyup(function (e) {
					if (e.keyCode === 27) { //KeyCode for ESC button is 27
						qodef.body.removeClass('qodef-sp-opened');
						qodef.modules.common.qodefEnableScroll();
					}
				});
			}
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var title = {};
    qodef.modules.title = title;

    title.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefParallaxTitle();
    }

    /*
     **	Title image with parallax effect
     */
	function qodefParallaxTitle() {
		var parallaxBackground = $('.qodef-title-holder.qodef-bg-parallax');
		
		if (parallaxBackground.length > 0 && qodef.windowWidth > 1024) {
			var parallaxBackgroundWithZoomOut = parallaxBackground.hasClass('qodef-bg-parallax-zoom-out'),
				titleHeight = parseInt(parallaxBackground.data('height')),
				imageWidth = parseInt(parallaxBackground.data('background-width')),
				parallaxRate = titleHeight / 10000 * 7,
				parallaxYPos = -(qodef.scroll * parallaxRate),
				adminBarHeight = qodefGlobalVars.vars.qodefAddForAdminBar;
			
			parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
			
			if (parallaxBackgroundWithZoomOut) {
				parallaxBackground.css({'background-size': imageWidth - qodef.scroll + 'px auto'});
			}
			
			//set position of background on window scroll
			$(window).scroll(function () {
				parallaxYPos = -(qodef.scroll * parallaxRate);
				parallaxBackground.css({'background-position': 'center ' + (parallaxYPos + adminBarHeight) + 'px'});
				
				if (parallaxBackgroundWithZoomOut) {
					parallaxBackground.css({'background-size': imageWidth - qodef.scroll + 'px auto'});
				}
			});
		}
	}

})(jQuery);

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
(function($) {
    "use strict";

    var blogListSC = {};
    qodef.modules.blogListSC = blogListSC;
    
    blogListSC.qodefOnWindowLoad = qodefOnWindowLoad;
    blogListSC.qodefOnWindowScroll = qodefOnWindowScroll;
    blogListSC.qodefElementorBlogList = qodefElementorBlogList;

    $(window).load(qodefOnWindowLoad);
    $(window).scroll(qodefOnWindowScroll);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodefInitBlogListShortcodePagination().init();
        qodefElementorBlogList();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function qodefOnWindowScroll() {
        qodefInitBlogListShortcodePagination().scroll();
    }

    /**
     * Init blog list shortcode pagination functions
     */
    function qodefInitBlogListShortcodePagination(){
        var holder = $('.qodef-blog-list-holder');

        var initStandardPagination = function(thisHolder) {
            var standardLink = thisHolder.find('.qodef-bl-standard-pagination li');

            if(standardLink.length) {
                standardLink.each(function(){
                    var thisLink = $(this).children('a'),
                        pagedLink = 1;

                    thisLink.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
                            pagedLink = thisLink.data('paged');
                        }

                        initMainPagFunctionality(thisHolder, pagedLink);
                    });
                });
            }
        };

        var initLoadMorePagination = function(thisHolder) {
            var loadMoreButton = thisHolder.find('.qodef-blog-pag-load-more a');

            loadMoreButton.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                initMainPagFunctionality(thisHolder);
            });
        };

        var initInifiteScrollPagination = function(thisHolder) {
            var blogListHeight = thisHolder.outerHeight(),
                blogListTopOffest = thisHolder.offset().top,
                blogListPosition = blogListHeight + blogListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;

            if(!thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > blogListPosition) {
                initMainPagFunctionality(thisHolder);
            }
        };

        var initMainPagFunctionality = function(thisHolder, pagedLink) {
            var thisHolderInner = thisHolder.find('.qodef-blog-list'),
                nextPage,
                maxNumPages;

            if (typeof thisHolder.data('max-num-pages') !== 'undefined' && thisHolder.data('max-num-pages') !== false) {
                maxNumPages = thisHolder.data('max-num-pages');
            }

            if(thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                thisHolder.data('next-page', pagedLink);
            }

            if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
                thisHolder.addClass('qodef-bl-pag-infinite-scroll-started');
            }

            var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisHolder),
                loadingItem = thisHolder.find('.qodef-blog-pag-loading');

            nextPage = loadMoreDatta.nextPage;
    
            var nonceHolder = thisHolder.find('input[name*="qodef_blog_load_more_nonce_"]');
           
            loadMoreDatta.blog_load_more_id = nonceHolder.attr('name').substring(nonceHolder.attr('name').length - 4, nonceHolder.attr('name').length);
            loadMoreDatta.blog_load_more_nonce = nonceHolder.val();
          
            if(nextPage <= maxNumPages){
                if(thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                    loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
                    thisHolder.addClass('qodef-bl-pag-standard-shortcodes-animate');
                } else {
                    loadingItem.addClass('qodef-showing');
                }

                var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'struktur_select_blog_shortcode_load_more');

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: qodefGlobalVars.vars.qodefAjaxUrl,
                    success: function (data) {
                        if(!thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                            nextPage++;
                        }

                        thisHolder.data('next-page', nextPage);

                        var response = $.parseJSON(data),
                            responseHtml =  response.html;

                        if(thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                            qodefInitStandardPaginationLinkChanges(thisHolder, maxNumPages, nextPage);

                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('qodef-bl-masonry')){
                                    qodefInitHtmlIsotopeNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    qodefInitHtmlGalleryNewContent(thisHolder, thisHolderInner, loadingItem, responseHtml);

                                    if (typeof qodef.modules.common.qodefStickySidebarWidget === 'function') {
                                        qodef.modules.common.qodefStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        } else {
                            thisHolder.waitForImages(function(){
                                if(thisHolder.hasClass('qodef-bl-masonry')){
                                    qodefInitAppendIsotopeNewContent(thisHolderInner, loadingItem, responseHtml);
                                } else {
                                    qodefInitAppendGalleryNewContent(thisHolderInner, loadingItem, responseHtml);

                                    if (typeof qodef.modules.common.qodefStickySidebarWidget === 'function') {
                                        qodef.modules.common.qodefStickySidebarWidget().reInit();
                                    }
                                }
                            });
                        }

                        if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll-started')) {
                            thisHolder.removeClass('qodef-bl-pag-infinite-scroll-started');
                        }
                    }
                });
            }

            if(nextPage === maxNumPages){
                thisHolder.find('.qodef-blog-pag-load-more').hide();
            }
        };

        var qodefInitStandardPaginationLinkChanges = function(thisHolder, maxNumPages, nextPage) {
            var standardPagHolder = thisHolder.find('.qodef-bl-standard-pagination'),
                standardPagNumericItem = standardPagHolder.find('li.qodef-pag-number'),
                standardPagPrevItem = standardPagHolder.find('li.qodef-pag-prev a'),
                standardPagNextItem = standardPagHolder.find('li.qodef-pag-next a');

            standardPagNumericItem.removeClass('qodef-pag-active');
            standardPagNumericItem.eq(nextPage-1).addClass('qodef-pag-active');

            standardPagPrevItem.data('paged', nextPage-1);
            standardPagNextItem.data('paged', nextPage+1);

            if(nextPage > 1) {
                standardPagPrevItem.css({'opacity': '1'});
            } else {
                standardPagPrevItem.css({'opacity': '0'});
            }

            if(nextPage === maxNumPages) {
                standardPagNextItem.css({'opacity': '0'});
            } else {
                standardPagNextItem.css({'opacity': '1'});
            }
        };

        var qodefInitHtmlIsotopeNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            var sizerAndGutterHTML = '';
            if(thisHolderInner.children('[class*="-grid-sizer"]').length) {
                sizerAndGutterHTML += thisHolderInner.children('[class*="-grid-sizer"]')[0].outerHTML;
            }
            if(thisHolderInner.children('[class*="-grid-gutter"]').length) {
                sizerAndGutterHTML += thisHolderInner.children('[class*="-grid-gutter"]')[0].outerHTML;
            }
            
            thisHolderInner.html(sizerAndGutterHTML + responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
            thisHolder.removeClass('qodef-bl-pag-standard-shortcodes-animate');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof qodef.modules.common.qodefStickySidebarWidget === 'function') {
                    qodef.modules.common.qodefStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var qodefInitHtmlGalleryNewContent = function(thisHolder, thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
            thisHolder.removeClass('qodef-bl-pag-standard-shortcodes-animate');
            thisHolderInner.html(responseHtml);
        };

        var qodefInitAppendIsotopeNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            thisHolderInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
            loadingItem.removeClass('qodef-showing');

            setTimeout(function() {
                thisHolderInner.isotope('layout');

                if (typeof qodef.modules.common.qodefStickySidebarWidget === 'function') {
                    qodef.modules.common.qodefStickySidebarWidget().reInit();
                }
            }, 600);
        };

        var qodefInitAppendGalleryNewContent = function(thisHolderInner, loadingItem, responseHtml) {
            loadingItem.removeClass('qodef-showing');
            thisHolderInner.append(responseHtml);
        };

        return {
            init: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('qodef-bl-pag-standard-shortcodes')) {
                            initStandardPagination(thisHolder);
                        }

                        if(thisHolder.hasClass('qodef-bl-pag-load-more')) {
                            initLoadMorePagination(thisHolder);
                        }

                        if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            },
            scroll: function() {
                if(holder.length) {
                    holder.each(function() {
                        var thisHolder = $(this);

                        if(thisHolder.hasClass('qodef-bl-pag-infinite-scroll')) {
                            initInifiteScrollPagination(thisHolder);
                        }
                    });
                }
            }
        };
    }

    /**
     * Elementor
     */
    function qodefElementorBlogList(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_blog_list.default', function() {
                qodefInitBlogListShortcodePagination().init();
            } );
        });
    }

})(jQuery);
(function($) {
    "use strict";

    var headerMinimal = {};
    qodef.modules.headerMinimal = headerMinimal;
	
	headerMinimal.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefFullscreenMenu();
    }

    /**
     * Init Fullscreen Menu
     */
    function qodefFullscreenMenu() {
	    var popupMenuOpener = $( 'a.qodef-fullscreen-menu-opener');
	    
        if (popupMenuOpener.length) {
            var popupMenuHolderOuter = $(".qodef-fullscreen-menu-holder-outer"),
                cssClass,
            //Flags for type of animation
                fadeRight = false,
                fadeTop = false,
            //Widgets
                widgetAboveNav = $('.qodef-fullscreen-above-menu-widget-holder'),
                widgetBelowNav = $('.qodef-fullscreen-below-menu-widget-holder'),
            //Menu
                menuItems = $('.qodef-fullscreen-menu-holder-outer nav > ul > li > a'),
                menuItemWithChild =  $('.qodef-fullscreen-menu > ul li.has_sub > a'),
                menuItemWithoutChild = $('.qodef-fullscreen-menu ul li:not(.has_sub) a');

            //set height of popup holder and initialize perfectScrollbar
            qodef.modules.common.qodefInitPerfectScrollbar().init(popupMenuHolderOuter);

            //set height of popup holder on resize
            $(window).resize(function() {
                popupMenuHolderOuter.height(qodef.windowHeight);
            });

            if (qodef.body.hasClass('qodef-fade-push-text-right')) {
                cssClass = 'qodef-push-nav-right';
                fadeRight = true;
            } else if (qodef.body.hasClass('qodef-fade-push-text-top')) {
                cssClass = 'qodef-push-text-top';
                fadeTop = true;
            }

            //Appearing animation
            if (fadeRight || fadeTop) {
                if (widgetAboveNav.length) {
                    widgetAboveNav.children().css({
                        '-webkit-animation-delay' : 0 + 'ms',
                        '-moz-animation-delay' : 0 + 'ms',
                        'animation-delay' : 0 + 'ms'
                    });
                }
                menuItems.each(function(i) {
                    $(this).css({
                        '-webkit-animation-delay': (i+1) * 70 + 'ms',
                        '-moz-animation-delay': (i+1) * 70 + 'ms',
                        'animation-delay': (i+1) * 70 + 'ms'
                    });
                });
                if (widgetBelowNav.length) {
                    widgetBelowNav.children().css({
                        '-webkit-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        '-moz-animation-delay' : (menuItems.length + 1)*70 + 'ms',
                        'animation-delay' : (menuItems.length + 1)*70 + 'ms'
                    });
                }
            }

            // Open popup menu
            popupMenuOpener.on('click',function(e){
                e.preventDefault();

                if (!popupMenuOpener.hasClass('qodef-fm-opened')) {
                    popupMenuOpener.addClass('qodef-fm-opened');
                    qodef.body.removeClass('qodef-fullscreen-fade-out').addClass('qodef-fullscreen-menu-opened qodef-fullscreen-fade-in');
                    qodef.body.removeClass(cssClass);
                    qodef.modules.common.qodefDisableScroll();
                    
                    $(document).keyup(function(e){
                        if (e.keyCode === 27 ) {
                            popupMenuOpener.removeClass('qodef-fm-opened');
                            qodef.body.removeClass('qodef-fullscreen-menu-opened qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                            qodef.body.addClass(cssClass);
                            qodef.modules.common.qodefEnableScroll();

                            $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200);
                        }
                    });
                } else {
                    popupMenuOpener.removeClass('qodef-fm-opened');
                    qodef.body.removeClass('qodef-fullscreen-menu-opened qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                    qodef.body.addClass(cssClass);
                    qodef.modules.common.qodefEnableScroll();

                    $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200);
                }
            });

            //logic for open sub menus in popup menu
            menuItemWithChild.on('tap click', function(e) {
                e.preventDefault();

                var thisItem = $(this),
	                thisItemParent = thisItem.parent(),
					thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');

                if (thisItemParent.hasClass('has_sub')) {
	                var submenu = thisItemParent.find('> ul.sub_menu');
	
	                if (submenu.is(':visible')) {
		                submenu.slideUp(450, 'easeInOutQuint');
		                thisItemParent.removeClass('open_sub');
	                } else {
		                thisItemParent.addClass('open_sub');
		
		                if(thisItemParentSiblingsWithDrop.length === 0) {
			                submenu.slideDown(400, 'easeInOutQuint');
		                } else {
							thisItemParent.closest('li.menu-item').siblings().find('.menu-item').removeClass('open_sub');
			                thisItemParent.siblings().removeClass('open_sub').find('.sub_menu').slideUp(400, 'easeInOutQuint', function() {
				                submenu.slideDown(400, 'easeInOutQuint');
			                });
		                }
	                }
                }
                
                return false;
            });

            //if link has no submenu and if it's not dead, than open that link
            menuItemWithoutChild.on('click', function (e) {
                if(($(this).attr('href') !== "http://#") && ($(this).attr('href') !== "#")){
                    if (e.which === 1) {
                        popupMenuOpener.removeClass('qodef-fm-opened');
                        qodef.body.removeClass('qodef-fullscreen-menu-opened');
                        qodef.body.removeClass('qodef-fullscreen-fade-in').addClass('qodef-fullscreen-fade-out');
                        qodef.body.addClass(cssClass);
                        $("nav.qodef-fullscreen-menu ul.sub_menu").slideUp(200);
                        qodef.modules.common.qodefEnableScroll();
                    }
                } else {
                    return false;
                }
            });
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var headerVerticalSliding = {};
    qodef.modules.headerVerticalSliding = headerVerticalSliding;
	
	headerVerticalSliding.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefVerticalSlidingMenu().init();
    }

    /**
     * Function object that represents vertical menu area.
     * @returns {{init: Function}}
     */
    var qodefVerticalSlidingMenu = function() {
	    var verticalMenuObject = $('.qodef-header-vertical-sliding .qodef-vertical-menu-area');
	
	    var initNavigation = function () {
		    var varticalMenuOpener = verticalMenuObject.find('.qodef-vertical-menu-opener a'),
			    verticalMenuNavHolder = verticalMenuObject.find('.qodef-vertical-menu-nav-holder-outer'),
			    menuItemWithChild = verticalMenuObject.find('.qodef-fullscreen-menu > ul li.has_sub > a'),
			    menuItemWithoutChild = verticalMenuObject.find('.qodef-fullscreen-menu ul li:not(.has_sub) a'),
			    leftContentHolder = verticalMenuObject.find('.qodef-vertical-menu-holder');
		    
		    //set height of vertical menu holder and initialize perfectScrollbar
		    verticalMenuNavHolder.height(qodef.windowHeight);
            qodef.modules.common.qodefInitPerfectScrollbar().init(verticalMenuNavHolder);
		
		    //set height of vertical menu holder on resize
		    $(window).resize(function () {
			    verticalMenuNavHolder.height(qodef.windowHeight);
		    });
		
		    varticalMenuOpener.on('click', function (e) {
			    e.preventDefault();
			
			    if (!verticalMenuNavHolder.hasClass('active')) {
				    verticalMenuNavHolder.addClass('active');
				    verticalMenuObject.addClass('opened');
				    if (!qodef.body.hasClass('page-template-full_screen-php')) {
					    qodef.modules.common.qodefDisableScroll();
				    }
				    verticalMenuObject.css('width', '50%');
				    leftContentHolder.css({left: 'calc(100% - 85px)'});
				    
				    
			    } else {
				    verticalMenuNavHolder.removeClass('active');
				    verticalMenuObject.removeClass('opened');
				    if (!qodef.body.hasClass('page-template-full_screen-php')) {
					    qodef.modules.common.qodefEnableScroll();
				    }
				    verticalMenuObject.css('width', '85px');
				    leftContentHolder.css({left: '0'});
			    }
		    });
		
		    $('.qodef-content').on('click', function () {
			    if (verticalMenuNavHolder.hasClass('active')) {
				    verticalMenuNavHolder.removeClass('active');
				    verticalMenuObject.removeClass('opened');
				    if (!qodef.body.hasClass('page-template-full_screen-php')) {
					    qodef.modules.common.qodefEnableScroll();
				    }
				    verticalMenuObject.css('width', '85px');
				    leftContentHolder.css({left: '0'});
			    }
		    });
		
		    //logic for open sub menus in popup menu
		    menuItemWithChild.on('tap click', function (e) {
			    e.preventDefault();
			
			    if ($(this).parent().hasClass('has_sub')) {
				    var submenu = $(this).parent().find('> ul.sub_menu');
				    
				    if (submenu.is(':visible')) {
					    submenu.slideUp(200);
					    $(this).parent().removeClass('open_sub');
				    } else {
					    if ($(this).parent().siblings().hasClass('open_sub')) {
						    $(this).parent().siblings().each(function () {
							    var sibling = $(this);
							    if (sibling.hasClass('open_sub')) {
								    var openedUl = sibling.find('> ul.sub_menu');
								    openedUl.slideUp(200);
								    sibling.removeClass('open_sub');
							    }
							    if (sibling.find('.open_sub')) {
								    var openedUlUl = sibling.find('.open_sub').find('> ul.sub_menu');
								    openedUlUl.slideUp(200);
								    sibling.find('.open_sub').removeClass('open_sub');
							    }
						    });
					    }
					
					    $(this).parent().addClass('open_sub');
					    submenu.slideDown(200);
				    }
			    }
			    return false;
		    });
		
	    };
	
	    return {
		    /**
		     * Calls all necessary functionality for vertical menu area if vertical area object is valid
		     */
		    init: function () {
			    if (verticalMenuObject.length) {
				    initNavigation();
				
			    }
		    }
	    };
    };

})(jQuery);
(function ($) {
	"use strict";
	
	var mobileHeader = {};
	qodef.modules.mobileHeader = mobileHeader;
	
	mobileHeader.qodefOnDocumentReady = qodefOnDocumentReady;
	mobileHeader.qodefOnWindowResize = qodefOnWindowResize;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).resize(qodefOnWindowResize);
	
	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function qodefOnDocumentReady() {
		qodefInitMobileNavigation();
		qodefInitMobileNavigationScroll();
		qodefMobileHeaderBehavior();
	}
	
	/*
        All functions to be called on $(window).resize() should be in this function
    */
	function qodefOnWindowResize() {
		qodefInitMobileNavigationScroll();
	}
	
	function qodefInitMobileNavigation() {
		var navigationOpener = $('.qodef-mobile-header .qodef-mobile-menu-opener'),
			navigationHolder = $('.qodef-mobile-header .qodef-mobile-nav'),
			dropdownOpener = $('.qodef-mobile-nav .mobile_arrow, .qodef-mobile-nav h6, .qodef-mobile-nav a.qodef-mobile-no-link');
		
		//whole mobile menu opening / closing
		if (navigationOpener.length && navigationHolder.length) {
			navigationOpener.on('tap click', function (e) {
				e.stopPropagation();
				e.preventDefault();
				
				if (navigationHolder.is(':visible')) {
					navigationHolder.slideUp(450, 'easeInOutQuint');
					navigationOpener.removeClass('qodef-mobile-menu-opened');
				} else {
					navigationHolder.slideDown(450, 'easeInOutQuint');
					navigationOpener.addClass('qodef-mobile-menu-opened');
				}
			});
		}
		
		//dropdown opening / closing
		if (dropdownOpener.length) {
			dropdownOpener.each(function () {
				var thisItem = $(this),
					initialNavHeight = navigationHolder.outerHeight();
				
				thisItem.on('tap click', function (e) {
					var thisItemParent = thisItem.parent('li'),
						thisItemParentSiblingsWithDrop = thisItemParent.siblings('.menu-item-has-children');
					
					if (thisItemParent.hasClass('has_sub')) {
						var submenu = thisItemParent.find('> ul.sub_menu');
						
						if (submenu.is(':visible')) {
							submenu.slideUp(450, 'easeInOutQuint');
							thisItemParent.removeClass('qodef-opened');
							navigationHolder.stop().animate({'height': initialNavHeight}, 300);
						} else {
							thisItemParent.addClass('qodef-opened');
							
							if (thisItemParentSiblingsWithDrop.length === 0) {
								thisItemParent.find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
									navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
								});
							} else {
								thisItemParent.siblings().removeClass('qodef-opened').find('.sub_menu').slideUp(400, 'easeInOutQuint', function () {
									submenu.slideDown(400, 'easeInOutQuint');
									navigationHolder.stop().animate({'height': initialNavHeight + 50}, 300);
								});
							}
						}
					}
				});
			});
		}
		
		$('.qodef-mobile-nav a, .qodef-mobile-logo-wrapper a').on('click tap', function (e) {
			if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
				navigationHolder.slideUp(450, 'easeInOutQuint');
				navigationOpener.removeClass("qodef-mobile-menu-opened");
			}
		});
	}
	
	function qodefInitMobileNavigationScroll() {
		if (qodef.windowWidth <= 1024) {
			var mobileHeader = $('.qodef-mobile-header'),
				mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0,
				navigationHolder = mobileHeader.find('.qodef-mobile-nav'),
				navigationHeight = navigationHolder.outerHeight(),
				windowHeight = qodef.windowHeight - 100;
			
			//init scrollable menu
			var scrollHeight = mobileHeaderHeight + navigationHeight > windowHeight ? windowHeight - mobileHeaderHeight : navigationHeight;

            // in case if mobile header exists on specific page
            if(navigationHolder.length) {
                navigationHolder.height(scrollHeight);
                qodef.modules.common.qodefInitPerfectScrollbar().init(navigationHolder);
            }
		}
	}
	
	function qodefMobileHeaderBehavior() {
		var mobileHeader = $('.qodef-mobile-header'),
			mobileMenuOpener = mobileHeader.find('.qodef-mobile-menu-opener'),
			mobileHeaderHeight = mobileHeader.length ? mobileHeader.outerHeight() : 0;
		
		if (qodef.body.hasClass('qodef-content-is-behind-header') && mobileHeaderHeight > 0 && qodef.windowWidth <= 1024) {
			$('.qodef-content').css('marginTop', -mobileHeaderHeight);
		}
		
		if (qodef.body.hasClass('qodef-sticky-up-mobile-header')) {
			var stickyAppearAmount,
				adminBar = $('#wpadminbar');
			
			var docYScroll1 = $(document).scrollTop();
			stickyAppearAmount = mobileHeaderHeight + qodefGlobalVars.vars.qodefAddForAdminBar;
			
			$(window).scroll(function () {
				var docYScroll2 = $(document).scrollTop();
				
				if (docYScroll2 > stickyAppearAmount) {
					mobileHeader.addClass('qodef-animate-mobile-header');
				} else {
					mobileHeader.removeClass('qodef-animate-mobile-header');
				}
				
				if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount && !mobileMenuOpener.hasClass('qodef-mobile-menu-opened')) || (docYScroll2 < stickyAppearAmount)) {
					mobileHeader.removeClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', 0);
					
					if (adminBar.length) {
						mobileHeader.find('.qodef-mobile-header-inner').css('top', 0);
					}
				} else {
					mobileHeader.addClass('mobile-header-appear');
					mobileHeader.css('margin-bottom', stickyAppearAmount);
				}
				
				docYScroll1 = $(document).scrollTop();
			});
		}
	}
	
})(jQuery);
(function($) {
    "use strict";

    var stickyHeader = {};
    qodef.modules.stickyHeader = stickyHeader;
	
	stickyHeader.isStickyVisible = false;
	stickyHeader.stickyAppearAmount = 0;
	stickyHeader.behaviour = '';
	
	stickyHeader.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    if(qodef.windowWidth > 1024) {
		    qodefHeaderBehaviour();
	    }
    }

    /*
     **	Show/Hide sticky header on window scroll
     */
    function qodefHeaderBehaviour() {
        var header = $('.qodef-page-header'),
	        stickyHeader = $('.qodef-sticky-header'),
            fixedHeaderWrapper = $('.qodef-fixed-wrapper'),
	        fixedMenuArea = fixedHeaderWrapper.children('.qodef-menu-area'),
	        fixedMenuAreaHeight = fixedMenuArea.outerHeight(),
            sliderHolder = $('.qodef-slider'),
            revSliderHeight = sliderHolder.length ? sliderHolder.outerHeight() : 0,
	        stickyAppearAmount,
	        headerAppear;
        
        var headerMenuAreaOffset = fixedHeaderWrapper.length ? fixedHeaderWrapper.offset().top - qodefGlobalVars.vars.qodefAddForAdminBar : 0;

        switch(true) {
            // sticky header that will be shown when user scrolls up
            case qodef.body.hasClass('qodef-sticky-header-on-scroll-up'):
                qodef.modules.stickyHeader.behaviour = 'qodef-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = parseInt(qodefGlobalVars.vars.qodefTopBarHeight) + parseInt(qodefGlobalVars.vars.qodefLogoAreaHeight) + parseInt(qodefGlobalVars.vars.qodefMenuAreaHeight) + parseInt(qodefGlobalVars.vars.qodefStickyHeaderHeight);
	            
                headerAppear = function(){
                    var docYScroll2 = $(document).scrollTop();
					
                    if((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        qodef.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.qodef-main-menu .second').removeClass('qodef-drop-down-start');
                        qodef.body.removeClass('qodef-sticky-header-appear');
                    } else {
                        qodef.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    qodef.body.addClass('qodef-sticky-header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case qodef.body.hasClass('qodef-sticky-header-on-scroll-down-up'):
                qodef.modules.stickyHeader.behaviour = 'qodef-sticky-header-on-scroll-down-up';

                if(qodefPerPageVars.vars.qodefStickyScrollAmount !== 0){
                    qodef.modules.stickyHeader.stickyAppearAmount = parseInt(qodefPerPageVars.vars.qodefStickyScrollAmount);
                } else {
                    qodef.modules.stickyHeader.stickyAppearAmount = parseInt(qodefGlobalVars.vars.qodefTopBarHeight) + parseInt(qodefGlobalVars.vars.qodefLogoAreaHeight) + parseInt(qodefGlobalVars.vars.qodefMenuAreaHeight) + parseInt(revSliderHeight);
                }

                headerAppear = function(){
                    if(qodef.scroll < qodef.modules.stickyHeader.stickyAppearAmount) {
                        qodef.modules.stickyHeader.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.qodef-main-menu .second').removeClass('qodef-drop-down-start');
	                    qodef.body.removeClass('qodef-sticky-header-appear');
                    }else{
                        qodef.modules.stickyHeader.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
	                    qodef.body.addClass('qodef-sticky-header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function() {
                    headerAppear();
                });

                break;

            // on scroll down, part of header will be sticky
            case qodef.body.hasClass('qodef-fixed-on-scroll'):
                qodef.modules.stickyHeader.behaviour = 'qodef-fixed-on-scroll';
                var headerFixed = function(){
	
	                if(qodef.scroll <= headerMenuAreaOffset) {
		                fixedHeaderWrapper.removeClass('fixed');
		                qodef.body.removeClass('qodef-fixed-header-appear');
		                header.css('margin-bottom', '0');
	                } else {
		                fixedHeaderWrapper.addClass('fixed');
		                qodef.body.addClass('qodef-fixed-header-appear');
		                header.css('margin-bottom', fixedMenuAreaHeight + 'px');
	                }
                };

                headerFixed();

                $(window).scroll(function() {
                    headerFixed();
                });

                break;
        }
    }

})(jQuery);
(function($) {
    "use strict";

    var searchFullscreen = {};
    qodef.modules.searchFullscreen = searchFullscreen;

    searchFullscreen.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
	    qodefSearchFullscreen();
    }
	
	/**
	 * Init Search Types
	 */
	function qodefSearchFullscreen() {
        if ( qodef.body.hasClass( 'qodef-fullscreen-search' ) ) {

            var searchOpener = $('a.qodef-search-opener');

            if (searchOpener.length > 0) {

                var searchHolder = $('.qodef-fullscreen-search-holder'),
                    searchClose = $('.qodef-search-close');

                searchOpener.on('click', function (e) {
                    e.preventDefault();

                    if (searchHolder.hasClass('qodef-animate')) {
                        qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-out');
                        qodef.body.removeClass('qodef-search-fade-in');
                        searchHolder.removeClass('qodef-animate');

                        setTimeout(function () {
                            searchHolder.find('.qodef-search-field').val('');
                            searchHolder.find('.qodef-search-field').blur();
                        }, 300);

                        qodef.modules.common.qodefEnableScroll();
                    } else {
                        qodef.body.addClass('qodef-fullscreen-search-opened qodef-search-fade-in');
                        qodef.body.removeClass('qodef-search-fade-out');
                        searchHolder.addClass('qodef-animate');

                        setTimeout(function () {
                            searchHolder.find('.qodef-search-field').focus();
                        }, 900);

                        qodef.modules.common.qodefDisableScroll();
                    }

                    searchClose.on('click', function (e) {
                        e.preventDefault();
                        qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-in');
                        qodef.body.addClass('qodef-search-fade-out');
                        searchHolder.removeClass('qodef-animate');

                        setTimeout(function () {
                            searchHolder.find('.qodef-search-field').val('');
                            searchHolder.find('.qodef-search-field').blur();
                        }, 300);

                        qodef.modules.common.qodefEnableScroll();
                    });

                    //Close on click away
                    $(document).mouseup(function (e) {
                        var container = $(".qodef-form-holder-inner");

                        if (!container.is(e.target) && container.has(e.target).length === 0) {
                            e.preventDefault();
                            qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-in');
                            qodef.body.addClass('qodef-search-fade-out');
                            searchHolder.removeClass('qodef-animate');

                            setTimeout(function () {
                                searchHolder.find('.qodef-search-field').val('');
                                searchHolder.find('.qodef-search-field').blur();
                            }, 300);

                            qodef.modules.common.qodefEnableScroll();
                        }
                    });

                    //Close on escape
                    $(document).keyup(function (e) {
                        if (e.keyCode === 27) { //KeyCode for ESC button is 27
                            qodef.body.removeClass('qodef-fullscreen-search-opened qodef-search-fade-in');
                            qodef.body.addClass('qodef-search-fade-out');
                            searchHolder.removeClass('qodef-animate');

                            setTimeout(function () {
                                searchHolder.find('.qodef-search-field').val('');
                                searchHolder.find('.qodef-search-field').blur();
                            }, 300);

                            qodef.modules.common.qodefEnableScroll();
                        }
                    });
                });

                //Text input focus change
                var inputSearchField = $('.qodef-fullscreen-search-holder .qodef-search-field'),
                    inputSearchLine = $('.qodef-fullscreen-search-holder .qodef-field-holder .qodef-line');

                inputSearchField.focus(function () {
                    inputSearchLine.css('width', '100%');
                });

                inputSearchField.blur(function () {
                    inputSearchLine.css('width', '0');
                });
            }
        }
	}

})(jQuery);
