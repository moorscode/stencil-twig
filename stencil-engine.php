<?php
/**
 * Engine code
 *
 * @package Stencil
 * @subpackage Twig
 */

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( class_exists( 'Stencil_Container_Implementation' ) ) :

	add_action( 'init', create_function( '', 'new Stencil_Twig();' ) );

	/**
	 * Class StencilTwig
	 *
	 * Implementation of the "Twig" templating engine
	 */
	class Stencil_Twig extends Stencil_Container_Implementation {

		/**
		 * Initialize Twig and set defaults
		 */
		public function __construct() {
			parent::__construct();

			require_once( 'lib/Twig/Autoloader.php' );

			Twig_Autoloader::register( true );

			$loader       = new Twig_Loader_Filesystem( $this->template_path );
			$this->engine = new Twig_Environment(
				$loader,
				array(
					// 'cache' => $this->cache_path,
				)
			);

			$this->template_extension = 'html';

			$this->ready();
		}

		/**
		 * Fetches the Smarty compiled template
		 *
		 * @param string $template Template file to get.
		 *
		 * @return string
		 */
		function fetch( $template ) {
			return $this->engine->render( $template, $this->variables );
		}
	}

endif;
