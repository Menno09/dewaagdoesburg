(function ($) {
    'use strict';

    /* Food data tab options */
    $('ul.fmp-tabs').show();
    $('ul.fmp-tabs').on('click', 'a', function (e) {
        e.preventDefault();
        var panel_wrapper = $(this).closest('div.panel-wrapper');
        $('ul.fmp-tabs li', panel_wrapper).removeClass('active');
        $(this).parent().addClass('active');
        $('div.panel', panel_wrapper).hide();
        $($(this).attr('href')).show();
    });
    $('div.panel-wrapper').each(function () {
        $(this).find('ul.fmp-tabs li').eq(0).find('a').click();
    });

    function changeFmpType() {
        var select_val = $('select#_fmp_type').val();
        if('variable' === select_val){
            $('.simple_menu_attr').hide();
            $('.variation-wrapper').show();
        }else{
            $('.simple_menu_attr').show();
            $('.variation-wrapper').hide();
        }

    }
    changeFmpType();
    $( 'select#_fmp_type' ).change( function(e) {
        // Get value.
        changeFmpType();
    });
    $( '.fmp-metabox.closed' ).each( function() {
        $( this ).find( '.fmp-metabox-content' ).hide();
    });
    $('.fmp_variations').on('blur', 'input.variation_name', function () {
        $(this).closest('.fmp_variation').find('strong.variation_name').text($(this).val());
    });
    $( '.fmp-metaboxes-wrapper' ).on( 'click', '.fmp-metabox > h3', function() {
        var target = $( this ).parent( '.fmp-metabox' );
        if(target.hasClass('closed')){
            target.find('.fmp-metabox-content').slideDown('slow');
        }else{
            target.find('.fmp-metabox-content').slideUp('slow');
        }
        target.toggleClass( 'closed' ).toggleClass( 'open' );
    });
    var preLoader_target = $('.fmp_variations'),
        fmp_preloader = function () {
            preLoader_target.addClass('fmp_loading');
            $('<div class="fmp-pre-loader"><span class="spinner is-active"></span>').appendTo(preLoader_target);
        },
        removePreLoader = function () {
            preLoader_target.removeClass('fmp_loading');
            preLoader_target.find('.fmp-pre-loader').remove();
        };
    $("button.add_variation").on('click', function () {
        var size = $('.fmp_variations .fmp_variation').length,
            $wrapper = $(this).closest('#general_fmp_data'),
            $variations = $wrapper.find('.fmp_variations'),
            data = {
                action: 'fmp_add_variation_action',
                parent_id: $('#post_ID').val(),
                i: size,
                nonceID: fmp_var.nonce
            };
        $.ajax({
            type: "POST",
            url: fmp_var.ajaxurl,
            data: data,
            beforeSend: function () {
                fmp_preloader();
            },
            success: function (data) {
                $variations.append(data);
                removePreLoader();
            },
            error: function (data) {
                //console.log(data);
                removePreLoader();
            }
        });

    });
    $( document ).on( 'click', '.fmp_variation .remove_row', function(e) {
        e.preventDefault();
        if(confirm("Are you sure to delete!!")) {
            var id = $(this).attr('data-id'),
                target = $(this).parents('.fmp_variation'),
                data = {
                    post_id: id,
                    action: 'fmp_remove_variation_action'
                };
            $.ajax({
                type: "POST",
                url: fmp_var.ajaxurl,
                data: data,
                beforeSend: function () {
                    fmp_preloader();
                },
                success: function (data) {
                    if (!data.error) {
                        target.slideUp('slow', function () {
                            $(this).remove();
                        });
                    }
                    removePreLoader();
                },
                error: function () {
                    //console.log(data);
                    removePreLoader();
                }
            });
        }
        return false;
    });
    $( 'button.save_variations' ).on( 'click', function() {
        var data = {
            data        : $( '.fmp_variations' ).find( 'input' ).serialize(),
            action      : 'fmp_save_variations_action'
        };

        $.ajax({
            type: "POST",
            url: fmp_var.ajaxurl,
            data: data,
            beforeSend: function () {
                fmp_preloader();
            },
            success: function (data) {
                //console.log(data);
                removePreLoader();
            },
            error: function (data) {
                //console.log(data);
                removePreLoader();
            }
        });
        return false;
    });
    /*



    $( 'button.save_attributes' ).on( 'click', function() {
        var data = {
            post_id     : $('#post_ID').val(),
            product_type: $( '#product-type' ).val(),
            data        : $( '.fmp_attributes' ).find( 'input, select, textarea' ).serialize(),
            action      : 'fmp_save_attributes_action'
        };

        $.ajax({
            type: "POST",
            url: fmp_var.ajaxurl,
            data: data,
            beforeSend: function () {
                //addPreLoader();
            },
            success: function (data) {
                console.log(data);
                //removePreLoader();
            },
            error: function (data) {
                console.log(data);
                //removePreLoader();
            }
        });
        return false;
    });
    $( '.fmp_attributes' ).on( 'click', '.remove_row', function() {

    });
    $( '.fmp_attributes' ).sortable({
        items: '.fmp_attribute',
        cursor: 'move',
        axis: 'y',
        handle: 'h3',
        scrollSensitivity: 40,
        forcePlaceholderSize: true,
        helper: 'clone',
        opacity: 0.65,
        placeholder: 'wc-metabox-sortable-placeholder',
        start: function( event, ui ) {
            ui.item.css( 'background-color', '#f6f6f6' );
        },
        stop: function( event, ui ) {
            ui.item.removeAttr( 'style' );
        }
    });

    */


    var fmp_admin = {
        "decimal_error": "Please enter in decimal (.) format without thousand separators.",
        "mon_decimal_error": "Please enter in monetary decimal (.) format without thousand separators and currency symbols.",
        "country_iso_error": "Please enter in country code with two capital letters.",
        "sale_less_than_regular_error": "Please enter in a value less than the regular price.",
        "decimal_point": ".",
        "mon_decimal_point": "."
    };
    $(document.body)
        .on('fmp_add_error_tip', function (e, element, error_type) {
            var offset = element.position();

            if (element.parent().find('.fmp_error_tip').length === 0) {
                element.after('<div class="fmp_error_tip ' + error_type + '">' + fmp_admin[error_type] + '</div>');
                element.parent().find('.fmp_error_tip')
                    .css('left', offset.left + element.width() - ( element.width() / 2 ) - ( $('.fmp_error_tip').width() / 2 ))
                    .css('top', offset.top + element.height())
                    .fadeIn('100');
            }
        })
        .on('fmp_remove_error_tip', function (e, element, error_type) {
            element.parent().find('.fmp_error_tip.' + error_type).fadeOut('100', function () {
                $(this).remove();
            });
        })
        .on('blur', '.fmp_input_price[type=text]', function () {
            $('.fmp_error_tip').fadeOut('100', function () {
                $(this).remove();
            });
        })
        .on('change', '.fmp_input_price[type=text]', function () {
            var regex;
            if ($(this).is('.fmp_input_price')) {
                regex = new RegExp('[^\-0-9\%\\' + fmp_admin.mon_decimal_point + ']+', 'gi');
            } else {
                regex = new RegExp('[^\-0-9\%\\' + fmp_admin.decimal_point + ']+', 'gi');
            }
            var value = $(this).val();
            var newvalue = value.replace(regex, '');
            if (value !== newvalue) {
                $(this).val(newvalue);
            }
        })
        .on('keyup', '.fmp_input_price[type=text]', function () {
            var regex, error;
            if ($(this).is('.fmp_input_price')) {
                regex = new RegExp('[^\-0-9\%\\' + fmp_admin.mon_decimal_point + ']+', 'gi');
                error = 'mon_decimal_error';
            } else if ($(this).is('.fmp_input_country_iso')) {
                regex = new RegExp('([^A-Z])+|(.){3,}', 'im');
                error = 'country_iso_error';
            } else {
                regex = new RegExp('[^\-0-9\%\\' + fmp_admin.decimal_point + ']+', 'gi');
                error = 'decimal_error';
            }
            var value = $(this).val();
            var newvalue = value.replace(regex, '');

            if (value !== newvalue) {
                $(document.body).triggerHandler('fmp_add_error_tip', [$(this), error]);
            } else {
                $(document.body).triggerHandler('fmp_remove_error_tip', [$(this), error]);
            }
        })
        .on('change', '#_sale_price.fmp_input_price[type=text]', function () {
            var sale_price_field = $(this),
                regular_price_field = $('#_regular_price');

            var sale_price = parseFloat(window.accounting.unformat(sale_price_field.val(), fmp_admin.mon_decimal_point));
            var regular_price = parseFloat(window.accounting.unformat(regular_price_field.val(), fmp_admin.mon_decimal_point));

            if (sale_price >= regular_price) {
                $(this).val('');
            }
        })
        .on('keyup', '#_sale_price.fmp_input_price[type=text]', function () {
            var sale_price_field = $(this),
                regular_price_field = $('#_regular_price');

            var sale_price = parseFloat(window.accounting.unformat(sale_price_field.val(), fmp_admin.mon_decimal_point));
            var regular_price = parseFloat(window.accounting.unformat(regular_price_field.val(), fmp_admin.mon_decimal_point));

            if (sale_price >= regular_price) {
                $(document.body).triggerHandler('fmp_add_error_tip', [$(this), 'sale_less_than_regular_error']);
            } else {
                $(document.body).triggerHandler('fmp_remove_error_tip', [$(this), 'sale_less_than_regular_error']);
            }
        })
        .on('keyup', '.fmp-item-search input[type=text]', function () {
            var _this = $(this),
                target = _this.parents('ul.fmp-available-list').find('li.available-item'),
                qsRegex = new RegExp(_this.val(), 'gi');
            if (qsRegex) {
                target.each(function () {
                    var item = $(this),
                        str = item.find('label').text();
                    if (str.match(qsRegex)) {
                        item.show();
                    } else {
                        item.hide();
                    }
                });
            } else {
                item.show();
            }
        });

    $("#ingredient-container .fmp-sortable-list").sortable({
        connectWith: ".fmp-sortable-list",
        'update': function (e, ui) {
            var $this = $(this),
                item = $(ui.item);
            if ($this.hasClass('fmp-active-list')) {
                if (item.find('input').length < 1) {
                    var id = item.data('id');
                    var units = fmp_var.units,
                        $unitOptions = '';
                    if (units) {
                        $.map(units, function (val, id) {
                            $unitOptions = $unitOptions + "<option value='" + id + "'>" + val + "</option>";
                        });
                    }
                    var options = "<input type='text' name='_ingredient[" + id + "][value]'>" +
                        "<select name='_ingredient[" + id + "][unit_id]'>" +
                        "<option value=''>Unit</option>" + $unitOptions +
                        "</select>";
                    item.find('.fmp-sortable-item-values').html(options);
                    item.removeClass('available-item').addClass('active-item');
                }
            } else {
                item.find('.fmp-sortable-item-values').html('');
                item.removeClass('active-item').addClass('available-item');
            }
        }
    }).disableSelection();


    $("#nutrition-container .fmp-sortable-list").sortable({
        connectWith: ".fmp-sortable-list",
        'update': function (e, ui) {
            var $this = $(this),
                item = $(ui.item);
            if ($this.hasClass('fmp-active-list')) {
                if (item.find('input').length < 1) {
                    var id = item.data('id');
                    var units = fmp_var.units,
                        $unitOptions = '';
                    if (units) {
                        $.map(units, function (val, id) {
                            $unitOptions = $unitOptions + "<option value='" + id + "'>" + val + "</option>";
                        });
                    }
                    var options = "<input type='text' name='_nutrition[" + id + "][value]'>" +
                        "<select name='_nutrition[" + id + "][unit_id]'>" +
                        "<option value=''>Unit</option>" + $unitOptions +
                        "</select>";
                    item.find('.fmp-sortable-item-values').html(options);
                    item.removeClass('available-item').addClass('active-item');
                }
            } else {
                item.find('.fmp-sortable-item-values').html('');
                item.removeClass('active-item').addClass('available-item');
            }
        }
    }).disableSelection();


    // menu order sorting
    if ($('.post-type-food-menu table.posts #the-list').length) {
        var fixHelper = function (e, ui) {
            ui.children().children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        };
        $('.post-type-food-menu table.posts #the-list').sortable({
            items: 'tr',
            axis: 'y',
            helper: fixHelper,
            placeholder: 'placeholder',
            opacity: 0.65,
            update: function (e, ui) {
                var order = $('#the-list').sortable('serialize');
                jQuery.ajax({
                    type: "post",
                    url: ajaxurl,
                    data: order + "&action=fmp-logo-update-menu-order",
                    beforeSend: function () {
                        $('body').append($("<div id='fmp-loading'><span class='fmp-loading'>Updating ...</span></div>"));
                    },
                    success: function (data) {
                        jQuery("#fmp-loading").remove();
                    }
                });
            }
        });
    }

    // Image gallery file uploads.
    var fmp_gallery_frame;
    var $image_gallery_ids = $('#fmp_image_gallery');
    var $fmp_images = $('#fmp_images_container').find('ul.fmp_images');

    $('.add_fmp_images').on('click', 'a', function (event) {
        var $el = $(this);

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if (fmp_gallery_frame) {
            fmp_gallery_frame.open();
            return;
        }

        // Create the media frame.
        fmp_gallery_frame = wp.media.frames.product_gallery = wp.media({
            // Set the title of the modal.
            title: $el.data('choose'),
            button: {
                text: $el.data('update')
            },
            states: [
                new wp.media.controller.Library({
                    title: $el.data('choose'),
                    filterable: 'all',
                    multiple: true
                })
            ]
        });

        // When an image is selected, run a callback.
        fmp_gallery_frame.on('select', function () {
            var selection = fmp_gallery_frame.state().get('selection');
            var attachment_ids = $image_gallery_ids.val();

            selection.map(function (attachment) {
                attachment = attachment.toJSON();

                if (attachment.id) {
                    attachment_ids = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
                    var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

                    $fmp_images.append('<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="#" class="delete" title="' + $el.data('delete') + '">' + $el.data('text') + '</a></li></ul></li>');
                }
            });

            $image_gallery_ids.val(attachment_ids);
        });

        // Finally, open the modal.
        fmp_gallery_frame.open();
    });

    // Image ordering.
    $fmp_images.sortable({
        items: 'li.image',
        cursor: 'move',
        scrollSensitivity: 40,
        forcePlaceholderSize: true,
        forceHelperSize: false,
        helper: 'clone',
        opacity: 0.65,
        placeholder: 'fmp-metabox-sortable-placeholder',
        start: function (event, ui) {
            ui.item.css('background-color', '#f6f6f6');
        },
        stop: function (event, ui) {
            ui.item.removeAttr('style');
        },
        update: function () {
            var attachment_ids = '';

            $('#fmp_images_container').find('ul li.image').css('cursor', 'default').each(function () {
                var attachment_id = $(this).attr('data-attachment_id');
                attachment_ids = attachment_ids + attachment_id + ',';
            });

            $image_gallery_ids.val(attachment_ids);
        }
    });

    // Remove images.
    $('#fmp_images_container').on('click', 'a.delete', function () {
        $(this).closest('li.image').remove();

        var attachment_ids = '';

        $('#fmp_images_container').find('ul li.image').css('cursor', 'default').each(function () {
            var attachment_id = $(this).attr('data-attachment_id');
            attachment_ids = attachment_ids + attachment_id + ',';
        });

        $image_gallery_ids.val(attachment_ids);

        // Remove any lingering tooltips.
        $('#tiptip_holder').removeAttr('style');
        $('#tiptip_arrow').removeAttr('style');

        return false;
    });
})(jQuery);