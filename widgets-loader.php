<?php // ***** 2 theke 9 number line all eidt kora lagbe
/**
 * My New Plugin
 *
 * @package           myNewPlugin 
 * @author            Kibria
 * @copyright         2021 Kibria or Skill-ice
 * @license           GPL-2.0-or-later
 */

final class My_NewPlugin { // ***** My_NewPlugin name ta nijer moto kore ekhane o shobar laste Edite kora lage

	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';
	private static $_instance = null;
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	public function __construct() {  // ***** ekhane Styles/Scripts er function functionNeme diya Register ba add_action kora lage, check 46 & 54 line number "public function"

		add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

	}

	/**
	 * Load Textdomain
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 */
	public function i18n() {

		load_plugin_textdomain( 'my-New-Plugin' ); // ***** ekhane plugin text domain likhte hobe

	}

	public function widget_styles() { // ***** ekahne extra css er file add kora . eta ke conection korte go up 24 number line __construct

		wp_enqueue_style( 'froala-css', '//cdnjs.cloudflare.com/ajax/libs/froala-design-blocks/2.0.1/css/froala_blocks.min.css' );
		wp_enqueue_style( 'bootstrap-css', '//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css' );
		// wp_register_style( 'widget-1', plugins_url( 'css/widget-1.css', __FILE__ ) );
		// wp_register_style( 'widget-2', plugins_url( 'css/widget-2.css', __FILE__ ) );

	}
	public function widget_scripts() { // ***** ekahne extra js er file add kora . eta ke conection korte go up 24 number line __construct

		// wp_register_script( 'some-library', plugins_url( 'js/libs/some-library.js', __FILE__ ) );

		// wp_register_script( 'widget-1', plugins_url( 'js/widget-1.js', __FILE__ ) );
		wp_enqueue_script( 'bootstrap-js', "//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js");
		// wp_register_script( 'widget-2', plugins_url( 'js/widget-2.js', __FILE__ ), [ 'jquery', 'some-library' ] );

	}

	/**
	 * On Plugins Loaded
	 * Checks if Elementor has loaded, and performs some compatibility checks.
	 * If All checks pass, inits the plugin.
	 * Fired by `plugins_loaded` action hook.
	 */
	public function on_plugins_loaded() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 * Checks if the installed version of Elementor meets the plugin's minimum requirement.
	 * Checks if the installed PHP version meets the plugin's minimum requirement.
	 */
	public function is_compatible() { // ***** Admin er notice text er jonno niche 156/182/207 no line check

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Initialize the plugin
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Load the files required to run the plugin.
	 * Fired by `plugins_loaded` action hook.
	 */
	public function init() {
	
		$this->i18n();

		// Add Plugin actions // ***** amader je widget gulur function register er jonno, & function niche 130 no line
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		// add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] ); // kibria

		// for widget New categories add_action // ***** amader je widget er categorie function register er jonno, & function niche 141 no line
		add_action( 'elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories'] );

	}

	/**
	 * Init Widgets
	 * Include widgets files and register them
	 */
	public function init_widgets() {

		// Include Widget files
		require_once( plugin_dir_path(__FILE__). 'widgets/block_about.php' ); // ***** amader widget file name add joto hobe niche niche likhe jabo
		require_once( plugin_dir_path(__FILE__). 'widgets/block_team_images.php' ); 

		// Register widget // ***** widget file je "class My_NewPlugin_Widget extends \Elementor\Widget_Base" er My_NewPlugin_Widget emon name unujayi protita widget className ta ekahne likte hobe widget file theke niye
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \My_block_about() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \My_block_team_images() );

	}
 //-------------------- kibria start
// for widget New categories function // ***** eta new cat make korar jonno and conection to up 122 line
	function add_elementor_widget_categories( $manager ) {

		$manager->add_category(
			'mynewplugincat',// ***** new cat name
			[
				'title' => __( 'My New Plugin Cat', 'my-New-Plugin' ),
				'icon' => 'eicon-product-related',
			]
		);
	}

	/**
	 * Admin notice
	 * Warning when the site doesn't have Elementor installed or activated.
	 */
	public function admin_notice_missing_main_plugin() { // ***** notice 

	    if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
	        $notice_title = __( 'Activate Elementor', 'my-New-Plugin' );
	        $notice_url = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
	     }else{
	        $notice_title = __( 'Install Elementor', 'my-New-Plugin' );
	        $notice_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
	     }

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated "%3$s".', 'my-New-Plugin' ),
			'<strong>' . esc_html__( 'My New Plugin', 'my-New-Plugin' ) . '</strong>',// ***** amar plugin er name "My New Plugin" add kora lagbe
			'<strong>' . esc_html__( 'Elementor', 'my-New-Plugin' ) . '</strong>',
			'<a href="' . esc_url( $notice_url ) . '">' . $notice_title . '</a>'
		 );

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 * Warning when the site doesn't have a minimum required Elementor version.
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'my-New-Plugin' ),
			'<strong>' . esc_html__( 'My New Plugin', 'my-New-Plugin' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'my-New-Plugin' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'my-New-Plugin' ),
			'<strong>' . esc_html__( 'My New Plugin', 'my-New-Plugin' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'my-New-Plugin' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

}

My_NewPlugin::instance();