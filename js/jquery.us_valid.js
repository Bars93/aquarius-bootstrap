(function ($) {
    jQuery.fn.us_valid = function() {
        var send_data = function() {
            var uid = $("#eu_uid").val();
            var uname = $("#eu_uname").val();
            var ufullname = $("#eu_fullname").val();
            var uemail = $("#eu_email").val();
            var rows = $("select#row_count option").filter(":selected").val();
            $.when($.ajax({
                method: "POST",
                type: "text",
                caching: false,
                url: "updateuser.php",
                data: {id: uid, name: uname, fname: ufullname, email: uemail, rpp: rows}
            })).then(function(resp) {
                    var eu = $("#eu_info");
                    if(eu) {
                        eu.remove();
                    }
                    var eui_art = document.createElement('article');
                    eui_art.className = 'eu_info'
                    eui_art.id = 'eu_info';
                    if(resp.indexOf("correct") == -1) {
                        eui_art.innerHTML = "<div class='errormsg'>Ошибка при отправке данных: "+ resp + "</div>"

                        $(eui_art).insertAfter("#edituser");
                    }
                    else {
                        $.when($.ajax({
                            type: "xml",
                            url: "getuserdata.php",
                            method: "POST",
                            data: {uid: uid},
                            caching: false
                        })).then(function(xmlResp){
                                var udata = $("userinfo", xmlResp).map(
                                    function () {
                                        return {
                                            user_id: $("user_id",this).text(),
                                            user_name: $("user_name",this).text(),
                                            full_name: $("full_name",this).text(),
                                            e_mail: $("e_mail",this).text(),
                                            avatar: $("avatar",this).text(),
                                            rows: $("rows",this).text(),
                                            regdate: $("regdate",this).text()
                                        };
                                    }
                                ).get();
                                udata = udata[0];
                                var su_art = document.createElement('article');
                                su_art.id = 'showuser';
                                su_art.className = 'showuser';
                                su_art.innerHTML = '<h1>Профиль пользователя</h1><table class="userinfo"><thead>'+
                                    '<tr><th colspan="2"><div class="nickname">' + udata.user_name + '</div>' +
                                    '<div class="fullname">' + udata.full_name + '</div></th></tr></thead>' +
                                    '<tbody><tr><td class="avatar"><img src="' + udata.avatar + '"></td><td>' +
                                    '<div class="headinfo">E-mail</div><div class="info">' + udata.e_mail +
                                    ' </div></td></tr><tr><td><small>' + udata.regdate + '</small></td><td>' +
                                    '<input type="button" class="editbtn" value="Редактировать" id="editbtn">' +
                                    '</td></tr></tbody></table>';
                                eui_art.innerHTML = "<div class='successmsg'>Данные успешно сохранены!</div>";
                                $(su_art).insertAfter("#edituser");
                                $("#edituser").remove();
                                $(eui_art).insertAfter("#showuser");
                                document.getElementsByClassName('login_nick')[0].innerHTML = udata.user_name+ ' (' + udata.full_name + ')';
                                $("#editbtn").usersettings(udata.user_id);
                            });
                    }
                });
        };
        $(this).click(function() {
            var check = nickok;
            check = check && $("#eu_email").emailvalid();
            if(check) {
                send_data();
            }
            else {
                alert('Заполните поля правильно!');
            }
        });
    };
})(jQuery);