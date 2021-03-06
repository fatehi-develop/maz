/**
 * DoneTyping
 */
(function ($) {
    $.fn.extend({
        donetyping: function (callback, timeout) {
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference, doneTyping = function (el) {
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
        $("#menumobile .sub-menu").prepend("<div class='title-sub-head'><span class='sub-closer float-left'><i></i></span><strong class='float-right title-subcome'>????????????</strong></div>");
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
                    items: 2, margin: 10, stagePadding: 20,
                }, 450: {
                    items: 3, margin: 10, stagePadding: 20,
                }, 768: {
                    items: 3.5, margin: 10, stagePadding: 20,
                }, 992: {
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

                }, 576: {
                    items: 2,
                }, 992: {
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

                }, 576: {
                    items: 2,
                }, 992: {
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
                    items: 1, loop: true,

                }, 576: {
                    items: 2, loop: true,
                }, 992: {
                    items: 3, loop: false,
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
                    items: 2, loop: true,

                }, 576: {
                    items: 2, loop: true,
                }, 992: {
                    items: 6, loop: false,
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
                }, 576: {
                    items: 2,
                }, 768: {
                    items: 3,
                }, 992: {
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
                    type: 'post', async: true, url: ajax_data.url, data: {
                        action: 'results_search', 'subject': subject, keyword: jQuery('#search-text').val(),
                    }, dataType: "html", /* beforeSend : function(){
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
                loop: false, rtl: true, nav: false, lazyLoad: true, dots: false, items: 1, mouseDrag: false
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
                    }, 400: {
                        items: 2
                    }, 992: {
                        items: 3
                    }, 1200: {
                        items: 4
                    }
                }
            }).on('click', '.owl-item', function () {
                slider.trigger('to.owl.carousel', [$(this).index(), duration, true]);

            }).on('changed.owl.carousel', function (e) {
                slider.trigger('to.owl.carousel', [e.item.index, duration, true]);
            });

            jQuery('.page_lightgallery').lightGallery({
                thumbnail: true, selector: '.product_gallery_item a', subHtmlSelectorRelative: true
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
            thumbnail: true, selector: '.gallery_item a', subHtmlSelectorRelative: true
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
        items: 1, margin: 30, rtl: true, loop: true, dots: false,
    })
    let slider_offer_day = $('.slider_offer_day').owlCarousel({
        items: 1, margin: 30, rtl: true, dots: false, loop: true, mouseDrag: false, touchDrag: false, responsive: {
            0: {
                items: 1,
            }, 400: {
                items: 2,
            }, 576: {
                items: 2,
            }, 768: {
                items: 3,
            }, 992: {
                items: 1,
            }

        }
    })
    let swiper_category_product = $('.swiper_category_product').owlCarousel({
        items: 7.1, margin: 24, rtl: true, loop: true, dots: true, responsive: {
            0: {
                items: 1, margin: 10
            }, 250: {
                items: 1.5, margin: 10
            }, 320: {
                items: 2, margin: 10
            }, 576: {
                items: 3, margin: 10
            }, 768: {
                items: 3, margin: 10
            }, 992: {
                items: 4,
            }, 1200: {
                items: 5,
            }, 1300: {
                items: 5.7,
            }, 1500: {
                items: 6.1,
            }, 1700: {
                items: 7.1,
            }

        }
    })
    let slider_brands_index = $('.slider_brands_index').owlCarousel({
        items: 6, margin: 10, rtl: true, dots: true, responsive: {
            0: {
                items: 1,
            }, 250: {
                items: 2,
            }, 350: {
                items: 3,
            }, 576: {
                items: 4,
            }, 992: {
                items: 5,
            }, 1200: {
                items: 6,
            }, 1300: {
                items: 6, margin: 32
            },

        }

    })
    let best_sallers_product = $('.best_sallers_product').owlCarousel({
        items: 3.4, margin: 25, rtl: true, dots: false, responsive: {
            0: {
                items: 1, margin: 10
            }, 250: {
                items: 1.5, margin: 10
            }, 320: {
                items: 2, margin: 10
            }, 459: {
                items: 1, margin: 10
            }, 768: {
                items: 2, margin: 10
            }, 992: {
                items: 2.4,
            }, 1300: {
                items: 3.4,
            }

        }
    })
    let products_offer_slider = $('.products_offer_slider').owlCarousel({
        items: 6, margin: 15, rtl: true, dots: false, loop: true, responsive: {
            0: {
                items: 1, margin: 15
            }, 400: {
                items: 2,
            }, 576: {
                items: 2,
            }, 768: {
                items: 3,
            }, 992: {
                items: 4,
            }, 1200: {
                items: 5,
            }, 1300: {
                items: 6, margin: 25
            },
        }

    })

    function postsCarousel() {
        var checkWidth = $(window).width();
        var owlPost = $(".category_slider");
        if (checkWidth > 992) {
            if (typeof owlPost.data('owl.carousel') != 'undefined') {
                owlPost.data('owl.carousel').destroy();
            }
            owlPost.removeClass('owl-carousel');
        } else if (checkWidth < 992) {
            owlPost.addClass('owl-carousel');
            owlPost.owlCarousel({
                items: 4, margin: 15, rtl: true, dots: false,
                responsive: {
                    0: {
                        items: 2, margin: 10
                    }, 415: {
                        items: 3, margin: 10
                    }, 517: {
                        items: 3, margin: 10
                    }, 768: {
                        items: 4, margin: 10
                    }

                }
            });
        }
    }

    postsCarousel();
    $(window).resize(postsCarousel);


    function slider_tab_title_cat_pro() {
        var checkWidth = $(window).width();
        var owlPost = $(".slider_tab_title");
        if (checkWidth > 1300) {
            if (typeof owlPost.data('owl.carousel') != 'undefined') {
                owlPost.data('owl.carousel').destroy();
            }
            owlPost.removeClass('owl-carousel');
        } else if (checkWidth < 1300) {
            owlPost.addClass('owl-carousel');
            owlPost.owlCarousel({
                autoWidth:true, margin: 15, rtl: true, dots: false,
            });
        }
    }
    slider_tab_title_cat_pro();
    $(window).resize(slider_tab_title_cat_pro);



    $(".hero.navigation_slider_arrow.next").click(function () {
        slider_header.trigger('next.owl.carousel')
    })

    $(".hero.navigation_slider_arrow.prev").click(function () {
        slider_header.trigger('prev.owl.carousel')
    })

    $(".offer.navigation_slider_arrow.next").click(function () {
        products_offer_slider.trigger('next.owl.carousel')
    })

    $(".offer.navigation_slider_arrow.prev").click(function () {
        products_offer_slider.trigger('prev.owl.carousel')
    })

    $(".best_sallers.navigation_slider_arrow.next").click(function () {
        best_sallers_product.trigger('next.owl.carousel')
    })

    $(".best_sallers.navigation_slider_arrow.prev").click(function () {
        best_sallers_product.trigger('prev.owl.carousel')
    })


    $(".slider_offer_day").ready(function () {
        let width_org = $(".timer")[0].offsetWidth
        let calc_time = width_org * 0.05
        setInterval(function () {
            let width_timer = $(".timer .line")[0].offsetWidth
            $(".timer .line").css({"width": width_timer - 1})
            if (width_timer == 0) {
                slider_offer_day.trigger('next.owl.carousel');
                $(".timer .line").css({"width": width_org})
            }
        }, calc_time)
    })

    function get_time_format(get_time_expire) {
        let now = new Date().getTime();
        let distance = get_time_expire - now;

        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);


        return {
            "days": Math.abs(days),
            "hours": Math.abs(hours),
            "minutes": Math.abs(minutes),
            "seconds": Math.abs(seconds),
            "distance": distance
        };
    }

    $(".item-product").ready(function () {
        $(".item-product").each(function (key, item) {
            let get_date_expire = $(item).attr("data-sale-to")
            let get_date_start = $(item).attr("data-sale-from")

            if (get_date_expire && get_date_start) {
                let get_time_expire = new Date(get_date_expire).getTime();
                let get_time_start = new Date(get_date_start).getTime();

                let info = get_time_format(get_time_expire)
                $(item).find(".timer_post__day .days").html(info.days)
                $(item).find(".timer_post__day .hours").html(info.hours)
                $(item).find(".timer_post__day .minutes").html(info.minutes)
                $(item).find(".timer_post__day .seconds ").html(info.seconds)

                let x = setInterval(function () {
                    let info = get_time_format(get_time_expire)
                    $(item).find(".timer_post__day .days").html(info.days)
                    $(item).find(".timer_post__day .hours").html(info.hours)
                    $(item).find(".timer_post__day .minutes").html(info.minutes)
                    $(item).find(".timer_post__day .seconds ").html(info.seconds)

                    let off = (get_time_expire - get_time_start)
                    let percent = (info.distance * 100) / off
                    $(item).find(".timer_post__line span ").css({"width": percent + '%'})

                }, 1000);
            }
        })
    })

    $(".show-more").click(function () {
        let des = $(this).parents(".box-des-footer").find("p")
        if (des.hasClass("before")) {
            des.css({"height": des[0].scrollHeight})
            $(this).find("span").html("????????")
            $(this).find("i").css({'rotate': '180deg'})
        } else {
            des.css({"height": 67})
            $(this).find("span").html("??????????")
            $(this).find("i").css({'rotate': '0deg'})
        }
        des.toggleClass('before')
    })


    /**
     * generate tab
     * @param {string} [tabIndex] - The tabIndex is value of data-tabindex in parent tab.
     */
    function tabInit(tabIndex) {
        if (typeof tabIndex === "undefined" || tabIndex === null) {
            $('[data-tabindex]').each(function () {
                let ele = $(this), dataTabindex = ele.attr('data-tabindex'), hasTrueTab = false;
                ele.find(' .tab-content [data-tabc][data-parent="' + dataTabindex + '"]').hide();
                ele.find(' .tab-title  [data-tab][data-parent="' + dataTabindex + '"]').each(function () {
                    let i;
                    if ($(this).hasClass('active')) {
                        i = $(this).attr('data-tab');
                        ele.find('.tab-content [data-tabc="' + i + '"][data-parent="' + dataTabindex + '"]').addClass('active').fadeIn();
                        hasTrueTab = true;
                    }
                    if (hasTrueTab !== true) {
                        ele.find('.tab-content [data-tabc="' + i + '"][data-parent="' + dataTabindex + '"]:first-of-type').fadeIn();
                        ele.find('.tab-title [data-tab="' + i + '"][data-parent="' + dataTabindex + '"]:first-of-type').addClass('active');
                    }
                });
                ele.find(' .tab-title [data-tab][data-parent="' + dataTabindex + '"]').click(function () {
                    if (!$(this).hasClass('active')) {
                        let t = $(this).attr('data-tab'),
                            oldActiveTab = ele.find(' .tab-title  [data-tab][data-parent="' + dataTabindex + '"].active').attr('data-tab');
                        ele.find(' .tab-title  [data-tab=' + oldActiveTab + '][data-parent="' + dataTabindex + '"]').removeClass('active');
                        ele.find(' .tab-content  [data-tabc=' + oldActiveTab + '][data-parent="' + dataTabindex + '"]').removeClass('active').hide();
                        $(this).addClass('active');
                        ele.find(' .tab-content  [data-tabc="' + t + '"][data-parent="' + dataTabindex + '"]').fadeIn();
                    }
                });
            });
        } else {
            let dataTabindex = tabIndex;
            tabIndex = '[data-tabindex=' + tabIndex + ']';
            $(tabIndex).find(' .tab-content [data-tabc][data-parent="' + dataTabindex + '"]').hide();
            $(tabIndex).find(' .tab-title [data-tab][data-parent="' + dataTabindex + '"]').each(function () {
                var i;
                if ($(this).hasClass('active')) {
                    i = $(this).attr('data-tab');
                    $(tabIndex).find(' .tab-content  [data-tabc="' + i + '"][data-parent="' + dataTabindex + '"]').addClass('active').fadeIn();
                }
            });
            $(tabIndex).find(' .tab-title  [data-tab][data-parent="' + dataTabindex + '"]').click(function () {
                if (!$(this).hasClass('active')) {
                    let t = $(this).attr('data-tab'),
                        oldActiveTab = $(tabIndex).find(' .tab-title  [data-tab][data-parent="' + dataTabindex + '"].active').attr('data-tab');
                    $(tabIndex).find(' .tab-title  [data-tab=' + oldActiveTab + '][data-parent="' + dataTabindex + '"]').removeClass('active');
                    $(tabIndex).find(' .tab-content  [data-tabc=' + oldActiveTab + '][data-parent="' + dataTabindex + '"]').removeClass('active').hide();
                    $(this).addClass('active');
                    $(tabIndex).find(' .tab-content  [data-tabc="' + t + '"][data-parent="' + dataTabindex + '"]').fadeIn();
                }
            });
        }
        $('body').on('click', '[data-tabindex-current]', function () {
            let dataTabindex = $(this).attr('data-tabindex-current'), ele = $('[data-tabindex="' + dataTabindex + '"]'),
                tabCurrent = $(this).attr('data-tab-current');
            ele.find('.tab-title  [data-tab][data-parent="' + dataTabindex + '"]').removeClass('active');
            ele.find('.tab-content  [data-tabc][data-parent="' + dataTabindex + '"]').hide();
            ele.find('.tab-title  [data-tab="' + tabCurrent + '"][data-parent="' + dataTabindex + '"]').addClass('active');
            ele.find('.tab-content  [data-tabc="' + tabCurrent + '"][data-parent="' + dataTabindex + '"]').fadeIn();


        });
    }

    tabInit();


    $("body").on("mouseenter", ".box_products_offer .item-product", function (e) {
        $(".products_offer .item-product").addClass("blur")
        $(this).removeClass("blur")
        $(this).addClass("scale")
    });

    $("body").on("mouseleave", ".box_products_offer .item-product", function (e) {
        $(".products_offer .item-product").removeClass("blur")
        $(this).removeClass("scale")
    });


}(jQuery));