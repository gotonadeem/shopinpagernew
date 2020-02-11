<!-- Header start -->
<div class="loader-div">
<img src="{{ URL::to('/public/assets/img/loader.gif') }}" alt="">
</div>
<header class="header sticky-header">
  <div class="container-fluid">
    <div class="header_wrapper">
      <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-3 col-5">
          <div class="logo">
            <a href="{{URL::to('/')}}">
              <img src="{{ URL::to('public/admin/img/logo.png') }}" alt="">
            </a>
          </div>

        </div>
        <div class="col-lg-5 col-md-12 text-center order-last">
          <!-- Start header_bottom_left -->
          <div class="box-category-heading mr-3">
            <div class="box-category" data-toggle="dropdown">
              <div class="title1">
                Shop By Category </div>
            </div>
            <!-- category block -->
            <div class="dropdown-menu header-category widget_product_categories">
                <div class="sidebar-category">
                  <ul id="navBarMegaNav" class="bdr-viewall">        
				    @foreach($headerCategory as $ks1=>$vs1)
                    <li class="active" <?PHP  
						          if($ks1==0):
						                 echo 'class="active"';
								   endif;
								   
						        ?>><a id="#itme{{$vs1->cat_id}}" href="">{{$vs1->cat_name}}</a></li>
                    @endforeach
                  </ul> 
                  <div class="mm-content">        
					
					@foreach($headerCategory as $vs)
					<div id="itme{{$vs->cat_id}}" class="tabbable clearfix">
                      <div class="taglist">
                        <ul class="tab-sub">
						  <?php $subCatData =Helper::get_sub_cat($vs->cat_id);?>
						   @foreach($subCatData as $ks=>$subCatVal)
                          <li  <?PHP  
						          if($ks==0):
						                 echo 'class="active"';
								   endif;
						        ?>> 
						  <a id="#subitem{{$subCatVal->cat_id}}" href="{{URL::to('category/'.$vs->cat_slug.'/'.$subCatVal->cat_slug)}}">
              {{$subCatVal->cat_name}}</a></li>						  
                           @endforeach
						</ul>
                      </div>
                      <div class="no-boxshadow">        
                          @foreach($subCatData as $subCatVal)
						<div id="subitem{{$subCatVal->cat_id}}" class="tabbable-two">
                          <ul>
                            <?php $superSubCatData =Helper::get_super_sub_category($subCatVal->cat_id);
							?>
                              @foreach($superSubCatData as $ks2=>$superSubCatVal)
								<li <?PHP  
						          if($ks2==0):
						                 echo 'class="active"';
								   endif;
								   
						        ?>><a href="{{URL::to('category/'.$vs->cat_slug.'/'.$subCatVal->cat_slug.'/'.$superSubCatVal['slug'])}}">{{$superSubCatVal['name']}}</a></li>
                               @endforeach								
                          </ul>
                        </div>
						 @endforeach
                           
                      </div>
                    </div>
					@endforeach
					
                    </div>   
                  </div>
                </div>
            <!-- end category block -->
          </div>

          <!--Search-->
          <div class="header-search">
            <div class="header-toggle"></div>
          {{ Form::open(array('url'=>'','class'=>'form-horizontal','enctype'=>'multipart/form-data','id'=>'search_submit','name'=>'add_team')) }}
              <div class="input-group product-search-widget">
                <input type="search" class="search-field display_suggestion" placeholder="Search Products…" value="" name="s" title="Search for:" autofocus>
                <input type="hidden" name="post_type" value="product">
              </div>
          </form>          

          </div>
        </div>

        <div class="col-lg-5 col-md-9 col-sm-9 col-7 text-right">
          <div class="search_box mr-3">
            <div class="search_inner" data-toggle="dropdown">
              <?php
              $citySessionVal = session('city_name'); //session('state_name')
              $cityStateSessionVal = session('city_name').' ('.session('pincode').')';
              $cityStateName = $citySessionVal ? $cityStateSessionVal : 'Select City';
              if(!empty($citySessionVal)){
                $modelHideShow = '';
                $showPopUp = '';
              }else{
                $modelHideShow = 'show';
                $showPopUp = 'active';
              }
              ?>
              <form action="#">

                <input type="text" placeholder="{{$cityStateName}}" disabled>
                <button type="submit"><i class="ion-ios-search"></i></button>
              </form>
            </div>
            <div class="dropdown-menu location_dropdown {{$modelHideShow}}">
              <h6 class="text-center">Where do you want the delivery?</h6>
              <div class="pincode-box">
                <input type="text" class="form-control onlyNumbar pincode" name="pincode" id="pincode" placeholder="Check Pincode">
                <div class="input-group-pincode">

                <button class="btn checkPinAvailability" type="button"><i class="fa fa-location-arrow" aria-hidden="true"></i><span>Check Availability</span></button>
              </div>
              </div>
              <div class="error-msg" id="error" style="display: none; color: red"></div>
              <div class="success-msg" id="success" style="display: none; color: green"></div>
              <div class="location-body">
                <div class="location_list_carousel owl-carousel shop_page">
                  <?php foreach ($availableCity as $city){ ?>
                  <div class="city-images">
                    <a href="#">
                      <?php if(!empty($city->icon)){ ?>
                      <img src="{{URL::asset('public/admin/uploads/city_icon/'.$city->icon)}}" alt="brand logo">
                        <?php } else{ ?>
                        <img src="{{URL::asset('public/admin/uploads/city_icon/default.png')}}" alt="brand logo">
                        <?php } ?>
                      <label>{{$city->name}}</label>
                    </a>
                  </div>
                    <?php } ?>
                </div>
              </div>
              
            </div>
          </div>
          <!-- end dropdown -->
          <div class="location__overlay {{$showPopUp}}"></div>
          <div class="header-middle-right text-right">
           <?php $ifChecoutPage =  Request::segment(1);
            if($ifChecoutPage !='checkout'){
            ?>
          <div class="mini-cart">
              <div class="mini_cart_inner">
                <div class="cart_icon">
                     <span class="cart_icon_inner">
                          <div class="cart-icon"></div>

                          <span class="cart_count" id="cart_count">{{$cart_count}}</span>
                        
                          </span>
                </div>
                <!--Mini Cart Box-->
                <div class="mini_cart_box cart_box_one" id="cart_header">
                  <!-- list-->
                  <?PHP
                  $sum=0;
                  $dc=0;

                  ?>
                <div class="cart-itme-list">
                @if($cart_count>0)
                    @foreach($cart_data as $vs)
                  <div class="mini_cart_item">
                    <div class="mini_cart_img">

                        <img src="{{URL::asset('public/admin/uploads/product/'.$vs->cart_image->image)}}" alt="">
                        <span class="cart_count">{{$vs->qty}}</span>

                    </div>
                    <div class="cart_info">
                      <h5><a href="product-details.html">{{$vs->product_name}}</a></h5>
                      <span class="weight"> {{$vs->weight}}</span>
                      <span class="cart_multi"> {{$vs->qty}} x {{$vs->sprice}}</span>
                      <span class="cart_price"> Rs {{$vs->qty*$vs->sprice}}</span>
                    </div>
                    <div class="cart_remove">
                      <i onclick="delete_cart(this.id)" id="{{$vs->id}}" class="zmdi zmdi-delete" ></i>

                    </div>
                  </div>
                      <?PHP
                      $sum= $sum+ ($vs->qty*$vs->sprice);
                      $dc= 0;
                      ?>
                    @endforeach
                  @else
                    <div class="empty-basket">
                      <p class="m-0">Your basket is empty. Start shopping now!</p>
                      <div class="cantinue-shopping text-center p-3">
                        <a href="" class="btn btn-submit"><i class="fa fa-angle-double-left mr-1"></i> Continue Shopping</a>
                      </div>
                    </div>
                  @endif
                        </div>
                  <div class="price_content">
                    <div class="cart_subtotals">
                      <div class="price_inline">
                        <span class="label">Subtotal </span>
                        <span class="value"> <i class="fa fa-rupee"></i>Rs {{$sum}} </span>
                      </div>

                    </div>

                  </div>
                  <div class="min_cart_checkout">
                    <a href="{{URL::to('checkout')}}">View Cart & Checkout</a>
                  </div>
                </div>
                <!--Mini Cart Box End -->
              </div>
            </div>
             <?php } ?>
           <!----Noticatcion section Start--->
               @if(Auth::check())
                   @if(Auth::user()->role_id==3)
                       <div class="notifaction dropdown" >
              <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="updateNotifyViewStatus()">
              <i class="fa fa-bell" ></i>
                  @if($userNotifyCount)
              <span id="bell_count">{{$userNotifyCount}}</span>
                  @endif
              </span>
                           <div class="dropdown-menu notifaction-list" aria-labelledby="dropdownMenuButton">
                               {{--<lable><a href="javascrip:void(0)" onclick="clearNotification()">Clear All</a></lable>--}}
                               <ul>
                                   @foreach($usernotifyData as $noti)
                                       <li class="clearfix">
                                           <span><img src="{{URL::asset('public/admin/uploads/user_notification/'.$noti->image)}}" class=""></span>
                                           <p><strong>{{$noti->title}}</strong>{{strip_tags($noti->description)}}</p>
                                       </li>
                                   @endforeach
                               </ul>
                           </div>
                       </div>
               @endif
           @endif
           <!----Noticatcion section End--->
          <!--   -->
            <div class="topbar-link mr-0">
              <?php
              if(Auth::check()){
              if(Auth::user()->role_id==2){
                  Auth::logout();
              ?>
                <script>
                  location.reload();
                </script>

              <?Php
              }else{
                if(Auth::user()->role_id==3){ ?>
                <div class="topbar-link">
                  <div class="topbar-link-toggle dropdown-toggle" data-toggle="dropdown"> {{$user_info['f_name']}}</div>
                  <div class="topbar-link-wrapper dropdown-menu menu_dropdown" role="menu">
                    <div class="header-menu-links">
                      <ul class="header-menu">
                        <li class="menu-item"><a href="{{URL::to('my-account')}}">My Account</a></li>
                        <li class="menu-item"><a href="{{URL::to('my-order')}}">My Order</a></li>
                        <li class="menu-item"><a href="{{URL::to('my-wallet')}}">My Wallet</a></li>
                        <li class="menu-item"><a href="{{URL::to('refer-earn')}}">Refer & Earn</a></li>
                        <li class="menu-item"><a href="{{URL::to('user-support')}}">Support</a></li>
                        <li class="menu-item"><a href="{{URL::to('logout')}}">Logout</a></li>
                      </ul>

                    </div>
                  </div>
                </div>
                <?php }else{ ?>
                <a href="{{URL::to('/user-login')}}">Log In</a> / <a href="{{URL::to('/register-user')}}">Sign Up</a>
                <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModel">Log In</a> / <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModel">Sign Up</a> -->
               <?php  }
                }
                      }else{ ?>
                <a href="{{URL::to('/user-login')}}">Log In</a> / <a href="{{URL::to('/register-user')}}">Sign Up</a>
                <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModel">Log In</a> / <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModel">Sign Up</a> -->
               <?php }
              ?>


            </div>
            
          </div>
        </div>


      </div>
    </div>
  </div>
</header>
<!--Header end-->
<!--Login singup popup start-->
<!-- Modal -->
<div class="login-model modal fade" id="loginModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="registration-from row">
          <div class="col-4 pr-0">
            <div class="form-left">
                        <img src="{{URL::asset('public/img/login-png.png')}}" alt="">
            </div>
          </div>
          <div class="col-md-8 col-12 pl-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Sign Up</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> 
                        <div class="alert m-0 p-0" id="regSuccessMessage">
                        </div>
                       
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
                                            <input id="login_password" placeholder="Password" name="login_password" type="password">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                      <div class="login_submit">
                                            <input class="inline" value="login" id="login_user" type="button">
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
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
						<div>
						<div id="reg_section">
                        <form action="{{URL::to('/register')}}" method="post" id="register-popup" name="register-popup">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="input_text">
                                        <label for="fname">First Name <span>*</span></label>
                                        <input id="fname" value="{{old('fname')}}" placeholder="First Name" name="fname" class="form-control" type="text">
                                        <strong class="error">{{ $errors->first('fname') }}</strong>
                                                                                
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="input_text">
                                        <label for="lname">Last Name <span>*</span></label>
                                        <input id="lname" name="lname" value="{{old('lname')}}" placeholder="Last Name" type="text">
                                        <strong class="error">{{ $errors->first('lname') }}</strong>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input_text">
                                        <label for="email">Email Address <span></span></label>
                                        <input id="user_email" type="email" value="{{old('email')}}" placeholder="Email Address" name="user_email">

                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="input_text">
                                        <label for="mobile">Mobile<span>*</span></label>
                                        <input id="mobile" name="mobile" value="{{old('mobile')}}" placeholder="Mobile" type="text">
                                        <strong class="error">{{ $errors->first('mobile') }}</strong>
                                        <span class="error-msg  error mobileMsg"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-md-6">
                                    <div class="input_text">
                                        <label for="reff_code">Referral Code<span></span></label>
                                        <input id="reff_code" value="{{old('reff_code')}}" type="text" placeholder="Referral Code" name="reff_code">
                                    </div>
                                </div>
                                <div class="row w-100 m-0">
                                    <div class="col-6">
                                        <div class="login_submit">
                                            <button value="Register" class="btn btn-submit" id="register_user_popup" name="register_user_popup"  type="button">Register</button>
                                        </div>
                                    </div>
                                    <!-- <div class="col-12">
                                        <div class="text-left text-center">
                                            Already have an account?<a class="text-primary" href="{{URL::to('/user-login')}}"><span>  Sign in</span></a>
                                        </div>
                                    </div> -->
                                </div>
								
								         

                            </div>
                        </form>
						</div>
                        
						
						<div id="otp_section">
              <h6>An OTP has been sent to your registered mobile number</h6>
							<div class="otp-text">
                <div class="form-group">
                  <label class="label d-block">Enter OTP</label>
                  <div class="d-flex">
                    <input type="number" name="otp" id="otp" class="input-text otp-number col-9" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxlength = "4" min="1" max="9999" required autofocus>
                    <button type="button" onclick="resend_otp()" class="resendotp col-3">Resend OTP</button>
                  </div>
                </div>
				       <div id="otp_msg"></div>
							</div>
							<div class="form-row-last">
								<input type="button" onclick="verify_otp()" name="register" class="verify" value="Verify">
							</div>
						</div>
										
                    </div>
              </div>
            </div>

            <div class="app-section">
              <h4>DOWNLOAD THE <span> SHOPINPAGER APP</span></h4>
              <div class="app-button">
                <a href="">
                  <img src="{{URL::asset('public/img/app-storw.png')}}" alt="">
                </a>
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
  
</div>
<!--Login singup popup End-->
<script>
    function updateNotifyViewStatus() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: BASE_URL + '/user/update-notify-view-status',
            //data: {email:semail},
            success: function (response, textStatus, jqXHR) {

                $('#bell_count').html(0);
            },
            error: function(response)
            {
                $(".loader_div").show();
            }
        });
    }
</script>