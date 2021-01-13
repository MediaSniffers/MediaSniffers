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