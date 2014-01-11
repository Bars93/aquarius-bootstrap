(function ($) {
    jQuery.fn.nickvalid = function () {
        var res = false;
        if ($(this).val() != "") {
            if ($(this).val().length <= 25) {
                $.when($.ajax({
                    url: "getuser.php?user_name=" + encodeURI($(this).val()),
                    caching: false,
                    dataType: "xml"
                }))
                .then(function(xmlResponse) {
                        var res = $("result",xmlResponse).map(function() {
                            return {
                                taken: $("taken", this).text()
                            };
                        }).get();
                        if(res[0].taken == "true") {
                            $("#login_name").css("background-image","url(img/err.png)");
							$("#uname_err").css("visibility", "visible");
							$("#uname_err").css("height", "40px");
							document.getElementById('uname_err').innerHTML = 'К сожалению, ник уже занят!';
                            nickok = false;

                        }
                        else {
                            $("#login_name").css("background-image","url(img/ok.png)");
							$("#uname_err").css("visibility", "hidden");
							$("#uname_err").css("height", "1px");
                            nickok = true;

                        }
                    }
                )
            }
            else {
                $(this).css("background-image", "url(img/err.png)");
				$("#uname_err").css("visibility", "visible");
				$("#uname_err").css("height", "40px");
                document.getElementById('uname_err').innerHTML = 'Слишком длинный ник!';
				nickok = false;
                res = false;
            }
        }
        else {
            $(this).css("background-image", "none");
            $("#uname_err").css("visibility", "hidden");
            $("#uname_err").css("height", "1px");
            res = false;
        }
        return res;
    };
})(jQuery);