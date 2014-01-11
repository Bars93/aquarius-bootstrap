(function ($) {
    jQuery.fn.emailvalid = function () {
        var res = false;
        if ($(this).val() != "") {
            var regexp = /.@./;
            if (regexp.test($(this).val())) {
                $(this).css("background-image", "url(img/ok.png)");
                if ($("#uemail_err")) {
                    $("#uemail_err").css("visibility", "hidden").css("height", "1px");
                }
                res = true;
            }
            else {
                $(this).css("background-image", "url(img/err.png)");
                if ($("#uemail_err")) {
                    $("#uemail_err").css("visibility", "visible").css("height", "40px");
                }
                res = false;
            }
        }
        else {
            $(this).css("background-image", "none");
            if ($("#uemail_err")) {
                $("#uemail_err").css("visibility", "hidden").css("height", "1px");
            }
            res = false;
        }
        return res;
    };
})(jQuery);