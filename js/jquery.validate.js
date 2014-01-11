(function ($) {
    jQuery.fn.validate = function () {
        var check = false;
        var valid = function () {
            check = nickok;
            check = $("#login_email").emailvalid() && check;
            check = $("#login_pw").passwordvalid() && check;
            if (check) {
                $("#reg_btn").attr("type", "submit");
                $("#reg_btn").attr("onclick", "");
            }
            else {
                $("#reg_btn").attr("type", "button");
                $("#reg_btn").attr("onclick", "alert('Пожалуйста, заполните все поля правильно!');");
            }
        };
        valid();
        $("#login_name").typing({
            start: function(event,$elem) {
              nickok = false;
                $("regbtn").attr("type","button");
                $("regbtn").attr("onclick","alert('Пожалуйста, заполните все поля правильно!');")
            },
            stop:function(event,$elem) {
                $elem.nickvalid();
            },
            delay: 700
        });
        $("#login_email").keyup(function () {
            valid();
        }).blur(function () {
            valid();
        });
        $("#login_pw").typing({
            stop: function(){valid();},
            delay: 500
        });
        $("#login_cpw").keyup(function () {
            valid();
        }).blur(function () {
            valid();
        });
        return true;
    };
})(jQuery);
