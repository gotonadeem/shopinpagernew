<!-- footer start -->
<footer class="footer pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="footer_menu_list d-flex justify-content-between">
                    <!--Single Footer-->
                    <div class="single_footer widget">
                        <div class="single_footer_widget_inner">
                            <div class="footer_title">
                                <h2>Products</h2>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="{{URL::to('/about-us')}}">About us</a></li>
                                    <li><a href="{{URL::to('/privacy-policy')}}"> Privacy Policy</a></li>
                                    <li><a href="{{URL::to('/terms-condition')}}"> Terms and Conditions</a></li>
                                    <li><a href="{{URL::to('/cancelation-returns')}}"> Cancellations and Returns</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Single footer end-->
                    <!--Single footer start-->
                    <div class="single_footer widget">
                        <div class="single_footer_widget_inner">
                            <div class="footer_title">
                                <h2>Help</h2>
                            </div>
                            <div class="footer_menu">
                                <ul>
                                    <li><a href="{{URL::to('/faq')}}">FAQs</a></li>
                                    <li><a href="{{URL::to('/contact-us')}}"> Contact US</a></li>
                                    <li><a href="{{URL::to('/shipping-delivery')}}"> Shipping & Delivery</a></li>
                                    <li><a href="{{ URL::to('public/sitemap.xml') }}">Sitemap</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-xs-12">
                <div class="footer_title">
                    <h2> Join Our Newsletter Now </h2>
                </div>
                <div class="footer_news_letter">
                    <p>Get E-mail updates about our latest shop and special offers.</p>
                    <div class="newsletter_form">
                            
                            <input type="email" name="semail" id="semail" placeholder="Your Email Address">
                            <div id="emsg"></div>
                            <div id="ssmsg"></div>
                            <input type="submit" onclick="subscribe()" value="Subscribe">

                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-12 col-xs-12">
            <div class="footer_title">
                    <h2> Get in Touch </h2>
                </div>
                <div class="footer_social_icon">
                    <a href="{{URL::to('https://twitter.com/shopinpager')}}"><i class="fa fa-twitter"></i></a>
                    <a href="{{URL::to('https://www.linkedin.com/company/shopinpager')}}"><i class="fa fa-linkedin"></i></a>
                    <a href="{{URL::to('https://www.facebook.com/shopinpager')}}"><i class="fa fa-facebook"></i></a>
                    <a href="{{URL::to('https://www.instagram.com/shopinpager/')}}"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7">
                    <div class="copyright_text text-left">
                        <p>Copyright 2019 <a href="{{URL::to('/')}}">Shopinpager</a>. All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-sm-5">
                <div class="become-seller text-right">
                    <a href="{{URL::to('/join-as-seller')}}"> 
                    <button class="btn"><i class="fa fa-user-o"></i> Join us as seller</button>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>

</footer>
</html>
<!-- footer end -->

<!-- modal area start -->
<!-- <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body shop">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <div class="product-flags madal">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="imgeone" role="tabpanel">
                                        <div class="product_tab_img">
                                            <a href="#"><img src="assets/img/cart/nav12.jpg" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="imgetwo" role="tabpanel">
                                        <div class="product_tab_img">
                                            <a href="#"><img src="assets/img/cart/nav11.jpg" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="imgethree" role="tabpanel">
                                        <div class="product_tab_img">
                                            <a href="#"><img src="assets/img/cart/nav13.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="products_tab_button  modals">
                                    <ul class="nav product_navactive" role="tablist">
                                        <li>
                                            <a class="nav-link active" data-toggle="tab" href="#imgeone" role="tab" aria-controls="imgeone" aria-selected="false"><img src="assets/img/cart/nav.jpg" alt=""></a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="tab" href="#imgetwo" role="tab" aria-controls="imgetwo" aria-selected="false"><img src="assets/img/cart/nav1.jpg" alt=""></a>
                                        </li>
                                        <li>
                                            <a class="nav-link button_three" data-toggle="tab" href="#imgethree" role="tab" aria-controls="imgethree" aria-selected="false"><img src="assets/img/cart/nav2.jpg" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <div class="modal_right">
                                <div class="shop_reviews">
                                    <div class="demo_product">
                                        <h2>Sprite Yoga Straps1</h2>
                                    </div>
                                    <div class="current_price">
                                        <span class="regular"><i class="fa fa-rupee"></i>64.99</span>
                                        <span class="regular_price"><i class="fa fa-rupee"></i>78.99</span>
                                    </div>
                                    <div class="product_information product_modal">
                                        <div id="product_modal_content">
                                            <p>Short-sleeved blouse with feminine draped sleeve detail.</p>
                                        </div>
                                        <div class="product_variants">
                                            <div class="product_variants_item modal_item">
                                                <span class="control_label">Size</span>
                                                <select id="group_1">
                                                    <option value="1">S</option>
                                                    <option value="2" selected="selected">M</option>
                                                    <option value="3">L</option>
                                                </select>
                                            </div>

                                            <div class="quickview_plus_minus">
                                                <span class="control_label">Quantity</span>
                                                <div class="quickview_plus_minus_inner">
                                                    <div class="cart-plus-minus">
                                                        <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                                    </div>
                                                    <div class="add_button add_modal">
                                                        <button type="submit"> Add to cart</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="cart_description">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="social-share">
                                <h3>Share this product</h3>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 -->

<!-- modal area end -->
<script>
    BASE_URL="{{URL::to('/')}}";
</script>
<!-- all js here -->

<script src="{{ URL::asset('public/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{URL::asset('public/js/jquery.min.js')}}"></script>
<script src="{{ URL::asset('public/js/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('public/js/price_range_script.js') }}"></script>
<script src="{{ URL::asset('public/js/popper.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap.min.js') }}"></script>

<script src="{{ URL::asset('public/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{ URL::asset('public/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('public/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('public/js/jquery.counterup.min.js') }}"></script>
<script src="{{ URL::asset('public/js/waypoints.min.js') }}"></script>
<script src="{{ URL::asset('public/js/ajax-mail.js') }}"></script>
<script src="{{ URL::asset('public/js/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('public/js/zoom-image.js') }}"></script>
<script src="{{ URL::asset('public/js/zoom-main.js') }}"></script>
<script src="{{ URL::asset('public/js/plugins.js') }}"></script>
<script src="{{ URL::asset('public/js/main.js') }}"></script>
<script src="{{ URL::asset('public/js/custom.js') }}"></script>
<script language="javascript" src="{{ URL::asset('public/js/validation/jquery.validate.min.js') }}"></script>
<script language="javascript" src="{{ URL::asset('public/js/validation/additional-methods.min.js') }}"></script>
<script language="javascript" src="{{ URL::asset('public/js/developer/search.js') }}"></script>
<script language="javascript" src="{{ URL::asset('public/front/developer/js/page_js/user_login.js') }}"></script>
<script language="javascript" src="{{ URL::asset('public/front/developer/js/page_js/user_signup.js') }}"></script>
<script language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/jqueryElevateZoom.js') }}"></script>

<script src="{{ URL::asset('public/js/developer/cart.js') }}"></script>
<script src="{{ URL::asset('public/js/bootstrap-datepicker.js') }}"></script>
<!-- <script src="{{ URL::asset('public/js/zoomsl.js') }}"></script> -->
<!-- Compiled and minified JavaScript -->

<script>

</script>

<script type="text/javascript">
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    function subscribe()
    {

        var semail= $("#semail").val();
        if(semail=="" || isEmail(semail)==false)
        {
            $("#emsg").text("Enter valid email address").css('color','red');
        }
        else
        {
            $("#emsg").html("");
            $(".loader-div").show();
            $("#smsg").text("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: BASE_URL + '/subscribe',
                data: {email:semail},
                success: function (response, textStatus, jqXHR) {
                    $(".loader-div").hide();
                    var data= JSON.parse(response);
                    if(data.status)
                    {
                        $("#ssmsg").show();
                        $("#ssmsg").text(data.message).css('color','green');
                        $("#semail").val('');
                        setTimeout(function(){
                            $("#ssmsg").hide();
                            $(".loader-div").hide();
                        },2000);
                    }
                    else
                    {
                        $("#smsg").text(data.message);
                    }
                },
                error: function(response)
                {
                    //$(".loader_div").show();
                }
            });
        }
    }
</script>

<script>
    function openNav() {
        document.getElementById("collapsibleNavbars").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("collapsibleNavbars").style.width = "0%";
    }

</script>

<script type="text/javascript">
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<script>
    function maxLengthCheck(object) {
        if (object.value.length > object.maxLength)
            object.value = object.value.slice(0, object.maxLength)
    }
    function isNumeric (evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode (key);
        var regex = /[0-9]|\./;
        if ( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>

<script>
    $( function() {
        $( "#datepicker-dob" ).datepicker();
    } );

    $( ".show-toast" ).click(function() {
        $('#toast-error').toast('show').html('Please login first.');
    });
</script>

<script>

    $(function () {
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

<script>
    $('.location-carousel').owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    })
</script>
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
	
  <script>
  $("document").ready(function() {
    $('.dropdown-menu').on('click', function(e) {
      if($(this).hasClass('location_dropdown')) {
        e.stopPropagation();
      }
      if($(this).hasClass('menu_dropdown')) {
        e.stopPropagation();
      }
    });
  });
</script>
<script>
    $('#product_navactive').owlCarousel({
        loop:false,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    })
</script>
@if(session('pincode'))
	@if(!Auth::check())
	<script> 
		$(window).load(function(){        
		$('#loginModel').modal('show');
		}); 
		
		$('#loginModel').modal({
			backdrop: 'static',
			keyboard: false
		})
	</script>
   @endif
@endif
<Script>
	$(document).ready(function($) {
		$("#navBarMegaNav li").hover(function() {
			$(".tabbable").hide();
			$("#navBarMegaNav li").removeClass('active');					
			$(this).addClass("active");					
			var selected_tab = $(this).find("a").attr("id");
			$(selected_tab).show();
			return false;
		});
        $(".tab-sub li").hover(function() {
			$(".tabbable-two").hide();
			$(".tab-sub li").removeClass('active');					
			$(this).addClass("active");					
			var selected_tab = $(this).find("a").attr("id");
			$(selected_tab).show();
			return false;
		});

	});

</script>