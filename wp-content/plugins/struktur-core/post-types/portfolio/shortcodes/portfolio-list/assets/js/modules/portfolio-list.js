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