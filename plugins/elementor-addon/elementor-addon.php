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


     require_once(__DIR__ . '/widgets/heroSlider.php');
     require_once(__DIR__ . '/widgets/richTextWithBackground.php');
     require_once(__DIR__ . '/widgets/heroImage.php');
     require_once(__DIR__ . '/widgets/testimonialSection.php');
     require_once(__DIR__ . '/widgets/announceProperty.php');
     require_once(__DIR__ . '/widgets/showCaseSection.php');
     require_once(__DIR__ . '/widgets/blogShowCase.php');
     require_once(__DIR__ . '/widgets/socialSection.php');
     require_once(__DIR__ . '/widgets/circleSlider.php');
     require_once(__DIR__ . '/widgets/buildingPageAddition.php');
     require_once(__DIR__ . '/widgets/modelSuitesSection.php');
     require_once(__DIR__ . '/widgets/gallerySection.php');
     require_once(__DIR__ . '/widgets/advantageSection.php');
     require_once(__DIR__ . '/widgets/commitmentSection.php');
     require_once(__DIR__ . '/widgets/faq-accordion.php');
     require_once(__DIR__ . '/widgets/contactUsSection.php');
     require_once(__DIR__ . '/widgets/propertyMapWidgetNew.php');

     $widgets_manager->register(new \Elementor_heroSlider());
     $widgets_manager->register(new \Elementor_richTextWithBackground());
     $widgets_manager->register(new \Elementor_heroImage());
     $widgets_manager->register(new \Elementor_testimonialsSection());
     $widgets_manager->register(new \Elementor_announceProperty());
     $widgets_manager->register(new \Elementor_showCaseSection());
     $widgets_manager->register(new \Elementor_blogShowCase());
     $widgets_manager->register(new \Elementor_socialSection());
     $widgets_manager->register(new \Elementor_circleSlider());
     $widgets_manager->register(new \Elementor_buildingPageAddition());
     $widgets_manager->register(new \Elementor_modelSuitesSection());
     $widgets_manager->register(new \Elementor_gallerySection());
     $widgets_manager->register(new \Elementor_advantageSection());
     $widgets_manager->register(new \Elementor_commitmentSection());
     $widgets_manager->register(new \Elementor_faqAccordion());
     $widgets_manager->register(new \Elementor_contactUsSection());
     $widgets_manager->register(new \Elementor_propertyMapWidgetNew());



}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );