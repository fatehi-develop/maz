<?php
global $product;
$discount_percentage = (add_percentage_to_sale_badge($product) != 100) ? add_percentage_to_sale_badge($product) : null;

$sales_price_from = $product->get_date_on_sale_from();
$sales_price_to = $product->get_date_on_sale_to();
if (!empty($sales_price_from) && (strtotime($sales_price_from) < current_time("timestamp")) && !empty($sales_price_to) && (strtotime($sales_price_to) > current_time("timestamp"))) {
    $status_offer = true;
}

$time_now = current_time('timestamp');
$time_post = get_post_time();
$diff_time = abs($time_now - $time_post);
$count_days_after_publish_product = floor($diff_time / (24 * 60 * 60));

$get_availability = $product->get_availability()["class"];
$out_of_stock_product = $product->get_availability()["class"] == "out-of-stock";
?>
<article class="item-product" data-sale-to="<?= $sales_price_to ?>" data-sale-from="<?= $sales_price_from ?>">
    <?php if ($count_days_after_publish_product < 2) { ?>
        <span class="new">جدید!</span>
    <?php } ?>
    <a class="item-product__img" href="<?= get_the_permalink() ?>"><?= the_thumbnail("img_product_index") ?></a>

    <div class="title">
        <h2 class="pf-2"><a href="<?= get_the_permalink() ?>"><?= get_the_title() ?></a></h2>
    </div>

    <div class="box_price <?= $status_offer ? "m-12" : '' ?>">
        <?php if (!$out_of_stock_product) { ?>
            <?php if ($discount_percentage) { ?><span class="box_price__percent">
                ٪<?= convertEnglishNumbersToPersian($discount_percentage) ?></span><?php } ?>
            <div class="box_price__amount">
                <?php if ($product->get_regular_price() && $product->get_sale_price()) { ?>
                    <ins class="price-main"><?= convertEnglishNumbersToPersian(number_format($product->get_regular_price())); ?></ins>
                    <span class="price-offer">
                                        <ins><?= convertEnglishNumbersToPersian(number_format($product->get_sale_price())) ?></ins>
                                     <?= get_woocommerce_currency_symbol() ?>
                                    </span>
                <?php } else { ?>
                    <span class="price-offer">
                                        <ins><?= convertEnglishNumbersToPersian(number_format($product->get_regular_price())) ?></ins>
                                     <?= get_woocommerce_currency_symbol() ?>
                                    </span>
                <?php } ?>
            </div>
        <?php } else { ?>
            <span class="out_of_stock_product">در انبار موجود نمی باشد</span>
        <?php } ?>
    </div>

    <?php if (isset($args["type"]) && $args["type"] == "offer" && $status_offer) { ?>
        <div class="timer_post">
            <div class="timer_post__line">
                <span></span>
            </div>
            <div class="timer_post__day">
                <span class="days">۱۲</span>:
                <span class="hours">۴۵</span>:
                <span class="minutes">۱۲</span>:
                <span class="seconds">۳۳</span>
            </div>
        </div>
    <?php } ?>

</article>

