(function ($) {

    // The slider being synced must be initialized first
    $('#fmp-carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 100,
        itemMargin: 5,
        asNavFor: '#fmp-slider'
    });

    $('#fmp-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#fmp-carousel"
    });

    $(document).on('click', '.fmp-disable', function (e) {
        e.preventDefault();
    });

    $(".fmp-wrapper a.fmp-disable").each(function () {
        $(this).prop("disabled", true);
        $(this).removeAttr("href");
    });

    function setVariation(target) {
        if (!target) return;

        var attribute = {};
        var variation_form = $(target).closest( '.variations_form' );
        var attributData = variation_form.data('product_variations') || [];

        variation_form
            .find('select[name^=attribute]')
            .each(function () {
                var key = $(this).closest('select').attr('id');
                attribute['attribute_'+key] = $(this).val();
            });

        attributData.some(function (attr) {
            if (JSON.stringify(attr.attributes) === JSON.stringify(attribute)) {
                variation_form.find( 'input[name=variation_id]' ).val(attr.variation_id);
                return true;
            } else {
                variation_form.find( 'input[name=variation_id]' ).val(0);
            }
        });
    }

    $(document).on('change','.fmp-qv-add-to-cart select[name^=attribute]', function() {
        setVariation(this);
    });
    // Reyad end

    $(document).on('click', '.fmp-popup', function (event) {
        event.preventDefault();
        var _this = $(this),
            _id = _this.data('id');
        $.ajax({
            type: "POST",
            url: fmp.ajaxurl,
            data: {
                action: 'fmp_ajax',
                id: _id
            },
            beforeSend: function () {
                $("body > .fmp-modal").remove();
                $('<div class="modal-spinner"></div>').appendTo('body').show();
            },
            success: function (data) {
                $('body > .modal-spinner').remove();
                var modal = $("<div class='fmp-modal'>" + data.html + "</div>").appendTo('body').modal({
                    fadeDuration: 100
                });
                callSlider();
                setVariation($(document).find('.fmp-qv-add-to-cart select[name^=attribute]').eq(0));
            },
            error: function (jqXHR, exception) {
                var result;
                if (jqXHR.status === 0) {
                    result = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    result = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    result = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    result = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    result = 'Time out error.';
                } else if (exception === 'abort') {
                    result = 'Ajax request aborted.';
                } else {
                    result = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                $('body > .modal-spinner').remove();
                $("<div class='fmp-modal'>" + result + "</div>").appendTo('body').modal({
                    fadeDuration: 100
                });
            }
        });
        return false;
    });

    $(document).on('click', '.fmp-wrapper .fmp-wc-add-to-cart-btn', function (e) {
        e.preventDefault();
        var self = $(this),
            productType = self.data('type') || 'simple',
            productId = self.data('id') || 0,
            variationId = self.data('variation-id') || 0,
            quantity = parseInt(self.parents('.fmp-wc-add-to-cart-wrap, .fmp-price-box').find('input[name="quantity"]').val(), 10) || 1;
        var data = {
            action: 'fmp_wc_ajax_add_to_cart',
            product_id: productId,
            quantity: quantity,
            type: productType,
            variation_id: variationId,
        };

        $.ajax({
            url: fmp.ajaxurl,
            data: data,
            type: "POST",
            beforeSend: function () {
                self.parent().find('.fmp-wc-view-cart').remove();
                self.addClass('loading');
            },
            success: function (response) {
                var fragments = response.fragments;
                if (fragments) {
                    $.each(fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });
                    $('<a href="' + fmp.wc_cart_url + '" class="fmp-wc-view-cart" title="View cart">View cart</a>').insertAfter(self);
                }
                self.removeClass('loading');
            },
            error: function () {
                self.parent().find('.fmp-wc-view-cart').remove();
                self.removeClass('loading');
            }
        });

        return false;
    });

    $('.fmp-tabs-wrapper ul.fmp-tabs').on('click', 'li', function () {
        var $this = $(this),
            id = $this.data('id'),
            parent = $this.parents('.fmp-tabs-wrapper'),
            tabs = $this.parent('.fmp-tabs');
        parent.find('.fmp-tab-panel').hide();
        tabs.find('li').removeClass('active');
        $this.addClass('active');
        $this.addClass('active');
        $('#' + id).show();
        return false;
    });
    $('.fmp-tabs-wrapper').find('.fmp-tab-panel').hide();
    $('.fmp-tabs-wrapper ul.fmp-tabs li:first-child').trigger('click');

    $(window).on('load resize', function () {
        equalHeight();
    });
    $(window).on('load', function () {
        initFMP();
    });

    function initFMP() {
        $('.fmp-wrapper').each(function () {
            var container = $(this);
            var str = $(this).attr("data-layout");
            if (str) {
                var qsRegex,
                    buttonFilter;
                var Iso = container.find(".fmp-isotope");
                var caro = container.find('.fmp-carousel');
                if (caro.length) {
                    caro.parents('.fmp-row').removeClass('fmp-pre-loader');
                    var items = caro.data('items'),
                        loop = caro.data('loop'),
                        nav = caro.data('nav'),
                        dots = caro.data('dots'),
                        autoplay = caro.data('autoplay'),
                        autoPlayHoverPause = caro.data('autoplay-hover-pause'),
                        autoPlayTimeOut = caro.data('autoplay-timeout'),
                        autoHeight = caro.data('autoHeight'),
                        lazyLoad = caro.data('lazyLoad'),
                        rtl = caro.data('rtl'),
                        smartSpeed = caro.data('smart-speed');
                    caro.owlCarousel({
                        items: items ? items : 3,
                        loop: loop ? true : false,
                        nav: nav ? true : false,
                        dots: dots ? true : false,
                        navText: ["<i class=\'fa fa-chevron-left\'></i>", "<i class=\'fa fa-chevron-right\'></i>"],
                        autoplay: autoplay ? true : false,
                        autoplayHoverPause: autoPlayHoverPause ? true : false,
                        autoplayTimeout: autoPlayTimeOut ? autoPlayTimeOut : 5000,
                        smartSpeed: smartSpeed ? smartSpeed : 250,
                        autoHeight: autoHeight ? true : false,
                        lazyLoad: lazyLoad ? true : false,
                        rtl: rtl ? true : false,
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 1
                            },
                            600: {
                                items: 2
                            },
                            1000: {
                                items: items ? items : 3
                            }
                        }
                    });
                }

                if (Iso.length) {
                    var IsoButton = container.find(".fmp-isotope-buttons");
                    if (!buttonFilter) {
                        buttonFilter = IsoButton.find('button.selected').data('filter');
                    }
                    var isotope = Iso.imagesLoaded(function () {
                        preFunction();
                        Iso.parents('.fmp-row').removeClass('fmp-pre-loader');
                        isotope.isotope({
                            itemSelector: '.fmp-isotope-item',
                            masonry: {columnWidth: '.fmp-isotope-item'},
                            filter: function () {
                                var $this = $(this);
                                var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
                                var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                                return searchResult && buttonResult;
                            }
                        });
                    });
                    // use value of search field to filter
                    var $quicksearch = container.find('.iso-search-input').keyup(debounce(function () {
                        qsRegex = new RegExp($quicksearch.val(), 'gi');
                        isotope.isotope();
                    }));

                    IsoButton.on('click touchstart', 'button', function (e) {
                        e.preventDefault();
                        buttonFilter = $(this).attr('data-filter');
                        isotope.isotope();
                        $(this).parent().find('.selected').removeClass('selected');
                        $(this).addClass('selected');
                    });

                    if (container.find('.fmp-utility .fmp-load-more').length) {
                        container.find(".fmp-load-more").on('click', 'button', function (e) {
                            e.preventDefault(e);
                            loadMoreButton($(this), isotope, container, 'isotope', IsoButton);
                        });
                    }

                    if (container.find('.fmp-utility .fmp-scroll-load-more').length) {
                        $(window).on('scroll', function () {
                            var $this = container.find('.fmp-utility .fmp-scroll-load-more');
                            scrollLoadMore($this, isotope, container, 'isotope', IsoButton);
                        });
                    }
                } else if (container.find('.fmp-row.fmp-masonry').length) {
                    var masonryTarget = $('.fmp-row.fmp-masonry');
                    preFunction();
                    var isotopeM = masonryTarget.imagesLoaded(function () {
                        isotopeM.isotope({
                            itemSelector: '.masonry-grid-item',
                            masonry: {columnWidth: '.masonry-grid-item'}
                        });
                    });
                    if (container.find('.fmp-utility .fmp-load-more').length) {
                        container.find(".fmp-load-more").on('click', 'button', function (e) {
                            e.preventDefault(e);
                            loadMoreButton($(this), isotopeM, container, 'mLayout');
                        });
                    }
                    if (container.find('.fmp-utility .fmp-scroll-load-more').length) {
                        $(window).on('scroll', function () {
                            var $this = container.find('.fmp-utility .fmp-scroll-load-more');
                            if ($this.attr('data-trigger') > 0) {
                                scrollLoadMore($this, isotopeM, container, 'mLayout');
                            }
                        });
                    }

                    if (container.find('.fmp-utility .fmp-pagination.fmp-ajax').length) {
                        ajaxPagination(container, isotopeM);
                    }
                } else {
                    if (container.find(".fmp-utility  .fmp-load-more").length) {
                        container.find(".fmp-load-more").on('click', 'button', function (e) {
                            e.preventDefault(e);
                            loadMoreButton($(this), isotopeM, container, 'eLayout');
                        });
                    }
                    if (container.find('.fmp-utility .fmp-scroll-load-more').length) {
                        $(window).on('scroll', function () {
                            var $this = container.find('.fmp-utility .fmp-scroll-load-more');
                            if ($this.attr('data-trigger') > 0) {
                                scrollLoadMore($this, isotopeM, container, 'eLayout');
                            }
                        });
                    }
                    if (container.find('.fmp-utility .fmp-pagination.fmp-ajax').length) {
                        ajaxPagination(container);
                    }
                }
            }
        });
    }

    function loadMoreButton($this, $isotope, container, layout, IsoButton) {
        var $thisText = $this.text();
        var data,
            scID = $this.attr("data-sc-id"),
            paged = parseInt($this.attr("data-paged"), 10),
            data = "scID=" + scID + "&paged=" + paged;
        data = data + "&action=fmpLoadMore&" + fmp.nonceID + "=" + fmp.nonce;
        if (container.data("archive")) {
            data = data + "&archive=" + container.data("archive");
            if (container.data("archive-value")) {
                data = data + "&archive-value=" + container.data("archive-value");
            }
        }

        $.ajax({
            type: "post",
            url: fmp.ajaxurl,
            data: data,
            beforeSend: function () {
                $this.html('<span class="more-loading">Loading ...</span>');
            },
            success: function (data) {

                if (!data.error) {
                    $this.attr("data-paged", paged + 1);
                    if (layout == "isotope") {
                        renderIsotope(container, $isotope, data.data, IsoButton);
                    } else if (layout == "mLayout") {
                        $isotope.append(data.data).isotope('appended', data.data).isotope('updateSortData').isotope('reloadItems').isotope();
                    } else {
                        container.children(".fmp-row").append(data.data);
                    }
                    preFunction();
                    $this.text($thisText);
                } else {
                    $this.text(data.msg);
                    $this.attr('disabled', 'disabled');
                    $this.parent().hide();
                }
            }
        });
        return false;
    }

    function renderIsotope(container, $isotope, data, IsoButton) {

        var qsRegexG, buttonFilter;
        if (!buttonFilter) {
            buttonFilter = IsoButton.find('button.selected').data('filter');
        }

        $isotope.append(data)
            .isotope('appended', data)
            .isotope('reloadItems')
            .isotope('updateSortData')
            .isotope();
        preFunction();
        setTimeout(function () {
            preFunction();
            $isotope.isotope();
        }, 100);

        $(IsoButton).on('click touchstart', 'button', function (e) {
            e.preventDefault();
            buttonFilter = $(this).attr('data-filter');
            $isotope.isotope();
            $(this).parent().find('.selected').removeClass('selected');
            $(this).addClass('selected');
        });
        var $quicksearch = container.find('.iso-search-input').keyup(debounce(function () {
            qsRegexG = new RegExp($quicksearch.val(), 'gi');
            $isotope.isotope();
        }));
    }

    function scrollLoadMore($this, $isotope, container, layout, IsoButton) {
        var viewportHeight = $(window).height();
        var scrollTop = $(window).scrollTop();
        var targetHeight = $this.offset().top + $this.outerHeight() - 50;
        var targetScroll = scrollTop + viewportHeight;

        if (targetScroll >= targetHeight) {
            var trigger = $this.attr("data-trigger");
            if (trigger == 1) {
                // $this.data('trigger', false);
                $this.attr("data-trigger", 0);
                var data,
                    scID = $this.attr("data-sc-id"),
                    paged = parseInt($this.attr("data-paged"), 10);
                data = "scID=" + scID + "&paged=" + paged;
                data = data + "&action=fmpLoadMore&" + fmp.nonceID + "=" + fmp.nonce;

                if (container.data("archive")) {
                    data = data + "&archive=" + container.data("archive");
                    if (container.data("archive-value")) {
                        data = data + "&archive-value=" + container.data("archive-value");
                    }
                }
                $.ajax({
                    type: "post",
                    url: fmp.ajaxurl,
                    data: data,
                    beforeSend: function () {
                        $this.html('<span class="more-loading">Loading ...</span>');
                    },
                    success: function (data) {
                        if (!data.error) {
                            $this.attr("data-paged", paged + 1);
                            if (layout == "isotope") {
                                renderIsotope(container, $isotope, data.data, IsoButton);
                            } else if (layout == "mLayout") {
                                $isotope.append(data.data).isotope('appended', data.data).isotope('updateSortData').isotope('reloadItems').isotope();
                            } else {
                                container.children(".fmp-row").append(data.data);
                            }
                            preFunction();
                            $this.html('');
                            $this.attr("data-trigger", 1);
                        } else {
                            $this.html('');
                            $this.attr("data-trigger", 0);
                        }
                    }
                });
            } // if trigger == 1

        }
    }

    function ajaxPagination(container, isotopeM) {
        $(".fmp-pagination.fmp-ajax ul li").on('click', 'a', function (e) {
            e.preventDefault();
            var data,
                $this = $(this),
                target = $this.parents("li"),
                parent = target.parents(".fmp-pagination.fmp-ajax"),
                activeLi = parent.find("li.active"),
                activeNumber = parseInt(activeLi.text(), 10),
                replaced = "<a data-paged='" + activeNumber + "' href='#'>" + activeNumber + "</a>",
                scID = parent.data("sc-id"),
                paged = $this.data("paged");
            activeLi.html(replaced);
            parent.find("li").removeClass("active");
            target.addClass("active");
            target.html("<span>" + paged + "</span>");
            data = "scID=" + scID + "&paged=" + paged;
            data = data + "&action=fmpLoadMore&" + fmp.nonceID + "=" + fmp.nonce;

            if (container.data("archive")) {
                data = data + "&archive=" + container.data("archive");
                if (container.data("archive-value")) {
                    data = data + "&archive-value=" + container.data("archive-value");
                }
            }
            $.ajax({
                type: "post",
                url: fmp.ajaxurl,
                data: data,
                beforeSend: function () {
                    parent.append('<div class="fmp-loading-holder"><span class="more-loading">Loading ...</span></div>');
                },
                success: function (data) {

                    if (!data.error) {
                        if (typeof isotopeM === "undefined") {
                            container.children(".fmp-row").animate({opacity: 0});
                            container.children(".fmp-row").html(data.data).show();
                            $(document).imagesLoaded(function () {
                                $.when(preFunction()).done(function () {
                                    container.children(".fmp-row").animate({opacity: 1});
                                });
                            });
                        } else {
                            container.children(".fmp-row").find(".masonry-grid-item").remove();
                            $.when(
                                isotopeM.append(data.data).isotope('appended', data.data).isotope('updateSortData').isotope('reloadItems').isotope()
                            ).done(function () {
                                isotopeM.imagesLoaded(function () {
                                    $.when(preFunction()).done(function () {
                                        isotopeM.isotope();
                                    });
                                });
                            });
                        }
                        // container.children(".fmp-row").fadeOut('slow').html(data.data).fadeIn('slow');
                        preFunction();
                    } else {
                        alert(data.msg);
                    }
                    $(".fmp-loading-holder").remove();
                }
            });
        });
    }

    function preFunction() {
        equalHeight();
    }

    function callSlider() {

        $('#fmp-carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 100,
            itemMargin: 5,
            asNavFor: '#fmp-slider'
        });

        $('#fmp-slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#fmp-carousel"
        });
    }

    function equalHeight() {
        var wWidth = $(window).width();
        $(".fmp-wrapper").each(function () {
            var _this = $(this),
                dCol = _this.data('desktop-col'),
                tCol = _this.data('tab-col'),
                mCol = _this.data('mobile-col'),
                target = $(this).find('.fmp-row.fmp-even'),
                rtMaxH = 0;
            if ((wWidth >= 992 && dCol > 1) || (wWidth >= 768 && tCol > 1) || (wWidth < 768 && mCol > 1)) {
                $(document).imagesLoaded(function () {
                    target.find(".even-grid-item").height("auto");
                    target.find('.even-grid-item').each(function () {
                        var $thisH = $(this).actual('outerHeight');
                        if ($thisH > rtMaxH) {
                            rtMaxH = $thisH;
                        }
                    });
                    //target.find(".even-grid-item").css('height', rtMaxH + "px");
                });
            } else {
                target.find(".even-grid-item").height("auto");
            }
        });
    }

    // debounce so filtering doesn't happen every millisecond
    function debounce(fn, threshold) {
        var timeout;
        return function debounced() {
            if (timeout) {
                clearTimeout(timeout);
            }

            function delayed() {
                fn();
                timeout = null;
            }

            setTimeout(delayed, threshold || 100);
        };
    }

})(jQuery);