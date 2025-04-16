<?php
/**
 * Plugin Name: Elementor Addon
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-addon
 */

function register_hello_world_widget($widgets_manager)
{

    require_once(__DIR__ . '/widgets/HeroSlider.php');
    require_once(__DIR__ . '/widgets/richTextWithBackground.php');
    require_once(__DIR__ . '/widgets/heroImage.php');
    require_once(__DIR__ . '/widgets/testimonialSection.php');
    require_once(__DIR__ . '/widgets/announceProperty.php');
    require_once(__DIR__ . '/widgets/showCaseSection.php');
    require_once(__DIR__ . '/widgets/blogShowCase.php');
    require_once(__DIR__ . '/widgets/socialSection.php');
    require_once(__DIR__ . '/widgets/circuleSlider.php');


    $widgets_manager->register(new \Elementor_heroSlider());
    $widgets_manager->register(new \Elementor_richTextWithBackground());
    $widgets_manager->register(new \Elementor_heroImage());
    $widgets_manager->register(new \Elementor_testimonialsSection());
    $widgets_manager->register(new \Elementor_announceProperty());
    $widgets_manager->register(new \Elementor_showCaseSection());
    $widgets_manager->register(new \Elementor_blogShowCase());
    $widgets_manager->register(new \Elementor_socialSection());
    $widgets_manager->register(new \Elementor_circuleSlider());

}

add_action('elementor/widgets/register', 'register_hello_world_widget');