<?php
/**
 * Plugin Name: Stencil: Twig Implementation
 * Plugin URI: https://github.com/moorscode/stencil/
 * Description: Twig Stencil Implementation. This plugin enables the use of Twig in your theme. This implementation requires the plugin "Stencil" to be installed and active.
 * Version: 1.0.0
 * Author: Jip Moors
 * Author URI: http://www.jipmoors.nl
 * Text Domain: stencil
 * License: GPL2
 *
 * Stencil - Twig addon is free software: you can redistribute it
 * and/or modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 2 of the
 * License, or any later version.
 *
 * Stencil - Twig addon is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Stencil - Twig addon.
 * If not, see http://www.gnu.org/licenses/gpl-2.0.html.
 *
 * @package Stencil
 * @subpackage Twig
 */

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( ! function_exists( '__stencil_twig_register' ) ) :

	include( 'stencil-dependency.php' );

	add_filter( 'stencil:register-engine', '__stencil_twig_register' );

	/**
	 * Register this implementation to Stencil
	 *
	 * @param array $engines Currently registered engines.
	 *
	 * @return array
	 */
	function __stencil_twig_register( $engines ) {
		$engine    = 'Twig';
		$engines[] = $engine;

		add_action( 'stencil.activate-' . $engine, '__stencil_twig_activate' );

		return $engines;
	}

	/**
	 * On activation, include engine file.
	 */
	function __stencil_twig_activate() {
		include_once( 'stencil-engine.php' );
	}

	/**
	 * Load plugin textdomain
	 */
	add_action(
		'plugins_loaded',
		create_function(
			'',
			"load_plugin_textdomain( 'stencil', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );"
		)
	);

endif;
