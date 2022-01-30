<?php
/**
 * Plugin Name:       MCQ System
 * Plugin URI:        https://example.com/
 * Description:       This is a MCQ System plugin
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      5.6
 * Author:            Rajan K.
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mcq-system
 * Domain Path:       /languages/
 */

//Prevent Direct access
defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin main class
 */
final class MCQ_System {
    /**
     * Plugin version
     * 
     * @var string VERSION
     */
    const VERSION = '1.0.0';

    /**
     * Plugin instance
     * 
     * @var string $instance
     */
    private static $instance = null;

    /**
     * Class constructor
     */
    private function __construct() {
        $this->define_constants();

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Hook the plugin
     * 
     * @return void
     */
    public function init_plugin() {
        new Rajan\McqSystem\Assets();
        new Rajan\McqSystem\McqPostType();
        new Rajan\McqSystem\Shortcode();
        new Rajan\McqSystem\Adminmenu();
    }

    /**
     * Define necessary constants
     * 
     * @return void
     */
    public function define_constants() {
        define( 'MCQ_VERSION', self::VERSION );
        define( 'MCQ_PATH', __DIR__ );
        define( 'MCQ_FILE', __FILE__ );
        define( 'MCQ_URL', plugins_url( '', MCQ_FILE ) );
        define( 'MCQ_ASSETS', MCQ_URL . '/assets' );
        define( 'MCQ_REACT_APP', MCQ_URL . '/build' );
    }

    /**
     * Initialize a singleton instance
     * 
     * @return MCQ_System
     */
    public static function init() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

/**
 * Initialize the plugin
 * 
 * @return MCQ_System
 */
function mcq_boot() {
    return MCQ_System::init();
}

//Start the plugin
mcq_boot();