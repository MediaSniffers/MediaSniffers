(function($) {
    'use strict';

    var like = {};
    
    like.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    
    /**
    *  All functions to be called on $(document).ready() should be in this function
    **/
    function qodefOnDocumentReady() {
        qodefLikes();
    }

    function qodefLikes() {
        $(document).on('click','.qodef-like', function() {
            var likeLink = $(this),
                id = likeLink.attr('id'),
                postID = likeLink.data('post-id'),
                type = '';

            if ( likeLink.hasClass('liked') ) {
                return false;
            }

            if (typeof likeLink.data('type') !== 'undefined') {
                type = likeLink.data('type');
            }
    
            var dataToPass = {
                action: 'struktur_core_action_like',
                likes_id: id,
                type: type,
                like_nonce: $('#qodef_like_nonce_'+postID).val()
            };
        
            var like = $.post(qodefGlobalVars.vars.qodefAjaxUrl, dataToPass, function( data ) {
                likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
            });

            return false;
        });
    }
    
})(jQuery);
(function ($) {
	'use strict';
	
	var rating = {};
	qodef.modules.rating = rating;

    rating.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCommentRating();
	}
	
	function qodefInitCommentRating() {
		var ratingHolder = $('.qodef-comment-form-rating');

        var addActive = function (stars, ratingValue) {
            for (var i = 0; i < stars.length; i++) {
                var star = stars[i];
                if (i < ratingValue) {
                    $(star).addClass('active');
                } else {
                    $(star).removeClass('active');
                }
            }
        };

		ratingHolder.each(function() {
		    var thisHolder = $(this),
                ratingInput = thisHolder.find('.qodef-rating'),
                ratingValue = ratingInput.val(),
                stars = thisHolder.find('.qodef-star-rating');

                addActive(stars, ratingValue);

            stars.on('click', function () {
                ratingInput.val($(this).data('value')).trigger('change');
            });

            ratingInput.change(function () {
                ratingValue = ratingInput.val();
                addActive(stars, ratingValue);
            });
        });
	}
	
})(jQuery);
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
(function($) {
    'use strict';
	
	var accordions = {};
	qodef.modules.accordions = accordions;
	
	accordions.qodefInitAccordions = qodefInitAccordions;
	accordions.qodefInitElementorAccordions = qodefInitElementorAccordions;

	
	accordions.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAccordions();
	}

	function qodefOnWindowLoad() {
		qodefInitElementorAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function qodefInitAccordions(){
		var accordion = $('.qodef-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('qodef-accordion')){
					thisAccordion.accordion({
						animate: "swing",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('qodef-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.qodef-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.on('hover', function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

	function qodefInitElementorAccordions(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_accordion.default', function() {
				qodefInitAccordions();
			} );
		});
	}

})(jQuery);
(function ($) {
	'use strict';
	
	var anchorMenu = {};
	qodef.modules.anchorMenu = anchorMenu;
	
	anchorMenu.qodefAnchorMenu = qodefAnchorMenu;
	anchorMenu.qodefElementorAnchorMenu = qodefElementorAnchorMenu;

	
	anchorMenu.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefAnchorMenu();
	}

	function qodefOnWindowLoad() {
		qodefElementorAnchorMenu();
	}
	
	/*
	 *  Anchor Menu relocation
	 */
	function qodefAnchorMenu() {
		var anchorMenu = $('.qodef-anchor-menu');
		
		if (anchorMenu.length && qodef.windowWidth > 1024) {
			anchorMenu.remove();
			$('.qodef-content-inner').append(anchorMenu.addClass('qodef-init'));
			
			//scroll active item logic
			var anchorSections = $('div[data-qodef-anchor]'),
				anchorMenuItems = anchorMenu.find('.qodef-anchor');
			
			if (anchorSections.length && anchorMenuItems.length) {
				anchorMenuItems.first().addClass('qodef-active');
				
				$(window).scroll(function () {
					anchorSections.each(function (i) {
						var anchorSection = $(this),
							anchorSectionTop = anchorSection.offset().top,
							anchorSectionHeight = anchorSection.outerHeight(),
							offset = qodef.windowHeight / 5,
							currentItemIndex = 0;
						
						if ( qodef.scroll === 0 ) {
							anchorMenuItems.removeClass('qodef-active').first().addClass('qodef-active');
						} else if (anchorSectionTop <= qodef.scroll + offset && anchorSectionTop + anchorSectionHeight >= qodef.scroll + offset) {
							if (currentItemIndex !== i) {
								currentItemIndex = i;
								anchorMenuItems.removeClass('qodef-active').eq(i).addClass('qodef-active');
							}
						} else if (qodef.scroll + qodef.windowHeight == qodef.document.height()) {
							anchorMenuItems.removeClass('qodef-active').last().addClass('qodef-active');
						}
					});
				});
			}
		}
	}

	/**
	 * Elementor
	 */
	function qodefElementorAnchorMenu(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/struktur_anchor_menu.default', function() {
				qodefAnchorMenu();
			} );
		});
	}
	
})(jQuery);




(function($) {
	'use strict';
	
	var animationHolder = {};
	qodef.modules.animationHolder = animationHolder;
	
	animationHolder.qodefInitAnimationHolder = qodefInitAnimationHolder;
	
	
	animationHolder.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function qodefInitAnimationHolder(){
		var elements = $('.qodef-grow-in, .qodef-fade-in-down, .qodef-element-from-fade, .qodef-element-from-left, .qodef-element-from-right, .qodef-element-from-top, .qodef-element-from-bottom, .qodef-flip-in, .qodef-x-rotate, .qodef-z-rotate, .qodef-y-translate, .qodef-fade-in, .qodef-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	qodef.modules.button = button;
	
	button.qodefButton = qodefButton;
	
	
	button.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefButton().init();
	}

	function qodefOnWindowLoad() {
		qodefElementorButton();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var qodefButton = function() {
		//all buttons on the page
		var buttons = $('.qodef-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};

	function qodefElementorButton(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_button.default', function() {
				qodefButton().init();
			} );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_call_to_action.default', function() {
				qodefButton().init();
			} );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_section_title.default', function() {
				qodefButton().init();
			} );
		});
	}
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var countdown = {};
	qodef.modules.countdown = countdown;
	
	countdown.qodefInitCountdown = qodefInitCountdown;
	countdown.qodefInitElementorCountdown = qodefInitElementorCountdown;
	
	countdown.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCountdown();
	}

	function qodefOnWindowLoad() {
		qodefInitElementorCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function qodefInitCountdown() {
		var countdowns = $('.qodef-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth !== month ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}

	function qodefInitElementorCountdown(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_countdown.default', function() {
				qodefInitCountdown();
			} );
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	qodef.modules.counter = counter;
	
	counter.qodefInitCounter = qodefInitCounter;
	counter.qodefInitElementorCounter = qodefInitElementorCounter;
	
	counter.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitCounter();
	}

	function qodefOnWindowLoad() {
		qodefInitElementorCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function qodefInitCounter() {
		var counterHolder = $('.qodef-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.qodef-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('qodef-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}

	function qodefInitElementorCounter(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_counter.default', function() {
				qodefInitCounter();
			} );
		});
	}
	
})(jQuery);
(function ($) {
	'use strict';
	
	var customFont = {};
	qodef.modules.customFont = customFont;
	
	customFont.qodefCustomFontResize = qodefCustomFontResize;
	customFont.qodefElementorCustomFontResize = qodefElementorCustomFontResize;
	customFont.qodefCustomFontTypeOut = qodefCustomFontTypeOut;
	customFont.qodefElementorCustomFontTypeOut = qodefElementorCustomFontTypeOut;
	
	
	customFont.qodefOnDocumentReady = qodefOnDocumentReady;
	customFont.qodefOnWindowLoad = qodefOnWindowLoad;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefCustomFontResize();
	}
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnWindowLoad() {
		qodefCustomFontTypeOut();
		qodefElementorCustomFontResize();
		qodefElementorCustomFontTypeOut();
	}
	
	/*
	 **	Custom Font resizing style
	 */
	function qodefCustomFontResize() {
		var holder = $('.qodef-custom-font-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.qodef-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.qodef-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}
	
	/*
	 * Init Type out functionality for Custom Font shortcode
	 */
	function qodefCustomFontTypeOut() {
		var qodefTyped = $('.qodef-cf-typed');
		
		if (qodefTyped.length) {
			qodefTyped.each(function () {
				
				//vars
				var thisTyped = $(this),
					typedWrap = thisTyped.parent('.qodef-cf-typed-wrap'),
					customFontHolder = typedWrap.parent('.qodef-custom-font-holder'),
					str = [],
					string_1 = thisTyped.find('.qodef-cf-typed-1').text(),
					string_2 = thisTyped.find('.qodef-cf-typed-2').text(),
					string_3 = thisTyped.find('.qodef-cf-typed-3').text(),
					string_4 = thisTyped.find('.qodef-cf-typed-4').text();
				
				if (string_1.length) {
					str.push(string_1);
				}
				
				if (string_2.length) {
					str.push(string_2);
				}
				
				if (string_3.length) {
					str.push(string_3);
				}
				
				if (string_4.length) {
					str.push(string_4);
				}
				
				customFontHolder.appear(function () {
					thisTyped.typed({
						strings: str,
						typeSpeed: 90,
						backDelay: 700,
						loop: true,
						contentType: 'text',
						loopCount: false,
						cursorChar: '_'
					});
				}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}

	function qodefElementorCustomFontResize(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_custom_font.default', function() {
				qodefCustomFontResize();
			} );
		});
	}

	function qodefElementorCustomFontTypeOut(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_custom_font.default', function() {
				qodefCustomFontTypeOut();
			} );
		});
	}
	
})(jQuery);
(function($) {
	'use strict';

	var elementsHolder = {};
	qodef.modules.elementsHolder = elementsHolder;

	elementsHolder.qodefInitElementsHolderResponsiveStyle = qodefInitElementsHolderResponsiveStyle;


	elementsHolder.qodefOnDocumentReady = qodefOnDocumentReady;

	$(document).ready(qodefOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitElementsHolderResponsiveStyle();
	}

	/*
	 **	Elements Holder responsive style
	 */
	function qodefInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.qodef-elements-holder');

		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.qodef-eh-item'),
					style = '',
					responsiveStyle = '';

				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';

					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1400-1600') !== 'undefined' && thisItem.data('1400-1600') !== false) {
                        largeLaptop = thisItem.data('1400-1600');
					}
					if (typeof thisItem.data('1025-1399') !== 'undefined' && thisItem.data('1025-1399') !== false) {
						smallLaptop = thisItem.data('1025-1399');
					}
					if (typeof thisItem.data('769-1024') !== 'undefined' && thisItem.data('769-1024') !== false) {
						ipadLandscape = thisItem.data('769-1024');
					}
					if (typeof thisItem.data('681-768') !== 'undefined' && thisItem.data('681-768') !== false) {
						ipadPortrait = thisItem.data('681-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}

					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1400px) and (max-width: 1600px) {.qodef-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1399px) {.qodef-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.qodef-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}

                    if (typeof qodef.modules.common.qodefOwlSlider === "function") { // if owl function exist
                        var owl = thisItem.find('.qodef-owl-slider');
                        if (owl.length) { // if owl is in elements holder
                            setTimeout(function () {
                                owl.trigger('refresh.owl.carousel'); // reinit owl
                            }, 100);
                        }
                    }

				});

				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}

				if(style.length) {
					$('head').append(style);
				}

			});
		}
	}

})(jQuery);
(function($) {
	'use strict';

	var fullScreenSections = {};
	qodef.modules.fullScreenSections = fullScreenSections;

	fullScreenSections.qodefInitFullScreenSections = qodefInitFullScreenSections;


	fullScreenSections.qodefOnDocumentReady = qodefOnDocumentReady;

	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitFullScreenSections();
	}

	function qodefOnWindowLoad() {
		qodefInitElemenorFullScreenSections();
	}

	/*
	 **	Init full screen sections shortcode
	 */
	function qodefInitFullScreenSections(){
		var fullScreenSections = $('.qodef-full-screen-sections');

		if(fullScreenSections.length){
			fullScreenSections.each(function() {
				var thisFullScreenSections = $(this),
					fullScreenSectionsWrapper = thisFullScreenSections.children('.qodef-fss-wrapper'),
					fullScreenSectionsItems = fullScreenSectionsWrapper.children('.qodef-fss-item'),
					fullScreenSectionsItemsNumber = fullScreenSectionsItems.length,
					fullScreenSectionsItemsHasHeaderStyle = fullScreenSectionsItems.hasClass('qodef-fss-item-has-style'),
					enableContinuousVertical = false,
					enableNavigationData = '',
					enablePaginationData = '';

				var defaultHeaderStyle = '';
				if (qodef.body.hasClass('qodef-light-header')) {
					defaultHeaderStyle = 'light';
				} else if (qodef.body.hasClass('qodef-dark-header')) {
					defaultHeaderStyle = 'dark';
				}

				if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
					enableContinuousVertical = true;
				}
				if (typeof thisFullScreenSections.data('enable-navigation') !== 'undefined' && thisFullScreenSections.data('enable-navigation') !== false) {
					enableNavigationData = thisFullScreenSections.data('enable-navigation');
				}
				if (typeof thisFullScreenSections.data('enable-pagination') !== 'undefined' && thisFullScreenSections.data('enable-pagination') !== false) {
					enablePaginationData = thisFullScreenSections.data('enable-pagination');
				}

				var enableNavigation = enableNavigationData !== 'no',
					enablePagination = enablePaginationData !== 'no';

				fullScreenSectionsWrapper.fullpage({
					sectionSelector: '.qodef-fss-item',
					scrollingSpeed: 1200,
					verticalCentered: false,
					continuousVertical: enableContinuousVertical,
					navigation: enablePagination,
					onLeave: function(index, nextIndex, direction){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle($(fullScreenSectionsItems[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
						}

						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, nextIndex);
						}
					},
					afterRender: function(){
						if(fullScreenSectionsItemsHasHeaderStyle) {
							checkFullScreenSectionsItemForHeaderStyle(fullScreenSectionsItems.first().data('header-style'), defaultHeaderStyle);
						}

						if(enableNavigation) {
							checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, 1);
							thisFullScreenSections.children('.qodef-fss-nav-holder').css('visibility','visible');
						}

						fullScreenSectionsWrapper.css('visibility','visible');
					}
				});

				setResposniveData(thisFullScreenSections);

				if(enableNavigation) {
					thisFullScreenSections.find('#qodef-fss-nav-up').on('click', function() {
						$.fn.fullpage.moveSectionUp();
						return false;
					});

					thisFullScreenSections.find('#qodef-fss-nav-down').on('click', function() {
						$.fn.fullpage.moveSectionDown();
						return false;
					});
				}
			});
		}
	}

	function checkFullScreenSectionsItemForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			qodef.body.removeClass('qodef-light-header qodef-dark-header').addClass('qodef-' + default_header_style + '-header');
		} else {
			qodef.body.removeClass('qodef-light-header qodef-dark-header');
		}
	}

	function checkActiveArrowsOnFullScrrenTemplate(thisFullScreenSections, fullScreenSectionsItemsNumber, index){
		var thisHolder = thisFullScreenSections,
			thisHolderArrowsUp = thisHolder.find('#qodef-fss-nav-up'),
			thisHolderArrowsDown = thisHolder.find('#qodef-fss-nav-down'),
			enableContinuousVertical = false;

		if (typeof thisFullScreenSections.data('enable-continuous-vertical') !== 'undefined' && thisFullScreenSections.data('enable-continuous-vertical') !== false && thisFullScreenSections.data('enable-continuous-vertical') === 'yes') {
			enableContinuousVertical = true;
		}

		if (index === 1 && !enableContinuousVertical) {
			thisHolderArrowsUp.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});

			if(index !== fullScreenSectionsItemsNumber){
				thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else if (index === fullScreenSectionsItemsNumber && !enableContinuousVertical) {
			thisHolderArrowsDown.css({'opacity': '0', 'height': '0', 'visibility': 'hidden'});

			if(fullScreenSectionsItemsNumber === 2){
				thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			}
		} else {
			thisHolderArrowsUp.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
			thisHolderArrowsDown.css({'opacity': '1', 'height': 'auto', 'visibility': 'visible'});
		}
	}

	function setResposniveData(thisFullScreenSections) {
		var fullScreenSections = thisFullScreenSections.find('.qodef-fss-item'),
			responsiveStyle = '',
			style = '';

		fullScreenSections.each(function(){
			var thisSection = $(this),
				itemClass = '',
				imageLaptop = '',
				imageTablet = '',
				imagePortraitTablet = '',
				imageMobile = '';

			if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
				itemClass = thisSection.data('item-class');
			}
			if (typeof thisSection.data('laptop-image') !== 'undefined' && thisSection.data('laptop-image') !== false) {
				imageLaptop = thisSection.data('laptop-image');
			}
			if (typeof thisSection.data('tablet-image') !== 'undefined' && thisSection.data('tablet-image') !== false) {
				imageTablet = thisSection.data('tablet-image');
			}
			if (typeof thisSection.data('tablet-portrait-image') !== 'undefined' && thisSection.data('tablet-portrait-image') !== false) {
				imagePortraitTablet = thisSection.data('tablet-portrait-image');
			}
			if (typeof thisSection.data('mobile-image') !== 'undefined' && thisSection.data('mobile-image') !== false) {
				imageMobile = thisSection.data('mobile-image');
			}

			if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {

				if (imageLaptop.length) {
					responsiveStyle += "@media only screen and (max-width: 1366px) {.qodef-fss-item." + itemClass + " { background-image: url(" + imageLaptop + ") !important; } }";
				}
				if (imageTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-fss-item." + itemClass + " { background-image: url( " + imageTablet + ") !important; } }";
				}
				if (imagePortraitTablet.length) {
					responsiveStyle += "@media only screen and (max-width: 800px) {.qodef-fss-item." + itemClass + " { background-image: url( " + imagePortraitTablet + ") !important; } }";
				}
				if (imageMobile.length) {
					responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-fss-item." + itemClass + " { background-image: url( " + imageMobile + ") !important; } }";
				}
			}
		});

		if (responsiveStyle.length) {
			style = '<style type="text/css">' + responsiveStyle + '</style>';
		}

		if (style.length) {
			$('head').append(style);
		}
	}

	function qodefInitElemenorFullScreenSections(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_full_screen_sections.default', function() {
				qodefInitFullScreenSections();
			} );
		});
	}

})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	qodef.modules.googleMap = googleMap;
	
	googleMap.qodefShowGoogleMap = qodefShowGoogleMap;
	googleMap.qodefShowElementorGoogleMap = qodefShowElementorGoogleMap;
	
	googleMap.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefShowGoogleMap();
	}

	function qodefOnWindowLoad() {
		qodefShowElementorGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function qodefShowGoogleMap(){
		var googleMap = $('.qodef-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.qodef-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "qodef-map-"+ uniqueId;
				
				qodefInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function qodefInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'qodef-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qodef-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('qodef-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			qodefInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function qodefInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}

	function qodefShowElementorGoogleMap(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_google_map.default', function() {
				qodefShowGoogleMap();
			} );
		});
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var horizontalLayout = {};
    qodef.modules.horizontalLayout = horizontalLayout;

    horizontalLayout.qodefHorizontalLayout = qodefHorizontalLayout;
    horizontalLayout.qodefOnDocumentReady = qodefOnDocumentReady;
    horizontalLayout.qodefElementorHorizontalLayout = qodefElementorHorizontalLayout;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefHorizontalLayout().init();
    }

    function qodefOnWindowLoad() {
        qodefElementorHorizontalLayout();
    }

    /**
     * Init Horizontal Layout Shortcode
     */
    function qodefHorizontalLayout() {
        var $wrapper = $('.qodef-hl-items-wrapper'),
            $items = $('.qodef-hl-item'),
            $scrollArea = $('#qodef-hl-scroll-area'),
            $tops = $('.qodef-hli-top'),
            $mids = $('.qodef-hli-mid'),
            $btms = $('.qodef-hli-btm'),
            $cta = $('.qodef-hl-cta'),
            numOfItems = $items.length,
            btmOffset = 0,
            reverted = false,
            ctaW,
            speed = 100; //vh per item

        var c, w, offset, wrapperW,
            sX = 0,
            dX = 0;

        //trigger calculations
        var calc = function () {
            reset();
            setVars();
            setBottom();
            setX();
            setPositions();
        }

        //variables for calculation
        var setVars = function () {
            c = $('.qodef-vertical-menu-area').length && window.innerWidth > 1024 ? $('.qodef-vertical-menu-area').width() : 0;
            w = window.innerWidth > 1024 ? 372 : window.innerWidth;
            offset = window.innerWidth > 1024 ? window.innerWidth / 2 : window.innerWidth;
            ctaW = $cta.outerWidth();
            wrapperW = (numOfItems - 1) * w + offset + ctaW;
        }
        
        //position bottom media element below the longest text el.
        var setBottom = function () {
            btmOffset = 0;

            $mids.each(function () {
                if ($(this).outerHeight(true) > btmOffset) btmOffset = $(this).outerHeight(true);
            })

            $btms.height((1 - (btmOffset + $tops.first().height()) / window.innerHeight) * 100 + 'vh')
        }

        //calc next x value based on scroll position
        var setX = function () {
            sX = 1 - (qodef.scroll) / (parseFloat($scrollArea.height()) - window.innerHeight);
        }

        //position items incrementally to the right
        var setPositions = function () {
            $items.each(function (i) {
                $(this).css('right', (numOfItems - i - 1) * w + ctaW);
            });
        }

        //animate rAF
        var animate = function ($active) {
            reverted = false;
            var val = Math.min(parseFloat((1 - ($active.offset().left - c) / (offset - c)).toFixed(4)), 1); //0-1

            //prev
            $active.prevAll('.qodef-hl-item').css({
                'transform': 'translate3d(-' + (offset - w) * val + 'px, 0, 0)',
                'width': offset + 'px'
            });
            $active.prevAll().find('.qodef-hli-btm-inner').height('100%');
            //active
            $active.css({
                'transform': 'translate3d(0, 0, 0)',
                'width': w + (offset - w) * val + 'px'
            });
            $active.find('.qodef-hli-btm-inner').height(Math.min(Math.max((50 + val * 50), 50), 100) + '%');
            //next
            $active.next('.qodef-hl-item').css({
                'transform': 'translate3d(0, 0, 0)',
                'width': w + 'px'
            });
            $active.nextAll().find('.qodef-hli-btm-inner').height('50%');
        }

        //reset values
        var reset = function () {
            reverted = true;

            $items.css('transform', 'translate3d(0, 0, 0)');
            $items.not(':first-child').width(w);
            $items.not(':first-child').find('.qodef-hli-btm-inner').height('50%');
        }

        //set active item if in between 0 and offset values
        var setActive = function () {
            var $active = $items.not(':first-child').filter(function () {
                var $item = $(this);

                return $item.offset().left <= offset && $item.offset().left > 0;
            })

            $active.length && animate($active.first());
        }

        //60fps render
        var render = function () {
            dX = lerp(dX, sX, 0.1);
            dX = Math.max(dX, 0);
            if (window.innerWidth > 1024) dX = parseFloat(dX.toFixed(4));

            $wrapper.css('transform', 'translate3d(' + dX * (wrapperW - window.innerWidth + c) + 'px, 0, 0)');

            setActive();
            !reverted && qodef.scroll == 0 && reset();

            requestAnimationFrame(render);
        }

        //linear interpolation
        var lerp = function (a, b, n) {
            return (1 - n) * a + n * b;
        }

        var init = function() {
            qodef.body.addClass('qodef-with-horizontal-layout');
            calc();
            $scrollArea.height(numOfItems * speed + 'vh');
            window.addEventListener('scroll', setX);

            //resize debounce
            var resizeTimer;
            window.addEventListener('resize', function () {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function () {
                    calc();
                }, 250);
            });

            requestAnimationFrame(render);
        } 

        return {
            init: function () {
                $wrapper.length && init();
            },
        }
    }

    /**
     * Elementor
     */
    function qodefElementorHorizontalLayout() {
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_horizontal_layout.default', function() {
                qodefHorizontalLayout().init();
            } );
        });
    }
})(jQuery);
(function ($) {
	'use strict';
	
	var timeline = {};
	qodef.modules.timeline = timeline;
	
	timeline.qodefInitHorizontalTimeline = qodefInitHorizontalTimeline;
	timeline.qodefElementorInitHorizontalTimeline = qodefElementorInitHorizontalTimeline;


	timeline.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 ** All functions to be called on $(window).load() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitHorizontalTimeline().init();
	}

	function qodefOnWindowLoad() {
		qodefElementorInitHorizontalTimeline();
	}
	
	function qodefInitHorizontalTimeline() {
		var timelines = $('.qodef-horizontal-timeline'),
			eventsMinDistance;
		
		function initTimeline(timelines) {
			timelines.each(function () {
				var timeline = $(this),
					timelineComponents = {};
				
				eventsMinDistance = timeline.data('distance');
				
				//cache timeline components
				timelineComponents.timelineNavWrapper = timeline.find('.qodef-ht-nav-wrapper');
				timelineComponents.timelineNavWrapperWidth = timelineComponents.timelineNavWrapper.width();
				timelineComponents.timelineNavInner = timelineComponents.timelineNavWrapper.find('.qodef-ht-nav-inner');
				timelineComponents.fillingLine = timelineComponents.timelineNavInner.find('.qodef-ht-nav-filling-line');
				timelineComponents.timelineEvents = timelineComponents.timelineNavInner.find('a');
				timelineComponents.timelineDates = parseDate(timelineComponents.timelineEvents);
				timelineComponents.eventsMinLapse = minLapse(timelineComponents.timelineDates);
				timelineComponents.timelineNavigation = timeline.find('.qodef-ht-nav-navigation');
				timelineComponents.timelineEventContent = timeline.find('.qodef-ht-content');
				
				//select initial event
				timelineComponents.timelineEvents.first().addClass('qodef-selected');
				timelineComponents.timelineEventContent.find('li').first().addClass('qodef-selected');
				
				//assign a left postion to the single events along the timeline
				setDatePosition(timelineComponents, eventsMinDistance);
				
				//assign a width to the timeline
				var timelineTotWidth = setTimelineWidth(timelineComponents, eventsMinDistance);
				
				//the timeline has been initialize - show it
				timeline.addClass('qodef-loaded');
				
				//detect click on the next arrow
				timelineComponents.timelineNavigation.on('click', '.qodef-next', function (e) {
					e.preventDefault();
					updateSlide(timelineComponents, timelineTotWidth, 'next');
				});
				
				//detect click on the prev arrow
				timelineComponents.timelineNavigation.on('click', '.qodef-prev', function (e) {
					e.preventDefault();
					updateSlide(timelineComponents, timelineTotWidth, 'prev');
				});
				
				//detect click on the a single event - show new event content
				timelineComponents.timelineNavInner.on('click', 'a', function (e) {
					e.preventDefault();
					
					var thisItem = $(this);
					
					timelineComponents.timelineEvents.removeClass('qodef-selected');
					thisItem.addClass('qodef-selected');
					
					updateOlderEvents(thisItem);
					updateFilling(thisItem, timelineComponents.fillingLine, timelineTotWidth);
					updateVisibleContent(thisItem, timelineComponents.timelineEventContent);
				});
				
				var mq = checkMQ();
				
				//on swipe, show next/prev event content
				timelineComponents.timelineEventContent.on('swipeleft', function(){
					( mq === 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'next');
				});
				timelineComponents.timelineEventContent.on('swiperight', function(){
					( mq === 'mobile' ) && showNewContent(timelineComponents, timelineTotWidth, 'prev');
				});
				
				//keyboard navigation
				$(document).keyup(function (event) {
					if (event.which === '37' && elementInViewport(timeline.get(0))) {
						showNewContent(timelineComponents, timelineTotWidth, 'prev');
					} else if (event.which === '39' && elementInViewport(timeline.get(0))) {
						showNewContent(timelineComponents, timelineTotWidth, 'next');
					}
				});
			});
		}
		
		function updateSlide(timelineComponents, timelineTotWidth, string) {
			//retrieve translateX value of timelineComponents.timelineNavInner
			var translateValue = getTranslateValue(timelineComponents.timelineNavInner),
				wrapperWidth = Number(timelineComponents.timelineNavWrapper.css('width').replace('px', ''));
			//translate the timeline to the left('next')/right('prev')
			if(string === 'next') {
				translateTimeline(timelineComponents, translateValue - wrapperWidth + eventsMinDistance, wrapperWidth - timelineTotWidth);
			} else {
				translateTimeline(timelineComponents, translateValue + wrapperWidth - eventsMinDistance);
			}
		}
		
		function showNewContent(timelineComponents, timelineTotWidth, string) {
			//go from one event to the next/previous one
			var visibleContent = timelineComponents.timelineEventContent.find('.qodef-selected'),
				newContent = (string === 'next') ? visibleContent.next() : visibleContent.prev();
			
			if (newContent.length > 0) { //if there's a next/prev event - show it
				var selectedDate = timelineComponents.timelineNavInner.find('.qodef-selected'),
					newEvent = (string === 'next') ? selectedDate.parent('li').next('li').children('a') : selectedDate.parent('li').prev('li').children('a');
				
				updateFilling(newEvent, timelineComponents.fillingLine, timelineTotWidth);
				updateVisibleContent(newEvent, timelineComponents.timelineEventContent);
				
				newEvent.addClass('qodef-selected');
				selectedDate.removeClass('qodef-selected');
				
				updateOlderEvents(newEvent);
				updateTimelinePosition(string, newEvent, timelineComponents);
			}
		}
		
		function updateTimelinePosition(string, event, timelineComponents) {
			//translate timeline to the left/right according to the position of the qodef-selected event
			var eventStyle = window.getComputedStyle(event.get(0), null),
				eventLeft = Number(eventStyle.getPropertyValue("left").replace('px', '')),
				timelineWidth = Number(timelineComponents.timelineNavWrapper.css('width').replace('px', '')),
				timelineTotWidth = Number(timelineComponents.timelineNavInner.css('width').replace('px', '')),
				timelineTranslate = getTranslateValue(timelineComponents.timelineNavInner);
			
			if ((string === 'next' && eventLeft > timelineWidth - timelineTranslate) || (string === 'prev' && eventLeft < -timelineTranslate)) {
				translateTimeline(timelineComponents, -eventLeft + timelineWidth / 2, timelineWidth - timelineTotWidth);
			}
		}
		
		function translateTimeline(timelineComponents, value, totWidth) {
			var timelineNavInner = timelineComponents.timelineNavInner.get(0);
			
			value = (value > 0) ? 0 : value; //only negative translate value
			value = (typeof totWidth !== 'undefined' && value < totWidth) ? totWidth : value; //do not translate more than timeline width
			
			setTransformValue(timelineNavInner, 'translateX', value + 'px');
			
			//update navigation arrows visibility
			(value === 0) ? timelineComponents.timelineNavigation.find('.qodef-prev').addClass('qodef-inactive') : timelineComponents.timelineNavigation.find('.qodef-prev').removeClass('qodef-inactive');
			(value === totWidth) ? timelineComponents.timelineNavigation.find('.qodef-next').addClass('qodef-inactive') : timelineComponents.timelineNavigation.find('.qodef-next').removeClass('qodef-inactive');
		}
		
		function updateFilling(selectedEvent, filling, totWidth) {
			//change .qodef-ht-nav-filling-line length according to the qodef-selected event
			var eventStyle = window.getComputedStyle(selectedEvent.get(0), null),
				eventLeft = eventStyle.getPropertyValue("left"),
				eventWidth = eventStyle.getPropertyValue("width");
			
			eventLeft = Number(eventLeft.replace('px', '')) + Number(eventWidth.replace('px', '')) / 2;
			
			var scaleValue = eventLeft / totWidth;
			
			setTransformValue(filling.get(0), 'scaleX', scaleValue);
		}
		
		function setDatePosition(timelineComponents, min) {
			for (var i = 0; i < timelineComponents.timelineDates.length; i++) {
				var distance = daydiff(timelineComponents.timelineDates[0], timelineComponents.timelineDates[i]),
					distanceNorm = Math.round(distance / timelineComponents.eventsMinLapse) + 2;
				
				timelineComponents.timelineEvents.eq(i).css('left', distanceNorm * min + 'px');
			}
		}
		
		function setTimelineWidth(timelineComponents, width) {
			var timeSpan = daydiff(timelineComponents.timelineDates[0], timelineComponents.timelineDates[timelineComponents.timelineDates.length - 1]),
				timeSpanNorm = Math.round(timeSpan / timelineComponents.eventsMinLapse) + 4,
				totalWidth = timeSpanNorm * width;
			
			if (totalWidth < timelineComponents.timelineNavWrapperWidth) {
				totalWidth = timelineComponents.timelineNavWrapperWidth;
			}
			
			timelineComponents.timelineNavInner.css('width', totalWidth + 'px');
			
			updateFilling(timelineComponents.timelineNavInner.find('a.qodef-selected'), timelineComponents.fillingLine, totalWidth);
			updateTimelinePosition('next', timelineComponents.timelineNavInner.find('a.qodef-selected'), timelineComponents);
			
			return totalWidth;
		}
		
		function updateVisibleContent(event, timelineEventContent) {
			var eventDate = event.data('date'),
				visibleContent = timelineEventContent.find('.qodef-selected'),
				selectedContent = timelineEventContent.find('[data-date="' + eventDate + '"]'),
				selectedContentHeight = selectedContent.height(),
				classEnetering = 'qodef-selected qodef-enter-left',
				classLeaving = 'qodef-leave-right';
		
			if (selectedContent.index() > visibleContent.index()) {
				classEnetering = 'qodef-selected qodef-enter-right';
				classLeaving = 'qodef-leave-left';
			}
			
			selectedContent.attr('class', classEnetering);
			
			visibleContent.attr('class', classLeaving).one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
				visibleContent.removeClass('qodef-leave-right qodef-leave-left');
				selectedContent.removeClass('qodef-enter-left qodef-enter-right');
			});
			
			timelineEventContent.css('height', selectedContentHeight + 'px');
		}
		
		function updateOlderEvents(event) {
			event.parent('li').prevAll('li').children('a').addClass('qodef-older-event').end().end().nextAll('li').children('a').removeClass('qodef-older-event');
		}
		
		function getTranslateValue(timeline) {
			var timelineStyle = window.getComputedStyle(timeline.get(0), null),
				timelineTranslate = timelineStyle.getPropertyValue("-webkit-transform") || timelineStyle.getPropertyValue("-moz-transform") || timelineStyle.getPropertyValue("-ms-transform") || timelineStyle.getPropertyValue("-o-transform") || timelineStyle.getPropertyValue("transform"),
				translateValue = 0;
			
			if (timelineTranslate.indexOf('(') >= 0) {
				timelineTranslate = timelineTranslate.split('(')[1];
				timelineTranslate = timelineTranslate.split(')')[0];
				timelineTranslate = timelineTranslate.split(',');
				
				translateValue = timelineTranslate[4];
			}
			
			return Number(translateValue);
		}
		
		function setTransformValue(element, property, value) {
			element.style["-webkit-transform"] = property + "(" + value + ")";
			element.style["-moz-transform"] = property + "(" + value + ")";
			element.style["-ms-transform"] = property + "(" + value + ")";
			element.style["-o-transform"] = property + "(" + value + ")";
			element.style["transform"] = property + "(" + value + ")";
		}
		
		//based on http://stackoverflow.com/questions/542938/how-do-i-get-the-number-of-days-between-two-dates-in-javascript
		function parseDate(events) {
			var dateArrays = [];
			
			events.each(function () {
				var singleDate = $(this),
					dateCompStr = new String(singleDate.data('date')),
					dayComp = ['2000', '0', '0'],
					timeComp = ['0', '0'];
				
				if ( dateCompStr.length === 4 ) { //only year
					dayComp = [dateCompStr, '0', '0'];
				} else {
					var dateComp = dateCompStr.split('T');
					
					dayComp = dateComp[0].split('/'); //only DD/MM/YEAR
					
					if (dateComp.length > 1) { //both DD/MM/YEAR and time are provided
						dayComp = dateComp[0].split('/');
						timeComp = dateComp[1].split(':');
					} else if (dateComp[0].indexOf(':') >= 0) { //only time is provide
						timeComp = dateComp[0].split(':');
					}
				}
				
				var newDate = new Date(dayComp[2], dayComp[1] - 1, dayComp[0], timeComp[0], timeComp[1]);
				
				dateArrays.push(newDate);
			});
			
			return dateArrays;
		}
		
		function daydiff(first, second) {
			return Math.round((second - first));
		}
		
		function minLapse(dates) {
			//determine the minimum distance among events
			var dateDistances = [];
			
			for (var i = 1; i < dates.length; i++) {
				var distance = daydiff(dates[i - 1], dates[i]);
				dateDistances.push(distance);
			}
			
			return Math.min.apply(null, dateDistances);
		}
		
		/*
		 How to tell if a DOM element is visible in the current viewport?
		 http://stackoverflow.com/questions/123999/how-to-tell-if-a-dom-element-is-visible-in-the-current-viewport
		 */
		function elementInViewport(el) {
			var top = el.offsetTop;
			var left = el.offsetLeft;
			var width = el.offsetWidth;
			var height = el.offsetHeight;
			
			while (el.offsetParent) {
				el = el.offsetParent;
				top += el.offsetTop;
				left += el.offsetLeft;
			}
			
			return (
				top < (window.pageYOffset + window.innerHeight) &&
				left < (window.pageXOffset + window.innerWidth) &&
				(top + height) > window.pageYOffset &&
				(left + width) > window.pageXOffset
			);
		}
		
		function checkMQ() {
			//check if mobile or desktop device
			return window.getComputedStyle(document.querySelector('.qodef-horizontal-timeline'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
		}
		
		return {
			init: function () {
				(timelines.length > 0) && initTimeline(timelines);
			}
		};
	}

	/**
	 * Elementor
	 */
	function qodefElementorInitHorizontalTimeline(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_horizontal_timeline.default', function() {
				qodefInitHorizontalTimeline().init();
			} );
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	qodef.modules.icon = icon;
	
	icon.qodefIcon = qodefIcon;
	icon.qodefElementorIcon = qodefElementorIcon;
	
	
	icon.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefIcon().init();
	}

	function qodefOnWindowLoad() {
		qodefElementorIcon();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var qodefIcon = function() {
		var icons = $('.qodef-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('qodef-icon-animation')) {
				icon.appear(function() {
					icon.parent('.qodef-icon-animation-holder').addClass('qodef-icon-animation-show');
				}, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.qodef-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};

	function qodefElementorIcon(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_icon.default', function() {
				qodefIcon().init();
			} );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_icon_with_text.default', function() {
				qodefIcon().init();
			} );

			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_icon_list_item.default', function() {
				qodefIcon().init();
			} );
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	qodef.modules.iconListItem = iconListItem;
	
	iconListItem.qodefInitIconList = qodefInitIconList;
	
	
	iconListItem.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var qodefInitIconList = function() {
		var iconList = $('.qodef-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('qodef-appeared');
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
    'use strict';
    
    var imageMarquee = {};
    qodef.modules.imageMarquee = imageMarquee;
    
    imageMarquee.qodefInitImageMarquee = qodefInitImageMarquee;
    imageMarquee.qodefElementorInitImageMarquee = qodefElementorInitImageMarquee;

    imageMarquee.qodefOnDocumentReady = qodefOnDocumentReady;
    
    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitImageMarquee();
    }

    function qodefOnWindowLoad() {
        qodefElementorInitImageMarquee();
    }
    
    /**
     * Init Image Marquee effect
     */
    function qodefInitImageMarquee() {
        var imageMarqueeShortcodes = $('.qodef-image-marquee');

        if (imageMarqueeShortcodes.length) {

            imageMarqueeShortcodes.each(function(){
                var imageMarqueeShortcode = $(this),
                    marqueeElements = imageMarqueeShortcode.find('.qodef-image'),
                    originalItem = marqueeElements.filter('.qodef-original'),
                    auxItem = marqueeElements.filter('.qodef-aux');

                var marqueeEffect = function () {
	                
                    var delta = 1, //pixel movement
                        speedCoeff = 0.8, // below 1 to slow down, above 1 to speed up
                        marqueeWidth = originalItem.width();

                    auxItem.css('width', marqueeWidth); //same width as the initial marquee element
                    auxItem.css('left', marqueeWidth); //set to the right of the initial marquee element

                    //movement loop
                    marqueeElements.each(function(i){
                        var marqueeElement = $(this),
							currentPos = 0,
							animFrame;

                        var qodefInfiniteScrollEffect = function() {
                            currentPos -= delta;

                            //move marquee element
                            if (marqueeElement.position().left <= -marqueeWidth) {
                                marqueeElement.css('left', parseInt(marqueeWidth - delta));
                                currentPos = 0;
                            }

                            marqueeElement.css('transform','translate3d('+speedCoeff*currentPos+'px,0,0)');
	
	                        animFrame = requestAnimationFrame(qodefInfiniteScrollEffect);
                        }; 
						animFrame = requestAnimationFrame(qodefInfiniteScrollEffect);

						// Function to reset marquee on mobile orientation change
						function qodefOrientationChange() {
							marqueeWidth = originalItem.width();
							currentPos = 0;
							originalItem.css('left',0); // reset
							auxItem.css('width', marqueeWidth); //same width as the initial marquee element
							auxItem.css('left', marqueeWidth); //set to the right of the inital marquee element
						}
						  
						window.addEventListener('orientationchange', qodefOrientationChange);
						
						// Mobile Safari touch blocking fix
						qodef.body.on('touchstart', function(e) {
							if(!$.contains(imageMarqueeShortcode.get(0), e.target)) {
								if (animFrame) {
									cancelAnimationFrame(animFrame);
									animFrame = null;
	
									setTimeout(function() {
										animFrame = requestAnimationFrame(qodefInfiniteScrollEffect);
									}, 300);
								}
							}
						});
                    });
                };

                imageMarqueeShortcode.waitForImages(function(){
	                marqueeEffect();
	            });
            });
        }
    }

    /**
     * Elementor
     */
    function qodefElementorInitImageMarquee(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_image_marquee.default', function() {
                qodefInitImageMarquee();
            } );
        });
    }
})(jQuery);
(function ($) {
	'use strict';

	var customCursor = {};
	qodef.modules.customCursor = customCursor;

	customCursor.oqdefIWTCustomCursor = oqdefIWTCustomCursor;
	customCursor.qodefElementorIWT = qodefElementorIWT;


	customCursor.qodefOnDocumentReady = qodefOnDocumentReady;

	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		oqdefIWTCustomCursor();
	}

	function qodefOnWindowLoad() {
		qodefElementorIWT();
	}

	function oqdefIWTCustomCursor() {
		var $iwts = $('.qodef-image-with-text-holder.qodef-iwt-custom-cursor .qodef-iwt-image'),
			eX, eY, cursor, active = false;

		var handleMove = function (e) {
			eX = e.clientX;
			eY = e.clientY
		}

		var showCursor = function () {
			if (!active) {
				active = true;
				cursor.classList.add('-show');
			}
		}

		var hideCursor = function () {
			if (active) {
				active = false;
				cursor.classList.remove('-show');
			}
		}

		var render = function () {
			if (active) {
				cursor.style.top = eY + 'px';
				cursor.style.left = eX + 'px';
			}

			requestAnimationFrame(render);
		}

		var init = function () {
			$iwts.on('mousemove', handleMove);
			$iwts.on('mousemove', showCursor);
			$iwts.on('mouseleave', hideCursor);
			window.addEventListener('scroll', hideCursor);
			requestAnimationFrame(render);
		}


		if ($iwts.length && !Modernizr.touch) {
			qodef.body.append('\
				<svg id="qodef-iwt-cursor" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 251 253" width="230" height="230" stroke="#000" fill="transparent" stroke-width="1.5px">\
					<path d="M38.389,0V40.276H169.9L0,210.179,28.482,238.66l169.9-169.9V200.271H238.66V0Z" transform="translate(5.88 7)"/>\
				</svg>\
			');
			cursor = document.getElementById('qodef-iwt-cursor');
			init();
		}
	}

	function qodefElementorIWT(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_image_with_text.default', function() {
				oqdefIWTCustomCursor();
			} );
		});
	}

})(jQuery);
(function ($) {
    'use strict';

    var introSection = {};
    qodef.modules.introSection = introSection;

    introSection.qodefIntroSection = qodefIntroSection;
    introSection.qodefOnDocumentReady = qodefOnDocumentReady;
    introSection.qodefInitElementorIntroSection = qodefInitElementorIntroSection;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefIntroSection().init();
    }

    function qodefOnWindowLoad() {
        qodefInitElementorIntroSection();
    }

    /**
     * Init Intro Section Shortcode
     */
    function qodefIntroSection() {
        var $intro = $('#qodef-intro-section'),
            $counter = $('.qodef-is-loading-progress'),
            $arrow = $('#qodef-is-arrow');

        var toLastScreen = function () {
            $intro.addClass('-qodef-last');

            TweenLite.to("#qodef-is-arrow", .3, {
                autoAlpha: 0,
                onComplete: function () {
                    TweenLite.set('#qodef-is-arrow', {
                        'bottom': 'auto',
                        'top': 'calc(45vh + 6vw)',
                        y: '-20%'
                    })
                    TweenLite.to("#qodef-is-arrow", .4, {
                        autoAlpha: 1,
                        y: '0%',
                        delay: .6,
                        ease: Power4.easeOut,
                    })
                    $(window).scrollTop(0);
                    qodef.modules.common.qodefEnableScroll();
                    qodef.body.addClass('qodef-loaded');
                }
            });

            TweenLite.to('#qodef-is-first-title', .4, {
                y: 20,
                autoAlpha: 0,
                ease: Power4.easeOut,
            });

            TweenLite.to('#qodef-is-second-title', .4, {
                autoAlpha: 1,
                y: '0%',
                delay: 1,
                onComplete: function () {
                    $intro.addClass('-qodef-f-2');
                    document.querySelector('#qodef-is-video').play();
                }
            });

            TweenLite.to('#qodef-is-cover', 1.1, {
                transformOrigin: '0 0',
                scaleY: 0,
                ease: Power4.easeInOut,
            });

            TweenLite.to('#qodef-is-video', 1.1, {
                y: '0%',
                ease: Power4.easeInOut,
            });

            TweenLite.to($intro, 1.5, {
                y: '-45vh',
                delay: .6,
                ease: Power4.easeOut,
            });
        }

        var showSecondScreen = function () {
            document.querySelector('#qodef-is-video').play();
            document.querySelector('#qodef-is-video').pause(); //show first frame

            TweenLite.to('#qodef-is-cover', 1, {
                y: '0%',
                ease: Power4.easeInOut,
                delay: .2
            });

            TweenLite.to('#qodef-is-cover', 1, {
                transformOrigin: '0 0',
                scaleY: .45,
                ease: Power4.easeInOut,
                delay: .8
            });

            TweenLite.to('#qodef-is-video', 1.5, {
                scale: 1,
                y: '30%',
                ease: Power4.easeOut,
                delay: .8,
                onStart: function () {
                    TweenLite.set('#qodef-is-video', {
                        autoAlpha: 1
                    })
                },
                onComplete: function () {
                    $arrow[0].addEventListener('click', function () {
                        !$intro.hasClass('-qodef-last') && toLastScreen();
                    }, {
                        once: true
                    });
                    window.addEventListener('wheel', function () {
                        !$intro.hasClass('-qodef-last') && toLastScreen();
                    }, {
                        once: true
                    });
                }
            });

            TweenLite.to('#qodef-is-first-title', .4, {
                autoAlpha: 1,
                y: '0%',
                delay: .8,
                onComplete: function () {
                    $intro.addClass('-qodef-f-1');
                }
            });
        }

        var hideFirstScreen = function () {
            TweenLite.to('.qodef-is-loading-title', .8, {
                y: -20,
                autoAlpha: 0,
                ease: Power4.easeInOut,
            });
            TweenLite.to('.qodef-is-loading-center', .8, {
                y: -20,
                autoAlpha: 0,
                ease: Power4.easeInOut,
                delay: .05
            });
            TweenLite.to('.qodef-is-loading-bottom', .8, {
                y: -20,
                autoAlpha: 0,
                ease: Power4.easeInOut,
                delay: .1
            });
        }

        var startCounter = function () {
            var counter = {
                var: 0
            };

            TweenLite.to(counter, 3, {
                var: 100,
                onUpdate: function () {
                    $(window).scrollTop(0);
                    $counter[0].innerHTML = Math.ceil(counter.var) + '%';
                },
                onComplete: function () {
                    hideFirstScreen();
                    showSecondScreen();
                }
            });
        }

        var init = function () {
            $(window).scrollTop(0);
            qodef.modules.common.qodefDisableScroll();
            $intro.addClass('q-show');
            startCounter();
        }

        return {
            init: function () {
                $intro.length && init();
            },
        }
    }

    function qodefInitElementorIntroSection(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_intro_section.default', function() {
                qodefIntroSection().init();
            } );
        });
    }
})(jQuery);
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
(function ($) {
	'use strict';
	
	var outlineText = {};
	qodef.modules.outlineText = outlineText;
	
	outlineText.qodefOutlineTextResize = qodefOutlineTextResize;
	outlineText.qodefElementorInitOutlineText = qodefElementorInitOutlineText;

	
	outlineText.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefOutlineTextResize();
	}

	function qodefOnWindowLoad() {
		qodefElementorInitOutlineText();
	}
	
	/*
	 **	Outline Text resizing style
	 */
	function qodefOutlineTextResize() {
		var holder = $('.qodef-outline-text-holder');
		
		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';
				
				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}
				
				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}
				
				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}
				
				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {
					
					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.qodef-outline-text-holder." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.qodef-outline-text-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.qodef-outline-text-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.qodef-outline-text-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}
				
				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}
				
				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}

	/**
	 * Elementor
	 */
	function qodefElementorInitOutlineText(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_outline_text.default', function() {
				qodefOutlineTextResize();
			} );
		});
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var outroSection = {};
    qodef.modules.outroSection = outroSection;

    outroSection.qodefOutroSection = qodefOutroSection;
    outroSection.qodefOnWindowLoad = qodefOnWindowLoad;
    outroSection.qodefInitElementorOutroSection = qodefInitElementorOutroSection;

    $(window).on('load', qodefOnWindowLoad);

    /*
     All functions to be called on $(window).on('load', qodefOnWindowLoad) should be in this function
     */
    function qodefOnWindowLoad() {
        qodefOutroSection().init();
        qodefInitElementorOutroSection();
    }

    /**
     * Init Outro Section Shortcode
     */
    function qodefOutroSection() {
        var $outro = $('#qodef-outro-section'),
            cursor = document.getElementById('qodef-os-arrow'),
            active = false, eX, eY;

        var handleMove = function (e) {
            eX = e.clientX;
            eY = e.clientY
        }

        var showCursor = function () {
            if (!active) {
                active = true;
                cursor.classList.add('-show');
            }
        }

        var hideCursor = function () {
            if (active) {
                active = false;
                cursor.classList.remove('-show');
            }
        }

        var render = function () {
            if (active) {
                cursor.style.top = eY + 'px';
                cursor.style.left = eX + 'px';
            }

            requestAnimationFrame(render);
        }

        var initCursor = function () {
            $outro.on('mousemove', handleMove);
            $outro.on('mousemove', showCursor);
            $outro.on('mouseleave', hideCursor);
            window.addEventListener('scroll', hideCursor);
            requestAnimationFrame(render);
        }

        var init = function () {
            $outro.appear(function () {
                $outro.addClass('q-show');
            }, {
                accX: 0,
                accY: -qodef.windowHeight / 2
            });
            !Modernizr.touch && initCursor();
        }

        return {
            init: function () {
                $outro.length && init();
            },
        }
    }

    function qodefInitElementorOutroSection(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_outro_section.default', function() {
                qodefOutroSection().init();
            } );
        });
    }

})(jQuery);
(function($) {
	'use strict';
	
	var pieChart = {};
	qodef.modules.pieChart = pieChart;
	
	pieChart.qodefInitPieChart = qodefInitPieChart;
	pieChart.qodefInitElementorPieChart = qodefInitElementorPieChart;
	
	pieChart.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitPieChart();
	}

	function qodefOnWindowLoad() {
		qodefInitElementorPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function qodefInitPieChart() {
		var pieChartHolder = $('.qodef-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.qodef-pc-percentage'),
					barColor = '#25abd1',
					trackColor = '#f7f7f7',
					lineWidth = 2,
					size = 176;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: false,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.qodef-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}

	function qodefInitElementorPieChart(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_pie_chart.default', function() {
				qodefInitPieChart();
			} );
		});
	}
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var progressBar = {};
	qodef.modules.progressBar = progressBar;
	
	progressBar.qodefInitProgressBars = qodefInitProgressBars;
	progressBar.qodefInitElementorProgressBars = qodefInitElementorProgressBars;
	
	progressBar.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitProgressBars();
	}

	function qodefOnWindowLoad(){
		qodefInitElementorProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function qodefInitProgressBars() {
		var progressBar = $('.qodef-progress-bar');
		
		if (progressBar.length) {
			progressBar.each(function () {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.qodef-pb-content'),
					progressBar = thisBar.find('.qodef-pb-percent'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function () {
					qodefInitToCounterProgressBar(progressBar, percentage);
					
					thisBarContent.css('width', '0%').animate({'width': percentage + '%'}, 2000);
					
					if (thisBar.hasClass('qodef-pb-percent-floating')) {
						progressBar.css('left', '0%').animate({'left': percentage + '%'}, 2000);
					}
				});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function qodefInitToCounterProgressBar(progressBar, percentageValue){
		var percentage = parseFloat(percentageValue);
		
		if(progressBar.length) {
			progressBar.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 2000,
					refreshInterval: 50
				});
			});
		}
	}

	function qodefInitElementorProgressBars(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_progress_bar.default', function() {
				qodefInitProgressBars();
			} );
		});
	}
	
})(jQuery);
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
(function($) {
	'use strict';
	
	var tabs = {};
	qodef.modules.tabs = tabs;
	
	tabs.qodefInitTabs = qodefInitTabs;
	tabs.qodefInitElementorTabs = qodefInitElementorTabs;
	
	tabs.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitTabs();
	}

	function qodefOnWindowLoad() {
		qodefInitElementorTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function qodefInitTabs(){
		var tabs = $('.qodef-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.qodef-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.qodef-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.qodef-tabs a.qodef-external-link').unbind('click');
			});
		}
	}

	function qodefInitElementorTabs(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_tabs.default', function() {
				qodefInitTabs();
			} );
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var team = {};
	qodef.modules.team = team;

	team.qodefInitTeamFollowInfo = qodefInitTeamFollowInfo;
	team.qodefInitElementorTeam = qodefInitElementorTeam;

	team.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
	$(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
		qodefInitTeamFollowInfo();
	}

	function qodefOnWindowLoad() {
		qodefInitElementorTeam();
	}
	
	/**
	 * Initializes team follow info hover
	 */
	function qodefInitTeamFollowInfo() {
		var teamMember = $('.qodef-team-holder.qodef-team-info-on-image');
		
		if (teamMember.length) {
			qodef.body.append('<div class="qodef-team-follow-info-holder">\<div class="qodef-team-follow-info-inner">\<span class="qodef-team-follow-info-position">Position</span>\<span class="qodef-team-follow-info-name">Name</span></div>\</div>');
			
			var followInfoHolder = $('.qodef-team-follow-info-holder'),
				followInfoName = followInfoHolder.find('.qodef-team-follow-info-name'),
				followInfoPosition = followInfoHolder.find('.qodef-team-follow-info-position');
			
			teamMember.each(function () {
				var thisTeamMember = $(this);
				
				//info element position
				thisTeamMember.on('mousemove', function (e) {
					followInfoHolder.css({
						top: e.clientY,
						left: e.clientX
					});
				});
				
				//show/hide info element
				thisTeamMember.find('.qodef-team-inner').on('mouseenter', function () {
					var thisTeamItem = $(this),
						thisTeamItemName = thisTeamItem.find('.qodef-team-name'),
						thisTeamItemPosition = thisTeamItem.find('.qodef-team-position');
					
					if(thisTeamItemName.length) {
						followInfoName.text(thisTeamItemName.text());
					}
					
					if(thisTeamItemPosition.length) {
						followInfoPosition.text(thisTeamItemPosition.text());
					}
					
					if (!followInfoHolder.hasClass('qodef-is-active')) {
						followInfoHolder.addClass('qodef-is-active');
					}
				}).on('mouseleave', function () {
					if (followInfoHolder.hasClass('qodef-is-active')) {
						followInfoHolder.removeClass('qodef-is-active');
					}
				});
				
				//check if info element is below or above the targeted portfolio list
				$(window).scroll(function(){
					if (followInfoHolder.hasClass('qodef-is-active')) {
						if (followInfoHolder.offset().top < thisTeamMember.offset().top || followInfoHolder.offset().top > thisTeamMember.offset().top + thisTeamMember.outerHeight()) {
							followInfoHolder.removeClass('qodef-is-active');
						}
					}
				});
			});
		}
	}

	function qodefInitElementorTeam(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_team.default', function() {

			} );
		});
	}
	
	
})(jQuery);
(function ($) {
    'use strict';
    
    var textMarquee = {};
    qodef.modules.textMarquee = textMarquee;
    
    textMarquee.qodefTextMarquee = qodefTextMarquee;
    textMarquee.qodefMarqueeTextResize = qodefMarqueeTextResize;

    textMarquee.qodefOnDocumentReady = qodefOnDocumentReady;
    
    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefTextMarquee().init();
        qodefMarqueeTextResize();
    }

    function qodefOnWindowLoad() {
        qodefInitElementorTextMarquee();
    }

    /*
     ** Custom Font resizing
     */
    function qodefMarqueeTextResize() {
        var marqueeText = $('.qodef-text-marquee');

        if (marqueeText.length) {
            marqueeText.each(function () {
                var thisMarqueeText = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;

                if (qodef.windowWidth < 1480) {
                    coef1 = 0.8;
                }

                if (qodef.windowWidth < 1200) {
                    coef1 = 0.7;
                }

                if (qodef.windowWidth < 768) {
                    coef1 = 0.55;
                    coef2 = 0.65;
                }

                if (qodef.windowWidth < 600) {
                    coef1 = 0.45;
                    coef2 = 0.55;
                }

                if (qodef.windowWidth < 480) {
                    coef1 = 0.4;
                    coef2 = 0.5;
                }

                fontSize = parseInt(thisMarqueeText.css('font-size'));

                if (fontSize > 200) {
                    fontSize = Math.round(fontSize * coef1);
                } else if (fontSize > 60) {
                    fontSize = Math.round(fontSize * coef2);
                }

                thisMarqueeText.css('font-size', fontSize + 'px');

                lineHeight = parseInt(thisMarqueeText.css('line-height'));

                if (lineHeight > 70 && qodef.windowWidth < 1440) {
                    lineHeight = '1.2em';
                } else if (lineHeight > 35 && qodef.windowWidth < 768) {
                    lineHeight = '1.2em';
                } else {
                    lineHeight += 'px';
                }

                thisMarqueeText.css('line-height', lineHeight);

            });
        }
    }

    /**
     * Init Text Marquee effect
     */
    function qodefTextMarquee() {
        var marquees = $('.qodef-text-marquee');

        var Marquee = function (marquee) {
            this.holder = marquee;
            this.els = this.holder.find('.qodef-marquee-element');
            this.delta = .05;
        }

        var inRange = function (el) {
            if (qodef.scroll + qodef.windowHeight >= el.offset().top &&
                qodef.scroll < el.offset().top + el.height()) {
                return true;
            }

            return false;
        }

        var loop = function (marquee) {
            if (!inRange(marquee.holder)) {
                requestAnimationFrame(function () {
                    loop(marquee);
                });
                return false;
            } else {
                marquee.els.each(function (i) {
                    var el = $(this);
                    el.css('transform', 'translate3d(' + el.data('x') + '%, 0, 0)');
                    el.data('x', (el.data('x') - marquee.delta).toFixed(2));
                    el.offset().left < -el.width() - 25 && el.data('x', 100 * Math.abs(i - 1));
                })
                requestAnimationFrame(function () {
                    loop(marquee);
                });
            }
        }

        var init = function (marquee) {
            marquee.els.each(function (i) {
                $(this).data('x', 0);
            });

            requestAnimationFrame(function () {
                loop(marquee);
            });
        }

        return {
            init: function () {
                marquees.length &&
                marquees.each(function () {
                    var marquee = new Marquee($(this));

                    init(marquee);
                });
            }
        }
    }

    function qodefInitElementorTextMarquee(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_text_marquee.default', function() {
                qodefMarqueeTextResize();
                qodefTextMarquee().init();
            } );
        });
    }
    
})(jQuery);
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
(function($) {
    'use strict';

    var verticalShowcase = {};
    qodef.modules.verticalShowcase = verticalShowcase;
    verticalShowcase.qodefInitVerticalShowcase = qodefInitVerticalShowcase;
    verticalShowcase.qodefElementorInitVerticalShowcase = qodefElementorInitVerticalShowcase;

    verticalShowcase.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefInitVerticalShowcase();
    }

    function qodefOnWindowLoad() {
        qodefElementorInitVerticalShowcase();
    }

    /**
     * Init vertical showcase shortcode
     */
    function qodefInitVerticalShowcase() {
        var verticalShowcase = $('.qodef-vertical-showcase');
    
        if (verticalShowcase.length) {
            verticalShowcase.each(function () {
                var holder = $(this),
                    pasepartuWrapper = $('.qodef-wrapper'),
                    item = holder.find('.qodef-vs-item'),
                    frameImage = holder.find('.qodef-vs-inner-frame'),
                    frameInfo = holder.find('.qodef-vs-frame-info'),
                    frameSlideTitleAfterNumber = frameInfo.find('.qodef-vs-frame-title-after-number'),
                    frameSlideText = frameInfo.find('.qodef-vs-frame-slide-text'),
                    frameSlideNumber= frameInfo.find('.qodef-vs-frame-slide-number'),
                    frameTitle = frameInfo.find('.qodef-vs-frame-title'),
                    frameSubtitle = frameInfo.find('.qodef-vs-frame-subtitle'),
                    swiperInstance = holder.find('.swiper-container'),
                    swiperSlide = swiperInstance.find('.swiper-slide'),
                    contactForm = holder.find('.wpcf7'),
                    contactFormInput = contactForm.find('input'),
                    lastSlide = swiperSlide.length,
                    secondLastSlide = lastSlide - 1,
                    indexCounter = 1,
                    currentActiveIndex,
	                currentActiveSlideTitleAfterNumber,
                    currentActiveSlideText,
                    currentActiveTitle,
                    currentActiveSubtitle,
                    onLastSlide = false,
                    onSecondLastSlide = false,
                    currentActiveImageSrc;

                var swiperSlider = new Swiper (swiperInstance, {
                    loop: false,
                    direction: 'vertical',
                    slidesPerView: 1,
                    // mousewheel: {
                    //     invert: false,
                    //     // eventsTarged: holder
                    // },
                    touchStartForcePreventDefault: true,
                    speed: 1000,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        renderBullet: function (index, className) {
                            return '<span class="' + className + '"></span>';
                        },
                    },
                    init: false
                });

                var scrollStart = false;
                swiperInstance.on('wheel', function(e) {
                    e.preventDefault();
                    if (!scrollStart) {
                        scrollStart = true;
                        var delta = e.originalEvent.deltaY;

                        if (delta > 0) {
                            swiperInstance[0].swiper.slideNext();
                        } else {
                            swiperInstance[0].swiper.slidePrev();
                        }

                        setTimeout(function() {
                            scrollStart = false;
                        }, 2000);
                    }
                });
                
                // Recalculate slider height if paspartu enabled 
                if (qodef.body.hasClass('qodef-paspartu-enabled')) {
                    var paspartuPadding = parseInt(pasepartuWrapper.css('padding'));
                    holder.css("height", "calc(100vh - " + paspartuPadding*2 + "px)");
                    swiperInstance.css("height", "calc(100vh - " + paspartuPadding*2 + "px)");
                }

                if (qodef.windowWidth < 1025) {
                    var headerHeight = $('.qodef-mobile-header-inner').css('height');
                    holder.css("height", "calc(100vh - " + headerHeight + ")");
                    swiperInstance.css("height", "calc(100vh - " + headerHeight + ")");
                    pasepartuWrapper.css('padding', 0);
                }

                holder.waitForImages(function() {
                    swiperSlider.init();
                    var swiperPagination = holder.find('.swiper-pagination');
                    var swiperPaginationBullet = swiperPagination.find('.swiper-pagination-bullet');

                    swiperSlide.each(function() {
                        $(this).attr('slide-index', indexCounter);
                        $(this).data('slide-index', indexCounter);
                        indexCounter++;
                    });

                    function enableAdjacentPagination() {
                        // var activeBullet = swiperPagination.find('.swiper-pagination-bullet-active');
                        // swiperPaginationBullet.removeClass('bullet-clickable');
                        // activeBullet.addClass('bullet-clickable');
                        // activeBullet.next().addClass('bullet-clickable');
                        // activeBullet.prev().addClass('bullet-clickable');
                    }

                    // function find active item
                    function findActiveItem() {
                        currentActiveIndex = swiperInstance.find('.swiper-slide-active').data('slide-index');
                        currentActiveSlideTitleAfterNumber = swiperInstance.find('.swiper-slide-active .qodef-vs-item-slide-title-after-number').text();
                        currentActiveSlideText = swiperInstance.find('.swiper-slide-active .qodef-vs-item-slide-text').text();
                        currentActiveTitle = swiperInstance.find('.swiper-slide-active .qodef-vs-item-title').text();
                        currentActiveSubtitle = swiperInstance.find('.swiper-slide-active .qodef-vs-item-subtitle').text();
                        currentActiveImageSrc = swiperInstance.find('.swiper-slide-active>.qodef-vs-item>img').attr('src');
                    }

                    function updateFrameInfo() {
                        frameImage.css('background-image', "url(" + currentActiveImageSrc + ")");
	                    frameSlideTitleAfterNumber.text(currentActiveSlideTitleAfterNumber);
                        frameSlideText.text(currentActiveSlideText);
                        frameSlideNumber.text('0' + currentActiveIndex);
                        frameTitle.text(currentActiveTitle);
                        frameSubtitle.text(currentActiveSubtitle);
                    }

                    function readyAnimation() {
                        setTimeout(function() {
                            holder.addClass('q-show q-odd');
                            frameInfo.removeClass("qodef-vs-frame-animate-out");
                        }, 700);
                        holder.removeClass("qodef-vs-ready-animation");
                    }

                    // Initialize frame info when slider is ready
                    findActiveItem();
                    updateFrameInfo();
                    enableAdjacentPagination();

                    setTimeout(function() {
                        readyAnimation();
                    }, 500); 

                    swiperSlider.on('slideChangeTransitionStart', function() {
                        holder.removeClass('q-odd q-even q-show')
                        !!(this.activeIndex % 2) ? holder.addClass('q-even') : holder.addClass('q-odd')
                    });

                    swiperSlider.on('slideChangeTransitionEnd', function() {
                        holder.addClass('q-show')
                        holder.removeClass('q-even-visible q-odd-visible')
                        !!(this.activeIndex % 2) ? holder.addClass('q-even-visible') : holder.addClass('q-odd-visible')
                    });

                    swiperSlider.on('slideChangeTransitionStart', function() {
                        findActiveItem();
                        enableAdjacentPagination();

                        if (currentActiveIndex == lastSlide) {
                            onLastSlide = true;
                            holder.addClass("qodef-vs-last-slide");
                        } else {
                            onLastSlide = false;
                            holder.removeClass("qodef-vs-last-slide");
                        }

                        if (!onLastSlide) {
                            frameInfo.addClass("qodef-vs-frame-animate-out");
                        
                            setTimeout(function() {
                                // if even slide move the frame info down
                                if (currentActiveIndex % 2 == 0) {
                                    frameInfo.addClass("qodef-vs-frame-even");
                                } else {
                                    frameInfo.removeClass("qodef-vs-frame-even");
                                }
                                updateFrameInfo();
                                frameInfo.removeClass("qodef-vs-frame-animate-out");
                            }, 700);
                        }
                    });
                });

                contactFormInput.bind("mousedown",function(e){
                    e.stopPropagation();
                });
            });
        }
    }

    /**
     * Elementor
     */
    function qodefElementorInitVerticalShowcase(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_vertical_showcase.default', function() {
                qodefInitVerticalShowcase();
            } );
        });
    }

})(jQuery);
(function ($) {
    'use strict';

    var videoButton = {};
    qodef.modules.videoButton = videoButton;
    videoButton.qodefVideoButton = qodefVideoButton;

    videoButton.qodefOnDocumentReady = qodefOnDocumentReady;

    $(document).ready(qodefOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function qodefOnDocumentReady() {
        qodefVideoButton().init();
    }


    function qodefVideoButton() {
        var $items = $('.qodef-video-button-play-inner'),
            mouse = {};

        var handleMove = function (e) {
            mouse = {
                x: e.pageX,
                y: e.pageY,
            }
        }

        var controlItems = function () {
            $items.each(function () {
                var $item = $(this),
                    $inner = $item.children(),
                    limit = 200;

                var cX, cY, w, h, x, y, inRange; //position variables

                var updatePosition = function () {
                    cX = mouse.x;
                    cY = mouse.y;
                    w = $item.width();
                    h = $item.height();
                    x = $item.offset().left + w / 2;
                    y = $item.offset().top + h / 2;
                    inRange = Math.abs(x - cX) < w && Math.abs(y - cY) < h;
                }

                var coords = function () {
                    return {
                        x: Math.abs(cX - x) < limit ? cX - x : limit * (cX - x) / Math.abs(cX - x),
                        y: Math.abs(cY - y) < limit ? cY - y : limit * (cY - y) / Math.abs(cY - y)
                    }
                }

                var moveItem = function () {
                    $inner.addClass('qodef-moving');
                    var deltaX = 0,
                        deltaY = 0,
                        dX = coords().x,
                        dY = coords().y;

                    var transformItem = function () {
                        deltaX += (coords().x - dX) / 5;
                        deltaY += (coords().y - dY) / 5;

                        deltaX.toFixed(2) !== dX.toFixed(2) &&
                            $inner.css({
                                'transform': 'translate3d(' + deltaX + 'px, ' + deltaY + 'px, 0)',
                                'transition': 'none'
                            });

                        dX = deltaX;
                        dY = deltaY;

                        requestAnimationFrame(function () {
                            inRange && transformItem();
                        });
                    }

                    transformItem();
                }

                var resetItem = function () {
                    $inner
                        .removeClass('qodef-moving')
                        .css({
                            'transition': 'transform 1s',
                            'transform': 'translate3d(0px, 0px, 0px)'
                        })
                        .one(qodef.transitionEnd, function () {
                            $inner.removeClass('qodef-controlled');
                            $inner.css({
                                'transition': 'none'
                            });
                        });
                }

                var setState = function () {
                    updatePosition();

                    if (inRange) {
                        !$inner.hasClass('qodef-moving') && moveItem(); //start move
                    } else {
                        $inner.hasClass('qodef-moving') && resetItem(); //end move
                    }

                    requestAnimationFrame(setState);
                }

                requestAnimationFrame(setState);
            });
        }

        var init = function () {
            controlItems();
            $(window).on('mousemove', handleMove);
        }

        return {
            init: function () {
                $items.length && !Modernizr.touch && init();
            }
        }
    }

})(jQuery);
(function($) {
	'use strict';
	
	var workflow = {};
	qodef.modules.workflow = workflow;

    workflow.qodefWorkflow = qodefWorkflow;
    workflow.qodefElementorWorkflow = qodefElementorWorkflow;

    workflow.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
        qodefWorkflow();
	}

    function qodefOnWindowLoad() {
        qodefElementorWorkflow();
    }

    function qodefWorkflow() {
        var workflowShortcodes = $('.qodef-workflow');
        if (workflowShortcodes.length) {
            workflowShortcodes.each(function () {
                var workflowShortcode = $(this);
                if (workflowShortcode.hasClass('qodef-workflow-animate')) {
                    var workflowItems = workflowShortcode.find('.qodef-workflow-item');

                    workflowShortcode.appear(function () {
                        workflowShortcode.addClass('qodef-appeared');
                        setTimeout(function () {
                            workflowItems.each(function (i) {
                                var workflowItem = $(this);
                                setTimeout(function () {
                                    workflowItem.addClass('qodef-appeared');
                                }, 350 * i);
                            });
                        }, 350);
                    }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

                }
            });
        }
    }

    /**
     * Elementor
     */
    function qodefElementorWorkflow(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_workflow.default', function() {
                qodefWorkflow();
            } );
        });
    }
	
})(jQuery);
(function($) {
    'use strict';

    var portfolioList = {};
    qodef.modules.portfolioList = portfolioList;

    portfolioList.qodefOnWindowLoad = qodefOnWindowLoad;
    portfolioList.qodefOnWindowScroll = qodefOnWindowScroll;
    portfolioList.qodefOnWindowResize = qodefOnWindowResize;
    portfolioList.qodefInitElementorPortfolioList = qodefInitElementorPortfolioList;
    portfolioList.qodefInitPortfolioHoverArrow = qodefInitPortfolioHoverArrow;
    portfolioList.qodefPortfolioFollowInfo = qodefPortfolioFollowInfo;

    $(window).load(qodefOnWindowLoad);
    $(window).scroll(qodefOnWindowScroll);
    $(window).resize(qodefOnWindowResize);
	//window.onmousemove = handleMouseMove;

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodefInitPortfolioFilter();
        qodefInitPortfolioListAnimation();
	    qodefInitPortfolioPagination().init();
	    qodefPortfolioFilterToggle();
	    qodefInitPortfolioHoverArrow();
	    qodefPortfolioParallaxList().init();
	    qodefPortfolioFollowInfo().init();
		qodefInitElementorPortfolioList();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function qodefOnWindowScroll() {
	    qodefInitPortfolioPagination().scroll();
    }
    
    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function qodefOnWindowResize() {
	    qodefInitPortfolioHoverArrow();
    }

    /**
     * Initializes portfolio list article animation
     */
    function qodefInitPortfolioListAnimation(){
        var portList = $('.qodef-portfolio-list-holder.qodef-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.qodef-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('qodef-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('qodef-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function qodefInitPortfolioFilter(){
        var filterHolder = $('.qodef-portfolio-list-holder .qodef-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.qodef-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.qodef-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('qodef-pl-pag-load-more');

                thisFilterHolder.find('.qodef-pl-filter:first').addClass('qodef-pl-current');
	            
	            if(thisPortListHolder.hasClass('qodef-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.qodef-pl-filter').on('click', function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
	                    portListHasArticles = thisPortListInner.children().hasClass(filterClassName);

                    thisFilter.parent().children('.qodef-pl-filter').removeClass('qodef-pl-current');
                    thisFilter.addClass('qodef-pl-current');
	
	                if(portListHasLoadMore && !portListHasArticles && filterValue.length) {
		                qodefInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
	                } else {
		                filterValue = filterValue.length === 0 ? '*' : filterValue;
                   
                        thisFilterHolder.parent().children('.qodef-pl-inner').isotope({ filter: filterValue });
	                    qodef.modules.common.qodefInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function qodefInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.qodef-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'struktur_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.qodef-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('qodef-showing qodef-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: qodefGlobalVars.vars.qodefAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArticles) {
                            setTimeout(function() {
	                            qodef.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.qodef-masonry-grid-sizer').width(), true);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('qodef-showing qodef-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    qodefInitPortfolioListAnimation();
	                                qodef.modules.common.qodefInitParallax();
                                }, 150);
                            }, 400);
                        } else {
                            loadingItem.removeClass('qodef-showing qodef-filter-trigger');
                            qodefInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function qodefInitPortfolioPagination(){
		var portList = $('.qodef-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.qodef-pl-standard-pagination li');
			
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
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.qodef-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - qodefGlobalVars.vars.qodefAddForAdminBar;
			
			if(!thisPortList.hasClass('qodef-pl-infinite-scroll-started') && qodef.scroll + qodef.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.qodef-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
				thisPortList.addClass('qodef-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = qodef.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.qodef-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages || maxNumPages === 0){
				if(thisPortList.hasClass('qodef-pl-pag-standard')) {
					loadingItem.addClass('qodef-showing qodef-standard-pag-trigger');
					thisPortList.addClass('qodef-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('qodef-showing');
				}
				
				var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'struktur_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: qodefGlobalVars.vars.qodefAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('qodef-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							qodefInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('qodef-pl-masonry')){
									qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter')) {
									qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									qodefInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('qodef-pl-masonry')){
								    if(pagedLink === 1) {
                                        qodefInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        qodefInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    }
								} else if (thisPortList.hasClass('qodef-pl-gallery') && thisPortList.hasClass('qodef-pl-has-filter') && pagedLink !== 1) {
									qodefInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
								    if (pagedLink === 1) {
                                        qodefInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        qodefInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                    }
								}
							});
						}
						
						if(thisPortList.hasClass('qodef-pl-infinite-scroll-started')) {
							thisPortList.removeClass('qodef-pl-infinite-scroll-started');
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.qodef-pl-load-more-holder').hide();
			}
		};
		
		var qodefInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.qodef-pl-standard-pagination'),
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
		
		var qodefInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
			qodef.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.qodef-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPortfolioListAnimation();
				qodef.modules.common.qodefInitParallax();
				qodef.modules.common.qodefPrettyPhoto();
				qodefInitPortfolioHoverArrow();
			}, 600);
		};
		
		var qodefInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing qodef-standard-pag-trigger');
			thisPortList.removeClass('qodef-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			qodefInitPortfolioListAnimation();
			qodef.modules.common.qodefInitParallax();
			qodef.modules.common.qodefPrettyPhoto();
			qodefInitPortfolioHoverArrow();
		};
		
		var qodefInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
			qodef.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.qodef-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('qodef-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				qodefInitPortfolioListAnimation();
				qodef.modules.common.qodefInitParallax();
				qodef.modules.common.qodefPrettyPhoto();
				qodefInitPortfolioHoverArrow();
			}, 600);
		};
		
		var qodefInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('qodef-showing');
			thisPortListInner.append(responseHtml);
			qodefInitPortfolioListAnimation();
			qodef.modules.common.qodefInitParallax();
			qodef.modules.common.qodefPrettyPhoto();
			qodefInitPortfolioHoverArrow();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('qodef-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
            getMainPagFunction: function(thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
		};
	}
	
	function qodefInitPortfolioHoverArrow() {
		var portfolioLists = $('.qodef-portfolio-list-holder.qodef-pl-gallery-overlay');
		
		if (portfolioLists.length) {
			portfolioLists.each(function(){
				var portfolioList = $(this),
					portfolioListInner,
					cursor = portfolioList.find('.qodef-pl-custom-cursor'),
					topOffset = 0,
					leftOffset = 0,
					height = 0,
					width = 0;
				
				if( portfolioList.parent().hasClass('qodef-portfolio-slider-holder') ){
					portfolioListInner = portfolioList.find('.owl-stage-outer');
				} else{
					portfolioListInner = portfolioList.find('.qodef-pl-inner');
				}
				
				
				topOffset = portfolioListInner.offset().top;
				leftOffset = portfolioListInner.offset().left;
				height = portfolioListInner.outerHeight();
				width = portfolioListInner.outerWidth();
				
				var transformCursor = function (x, y) {
					if( leftOffset - cursor.width() / 2 <= x && x <= leftOffset + width - cursor.width() / 2 && topOffset - cursor.width() / 2 <= qodef.scroll + y && qodef.scroll + y <= topOffset + height - cursor.width() / 2 ){
						cursor.css({'transform': 'translate3d(' + x + 'px, ' + y + 'px, 0)', 'visibility': 'visible'});
					} else{
						cursor.css({'visibility': 'hidden'});
					}
				}
				
				var handleMove = function (e) {
					var x = e.clientX - cursor.width() / 2,
						y = e.clientY - cursor.height() / 2;
					
					requestAnimationFrame(function () {
						transformCursor(x, y);
					});
				}
				
				$(window).on('mousemove', handleMove);
			})
			
		}
	}
	
	function qodefPortfolioFilterToggle() {
		
		$('.qodef-pl-filter-toggle').on('click', function(e){
			e.preventDefault();
			e.stopPropagation();
			
			var toggleWidth = $('.qodef-plf-inner ul').width() == 0 ? '85%' : '0';
			if(toggleWidth == 0) {
				$('.qodef-plf-inner ul').delay(250).animate({
					width: toggleWidth
				});
			} else {
				$('.qodef-plf-inner ul').delay(50).animate({
					width: toggleWidth
				});
			}
		});
	}
	
	function qodefPortfolioParallaxList() {
		var $list = $('.qodef-pl-parallax'),
			$items = $('.qodef-pl-parallax article'),
			$textItems = $('.qodef-pli-parallax-text-item');

		var crop = function($item, i) {
			var rItem = $item[0].getBoundingClientRect(),
				rText = $textItems.eq(i)[0].getBoundingClientRect();

			var c = 1 - (rItem.top + rItem.height - rText.top)/(rText.height);

			c= Math.min(Math.max(c,0),1);

			$textItems.eq(i).find('.qodef-pli-helper-1').css({
				'transform': 'translate3d(0,-'+c*100+'%,0)'
			});			
			$textItems.eq(i).find('.qodef-pli-helper-2').css({
				'transform': 'translate3d(0,'+c*100+'%,0)'
			});
			$textItems.eq(i + 1).find('.qodef-pli-helper-1').css({
				'transform': 'translate3d(0,'+(1-c)*100+'%,0)'
			});
			$textItems.eq(i + 1).find('.qodef-pli-helper-2').css({
				'transform': 'translate3d(0,-'+(1-c)*100+'%,0)'
			});
		}

		var render = function() {
			$items.each(function(i) {
				var $item = $(this),
					rect = $item[0].getBoundingClientRect();

				rect.top < 0 &&  rect.top + rect.height > 0 && crop($item, i);
			})

			requestAnimationFrame(render);
		}

		var setPositions = function() {
			$textItems.find('.qodef-pli-helper-1').css({
				'transform': 'translate3d(0,100%,0)'
			})			
			$textItems.find('.qodef-pli-helper-2').css({
				'transform': 'translate3d(0,-100%,0)'
			});
			qodef.scroll == 0 && $textItems.first().find('div[class*="helper"]').css({
				'transform': 'translate3d(0,0,0)'
			});
		}

		var init = function() {
			$list.addClass('init');
			setPositions();
			requestAnimationFrame(render);
		}
		
		return {
			init: function() {
				$list.length && init();
			}
		}
	}

	function qodefPortfolioFollowInfo() {
		var $list = $('.qodef-pl-gallery-follow-info'),
			$articles = $('.qodef-pl-gallery-follow-info article'),
			eX, eY, active = false,
			cursor;

		var handleMove = function(e) {
			eX = e.clientX;
			eY = e.clientY
		}

		var showCursor = function() {
			if (!active)  {
				active = true;
				cursor.classList.add('-show');
			}
		}

		var hideCursor = function() {
			if (active) {
				active = false;
				cursor.classList.remove('-show');
			}
		}

		var render = function() {
			if (active) {
				cursor.style.top = eY + 'px';
				cursor.style.left = eX + 'px';
			}

			requestAnimationFrame(render);
		}

		var addHTML = function() {
			cursor = document.createElement('div');
			cursor.setAttribute('id', 'qodef-pl-info-cursor');
			document.body.appendChild(cursor);
		}

		var changeText = function() {
			var html = $(this).find('.qodef-pli-text').html();
			cursor.innerHTML = html;
		}

		var init = function() {
			$list.on('mousemove', handleMove);
			$articles.on('mousemove', showCursor);
			$articles.on('mouseleave', hideCursor);
			$articles.on('mouseenter', changeText);
			window.addEventListener('scroll', hideCursor);
			addHTML();
			requestAnimationFrame(render);
		}
		
		return {
			init: function() {
				$list.length && !Modernizr.touch && init();
			}
		}
	}

	function qodefInitElementorPortfolioList(){
		$(window).on('elementor/frontend/init', function () {
			elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_portfolio_list.default', function() {
				qodefInitPortfolioFilter();
				qodefInitPortfolioListAnimation();
				qodefInitPortfolioPagination().init();
				qodefPortfolioFilterToggle();
				qodefInitPortfolioHoverArrow();
				qodefPortfolioParallaxList().init();
				qodefPortfolioFollowInfo().init();
			} );
		});
	}

})(jQuery);
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
(function($) {
    'use strict';

    var portfolioVerticalLoop = {};
    qodef.modules.portfolioVerticalLoop = portfolioVerticalLoop;

    portfolioVerticalLoop.qodefOnDocumentReady = qodefOnDocumentReady;
    portfolioVerticalLoop.qodefInitElementorPortfolioVerticalLoop = qodefInitElementorPortfolioVerticalLoop;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);

    function qodefOnDocumentReady() {
        qodefInitPortfolioVerticalLoop();
    }

    function qodefOnWindowLoad() {
        qodefInitElementorPortfolioVerticalLoop();
    }

    function qodefInitPortfolioVerticalLoop(){
        var portfolioVerticalLoopHolder = $('.qodef-portfolio-vertical-loop-holder');

        if(portfolioVerticalLoopHolder.length) {
            portfolioVerticalLoopHolder.each(function() {
                var thisPortfolioVerticalLoop = $(this),
                    header = $('.qodef-page-header'),
                    mobileHeader = $('.qodef-mobile-header'),
                    headerAddition,
                    normalHeaderAddition,
                    headerHeight = header.outerHeight(),
                    paspartuWidth = qodef.body.hasClass('qodef-paspartu-enabled') ? parseInt($('.qodef-paspartu-enabled .qodef-wrapper').css('padding-left')) : 0;

                if (qodef.body.hasClass('qodef-content-is-behind-header')) {
                    normalHeaderAddition = 0;
                } else {
                    normalHeaderAddition = headerHeight;
                }

                var click = true;

                var container = $('.qodef-pvl-inner');
                $(qodef.body).on('click', '.qodef-pvli-content-holder .qodef-pvli-content-link', function (e) {
                    e.preventDefault();
                    if (click) {
                        click = false;
                        var thisLink = $(this);

                        //check for mobile header
                        if (qodef.windowWidth < 1000) {
                            headerAddition = mobileHeader.outerHeight();
                        } else {
                            headerAddition = normalHeaderAddition;
                        }

                        var scrollTop = qodef.window.scrollTop(),
                            elementOffset = thisLink.closest('article').offset().top,
                            distance = (elementOffset - scrollTop) - headerAddition - paspartuWidth;

                        container.find('article:eq(0)').addClass('fade-out');
                        thisLink.closest('article').addClass('move-up').removeClass('next-item').css('transform', 'translateY(-' + distance + 'px)');
                        setTimeout(function () {
                            qodef.window.scrollTop(0);
                            container.find('article:eq(0)').remove();
                            thisLink.closest('article').removeAttr('style').removeClass('move-up');
                        }, 450);

                        var loadMoreData = qodef.modules.common.getLoadMoreData(thisPortfolioVerticalLoop);

                        var ajaxData = qodef.modules.common.setLoadMoreAjaxData(loadMoreData, 'struktur_core_portfolio_vertical_loop_ajax_load_more');

                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: qodefGlobalVars.vars.qodefAjaxUrl,
                            success: function (data) {

                                var response = $.parseJSON(data),
                                    responseHtml = response.html,
                                    nextItemId = response.next_item_id;
                                thisPortfolioVerticalLoop.data('next-item-id', nextItemId);

                                var nextItem = $(responseHtml).find('.qodef-pvl-item-inner').parent().addClass('next-item').fadeIn(400);
                                container.append(nextItem);
                                click = true;
                            }
                        });

                        // load navigation
                        qodefPortfolioVerticalLoopNavigation(thisPortfolioVerticalLoop);
                    }
                    else {
                        return false;
                    }
                });

                //load next item on page load
                qodefPortfolioVerticalLoopNextItem(thisPortfolioVerticalLoop, container);

            });
        }
    }

    function qodefPortfolioVerticalLoopNextItem(portfolioVerticalLoopHolder, container){
        var navHolder = portfolioVerticalLoopHolder.find('.qodef-pvl-navigation-holder'),
            navigation = navHolder.find('.qodef-pvl-navigation');

        if (typeof navHolder.data('id') !== 'undefined' && navHolder.data('id') !== false) {
            var navItemId = navHolder.data('id');
        }

        if (typeof navHolder.data('next-item-id') !== 'undefined' && navHolder.data('next-item-id') !== false) {
            var navNextItemId = navHolder.data('next-item-id');
        }


        if (typeof portfolioVerticalLoopHolder.data('id') === 'undefined' || portfolioVerticalLoopHolder.data('id') !== false) {
            portfolioVerticalLoopHolder.data('id', navItemId);
        }

        if (typeof portfolioVerticalLoopHolder.data('next-item-id') === 'undefined' || portfolioVerticalLoopHolder.data('next-item-id') === false) {
            portfolioVerticalLoopHolder.data('next-item-id', navNextItemId);
        }

        var loadMoreInitialData = qodef.modules.common.getLoadMoreData(portfolioVerticalLoopHolder),
            ajaxInitialData = qodef.modules.common.setLoadMoreAjaxData(loadMoreInitialData, 'struktur_core_portfolio_vertical_loop_ajax_load_more');

        $.ajax({
            type: 'POST',
            data: ajaxInitialData,
            url: qodefGlobalVars.vars.qodefAjaxUrl,
            success: function (data) {
                var response = $.parseJSON(data),
                    responseHtml = response.html,
                    nextItemId = response.next_item_id;
                portfolioVerticalLoopHolder.data('next-item-id', nextItemId);

                var nextItem = $(responseHtml).find('.qodef-pvl-item-inner').parent().addClass('next-item').fadeIn(400);
                container.append(nextItem);
            }
        });
    }

    function qodefPortfolioVerticalLoopNavigation(portfolioVerticalLoopHolder){
        var navHolder = portfolioVerticalLoopHolder.find('.qodef-pvl-navigation-holder'),
            navigation = navHolder.find('.qodef-pvl-navigation'),
            loadMoreNavData = qodef.modules.common.getLoadMoreData(navHolder);

        var ajaxDataNav = qodef.modules.common.setLoadMoreAjaxData(loadMoreNavData, 'struktur_core_portfolio_vertical_loop_ajax_load_more_navigation');

        $.ajax({
            type: 'POST',
            data: ajaxDataNav,
            url: qodefGlobalVars.vars.qodefAjaxUrl,
            success: function (data) {
                var response = $.parseJSON(data),
                    responseHtml = response.html,
                    nextItemId = response.next_item_id;

                navHolder.data('next-item-id', nextItemId);

                navHolder.html(responseHtml);
            }
        });
    }

    function qodefInitElementorPortfolioVerticalLoop(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_portfolio_vertical_loop.default', function() {

            } );
        });
    }

})(jQuery);
(function ($) {
    'use strict';

    var testimonialsCarousel = {};
    qodef.modules.testimonialsCarousel = testimonialsCarousel;

    testimonialsCarousel.qodefInitTestimonials = qodefInitTestimonialsCarousel;
    testimonialsCarousel.qodefInitElementorTestimonials = qodefInitElementorTestimonials;

    testimonialsCarousel.qodefOnWindowLoad = qodefOnWindowLoad;

    $(window).load(qodefOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function qodefOnWindowLoad() {
        qodefInitTestimonialsCarousel();
        qodefInitElementorTestimonials();
    }

    /**
     * Init testimonials shortcode elegant type
     */
    function qodefInitTestimonialsCarousel(){
        var testimonial = $('.qodef-testimonials-holder.qodef-testimonials-carousel');

        if(testimonial.length){
            testimonial.each(function(){
                var thisTestimonials = $(this),
                    mainTestimonialsSlider = thisTestimonials.find('.qodef-testimonials-main'),
                    imagePagSlider = thisTestimonials.children('.qodef-testimonial-image-nav'),
                    loop = true,
                    autoplay = true,
                    sliderSpeed = 5000,
                    sliderSpeedAnimation = 600,
                    mouseDrag = false;

                if (mainTestimonialsSlider.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (mainTestimonialsSlider.data('enable-autoplay') === 'no') {
                    autoplay = false;
                }
                if (typeof mainTestimonialsSlider.data('slider-speed') !== 'undefined' && mainTestimonialsSlider.data('slider-speed') !== false) {
                    sliderSpeed = mainTestimonialsSlider.data('slider-speed');
                }
                if (typeof mainTestimonialsSlider.data('slider-speed-animation') !== 'undefined' && mainTestimonialsSlider.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = mainTestimonialsSlider.data('slider-speed-animation');
                }
                if(qodef.windowWidth < 680){
                    mouseDrag = true;
                }

                if (mainTestimonialsSlider.length && imagePagSlider.length) {
                    var text = mainTestimonialsSlider.owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        autoplayHoverPause: false,
                        dots: false,
                        nav: false,
                        mouseDrag: false,
                        touchDrag: mouseDrag,
                        onInitialize: function () {
                            mainTestimonialsSlider.css('visibility', 'visible');
                        }
                    });

                    var image = imagePagSlider.owlCarousel({
                        loop: loop,
                        autoplay: autoplay,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        autoplayHoverPause: false,
                        center: true,
                        dots: false,
                        nav: false,
                        mouseDrag: false,
                        touchDrag: false,
                        responsive: {
                            1025: {
                                items: 5
                            },
                            0: {
                                items: 3
                            }
                        },
                        onInitialize: function () {
                            imagePagSlider.css('visibility', 'visible');
                            thisTestimonials.css('opacity', '1');
                        }
                    });

                    imagePagSlider.find('.owl-item').on('click touchpress', function (e) {
                        e.preventDefault();

                        var thisItem = $(this),
                            itemIndex = thisItem.index(),
                            numberOfClones = imagePagSlider.find('.owl-item.cloned').length,
                            modifiedItems = itemIndex - numberOfClones / 2 >= 0 ? itemIndex - numberOfClones / 2 : itemIndex;

                        image.trigger('to.owl.carousel', modifiedItems);
                        text.trigger('to.owl.carousel', modifiedItems);
                    });

                }
            });
        }
    }

    function qodefInitElementorTestimonials(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_testimonials.default', function() {
                qodef.modules.common.qodefAddAppearClass().init();
            } );
        });
    }

})(jQuery);