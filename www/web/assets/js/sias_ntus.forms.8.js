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
        // parameters for ajax process 
        var api_params = {
            baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
            api_ver: "v1",
            resource: "/extra",
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
        var form_data = {};

        if (paramValidation($(("#date")).find("input[type=text]").val())) {
            var day_of_birth = new Date($.trim($(("#date")).find("input[type=text]").val()));
            var timeToUnix = ConvertToUTC(day_of_birth);
            form_data['date'] = timeToUnix;
        } else {
            form_data['date'] = "";
        }
        form_data['gender'] = $("#gender").val() == null ? 0 : parseInt($("#gender").val());
        form_data['schl'] = $("#schl").val() == null ? 0 : $("#schl").val();
        form_data['grade'] = $("#grade").val() == null ? 0 : parseInt($("#grade").val());
        form_data['spt'] = $("#spt").val() == null ? 0 : $.trim($("#spt").val());

        $("body").find('input[type=text], input[type=number]').each(function () {
            var re = /-/gi;
            var key = $(this).attr('id');
            var value = $(this).val();

            if (paramValidation(key)) {
                var real_key = key.replace(re, "_");

                if (paramValidation(value)) {
                    if (!isNaN(value)) {
                        form_data[real_key] = parseFloat(value);
                    } else {
                        form_data[real_key] = $.trim(value);
                    }
                } else {
                    form_data[real_key] = "";
                }
            }
        });

        $("body").find('div[id$="-check"]').each(function () {
            var re = /-/gi;
            var key = $(this).attr('id');

            if (paramValidation(key)) {
                var input_names = key.replace('-check', '');
                var real_key = input_names.replace(re, "_");

                if (input_names == "is-injured-6month") {
                    $(this).find(`input[name='${input_names}']`).each(function (i) {
                        if (this.checked) {
                            if (i == 0)
                                form_data[real_key] = 1;
                            else
                                form_data[real_key] = 0;
                        }
                    });
                } else {
                    $(this).find(`input[name='${input_names}']`).each(function (i) {
                        if (this.checked) {
                            form_data[real_key] = i + 1;
                        }
                    });
                }
            }
        });

        if (GetCookie("isEdited") == 1) {
            /** parameters for ajax process */
            var api_params = {
                baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                api_ver: "v1",
                resource: "/extra",
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

                        DelCookie("token", window.location.hostname);
                        DelCookie("name", window.location.hostname);
                        DelCookie("last_modify", window.location.hostname);
                        DelCookie("isEdited", window.location.hostname);
                        alert("測驗完成！");
                        location.href = "index.html";
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
                resource: "/extra",
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
                        alert("測驗完成！");
                        location.href = "index.html";
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
        location.href = "forms-7.html";
    });


    $('div[id="is-injured-6month-check"]')
        .find("input[name='is-injured-6month']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name='is-injured-6month']")
                .not(this)
                .prop("checked", false);
        });
    $('div[id="injured-side-check"]')
        .find("input[name='injured-side']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name='injured-side']")
                .not(this)
                .prop("checked", false);

            var other_tag = $.trim(
                $(this)
                    .parent()
                    .text()
            );
            if (other_tag == "其他") {
                if (this.checked) {
                    $("#injured-side-other").show();
                } else {
                    $("#injured-side-other").hide();
                    $("#injured-side-other").val("");
                }
            } else {
                $("#injured-side-other").hide();
                $("#injured-side-other").val("");
            }
        });
    $('div[id="injured-part-check"]')
        .find("input[name='injured-part']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name='injured-part']")
                .not(this)
                .prop("checked", false);

            var other_tag = $.trim(
                $(this)
                    .parent()
                    .text()
            );
            if (other_tag == "其他") {
                if (this.checked) {
                    $("#injured-part-other").show();
                } else {
                    $("#injured-part-other").hide();
                    $("#injured-part-other").val("");
                }
            } else {
                $("#injured-part-other").hide();
                $("#injured-part-other").val("");
            }
        });

    $('div[id="diagnosis-check"]')
        .find("input[name='diagnosis']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name='diagnosis']")
                .not(this)
                .prop("checked", false);

            var other_tag = $.trim(
                $(this)
                    .parent()
                    .text()
            );
            if (other_tag == "其他") {
                if (this.checked) {
                    $("#diagnosis-other").show();
                } else {
                    $("#diagnosis-other").hide();
                    $("#diagnosis-other").val("");
                }
            } else {
                $("#diagnosis-other").hide();
                $("#diagnosis-other").val("");
            }
        });

    $('div[id="event-check"]')
        .find("input[name='event']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name='event']")
                .not(this)
                .prop("checked", false);

            var other_tag = $.trim(
                $(this)
                    .parent()
                    .text()
            );
            if (other_tag == "其他") {
                if (this.checked) {
                    $("#event-other").show();
                } else {
                    $("#event-other").hide();
                    $("#event-other").val("");
                }
            } else {
                $("#event-other").hide();
                $("#event-other").val("");
            }
        });
});

function _init() {
    $("body").find(':input').each(function () {
        $(this).val('');
    });

    $("body").find('select option').eq(0).each(function () {
        $(this).prop("selected", true);
    });

    $("#date").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        language: "zh-TW"
    });

    $("#injured-side-other").hide();
    $("#injured-side-other").prev().prev().prop("checked", false);
    $("#injured-part-other").hide();
    $("#injured-part-other").prev().prev().prop("checked", false);
    $("#diagnosis-other").hide();
    $("#diagnosis-other").prev().prev().prop("checked", false);
    $("#event-other").hide();
    $("#event-other").prev().prev().prop("checked", false);
}

function fillOutForm(data_obj) {
    var re = /_/gi;
    var checkbox_attributes = ["injured_side_other", "injured_part_other", "diagnosis_other", "event_other"];

    $.each(data_obj, function (key, value) {
        var key_of_value = key.replace(re, '-');
        var selector = `#${key_of_value}`;

        if (key_of_value == "date") {
            $(selector).find("input[type=text]").val(ConvertUnixTimeToLocalDate(value));
        } else if (key_of_value == "is-injured-6month") {
            var checkbox_index = value == 0 ? 1 : 0;
            $(`div[id^="${key_of_value}"]`).find(`input[name='${key_of_value}']`).eq(checkbox_index).prop("checked", true);
        } else {
            $(selector).val(value);
        }
    });

    $.each(checkbox_attributes, function (key, value) {
        var key_of_value = value.replace(re, '-');
        var selector = `#${key_of_value}`;
        var input_name = key_of_value.replace("-other", "");

        if (paramValidation(data_obj[value])) {
            $(selector).val(data_obj[value]);
            $(selector).prev().prev().prop("checked", true);
            $(selector).show();
        } else {
            var r = /-/gi;
            var data_index = input_name.replace(r, '_');
            $(`div[id^="${input_name}"]`).find(`input[name='${input_name}']`).eq(data_obj[data_index] - 1).prop("checked", true);
        }

    })
}