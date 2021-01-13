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