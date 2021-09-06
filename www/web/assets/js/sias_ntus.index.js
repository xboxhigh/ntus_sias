$(function () {

    $('button[type="submit"]').click(function (e) {
        e.preventDefault();
        if ($('button[type="submit"]').text() == "資料確認") {
            var line_id = $("input[name=line_id]").val();
            var user_name = $("input[name=user_name]").val();
            var contact_no = $("input[name=contact_no]").val();
            //little validation just to check username
            if (line_id != "" && user_name != "" && contact_no != "") {
                var post_data = {};
                post_data.data = {
                    line_id: line_id,
                    name: user_name,
                    contact_no: contact_no
                };

                post_data.expire_days = 1;
                /** parameters for ajax process */
                var api_params = {
                    baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                    api_ver: "v1",
                    resource: "/users",
                    action: "/signin",
                }
                var target_api_link = api_params.baseUrl + api_params.api_ver + api_params.resource + api_params.action;
                $.ajax({
                    type: "POST",
                    url: target_api_link,
                    dataType: "json",
                    data: post_data.data,
                    statusCode: {
                        201: function (feedback, textStatus, jqXHR) {
                            SetCookie("token", feedback.token, post_data.expire_days, window.location.hostname);
                            SetCookie("name", feedback.name, post_data.expire_days, window.location.hostname);
                            if (paramValidation(feedback.last_modify))
                                SetCookie("last_modify", feedback.last_modify, post_data.expire_days, window.location.hostname);
                            else
                                DelCookie("last_modify", window.location.hostname);

                            $("#output").addClass("alert alert-success animated fadeInUp").html(
                                "歡迎 "
                                + "<span style='text-transform:uppercase'>"
                                + user_name
                                + "</span> 請點擊「開始填寫」按鈕"
                            );
                            $("#output").removeClass("alert-danger");
                            $("input").css({
                                height: "0",
                                padding: "0",
                                margin: "0",
                                opacity: "0"
                            });

                            //change button text
                            $('button[type="submit"]').html("開始填寫").removeClass("btn-info").addClass("btn-warning")
                                .click(function () {
                                    $("input").css({
                                        height: "auto",
                                        padding: "10px",
                                        opacity: "1"
                                    }).val("");
                                    location.href = "forms-1.html";
                                });
                            // if current login user has finish at least one test, then add button next to 'submit'
                            $('button[type="submit"]').after('<button class="btn btn-success btn-block jump" type="button"> 運動傷害病史與紀錄填寫</button>');
                            $('.btn-block.jump').click(function () {
                                location.href = "fifth-sec-fillup.html";
                            });
                        },
                        400: function (feedback, textStatus, jqXHR) {
                            //remove success mesage replaced with error message
                            $("#output").removeClass(" alert alert-success");
                            $("#output").addClass("alert alert-danger animated fadeInUp").html("資料填寫有誤");
                        },
                        401: function (feedback, textStatus, jqXHR) {
                            //remove success mesage replaced with error message
                            $("#output").removeClass(" alert alert-success");
                            $("#output").addClass("alert alert-danger animated fadeInUp").html("無效的 TOKEN");
                        },
                        500: function (feedback, textStatus, jqXHR) {
                            //remove success mesage replaced with error message
                            $("#output").removeClass(" alert alert-success");
                            $("#output").addClass("alert alert-danger animated fadeInUp").html("伺服器錯誤，請洽網站管理員");
                        }
                    }
                });
            } else {
                //remove success mesage replaced with error message
                $("#output").removeClass(" alert alert-success");
                $("#output").addClass("alert alert-danger animated fadeInUp").html("LIND ID、姓名、聯絡電話為必填");
            }
        }
    });
});
