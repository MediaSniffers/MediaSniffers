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