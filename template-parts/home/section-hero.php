<?php
$header_slider = get_sub_field("header_slider");

$offer_day = get_sub_field("offer_day");
$list = [];
foreach ($offer_day as $item_pro) {
    $list[] = $item_pro["product"];
}
$args_product = array(
    'post_type' => 'product',
    'post__in' => $list,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => '_sale_price',
            'value' => 0,
            'compare' => '>',
            'type' => 'numeric'
        ),
    )
);
$query_product = new WP_Query($args_product);

?>
<div>
    <div class="container container--1300">
        <div class="row">
            <?php if ($header_slider) { ?>
                <div class="col-12 col-lg-9 box_slider_header mb-80">
                    <div class="owl-carousel slider_header">
                        <?php foreach ($header_slider as $slide) { ?>
                            <div class="item">
                                <img src="<?= $slide["img"]["url"] ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="navigation_slider hero">
                     <span class="hero navigation_slider_arrow prev">
                       <i class="icon-Big-Arrows-Right"></i>
                    </span>
                        <span class="hero navigation_slider_arrow next">
                       <i class="icon-Big-Arrows-left"></i>
                    </span>
                    </div>
                </div>
            <?php } ?>
            <?php if ($query_product->have_posts()) { ?>
                <div class="col-12 col-lg-3">
                    <div class="box_offer_day mb-80">
                        <div class="offer_day_head">
                            <span>پیشنهاد روز</span>
                            <div class="timer"><span class="line"></span></div>
                        </div>
                        <div class="owl-carousel slider_offer_day">
                            <?php while ($query_product->have_posts()) { $query_product->the_post();
                                global $product;
                                ?>
                                <div class="item">
                                    <div class="item_slider_offer_day">
                                        <div class="img">
                                            <?= get_the_post_thumbnail(); ?>
                                        </div>
                                        <h2 class="pf-2"><?= get_the_title() ?></h2>
                                        <div class="box_price">
                                            <span class="box_price__percent">٪۱۵</span>
                                            <div class="box_price__amount">
                                                <ins class="price-main"><?= convertEnglishNumbersToPersian(number_format($product->get_regular_price())); ?></ins>
                                                <span class="price-offer">
                                        <ins><?= convertEnglishNumbersToPersian(number_format($product->get_sale_price())) ?></ins>
                                     <?= get_woocommerce_currency_symbol() ?>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
</div>
