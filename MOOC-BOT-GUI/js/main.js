var g_rulesList = {};
$(document).ready(function() {
    $("#successMessage").hide("fast");
    loadFilters();
    loadRules();
});
var g_editingRuleId = 0;
function loadRules() {
    $("#edit-refreshIcon").toggleClass("fa-spin");
    $("#edit-ruleList").html("");
    var MOOCAPI = "getRules.php";
    window.g_rulesList.length = 0;
    window.g_rulesList = {};
    $.post(MOOCAPI, {})
            .done(function(data) {
                $.each(data, function(i, item) {
                    window.g_rulesList[item.id] = item;
                    $("#edit-ruleList").append("<li class=\"" + item.catName + "\" role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\" ruleId=\"" + item.id + "\"  onclick=\"ruleDropdownClick(" + item.id + ")\">" + item.ruleName + "</a></li>");
                });
                $("#edit-refreshIcon").toggleClass("fa-spin");
            });
}

function loadFilters() {
    $("#filter-ruleList").html("");
    var MOOCAPI = "getCategories.php";
    $("#filter-ruleList").append("<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\" catName=\"" + "showAll" + "\"  onclick=\"filterRulesList('" + "showAll" + "')\">" + "showAll" + "</a></li>");
    $.post(MOOCAPI, {})
            .done(function(data) {
                $.each(data, function(i, item) {
                    console.log(item.catName);
                    $("#filter-ruleList").append("<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\" catName=\"" + item.catName + "\"  onclick=\"filterRulesList('" + item.catName + "')\">" + item.catName + "</a></li>");
                });
            });
}

function filterRulesList(_filter) {
    if (_filter === "showAll")
        $("#edit-ruleList li").show();
    else {
        $("#edit-ruleList li").hide();
        $('#edit-ruleList li').each(function(index) {
            if (!$(this).hasClass(_filter))
                $(this).show();
        });
    }
//    $("#edit-ruleList li:." + _filter).show();
}

function ruleDropdownClick(_ruleId) {
    var item = window.g_rulesList[_ruleId];
    window.g_editingRuleId = _ruleId;
    console.log(item.ruleName);
    $("#edit-ruleName").val(item.ruleName);
    $("#edit-who").val(item.who);
    $("#edit-catName").val(item.catName);
    $("#edit-containsThis").val(item.containsThis);
    $("#edit-containsThat").val(item.containsThat);
    $("#edit-notThis").val(item.notThis);
    $("#edit-listOfResponses").html("");
    thenTweets = item.thenTweet.split(";");
    for (var t in thenTweets) {
        $("#edit-listOfResponses").append("<div class='input-group input-group-lg' style='padding-top: 9px; padding-bottom: 9px;'>\n\
                                    <input type='text' class='form-control edit-answersToStore' placeholder='Tweet this message or you can add more and the Bot will choose one randomly' onkeyup='javascript: updateCharCount(this)'value=\"" + thenTweets[t] + "\">\n\
                                    <span class='input-group-addon customFontColor charCount' style='color: #888; padding: 5px;'>110</span>\n\
                                    <span class='input-group-addon customFontColor' style='color: #000; padding: 5px;' onclick='addMoreResponses()'><i class='fa fa-plus-square'></i></span>\n\
                                    <span class='input-group-addon customFontColor' style='color: #000; padding: 5px;' onclick='removeResponses(this)'><i class='fa fa-minus-square'></i></span>    </div>");
    }
}
/*
 * TODO:
 *Change the alert to a nice jquery dialogue....
 */
function removeRule() {
    if (window.g_editingRuleId > 0) {
         var result = window.confirm('Are you sure?');
            if (result == true) {
                $.post("deleteTweetRule.php",
                        {ruleId: window.g_editingRuleId});
                window.g_editingRuleId = 0;
            };
    }
    else {
        var res = ["You haven't chosen any rules to delete", "Choose a rule first then click delete", "How can I delete when there's no rule selected? PLease select a rule first!"];
        alert(res[Math.floor((Math.random() * 3))]);
    }
}

function addMoreResponses() {
    $("#listOfResponses").append("<div class='input-group input-group-lg' style='padding-top: 9px; padding-bottom: 9px;'>\n\
                                    <input type='text' class='form-control answersToStore' placeholder='Tweet this message or you can add more and the Bot will choose one randomly' onkeyup='javascript: updateCharCount(this)'>\n\
                                    <span class='input-group-addon customFontColor charCount' style='color: #888; padding: 5px;'>110</span>\n\
                                    <span class='input-group-addon customFontColor' style='color: #000; padding: 5px;' onclick='addMoreResponses()'><i class='fa fa-plus-square'></i></span>\n\
                                    <span class='input-group-addon customFontColor' style='color: #000; padding: 5px;' onclick='removeResponses(this)'><i class='fa fa-minus-square'></i></span>    </div>");
}
function addMoreEditResponses() {
    $("#edit-listOfResponses").append("<div class='input-group input-group-lg' style='padding-top: 9px; padding-bottom: 9px;'>\n\
                                    <input type='text' class='form-control edit-answersToStore' placeholder='Tweet this message or you can add more and the Bot will choose one randomly' onkeyup='javascript: updateCharCount(this)'>\n\
                                    <span class='input-group-addon customFontColor charCount' style='color: #888; padding: 5px;'>110</span>\n\
                                    <span class='input-group-addon customFontColor' style='color: #000; padding: 5px;' onclick='addMoreResponses()'><i class='fa fa-plus-square'></i></span>\n\
                                    <span class='input-group-addon customFontColor' style='color: #000; padding: 5px;' onclick='removeResponses(this)'><i class='fa fa-minus-square'></i></span>    </div>");
}
function removeResponses(_me) {
    $(_me).parent().remove();
}
function saveData() {

    var myContainsThis = $("#containsThis").val().toString(),
            myContainsThat = $("#containsThat").val().toString(),
            myNotThis = $("#notThis").val().toString(),
            myThenTweet = "",
            myWho = $("#who").val().toString(),
            ruleName = $("#ruleName").val().toString(),
            catName = $("#catName").val().toString();
    $(".answersToStore").each(function() {
        myThenTweet += $(this).val() + ";";
    });
    myThenTweet = myThenTweet.substr(0, myThenTweet.length - 1);
    $.post("saveTweetRule.php",
            {who: myWho, containsThis: myContainsThis, containsThat: myContainsThat, thenTweet: myThenTweet, notThis: myNotThis, ruleName: ruleName, catName: catName}).done(function(data) {
        $("#successMessage").show("fast");
        $("#successMessage").hide(3000);
    }).fail(function(data) {
        $("#successMessage").show("fast");
        $("#successMessage").hide(3000);
    });
}

function updateData() {
    $("#updateIcon").toggleClass("fa-spin");
    var myContainsThis = $("#edit-containsThis").val().toString(),
            myContainsThat = $("#edit-containsThat").val().toString(),
            myNotThis = $("#edit-notThis").val().toString(),
            myThenTweet = "",
            myWho = $("#edit-who").val().toString(),
            ruleName = $("#edit-ruleName").val().toString();
    $("#edit-listOfResponses .edit-answersToStore").each(function() {
        if ($(this).val().trim().length > 0)
            myThenTweet += $(this).val() + ";";
    });
    myThenTweet = myThenTweet.substr(0, myThenTweet.length - 1);
    console.log("updating!");
    $.post("updateTweetRule.php",
            {ruleId: window.g_editingRuleId, ruleName: ruleName, who: myWho, containsThis: myContainsThis, containsThat: myContainsThat, thenTweet: myThenTweet, notThis: myNotThis}
    ).done(function(data) {
        $("#updateIcon").toggleClass("fa-spin");
        loadRules();
    }).fail(function(xhr, textStatus, errorThrown) {
        $("#updateIcon").toggleClass("fa-spin");
        loadRules();
        console.log(xhr.responseText);
    });
}
function getFormValues(_containsThis, _containsThat, _thenTweet, _who) {
    _containsThis = $("#containsThis").val().toString();
    _containsThat = $("#containsThat").val().toString();
}

function updateCharCount(_me) {
    var myText = $(_me).val().toString();
    if (myText.length >= 110) {
        myText = myText.substring(0, 110);
        $(_me).val(myText);
    }
    $(_me).parent().children(".charCount").text(myText.length);
}

var dateFormat = function() {
    var token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
            timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
            timezoneClip = /[^-+\dA-Z]/g,
            pad = function(val, len) {
                val = String(val);
                len = len || 2;
                while (val.length < len)
                    val = "0" + val;
                return val;
            };
    // Regexes and supporting functions are cached through closure
    return function(date, mask, utc) {
        var dF = dateFormat;
        // You can't provide utc if you skip other args (use the "UTC:" mask prefix)
        if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
            mask = date;
            date = undefined;
        }

        // Passing date through Date applies Date.parse, if necessary
        date = date ? new Date(date) : new Date;
        if (isNaN(date))
            throw SyntaxError("invalid date");
        mask = String(dF.masks[mask] || mask || dF.masks["default"]);
        // Allow setting the utc argument via the mask
        if (mask.slice(0, 4) == "UTC:") {
            mask = mask.slice(4);
            utc = true;
        }

        var _ = utc ? "getUTC" : "get",
                d = date[_ + "Date"](),
                D = date[_ + "Day"](),
                m = date[_ + "Month"](),
                y = date[_ + "FullYear"](),
                H = date[_ + "Hours"](),
                M = date[_ + "Minutes"](),
                s = date[_ + "Seconds"](),
                L = date[_ + "Milliseconds"](),
                o = utc ? 0 : date.getTimezoneOffset(),
                flags = {
                    d: d,
                    dd: pad(d),
                    ddd: dF.i18n.dayNames[D],
                    dddd: dF.i18n.dayNames[D + 7],
                    m: m + 1,
                    mm: pad(m + 1),
                    mmm: dF.i18n.monthNames[m],
                    mmmm: dF.i18n.monthNames[m + 12],
                    yy: String(y).slice(2),
                    yyyy: y,
                    h: H % 12 || 12,
                    hh: pad(H % 12 || 12),
                    H: H,
                    HH: pad(H),
                    M: M,
                    MM: pad(M),
                    s: s,
                    ss: pad(s),
                    l: pad(L, 3),
                    L: pad(L > 99 ? Math.round(L / 10) : L),
                    t: H < 12 ? "a" : "p",
                    tt: H < 12 ? "am" : "pm",
                    T: H < 12 ? "A" : "P",
                    TT: H < 12 ? "AM" : "PM",
                    Z: utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
                    o: (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
                    S: ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 !== 10) * d % 10]
                };
        return mask.replace(token, function($0) {
            return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
        });
    };
}();
// Some common format strings
dateFormat.masks = {
    "default": "ddd mmm dd yyyy HH:MM:ss",
    shortDate: "m/d/yy",
    mediumDate: "mmm d, yyyy",
    longDate: "mmmm d, yyyy",
    fullDate: "dddd, mmmm d, yyyy",
    shortTime: "h:MM TT",
    mediumTime: "h:MM:ss TT",
    longTime: "h:MM:ss TT Z",
    isoDate: "yyyy-mm-dd",
    isoTime: "HH:MM:ss",
    isoDateTime: "yyyy-mm-dd'T'HH:MM:ss",
    isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};
// Internationalization strings
dateFormat.i18n = {
    dayNames: [
        "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
        "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
    ],
    monthNames: [
        "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
        "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
    ]
};
// For convenience...
Date.prototype.format = function(mask, utc) {
    return dateFormat(this, mask, utc);
};