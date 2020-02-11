function showLogin() {
    var e = $("#content-login"),
        a = $("#content-register"),
        s = e.height();
    $(e).css("display", "block"), $(e).stop().animate({
        left: "0px"
    }, 800, function() {}), $(a).stop().animate({
        left: "880px"
    }, 800, function() {
        $(a).css("display", "none")
    }), $("#page").stop().animate({
        height: s + "px"
    }, 550, function() {})
}

function changeType(e) {
    "text" == $("." + e).attr("type") ? $("." + e).attr("type", "password") : $("." + e).attr("type", "text")
}

function ChangeTypeLogin() {
    "text" == $("#login_password").attr("type") ? $("#login_password").attr("type", "password") : $("#login_password").attr("type", "text")
}

function reset_password() {
    jQuery(".loader-div").show();
    var e = jQuery("#remail").val();
    if ("" == e) {
        $(".rsuccessMsg").html("<div id='success-alert' class='alert alert-danger'>Please enter your registered email address</div>"), $("#success-alert").fadeTo(2e3, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500)
        }), jQuery(".loader-div").hide()
    } else jQuery.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: BASE_URL + "/reset-password-verify",
        type: "POST",
        dataType: "json",
        data: {
            email: e
        },
        success: function(e) {
            if (jQuery(".loader-div").hide(), e.success) {
                $("#remail").val("");
                $(".rsuccessMsg").html("<div id='success-alert' class='alert alert-success'>Reset password link has been sent to your email</div>"), $("#success-alert").fadeTo(2e3, 500).slideUp(500, function() {
                    $("#success-alert").slideUp(500)
                })
            }
            e.error && (console.log(e.error), $("#otp_msg").html("Invalid Otp"))
        }
    })
}
$(function() {
    jQuery.validator.addMethod("validEmail", function(e, a) {
        if ("" == e) return !0;
        var s = e.indexOf("@"),
            t = e.substr(s + 1),
            r = t.substr(0, t.indexOf("."));
        if (r.lastIndexOf("-") == r.length - 1 || r.indexOf("-") != r.lastIndexOf("-")) return !1;
        var n = e.substr(0, s);
        return n.lastIndexOf("_") != n.length - 1 && n.lastIndexOf(".") != n.length - 1 && n.lastIndexOf("-") != n.length - 1 && (str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]+)$/, str.test(e))
    }, "Please enter valid email."), $("#login-form").validate({
        rules: {
            login_mobile: {
                required: !0,
                maxlength: 100
            },
            login_password: {
                required: !0,
                minlength: 6,
                maxlength: 20
            }
        },
        messages: {
            login_password: {
                minlength: "Password must be at least 6 characters long",
                maxlength: "Password cannot be longer than 20 characters"
            },
            login_mobile: {
                maxlength: "Password cannot be longer than 100 characters"
            }
        },
        submitHandler: function(e) {}
    })
}), $(document).ready(function() {
    $("#login-form").validate(), $("#login_user").click(function() {
        if ($("#login-form").valid()) {
            jQuery(".loader").show();
            var e = jQuery("#login_password").val(),
                a = jQuery("#login_mobile").val();
            jQuery.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: BASE_URL + "/login-popup",
                type: "POST",
                dataType: "json",
                data: {
                    mobile: a,
                    password: e
                },
                success: function(e) {
                    if (e.fail) {
                        $("#regSuccessMessage").html("<div class='alert alert-danger'>Invalid mobile or Password.</div>")
                    }
					 if (e.success) {
                          location.replace(BASE_URL)
					 }
                },
                error: function(e) {
                    console.log("Something wrong in username and password")
                }
            })
        }
    })
}), $(".login_form").keydown(function(e) {
    13 == e.which && $("#login_user").trigger("click")
});