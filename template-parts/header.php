<?php
$home_logo = get_field("home_logo", "option");
$contact_number = get_field("contact_number", "option");
$phone_number = explode('-' , $contact_number);
?>
<header class="box-header">
    <div class="container container--1300">
        <div class="header">
            <div class="header-top">
                <div class="header-top__right">
                    <a class="logo" href="<?= home_url() ?>"><img src="<?= $home_logo["url"] ?>" alt=""></a>
                    <form class="search" action="">
                        <button type="submit"><i class="icon-search"></i></button>
                        <input type="text" placeholder="جستجو در کتاب‌ها ">
                    </form>
                </div>
                <div class="header-top__left">
                    <a class="call_us" href="">
                        <i class="icon-tel"></i>
                    </a>
                    <div class="register">
                        <?= websima_auth_modal_btn(); ?>
                    </div>
                    <a class="basket" href="<?= wc_get_cart_url() ?>">
                        <i class="icon-basket"></i>
                        <span>0</span>
                    </a>
                </div>
            </div>
            <div class="header-bottom">
                <div class="menu">
                    <?php wp_nav_menu([
                        'theme_location' => 'top',
                    ]); ?>
                </div>
                <a class="call_us" href="tel:<?= $phone_number[0] . $phone_number[1] ?>">
                    <i class="icon-tel"></i>
                    <span><?= $contact_number ?></span>
                </a>
                <form class="search" action="">
                    <button type="submit"><i class="icon-search"></i></button>
                    <input type="text" placeholder="جستجو در کتاب‌ها " name="s">
                </form>
            </div>
        </div>
    </div>
</header>