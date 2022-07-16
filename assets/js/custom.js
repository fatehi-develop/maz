/**
 * DoneTyping
 */
(function ($) {
    $.fn.extend({
        donetyping: function (callback, timeout) {
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function (el) {
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function (i, el) {
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste', function (e) {
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type == 'keyup' && e.keyCode != 8) return;

                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function () {
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur', function () {
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

(function ($) {
    $(document).ready(function () {

        // start menu mobile
        $(".header-mm").click(function (e) {
            e.preventDefault();
            $("#mask").fadeIn(500);
            $("#menumobile").addClass("come-menumobile");
        });
        $("#mask").click(function () {
            $(this).fadeOut(500);
            $("#menumobile").removeClass("come-menumobile");
            $(".sub-menu").removeClass("come-submenu");
            jQuery("#sidebar").toggleClass('active')
        });
        $("#nomenumobile").click(function () {
            $("#mask").fadeOut(500);
            $("#menumobile").removeClass("come-menumobile");
            $(".sub-menu").removeClass("come-submenu");
        });
        $("#menumobile .main-mm ul > .menu-item-has-children > a").append("<span class='childer'><i></i></span>");
        $("#menumobile .sub-menu").prepend("<div class='title-sub-head'><span class='sub-closer float-left'><i></i></span><strong class='float-right title-subcome'>بازگشت</strong></div>");
        $("#menumobile .sub-closer").click(function () {
            $(this).parent().parent().removeClass('come-submenu');
        });
        $("#menumobile .childer").click(function (e) {
            e.preventDefault();
            var textmenu = $(this).parent().text();
            $(this).parent().next().addClass('come-submenu');
            $(this).parent().next().find('.title-sub-head').find('.title-subcome').html(textmenu);
        });
        // end menu mobile

        //add to cart open
        jQuery('.head_item_cart').click(function (e) {
            e.preventDefault();
            jQuery(this).parent().toggleClass('active');
            jQuery("#mask-cart").fadeIn(500);
        });
        jQuery("#mask-cart ,.widget-shopping-cart-close").click(function () {
            jQuery('#mask-cart').fadeOut(500);
            jQuery(".parent_item_cart").toggleClass("active");
        });
        /*  $("#nomenumobile").click(function () {
             $("#mask").fadeOut(500);
             $("#menumobile").removeClass("come-menumobile");
             $(".sub-menu").removeClass("come-submenu");
         }); */
        jQuery('.slider-site ,.slide-banners').owlCarousel({
            slideSpeed: 500,
            rtl: true,
            autoplay: false,
            autoplaySpeed: 3000,
            smartSpeed: 1000,
            loop: false,
            dots: false,
            nav: true,
            items: 1,
            lazyLoad: true,
            navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
        });

        jQuery('.owl-testimonials ').owlCarousel({
            slideSpeed: 5000,
            rtl: true,
            autoplay: true,
            autoplay: 30000,
            smartSpeed: 1000,
            loop: false,
            margin: 25,
            stagePadding: 10,
            dots: false,
            nav: true,
            items: 1,
            lazyLoad: true,
            navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
        });

        jQuery('.faq-carousel').owlCarousel({
            slideSpeed: 500,
            rtl: true,
            autoplay: true,
            autoplaySpeed: 3000,
            smartSpeed: 1000,
            loop: false,
            margin: 20,
            dots: false,
            nav: true,
            lazyLoad: true,
            navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
            responsive: {
                0: {
                    items: 2,
                    margin: 10,
                    stagePadding: 20,
                },
                450: {
                    items: 3,
                    margin: 10,
                    stagePadding: 20,
                },
                768: {
                    items: 3.5,
                    margin: 10,
                    stagePadding: 20,
                },
                992: {
                    items: 4,
                },
            }
        });

        jQuery('.categories-carousel').owlCarousel({
            rtl: true,
            nav: true,
            dots: false,
            margin: 20,
            items: 2,
            stagePadding: 0,
            autoplay: true,
            autoplayTimeout: 10000,
            loop: false,
            smartSpeed: 2000,
            navText: ["<i class='icon-arrow-right'></i>", "<i class='icon-arrow-left'></i>"],
            responsive: {
                0: {
                    items: 2,

                },
                576: {
                    items: 2,
                },
                992: {
                    items: 6,
                }
            }
        });
        jQuery('.product-carousel').owlCarousel({
            rtl: true,
            nav: true,
            dots: false,
            margin: 20,
            items: 1,
            stagePadding: 0,
            autoplay: true,
            autoplayTimeout: 10000,
            loop: false,
            smartSpeed: 2000,
            navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
            responsive: {
                0: {
                    items: 1,

                },
                576: {
                    items: 2,
                },
                992: {
                    items: 4,
                }
            }
        });

        jQuery('.blog-carousel').owlCarousel({
            rtl: true,
            nav: true,
            dots: false,
            margin: 20,
            items: 1,
            stagePadding: 0,
            autoplay: true,
            autoplayTimeout: 10000,
            smartSpeed: 2000,
            navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
            responsive: {
                0: {
                    items: 1,
                    loop: true,

                },
                576: {
                    items: 2,
                    loop: true,
                },
                992: {
                    items: 3,
                    loop: false,
                }
            }
        });


        jQuery('.brands-carousel').owlCarousel({
            rtl: true,
            nav: true,
            dots: false,
            margin: 20,
            stagePadding: 0,
            autoplay: true,
            autoplayTimeout: 10000,
            smartSpeed: 2000,
            navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
            responsive: {
                0: {
                    items: 2,
                    loop: true,

                },
                576: {
                    items: 2,
                    loop: true,
                },
                992: {
                    items: 6,
                    loop: false,
                }
            }
        });


        /*****************************************************
         gallery js
         *****************************************************/

        jQuery('.editor-content.main-content .owl-gallery').owlCarousel({
            slideSpeed: 500,
            rtl: true,
            stagePadding: 10,
            autoplay: true,
            autoplaySpeed: 3000,
            smartSpeed: 1000,
            loop: false,
            margin: 10,
            dots: false,
            nav: true,
            lazyLoad: true,
            navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
            responsive: {
                0: {
                    items: 2,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
            }
        });
        jQuery('#sidebar .owl-gallery').owlCarousel({
            slideSpeed: 500,
            rtl: true,
            autoplay: true,
            autoplaySpeed: 3000,
            smartSpeed: 1000,
            loop: false,
            margin: 20,
            items: 1,
            dots: false,
            nav: true,
            lazyLoad: true,
            navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
        });

        /*****************************************************
         Single access post
         *****************************************************/

        jQuery('.help-heading ul li a, .access-post a , .more-tax-desc').on('click', function (e) {
            e.preventDefault();
            var hash = this.hash;
            jQuery('html, body').animate({
                scrollTop: jQuery(hash).offset().top
            }, 800);
        });


        /*****************************************************
         seach pop up
         *****************************************************/

        jQuery(".header-search").click(function (e) {
            e.preventDefault();
            jQuery(".search-pup-up").fadeIn(500);
            jQuery(".search-pup-up").addClass('popup-search-active');
        });
        jQuery(".fd-outer").click(function (e) {
            e.preventDefault();
            jQuery(".search-pup-up").fadeOut(500);
            jQuery(".search-pup-up").removeClass('popup-search-active');
        });

        /*****************************************************
         AJAX search
         *****************************************************/
        jQuery('.search-close , .search-form .search-remove').click(function () {
            jQuery(".search-results-box").html('').fadeOut();
            jQuery("#search-text").val('');
            jQuery('.search-form .search-remove').fadeOut(400);
        });
        jQuery('#search-text').on('input', function () {
            var subject = jQuery(this).val().trim();
            if (subject.length > 1) {
                jQuery('.search-form .search-remove').fadeOut(400);
                jQuery('.search-form .search-loading').fadeIn(400);
            } else {
                jQuery('.search-form .search-remove , .search-form .search-loading').fadeOut(400);
            }
        });
        jQuery("#search-text").donetyping(function () {
            var subject = jQuery(this).val().trim();
            if (subject.length > 1) {
                jQuery.ajax({
                    type: 'post',
                    async: true,
                    url: ajax_data.url,
                    data: {
                        action: 'results_search',
                        'subject': subject,
                        keyword: jQuery('#search-text').val(),
                    },
                    dataType: "html",
                    /* beforeSend : function(){
                        jQuery('.search-form .search-remove').fadeOut(400);
                        jQuery('.search-form .search-loading').fadeIn(400);
                    } */
                }).done(function (data) {
                    jQuery('.search-form .search-loading').fadeOut(400);
                    jQuery('.search-form .search-remove').fadeIn(400);

                    jQuery(".search-results-box").html('').html(data).fadeIn(400);
                    jQuery('#head_search form').addClass('sc_open');
                });
            } else {
                //jQuery('.search-form .search-remove , .search-form .search-loading').fadeOut(400);
                jQuery(".search-results-box").html('').fadeOut(400);
            }
        });


        /*****************************************************
         Single Product image js
         *****************************************************/
        if (jQuery('.single-product').length > 0) {
            var slider = jQuery('#single-product-slider');
            var thumbnailSlider = jQuery('#single-product-thumbnail');
            var duration = 500;
            slider.owlCarousel({
                loop: false,
                rtl: true,
                nav: false,
                lazyLoad: true,
                dots: false,
                items: 1,
                mouseDrag: false
            }).on('changed.owl.carousel', function (e) {
                thumbnailSlider.trigger('to.owl.carousel', [e.item.index, duration, true]);
            });
            thumbnailSlider.owlCarousel({
                loop: false,
                rtl: true,
                nav: true,
                dots: false,
                mouseDrag: false,
                touchDrag: false,
                lazyLoad: true,
                navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
                responsive: {
                    0: {
                        items: 3
                    },
                    400: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 4
                    }
                }
            }).on('click', '.owl-item', function () {
                slider.trigger('to.owl.carousel', [$(this).index(), duration, true]);

            }).on('changed.owl.carousel', function (e) {
                slider.trigger('to.owl.carousel', [e.item.index, duration, true]);
            });

            jQuery('.page_lightgallery').lightGallery({
                thumbnail: true,
                selector: '.product_gallery_item a',
                subHtmlSelectorRelative: true
            });
        }
        jQuery(document).ready(function () {
            jQuery('form.variations_form').on('show_variation', function (event, data) {
                if (jQuery('#single-product-thumbnail').find('.item[data-from="variation"]').length > 0) {
                    jQuery('#single-product-thumbnail').trigger('remove.owl.carousel', -1);
                    jQuery('#single-product-slider').trigger('remove.owl.carousel', -1);
                }
                if (jQuery('#single-product-thumbnail').find('.item[data-id="' + data.image_id + '"]').length > 0) {
                    jQuery('#single-product-thumbnail .item[data-id="' + data.image_id + '"]').click();
                } else {
                    jQuery('#single-product-thumbnail').trigger('add.owl.carousel', ['<div class="item" data-from="variation" data-id="' + data.image_id + '"><img src="' + data.image['src'] + '"></div>']).trigger('refresh.owl.carousel');
                    jQuery('#single-product-slider').trigger('add.owl.carousel', ['<div class="item" data-from="variation" data-id="' + data.image_id + '"><img src="' + data.image['src'] + '"></div>']).trigger('refresh.owl.carousel');
                    jQuery('#single-product-thumbnail .item[data-id="' + data.image_id + '"]').click();
                }

            });

        });


        /*****************************************************
         Factor
         *****************************************************/
        if (jQuery("body").hasClass("woocommerce-checkout")) {
            if (jQuery('#customer-type_field').length) {
                jQuery('#national-code_field').hide();
                jQuery('#company_field').hide();
                jQuery('#register-number_field').hide();
                jQuery('#economic-code_field').hide();
                jQuery('#national-id_field').hide();

                jQuery('#customer-type_field input[type="radio"]').change(function () {
                    if (this.value == 'haghighi') {
                        jQuery('#national-code_field').show();
                        jQuery('#company_field').hide();
                        jQuery('#register-number_field').hide();
                        jQuery('#economic-code_field').hide();
                        jQuery('#national-id_field').hide();
                    } else {
                        jQuery('#national-code_field').hide();
                        jQuery('#company_field').show();
                        jQuery('#register-number_field').show();
                        jQuery('#economic-code_field').show();
                        jQuery('#national-id_field').show();
                    }
                });
            }
        }


        /*****************************************************
         Group attribute
         *****************************************************/
        if (jQuery("body").hasClass("single-product")) {
            jQuery(".shop_attributes").on('click', '.attribute_group_row', function ($) {
                var group = jQuery(this).next().find(".attribute-inner-table-wrapper");
                if (group.is(":visible")) {
                    group.stop().slideUp();
                    group.removeClass('open');
                    jQuery('.attribute_group_row').removeClass('open');
                } else {
                    jQuery(".shop_attributes .attribute-inner-table-wrapper").stop().slideUp();
                    group.stop().slideDown();
                    group.addClass('open');
                    jQuery(this).addClass('open');
                }
            });
        }
    });


    /*****************************************************
     Tab SCRIPT FAQ
     *****************************************************/
    jQuery('.tab-links li').click(function (e) {
        e.preventDefault();
        jQuery('.tab-links li').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.tab-content').removeClass('active in');
        var activeTab = jQuery(this).find('a').attr('href');
        jQuery(activeTab).addClass('active in');
    });

    /*****************************************************
     ACCordion SCRIPT FAQ
     *****************************************************/

    jQuery('.accordion').click(function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        if ($this.next().hasClass('show')) {
            $this.next().removeClass('show');
            $this.next().slideUp(350);
            $this.parent().removeClass('active');
        } else {
            $this.parent().addClass('active');
            $this.parent().parent().find('li .inner').removeClass('show');
            $this.parent().parent().find('li .inner').slideUp(350);
            $this.next().toggleClass('show');
            $this.next().slideToggle(350);
        }
    });

    /*****************************************************
     JS For Gallery
     *****************************************************/

    if (jQuery('.owl-gallery').length > 0) {
        jQuery('.page_lightgallery').lightGallery({
            thumbnail: true,
            selector: '.gallery_item a',
            subHtmlSelectorRelative: true
        });
    }

    /*****************************************************
     JS for ALL sidebar
     *****************************************************/

    //jQuery('.cat-item .children').slideUp();


    jQuery('.widget-side li.current-cat-parent').find('.children').css('display', 'block')


    jQuery(".cat-item ").children('.children').after("<span class='caticon'></span>");
    jQuery(".children").parent().addClass("cat-parent");
    jQuery(".cat-parent .caticon").each(function (index) {
        jQuery(this).on("click", function () {
            jQuery(this).toggleClass('active');
            jQuery(this).siblings(".children").slideToggle(300);
        });
    });
    jQuery(".sidebar-btn").on("click", function () {
        jQuery(this).siblings("#sidebar").toggleClass('active')
        $("#mask").fadeIn(500);
    });
    jQuery("#sidebar").on("click", '.sidebar-close', function () {
        jQuery(this).parent("#sidebar").toggleClass('active')
        $('#mask').fadeOut(500);
    });


    /*  Donetyping */
    //https://www.sanwebe.com/snippet/simple-done-typing-jquery-function
    $.fn.donetyping = function (callback) {
        var _this = $(this);
        var x_timer;
        _this.keyup(function () {
            clearTimeout(x_timer);
            x_timer = setTimeout(clear_timer, 1000);
        });

        function clear_timer() {
            clearTimeout(x_timer);
            callback.call(_this);
        }
    }

    /*****************************************************
     Modal js
     *****************************************************/

    jQuery("body").on('click', '*[data-toggle="modal"]', function () {
        var target = jQuery(this).attr("data-target");
        jQuery(target).fadeIn();
        jQuery(target).addClass('show');
    });

    jQuery(".modal").on('click', '.close', function () {
        jQuery(this).parents('.modal').fadeOut();
        jQuery(this).parents('.modal').removeClass('show');
    });


}(jQuery));

(function ($) {
    let slider_header = $('.slider_header').owlCarousel({
        items: 1,
        margin: 30,
        rtl: true,
        loop: true,
        dots: false,
    })
    let slider_offer_day = $('.slider_offer_day').owlCarousel({
        items: 1,
        margin: 30,
        rtl: true,
        loop: true,
        dots: false,
    })
    let swiper_category_product = $('.swiper_category_product').owlCarousel({
        items: 7.3,
        margin: 24,
        rtl: true,
        loop: true,
        dots: true,
        // center: true
    })
    let slider_brands_index = $('.slider_brands_index').owlCarousel({
        items: 6,
        margin: 32,
        rtl: true,
        dots: true,
    })


    $(".navigation_slider_arrow.next").click(function () {
        slider_header.trigger('next.owl.carousel');
    })

    $(".navigation_slider_arrow.prev").click(function () {
        slider_header.trigger('prev.owl.carousel');
    })

}(jQuery));