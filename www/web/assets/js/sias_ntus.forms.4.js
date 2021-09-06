$(function () {
    $(document).ajaxStart(function () {
        $(".loading-mask").css("display", "block");
    });

    $(document).ajaxStop(function () {
        $(".loading-mask").css("display", "none");
    });

    var _TOKEN = GetCookie("token");
    var _LAST_MODIFY = GetCookie("last_modify");

    _init(_TOKEN, _LAST_MODIFY);

    if (paramValidation(_LAST_MODIFY)) {
        SetCookie("isEdited", 1, 1, window.location.hostname);
        /** parameters for ajax process */
        var api_params = {
            baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
            api_ver: "v1",
            resource: "/medicals",
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
            "event_1": []
        };

        $("body").find('div[id$="-check"]').each(function () {
            var key = $(this).attr('id');

            if (paramValidation(key)) {
                if (key == "injured-code-beg-check") {
                    $(this).find("input[name='injured-code-beg']").each(function (i) {
                        if (this.checked) {
                            var text = $.trim($(this).parent().text());
                            form_data["event_1"].push(text);
                        }
                    });
                } else if (key == "injured-code-mid-check") {
                    var injured_code_other = $.trim($("#injured-code-mid-other").val());

                    if (paramValidation(injured_code_other)) {
                        form_data["event_1_other"] = injured_code_other;
                    }
                    $(this).find("input[name='injured-code-mid']").each(function (i) {
                        if (this.checked) {
                            var text = $.trim($(this).parent().text());
                            form_data["event_1"].push(text);
                        }
                    });

                } else if (key == "injured-code-end-check") {
                    $(this).find("input[name='injured-code-end']").each(function (i) {
                        if (this.checked) {
                            var text = $.trim($(this).parent().text());
                            form_data["event_1"].push(text);
                        }
                    });

                } else if (key == "diagnosis-code-check") {
                    var diagnos_code_other = $.trim($("#diagnosis-code-other").val());

                    if (paramValidation(diagnos_code_other)) {
                        form_data["diagnosis_1_other"] = diagnos_code_other;
                    }
                    $(this).find("input[name='diagnosis-code']").each(function (i) {
                        if (this.checked) {
                            var text = $.trim($(this).parent().text());
                            form_data["diagnosis_1"] = text;
                        }
                    });

                } else if (key == "at-plan-check") {
                    var at_plan_other = $.trim($("#at-plan-other").val());

                    if (paramValidation(at_plan_other)) {
                        form_data["at_plan_other"] = at_plan_other;
                        form_data["at_plan"] = "其他";
                    } else {
                        $(this).find("input[name='at-plan']").each(function (i) {
                            if (this.checked) {
                                var text = $.trim($(this).parent().text());
                                form_data["at_plan"] = text;
                            }
                        });
                    }
                } else if (key == "treat-plan-check") {
                    var treatment_other = $.trim($("#treat-plan-other").val());

                    if (paramValidation(treatment_other)) {
                        form_data["treatment_other"] = treatment_other;
                        form_data["treatment"] = "其他";
                    } else {
                        $(this).find("input[name='treat-plan']").each(function (i) {
                            if (this.checked) {
                                var text = $.trim($(this).parent().text());
                                form_data["treatment"] = text;
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
                resource: "/medicals",
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
                        location.href = "forms-5.html";
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
                resource: "/medicals",
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
                        location.href = "forms-5.html";
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
        location.href = "forms-3.html";
    });

    $(".pagination > .page-item > .btn.btn-warning").click(function () {
        var form_data = {
            "event_1": []
        };

        $("body").find('div[id$="-check"]').each(function () {
            var key = $(this).attr('id');

            if (paramValidation(key)) {
                if (key == "injured-code-beg-check") {
                    $(this).find("input[name='injured-code-beg']").each(function (i) {
                        if (this.checked) {
                            var text = $.trim($(this).parent().text());
                            form_data["event_1"].push(text);
                        }
                    });
                } else if (key == "injured-code-mid-check") {
                    var injured_code_other = $.trim($("#injured-code-mid-other").val());

                    if (paramValidation(injured_code_other)) {
                        form_data["event_1_other"] = injured_code_other;
                    }
                    $(this).find("input[name='injured-code-mid']").each(function (i) {
                        if (this.checked) {
                            var text = $.trim($(this).parent().text());
                            form_data["event_1"].push(text);
                        }
                    });

                } else if (key == "injured-code-end-check") {
                    $(this).find("input[name='injured-code-end']").each(function (i) {
                        if (this.checked) {
                            var text = $.trim($(this).parent().text());
                            form_data["event_1"].push(text);
                        }
                    });

                } else if (key == "diagnosis-code-check") {
                    var diagnos_code_other = $.trim($("#diagnosis-code-other").val());

                    if (paramValidation(diagnos_code_other)) {
                        form_data["diagnosis_1_other"] = diagnos_code_other;
                    }
                    $(this).find("input[name='diagnosis-code']").each(function (i) {
                        if (this.checked) {
                            var text = $.trim($(this).parent().text());
                            form_data["diagnosis_1"] = text;
                        }
                    });

                } else if (key == "at-plan-check") {
                    var at_plan_other = $.trim($("#at-plan-other").val());

                    if (paramValidation(at_plan_other)) {
                        form_data["at_plan_other"] = at_plan_other;
                        form_data["at_plan"] = "其他";
                    } else {
                        $(this).find("input[name='at-plan']").each(function (i) {
                            if (this.checked) {
                                var text = $.trim($(this).parent().text());
                                form_data["at_plan"] = text;
                            }
                        });
                    }
                } else if (key == "treat-plan-check") {
                    var treatment_other = $.trim($("#treat-plan-other").val());

                    if (paramValidation(treatment_other)) {
                        form_data["treatment_other"] = treatment_other;
                        form_data["treatment"] = "其他";
                    } else {
                        $(this).find("input[name='treat-plan']").each(function (i) {
                            if (this.checked) {
                                var text = $.trim($(this).parent().text());
                                form_data["treatment"] = text;
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
                resource: "/medicals",
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
                resource: "/medicals",
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

    $('div[id^="injured-code"]')
        .find("input[name^='injured-code']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name^='injured-code']")
                .not(this)
                .prop("checked", false);
        });

    $('div[id^="injured-code-mid"]')
        .find("input[name^='injured-code-mid']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name^='injured-code-mid']")
                .not(this)
                .prop("checked", false);

            if (id == "injured-code-mid-check") {
                var injured_name = $.trim(
                    $(this)
                        .parent()
                        .text()
                );
                if (injured_name == "其他部位") {
                    if (this.checked) {
                        $("#injured-code-mid-other").show();
                    } else {
                        $("#injured-code-mid-other").hide();
                        $("#injured-code-mid-other").val("");
                    }
                } else {
                    $("#injured-code-mid-other").hide();
                    $("#injured-code-mid-other").val("");
                }
            }
        });

    $('div[id="diagnosis-code-check"]')
        .find("input[name='diagnosis-code']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name='diagnosis-code']")
                .not(this)
                .prop("checked", false);

            if (id == "diagnosis-code-check") {
                var diagnosis_name = $.trim(
                    $(this)
                        .parent()
                        .text()
                );
                if (diagnosis_name == "其他部位") {
                    if (this.checked) {
                        $("#diagnosis-code-other").show();
                    } else {
                        $("#diagnosis-code-other").hide();
                        $("#diagnosis-code-other").val("");
                    }
                } else {
                    $("#diagnosis-code-other").hide();
                    $("#diagnosis-code-other").val("");
                }
            }
        });

    $('div[id^="at-plan"]')
        .find("input[name^='at-plan']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name^='at-plan']")
                .not(this)
                .prop("checked", false);

            if (id == "at-plan-check") {
                var plan_name = $.trim(
                    $(this)
                        .parent()
                        .text()
                );
                if (plan_name == "其他") {
                    if (this.checked) {
                        $("#at-plan-other").show();
                    } else {
                        $("#at-plan-other").hide();
                        $("#at-plan-other").val("");
                    }
                } else {
                    $("#at-plan-other").hide();
                    $("#at-plan-other").val("");
                }
            }
        });

    $('div[id^="treat-plan"]')
        .find("input[name^='treat-plan']")
        .change(function () {
            var id = $(this)
                .parent()
                .parent()
                .attr("id");
            $("#" + id)
                .find("input[name^='treat-plan']")
                .not(this)
                .prop("checked", false);

            if (id == "treat-plan-check") {
                var plan_name = $.trim(
                    $(this)
                        .parent()
                        .text()
                );
                if (plan_name == "其他") {
                    if (this.checked) {
                        $("#treat-plan-other").show();
                    } else {
                        $("#treat-plan-other").hide();
                        $("#treat-plan-other").val("");
                    }
                } else {
                    $("#treat-plan-other").hide();
                    $("#treat-plan-other").val("");
                }
            }
        });
});
function _init(_TOKEN, _LAST_MODIFY) {

    $("#shoes-brand-other").hide();
    $("#shoes-brand-other").prev().prev().prop("checked", false);
    $("#at-plan-other").hide();
    $("#at-plan-other").prev().prev().prop("checked", false);
    $("#treat-plan-other").hide();
    $("#treat-plan-other").prev().prev().prop("checked", false);
    $("#diagnosis-code-other").hide();
    $("#diagnosis-code-other").prev().prev().prop("checked", false);
    $("#injured-code-mid-other").hide();
    $("#injured-code-mid-other").prev().prev().prop("checked", false);

}

function fillOutForm(data_obj) {
    var injured_code_other = data_obj['event_1_other'];
    var diagnos_code_other = data_obj['diagnosis_1_other'];
    var at_plan_other = data_obj['at_plan_other'];
    var treatment_other = data_obj['treatment_other'];

    var injured_code_beg = data_obj['event_1'][0];
    var injured_code_mid = data_obj['event_1'][1];
    var injured_code_end = data_obj['event_1'][2];
    var diagnos_code = data_obj['diagnosis_1'];

    var at_plan_filter = ["運動按摩", "拉筋", "冷熱敷", "衛教", "貼紮防護", "建議轉介醫院或診所", "無", "其他"];
    var treatment_filter = ["醫院或診所接受復健或其它保守治療介入", "國術館或民俗療法", "無接受任何方式處理", "手術治療", "其他"];

    $("#injured-code-beg-check").find("input[name^='injured-code']").each(function () {
        var text = $.trim($(this).parent().text());
        if (text == injured_code_beg) {
            $(this).prop("checked", true);
        }
    });

    if (paramValidation(injured_code_other)) {
        $("#injured-code-mid-other").val(injured_code_other);
        $("#injured-code-mid-other").prev().prev().prop("checked", true);
        $("#injured-code-mid-other").show();
    } else {
        $("#injured-code-mid-check").find("input[name^='injured-code']").each(function () {
            var text = $.trim($(this).parent().text());
            if (text == injured_code_mid) {
                $(this).prop("checked", true);
            }
        });
    }

    $("#injured-code-end-check").find("input[name^='injured-code']").each(function () {
        var text = $.trim($(this).parent().text());
        if (text == injured_code_end) {
            $(this).prop("checked", true);
        }
    });

    if (paramValidation(diagnos_code_other)) {
        $("#diagnosis-code-other").val(diagnos_code_other);
        $("#diagnosis-code-other").prev().prev().prop("checked", true);
        $("#diagnosis-code-other").show();
    } else {
        $("#diagnosis-code-check").find("input[name='diagnosis-code']").each(function () {
            var text = $.trim($(this).parent().text());
            if (text == diagnos_code) {
                $(this).prop("checked", true);
            }
        });
    }

    if (paramValidation(at_plan_other)) {
        $("#at-plan-other").val(at_plan_other);
        $("#at-plan-other").prev().prev().prop("checked", true);
        $("#at-plan-other").show();
    } else {
        $.each([
            data_obj['at_plan_1'], data_obj['at_plan_2'], data_obj['at_plan_3'], data_obj['at_plan_4'], data_obj['at_plan_5'], data_obj['at_plan_6'], data_obj['at_plan_7'], data_obj['at_plan_8']], function (i, value) {

                if (value == 1)
                    at_plan_match = at_plan_filter[i];

            });
        $("#at-plan-check").find("input[name='at-plan']").each(function () {
            var text = $.trim($(this).parent().text());

            if (text == at_plan_match) {
                $(this).prop("checked", true);
            }
        });
    }

    if (paramValidation(treatment_other)) {

        $("#treat-plan-other").val(treatment_other);
        $("#treat-plan-other").prev().prev().prop("checked", true);
        $("#treat-plan-other").show();
    } else {
        $.each([
            data_obj['treatment_1'], data_obj['treatment_2'], data_obj['treatment_3'], data_obj['treatment_4'], data_obj['treatment_5']], function (i, value) {

                if (value == 1)
                    treat_plan_match = treatment_filter[i];

            });
        $("#treat-plan-check").find("input[name='treat-plan']").each(function () {
            var text = $.trim($(this).parent().text());
            if (text == treat_plan_match) {
                $(this).prop("checked", true);
            }
        });
    }

}