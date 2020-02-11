@extends('front.layout.front')
@section('content')
    <!--organicfood wrapper end-->
    <!--login section start-->
    <div class="page_login_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="register_page_form">
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
                        <form action="{{URL::to('/register')}}" method="post" id="register-form" name="register-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="input_text">
                                        <label for="fname">First Name <span>*</span></label>
                                        <input id="fname" value="{{old('fname')}}" name="fname" class="form-control" type="text">
                                        <strong class="error">{{ $errors->first('fname') }}</strong>
                                                                                
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="input_text">
                                        <label for="lname">Last Name <span>*</span></label>
                                        <input id="lname" name="lname" value="{{old('lname')}}" type="text">
                                        <strong class="error">{{ $errors->first('lname') }}</strong>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="input_text">
                                        <label for="email">Email Address <span></span></label>
                                        <input id="email" type="email" value="{{old('email')}}" name="email">

                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="input_text">
                                        <label for="mobile">Mobile<span>*</span></label>
                                        <input id="mobile" name="mobile" value="{{old('mobile')}}" type="text">
                                        <strong class="error">{{ $errors->first('mobile') }}</strong>
                                        <span class="error-msg  error mobileMsg"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="input_text">
                                        <label for="reff_code">Referral Code<span></span></label>
                                        <input id="reff_code" value="{{old('reff_code')}}" type="text" name="reff_code">
                                    </div>
                                </div>
                                <div class="row w-100 m-0">
                                    <div class="col-6">
                                        <div class="login_submit">
                                            <input value="Register"  type="submit">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-md-6">
                                        <div class="text-left text-right">
                                            Already have an account?<a class="text-primary" href="{{URL::to('/user-login')}}"><span>  Sign in</span></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="login-app-section">
                        <h4>DOWNLOAD THE <span> SHOPINPAGER APP</span></h4>
                        <div class="app-button">
                            <a href="">
                            <img src="{{URL::asset('public/img/play-store.png')}}" alt="">
                            </a>
                        </div>
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
		var minLength = 10;
		var maxLength = 10;
		$(document).ready(function(){
			$('#mobile').on('keydown keyup change', function(){
				var char = $(this).val();
				var charLength = $(this).val().length;
				if(charLength < minLength){
					//$('span').text('Length is short, minimum '+minLength+' required.');
				}else if(charLength > maxLength){
					//$('span').text('Length is not valid, maximum '+maxLength+' allowed.');
					$(this).val(char.substring(0, maxLength));
				}else{
					//$('span').text('Length is valid');
				}
			});
		});
	</script>
@stop

    <!--login section end-->
@endsection
    