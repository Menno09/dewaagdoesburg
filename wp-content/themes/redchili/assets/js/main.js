jQuery(document).ready(function ($) {
    "use strict";

    $.fn.bsModal = $.fn.modal.noConflict();

    $(window).scroll(function(){
      var sticky = $('#meanmenu'),
          scroll = $(window).scrollTop();

      if (scroll >= 100) sticky.addClass('fixed');
      else sticky.removeClass('fixed');
    });

    $(document).on('click', '.rt-woo-iso-2-popup', function (e) {

        e.preventDefault();
        $('body > #rt-woo-iso-popup-modal').remove();
        var _this = $(this),
            showcart = _this.data('showcart'),
            id = _this.data('id') || 0,
            modal = $('<div id="rt-woo-iso-popup-modal" class="modal fade" />');
        modal.append('<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Modal Header</h4></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div>');
        $('body').append(modal);

        $.ajax({
            url: redChiliObj.ajaxurl,
            data: {product_id: id, showcart: showcart, action: 'rt_get_woo_single_data'},
            type: 'POST',
            beforeSend: function () {
                $('body').addClass('rt-loading');
            },
            success: function (response) {
                console.log(response);
                $('body').removeClass('rt-loading');
                if (response.success) {
                    modal.find('.modal-title').html(response.title);
                    modal.find('.modal-body').html(response.content);
                    modal.modal('show');
                } else {
                    alert(response.msg);
                }

            },
            error: function (e) {
                console.log(e);
                $('body').removeClass('rt-loading');
            }

        });

        return false;

    });

    // var rt_site_url = $('.food-menu2-area').data("url");
    var rt_site_url = $('.fmp-layout-custom-layout6').data("url");
    $(".rt-variable-price-box").on('click', 'a.ajax_add_to_cart', function (e) {
        e.preventDefault();
        var self = $(this),
            productId = self.data('product-id'),
            variationId = self.data('variation-id'),
            attributeName = self.data('attribute-name'),
            attributeValue = self.data('attribute-value'),
            quantity = parseInt(self.prev('.quantity').find('input[name="quantity"]').val(), 10),
            item = {};
        item[attributeName] = attributeValue;
        var data = {
            action: 'rt_add_to_cart_variable_rc',
            product_id: productId,
            quantity: quantity,
            variation_id: variationId,
            variation: item
        };

        $.ajax({
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            type: "POST",
            beforeSend: function () {

                $('.added_to_cart.wc-forward').remove();
                $('.view_button_tmp').remove();
                self.addClass('loading');
            },
            success: function (response) {
                var fragments = response.fragments;

                if (fragments) {

                    $.each(fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });

                    $('<a href="' + rt_site_url + '/cart/" class="view_button_tmp added_to_cart wc-forward" title="View cart">View cart</a>').insertAfter(self);

                }
                self.removeClass('loading');
                $('.view_button_tmp').remove();
            },
            error: function () {

            }
        });

        return false;
    });

    /* Fixing for hover effect at IOS */
    $('*').on('touchstart', function () {
        $(this).trigger('hover');
    }).on('touchend', function () {
        $(this).trigger('hover');
    });

    var a = $('.offscreen-navigation .menu');

    if (a.length) {
        a.children("li").addClass("menu-item-parent");
        a.find(".menu-item-has-children > a").on("click", function (e) {
            e.preventDefault();
            $(this).toggleClass("opened");
            var n = $(this).next(".sub-menu"),
                s = $(this).closest(".menu-item-parent").find(".sub-menu");
            a.find(".sub-menu").not(s).slideUp(250).prev('a').removeClass('opened'), n.slideToggle(250)
        });
        a.find('.menu-item:not(.menu-item-has-children) > a').on('click', function (e) {
            $('.rt-slide-nav').slideUp();
            $('body').removeClass('slidemenuon');
        });
    }

    $('.mean-bar .sidebarBtn').on('click', function (e) {
        e.preventDefault();
        if ($('.rt-slide-nav').is(":visible")) {
            $('.rt-slide-nav').slideUp();
            $('body').removeClass('slidemenuon');
        } else {
            $('.rt-slide-nav').slideDown();
            $('body').addClass('slidemenuon');
        }

    });

    $('#site-navigation').navpoints({
        updateHash:true
    });

    /* Search Box */
    $(".search-box-area").on('click', '.search-button, .search-close', function (event) {
        event.preventDefault();
        if ($('.search-text').hasClass('active')) {
            $('.search-text, .search-close').removeClass('active');
        } else {
            $('.search-text, .search-close').addClass('active');
        }
        return false;
    });

    /*header content gap*/
    var windowWidth = $(window).width();
    if (windowWidth > 991) {
        var Hh1 = $('.header-area'),
            Hh1slider = Hh1.parents('body').find("#header-area-space"),
            isAdmin = $("body").hasClass("admin-bar"),
            adminBarHeight,
            totalHeight,
            mHeight;
        if (isAdmin == true) {
            adminBarHeight = 32;
        } else {
            adminBarHeight = 0;
        }
        if (Hh1.length) {
            mHeight = $('body .header-area').outerHeight();
            totalHeight = mHeight - adminBarHeight;
            Hh1slider.css("margin-top", totalHeight + 'px');
        }
    }

    /* Sticky Menu */
    if (redChiliObj.stickyMenu == 1 || redChiliObj.stickyMenu == 'on') {

        $(window).on('scroll', function () {

            var s = $('#sticker'),
                w = $('body'),
                h = s.outerHeight(),
                windowpos = $(window).scrollTop(),
                windowWidth = $(window).width(),
                h1 = s.parent('#header-1'),
                h2 = s.parent('#header-2'),
                h3 = s.parent('#header-3'),
                h4 = s.parent('#header-4'),
                h5 = s.parent('#header-5'),
                h6 = s.parent('#header-6'),
                h7 = s.parent('#header-7'),
                h8 = s.parent('#header-8'),
                h1H = h1.find('.header-top-bar').outerHeight(),
                topBar = s.prev('.header-top-bar'),
                topBarP = w.hasClass('has-topbar'),
                tempMenu;
            if (windowWidth > 991) {

                w.css('padding-top', '');
                var topBarH, mBottom = 0;

                /*header 1 & header 2*/
                if (h1.length || h2.length || h5.length) {
                    if (topBarP == true) {

                        topBarH = topBar.outerHeight();
                        if (windowpos <= topBarH) {
                            if (h1.hasClass('header-fixed') || h2.hasClass('header-fixed') || h5.hasClass('header-fixed')) {
                                h1.css('top', '-' + windowpos + 'px');
                                h2.css('top', '-' + windowpos + 'px');
                                h5.css('top', '-' + windowpos + 'px');
                            }
                        }

                        if (windowpos >= topBarH) {
                            if (h1.length || h2.length || h5.length) {
                                s.addClass('stickp');
                                $('.header-fixed').addClass('bottomBorder');
                                w.removeClass("non-stickh");
                                w.addClass("stickh");

                                if (h1.hasClass('header-fixed') || h2.hasClass('header-fixed')) {
                                    h1.css('top', '-' + topBarH + 'px');
                                    h2.css('top', '-' + topBarH + 'px');
                                    h5.css('top', '-' + topBarH + 'px');
                                }
                            }
                        } else {
                            s.removeClass('stickp');
                            $('.header-fixed').removeClass('bottomBorder');
                            w.removeClass("stickh");
                            w.addClass("non-stickh");

                        }
                        if (windowpos == 0) {
                            if($("#upmenu-widget").length){
                                h1.css('top', '-' + 0 + 'px');
                                h2.css('top', '-' + 0 + 'px');
                                h5.css('top', '-' + 0 + 'px');
                                console.log('called 0');
                            }
                        } else {
                            if($("#upmenu-widget").length){
                                h1.css('top', '-' + h1.outerHeight() + 'px');
                                h2.css('top', '-' + h2.outerHeight() + 'px');
                                h5.css('top', '-' + h3.outerHeight() + 'px');
                                console.log('called');
                            }
                        }

                    } else {
                        if (windowpos == 0) {
                            if (h1.length || h2.length || h5.length) {
                                s.addClass('stickp');
                                $('.header-fixed').removeClass('bottomBorder');
                                w.removeClass("non-stickh");
                                w.addClass("stickh");
                                if($("#upmenu-widget").length){
                                    h1.css('top', '-' + 0 + 'px');
                                    h2.css('top', '-' + 0 + 'px');
                                    h5.css('top', '-' + 0 + 'px');
                                }

                                if (h1.hasClass('header-fixed') || h2.hasClass('header-fixed') || h5.hasClass('header-fixed')) {
                                    h1.css('top', '-' + topBarH + 'px');
                                    h2.css('top', '-' + topBarH + 'px');
                                    h5.css('top', '-' + topBarH + 'px');
                                }
                            }
                        } else {

                            s.removeClass('stickp');
                            $('.header-fixed').addClass('bottomBorder');
                            w.removeClass("stickh");
                            w.addClass("non-stickh");
                            if($("#upmenu-widget").length){
                                h1.css('top', '-' + h1.outerHeight() + 'px');
                                h2.css('top', '-' + h2.outerHeight() + 'px');
                                h5.css('top', '-' + h3.outerHeight() + 'px');
                            }
                        }
                    }
                }
                /*header 5*/
                if (h5.length) {
                    if (topBarP == true) {

                        topBarH = topBar.outerHeight();
                        if (windowpos <= topBarH) {
                            if (h5.hasClass('header-fixed')) {
                                h5.css('top', '-' + windowpos + 'px');
                            }
                        }

                        if (windowpos >= topBarH) {
                            if (h5.length) {
                                s.addClass('stickp');
                                $('.header-fixed').addClass('bottomBorder');
                                w.removeClass("non-stickh");
                                w.addClass("stickh");
                            }
                            if (h5.length) {
                                if (h5.hasClass('header-fixed')) {
                                    h5.css('top', '-' + 36 + 'px');
                                }
                            }
                        } else {
                            s.removeClass('stickp');
                            $('.header-fixed').removeClass('bottomBorder');
                            w.removeClass("stickh");
                            w.addClass("non-stickh");
                        }

                    } else {
                        if (windowpos == 0) {
                            if (h5.length) {
                                s.addClass('stickp');
                                $('.header-fixed').removeClass('bottomBorder');
                                w.removeClass("non-stickh");
                                w.addClass("stickh");
                            }
                            if (h5.length) {
                                if (h5.hasClass('header-fixed')) {
                                    h5.css('top', '-' + topBarH + 'px');
                                }
                            }
                        } else {
                            s.removeClass('stickp');
                            $('.header-fixed').addClass('bottomBorder');
                            w.removeClass("stickh");
                            w.addClass("non-stickh");
                        }
                    }
                }
                /*header 3*/
                var headerFirstrow = $('.header-firstrow').outerHeight(), h3heightGap;
                if (h3.length) {
                    topBarH = topBar.outerHeight();
                    h3heightGap = headerFirstrow + topBarH;
                    if (windowpos <= h3heightGap) {
                        if (h3.hasClass('header-fixed')) {
                            h3.css('top', '-' + windowpos + 'px');
                        }
                    }

                    if (windowpos >= h3heightGap) {
                        if (h3.length) {
                            s.addClass('stickp');
                            $('.header-fixed').addClass('bottomBorder');
                            w.removeClass("non-stickh");
                            w.addClass("stickh");
                        }
                        if (h3.length) {
                            if (h3.hasClass('header-fixed')) {
                                h3.css('top', '-' + h3heightGap + 'px');
                            } else {
                                w.css('padding-top', h + 'px');
                            }
                        }
                    } else {
                        s.removeClass('stickp');
                        $('.header-fixed').removeClass('bottomBorder');
                        w.removeClass("stickh");
                        w.addClass("non-stickh");
                        if (h3.length) {
                            w.css('padding-top', 0);
                        }
                    }
                }

                /*header 4*/
                var headerFirstrow = $('.header-firstrow').outerHeight(), h4heightGap;
                if (h4.length) {
                    topBarH = topBar.outerHeight();
                    h4heightGap = headerFirstrow + topBarH;
                    if (windowpos <= h4heightGap) {
                        if (h4.hasClass('header-fixed')) {
                            h4.css('top', '-' + windowpos + 'px');
                        }
                    }

                    if (windowpos >= h4heightGap) {
                        if (h4.length) {
                            s.addClass('stickp');
                            $('.header-fixed').addClass('bottomBorder');

                            w.removeClass("non-stickh");
                            w.addClass("stickh");

                        }
                        if (h4.length) {
                            if (h4.hasClass('header-fixed')) {
                                h4.css('top', '-' + h4heightGap + 'px');
                            }
                        }
                    } else {
                        s.removeClass('stickp');
                        $('.header-fixed').removeClass('bottomBorder');

                        w.removeClass("stickh");
                        w.addClass("non-stickh");
                    }
                }
            } //checking window width
        });

    }

    /* Header Right Menu */
    $('.additional-menu-area').on('click', '.side-menu-trigger', function (e) {
        e.preventDefault();
        $('.sidenav').width(280);

    });
    $('.additional-menu-area').on('click', '.closebtn', function (e) {
        e.preventDefault();
        $('.sidenav').width(0);
    });

    /* Mega Menu */
    $('.site-header .main-navigation ul > li.mega-menu').each(function () {
        // total num of columns
        var items = $(this).find(' > ul.sub-menu > li').length;
        // screen width
        var bodyWidth = $('body').outerWidth();
        // main menu link width
        var parentLinkWidth = $(this).find(' > a').outerWidth();
        // main menu position from left
        var parentLinkpos = $(this).find(' > a').offset().left;

        var width = items * 220;
        var left = (width / 2) - (parentLinkWidth / 2);

        var linkleftWidth = parentLinkpos + (parentLinkWidth / 2);
        var linkRightWidth = bodyWidth - (parentLinkpos + parentLinkWidth);

        // exceeds left screen
        if ((width / 2) > linkleftWidth) {
            $(this).find(' > ul.sub-menu').css({
                width: width + 'px',
                right: 'inherit',
                left: '-' + parentLinkpos + 'px'
            });
        }
        // exceeds right screen
        else if ((width / 2) > linkRightWidth) {
            $(this).find(' > ul.sub-menu').css({
                width: width + 'px',
                left: 'inherit',
                right: '-' + linkRightWidth + 'px'
            });
        } else {
            $(this).find(' > ul.sub-menu').css({
                width: width + 'px',
                left: '-' + left + 'px'
            });
        }
    });

    // Info Text hover 
    $(".info-box-1").on({
        mouseenter: function () {
            var hoverColor = $(this).data('hover');
            $(this).find("i").css('color', hoverColor);
        },
        mouseleave: function () {
            var color = $(this).data('color');
            $(this).find("i").css('color', color);
        }
    }, this);

    // Food Slider hover
    $(".wfmc-title").on({
        mouseenter: function () {
            var hoverColor = $(this).data('titlehover');
            $(this).find(".title-small.title-bar-small-center a").css('color', hoverColor);
        },
        mouseleave: function () {
            var color = $(this).data('titlecolor');
            $(this).find(".title-small.title-bar-small-center a").css('color', color);
        }
    }, this);

    /* Google map */
    if (redChiliObj.isEventPage == 1) {

        //Map initialize
        var initialize = function () {
            var mapOptions = {
                zoom: 15,
                scrollwheel: false,
                center: new google.maps.LatLng(redChiliObj.rc_event_lat, redChiliObj.rc_event_lan),
            };
            var map = new google.maps.Map(document.getElementById("event-map"),
                mapOptions);
            var marker = new google.maps.Marker({
                position: map.getCenter(),
                animation: google.maps.Animation.BOUNCE,
                icon: '../img/map-marker.png',
                map: map
            });
        }
        google.maps.event.addDomListener(window, "load", initialize);
    }

    /* Booking dates and time */
    var datePicker = $('.rt-date');
    if (datePicker.length) {
        datePicker.datetimepicker({
            format: 'Y-m-d',
            timepicker: false
        });
    }

    var timePicker = $('.rt-time');
    if (timePicker.length) {
        timePicker.timepicker({format: 'H:i', step: 15});
    }

if ( $.isFunction($.fn.flexslider) ) {
    $('.flexslider').flexslider({
        animation: "slide"
    });
}

    /* Scroll to top */
    $('.scrollToTop').on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });

    /* Woocommerce Shop change view */
    $('#shop-view-mode li a').on('click', function () {
        $('body').removeClass('product-grid-view').removeClass('product-list-view');

        if ($(this).closest('li').hasClass('list-view-nav')) {
            $('body').addClass('product-list-view');
            Cookies.set('shopview', 'list');
        } else {
            $('body').addClass('product-grid-view');
            Cookies.remove('shopview');
        }
        return false;
    });

    /* Owl Custom Nav */
    if (typeof $.fn.owlCarousel == 'function') {
        $(".owl-custom-nav .owl-next").on('click', function () {
            $(this).closest('.owl-wrap').find('.owl-carousel').trigger('next.owl.carousel');
        });
        $(".owl-custom-nav .owl-prev").on('click', function () {
            $(this).closest('.owl-wrap').find('.owl-carousel').trigger('prev.owl.carousel');
        });

        $(".rt-owl-carousel").each(function () {
            var options = $(this).data('carousel-options');
            if (redChiliObj.rtl == 'yes') {
                options['rtl'] = true; //@rtl                
            }
            $(this).owlCarousel(options);
        });
    }

    // VC fullscreen error fix in RTL /@rtl
    if (redChiliObj.rtl == 'yes') {
        rdthemeFixVcFullWidthRow();
        $(document).on('vc-full-width-row', function () {
            rdthemeFixVcFullWidthRow();
        });
    }

    /* Counter */
    var aboutContainer = $('.about-counter');

    if (aboutContainer.length) {
        aboutContainer.counterUp({
            delay: 50,
            time: 5000
        });
    }

    /* Header Right Menu */
    $('.additional-menu-area').on('click', '.side-menu-trigger', function (e) {
        e.preventDefault();
        $('.sidenav').width(280);
    });
    $('.additional-menu-area').on('click', '.closebtn', function (e) {
        e.preventDefault();
        $('.sidenav').width(0);
    });

    /* recipe preparation */
    $('.person-number').on('change', function (e) {
        e.preventDefault();
        var person_number = $('.person-number').val();
        var liIds = $('.ingredients-box ul li span').map(function (i, n) {
            var a = parseFloat($(n).attr("id"));
            var r = a * person_number;
            return $(this).text(parseFloat(r).toFixed(2));
        }).get().join(',');
    });

    /*extra menu - design*/
    var col_number = $('.single-cat-menu').data('desktop-col');
    if (col_number == '1') {
        $('.single-cat-menu').addClass('one-col');
    } else {
        $('.single-cat-menu').addClass('two-col');
    }


    /* when product quantity changes, update quantity attribute on add-to-cart button */
    $("form.cart").on("change", "input.qty", function () {
        if (this.value === "0")
            this.value = "1";

        $(this.form).find("button[data-quantity]").data("quantity", this.value);
    });

    /* remove old "view cart" text, only need latest one thanks! */
    $(document.body).on("adding_to_cart", function () {
        $("a.added_to_cart").remove();
    });

    /*variable ajax cart end*/
    $('.quantity').on('click', '.plus', function (e) {
        var self = $(this),
            $input = self.prev('input.qty'),
            target = self.parents('form').find('.product_type_simple'),
            val = parseInt($input.val(), 10) + 1;
        target.attr("data-quantity", val);
        $input.val(val);

        return false;
    });

    $('.quantity').on('click', '.minus', function (e) {
        var self = $(this),
            $input = self.next('input.qty'),
            target = self.parents('form').find('.product_type_simple'),
            val = parseInt($input.val(), 10);
        val = (val > 1) ? val - 1 : val;
        target.attr("data-quantity", val);
        $input.val(val);
        return false;
    });

    /*count charecter - js*/
    $(".fmp-layout-custom-grid-by-cat2 .menu-list .fmp-price").each(function () {
        var price_lenght_2 = $(this).text().length;
        if (price_lenght_2 > 5) {
            $('.fmp-cat2 .fmp-box ul.menu-list li span.fmp-price').css('font-size', '15px');
        }
    });
    $(".fmp-layout-custom-grid-by-cat4 .fmp-cat2 .fmp-box ul.menu-list li span.fmp-price").each(function () {
        var price_lenght_3 = $(this).text().length;
        if (price_lenght_3 > 5) {
            $('.fmp-layout-custom-grid-by-cat4 .fmp-cat2 .fmp-box ul.menu-list li span.fmp-price').css('font-size', '15px');
        }
    });
    $(".fmp-layout-custom-grid-by-cat3 .card-menu-price").each(function () {
        var price_lenght_3 = $(this).text().length;
        if (price_lenght_3 > 5) {
            $('.fmp-layout-custom-grid-by-cat3 .card-menu-price ').css('font-size', '15px');
        }
    });

    //@rtl
    function rdthemeFixVcFullWidthRow() {
        var $elements = jQuery('[data-vc-full-width="true"]');
        jQuery.each($elements, function () {
            var $el = jQuery(this);
            $el.css('right', $el.css('left')).css('left', '');
        });
    }

});

(function ($) {
    "use strict";

    // Window Load+Resize
    $(window).on('load resize', function () {
        // Define the maximum height for mobile menu
        var wHeight = $(window).height();
        wHeight = wHeight - 50;
        $('.mean-nav > ul').css('max-height', wHeight + 'px');
    });

    /*For upmenu*/
    //$(window).on ( 'scroll' , function() {
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 300) {

            $(".theme-cart-col").addClass("placeupmenu");
            $(".pagination-area").addClass("placeupmenu");

        } else {

            $(".theme-cart-col").removeClass("placeupmenu");
            $(".pagination-area").removeClass("placeupmenu");

        }
    });


    /* Window load function */
    $(window).on('load', function () {
        // Page Preloader
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });

        /* Isotope initialization */
        var $container = $('#inner-isotope');
        if ($container.length > 0) {

            // Isotope initialization
            var $isotope = $container.find('.featuredContainer').isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });

            // Isotope filter
            $container.find('.rt-food-menu-tab').on('click', 'button', function () {

                var $this = $(this);
                $this.parent('.rt-food-menu-tab').find('button').removeClass('current');
                $this.addClass('current');
                var selector = $this.attr('data-filter');
                $isotope.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
				
				$("#rt-home-isotope-fix .fmp-isotope-buttons button").first().trigger('click');
                
				return false;				
            });
            $("#rt-home-isotope-fix .fmp-isotope-buttons button[data-filter='*']").remove();

        }
    });

})(jQuery);