<?php
$args_product = array(
    'post_type' => 'product',
    'posts_per_page' => 9,
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => '_sale_price',
            'value' => 0,
            'compare' => '>',
            'type' => 'numeric'
        ),
        array(
            'key' => '_min_variation_sale_price',
            'value' => 0,
            'compare' => '>',
            'type' => 'numeric'
        )
    )
);
$query_product = new WP_Query($args_product);
?>
<?php if ($query_product->have_posts()) { ?>
    <div class="box_products_offer">
        <div class="container container--1300">
            <div class="products_offer" data-tabindex="status">
                <div data-tabindex="status">

                    <div class="header_products_offer">
                        <div class="header_products_offer__title">
                            <span class="icon"><i class="icon-percent"></i></span>
                            <span class="title"> شگفت‌انگیز‌ها</span>
                        </div>
                        <div class="tab-title">
                            <div data-tab="awaiting-payment" data-parent="status"
                                 class="item active">
                                <span>همه</span>
                            </div>

                            <div data-tab="processing" data-parent="status" class="item">
                                <span>کتاب کمک درسی </span>
                            </div>
                        </div>
                        <a class="header_products_offer__link" href="">
                            مشاهده همه
                            <i class="icon-Big-Arrows-left"></i>
                        </a>
                    </div>

                    <div class="content_products_offer">
                        <div class="tab-content">

                            <div data-tabc="awaiting-payment" data-parent="status">
                                <div class="owl-carousel products_offer_slider">
                                    <?php while ($query_product->have_posts()) {
                                        $query_product->the_post();
                                        ?>
                                        <?php get_template_part("template-parts/home/item-post") ?>
                                    <?php }
                                    wp_reset_query();
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>

                            <div data-tabc="processing" data-parent="status">
                                <div class="owl-carousel products_offer_slider">
                                    <?php while ($query_product->have_posts()) {
                                        $query_product->the_post();
                                        ?>
                                        <?php get_template_part("template-parts/home/item-post") ?>
                                    <?php }
                                    wp_reset_query();
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="navigation_slider offer">
                     <span class="navigation_slider_arrow prev">
                       <i class="icon-Big-Arrows-Right"></i>
                    </span>
                            <span class="navigation_slider_arrow next">
                       <i class="icon-Big-Arrows-left"></i>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>