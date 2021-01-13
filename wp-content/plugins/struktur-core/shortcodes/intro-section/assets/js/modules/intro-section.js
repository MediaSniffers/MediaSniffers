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