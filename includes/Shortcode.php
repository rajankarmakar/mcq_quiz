<?php

namespace Rajan\McqSystem;

defined( 'ABSPATH' ) || exit;

/**
 * Shortcode class
 */
class Shortcode {
    /**
     * Shortcode name
     * 
     * @var string $shortcode_name
     */
    public $shortcode_name = 'show_mcq';

    /**
     * Class constructor
     */
    public function __construct() {
        add_shortcode( $this->shortcode_name, [ $this, 'render_shortcode' ] );
    }

    /**
     * Render shortcode
     * 
     * @return string
     */
    public function render_shortcode() {
        wp_enqueue_script( 'react-app' );
        wp_enqueue_script( 'handle-shortcode' );

        $args = [
            'post_type' => 'mcq_system',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ];

        $data = [];
        $the_query = new \WP_Query( $args );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) : 
                $the_query->the_post();
                $data[]['title'] = the_title();
                // $data[]['choices'] = get_post_meta( get_the_id(), 'mcq_question' );
                $data[]['answer'] = get_post_meta( get_the_id(), 'mcq_answer' );
            endwhile;
        }
        // return "<div id='react-app'></div>";
        ob_start();
        include MCQ_PATH . '/template/shortcode-template.php';
        return ob_get_clean();
    }

}
