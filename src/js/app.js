/**
 * ------------------------------------------------------------------------------
 * Some useful common functions
 * ------------------------------------------------------------------------------
 */
baseURL = window.location.origin;
currentURL = document.location.href;

// Make sure jQuery has been loaded
if (typeof jQuery === 'undefined') {
    throw new Error('App requires jQuery');
}


/**
 * Overridden console.log for production
 * @type Function|common_L4.commonAnonym$0
 */
window.console = (function(origConsole) {
    if (!window.console)
        console = {};
    var isDebug = true; // set true to display console in browser console
    var logArray = {
        logs: [],
        errors: [],
        warns: [],
        infos: []
    };
    return {
        log: function() {
            logArray.logs.push(arguments)
            isDebug && origConsole.log && origConsole.log.apply(origConsole, arguments);
        },
        warn: function() {
            logArray.warns.push(arguments)
            isDebug && origConsole.warn && origConsole.warn.apply(origConsole, arguments);
        },
        error: function() {
            logArray.errors.push(arguments)
            isDebug && origConsole.error && origConsole.error.apply(origConsole, arguments);
        },
        info: function(v) {
            logArray.infos.push(arguments)
            isDebug && origConsole.info && origConsole.info.apply(origConsole, arguments);
        },
        debug: function(bool) {
            isDebug = bool;
        },
        logArray: function() {
            return logArray;
        }
    };

}(window.console));



var regEx = {
    user_id: /^[0-9\sA-Za-z\u00C0-\u00FF\~\#\";\/!@$%^&*()_\+\{\}\?\-\[\]\\,.\u0152\u0153\u20A0\u20A3\u0178\u20AC\u2013\u2014\u00C6\u00E6\u00C4\u00E4\u20A3]{5,32}$/,
    password: /^[^|]{6,32}$/,
    email: /^(?!.*([.])\1{1})([\w\.\-\+\<\>\{\}\=\`\|\?]+)@(?![.-])([a-zA-Z\d.-]+)\.([a-zA-Z.][a-zA-Z]{1,6})$/,
    create_user_id: /^[0-9\sA-Za-z\!@$%^*()_\+\{\}\?\-\[\]\\,.]{5,32}$/,
    four_consecutive_digits: /\d{4}/,
    create_password: /^(?=(?:.*?[0-9]){2})(?=.*[a-zA-Z])[0-9\sA-Za-z\!@\#$%^&*()_\+\{\}?\-\[\]\\,.]{6,32}$/,
    checkpoint_response: /^[0-9\sA-Za-z\?\#,.:;\\<|>!=@\#$%^*_\-\+\{\}\[\]]{1,}$/,
    formatted_date: /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/,
    formatted_date_with_stars_pattern: /^(0[1-9]|1[012]|\*\*)[- /.](0[1-9]|[12][0-9]|3[01]|\*\*)[- /.](((19|20)\d\d)|(\*\*\*\*))$/,
    cvv: /^\d{3,4}$/,
    last_four_digits: /^\d{4}$/,
    card_number_length: /^.{9,16}$/,
    card_number_format: /^[0-9]*$/,
    card_name: /^[a-zA-Z\s\-'\.]{4,30}$/,
    aba_routing: /^\d{1,9}$/,
    account_number: /^\d{1,17}$/,
    currency: /^\d{1,10}(\.\d{0,2})?$|^\.\d{1,2}$/,
    nickname: /^[\s\dA-Za-z\u00C0-\u00FF\!@\#$%^&\*\(\)_\+\{\}\?\-\=\[\]\,\.\u0152\u0153\u20A0\u20A3\u0178\u20AC\u00C6\u00E6\u00C4\u00E4\u20A3]{0,30}$/,
    card_nickname: /^[\s\dA-Za-z\u00C0-\u00FF\!@\#$%^&\*\(\)_\+\{\}\?\-\[\]\,\~\\\\|\/u0152\u0153\u20A0\u20A3\u0178\u20AC\u00C6\u00E6\u00C4\u00E4\u20A3]{0,30}$/,
    three_repeating_characters: /(.)\1{2,}/,
    phone_number_US: /^\d{10}$/,
    has_a_number: /\d/,
    security_question_format: /^[0-9\sA-Za-z\u00C0-\u00FF0-9\u0152\u0153\u20A0\u0178\u20A3\u20AC\<\>\!@\#$%^*_\+\{\}|:\?\-\=\[\]\\;/.]*$/,
    whole_number: /^([1-9][0-9]*)$/,
    name: /^[A-Za-z\.\-\'\s,]*$/,
    name_with_latin_characters: /^[A-Za-z\.\-\'\s,\u00C0-\u00FF\u0152\u0153\u20A0\u20A3\u0178\u20AC\u00C6\u00E6\u00C4\u00E4\u20A3]*$/,
    numeric_only: /^[0-9]*$/,
    numeric_only_with_spaces: /^[0-9\s]*$/,
    numeric_two_decimal_places: /^\d+(\.\d{1,2})?$/,
    alpha_only: /^[A-Za-z]*$/,
    alpha_upper: /^[A-Z]*$/,
    alpha_lower: /^[a-z]*$/,
    is_special_char: /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]+$/,
    alpha_with_spaces: /^[A-Za-z\s]*$/,
    alpha_numeric_only: /^[0-9A-Za-z]*$/,
    alphanumeric_with_spaces: /^[A-Za-z0-9\s]*$/,
    balance_transfer_city: /^[A-Za-z\u00C0-\u00FF\u0152\u0153\u20A0\u20A3\u0178\u20AC\u00C6\u00E6\u00C4\u00E4\u20A3\s\.]{1,18}$/,
    zipcode: /^[0-9]{5,5}$/,
    postal_code: /^[A-Za-z][0-9][A-Za-z]\s[0-9][A-Za-z][0-9]$/,
    consecutive_spaces: /\s\s/,
    leading_or_trailing_spaces: /^[\s]+|[\s]+$/,
    activation_code: /^[A-Za-z0-9]{8}$/,
    dispute_charge_text: /^[^<>\"%]*$/,
    message_subject: /^[^=\"'<>]*$/,
    message_body: /^[^=\"'<>]*$/
};

/**
 * Onload set scroll bar to bottom of the scrollable container 
 * @param {DOM element object} el 
 */
function scrollToBottom(el) {
    var $scrollableArea = $('.scrollable-b');
    $scrollableArea.scrollTop($scrollableArea[0].scrollHeight);
}

function getQueryString() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function setTimeoutTesting() {
    console.log("setTimeoutTesting() called after 5000ms");
}

function setIntervalTesting() {
    var d = new Date();
    var curTime = formatAMPM(d);
    console.log("# setIntervalTesting() called after 1000ms. Time = " + curTime);
}

function displayClock() {
    var d = new Date();
    var curTime = formatAMPM(d);
    $("#showClock").html(curTime);
}

/**
 * Time format AM, PM
 * @param {*} date 
 */
function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    var strTime = '<span><span class="h1">' + hours + '</span>:<span class="h3">' + minutes + '</span><sup><span class="h6 text-danger">' + seconds + '</span> ' + ampm + '</sup></span>';
    //var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

/**
 * Display count down timer
 */
function displayCountDownTimer() {
    //var deadline = new Date("Mar 16, 2018 15:23:59").getTime();
    var deadline = new Date().getTime() + 60000;
    //var countDown = "initializing timer...";
    var x = setInterval(function() {
        var timeNow = new Date().getTime();
        var timeDiff = countTimeDifference(deadline, timeNow);
        var countDown = timeDiff.days + "d " + timeDiff.hours + "h " + timeDiff.minutes + "m " + timeDiff.seconds + "s ";
        $("#showCountDown").html('Something will be start in <b>' + countDown + '</b>');
        if (timeDiff < 0) {
            clearInterval(x);
            var countDown = "expired";
            $("#showCountDown").html(countDown);
        }
    }, 1000);
}

/**
 * Calculate time difference between two time stamp
 * @param {number} time1 
 * @param {number} time2 
 */
function countTimeDifference(time1, time2) {
    var res = {};
    var timeDiff = time1 - time2;
    var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
    res.days = days;
    res.hours = hours;
    res.minutes = minutes;
    res.seconds = seconds;
    if (timeDiff < 0) {
        return -1;
    } else {
        return res;
    }
}

/**
 * Generate GUID
 */
function generateGUID() {
    function s4() {
        return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
    }
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}

/**
 * Generate Random Number
 */
function generateBasicRandomNumber(length, type) {
    return Math.floor(Math.random() * 2000) + 1000;
}

/**
 * Close Bootstrap Alert Messages
 */
function autoCloseAlertMessage(autoClose) {
    if (autoClose === true) {
        $('.auto-closable-alert').fadeTo(5000, 500).slideUp(500, function() {
            $('.auto-closable-alert').alert('clsoe');
        });
    }
}

/**
 * Scroll to Top of webpage
 */

function scrollToTop(minHeight, scrollSpeed) {
    $(window).scroll(function() {
        if ($(this).scrollTop() > minHeight) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, scrollSpeed);
        return false;
    });
}


/**
 * Toggle Icons
 */
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
};

function panelGroupToggle() {
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
}

/**
 * Field Help
 */
function renderFieldHelp(e) {
    $('.field-help').on('focusin', function(e) {
        var elm = $(this);
        var helpText = elm.attr('data-help-text');
        var helpTextCssClass = elm.attr('data-help-text-class') ? elm.attr('data-help-text-class') : 'p-3 mt-1 mb-2 bg-light';
        if (typeof helpText != 'undefined' && helpText.length > 0) {
            var html = '<div class="' + helpTextCssClass + '"><small>' + helpText + '</small></div>';
            elm.after(html);
        }
    });
    $('.field-help').on('focusout', function(e) {
        var elm = $(this);
        var helpText = elm.attr('data-help-text');;
        if (typeof helpText != 'undefined' && helpText.length > 0) {
            elm.next().remove();
        }
    });
}

/**
 * Allow Numeric Only
 */
function numericOnly(event) {
    event.target.value = event.target.value.replace(/[^0-9\.]/g, '');
    if ((event.which != 46 || event.target.value.indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
}

/**
 * Display Window Confirmation
 */
function askConfirmation(event) {
    //event.preventDefault();
    var result = false;
    var that = $(this);
    var isConfirmationRequired = that.attr('data-confirmation');
    var confirmationMessage = that.attr('data-confirmation-message');
    var confirmed = confirm(confirmationMessage);
    if (confirmed) {
        result = true;
    } else {
        result = false;
    }
    return result;
}
















/**
 * ------------------------------------------------------------------------------
 * DOM Interaction (Ready/Load, Click, Hover, Change)
 * ------------------------------------------------------------------------------
 */
var closeBootstrapAlertMsg = false; // true|false

// Start of document ready
$(document).ready(initPage);

function initPage() {
    //Alert message close after few seconds
    autoCloseAlertMessage(closeBootstrapAlertMsg);
    // Scroll to top
    scrollToTop(500, 100);
    panelGroupToggle();
    renderFieldHelp();
    setActiveTarget();

    //Select 2
    $('.ci-js-select-2').select2();

    //Bootstrap tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //Add random CSS class using JS
    /*var classes = ["badge badge-primary", "badge badge-success", "badge badge-info", "badge badge-warning", "badge badge-dark", "badge badge-dark", "badge badge-danger"];
    $(".tagcloud a").each(function() {
        $(this).addClass(classes[~~(Math.random() * classes.length)]);
    });*/

}
// End of initPage() i.e. document ready

// Start of DOM Interaction Handler
$(document).on('keypress keyup blur', '.numeric-decimal', numericOnly);
$(document).on('click', '.btn-delete', askConfirmation);


//Nav Tab Click : Display last clicked nav tab
function setActiveTarget() {
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        //console.log(activeTab);
        //$('a[data-toggle="tab"]').removeClass('active');
        $('a[data-toggle="tab"][id="' + activeTab + '"]').click();

    }


}
$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    var target = $(e.target).attr("id") // activated tab, // prev target e.relatedTarget
    localStorage.setItem('activeTab', target);
    //console.log(target);
});


/**
 * Display Ajax Loader
 */

function showAjaxLoader() {
    $("#ajax-loader").css("display", "block");
}

function hideAjaxLoader() {
    $("#ajax-loader").css("display", "none");
}