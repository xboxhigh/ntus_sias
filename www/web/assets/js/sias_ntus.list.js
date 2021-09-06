$(function () {
    $(document).ajaxStart(function () {
        $(".loading-mask").css("display", "block");
    });

    $(document).ajaxStop(function () {
        $(".loading-mask").css("display", "none");
    });

    _init();

    var _TOKEN = GetCookie("token");

    /** parameters for ajax process */
    var api_params = {
        baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
        api_ver: "v1",
        resource: "/users",
        action: `/findList`,
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
                if (paramValidation(feedback))
                    fillOutForm(feedback)
            },
            401: function (feedback, textStatus, jqXHR) {
                alert("無效的 TOKEN");
                location.href = "/web";
            },
            404: function (feedback, textStatus, jqXHR) {
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

    $('#line-id').on('change', function () {
        if ($(this).val() != 0) {
            $("#advanced-operation").show();
            var ubi_id = $(this).find("option:selected").text().split("[")[1].split("]")[0];

            if (paramValidation(ubi_id)) {
                /** parameters for ajax process */
                var api_params = {
                    baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                    api_ver: "v1",
                    resource: "/users",
                    action: `/getAllData/${ubi_id}`,
                }
                var target_api_link = api_params.baseUrl + api_params.api_ver + api_params.resource + api_params.action;

                $.ajax({
                    type: "GET",
                    url: target_api_link,
                    dataType: "json",
                    headers: {
                        'Authorization': `Bearer ${_TOKEN}`
                    },
                    statusCode: {
                        200: function (feedback, textStatus, jqXHR) {
                            if (paramValidation(feedback))
                                fillOutForms(feedback)
                        },
                        204: function (feedback, textStatus, jqXHR) {
                            alert("無資料！")
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
        } else {
            $("#advanced-operation").hide();
            cleanTables();
        }
    });

    $('#advanced-operation > .btn.btn-outline-warning').on('click', function () {
        var ubi_id = $("#line-id option:selected").text().split("[")[1].split("]")[0];

        if (confirm("確定要刪除此筆測驗？")) {
            if (paramValidation(ubi_id)) {
                /** parameters for ajax process */
                var api_params = {
                    baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                    api_ver: "v1",
                    resource: "/users",
                    action: `/forms/${ubi_id}`,
                }
                var target_api_link = api_params.baseUrl + api_params.api_ver + api_params.resource + api_params.action;

                $.ajax({
                    type: "DELETE",
                    url: target_api_link,
                    dataType: "json",
                    headers: {
                        'Authorization': `Bearer ${_TOKEN}`
                    },
                    statusCode: {
                        200: function (feedback, textStatus, jqXHR) {
                            alert("刪除成功");
                            location.reload();
                        },
                        403: function (feedback, textStatus, jqXHR) {
                            alert("禁止存取！")
                        },
                        500: function (feedback, textStatus, jqXHR) {
                            alert("伺服器錯誤，請洽網站管理員！")
                        }
                    }
                });
            }
        }
    });

    $('#advanced-operation > .btn.btn-outline-danger').on('click', function () {
        var u_id = $("#line-id").val();

        if (confirm("確定要刪除此 Line ID？")) {
            if (confirm("此 Line ID 所做過的所有測驗將會一併刪除，且本操作不可復原！\n確定要執行？")) {
                if (paramValidation(u_id)) {
                    /** parameters for ajax process */
                    var api_params = {
                        baseUrl: "http://" + window.location.hostname + ":8100/api/web/",
                        api_ver: "v1",
                        resource: "/users",
                        action: `/${u_id}`,
                    }
                    var target_api_link = api_params.baseUrl + api_params.api_ver + api_params.resource + api_params.action;

                    $.ajax({
                        type: "DELETE",
                        url: target_api_link,
                        dataType: "json",
                        headers: {
                            'Authorization': `Bearer ${_TOKEN}`
                        },
                        statusCode: {
                            200: function (feedback, textStatus, jqXHR) {
                                alert("刪除成功");
                                location.reload();
                            },
                            403: function (feedback, textStatus, jqXHR) {
                                alert("禁止存取！")
                            },
                            500: function (feedback, textStatus, jqXHR) {
                                alert("伺服器錯誤，請洽網站管理員！")
                            }
                        }
                    });
                }

            }
        }
    });
});

function _init() {
    $("body").find(':input').each(function () {
        $(this).val('');
    });
}

function fillOutForm(data_obj) {
    var option_html = ["<option value='0'>...</option>"];
    $.each(data_obj, function (key, value) {
        var u_id = value['u_id'];
        var line_id = value['line_id'];
        var content = `<option value='${u_id}'>${line_id}</option>`;

        option_html.push(content);
    });
    $("#line-id").html(option_html.join(''));
}

function fillOutForms(data_obj) {
    var re = /_/gi;

    $.each(data_obj, function (key, value) {
        var section_id = key.replace(re, '-');

        if (section_id == "user") {
            var push_contents = [];
            $.each(value, function (key, value) {
                var contents = `<div class="container"><div class="col-sm"><div class="row"><div class="col-sm border border-danger font-weight-bold">${key}</div><div class="col-sm border border-info">${value}</div></div></div></div>`
                push_contents.push(contents)
            });
            $(`#${section_id}`).html(push_contents.join(''));
        } else if (section_id == "user-body") {
            var push_contents = [];
            $.each(value, function (key, value) {
                if (key == "created_at" || key == "updated_at" || key == "day_of_birth") {
                    value = ConvertUnixTimeToLocalDate(value);
                }
                var contents = `<div class="container"><div class="col-sm"><div class="row"><div class="col-sm border border-danger font-weight-bold">${key}</div><div class="col-sm border border-info">${value}</div></div></div></div>`
                push_contents.push(contents)
            });
            $(`#${section_id}`).html(push_contents.join(''));
        } else if (section_id == "basic-shoes") {
            var push_contents = [];
            $.each(value, function (key, value) {
                if (key == "created_at" || key == "updated_at") {
                    value = ConvertUnixTimeToLocalDate(value);
                }
                var contents = `<div class="container"><div class="col-sm"><div class="row"><div class="col-sm border border-danger font-weight-bold">${key}</div><div class="col-sm border border-info">${value}</div></div></div></div>`
                push_contents.push(contents)
            });
            $(`#${section_id}`).html(push_contents.join(''));
        } else if (section_id == "adv-shoes") {
            var push_contents = [];
            $.each(value, function (key, value) {
                if (key == "created_at" || key == "updated_at") {
                    value = ConvertUnixTimeToLocalDate(value);
                }
                var contents = `<div class="container"><div class="col-sm"><div class="row"><div class="col-sm border border-danger font-weight-bold">${key}</div><div class="col-sm border border-info">${value}</div></div></div></div>`
                push_contents.push(contents)
            });
            $(`#${section_id}`).html(push_contents.join(''));
        } else if (section_id == "medical") {
            var push_contents = [];
            $.each(value, function (fakeKey, medical) {
                push_contents.push(`<div class="container"><h5> table 5 - ${fakeKey}`);
                $.each(medical, function (key, value) {
                    if (key == "created_at" || key == "updated_at") {
                        value = ConvertUnixTimeToLocalDate(value);
                    }
                    var contents = `<div class="col-sm"><div class="row"><div class="col-sm border border-danger font-weight-bold">${key}</div><div class="col-sm border border-info">${value}</div></div></div>`
                    push_contents.push(contents)
                });
                push_contents.push(`</h5></div>`);
            });
            $(`#${section_id}`).html(push_contents.join(''));
        } else if (section_id == "muscles") {
            var push_contents = [];
            $.each(value, function (key, value) {
                if (key == "created_at" || key == "updated_at") {
                    value = ConvertUnixTimeToLocalDate(value);
                }
                var contents = `<div class="container"><div class="col-sm"><div class="row"><div class="col-sm border border-danger font-weight-bold">${key}</div><div class="col-sm border border-info">${value}</div></div></div></div>`
                push_contents.push(contents)
            });
            $(`#${section_id}`).html(push_contents.join(''));
        } else if (section_id == "psycho") {
            var push_contents = [];
            $.each(value, function (key, value) {
                if (key == "created_at" || key == "updated_at") {
                    value = ConvertUnixTimeToLocalDate(value);
                }
                var contents = `<div class="container"><div class="col-sm"><div class="row"><div class="col-sm border border-danger font-weight-bold">${key}</div><div class="col-sm border border-info">${value}</div></div></div></div>`
                push_contents.push(contents)
            });
            $(`#${section_id}`).html(push_contents.join(''));
        } else if (section_id == "extra") {
            var push_contents = [];
            $.each(value, function (key, value) {
                if (key == "created_at" || key == "updated_at" || key == "date") {
                    value = ConvertUnixTimeToLocalDate(value);
                }
                var contents = `<div class="container"><div class="col-sm"><div class="row"><div class="col-sm border border-danger font-weight-bold">${key}</div><div class="col-sm border border-info">${value}</div></div></div></div>`
                push_contents.push(contents)
            });
            $(`#${section_id}`).html(push_contents.join(''));
        }
    });


}

function cleanTables() {
    $("#user").empty();
    $("#user-body").empty();
    $("#basic-shoes").empty();
    $("#adv-shoes").empty();
    $("#medical").empty();
    $("#muscles").empty();
    $("#psycho").empty();
    $("#psycho").empty();
}