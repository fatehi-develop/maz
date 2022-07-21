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
<section>
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
                <div class="col-12 col-lg-3 mb-80">
                    <div class="box_offer_day ">
                        <div class="offer_day_head">
                            <span>پیشنهاد روز</span>
                            <div class="timer"><span class="line"></span></div>
                        </div>
                        <div class="owl-carousel slider_offer_day">
                            <?php while ($query_product->have_posts()) { $query_product->the_post();
                                global $product;
                                $discount_percentage = (add_percentage_to_sale_badge($product) != 100) ? add_percentage_to_sale_badge($product) : null;
                                ?>
                                <article class="item">
                                    <div class="item_slider_offer_day">
                                        <a href="<?= get_the_permalink() ?>" class="img">
                                            <?= get_the_post_thumbnail(); ?>
                                        </a>
                                        <h2 class="pf-2"><a href="<?= get_the_permalink() ?>"><?= get_the_title() ?></a></h2>
                                        <div class="box_price">
                                            <?php if ($discount_percentage) { ?><span class="box_price__percent">
                                                ٪<?= convertEnglishNumbersToPersian($discount_percentage) ?></span><?php } ?>
                                            <div class="box_price__amount">
                                                <ins class="price-main"><?= convertEnglishNumbersToPersian(number_format($product->get_regular_price())); ?></ins>
                                                <span class="price-offer">
                                        <ins><?= convertEnglishNumbersToPersian(number_format($product->get_sale_price())) ?></ins>
                                     <?= get_woocommerce_currency_symbol() ?>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
