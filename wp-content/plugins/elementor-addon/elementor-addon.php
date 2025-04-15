<?php
/**
 * Plugin Name: Elementor Addon
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-addon
 */

function register_hello_world_widget( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/totalServices.php' );
    require_once( __DIR__ . '/widgets/totalServicesq.php' );
    require_once( __DIR__ . '/widgets/stSection.php' );
    require_once( __DIR__ . '/widgets/ndSection.php' );

    $widgets_manager->register( new \Elementor_totalServices() );
    $widgets_manager->register( new \Elementor_totalServicesq() );
    $widgets_manager->register( new \Elementor_stSection() );
    $widgets_manager->register( new \Elementor_ndSection() );


}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );