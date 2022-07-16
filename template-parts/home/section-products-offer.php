<?php
$amazing_discount_period = get_sub_field("amazing_discount_period");
if (isset($amazing_discount_period) && strtotime($amazing_discount_period) > current_time("timestamp")) {
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
    if (isset($amazing_discount_period) && strtotime($amazing_discount_period) > current_time("timestamp")) {
        $box_amazing_discounts = true;
    }
    ?>
    <?php if (0 && $query_product->have_posts()) { ?>
        <div class="box-amazing_discounts" data-sale-to="<?= $amazing_discount_period ?>">
            <div class="info_amazing_discounts">
                <span class="info_amazing_discounts__title">تخفیفات شگفت انگیز !</span>
                <ul class="info_amazing_discounts__timer">

                    <li class="seconds"><span>00</span></li>
                    <li class="minutes"><span>00</span></li>
                    <li class="hours"><span>00</span></li>
                    <li class="days"><span>00</span></li>

                    <li><i class="icon-time"></i></li>
                </ul>
                <a class="info_amazing_discounts__link" href="#">
                    مشاهده همه تخفیفات
                    <em>></em>
                </a>
                <img class="img-special-offer" src="<?= THEME_URL ?>/assets/img/098%202.png" alt="">
            </div>
            <div class="container container--1240">
                <div class="d-flex">
                    <div class=" slider_amazing_discounts">
                        <div class="owl-carousel swiper_category_product_offer owl-custom-slider">

                                <?php while ($query_product->have_posts()) {
                                    $query_product->the_post();
                                    ?>
                                        <?php get_template_part("template-parts/home/item-post") ?>
                                <?php } ?>

                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php }
} ?>