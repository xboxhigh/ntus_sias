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
            resource: "/basicshoes",
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
                    DelCookie("isEdited", window.location.hostname);
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
        var form_data = {};

        $("body").find('input[type=text], input[type=checkbox], div[id$="-check"]').each(function () {
            var re = /-/gi;
            var e = /_/gi;

            var key = $(this).attr('id');
            var value = $(this).val();

            if (paramValidation(key)) {
                var key_of_value = key.replace(re, '_').replace('shoes_', '');
                var split_conut = key_of_value.split('_').length;

                if ($(this).is(':checkbox')) {
                    if (this.checked) {

                        form_data[key_of_value] = 1;
                    } else {
                        form_data[key_of_value] = 0;
                    }

                } else if ($(this).is('input:text')) {
                    if (key_of_value.split('_')[split_conut - 1] == "year") {
                        var key_of_month = key.replace('-year', '-month');
                        var value_of_month = $(`#${key_of_month}`).val();
                        var real_key = key_of_value.replace('_year', '')

                        form_data[real_key] =
                            paramValidation(value) ? parseInt(value * 12) : 0 +
                                paramValidation(value) ? parseInt(value_of_month) : 0;

                    } else {
                        if (key_of_value.split('_')[split_conut - 1] != "month") {
                            if (!isNaN(value)) {
                                if (paramValidation(value)) {
                                    form_data[key_of_value] = parseFloat(value);
                                } else {
                                    form_data[key_of_value] = 0;
                                }
                            } else {
                                if (paramValidation(value)) {
                                    form_data[key_of_value] = value;
                                } else {
                                    form_data[key_of_value] = "";
                                }
                            }
                        }
                    }
                } else {
                    if (key_of_value.split('_')[split_conut - 1] == "check") {
                        var input_names = "shoes-" + key_of_value.replace(e, '-').replace('-check', '')
                        var total_checkbox_num = $(`input[name='${input_names}']`).length;
                        var real_key = key_of_value.replace('_check', '')

                        $(`input[name='${input_names}']`).each(function (i) {
                            if (total_checkbox_num == 2) {
                                if (i == 0) {
                                    form_data[real_key] = 1;
                                } else {
                                    form_data[real_key] = 0;
                                }
                            } else {
                                if (this.checked) {
                                    form_data[real_key] = i + 1;
                                }
                            }
                        });
                    }
                }
            }
        });

        if (GetCookie("isEdited") == 1) {
            /** parameters for ajax process */
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/basicshoes",
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
                        location.href = "forms-3.html";
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
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/basicshoes",
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
                        location.href = "forms-3.html";
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

    $(".pagination > .page-item > .page-link.prev").click(function () {
        location.href = "forms-1.html";
    });

    $(".pagination > .page-item > .btn.btn-warning").click(function () {
        var form_data = {};

        $("body").find('input[type=text], input[type=checkbox], div[id$="-check"]').each(function () {
            var re = /-/gi;
            var e = /_/gi;

            var key = $(this).attr('id');
            var value = $(this).val();

            if (paramValidation(key)) {
                var key_of_value = key.replace(re, '_').replace('shoes_', '');
                var split_conut = key_of_value.split('_').length;

                if ($(this).is(':checkbox')) {
                    if (this.checked) {

                        form_data[key_of_value] = 1;
                    } else {
                        form_data[key_of_value] = 0;
                    }

                } else if ($(this).is('input:text')) {
                    if (key_of_value.split('_')[split_conut - 1] == "year") {
                        var key_of_month = key.replace('-year', '-month');
                        var value_of_month = $(`#${key_of_month}`).val();
                        var real_key = key_of_value.replace('_year', '')

                        form_data[real_key] =
                            paramValidation(value) ? parseInt(value * 12) : 0 +
                                paramValidation(value) ? parseInt(value_of_month) : 0;

                    } else {
                        if (key_of_value.split('_')[split_conut - 1] != "month") {
                            if (!isNaN(value)) {
                                if (paramValidation(value)) {
                                    form_data[key_of_value] = parseFloat(value);
                                } else {
                                    form_data[key_of_value] = 0;
                                }
                            } else {
                                if (paramValidation(value)) {
                                    form_data[key_of_value] = value;
                                } else {
                                    form_data[key_of_value] = "";
                                }
                            }
                        }
                    }
                } else {
                    if (key_of_value.split('_')[split_conut - 1] == "check") {
                        var input_names = "shoes-" + key_of_value.replace(e, '-').replace('-check', '')
                        var total_checkbox_num = $(`input[name='${input_names}']`).length;
                        var real_key = key_of_value.replace('_check', '')

                        $(`input[name='${input_names}']`).each(function (i) {
                            if (total_checkbox_num == 2) {
                                if (i == 0) {
                                    form_data[real_key] = 1;
                                } else {
                                    form_data[real_key] = 0;
                                }
                            } else {
                                if (this.checked) {
                                    form_data[real_key] = i + 1;
                                }
                            }
                        });
                    }
                }
            }
        });

        if (GetCookie("isEdited") == 1) {
            /** parameters for ajax process */
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/basicshoes",
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
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/basicshoes",
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
                    500: function (feedback, textStatus, jqXHR) {
                        alert("伺服器錯誤，請洽網站管理員！")
                    }
                }
            });
        }
    });

    $('div[id^="shoes"]').find("input[name^='shoes']").change(function () {
        var id = $(this)
            .parent()
            .parent()
            .attr("id");

        $("#" + id)
            .find("input[name^='shoes']")
            .not(this)
            .prop("checked", false);

        if (id == "shoes-brand-check") {
            var brand_name = $.trim($(this).parent().text());
            if (brand_name == "其他") {
                if (this.checked) {
                    $("#shoes-brand-other").show();
                } else {
                    $("#shoes-brand-other").hide();
                    $("#shoes-brand-other").val("");
                }
            } else {
                $("#shoes-brand-other").hide();
                $("#shoes-brand-other").val("");
            }
        }
    });
});

function _init() {
    $("body").find(':input').each(function () {
        $(this).val('');
    });
    $("#shoes-brand-other").hide();
    $("#shoes-brand-other").val("");
}

function fillOutForm(data_obj) {
    var re = /_/gi;

    $.each(data_obj, function (key, value) {
        var key_of_value = key.replace(re, '-');
        var prefix = "shoes";

        var check_selector = `#${prefix}-${key_of_value}-check`;
        if ($(check_selector).length) {

            var input_names = `${prefix}-${key_of_value}`;
            var checked_index = parseInt(value);
            var total_checkbox_num = $(`input[name='${input_names}']`).length;

            $(`input[name='${input_names}']`).each(function (i) {
                if (total_checkbox_num == 2) {
                    if (i != checked_index) {
                        $(this).prop("checked", true);
                    }
                } else {
                    if (i == (checked_index - 1)) {
                        $(this).prop("checked", true);
                    }
                    if (input_names == "shoes-brand") {
                        if (checked_index == total_checkbox_num) {
                            $("#shoes-brand-other").show();
                        }
                    }
                }
            });


        } else {
            var selector = `#${prefix}-${key_of_value}`;

            if (key_of_value == "aver-replace") {
                var year = value < 12 ? 0 : parseInt(value / 12);
                $("#shoes-aver-replace-year").val(year);
                var month = value < 12 ? value : (value % 12);
                $("#shoes-aver-replace-month").val(month);
            } else if (key_of_value.split("-")[0] == "worn") {
                if (value == 1)
                    $(selector).prop("checked", true);
            } else {
                $(selector).val(value);
            }
        }
    });
}