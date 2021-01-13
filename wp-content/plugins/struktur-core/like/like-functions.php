<?php

if ( ! function_exists( 'struktur_core_action_like' ) ) {
	/**
	 * Returns StrukturSelectClassLike instance
	 *
	 * @return StrukturSelectClassLike
	 */
	function struktur_core_action_like() {
		return StrukturSelectClassLike::get_instance();
	}
}

function struktur_core_get_like() {
	
	echo wp_kses( struktur_core_action_like()->add_like(), array(
		'span'  => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'     => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'     => array(
			'href'         => true,
			'class'        => true,
			'id'           => true,
			'title'        => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	) );
}