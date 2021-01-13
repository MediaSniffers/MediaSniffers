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