<?php
$product_slider_title = get_sub_field("product_slider_title");
$type_slider_product = get_sub_field("type-slider-product");

$args_product = array(
    'post_type' => 'product',
    'posts_per_page' => 9,
);

if ($type_slider_product == "selected_product") {
    $type_slider_product = get_sub_field("selection_products");
    $list = [];
    foreach ($type_slider_product as $item) {
        $list[] = $item["product"];
    }
    $args_product["post__in"] = $list;
}

if ($type_slider_product == "best_selling") {
    $args_product["meta_key"] = "total_sales";
    $args_product["orderby"] = "meta_value_num";
}

$query_product = new WP_Query($args_product);

$special_slide = get_sub_field("special_slide");
$responsive_mode_description = get_sub_field("responsive_mode_description");
$image_special_mode = get_sub_field("image_special_mode");

?>
<?php if (!$special_slide) { ?>
    <?php if ($query_product->have_posts()) { ?>
        <section class="box_slider_product">
            <div class="container container--1300">
                <div class="header-slider">
                    <span><?= @$product_slider_title ?></span>
                    <a href="<?= get_post_type_archive_link('product') ?>">مشاهده همه
                        <i class="icon-Big-Arrows-left"></i>
                    </a>
                </div>
            </div>
            <div class="owl-carousel swiper_category_product owl-custom-slider">
                <?php

                while ($query_product->have_posts()) {
                    $query_product->the_post();
                    ?>
                    <?php get_template_part("template-parts/home/item-post", null) ?>
                <?php }
                wp_reset_query();
                wp_reset_postdata();
                ?>
            </div>
        </section>

    <?php }
} else { ?>
    <?php if ($query_product->have_posts()) { ?>
        <section class="box_list_best_sellers">
            <div class="container container--1300">
                <div class="header-slider">
                    <span><?= @$product_slider_title ?></span>
                    <a href="#">مشاهده همه
                        <i class="icon-Big-Arrows-left"></i>
                    </a>
                </div>
                <div class="list_best_sellers mb-80">
                    <div class="banner">
                        <img src="<?= @$image_special_mode["url"] ?>" alt="">
                        <div class="box-des">
                            <span class="title"><?= @$product_slider_title ?> </span>
                            <span class="des"><?= @$responsive_mode_description ?></span>
                            <a href="#" class="link">مشاهده همه
                                <i class="icon-Big-Arrows-left"></i>
                            </a>
                        </div>
                        <div class="navigation_slider best-saller">
                     <span class="best_sallers navigation_slider_arrow prev">
                       <i class="icon-Big-Arrows-Right"></i>
                    </span>
                            <span class="best_sallers navigation_slider_arrow next">
                       <i class="icon-Big-Arrows-left"></i>
                    </span>
                        </div>
                    </div>
                    <div class="list_product">
                        <div class="owl-carousel best_sallers_product owl-custom-slider">
                            <?php while ($query_product->have_posts()) {
                                $query_product->the_post();
                                ?>
                                <?php get_template_part("template-parts/home/item-post") ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
<?php } ?>