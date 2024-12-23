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
    require_once( __DIR__ . '/widgets/totalServices.php' );
    require_once( __DIR__ . '/widgets/fullSizeImage.php' );
    require_once( __DIR__ . '/widgets/applyCTAButton.php' );
    require_once( __DIR__ . '/widgets/propertyMapWidget.php' );
    require_once( __DIR__ . '/widgets/richText.php' );
	

    $widgets_manager->register( new \Elementor_switchSideImage() );
    $widgets_manager->register( new \Elementor_totalServices() );
    $widgets_manager->register( new \Elementor_fullSizeImage() );
    $widgets_manager->register( new \Elementor_applyCTAButton() );
    $widgets_manager->register( new \Elementor_PropertyMapWidget() );
    $widgets_manager->register( new \Elementor_richText() );


}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );