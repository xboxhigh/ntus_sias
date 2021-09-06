$(function () {
    $(document).ajaxStart(function () {
        $(".loading-mask").css("display", "block");
    });

    $(document).ajaxStop(function () {
        $(".loading-mask").css("display", "none");
    });

    _init();

    var _TOKEN = GetCookie("token");
    var _LAST_MODIFY = GetCookie("last_modify");
    var _USER_NAME = GetCookie("name");

    if (paramValidation(_USER_NAME)) {
        $("#name").val(_USER_NAME);
    }

    if (paramValidation(_LAST_MODIFY)) {
        SetCookie("isEdited", 1, 1, window.location.hostname);

        /** parameters for ajax process */
        var api_params = {
            baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
            api_ver: "v1",
            resource: "/users",
            action: `/${_LAST_MODIFY}`,
        }
        var target_api_link = api_params.baseUrl + api_params.api_ver + api_params.resource + api_params.action;

        $.ajax({
            url: target_api_link,
            headers: {
                'Authorization': `Bearer ${_TOKEN}`
            },
            type: "GET",
            dataType: "json",
            statusCode: {
                200: function (feedback, textStatus, jqXHR) {
                    fillOutForm(feedback);
                },
                401: function (feedback, textStatus, jqXHR) {
                    alert("無效的 TOKEN");
                    location.href = "/web";
                },
                404: function (feedback, textStatus, jqXHR) {
                    DelCookie("isEdited", window.location.hostname);
                },
                403: function (feedback, textStatus, jqXHR) {
                    alert("無權限");
                    location.href = "/web";
                },
                500: function (feedback, textStatus, jqXHR) {
                    alert("伺服器錯誤，請洽網站管理員！")
                }
            }
        });
    } else {
        DelCookie("isEdited", window.location.hostname);
    }

    $(".pagination > .page-item > .page-link.next").click(function () {
        var path_name_list = window.location.pathname.split("/");
        var current_page_num = path_name_list[path_name_list.length - 1].split(".")[0].split("-")[1];
        var total_page_num = 8;
        var page_remained = total_page_num - parseInt(current_page_num);
        var form_data = {};

        $("body").find(':input').each(function () {
            var re = /-/gi;
            var key = $(this).attr('id');
            var value = $(this).val();

            if (paramValidation(key)) {
                var key_of_value = key.replace(re, '_')
                if (key_of_value == "img_shldrlvl") {
                    if (this.checked) {
                        form_data[key_of_value] = 1;
                    } else {
                        form_data[key_of_value] = 0;
                    }
                } else {
                    if (!isNaN(value)) {
                        var toFloat = parseFloat(value);
                        form_data[key_of_value] = isNaN(toFloat) ? 0 : toFloat;
                    } else {
                        form_data[key_of_value] = value;
                    }
                }
            }
        });

        var day_of_birth = new Date($.trim($(("#day-of-birth")).find("input[type=text]").val()));
        var timeToUnix = ConvertToUTC(day_of_birth);
        form_data['day_of_birth'] = timeToUnix;
        form_data['gender'] = $("#gender").val() == null ? 0 : parseInt($("#gender").val());

        if (GetCookie("isEdited") == 1) {
            /** parameters for ajax process */
            var _TOKEN = GetCookie("token");
            var _LAST_MODIFY = GetCookie("last_modify");

            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/users",
                action: `/${_LAST_MODIFY}`,
            }
            var target_api_link = api_params.baseUrl + api_params.api_ver + api_params.resource + api_params.action;

            $.ajax({
                type: "PUT",
                url: target_api_link,
                dataType: "json",
                headers: {
                    'Authorization': `Bearer ${_TOKEN}`
                },
                data: form_data,
                statusCode: {
                    200: function (feedback, textStatus, jqXHR) {
                        alert("完成 " + current_page_num + " 頁，還有 " + page_remained.toString() + " 頁");
                        location.href = "forms-2.html";
                    },
                    400: function (feedback, textStatus, jqXHR) {
                        alert("資料填寫有誤")
                    },
                    401: function (feedback, textStatus, jqXHR) {
                        alert("TOKEN 失效")
                    },
                    403: function (feedback, textStatus, jqXHR) {
                        alert("禁止存取！")
                    },
                    404: function (feedback, textStatus, jqXHR) {
                        alert("找不到服務！")
                    },
                    500: function (feedback, textStatus, jqXHR) {
                        alert("伺服器錯誤，請洽網站管理員！")
                    }
                }
            });
        } else {
            /** parameters for ajax process */
            var _TOKEN = GetCookie("token");
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/users",
                action: "",
            }
            var target_api_link = api_params.baseUrl + api_params.api_ver + api_params.resource + api_params.action;
            $.ajax({
                type: "POST",
                url: target_api_link,
                dataType: "json",
                headers: {
                    'Authorization': `Bearer ${_TOKEN}`
                },
                data: form_data,
                statusCode: {
                    201: function (feedback, textStatus, jqXHR) {
                        SetCookie("last_modify", feedback.ubi_id, 1, window.location.hostname);
                        SetCookie("isEdited", 1, 1, window.location.hostname);
                        alert("完成 " + current_page_num + " 頁，還有 " + page_remained.toString() + " 頁");
                        location.href = "forms-2.html";
                    },
                    400: function (feedback, textStatus, jqXHR) {
                        alert("資料填寫有誤")
                    },
                    401: function (feedback, textStatus, jqXHR) {
                        alert("TOKEN 失效")
                    },
                    403: function (feedback, textStatus, jqXHR) {
                        alert("禁止存取！")
                    },
                    404: function (feedback, textStatus, jqXHR) {
                        alert("找不到服務！")
                    },
                    500: function (feedback, textStatus, jqXHR) {
                        alert("伺服器錯誤，請洽網站管理員！")
                    }
                }
            });
        }
    });

    $(".pagination > .page-item > .btn.btn-warning").click(function () {
        var form_data = {};

        $("body").find(':input').each(function () {
            var re = /-/gi;
            var key = $(this).attr('id');
            var value = $(this).val();

            if (paramValidation(key)) {
                var key_of_value = key.replace(re, '_')
                if (key_of_value == "img_shldrlvl") {
                    if (this.checked) {
                        form_data[key_of_value] = 1;
                    } else {
                        form_data[key_of_value] = 0;
                    }
                } else {
                    if (!isNaN(value)) {
                        var toFloat = parseFloat(value);
                        form_data[key_of_value] = isNaN(toFloat) ? 0 : toFloat;
                    } else {
                        form_data[key_of_value] = value;
                    }
                }
            }
        });

        var day_of_birth = new Date($.trim($(("#day-of-birth")).find("input[type=text]").val()));
        var timeToUnix = ConvertToUTC(day_of_birth);
        form_data['day_of_birth'] = timeToUnix;
        form_data['gender'] = $("#gender").val() == null ? 0 : parseInt($("#gender").val());

        if (GetCookie("isEdited") == 1) {
            /** parameters for ajax process */
            var _TOKEN = GetCookie("token");
            var _LAST_MODIFY = GetCookie("last_modify");

            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/users",
                action: `/${_LAST_MODIFY}`,
            }
            var target_api_link = api_params.baseUrl + api_params.api_ver + api_params.resource + api_params.action;

            $.ajax({
                type: "PUT",
                url: target_api_link,
                dataType: "json",
                headers: {
                    'Authorization': `Bearer ${_TOKEN}`
                },
                data: form_data,
                statusCode: {
                    200: function (feedback, textStatus, jqXHR) {
                        alert("本頁已保存成功");
                        location.reload();
                    },
                    400: function (feedback, textStatus, jqXHR) {
                        alert("資料填寫有誤")
                    },
                    401: function (feedback, textStatus, jqXHR) {
                        alert("TOKEN 失效")
                    },
                    403: function (feedback, textStatus, jqXHR) {
                        alert("禁止存取！")
                    },
                    404: function (feedback, textStatus, jqXHR) {
                        alert("找不到服務！")
                    },
                    500: function (feedback, textStatus, jqXHR) {
                        alert("伺服器錯誤，請洽網站管理員！")
                    }
                }
            });
        } else {
            /** parameters for ajax process */
            var _TOKEN = GetCookie("token");
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/users",
                action: "",
            }
            var target_api_link = api_params.baseUrl + api_params.api_ver + api_params.resource + api_params.action;
            $.ajax({
                type: "POST",
                url: target_api_link,
                dataType: "json",
                headers: {
                    'Authorization': `Bearer ${_TOKEN}`
                },
                data: form_data,
                statusCode: {
                    201: function (feedback, textStatus, jqXHR) {
                        alert("本頁已保存成功");
                        location.reload();
                    },
                    400: function (feedback, textStatus, jqXHR) {
                        alert("資料填寫有誤")
                    },
                    401: function (feedback, textStatus, jqXHR) {
                        alert("TOKEN 失效")
                    },
                    403: function (feedback, textStatus, jqXHR) {
                        alert("禁止存取！")
                    },
                    404: function (feedback, textStatus, jqXHR) {
                        alert("找不到服務！")
                    },
                    500: function (feedback, textStatus, jqXHR) {
                        alert("伺服器錯誤，請洽網站管理員！")
                    }
                }
            });
        }

    });
});

function _init() {
    $("body").find(':input').each(function () {
        $(this).val('');
    });

    $("#day-of-birth").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        language: "zh-TW"
    });
    var today = new Date();
    $("#created-at").text(today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate());
}

function fillOutForm(data_obj) {
    var re = /_/gi;
    $.each(data_obj, function (key, value) {
        var key_of_value = key.replace(re, '-');
        var selector = `#${key_of_value}`;

        if (key_of_value == "day-of-birth") {
            $(selector).find("input[type=text]").val(ConvertUnixTimeToLocalDate(value));
        } else if (key_of_value == "img-shldrlvl") {
            if (value == 1) {
                $(selector).prop("checked", true);
            }
        } else if (key_of_value == "created-at") {
            $(selector).text(ConvertUnixTimeToLocalDate(value));
        } else {
            $(selector).val(value);
        }
    });
}