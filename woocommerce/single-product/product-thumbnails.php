<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce,$wd_data;
$attachment_ids = $product->get_gallery_image_ids();
array_unshift($attachment_ids, get_post_thumbnail_id());
if ( $attachment_ids ) {
    $loop 		= 0;
    $columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
    ?>
	<div id="single-product-thumbnail" class="thumbnail-slider owl-carousel <?php echo 'columns-' . $columns; ?>">
		<?php
		foreach ( $attachment_ids as $attachment_id ) {
			$classes = array(  );
			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';
            $image_n_url = wp_get_attachment_image_src( $attachment_id, 'thumbnail');
			$image_link = wp_get_attachment_image_src( $attachment_id, 'thumbnail')[0];
			$image_n_url_w = $image_n_url[1];
			$image_n_url_h = $image_n_url[2];
			if ( ! $image_link )
				continue;
			
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true);
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item"  data-id="%s"><img src="%s" width="%s" height="%s" alt="%s" loading="lazy"></div>', $attachment_id,$image_link, $image_n_url_w, $image_n_url_h, $image_alt,$image_class), $attachment_id, $post->ID, $image_class );
			$loop++;
		}
		?>
	</div>
    <?php
}