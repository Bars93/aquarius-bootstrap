(function ($) {
    jQuery.fn.usersettings = function (user_id) {
        var get_data = function () {
            $.when($.ajax({
                    type: "POST",
                    dataType: "xml",
                    url: "getuserdata.php",
                    data: {uid: user_id},
                    caching: false
                })
                ).then(
                function (xmlResp) {
                    var err = $("error", xmlResp).map(function () {
                        return {
                            text: $("text", this).text()
                        };
                    }).get();
                    err = err[0].text;
                    if (err == "no") {
                        $("#error").innerHTML = "";
                        $("#error").attr("visibility", "hidden");
                        var userdata = $("userinfo", xmlResp).map(
                            function () {
                                return {
                                    user_id: $("user_id",this).text(),
                                    user_name: $("user_name",this).text(),
                                    full_name: $("full_name",this).text(),
                                    e_mail: $("e_mail",this).text(),
                                    avatar: $("avatar",this).text(),
                                    rows: $("rows",this).text(),
                                    regdata: $("regdate",this).text()
                                };
                            }
                        ).get();
                        userdata = userdata[0];
                        var eu_art = document.createElement("article");
                        eu_art.className = "edituser";
                        eu_art.id = "edituser";
                        eu_art.innerHTML = '<h1>Редактирование пользователя</h1><div class="eu_form">' +
                            '<input type="hidden" value="'+ userdata.user_id + '" id="eu_uid"><label for="eu_uname">Имя пользователя</label><br>' +
                            '<input type="text" class="eu_uname" id="eu_uname" value="'+ userdata.user_name+'">' +
							'<div id="uname_err" class="error">Ник не должен быть длиннее 25 символов</div>'+
                            '<br><label for="eu_fullname">Полное имя</label><br><input type="text" class="eu_fullname" id="eu_fullname" value="'+ userdata.full_name +'"><br>' +
                            '<label for="eu_email">E-mail</label><br><input type="text" class="eu_email" id="eu_email" value="'+userdata.e_mail+'"><br>' +
							'<div id="uemail_err" class="error">Введите e-mail правильно, например \'asm@mail.ru\'</div><br>' +
                            '<!--<img src="'+userdata.avatar+'" id="eu_avatar_old"><input type="image" class="eu_avatar" id="eu_avatar"><br>-->' +
                            '<label for="row_count">Количество задач на странице</label><br><select id="row_count">' +
                            '<option value="1">1</option>' +
                            '<option value="3">3</option>' +
                            '<option value="5">5</option>' +
                            '<option value="7">7</option>' +
                            '<option value="10">10</option>' +
                            '<option value="15">15</option>' +
                            '<option value="20">20</option></select>'+
                            '<br><input type="button" value="Отправить!" id="sendbtn"></div>';
                        $(eu_art).insertAfter("#showuser");
                        $("#editbtn").css("visibility","hidden");
                        $("#row_count").val(userdata.rows);
                        $("#sendbtn").us_valid();
                        $("#eu_email").emailvalid();
                        $("#eu_uname").us_nickvalid();
                        $("#eu_email").keyup(function () {
                            $(this).emailvalid();
                        }).blur(function () {
                                $(this).emailvalid();
                            });
                        $("#eu_uname").typing({
                            stop:function(event,$elem) {
                                $elem.us_nickvalid();
                            },
                            delay: 300
                        });
                        $("#showuser").remove();
                    }
                    else {
                        $("#error").innerHTML = "";
                        $(err).appendTo("#error");
                        $("#error").attr("visibility", "visible");
                    }
                }
            );
        };
        $(this).click(function(){
            var eu = $("#eu_info");
            if(eu) {
                eu.remove();
            }
            get_data();
        });
    };
})(jQuery);