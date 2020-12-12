<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * struktur_select_action_header_meta hook
	 *
	 * @see struktur_select_header_meta() - hooked with 10
	 * @see struktur_select_user_scalable_meta - hooked with 10
	 * @see struktur_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'struktur_select_action_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
	<?php do_action( 'struktur_select_action_after_opening_body_tag' ); ?>
    <div class="qodef-wrapper">
        <div class="qodef-wrapper-inner">
            <?php
            /**
             * struktur_select_action_after_wrapper_inner hook
             *
             * @see struktur_select_get_header() - hooked with 10
             * @see struktur_select_get_mobile_header() - hooked with 20
             * @see struktur_select_back_to_top_button() - hooked with 30
             * @see struktur_select_get_header_minimal_full_screen_menu() - hooked with 40
             * @see struktur_select_get_header_bottom_navigation() - hooked with 40
             */
            do_action( 'struktur_select_action_after_wrapper_inner' ); ?>
	        
            <div class="qodef-content" <?php struktur_select_content_elem_style_attr(); ?>>
                <div class="qodef-content-inner">