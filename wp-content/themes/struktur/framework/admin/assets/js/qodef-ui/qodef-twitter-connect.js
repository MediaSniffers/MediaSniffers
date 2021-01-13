(function($) {
    "use strict";

	$(document).ready(function () {
		qodefTwitterRequestToken();
	});
	
	function qodefTwitterRequestToken() {
		var twButton = $('#qodef-tw-request-token-btn');
		
		if (twButton.length) {
			twButton.on('click', function (e) {
				e.preventDefault();
				
				var thisButton = $(this),
					currentPageUrl = $('input[data-name="current-page-url"]').val();
				
				//@TODO get this from data attr
				thisButton.text('Working...');
				
				var data = {
					action: 'struktur_select_twitter_obtain_request_token',
					currentPageUrl: currentPageUrl,
					twitter_connect_nonce: $('input[name="qodef_twitter_connect_nonce"]').val()
				};
				
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: data,
					dataType: 'json',
					success: function (response) {
						if (typeof response.status !== 'undefined' && response.status) {
							thisButton.text('Redirect to Twitter...');
							
							if (typeof response.redirectURL !== 'undefined' && response.redirectURL !== '') {
								window.location = response.redirectURL;
							}
						} else {
							alert(response.message);
						}
					}
				});
			});
		}
	}
	
})(jQuery);