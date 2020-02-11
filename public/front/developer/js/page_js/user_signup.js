$("#otp_section").hide();

function verify_otp() {
    var e = jQuery("#otp").val();
    jQuery.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: BASE_URL + "/verify-otp",
        type: "POST",
        dataType: "json",
        data: {
            otp: e
        },
        success: function(e) {
			
            if (e.success) {
                $("#otp").val("");
                location.reload();
            }
            if (e.fail) {
				$("#otp_msg").html("Invalid Otp");
			}
        }
    })
}

function changeType(e) {
    "text" == $("." + e).attr("type") ? $("." + e).attr("type", "password") : $("." + e).attr("type", "text")
}
$(function() {
    jQuery.validator.addMethod("alphanumeric", function(e, a) {
        if (/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/.test(e)) return !0
    }, "Only Alphanumeric characters are allowed."), jQuery.validator.addMethod("validMobile", function(e, a) {
        if (/^[0-9]+$/i.test(e)) return !0
    }, "Please enter valid mobile no."), jQuery.validator.addMethod("validname", function(e, a) {
        if (/^[a-zA-Z.']+$/i.test(e)) return !0
    }, "Only characters allowed."), jQuery.validator.addMethod("validEmail", function(e, a) {
        if ("" == e) return !0;
        var r = e.indexOf("@"),
            s = e.substr(r + 1),
            t = s.substr(0, s.indexOf("."));
        if (t.lastIndexOf("-") == t.length - 1 || t.indexOf("-") != t.lastIndexOf("-")) return !1;
        var l = e.substr(0, r);
        return l.lastIndexOf("_") != l.length - 1 && l.lastIndexOf(".") != l.length - 1 && l.lastIndexOf("-") != l.length - 1 && (str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]+)$/, str.test(e))
    }, "Please enter valid email."), 
	$("#register-popup").validate({
        rules: {
            fname: {
                required: !0,
                validname: !0,
                maxlength: 20
            },
            lname: {
                required: !0,
                validname: !0,
                maxlength: 20
            },
            mobile: {
                required: !0,
                validMobile: !0,
                maxlength: 10
            },
            dob: {
                required: !0
            },
            gender: {
                required: !0
            },
            user_email: {
                required: !0,
                validEmail: !0,
                maxlength: 100
            },
            password: {
                required: !0,
                minlength: 6,
                maxlength: 20
            },
            password_confirmation: {
                required: !0,
                equalTo: "#password"
            }
        },
        messages: {
            fname: {
                maxlength: "first name cannot be longer than 20 characters"
            },
            lname: {
                maxlength: "last name cannot be longer than 20 characters"
            },
            mobile: {
                maxlength: "Mobile cannot be longer than 10 characters"
            },
            password: {
                minlength: "Password must be at least 6 characters long",
                maxlength: "Password cannot be longer than 20 characters"
            },
            password_confirmation: {
                equalTo: "Please enter the confirm password as password"
            },
            user_email: {
                maxlength: "Password cannot be longer than 100 characters"
            },
            dob: {
                required: "DOB is required"
            },
            gender: {
                required: "Gender is required"
            }
        },
        submitHandler: function(e) {}
    })
}), $(document).ready(function() {
    $("#register-popup").validate(), 
	$("#register_user_popup").click(function() {
        if ($("#register-popup").valid()) {
            $(".loader").fadeIn("slow");
            var e = jQuery("#fname").val(),
                a = jQuery("#lname").val(),
                r = jQuery("#mobile").val(),
                reff_code = jQuery("#reff_code").val(),
                s = jQuery("#password").val(),
                gender = jQuery("#gender").val(),
                t = jQuery("#user_email").val(),
                l = jQuery("#dob").val(),
                n = jQuery("#password_confirmation").val();
            jQuery.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: BASE_URL + "/submit-popup",
                type: "POST",
                data: {
                    fname: e,
                    lname: a,
                    email: t,
                    reff_code:reff_code,
                    mobile: r,
                    gender: gender,
                    password: s,
                    password_confirmation: n,
                    dob: l
                },
                success: function(e) {
					var e= JSON.parse(e);
                    if (e.success) {
                        
						$("#fname").val(""), $("#lname").val(""), $("#user_email").val(""), $("#mobile").val(""), $("#password").val(""), $("#password_confirmation").val(""), jQuery(".loader").hide(), $("#reg_section").hide(), $("#otp_section").show();
                        $(".successMsg").html("<div id='success-alert' class='alert alert-success'>You have registered successfully.</div>"), $("#success-alert").fadeTo(2e3, 500).slideUp(500, function() {
                            $("#success-alert").slideUp(500)
                        })
						
                    }
                    if (e.fail) {
                        var a = jQuery.parseJSON(JSON.stringify(e.errors));
                        $(".fnameMsg").html(a.fname), $(".lnameMsg").html(a.lname), $(".emailMsg").html(a.email), $(".mobileMsg").html(a.mobile), $(".dobMsg").html(a.dob), $(".genderMsg").html(a.gender), $(".passwordMsg").html(a.password), $(".confMsg").html(a.password_confirmation), jQuery(".loader").hide()
                    }
                },
                error: function(e) {
                    console.log(e)
                }
            })
        }
    })
});

function resend_otp()
{

    jQuery.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: BASE_URL + '/resend-otp-code',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if(data.success)
            {
                $("#otp").val('');
                var successContent = "<div id='success-alert' class='alert alert-success'>"+data.message+"</div>";
                $('.auth_msg').html(successContent);
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                    //location.reload();
                });

            }
            if(data.fail)
            {
                var successContent = "<div id='success-alert' class='alert alert-danger'>"+data.message+"</div>";
                $('.auth_msg').html(successContent);
                $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                    $("#success-alert").slideUp(500);
                });
            }
        }
    });
}