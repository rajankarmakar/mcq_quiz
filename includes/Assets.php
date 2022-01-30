<?php

namespace Rajan\McqSystem;

defined( 'ABSPATH' ) || exit;

/**
 * Assets class
 */
class Assets {
    /**
     * Frontend hook name
     * 
     * @var string
     */
    public $frontend_hook = 'wp_enqueue_scripts';

    /**
     * Frontend hook name
     * 
     * @var string
     */
    public $backend_hook = 'admin_enqueue_scripts';

    /**
     * Class constructor
     */
    public function __construct() {
        add_action( $this->frontend_hook, [ $this, 'register_assets' ] );
        add_action( $this->backend_hook, [ $this, 'register_assets' ] );
    }

    /**
     * Register scripts
     * 
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();

        foreach ( $scripts as $handle => $script ) {
            wp_register_script( $handle, $script[ 'src' ], $script[ 'deps' ], $script[ 'version' ], true );
        }
    }

    /**
     * Get scripts
     * 
     * @return array
     */
    public function get_scripts() {
        $args = require MCQ_PATH . '/build/index.asset.php';
        // $args[ 'dependencies' ][] = 'wp-scripts';
        error_log( 'path -: ' . print_r( $args, 1 ) );
        $scripts = [
            'react-app' => [
                'src'     => MCQ_REACT_APP . '/index.js',
                'deps'    => $args[ 'dependencies' ],
                'version' => $args['version']
            ],
            'handle-shortcode' => [
                'src'     => MCQ_ASSETS . '/js/handle-shortcode.js',
                'deps'    => [ 'jquery' ],
                'version' => time()
            ],
        ];

        return apply_filters( 'mcq_register_scripts', $scripts );
    }
}
