<?php

$site_feature_items = get_field("site_feature_items", "option");

$tel_footer = get_field("tel_footer", "option");
$email_footer = get_field("email_footer", "option");
$adress_footer = get_field("adress_footer", "option");


$logo_footer = get_field("logo_footer", "option");
$description_footer = get_field("description_footer", "option");
$social_media = get_field("social_media", "option");

$menu_footer = get_field("menu_footer", "option");

$text_copy_right_footer = get_field("text_copy_right_footer", "option");

$list_symbols = get_field("list_symbols", "option");

$footer_newsletter_shortcode = get_field("footer_newsletter_shortcode", "option");

?>

<div class="box-featured-footer">
    <div class="container container--1300">
        <div class="feature-footer">
            <?php if ($site_feature_items) { ?>
                <ul class="feature-footer__list">
                    <?php foreach ($site_feature_items as $item) { ?>
                        <li>
                            <i class="<?= $item["icon"] ?>"></i>
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
</div>

<div class="container container--1300">
    <footer>
        <div class="footer-top">
            <div class="list_link">
                <span class="title_link">راه های خرید</span>
                <ul>
                    <li><a href="">چگونگی ثبت سفارش و استفاده از کد تخفیف</a></li>
                    <li><a href=""> چگونگی ارسال کالا و پیگیری سفارش از طریق کد مرسوله</a></li>
                    <li><a href=""> چگونگی پرداخت </a></li>
                </ul>
            </div>
            <div class="list_link">
                <span class="title_link">خدمات مشتریان </span>
                <ul>
                    <li><a href="">معرفی تخفیف ها </a></li>
                    <li><a href=""> پرسش های متداول </a></li>
                    <li><a href=""> بازگشت کالا و شرایط عودت </a></li>
                    <li><a href=""> حریم خصوصی </a></li>
                </ul>
            </div>
            <div class="list_link">
                <span class="title_link">دسترسی‌ها </span>
                <ul>
                    <li><a href="">تماس با ما </a></li>
                    <li><a href="">درباره ما </a></li>
                    <li><a href=""> حریم خصوصی </a></li>
                    <li><a href=""> قوانین و مقررات </a></li>
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
                                <a href="<?= @$social["link"]["url"] ?>" target="<?= @$social["link"]["target"] ?>">
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
                <div>
                    <p class="des pf-3"><?= @$description_footer ?></p>
                    <span class="show-more">بیشتر</span>
                </div>
            </div>
            <ul class="list_documents">
                <li><img src="<?= THEME_URL . "/assets/img/anjoman 1.jpg" ?>" alt=""></li>
                <li><img src="<?= THEME_URL . "/assets/img/etehadieh 1.jpg" ?>" alt=""></li>
                <li><img src="<?= THEME_URL . "/assets/img/tandis 1.jpg" ?>" alt=""></li>
            </ul>
        </div>
    </footer>
</div>

<div class="copy_right">
    <span>تمامی حقوق این سایت متعلق به شرکت ماز است.</span>
</div>