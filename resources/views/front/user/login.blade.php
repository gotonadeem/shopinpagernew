    @extends('front.layout.front')
    @section('content')
        <!--login section start-->
        <div class="page_login_section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1">
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
                        <div class="login_page_form">
                            <form action="{{URL::to('/login-user')}}" method="post" id="login-form" name="login-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input_text">
                                            <label for="login_mobile">Mobile <span>*</span></label>
                                            <input id="login_mobile" name="login_mobile" placeholder="Enter Mobile Number" value="{{old('login_mobile')}}" type="number">
                                            <strong class="error">{{ $errors->first('login_mobile') }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input_text">
                                            <label for="login_password">Passwords <span>*</span></label>
                                            <input id="login_password" name="login_password" type="password">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                      <div class="login_submit">
                                            <input class="inline" value="login" type="submit">
                                      </div>
                                    </div>
                                    <div class="col-6" style="margin-top: 10px;">
                                        <div class="input_text text-right">
                                            <a class="text-primary" href="{{URL::to('/reset-password')}}"><span>Reset password?</span> </a>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="login-social">
                                  <label>Login with : </label> <a href="{{URL::to('facebook-login-test')}}"><i class="fa fa-facebook"></i></a> <a href="{{URL::to('google-login-now')}}"><i class="fa fa-google-plus"></i></a>
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
        </div>

    @section('scripts')
        <script language="javascript" src="{{ URL::asset('public/js/validation/jquery.validate.min.js') }}"></script>
        <script language="javascript" src="{{ URL::asset('public/js/validation/additional-methods.min.js') }}"></script>
        <script language="javascript" src="{{ URL::asset('public/js/developer/user_login.js') }}"></script>
    <script>
		var minLength = 10;
		var maxLength = 10;
		$(document).ready(function(){
			$('#login_mobile').on('keydown keyup change', function(){
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
    @endsection
        <!--login section end-->

        <!--organicfood wrapper start-->
       