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