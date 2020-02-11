@extends('front.layout.front')
@section('content')
    <!--organicfood wrapper end-->
    <!--login section start-->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="page_login_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    @if (session('success_message'))
                        <div class="alert alert-success">
                            {{ session('success_message') }}
                        </div>
                    @endif
                    @if (session('error_message'))
                        <div class="alert alert-danger">
                            {{ session('error_message') }}
                        </div>
                    @endif
                    <div class="register_page_form">
                        <form action="{{URL::to('/reset-password-otp-verify')}}" method="post" id="reset-password"  name="reset-password">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="text-center">Verify Otp</h4>
                                    <div id="c_message"></div>
                                    <div class="input_text">
                                        <label for="otp">Otp <span>*</span></label>
                                        <input id="otp" name="otp"  class="form-control" type="text" required placeholder="Otp">
                                        <span class="error-msg  error otpMsg"></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="login_submit">
                                        <input value="Verify"  type="submit">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script language="javascript" src="{{ URL::asset('public/js/validation/jquery.validate.min.js') }}"></script>
    <script language="javascript" src="{{ URL::asset('public/js/validation/additional-methods.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script language="javascript" src="{{ URL::asset('public/js/developer/user_signup.js') }}"></script>
    <script>
        function resendOtp() {
            $(".loader-div").show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: BASE_URL + '/user-resend-otp',
                //data:{},
                success: function (response) {
                    $(".loader-div").hide();
                    response1= JSON.parse(response);
                    if(response1.success)
                    {
                        $("#otp").val(response1.otp);
                        var html="<div id='success' class='alert alert-success text-center' style='font-size:16px;'>Otp send successfully</div>";
                        $("#c_message").html(html);
                        setTimeout(function(){ $("#success").hide(); },3000);
                    }
                }

            });
        }
    </script>
@stop

<!--login section end-->
@endsection
