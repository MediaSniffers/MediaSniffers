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