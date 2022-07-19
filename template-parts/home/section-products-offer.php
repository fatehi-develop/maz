<?php
$selection_products = get_sub_field("products_list");
?>
<?php if (isset($selection_products)) {
    $args_product = array(
        'post_type' => 'product',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_sale_price',
                'value' => 0,
                'compare' => '>',
                'type' => 'numeric'
            ),
            array(
                'key' => '_sale_price_dates_to',
                'value' => current_time("timestamp"),
                'compare' => '>',
                'type' => 'numeric'
            ),

        )
    );
    ?>
    <div class="box_products_offer mb-100">
        <div class="container container--1300">
            <div class="products_offer" data-tabindex="status">
                <div data-tabindex="status">

                    <div class="header_products_offer">
                        <div class="header_products_offer__title">
                            <span class="icon"><i class="icon-percent"></i></span>
                            <span class="title"> شگفت‌انگیز‌ها</span>
                        </div>
                        <div class="tab-title">
                            <?php
                            if (isset($selection_products)) {
                                $i = 1;
                                foreach ($selection_products as $item) {
                                    $list = [];
                                    foreach ($item["selection_products"] as $item_pro) {
                                        $list[] = $item_pro["product"];
                                    }
                                    $args_product['post__in'] = $list;
                                    $query_product = new WP_Query($args_product);
                                    if ($query_product->have_posts()) {
                                        ?>
                                        <div data-tab="products_offer_<?= $i ?>" data-parent="status"
                                             class="item <?= ($i == 1) ? "active" : '' ?>">
                                            <span><?= $item["title"] ?></span>
                                        </div>
                                    <?php }
                                    $i++;
                                }
                            } ?>
                        </div>
                        <a class="header_products_offer__link" href="">
                            مشاهده همه
                            <i class="icon-Big-Arrows-left"></i>
                        </a>
                    </div>

                    <div class="content_products_offer">
                        <div class="tab-content">

                            <?php
                            if (isset($selection_products)) {
                                $i = 1;
                                foreach ($selection_products as $item) {

                                    $list = [];
                                    foreach ($item["selection_products"] as $item_pro) {
                                        $list[] = $item_pro["product"];
                                    }
                                    $args_product['post__in'] = $list;

                                    $query_product = new WP_Query($args_product);
                                    ?>
                                    <?php if ($query_product->have_posts()) { ?>
                                        <div data-tabc="products_offer_<?= $i ?>" data-parent="status">
                                            <div class="owl-carousel products_offer_slider">
                                                <?php while ($query_product->have_posts()) {
                                                    $query_product->the_post();
                                                    $data = [
                                                            "type" => "offer"
                                                    ];
                                                    $args = array( 'type' => 'offer' );
                                                    ?>
                                                    <?php get_template_part("template-parts/home/item-post" , null , $args) ?>
                                                <?php }
                                                wp_reset_query();
                                                wp_reset_postdata();
                                                ?>
                                            </div>
                                        </div>
                                        <?php $i++;
                                    }
                                }
                            } ?>

                        </div>
                        <div class="navigation_slider offer">
                     <span class="offer navigation_slider_arrow prev">
                       <i class="icon-Big-Arrows-Right"></i>
                    </span>
                            <span class="offer navigation_slider_arrow next">
                       <i class="icon-Big-Arrows-left"></i>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>