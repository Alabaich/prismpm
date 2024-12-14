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

    require_once( __DIR__ . '/widgets/switchSideImage.php' );
	

    $widgets_manager->register( new \Elementor_switchSideImage() );


}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );