<?php
$list_brand_index = get_sub_field("list_brand_index", "option");
?>
<?php if ($list_brand_index) { ?>
    <section class="box_slider_brands_index mb-80">
        <div class="container container--1300">
            <div class="owl-carousel slider_brands_index owl-custom-slider">
                <?php foreach ($list_brand_index as $brand) { ?>
                    <?php if (isset($brand["link"]) && !empty($brand["link"])) { ?>
                        <a href="<?= @$brand["link"]["url"] ?? "#" ?>"
                           target="<?= @$brand["link"]["target"] ?? "" ?>" rel="<?= isset($brand["rel_nofollow"]) && !empty($brand["rel_nofollow"]) ? "nofollow" : "" ?>">
                            <img src="<?= $brand["img"]["url"] ?>" alt="">
                        </a>
                    <?php } else { ?>
                        <span>
                            <img src="<?= $brand["img"]["url"] ?>" alt="">
                        </span>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>







