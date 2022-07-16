<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
 $cart_image = get_field('cart_image','option');
 $car_desc = get_field('car_desc','option');
 $cart_links = get_field('cart_links','option');
 $cart_products_sub = get_field('cart_products_sub','option');
 $cart_products_desc = get_field('cart_products_desc','option');
 $cart_products = get_field('cart_products','option');


?>
<section class="cart-empty-page-top">
<?php  
echo wp_get_attachment_image($cart_image,'full');
if ($car_desc) { echo  '<div class="cart-empty-top-sub"> '.$car_desc.'</div>'; }
if ($cart_links) { echo  '<div class="cart-empty-top-link"> ';
foreach($cart_links as $item){
	echo '<a href="'.$item['link'].'">'.$item['name'].'</a>';
	
}
echo '</div>'; }
?>
</section>

<?php 
	$cart_products_sub = get_field('cart_products_sub','option');
 $cart_products_desc = get_field('cart_products_desc','option');
 $cart_products = get_field('cart_products','option');

	

        ?>
		

 <?php
        if ($cart_products != null) { ?>
		<section class="cart-empty-page-bottom">
                    <div class="pro-related py-4 pb-5 " id="pro-related">
                        
                            <?php if($cart_products_sub || $cart_products_desc ){
                                echo '<div class="title-site title-site-center mb-4 mb-md-5">';
								if($cart_products_sub ){     echo '<h4 class="title-heading">'.$cart_products_sub.'</h4>';  }
                               if($cart_products_sub || $cart_products_desc ){  echo '<p >'.$cart_products_desc.'</p>'; }
							   
                                echo '</div>';
                            }?>
							<div class="container">
                            <?php echo websima_list_products('products', '4', get_field('cart_products','option')); ?>
                            
							
                       </div>
                    </div>
					</section>
                <?php } ?>
				


	
	





