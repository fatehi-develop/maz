<?php
require_once "includes/template-functions.php";
require_once "includes/template-config.php";
require_once "includes/admin-rules.php";
require_once "includes/search-ajax.php";
require_once "includes/validation.php";
require_once "includes/xss_clean.php";
require_once "includes/websima-map/websima-map.php";
require_once "includes/websima-map-location/websima-map-location.php";
require_once "includes/acf-image-select/acf-image-select.php";
require_once "includes/websima-delivery/delivery-init.php";
require_once "includes/websima-sms/sms-init.php";
require_once "includes/websima-auth/websima-auth-init.php";
require_once "includes/websima-comment-sms/websima-comment-sms-init.php";
require_once "includes/websima-newsletter/websima-newsletter-init.php";
require_once "woocommerce/woocommerce-functions.php";
//require_once "includes/websima-captcha/captcha.php";

require_once "includes/thumbnails.php";


@ini_set( 'upload_max_size' , '64M');
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300');

// Customize excerpt word count length
function custom_excerpt_length()
{
    return 22;
}

add_filter('excerpt_length', 'custom_excerpt_length');

// Theme setup
function wordpressify_setup()
{
    // Handle Titles
    add_theme_support('title-tag');
    add_theme_support('woocommerce');

    // Add featured image support
    add_theme_support('post-thumbnails');
    add_image_size('small-thumbnail', 720, 720, true);
    add_image_size('square-thumbnail', 80, 80, true);
    add_image_size('banner-image', 1024, 1024, true);


    //register_nav_menu
    register_nav_menu('header-top-menu', 'منو بالای هدر');
    register_nav_menu('header-main-menu', 'منوی اصلی هدر');
}

add_action('after_setup_theme', 'wordpressify_setup');

function add_percentage_to_sale_badge($product)
{
    if ($product->is_type('variable')) {
        $percentages = array();

        // Get all variation prices
        $prices = $product->get_variation_prices();

        // Loop through variation prices
        foreach ($prices['price'] as $key => $price) {
            // Only on sale variations
            if ($prices['regular_price'][$key] !== $price) {
                // Calculate and set in the array the percentage for each variation on sale
                $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
            }
        }
        $percentage = max($percentages);
    } else {
        $regular_price = (float)$product->get_regular_price();
        $sale_price = (float)$product->get_sale_price();
        if ($sale_price && $regular_price) {
            $percentage = round(100 - ($sale_price / $regular_price * 100));
        }
    }
    return $percentage;
}

function get_date_on_sale_from($product)
{
    $sale_dates = array();

    if ($product->is_type('variable')) {
        $variation_ids = $product->get_visible_children();
        foreach ($variation_ids as $variation_id) {
            $variation = wc_get_product($variation_id);

            if ($variation->is_on_sale()) {
                $date_on_sale_from = $variation->get_date_on_sale_from();
                $date_on_sale_to = $variation->get_date_on_sale_to();

                if (!empty($date_on_sale_from) || !empty($date_on_sale_to)) {
                    $sale_dates[$variation_id] = array(
                        'from' => $date_on_sale_from,
                        'to' => $date_on_sale_to,
                    );
                }
            }
        }

        // Array row output
        print_r($sale_dates);
    }
}

function convertEnglishNumbersToPersian($input)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = [ 0 ,  1 ,  2 ,  3 ,  4 ,  5 ,  6 ,  7 ,  8 ,  9 ];
    return str_replace($english, $persian, $input);
}


function woo_scripts_cleaner()
{
    remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));
    if (!is_woocommerce() && !is_cart() && !is_checkout()) {
        $woo_styles = [
            'woocommerce_frontend_styles',
            'woocommerce-general',
            'woocommerce-layout',
            'woocommerce-smallscreen',
            'woocommerce_fancybox_styles',
            'woocommerce_chosen_styles',
            'woocommerce_prettyPhoto_css',
            'select2'
        ];
        $woo_scripts = [
            'wc-add-payment-method',
            'wc-lost-password',
            'wc_price_slider',
            'wc-single-product',
            'wc-add-to-cart',
            'wc-cart-fragments',
            'wc-credit-card-form',
            'wc-checkout',
            'wc-add-to-cart-variation',
            'wc-single-product',
            'wc-cart',
            'wc-chosen',
            'woocommerce',
            'prettyPhoto',
            'prettyPhoto-init',
            'jquery-blockui',
            'jquery-placeholder',
            'jquery-payment',
            'jqueryui',
            'fancybox',
            'wcqi-js',
        ];
        // Dequeue Styles
        foreach ($woo_styles as $style) {
            wp_dequeue_style($style);
        }
        // Dequeue scripts
        foreach ($woo_scripts as $script) {
            wp_dequeue_script($script);
        }

    }
}

add_action('wp_enqueue_scripts', 'woo_scripts_cleaner', 99);

