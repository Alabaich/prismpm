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

    require_once(__DIR__ . '/widgets/switchSideImage.php');
    require_once(__DIR__ . '/widgets/totalServices.php');
    require_once(__DIR__ . '/widgets/fullSizeImage.php');
    require_once(__DIR__ . '/widgets/applyCTAButton.php');
    require_once(__DIR__ . '/widgets/propertyMapWidget.php');
    require_once(__DIR__ . '/widgets/richText.php');
    require_once(__DIR__ . '/widgets/buildingsSlider.php');
    require_once(__DIR__ . '/widgets/PropertiesComingSoon.php');
    require_once(__DIR__ . '/widgets/aboutUs.php');



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
    require_once(__DIR__ . '/widgets/FullWidthSuitesSection.php');
    require_once(__DIR__ . '/widgets/fullScreenImage.php');






    require_once(__DIR__ . '/widgets/proudSection.php');
    require_once(__DIR__ . '/widgets/communityLifeSection.php');
    require_once(__DIR__ . '/widgets/neighborhoodsSection.php');
    require_once(__DIR__ . '/widgets/historySection.php');
    require_once(__DIR__ . '/widgets/infoSection.php');
    require_once(__DIR__ . '/widgets/discoverSection.php');

    $widgets_manager->register(new \Elementor_proudSection());
    $widgets_manager->register(new \Elementor_communityLifeSection());
    $widgets_manager->register(new \Elementor_neighborhoodsSection());
    $widgets_manager->register(new \Elementor_historySection());
    $widgets_manager->register(new \Elementor_infoSection());
    $widgets_manager->register(new \Elementor_discoverSection());



    require_once(__DIR__ . '/widgets/announcePropertyRow.php');
    require_once(__DIR__ . '/widgets/gridGallery.php');
    require_once(__DIR__ . '/widgets/scoreAnimatedSection.php');
    require_once(__DIR__ . '/widgets/gridGallery12.php');


    $widgets_manager->register(new \Elementor_announcePropertyRow());
    $widgets_manager->register(new \Elementor_gridGallery());
    $widgets_manager->register(new \Elementor_scoreAnimatedSection());
    $widgets_manager->register(new \Elementor_gridGallery12());
    




    
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
     $widgets_manager->register(new \Elementor_fullScreenImage());



    $widgets_manager->register(new \Elementor_switchSideImage());
    $widgets_manager->register(new \Elementor_totalServices());
    $widgets_manager->register(new \Elementor_fullSizeImage());
    $widgets_manager->register(new \Elementor_applyCTAButton());
    $widgets_manager->register(new \Elementor_PropertyMapWidget());
    $widgets_manager->register(new \Elementor_richText());
    $widgets_manager->register(new \Elementor_buildingsSlider());
    $widgets_manager->register(new \Elementor_PropertiesComingSoon());
    $widgets_manager->register(new \Elementor_aboutUs());
    $widgets_manager->register(new \Elementor_FullWidthSuitesSection());
}
add_action('elementor/widgets/register', 'register_hello_world_widget');
