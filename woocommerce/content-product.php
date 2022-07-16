<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
if (is_archive_product()){
	if(get_field('show_sidebar_shop','option') == 1 ){
	
			echo "<div class='col-sm-6 col-lg-4 mb-4'>";
}else{
	 echo "<div class='col-sm-6 col-lg-3 mb-4'>";
}
   
}
?>
    <div class="product-item-parent">


            <?php
            if (isset($timer)){

                $_sale_price_dates_to = get_field('_sale_price_dates_to');
                if ($_sale_price_dates_to) {
                    echo '<div class="product-head-date"><span class="product-head-text">زمان باقی مانده :</span>';
                    echo "<input class='product-sale-expire' type='hidden' value='".date('Y-M-d',$_sale_price_dates_to)."'>";
                    echo "<div class='countdown-wrapper'><div class='countdown'></div></div></div>";
                }
            }
            ?>

        <article <?php wc_product_class( 'product-item', $product ); ?>>
            <div class="product-head">
                <div class="product-compare-add">                    
                    <?php
                    if ( !$product->is_type( 'variable' ) ) {
                        if(  $product->is_on_sale() ){
                            $regular = $product->get_regular_price();
                            $sale = $product->get_sale_price();
                            if ( isset( $sale ) ) {
                                $discount = ceil( ( ($regular - $sale) / $regular ) * 100 );
                            }
                            echo'<span class="on-sale">'.$discount .'%</span>';
                        }
                    }
                    ?>
                </div>
            </div>
            <?php if (get_field('is_new') || get_field('is_sale')){
                echo "<div class='product-item-top'>";
                if (get_field('is_new')) echo "<span class='on-new'><i></i></span>";
                if (get_field('is_sale')) echo "<span class='on-sale'><i class='icon-sale'></i></span>";
                echo "</div>";
            } ?>
            <a href="<?php the_permalink(); ?>" class="product-image" <?php if (isset($dataimg)) echo $dataimg; ?>>
                <?php if (has_post_thumbnail()){
                    the_post_thumbnail('woocommerce_thumbnail');
                }else{
                   echo wp_get_attachment_image(get_field('no_thumbnail' ,'option'),'woocommerce_thumbnail') ;
                } ?>
            </a>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
           <?php 
            if ( ! $product->managing_stock() && ! $product->is_in_stock() ){
							echo'<div class="price"><p class="out-of-stock">ناموجود</p></div>';
						}else{
							woocommerce_template_loop_price();
					}
			?>
        </article>

    </div>
<?php
if (is_archive_product()){
    echo "</div>";
}