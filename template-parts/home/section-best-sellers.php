<?php

$args_product_best_sallers = array(
    'post_type' => 'product',
    'posts_per_page' => 9,
);
$args_product_best_sallers["meta_key"] = "total_sales";
$args_product_best_sallers["orderby"] = "meta_value_num";
$query_best_sallers = new WP_Query($args_product_best_sallers);

?>
<div>
    <div class="container container--1300">
        <div class="list_best_sellers">
            <div class="banner">
                <img src="<?= THEME_URL . "/assets/img/Frame 15115.png" ?>" alt="">
                <div class="navigation_slider best-saller">
                     <span class="navigation_slider_arrow prev">
                       <i class="icon-Big-Arrows-Right"></i>
                    </span>
                    <span class="navigation_slider_arrow next">
                       <i class="icon-Big-Arrows-left"></i>
                    </span>
                </div>
            </div>
            <div class="list_product">
                <div class="owl-carousel best_sallers_product owl-custom-slider">
                    <?php while ($query_best_sallers->have_posts()) {
                        $query_best_sallers->the_post();
                        ?>
                        <?php get_template_part("template-parts/home/item-post") ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>