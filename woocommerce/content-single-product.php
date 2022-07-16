<?php

/**

 * The template for displaying product content in the single-product.php template

 *

 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.

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



defined('ABSPATH') || exit;



global $product;



?>
<?php if(is_user_logged_in()){ ?>
<main id="main" class="site-main">

    <div class="container">

        <?php

        /**

         * Hook: woocommerce_before_single_product.

         *

         * @hooked woocommerce_output_all_notices - 10

         */

        do_action('woocommerce_before_single_product');



        if (post_password_required()) {

            echo get_the_password_form(); // WPCS: XSS ok.

            return;

        }

        ?>

        <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

            <div class="product-main-data">

                <div class="row">
                    <div class="col-lg-6">

                        <div class="summary entry-summary">

                            <?php

                            /**

                             * Hook: woocommerce_single_product_summary.

                             *

                             * @hooked woocommerce_template_single_title - 5

                             * @hooked woocommerce_template_single_rating - 10

                             * @hooked woocommerce_template_single_price - 10

                             * @hooked woocommerce_template_single_excerpt - 20

                             * @hooked woocommerce_template_single_add_to_cart - 30

                             * @hooked woocommerce_template_single_meta - 40

                             * @hooked woocommerce_template_single_sharing - 50

                             * @hooked WC_Structured_Data::generate_product_data() - 60

                             */

                            do_action('woocommerce_single_product_summary');

                            ?>

                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="product-meta-top">
                            <i class="icon-share"></i>
                            <?php echo websima_shares(); ?>
                        </div>
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

                        <?php

                        /**

                         * Hook: woocommerce_before_single_product_summary.

                         *

                         * @hooked woocommerce_show_product_sale_flash - 10

                         * @hooked woocommerce_show_product_images - 20

                         */

                        do_action('woocommerce_before_single_product_summary');

                        ?>

                    </div>



                </div>

            </div>

            <?php

            /**

             * Hook: woocommerce_after_single_product_summary.

             *

             * @hooked woocommerce_output_product_data_tabs - 10

             * @hooked woocommerce_upsell_display - 15

             * @hooked woocommerce_output_related_products - 20

             */

            do_action('woocommerce_after_single_product_summary');

            ?>

        </div>

    </div>

    <?php do_action('woocommerce_after_single_product'); ?>

    <?php $related_blogs = get_field('related_blogs');

    if ($related_blogs != null ){ ?>

    <section class="section section-related-blog">

        <div class="container">

            <h4 class="title-related-blog">مقالات مرتبط</h4>

            <div class="blog-carousel owl-carousel">

                <?php

                $args = array(

                    'post_type' => 'post',

                    'posts_per_page' => 3,

                    'order' => 'DESC',

                    'post_status' => 'publish',

                );

                $args['post__in'] = $ids;

                $the_query = new WP_Query($args); ?>

                <?php if ($the_query->have_posts()) : ?>

                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                        <?php get_template_part('template-parts/cards/card', 'post'); ?>

                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>

                <?php endif; ?>

            </div>

        </div>

    </section>


    <?php } ?>

</main>
 
<?php } ?>