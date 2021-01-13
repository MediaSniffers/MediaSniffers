<?php

namespace StrukturCore\Lib;

/**
 * interface PostTypeInterface
 * @package StrukturCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}