@extends('front.layout.front')
@section('content')
    <section class="myAccount my-5">

        <div class="container">
            <h2 class="shoping-cart-text border-0 text-center">Verify Otp</h2>
            <div class="row">
                <div class="col-12">
                    <div class="account-info">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-5 m-auto">
                                    <div class="box box-shipping-address mt-4">
                                        <div class="box-content">
                                            <div class="my-profile-content">
                                                <div class="c_message" id="c_message"></div>
                                                <div class="alert alert-success message" style="display:none" id="success_alert"><li class="fa fa-check"></li></div>
                                                @if(Session::has('success_message'))
                                                    <div class="alert alert-success message"><li class="fa fa-check"></li>{{ Session::get('success_message') }}</div>
                                                @endif
                                                @if(Session::has('error_message'))
                                                    <div class="alert alert-danger message"><li  class="fa fa-window-close"></li>{{ Session::get('error_message') }}</div>
                                                @endif
                                                {{ Form::model('',array('url' => 'verify-update-mobile-otp','class'=>'form-horizontal','name'=>'update_profile',"enctype"=>"multipart/form-data")) }}
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-4">
                                                                <label>Verify Otp<sub>*</sub></label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="text" class="form-control" placeholder="Enter Otp" id="otp" name="otp">
                                                                <div class="input-overlay">
                                                                    <span class="countdown"></span>
                                                                    <a href="javaScript:void(0)" class="resendOtp text-primary" onclick="resendOtp()">Resend Otp</a>
                                                                </div>
                                                                <span class="mobileMsg error">{{ $errors->first('otp') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 text-right">
                                                        <button type="submit" class="btn btn-submit custom-btn">Verify </button>
                                                    </div>
                                                    </form>




                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </section>
    @endSection
    <script>
        function resendOtp() {
            $(".loader-div").show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: BASE_URL + '/mobile-update-resend-otp',
                //data:{},
                success: function (response) {
                    $(".loader-div").hide();
                    $('.resendOtp').hide();
                        var html="<div id='success' class='alert alert-success text-center' style='font-size:16px;'>Otp send successfully</div>";
                        $("#c_message").html(html);
                        setTimeout(function(){ $("#c_message").hide(); },3000);
                    $('.countdown').show();
                    var timer2 = "2:00";
                    var interval = setInterval(function() {


                        var timer = timer2.split(':');
                        //by parsing integer, I avoid all extra string processing
                        var minutes = parseInt(timer[0], 10);
                        var seconds = parseInt(timer[1], 10);
                        --seconds;
                        minutes = (seconds < 0) ? --minutes : minutes;
                        if (minutes < 0) clearInterval(interval);
                        seconds = (seconds < 0) ? 59 : seconds;
                        seconds = (seconds < 10) ? '0' + seconds : seconds;
                        //minutes = (minutes < 10) ?  minutes : minutes;
                        $('.countdown').html(minutes + ':' + seconds);
                        timer2 = minutes + ':' + seconds;
                        if(minutes == 0 && seconds ==0){
                            $('.countdown').hide();
                            $('.resendOtp').show();

                        }
                    }, 1000);
                }

            });
        }
    </script>