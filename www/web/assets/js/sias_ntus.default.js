//** self defined function parameter empty/undefined/null validation */
function paramValidation(param) {
    if (!param || typeof param === "undefined") return false;
    else if (param == "") return false;
    else if (param == "null") return false;
    else return true;
}
function GetCookieVal(offset) {
    var endstr = window.document.cookie.indexOf(";", offset);
    if (endstr == -1) endstr = window.document.cookie.length;
    return unescape(window.document.cookie.substring(offset, endstr));
}

function SetCookie(name, value, days, domain) {
    var expdate = new Date();

    if (days != null) expdate.setTime(expdate.getTime() + days * 24 * 60 * 60 * 1000);

    window.document.cookie = name + "=" + escape(value) + (days == null ? "" : ";  expires=" + expdate.toGMTString()) + "; path=/;  domain=" + domain;
}

function DelCookie(name, domain) {
    var date = new Date();
    date.setTime(date.getTime() - 10000);
    document.cookie = name + "=; expire=" + date.toGMTString() + "; path=/;domain=" + domain;
}

function GetCookie(name) {
    var arg = name + "=";
    var alen = arg.length;
    var clen = window.document.cookie.length;

    var i = window.document.cookie.indexOf(arg);
    while (i < clen) {
        var j = i + alen;
        if (window.document.cookie.substring(i, j) == arg) return GetCookieVal(j);
        i = window.document.cookie.indexOf("  ", i) + 1;
        if (i == 0) break;
    }
    return null;
}

function ConvertUnixTimeToLocalDate(unix_timestamp) {

    var date = new Date(Number(unix_timestamp));
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();

    month = month.toString().length == 1 ? `0${month}` : month;
    day = day.toString().length == 1 ? `0${day}` : day;

    return `${year}-${month}-${day}`;
}

function ConvertUnixTimeToLocalDateTime(unix_timestamp) {

    var date = new Date(Number(unix_timestamp));
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hour = date.getHours();
    var min = date.getMinutes();
    var sec = date.getSeconds();

    month = month.toString().length == 1 ? `0${month}` : month;
    day = day.toString().length == 1 ? `0${day}` : day;
    hour = hour.toString().length == 1 ? `0${hour}` : hour;
    min = min.toString().length == 1 ? `0${min}` : min;
    sec = sec.toString().length == 1 ? `0${sec}` : sec;

    return `${year}-${month}-${day} ${hour}:${min}:${sec}`;
}

function ConvertToUTC(timestamp) {

    var date = new Date(timestamp);
    return Date.UTC(
        date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(),
        date.getUTCHours(), date.getUTCMinutes(), date.getUTCSeconds()
    ).toString();
}
