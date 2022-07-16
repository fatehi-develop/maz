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

$active_product_slider_svg = get_sub_field("active_product_slider_svg");
?>
<?php if ($query_product->have_posts()) { ?>
    <div class="box_slider_product">
        <div class="container container--1300">
            <div class="header-slider">
                <span><?= @$product_slider_title ?></span>
                <a href="<?= get_post_type_archive_link('product') ?>">مشاهده همه
                    <i> > </i>
                </a>
            </div>
        </div>
        <div class="owl-carousel swiper_category_product owl-custom-slider">
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

<?php } ?>