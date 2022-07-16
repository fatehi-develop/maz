<?php
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action('woocommerce_after_single_product', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 6);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);
function new_loop_shop_per_page($cols)
{
    $cols = 6;
    return $cols;
}

add_filter('woocommerce_default_catalog_orderby', 'misha_default_catalog_orderby');
function misha_default_catalog_orderby($sort_by)
{
    return 'date';
}

add_filter('woocommerce_layered_nav_count', '__return_false');


add_filter('woocommerce_enqueue_styles', 'jk_dequeue_styles');
function jk_dequeue_styles($enqueue_styles)
{
    unset($enqueue_styles['woocommerce-general']);    // Remove the gloss
    unset($enqueue_styles['woocommerce-layout']);        // Remove the layout
    unset($enqueue_styles['woocommerce-smallscreen']);    // Remove the smallscreen optimisation
    return $enqueue_styles;
}

add_action('wp', 'bbloomer_remove_sidebar_product_pages');

function bbloomer_remove_sidebar_product_pages()
{
    if (is_product()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}

/**
 * Remove the breadcrumbs
 */
add_action('init', 'woo_remove_wc_breadcrumbs');
function woo_remove_wc_breadcrumbs()
{
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}


add_action('woocommerce_after_single_product_summary', 'move_tags_product_to_end_tab', 11);
function move_tags_product_to_end_tab()
{
    global $product;
    echo wc_get_product_tag_list($product->get_id(), ' ', '<div class="tagged_as">' . _n('', 'برچسب ها :', count($product->get_tag_ids()), 'woocommerce') . ' ', '</span>');
}


if (!function_exists('is_archive_product')) {
    function is_archive_product()
    {
        if ((is_woocommerce() && is_tax()) || is_shop()) {
            return true;
        }
        return false;
    }
}

if (!function_exists('websima_list_products')) {
    function websima_list_products($query = 'recent_products', $count = 6, $ids = null, $cat = null)
    {
        /*
         * recent_products
         * featured_products
         * best_selling_products
         * sale_products
         * top_rated_products
         */
        $html = '';
        $id_products = '';
        $slug = '';
        if ($ids != null) $id_products = implode(",", $ids);
        if ($cat != null) {
            $term = get_term($cat, 'product_cat');
            $slug = $term->slug;
        }
        $html .= do_shortcode("[" . $query . " limit='" . $count . "' category='" . $slug . "' ids='" . $id_products . "']");
        return $html;
    }
}


add_action('wp_footer', 'bbloomer_add_cart_quantity_plus_minus');
function bbloomer_add_cart_quantity_plus_minus()
{
    // Only run this on the single product page
    //if ( ! is_product() ) return;
    if (is_cart() || is_product()) {
?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {

                $('.woocommerce').on('click', 'form.woocommerce-cart-form .plus,form.woocommerce-cart-form .minus', function(e) {
                    e.preventDefault();
                    setTimeout(function() {
                        jQuery('[name="update_cart"]').trigger('click');
                    }, 100);

                    // Get current quantity values
                    var qty = $(this).parent().find('.qty');
                    var btnupdate = $('form.woocommerce-cart-form').find('button[name="update_cart"]');
                    var val = parseInt(qty.val());
                    var max = qty.attr('max');
                    var min = qty.attr('min');
                    var step = parseInt(qty.attr('step'));

                    //console.log(max);
                    // Change the value if plus or minus
                    if ($(this).is('.plus')) {
                        if (max && (max <= val)) {
                            qty.val(max);
                        } else {
                            qty.val(val + step);
                        }
                    } else {
                        if (min && (min >= val)) {
                            qty.val(min);
                        } else if (val > 1) {
                            qty.val(val - step);
                        }
                    }
                    btnupdate.removeAttr('disabled');
                });

                $('form.cart').on('click', 'button.plus, button.minus', function(e) {
                    e.preventDefault();

                    // Get current quantity values
                    var qty = $(this).closest('form.cart').find('.qty');
                    var val = parseFloat(qty.val());
                    var max = parseFloat(qty.attr('max'));
                    var min = parseFloat(qty.attr('min'));
                    var step = parseFloat(qty.attr('step'));

                    // Change the value if plus or minus
                    if ($(this).is('.plus')) {
                        if (max && (max <= val)) {
                            qty.val(max);
                        } else {
                            qty.val(val + step);
                        }
                    } else {
                        if (min && (min >= val)) {
                            qty.val(min);
                        } else if (val > 1) {
                            qty.val(val - step);
                        }
                    }
                });
            });
        </script>
    <?php
    }
}

add_action('wp_footer', 'bbloomer_cart_refresh_update_qty');
function bbloomer_cart_refresh_update_qty()
{
    if (is_cart()) {
    ?>
        <script type="text/javascript">
            jQuery('div.woocommerce').on('change', 'input.qty', function() {
                setTimeout(function() {
                    jQuery('[name="update_cart"]').trigger('click');
                }, 100);
            });
        </script>
<?php
    }
}


function wc_varb_price_range($wcv_price, $product)
{

    $prefix = sprintf('%s ', __('', 'wcvp_range'));

    $wcv_reg_min_price = $product->get_variation_regular_price('min', true);
    $wcv_min_sale_price    = $product->get_variation_sale_price('min', true);
    $wcv_max_price = $product->get_variation_price('max', true);
    $wcv_min_price = $product->get_variation_price('min', true);

    $wcv_price = ($wcv_min_sale_price == $wcv_reg_min_price) ?
        wc_price($wcv_reg_min_price) :
        '<del>' . wc_price($wcv_reg_min_price) . '</del>' . '<ins>' . wc_price($wcv_min_sale_price) . '</ins>';

    return ($wcv_min_price == $wcv_max_price) ?
        $wcv_price :
        sprintf('%s%s', $prefix, $wcv_price);
}


add_filter('woocommerce_variable_sale_price_html', 'wc_varb_price_range', 10, 2);
add_filter('woocommerce_variable_price_html', 'wc_varb_price_range', 10, 2);


/* Redirects to the Orders List instead of Woocommerce My Account Dashboard */
function wpmu_woocommerce_account_redirect()
{

    $current_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $dashboard_url = get_permalink(get_option('woocommerce_myaccount_page_id'));

    if (is_user_logged_in() && $dashboard_url == $current_url) {
        $url = get_home_url() . '/my-account/orders';
        wp_redirect($url);
        exit;
    }
}
add_action('template_redirect', 'wpmu_woocommerce_account_redirect');

/* Remove the Dashboard tab of the My Account Page */
function custom_account_menu_items($items)
{
    unset($items['dashboard']);
    unset($items['downloads']);
    //unset($items['edit-address']);
    //unset($items['edit-account']);
    return $items;
}
add_filter('woocommerce_account_menu_items', 'custom_account_menu_items');

register_sidebar(array(
    'name' => 'سایدبار فروشگاه',
    'id' => 'sidebar_shop',
    'before_widget' => '<div id="%1$s" class="widget widget-side mb-4 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<div class="widget-title"><h4>',
    'after_title' => '</h4></div>',
));

remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination');
add_action('woocommerce_after_shop_loop', function ($query = null) {
    $args = array(
        'type' => 'list',
        'prev_text' => "<i class='icon-chevron-thin-right'></i>",
        'next_text' => "<i class='icon-chevron-thin-left'></i>",
    );
    if ($query != '') $args['total'] = $query->max_num_pages;
    echo paginate_links($args);
});


/**
 * After setup theme
 **/
add_action('after_setup_theme', 'websima_after_theme_setup');
function websima_after_theme_setup()
{
    add_theme_support('woocommerce');
    add_theme_support('html5', array('style', 'script'));
    remove_theme_support('wc-product-gallery-zoom');
    remove_theme_support('wc-product-gallery-lightbox');
    remove_theme_support('wc-product-gallery-slider');
    //Remove Default Wordpress Gallery Styles
    add_filter('use_default_gallery_style', '__return_false');
}

//instock/outofstock in shop page
add_action('pre_get_posts', 'filter_press_tax');

function filter_press_tax($query)
{
    if ($query->is_main_query()) {
        if (isset($_GET['ordersort'])) {
            $ordersort = $_GET['ordersort'];
            if ($ordersort) :
                $query->set('order', $ordersort);
            endif;
        }

        if (isset($_GET['stock'])) {
            $stock = $_GET['stock'];
            if ($stock == 'true') :
                $query->set('meta_query', array(
                    array(
                        'key' => '_stock_status',
                        'value' => 'instock',
                        'compare' => '=',
                    ),
                ));
            endif;
        }

        if (isset($_GET['ordershow'])) {
            $ordershow = $_GET['ordershow'];
            if ($ordershow) :
                $query->set('posts_per_page', $ordershow);
            endif;
        }
    }
    return;
}

add_filter('woocommerce_checkout_fields', 'custom_remove_woo_checkout_fields');

function custom_remove_woo_checkout_fields($fields)
{
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_2']);
    $fields['billing']['billing_phone']['label'] = 'شماره موبایل';
    $fields['billing']['billing_email']['class'] = array('form-row-first');
    $fields['billing']['billing_state']['class'] = array('form-row-first');
    $fields['billing']['billing_phone']['class'] = array('form-row-last');
    return $fields;
}


add_filter('woocommerce_default_address_fields', 'bbloomer_reorder_checkout_fields');

function bbloomer_reorder_checkout_fields($fields)
{
    unset($fields['address_2']);
    unset($fields['company']);
    $fields['state']['priority'] = 50;
    $fields['address_1']['priority'] = 81;
    $fields['address_1']['label'] = 'آدرس';
    return $fields;
}

add_action('wp_enqueue_scripts', 'dequeue_woocommerce_styles_scripts', 99);
function dequeue_woocommerce_styles_scripts(){
    if (function_exists('is_woocommerce')) {
        if (!is_woocommerce() && !is_cart() && !is_checkout()) {
            # Styles
            wp_dequeue_style('woocommerce-general');
            wp_dequeue_style('woocommerce-layout');
            wp_dequeue_style('woocommerce-smallscreen');
            wp_dequeue_style('woocommerce_frontend_styles');
            wp_dequeue_style('woocommerce_fancybox_styles');
            wp_dequeue_style('woocommerce_chosen_styles');
            wp_dequeue_style('woocommerce_prettyPhoto_css');
            # Scripts
            wp_dequeue_script('wc_price_slider');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-add-to-cart');
            wp_dequeue_script('wc-cart-fragments');
            wp_dequeue_script('wc-checkout');
            wp_dequeue_script('wc-add-to-cart-variation');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-cart');
            wp_dequeue_script('wc-chosen');
            wp_dequeue_script('woocommerce');
            wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');
            wp_dequeue_script('jquery-blockui');
            wp_dequeue_script('jquery-placeholder');
            wp_dequeue_script('fancybox');
            wp_dequeue_script('jqueryui');
        }
    }
}
/**
 * Rename product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
function woo_rename_tabs($tabs)
{

    $tabs['description']['title'] = __('توضیحات تکمیلی');        // Rename the description tab
    $tabs['reviews']['title'] = __('نظرات کاربران');                // Rename the reviews tab
    $tabs['additional_information']['title'] = __('مشخصات فنی');    // Rename the additional information tab

    return $tabs;
}
/**
 * Reorder product data tabs
 */
add_filter('woocommerce_product_tabs', 'woo_reorder_tabs', 98);
function woo_reorder_tabs($tabs)
{

    $tabs['reviews']['priority'] = 15;            // Reviews first
    $tabs['description']['priority'] = 10;            // Description second
    $tabs['additional_information']['priority'] = 5;    // Additional information third

    return $tabs;
}

/**
 * Disable plugins update capability
 */
add_filter('site_transient_update_plugins', 'websima_site_transient_update_plugins');
function websima_site_transient_update_plugins($value)
{
    if (array_key_exists("woocommerce-delivery-notes/woocommerce-delivery-notes.php", $value->response)) {
        unset($value->response['woocommerce-delivery-notes/woocommerce-delivery-notes.php']);
    }
    return $value;
}



/**
 * ACF Add shop page
 */
//https://support.advancedcustomfields.com/forums/topic/trying-to-add-field-group-to-the-woocommerce-shop-page-only/
add_filter('acf/location/rule_values/page_type', 'websima_acf_location_rules_values_woo_shop');
function websima_acf_location_rules_values_woo_shop($choices)
{
    $choices['woo-shop-page'] = 'برگه فروشگاه';
    return $choices;
}

add_filter('acf/location/rule_match/page_type', 'websima_acf_location_rules_match_woo_shop', 10, 3);
function websima_acf_location_rules_match_woo_shop($match, $rule, $options)
{
    if (is_admin()) {
        $screen = get_current_screen();
        if (is_object($screen)) {
            if ($rule['param'] == 'page_type' && $rule['value'] == 'woo-shop-page' && in_array($screen->post_type, array('page'))) {
                $post_id = $options['post_id'];
                $woo_shop_id = get_option('woocommerce_shop_page_id');

                if ($rule['operator'] == "==") {
                    $match = $post_id == $woo_shop_id;
                } elseif ($rule['operator'] == "!=") {
                    $match = $post_id != $woo_shop_id;
                }
            }
        }
    }

    return $match;
}

// if use swatchees in site remove from panel 
remove_filter('woocommerce_product_data_tabs', 'add_wvs_pro_preview_tab');
remove_filter('woocommerce_product_data_panels', 'add_wvs_pro_preview_tab_panel');


add_filter('woocommerce_cart_item_name', 'add_variations_in_cart', 10, 3);
function add_variations_in_cart($title, $cart_item, $item_key){
     				
    $html = '<h3>'.$cart_item['data']->get_title().'</h3>';
    $html .= "<ul class='cart-attributes'>";
    if($cart_item['data']->post_type == 'product_variation'){ 
		
		foreach($cart_item['variation'] as $attribute => $term_name )  {
			$taxonomy       = wc_sanitize_taxonomy_name(str_replace('attribute_', '', $attribute));
			$attribute_name = wc_attribute_label($taxonomy);
			$term_name2      = get_term_by( 'slug', $term_name, $taxonomy)->name;
			$html .= $term_name ? "<li><span>$attribute_name: </span>$term_name2</li>" : '';
		}
    }
    $html .= "</ul>";
    return $html;

}
add_filter( 'woocommerce_order_item_name', 'change_orders_items_names', 10, 2 );
function change_orders_items_names( $item_name,$cart_item ) {
    $product = wc_get_product( $cart_item['product_id'] );
    $html = '<h3>'.$product->get_title().'</h3>';
    $html .= "<ul class='order-details-attributes'>";

    foreach($cart_item->get_data()['meta_data'] as $attribute => $term_name )  {
        $attribute_name = wc_attribute_label($term_name->key);
        $term_name      = get_term_by( 'slug', $term_name->value, $term_name->key)->name;
        $html .= $term_name ? "<li><span>$attribute_name: </span>$term_name</li>" : '';
    }

    $html .= "</ul>";
    return $html;
}




/**
 * Show sale prices in the cart.
 */
function my_custom_show_sale_price_at_cart( $old_display, $cart_item, $cart_item_key ) {

	/** @var WC_Product $product */
	$product = $cart_item['data'];

	if ( $product ) {
		return $product->get_price_html();
	}

	return $old_display;
	

}
add_filter( 'woocommerce_cart_item_price', 'my_custom_show_sale_price_at_cart', 10, 3 );


add_filter('woocommerce_available_variation', function($available_variations, \WC_Product_Variable $variable, \WC_Product_Variation $variation) {
    if (empty($available_variations['price_html'])) {
        $available_variations['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
    }
    return $available_variations;
}, 10, 3);
  add_filter('woocommerce_show_variation_price',      function() { return TRUE;});
  
  
  remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

add_action( 'woocommerce_reset_variations_link' , 'sd_change_clear_text', 15 );
function sd_change_clear_text() {
   echo '<a class="reset_variations" href="#">' . esc_html__( 'پاک کردن', 'woocommerce' ) . '</a>';
   
 add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments){
    ob_start();
    $items_count = WC()->cart->get_cart_contents_count();
    ?>
    <div id="mini-cart-count"><?php echo $items_count ; ?></div>
    <?php
        $fragments['#mini-cart-count'] = ob_get_clean();
    return $fragments;
}
 
}
add_filter( 'woocommerce_catalog_orderby', 'misha_rename_default_sorting_options' );

function misha_rename_default_sorting_options( $options ){
	$options[ 'price' ] = 'مرتب سازی براساس ارزان ترین'; // rename
	$options[ 'price-desc' ] = 'مرتب سازی براساس گران ترین'; // rename
	return $options;
}