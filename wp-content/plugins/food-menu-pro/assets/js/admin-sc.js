(function ($) {
    $("#fmp_layout").on('change', function () {
        showHideScMeta();
    });
    showHideScMeta();

    $("#fmp_pagination").on('change', function () {
        if (this.checked) {
            $(".rt-field-wrapper.fmp-pagination-item").show();
        } else {
            $(".rt-field-wrapper.fmp-pagination-item").hide();
        }
    });

    $("#fmp_carousel_options-autoplay").on('change', function () {
        if (this.checked) {
            $("#fmp_carousel_autoplay_timeout_holder").show();
        } else {
            $("#fmp_carousel_autoplay_timeout_holder").hide();
        }
    });

    $("#fmp_detail_page_link").on('change', function () {
        var item = $("#fmp_single_food_popup_holder");
        if (this.checked) {
            item.show();
        } else {
            item.hide();
        }
    });

    $("#fmp_image_size").on('change', function () {
        customImageSize();
    });

    $("#fmp_source").on("click", "input[type='radio']", function () {
        var self = $(this),
            source = self.val();
        if (source) {
            var target = $("#fmp_categories_holder select"),
                targetWrap = self.parents(".field");
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "fmp_sc_source_change",
                    source: source
                },
                beforeSend: function () {
                    targetWrap.append('<span class="fmp-loading fmp-animate-spin dashicons dashicons-update"></span>');
                },
                success: function (response) {
                    //console.log(response);
                    target.html(response.cat_list).val('').trigger('change');
                    targetWrap.find('.fmp-loading').remove();
                },
                error: function (jqXHR, exception) {
                    targetWrap.find('.fmp-loading').remove();
                    if (jqXHR.status === 0) {
                        alert('Not connect.\n Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found. [404]');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error [500].');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error.\n' + jqXHR.responseText);
                    }
                }
            });
        }
    });

    $("#fmp_pagination_type").on("click", "input[type='radio']", function () {
        var paginationType = $("#fmp_pagination_type").find("input[name=fmp_pagination_type]:checked").val();
        if (paginationType == "load_more") {
            $(".rt-field-wrapper.fmp-load-more-item").show();
        } else {
            $(".rt-field-wrapper.fmp-load-more-item").hide();
        }

    });

    function customImageSize() {
        /* custom image size jquery */
        var fImageSize = $("#fmp_image_size").val();
        if (fImageSize == "fmp_custom") {
            $("#fmp_custom_image_size_holder").show();
        } else {
            $("#fmp_custom_image_size_holder").hide();
        }
    }

    function showHideScMeta() {
        var layout = $("#fmp_layout").val();
        var isIsotope = false,
            isCarousel = false,
            isCat = false;
        if (layout) {
            isCarousel = layout.match(/^carousel/i);
            isIsotope = layout.match(/^isotope/i);
            isCat = layout.match(/^grid-by-cat/i);
            $("#fmp_pagination_type").find("label[for='fmp_pagination_type-pagination'],label[for='fmp_pagination_type-pagination_ajax']").show();
            $("#fmp_carousel_autoplay_timeout_holder").hide();
            if (isCarousel) {
                $(".rt-field-wrapper.fmp-carousel-item").show();
                $(".rt-field-wrapper.fmp-isotope-item,.rt-field-wrapper.pagination, #fmp_column_holder").hide();

                var autoPlay = $("#fmp_carousel_options-autoplay").prop("checked");
                //console.log(autoPlay);
                if (autoPlay) {
                    $("#fmp_carousel_autoplay_timeout_holder").show();
                }

            } else if (isIsotope) {
                $(".rt-field-wrapper.fmp-isotope-item,.rt-field-wrapper.pagination,#fmp_column_holder").show();
                $(".rt-field-wrapper.fmp-carousel-item").hide();
                $("#fmp_pagination_type").find("label[for='fmp_pagination_type-pagination'],label[for='fmp_pagination_type-pagination_ajax']").hide();
                var paginationType = $("#fmp_pagination_type").find("input[name=fmp_pagination_type]:checked").val();
                if (paginationType == "pagination" || paginationType == "pagination_ajax") {
                    $("#fmp_pagination_type").find("label[for='fmp_pagination_type-load_more'] input").prop("checked", true);
                } else if (paginationType == "load_more") {
                    $(".rt-field-wrapper.fmp-load-more-item").show();
                }
            } else if (isCat) {
                $(".rt-field-wrapper.pagination").hide();
            } else {
                $(".rt-field-wrapper.fmp-isotope-item,.rt-field-wrapper.fmp-carousel-item").hide();
                $(".rt-field-wrapper.pagination, #fmp_column_holder").show();
            }
        }

        var pagination = $("#fmp_pagination").is(':checked');
        if (pagination && !isCarousel) {
            $(".rt-field-wrapper.fmp-pagination-item").show();
        } else {
            $(".rt-field-wrapper.fmp-pagination-item").hide();
        }

        var page_link = $("#fmp_detail_page_link").is(':checked');
        if (page_link) {
            $("#fmp_single_food_popup_holder").show();
        } else {
            $("#fmp_single_food_popup_holder").hide();
        }

        customImageSize();
    }
})(jQuery);