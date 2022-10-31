<?php
namespace Testimonials_BforeAi;

use Testimonials_BforeAi\PageSettings\Page_Settings;


defined( 'TESTIMONIAL-BF_BASEPATH' ) || define( 'TESTIMONIAL-BF_BASEPATH', plugin_dir_path( __FILE__ ) );
defined( 'TESTIMONIAL-BF_BASEURI' ) || define( 'TESTIMONIAL-BF_BASEURI', plugin_dir_url( __FILE__ ) );

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'elementor-hello-world', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_enqueue_script( 'bootstrap.min.js',TESTIMONIAL-BF_BASEURI.'public/js/bootstrap.bundle.min.js', array('jquery'), '5.1.3', true );
		wp_enqueue_script( 'owl.carousel.min.js',TESTIMONIAL-BF_BASEURI.'public/js/owl.carousel.min.js', array('jquery'), $this->generarCodigo(3), true );
		wp_enqueue_script( 'w-dt.js',TESTIMONIAL-BF_BASEURI.'public/js/w-dt.js', array('jquery'), $this->generarCodigo(3), true );

		/** Enqueue plugin styles */
		wp_enqueue_style( 'bootstrap.min.css', TESTIMONIAL-BF_BASEURI.'public/css/bootstrap5.1.3.min.css', array(), '5.1.3');
		wp_enqueue_style( 'awesome.css', TESTIMONIAL-BF_BASEURI.'public/css/font-awesome.min.css', array(), '4.7.0');
		wp_enqueue_style( 'owl.carousel.min.css',TESTIMONIAL-BF_BASEURI.'public/css/owl.carousel.min.css', array(), $this->generarCodigo(3));
		wp_enqueue_style( 'animate.min.css',TESTIMONIAL-BF_BASEURI.'public/css/animate.min.css', array(), $this->generarCodigo(3));
		wp_enqueue_style( 'w-dt.css',TESTIMONIAL-BF_BASEURI.'public/css/w-dt.css', array(),$this->generarCodigo(3));
	
	}

	
	private function generarCodigo($length) {
		$rand_string = '';
		for($i = 0; $i < $length; $i++) {
			$number = random_int(0, 36);
			//$character = base_convert($number, 10, 36);
			$rand_string .= $number;
		}
		return $rand_string;
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'elementor-hello-world-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'elementor-hello-world-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		// require_once( __DIR__ . '/widgets/hello-world.php' );
		// require_once( __DIR__ . '/widgets/inline-editing.php' );
	
		require_once(__DIR__ . '/widgets/widget-testimonial.php');
		// Register Widgets
		$widgets_manager->register( new Widgets\WidgetsTestimonial() );
		// $widgets_manager->register( new Widgets\Inline_Editing() );
	}

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Plugin::instance();
