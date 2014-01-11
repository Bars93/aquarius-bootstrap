(function ($) {
    jQuery.fn.passwordvalid = function () {
        var res = true;
        var valid = function () {
            if ($("#login_cpw").val() != "") {
                if ($("#login_pw").val() == $("#login_cpw").val()) {
                    $("#login_cpw").css("background-image", "url(img/ok.png)");
                    $("#cpw_err").css("visibility", "hidden");
                    $("#cpw_err").css("height", "1px");
                }
                else {
                    $("#login_cpw").css("background-image", "url(img/err.png)");
                    $("#cpw_err").css("visibility", "visible");
                    $("#cpw_err").css("height", "40px");
                    res = false;
                }
            }
            else {
                $("#login_cpw").css("background-image", "none");
                $("#cpw_err").css("visibility", "hidden");
                $("#cpw_err").css("height", "1px");
                res = false;
            }
        };
        if ($(this).val() != "") {
            var regexp = /(?!^[0-9]*$)(?!^[a-zA-Z!@#$%^&*()_+=<>?]*$)^([a-zA-Z!@#$%^&*()_+=<>?0-9]{6,})$/;
            if (regexp.test($(this).val())) {
                $(this).css("background-image", "url(img/ok.png)");
                $("#upw_err").css("visibility", "hidden");
                $("#upw_err").css("height", "1px");
                res = true;
            }
            else {
                $(this).css("background-image", "url(img/err.png)");
                $("#upw_err").css("visibility", "visible");
                $("#upw_err").css("height", "40px");
                res = false;
            }
            valid();
        }
        else {
            $(this).css("background-image", "none");
            $("#upw_err").css("visibility", "hidden");
            $("#upw_err").css("height", "1px");
            res = false;
            valid();
        }
        return res;
    };
})(jQuery);