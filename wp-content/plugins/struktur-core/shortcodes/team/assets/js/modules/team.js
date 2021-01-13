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