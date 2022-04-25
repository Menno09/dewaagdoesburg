(function ($) {
    if ($(".rt-select2").length) {
        $("select.rt-select2").select2({
            minimumResultsForSearch: Infinity
        });
    }


    // menu order sorting
    if ($('.post-type-food-menu table.tags #the-list').length) {

        var fixHelper = function (e, ui) {
            ui.children().children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        };

        $('.post-type-food-menu table.tags #the-list').sortable({
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
                    data: order + "&action=fmp-cat-update-order",
                    beforeSend: function () {
                        $('body').append($("<div id='fmp-loading'><span class='fmp-loading'>Updating ...</span></div>"));
                    },
                    success: function (data) {
                        //console.log(data);
                        jQuery("#fmp-loading").remove();
                    }
                });
            }
        });
    }
})(jQuery);
