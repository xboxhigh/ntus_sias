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

    if (paramValidation(_LAST_MODIFY)) {
        SetCookie("isEdited", 1, 1, window.location.hostname);
        // parameters for ajax process 
        var api_params = {
            baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
            api_ver: "v1",
            resource: "/psycho",
            action: "/" + _LAST_MODIFY,
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
                204: function (feedback, textStatus, jqXHR) {
                    DelCookie("isEdited", window.location.hostname);
                },
                401: function (feedback, textStatus, jqXHR) {
                    alert("無效的 TOKEN");
                    location.href = "/web";
                },
                403: function (feedback, textStatus, jqXHR) {
                    alert("無權限");
                    location.href = "/web";
                },
                404: function (feedback, textStatus, jqXHR) {
                    alert("基本身體資訊尚未填寫，將跳回第一頁");
                    location.href = "forms-1.html";
                },
                500: function (feedback, textStatus, jqXHR) {
                    alert("伺服器錯誤，請洽網站管理員！")
                }
            }
        });
    }

    $(".pagination > .page-item > .page-link.next").click(function () {
        var path_name_list = window.location.pathname.split("/");
        var current_page_num = path_name_list[path_name_list.length - 1].split(".")[0].split("-")[1];
        var total_page_num = 8;
        var page_remained = total_page_num - parseInt(current_page_num);
        var form_data = {
            "scale_results": []
        };

        $("body").find('div[id^="scale-results"]').each(function () {
            var re = /-/gi;
            var key = $(this).attr('id');

            if (paramValidation(key)) {
                var input_names = key.split("-")[0] + "-" + key.split("-")[1];
                var real_key = input_names.replace(re, "_");
                var isChecked = 0;

                $(this).find(`input[name='${input_names}']`).each(function (i) {
                    if (this.checked) {
                        var value = i + 1;
                        form_data[real_key].push(value);
                        isChecked = 1;
                    }
                    if (i == 4 && isChecked == 0) {
                        form_data[real_key].push(0);
                    }
                });
            }
        });
        $.each(form_data, function (key, number) {
            form_data[key] = form_data[key].join(",");
        });

        if (GetCookie("isEdited") == 1) {
            /** parameters for ajax process */
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/psycho",
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
                        location.href = "forms-8.html";
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
                    409: function (feedback, textStatus, jqXHR) {
                        alert("答案數量與題目不符！")
                    },
                    500: function (feedback, textStatus, jqXHR) {
                        alert("伺服器錯誤，請洽網站管理員！")
                    }
                }
            });
        } else {
            /** parameters for ajax process */
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/psycho",
                action: `/${_LAST_MODIFY}`,
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
                        alert("完成 " + current_page_num + " 頁，還有 " + page_remained.toString() + " 頁");
                        location.href = "forms-8.html";
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
                    409: function (feedback, textStatus, jqXHR) {
                        alert("答案數量與題目不符！")
                    },
                    500: function (feedback, textStatus, jqXHR) {
                        alert("伺服器錯誤，請洽網站管理員！")
                    }
                }
            });
        }
    });

    $(".pagination > .page-item > .page-link.prev").click(function () {
        location.href = "forms-6.html";
    });

    $(".pagination > .page-item > .btn.btn-warning").click(function () {
        var form_data = {
            "scale_results": []
        };

        $("body").find('div[id^="scale-results"]').each(function () {
            var re = /-/gi;
            var key = $(this).attr('id');

            if (paramValidation(key)) {
                var input_names = key.split("-")[0] + "-" + key.split("-")[1];
                var real_key = input_names.replace(re, "_");
                var isChecked = 0;

                $(this).find(`input[name='${input_names}']`).each(function (i) {
                    if (this.checked) {
                        var value = i + 1;
                        form_data[real_key].push(value);
                        isChecked = 1;
                    }
                    if (i == 4 && isChecked == 0) {
                        form_data[real_key].push(0);
                    }
                });
            }
        });
        $.each(form_data, function (key, number) {
            form_data[key] = form_data[key].join(",");
        });

        if (GetCookie("isEdited") == 1) {
            /** parameters for ajax process */
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/psycho",
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
                    409: function (feedback, textStatus, jqXHR) {
                        alert("答案數量與題目不符！")
                    },
                    500: function (feedback, textStatus, jqXHR) {
                        alert("伺服器錯誤，請洽網站管理員！")
                    }
                }
            });
        } else {
            /** parameters for ajax process */
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/psycho",
                action: `/${_LAST_MODIFY}`,
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
                    409: function (feedback, textStatus, jqXHR) {
                        alert("答案數量與題目不符！")
                    },
                    500: function (feedback, textStatus, jqXHR) {
                        alert("伺服器錯誤，請洽網站管理員！")
                    }
                }
            });
        }
    });

    $('div[id^="scale-results"]')
        .find("input[name='scale-results']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name='scale-results']")
                .not(this)
                .prop("checked", false);
        });
});

function _init() {
    $("body").find(':input').each(function () {
        $(this).val('');
    });

    $("#shoes-brand-other").hide();
    $("#at-plan-other").hide();
    $("#treat-plan-other").hide();
    $("#diagnosis-code-other").hide();
    $("#injured-code-mid-other").hide();

    $("#injured-code-mid-other").prop("checked", false);

    $("#day-of-birth").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        language: "zh-TW"
    });
}

function fillOutForm(data_obj) {
    var re = /_/gi;

    $.each(data_obj, function (key, value) {
        var key_of_value = key.replace(re, '-');

        if (key_of_value.includes("scale-results")) {
            var question_num_count = 0;

            $.each(value.split(","), function (key, number) {
                question_num_count += 1;
                var selector = `#${key_of_value}-${question_num_count}`;
                var input_names = `${key_of_value}`;
                var checked_index = parseInt(number);

                $(selector).find(`input[name='${input_names}']`).each(function (i) {
                    if (i == checked_index - 1) {
                        $(this).prop("checked", true);
                    }
                });
            });
        }
    });
}