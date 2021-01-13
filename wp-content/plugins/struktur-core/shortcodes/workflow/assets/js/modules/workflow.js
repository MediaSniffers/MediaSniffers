(function($) {
	'use strict';
	
	var workflow = {};
	qodef.modules.workflow = workflow;

    workflow.qodefWorkflow = qodefWorkflow;
    workflow.qodefElementorWorkflow = qodefElementorWorkflow;

    workflow.qodefOnDocumentReady = qodefOnDocumentReady;
	
	$(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function qodefOnDocumentReady() {
        qodefWorkflow();
	}

    function qodefOnWindowLoad() {
        qodefElementorWorkflow();
    }

    function qodefWorkflow() {
        var workflowShortcodes = $('.qodef-workflow');
        if (workflowShortcodes.length) {
            workflowShortcodes.each(function () {
                var workflowShortcode = $(this);
                if (workflowShortcode.hasClass('qodef-workflow-animate')) {
                    var workflowItems = workflowShortcode.find('.qodef-workflow-item');

                    workflowShortcode.appear(function () {
                        workflowShortcode.addClass('qodef-appeared');
                        setTimeout(function () {
                            workflowItems.each(function (i) {
                                var workflowItem = $(this);
                                setTimeout(function () {
                                    workflowItem.addClass('qodef-appeared');
                                }, 350 * i);
                            });
                        }, 350);
                    }, {accX: 0, accY: qodefGlobalVars.vars.qodefElementAppearAmount});

                }
            });
        }
    }

    /**
     * Elementor
     */
    function qodefElementorWorkflow(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/qodef_workflow.default', function() {
                qodefWorkflow();
            } );
        });
    }
	
})(jQuery);