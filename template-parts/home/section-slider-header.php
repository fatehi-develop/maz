<?php
$header_slider = get_field("header_slider", "option");
?>
<div>
    <div class="container container--1300">
        <div class="row">
            <?php if ($header_slider) { ?>
                <div class="col-9 box_slider_header">
                    <div class="owl-carousel slider_header">
                        <?php foreach ($header_slider as $slide) { ?>
                            <div class="item">
                                <img src="<?= $slide["item"]["url"] ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="navigation_slider">
                     <span class="navigation_slider_arrow prev">
                       <i class="icon-Big-Arrows-Right"></i>
                    </span>
                        <span class="navigation_slider_arrow next">
                       <i class="icon-Big-Arrows-left"></i>
                    </span>
                    </div>
                </div>
            <?php } ?>
            <div class="col-3">
                <div class="box_offer_day">
                    <div class="offer_day_head">
                        <span>پیشنهاد روز</span>
                        <div class="timer"><span class="line"></span></div>
                    </div>
                    <div class="owl-carousel slider_offer_day">
                        <div class="item">
                            <div class="item_slider_offer_day">
                                <div class="img">
                                    <img src="<?= THEME_URL . "/assets/img/lotfali-khan-zand-880x880-removebg-preview 3.png" ?>"
                                         alt="">
                                </div>
                                <h2 class="pf-2">کتاب زبان انگلیسی هشتم سری کارپوچینو </h2>
                                <div class="box_price">
                                    <span class="box_price__percent">٪۱۵</span>
                                    <div class="box_price__amount">
                                        <ins class="price-main">۷۶,۵۰۰</ins>
                                        <span class="price-offer">
                                        <ins>۷۶,۵۰۰</ins>
                                     تومان
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_slider_offer_day">
                                <div class="img">
                                    <img src="<?= THEME_URL . "/assets/img/lotfali-khan-zand-880x880-removebg-preview 3.png" ?>"
                                         alt="">
                                </div>
                                <h2 class="pf-2">کتاب زبان انگلیسی هشتم سری کارپوچینو </h2>
                                <div class="box_price">
                                    <span class="box_price__percent">٪۱۵</span>
                                    <div class="box_price__amount">
                                        <ins class="price-main">۷۶,۵۰۰</ins>
                                        <span class="price-offer">
                                        <ins>۷۶,۵۰۰</ins>
                                     تومان
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_slider_offer_day">
                                <div class="img">
                                    <img src="<?= THEME_URL . "/assets/img/lotfali-khan-zand-880x880-removebg-preview 3.png" ?>"
                                         alt="">
                                </div>
                                <h2 class="pf-2">کتاب زبان انگلیسی هشتم سری کارپوچینو </h2>
                                <div class="box_price">
                                    <span class="box_price__percent">٪۱۵</span>
                                    <div class="box_price__amount">
                                        <ins class="price-main">۷۶,۵۰۰</ins>
                                        <span class="price-offer">
                                        <ins>۷۶,۵۰۰</ins>
                                     تومان
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="item_slider_offer_day">
                                <div class="img">
                                    <img src="<?= THEME_URL . "/assets/img/lotfali-khan-zand-880x880-removebg-preview 3.png" ?>"
                                         alt="">
                                </div>
                                <h2 class="pf-2">کتاب زبان انگلیسی هشتم سری کارپوچینو </h2>
                                <div class="box_price">
                                    <span class="box_price__percent">٪۱۵</span>
                                    <div class="box_price__amount">
                                        <ins class="price-main">۷۶,۵۰۰</ins>
                                        <span class="price-offer">
                                        <ins>۷۶,۵۰۰</ins>
                                     تومان
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
