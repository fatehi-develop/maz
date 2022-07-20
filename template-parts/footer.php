<?php

$site_feature_items = get_field("site_feature_items", "option");
$logo_footer = get_field("logo_footer", "option");
$description_footer = get_field("description_footer", "option");
$social_media = get_field("social_media", "option");
$text_copy_right_footer = get_field("text_copy_right_footer", "option");
$list_symbols = get_field("list_symbols", "option");
$first_footer_title = get_field("first_footer_title", "option");
$two_footer_title = get_field("two_footer_title", "option");
$tree_footer_title = get_field("tree_footer_title", "option");

?>

<section class="box-featured-footer">
    <div class="container container--1300">
        <div class="feature-footer">
            <?php if (isset($site_feature_items) && !empty($site_feature_items)) { ?>
                <ul class="feature-footer__list">
                    <?php foreach ($site_feature_items as $item) { ?>
                        <li>
                            <img src="<?= @$item["pic"]["url"] ?>" alt="">
                            <div class="about">
                                <span class="pf-1"><?= @$item["text"] ?></span>
                                <p class="pf-1"><?= @$item["des"] ?></p>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</section>

<footer class="container container--1300">
    <footer>
        <div class="footer-top">
            <div class="list_link">
                <span class="title_link"><?= @$first_footer_title ?></span>
                <?php wp_nav_menu([
                    'theme_location' => 'footer1',
                ]); ?>
            </div>
            <div class="list_link">
                <span class="title_link"><?= @$two_footer_title ?> </span>
                <?php wp_nav_menu([
                    'theme_location' => 'footer2',
                ]); ?>
            </div>
            <div class="list_link">
                <span class="title_link"><?= $tree_footer_title ?> </span>
                <ul>
                    <?php wp_nav_menu([
                        'theme_location' => 'footer3',
                    ]); ?>
                </ul>
            </div>
            <div class="mailchimp">
                <span class="title_link">همراه ما باشید !</span>
                <p>با ثبت ایمیل، از جدید‌ترین تخفیف‌ها با‌خبر شوید</p>
                <?= websima_newsletter_form(); ?>
                <?php if ($social_media) { ?>
                    <ul class="social_media">
                        <?php foreach ($social_media as $social) { ?>
                            <li>
                                <a href="<?= @$social["link"]["url"] ?>" target="_blank"
                                   rel="nofollow noopener noreferrer" title="<?= $social["link"]["title"] ?>">
                                    <i class="<?= @$social["icon"] ?>"></i>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="info-site">
                <?php if ($logo_footer["url"]) { ?> <img src="<?= $logo_footer["url"] ?>" alt=""><?php } ?>
                <div class="box-des-footer">
                    <p class="des before active"><?= @$description_footer ?></p>
                    <span class="show-more">
                    <span>بیشتر</span>
                <i class="icon-arrow-bottom"></i>
                </span>
                </div>
            </div>
            <?php if (isset($list_symbols) && !empty($list_symbols)) { ?>
                <ul class="list_documents">
                    <?php foreach ($list_symbols as $item) { ?>
                        <li><?= @$item["symbol_script"] ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </footer>
</footer>

<?php if (isset($text_copy_right_footer) && !empty($text_copy_right_footer)) { ?>
    <div class="copy_right">
        <span><?= @$text_copy_right_footer ?></span>
    </div>
<?php } ?>