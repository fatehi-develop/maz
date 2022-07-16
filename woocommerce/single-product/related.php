<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if (!defined('ABSPATH')) {
    exit;
}
$show_related_products = get_field('show_related_products');
$custom_related_products = get_field('related_products');
if ($show_related_products) : ?>
    <section class="related products">
	    <div class="container">
        <?php
        $heading = apply_filters('woocommerce_product_related_products_heading', __('Related products', 'woocommerce'));
        if ($heading) :?>
            <div class="title-site title-site-center mb-3">
                <h2 class="title-heading"><?php echo esc_html($heading); ?></h2>
            </div>
        <?php endif; ?>
		<?php 
        if ($custom_related_products != null) {
            echo websima_list_products('products', '4', $custom_related_products);
        } else { 
		woocommerce_product_loop_start(); 
		foreach ($related_products as $related_product) : 
		
                $post_object = get_post($related_product->get_id());

                setup_postdata($GLOBALS['post'] =& $post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                wc_get_template_part('content', 'product');
               
			   endforeach; 
		}
		 woocommerce_product_loop_end(); 
		?>
        </div>
    </section>
<?php
endif;

wp_reset_postdata();
