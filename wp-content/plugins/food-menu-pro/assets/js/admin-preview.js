(function ($) {

     $("#fmsc_sc_settings_meta").on('change', 'select,input', function () {
         FmpRenderPreview();
    });
    $("#fmsc_sc_settings_meta").on("input propertychange", function () {
        FmpRenderPreview();
    });

    $("span.rtAddImage").on("click", function (e) {
        var file_frame, image_data;
        var $this = $(this).parents('.rt-image-holder');
        if (undefined !== file_frame) {
            file_frame.open();
            return;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select or Upload Media For your profile gallery',
            button: {
                text: 'Use this media'
            },
            multiple: false
        });
        file_frame.on('select', function () {
            var attachment = file_frame.state().get('selection').first().toJSON();
            var imgId = attachment.id;
            var imgUrl = (typeof attachment.sizes.thumbnail === "undefined") ? attachment.url : attachment.sizes.thumbnail.url;
            $this.find('.hidden-image-id').val(imgId);
            $this.find('.rtRemoveImage').show();
            $this.find('img').remove();
            $this.find('.rt-image-preview').append("<img src='" + imgUrl + "' />");
            FmpRenderPreview();
        });
        // Now display the actual file_frame
        file_frame.open();
    });

    $("span.rtRemoveImage").on("click", function (e) {
        e.preventDefault();
        if (confirm("Are you sure?")) {
            var $this = $(this).parents('.rt-image-holder');
            $this.find('.hidden-image-id').val('');
            $this.find('.rtRemoveImage').hide();
            $this.find('img').remove();
            FmpRenderPreview();
        }
    });

    $(document).ready(function () {
        FmpRenderPreview();
    });

    function FmpRenderPreview() {
        if ($("#fmsc_sc_settings_meta").length) {
            var data = $("#fmsc_sc_settings_meta").find('input[name],select[name],textarea[name]').serialize();
            data = data + '&' + $.param({'sc_id': $('#post_ID').val() || 0});
            fmpPreviewAjaxCall(null, 'fmpPreviewAjaxCall', data, function (data) {
                if (!data.error) {
                    $("#fmp-preview-container").html(data.data).promise().done(function () {
                        renderLayout();
                    });
                }
            });
        }
    }

    function renderLayout() {
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

                    IsoButton.on('click', 'button', function (e) {
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
        var data = $("#fmsc_sc_settings_meta").find('input[name],select[name],textarea[name]').serialize(),
            paged = parseInt($this.attr("data-paged"), 10),
            data = data + "&paged=" + paged + "&action=fmpLoadMorePreview&" + fmp.nonceID + "=" + fmp.nonce;
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

        $(IsoButton).on('click', 'button', function (e) {
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
                var data = $("#fmsc_sc_settings_meta").find('input[name],select[name],textarea[name]').serialize(),
                    paged = parseInt($this.attr("data-paged"), 10),
                    data = data + +"&paged=" + paged + "&action=fmpLoadMorePreview&" + fmp.nonceID + "=" + fmp.nonce;

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
            var data = $("#fmsc_sc_settings_meta").find('input[name],select[name],textarea[name]').serialize(),
                $this = $(this),
                target = $this.parents("li"),
                parent = target.parents(".fmp-pagination.fmp-ajax"),
                activeLi = parent.find("li.active"),
                activeNumber = parseInt(activeLi.text(), 10),
                replaced = "<a data-paged='" + activeNumber + "' href='#'>" + activeNumber + "</a>",
                paged = $this.data("paged"),
                data = data + "&paged=" + paged + "&action=fmpLoadMorePreview&" + fmp.nonceID + "=" + fmp.nonce;
            activeLi.html(replaced);
            parent.find("li").removeClass("active");
            target.addClass("active");
            target.html("<span>" + paged + "</span>");

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
                            $.when(preFunction()).done(function () {
                                container.children(".fmp-row").animate({opacity: 1});
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


    function equalHeight() {
        var wWidth = $(window).width();
        $(".fmp-wrapper").each(function () {
            var _this = $(this),
                dCol = _this.data('desktop-col'),
                tCol = _this.data('tab-col'),
                mCol = _this.data('mobile-col'),
                target = $(this).find('.fmp-row.fmp-even'),
                rtMaxH = 0;
            if ((wWidth >= 1200 && dCol > 1) || (wWidth >= 992 && tCol > 1) || (wWidth >= 768 && mCol > 1)) {
                $(document).imagesLoaded(function () {
                    target.find(".even-grid-item").height("auto");
                    target.find('.even-grid-item').each(function () {
                        var $thisH = $(this).actual('outerHeight');
                        if ($thisH > rtMaxH) {
                            rtMaxH = $thisH;
                        }
                    });
                    target.find(".even-grid-item").css('height', rtMaxH + "px");
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

    function fmpPreviewAjaxCall(element, action, arg, handle) {
        var data;
        if (action) data = "action=" + action;
        if (arg)    data = arg + "&action=" + action;
        if (arg && !action) data = arg;

        var n = data.search(fmp.nonceID);
        if (n < 0) {
            data = data + "&" + fmp.nonceID + "=" + fmp.nonce;
        }
        $.ajax({
            type: "post",
            url: fmp.ajaxurl,
            data: data,
            beforeSend: function () {
                $('#fmsc_sc_preview_meta').addClass('loading');
                $('.fmp-response .spinner').addClass('is-active');
            },
            success: function (data) {
                $('#fmsc_sc_preview_meta').removeClass('loading');
                $('.fmp-response .spinner').removeClass('is-active');
                handle(data);
            }
        });
    }

})(jQuery);