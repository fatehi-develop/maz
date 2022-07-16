<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}
global $post, $woocommerce, $product,$wd_data;
$attachment_ids = $product->get_gallery_image_ids();
array_unshift($attachment_ids, get_post_thumbnail_id());
$loop 		= 0;
$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
    ?>
    <div class="flex-viewport">
	<?php  if(!in_array("0", $attachment_ids)) { ?>
		<div id="single-product-slider" class="page_lightgallery owl-carousel">
		
			<?php
				$numimg = 1;
				foreach ( $attachment_ids as $attachment_id ) {
					$classes = array(  );
					$atr='';
					if ( $loop == 0 || $loop % $columns == 0 )
						$classes[] = 'first';
					 $atr='data-skip-lazy=""';

					if ( ( $loop + 1 ) % $columns == 0 )
						$classes[] = 'last';
					
					if (wp_is_mobile()) {
						$size='medium'; 
					}else{
						$size='full'; 
				    }
					$image_link = wp_get_attachment_image_src( $attachment_id,$size )['0'];
					$image_width  = wp_get_attachment_image_src( $attachment_id,$size )['1'];
					$image_height = wp_get_attachment_image_src( $attachment_id,$size )['2'];
					if ( ! $image_link )
						continue;
					$image_class = esc_attr( implode( ' ', $classes ) );
                    $image_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true);
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="product_gallery_item" data-id="%s"><a href="%s" ><img src="%s"  width="%s" height="%s" alt="%s" loading="lazy" '.$atr.'></a></div>', $attachment_id,$image_link, $image_link,$image_width,$image_height ,$image_alt ), $attachment_id, $post->ID, $image_class );
					$loop++;
					$numimg++;
				}
			?>
        </div>
    <?php if($numimg > 2){ do_action( 'woocommerce_product_thumbnails' ); }

	}else{
	echo'<div class="woocommerce-product-gallery__image--placeholder">';
		 echo wc_placeholder_img( 'woocommerce_single');
	echo'</div>';
	}
	?>
    </div>
