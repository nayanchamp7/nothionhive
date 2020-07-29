<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;


/**
 * TwentyTwenty child theme enqueue files
 * 
 * @since 1.0
 */
add_action('wp_enqueue_scripts', 'viserx_enqueue_styles');
function viserx_enqueue_styles()
{
    $parenthandle = 'understrap-styles';
    $theme = wp_get_theme();
    $theme_version = $theme->get('Version');



    //parent theme styles
    wp_enqueue_style(
        $parenthandle,
        get_template_directory_uri() . '/css/theme.min.css',
        array(),
        $theme->parent()->get('Version')
    );

    // wp_dequeue_style( 'understrap-styles' );
    // wp_deregister_style( 'understrap-styles' );

    //child theme styles
    // wp_enqueue_style( 'notionhive-child-font-awesome', get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css');
    wp_enqueue_style(
        'notionhive-child-style',
        get_stylesheet_uri(),
        array($parenthandle),
        $theme->get('Version')
    );


    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'wp-util' );
    
    
	wp_enqueue_script( 'notionhive-child-scripts', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(), $theme_version, true );
}



/**
 * Theme options
 *
 * @package viserx
 */

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'     => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));
}


/**
 * Service Checklist Shortcode
 * 
 * @since 1.0
 */
if (!function_exists('nh_services_checklist')) {
    function nh_services_checklist() {

        if( ! function_exists( 'get_field' ) ) {
            return;
        }

        $service_items = get_field( 'service_checklist_items', 'option' );

        if( $service_items ) {

            ob_start(); ?>

            <div class="selection-container">

                <div class="headings">
                    <p><?php _e( 'Services', 'notionhive' ); ?></p>
                    <p><?php _e( 'Starts from', 'notionhive' ); ?></p>
                </div>

                <?php

                    $counter = 1;
                    foreach( $service_items as $service_item ) { ?>

                    <label class="box-field">
                        <div class="box-text-holder">

                            <div id="service-<?php echo $counter; ?>" class="box-service-name" data="<?php echo $service_item['service_checklist_title']; ?>">
                                <?php echo $service_item['service_checklist_title']; ?>
                                <?php echo sprintf( '<p class="package-detail">%s</p>', $service_item['service_checklist_content'] ); ?>
                            </div>

                            <div class="service-price">
                                <?php echo sprintf( '$<span id="price-%s">%s</span>', $counter, $service_item['service_checklist_price'] ); ?>
                            </div>
                        </div>
                        <input id="check-<?php echo $counter; ?>" data-price="<?php echo $service_item['service_checklist_price']; ?>" class="package-check check-one" type="checkbox">
                        <span class="checkmark"></span>
                    </label>

                <?php  $counter++; } ?>
                

                <div class="calculated-result">
                    <h6>Total</h6>
                    <h6 class="total-amount">$<span id="total"><span class="abs-total">2500<span>.00</span></h6>
                </div>

                <div class="avail-btn-container show" style="height: 50px;">
                    <a href="#contact-form-section" id="avail-btn" class="btn">Take Me To the Final Step</a>
                </div>

            </div>

            <?php
            return ob_get_clean();

        }
    }
}
add_shortcode('nh_services_checklist', 'nh_services_checklist');
