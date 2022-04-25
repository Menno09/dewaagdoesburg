(function ($) {

    "use strict";

    $("#fmp-settings-form").on('click', '.rt-licensing-btn', function (e) {
        e.preventDefault();
        var self = $(this),
            type = self.attr('name'),
            data = 'type=' + type;
        $("#license_key_holder").find(".rt-licence-msg").remove();
        RtFmAjaxCall(self, 'rtFmpManageLicencing', data, function (data) {
            if (!data.error) {
                self.val(data.value);
                self.attr('name', data.name);
                self.addClass(data.class);
                if (data.name === 'license_deactivate') {
                    self.removeClass('button-primary');
                    self.addClass('danger');
                } else if (data.name === 'license_activate') {
                    self.removeClass('danger');
                    self.addClass('button-primary');
                }
            }
            if (data.msg) {
                $("<div class='rt-licence-msg'>" + data.msg + "</div>").insertAfter(self);
            }
            self.blur();
        });

        return false;
    });

    $("#fmp-settings-form").on("fmp_update_settings_form", function(event, data) {

        var response_wrapper = $(this).next('.rt-response');

        if (!data.error) {
            response_wrapper.removeClass('error').addClass('success');
            response_wrapper.show('slow').text(data.msg);
            var holder = $("#license_key_holder");
            if (!$(".license-status", holder).length && $("#license_key", holder).val()) {
                //console.log('inner');
                var bindElement = $("#license_key", holder),
                    target = $(".description", holder);
                target.find(".rt-licence-msg").remove();
                RtFmAjaxCall(bindElement, 'rtFmp_active_Licence', '', function (data) {
                    if (!data.error) {
                        target.append("<span class='license-status'>" + data.html + "</span>");
                    }
                    if (data.msg) {
                        if (target.find(".rt-licence-msg").length) {
                            target.find(".rt-licence-msg").html(data.msg);
                        } else {
                            target.append("<span class='rt-licence-msg'>" + data.msg + "</span>");
                        }
                        if (!data.error) {
                            target.find(".rt-licence-msg").addClass('success');
                        }
                    }
                });
            }
            if (!$("#license_key", holder).val()) {
                $('.license-status, .rt-licence-msg', holder).remove();
            }
        } else {
            response_wrapper.addClass('error').removeClass('success');
            response_wrapper.show('slow').text(data.msg);
        }
    });

    if ($('#plugin-license').length) {
        var $this = $('#license_key');
        var prevLicense = $this.val();
        $this.on('input', function() {
            if (prevLicense !== $this.val()) {
                $('.rt-licensing-btn').hide();
            } else {
                $('.rt-licensing-btn').show();
            }
        });
    }

})(jQuery);