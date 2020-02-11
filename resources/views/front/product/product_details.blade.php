@extends('front.layout.front')
@section('content')
    <?php
    // echo '<pre>';print_r($product_details->slug); die('asddsff');
    $ifSchemeProduct = Helper::getIfSchemeProduct($product_details->id, $product_details->product_item[0]['id']);
    if($ifSchemeProduct ){
        $productName = $ifSchemeProduct->offer_name;
        $imageUrl = 'public/admin/uploads/scheme_product/'.$ifSchemeProduct->image;
    }else{
        $productName = $product_details->name;
        $imageUrl = 'public/admin/uploads/product/'.$all_image[0]->image;
    }
    ?>
    {{--<div class="toast" id="toast-success" data-delay="3000">--}}
        {{--Toast Header--}}
    {{--</div>--}}
    {{--<div class="toast" id="toast-error" data-delay="2000">--}}
        {{--Toast Header--}}
    {{--</div>--}}
    <div class="alert-box clearfix pl-2 pr-2">
        <div class="alert alert-success text-center " role="alert" style="display:none;">

        </div>
        <div class="alert alert-danger text-center" role="alert" style="display:none;">

        </div>
    </div>
    <!--breadcrumb area start-->
    <div class="breadcrumb_container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{URL::to('/')}}">Home ></a>
                            </li>
                            <li>Product details </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="product_id" name="product_id" value="{{$product_details->id}}">
    <input type="hidden" id="product_weight" name="product_weight" value="{{$product_details->weight}}">
    <input type="hidden" id="seller_id" name="seller_id" value="{{$product_details->user_id}}">
    <input type="hidden" id="is_return" name="is_return" value="{{$product_details->is_return}}">
    <input type="hidden" id="is_exchange" name="is_exchange" value="{{$product_details->is_exchange}}">

    <!--breadcrumb area end-->
    <!-- primary block area -->
    <div class="table_primary_block pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
				<div class="zoom-show" href="{{URL::asset($imageUrl)}}">
                    <img src="{{URL::asset($imageUrl)}}" id="show-img">
                </div>
                
                <div class="small-img">
                    <img src="{{URL::asset('public/img/online_icon_right@2x.png')}}" class="icon-left" alt="" id="prev-img">                  
                    <div class="small-container">
                    <div id="small-img-roll">
                        <?php if($ifSchemeProduct ){ ?>
                        <img src="{{URL::asset('public/admin/uploads/scheme_product/'.$ifSchemeProduct->image)}}" class="show-small-img" alt="">
                   <?php } ?>
                            @foreach($all_image as $imgg)
				   <img src="{{URL::asset('public/admin/uploads/product/'.$imgg->image)}}" class="show-small-img" alt="">
				    @endforeach 
                    </div>
                    </div>
                    
                    <img src="{{URL::asset('public/img/online_icon_right@2x.png')}}" class="icon-right" alt="" id="next-img">
                </div>

                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="product__details_content">
                        <div class="demo_product">
                            <h2>{{$productName}} <p class="product-availability">
                                    <?php if($product_details->product_item[0]['qty'] == 0){
                                        $outOfstockHide = 'block';
                                        $instockHide = 'none';
                                    }else{
                                        $outOfstockHide = 'none';
                                        $instockHide = 'block';
                                    } ?>
                                        <span class="out-of-stock out-of-stock-ajax m-0 in-out-stock" style="display:{{$outOfstockHide}};color: red"> OUT OF STOCK </span>
                                    <span class="in-out-stock" id="availability" style="display:{{$instockHide}};"> <i class="zmdi zmdi-check"></i>In stock</span>
                                </p>
                            </h2>
                            <p>{{$product_details->brand ?$product_details->brand->name:''}}</p>
                        </div>
                        
                        <div class="current_price">
                            <span class="old-price"><i class="fa fa-rupee"></i> <span class="set-sprice">{{$product_details->product_item[0]['sprice']}}</span></span>
                            <del class="text-danger"><i class="fa fa-rupee"></i> <span class="set-price">{{$product_details->product_item[0]['price']}}</span></del>
                        <small class="off-discont set-offer">{{$product_details->product_item[0]['offer']}} <i class="fa fa-rupee"></i> OFF</small>
                        </div>
                        
                        <div class="product_information">
                            <h5 class="title-seller seller-name"> Seller: <?php Helper::getSellerName($product_details->user_id); ?></h5>
                            <?php
                            $defaultSellerItem = Helper::getProductItemBySellerId($product_details->id,$product_details->user_id);
                            $sellerList = Helper::getDuplicateSeller($product_details->id);
                            $sellerCount = count($sellerList) +1 ;
                            if($sellerCount > 1){
                                ?>
                            <div class="select-type">
                                <div class="select-title" data-toggle="collapse" data-target="#select-type">
                                    <h4> ({{$sellerCount}}) Seller Available</h4>
                                </div>
                                <div id="select-type" class="select-box-content collapse">
                                    <ul>
                                        @foreach($sellerList as $vs)
                                            <?php $relatedSeller = Helper::getProductItemBySellerId($product_details->id, $vs->get_seller->id); ?>
                                            <li><input type="radio" class="get-product-item" name="seller_id" value="{{$vs->get_seller->id}}"><label></label><span>{{$vs->get_seller->username}} <b>({{$relatedSeller[0]['weight']}} - RS {{$relatedSeller[0]['sprice']}}) </b></span></li>
                                        @endforeach
                                        <li><input type="radio" class="get-product-item" name="seller_id" value="{{$product_details->user_name->id}}" checked><label></label><span>{{$product_details->user_name->username}} <b>({{$defaultSellerItem[0]['weight']}} - RS {{$defaultSellerItem[0]['sprice']}}) </b></span></li>
                                    </ul>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <input type="radio" class="get-product-item" name="seller_id" value="{{$product_details->user_name->id}}" checked style="display: none;">
                            <?php } ?>
                            <div class="product_variants">
                                <div class="product_variant_list">
                                    <div class="product_variants_item variants_product">
                                        <span class="control_label">Select pack size:</span>
                                        <input type="hidden" value="{{$product_details->id}}" class="product_id" data-id="{{$product_details->id}}">
                                        <?php $productItem = Helper::getProductItemBySellerId($product_details->id,$product_details->user_id);
                                        $itemQty = $productItem[0]['qty'];
                                        ?>
                                        <select name="item-size" class="custom-select change-product-price item item-dropdowm-list">
                                            @foreach($productItem as $vs)
                                                <option value="{{$vs->id}}">{{$vs->weight}} - RS {{$vs->sprice}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="quickview_plus_minus">
                                    <div class="quickview_plus_minus_inner">

                                        <div class="label-text"><span>QTY:</span></div>
                                        <div class="input-group input-group-custom">
                                             <span class="input-group-btn">
                                              <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="">
                                                  <i class="fa fa-minus" aria-hidden="true"></i>
                                              </button>
                                              </span>
                                                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100" readonly>
                                              <span class="input-group-btn">
                                              <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="">
                                                  <i class="fa fa-plus" aria-hidden="true"></i>
                                              </button>
                                              </span>

                                        </div>
                                        <?php if($itemQty == 0) {
                                            $hide = 'none';
                                        }else{
                                            $hide = 'block';
                                        } ?>
                                        <span class="stock-error error" style="display: none"></span>
                                        <div class="add_button addcart in-out-stock" style="display:{{$hide}}">
                                            <button  onclick="add_to_cart()" id="add_to_cart"> Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                               


                            </div>
                        </div>
                    </div>
                    <div class="rating product-rating">
                        <?php  $avgRating = Helper::get_rating($product_details->id);
                        $starNumber = $avgRating['average'];
                        for( $x = 0; $x < 5; $x++ )
                        {
                            if( floor( $starNumber )-$x >= 1 )
                            { echo '<i class="fa fa-star"></i>'; }
                            elseif( $starNumber-$x > 0 )
                            { echo '<i class="fa fa-star-half-o"></i>'; }
                            else
                            { echo '<i class="fa fa-star-o"></i>'; }

                        }

                        ?>
                        <small>{{$starNumber}}</small>
                    </div>
                        <!-- product page tab -->

                        <div class="product_page_tab">
                            <div class="product_tab_button">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li>
                                        <a class=" tav_past active" id="home-tab" data-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="true">Description</a>
                                    </li>
                                    <!-- <li>
                                        <a class=" tav_past" id="profile-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Information</a>
                                    </li> -->
                                {{-- <li>
                                        <a class=" tav_past" id="contact-tab" data-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews</a>
                                    </li>--}}
                                </ul>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="Description" role="tabpanel">
                                    <div class="product-description pt-3">
                                        <?php echo $product_details->description; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- product page tab end -->
                </div>
            </div>
        </div>
    </div>
    <!-- primary block end -->



    <!--Features product area-->
    <div class="features_product mt-4">
        <div class="container-fluid">
            <div class="section_title text-left">
                <h3> Related Product </h3>
            </div>
            <!--Relaetd Product Details -->
            <div class="row">
            <div class="features_product_active owl-carousel">
            <?php
            if(!empty($product_details->related_product) and ($product_details->related_product !='null')){

            $relatedId = explode(',',$product_details->related_product); ?>
            @foreach ($relatedId as $id)
                <?php $relatedProduct =  Helper::getRelatedProduct($id);
                if($relatedProduct){
                ?>
            <div class="col-lg-2">
                <a href="{{URL::to('product/'.$relatedProduct->slug)}}">
                    <div class="single__product">
                        <div class="single_product__inner">
                            <div class="product_img">

                                <img src="{{URL::asset('public/admin/uploads/product/'.$relatedProduct->image)}}" alt="">

                            </div>
                            <div class="product__content text-center">
                                <div class="produc_desc_info">
                                    <div class="product_title">
                                        <h4>{{$relatedProduct->name}}</h4>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
            @endforeach

                  <?php  } ?>

                  </div>

            </div>
        </div>
    </div>
    <!--Features product end-->
    <section class="product-review my-5">
        <div class="container-fluid">
            <div class="section_title text-left">
                <h3> Customer Review</h3>
            </div>
            <div class="review-list">
                <?php $ratingData = Helper::getProductAllRating($product_details->id);?>
                @foreach($ratingData as $ratng)
                    <div class="review">

                        <h5>{{$ratng->user->username}}</h5>
                        <p class="rating">
                            <?php for($i=1;$i<=5;$i++){
                            if ($i <= $ratng->rating){?>
                            <i class="fa fa-star active"></i>
                            <?php }else{ ?>
                            <i class="fa fa-star "></i>
                            <?php    }
                            }?>

                        </p>
                        <p class="review-dis">
                            {{$ratng->message}}
                        </p>
                        <span> {{$ratng->created_at}}</span>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@section('scripts')
    <script>
        function getSellerName(sellerId) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: BASE_URL+'/get-seller-name',
                type: 'POST',
                data: {sellerId: sellerId },
                success: function (data) {
                    response=JSON.parse(data);
                    if(response.status) {
                        var sellerName = response.seller_name;
                        $('.seller-name').text('Seller Name: '+sellerName);
                    }

                },
                error: function () {
                    console.log('There is some error to get seller name. Please try again.');
                }
            });
        }
        $(document).on('change','.get-product-item', function () {
            var sellerId = $(this).val();
            getSellerName(sellerId);
            $('#quantity').val(1);
            $('.stock-error').hide();
            var productId = $('#product_id').val();
            $(".loader-div").show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: BASE_URL+'/get-item-list',
                type: 'POST',
                data: {sellerId: sellerId, productId:productId },
                success: function (data) {
                    $('.item-dropdowm-list').html(data);
                    var priceId = $(".item-dropdowm-list option:selected").val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: BASE_URL+'/get-product-price',
                        type: 'POST',
                        data: {priceId: priceId },
                        success: function (data) {
                            response=JSON.parse(data);
                            if(response.status){
                                var productOffer = response.offer;
                                var productPrice = response.price;
                                var productSprice = response.sprice;
                                var productSchemeName = response.scheme_name;
                                var productImagePath = response.image_path;
                                var itemQty = response.qty;
                                if(itemQty == 0){
                                    $('.in-out-stock').hide();
                                    $('.out-of-stock-ajax').show();
                                }else {
                                    $('.in-out-stock').show();
                                    $('.out-of-stock-ajax').hide();
                                }
                                $('.set-offer').text(productOffer+' OFF');
                                $('.set-price').text(productPrice);
                                $('.set-sprice').text(productSprice);
                                $('.product-name').text(productSchemeName);
                                $('.product-image').prop('src', productImagePath);
                                $('div.main-image > img').remove();
                                $('.main-image').append("<img  src="+productImagePath+" />");
                                console.log(productSchemeName);
                                $('.select-box-content').removeClass('show');
                                //$("#success").html(response.message).show();
                            }else{
                                $("#error").html(response.message).show();
                            }
                        },
                        error: function () {
                            console.log('There is some error. Please try again.');
                        }
                    });
                    $(".loader-div").hide();
                },
                error: function () {
                    console.log('There is some error to get item. Please try again.');
                }
            });
        });
        $(document).on('change','.change-product-price', function () {
            $(".loader-div").show();
            var priceId = $(this).val();
            $('#quantity').val(1);
            $('.stock-error').hide();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: BASE_URL+'/get-product-price',
                type: 'POST',
                data: {priceId: priceId },
                success: function (data) {

                    response=JSON.parse(data);
                    if(response.status){
                        var productOffer = response.offer;
                        var productPrice = response.price;
                        var productSprice = response.sprice;
                        var productSchemeName = response.scheme_name;
                        var productImagePath = response.image_path;
                        var itemQty = response.qty;
                        if(itemQty == 0){
                            $('.in-out-stock').hide();
                            $('.out-of-stock-ajax').show();
                        }else {
                            $('.in-out-stock').show();
                            $('.out-of-stock-ajax').hide();
                        }

                        $('.set-offer').text(productOffer+' OFF');
                        $('.set-price').text(productPrice);
                        $('.set-sprice').text(productSprice);
                        $('.product-name').text(productSchemeName);
                        $('.product-image').prop('src', productImagePath);
                        $('div.main-image > img').remove();
                        $('.main-image').append("<img  src="+productImagePath+" />");
                        console.log(productSchemeName);
                        $(".loader-div").hide();
                        //$("#success").html(response.message).show();
                    }else{
                        $("#error").html(response.message).show();
                    }
                },
                error: function () {
                    console.log('There is some error. Please try again.');
                }
            });
        })
    </script>
    <script>

        $('#sliderItem').ubislider({
            arrowsToggle: true,
            type: 'ecommerce',
            hideArrows: false,
            autoSlideOnLastClick: true,
            modalOnClick: true,
            position: 'vertical',onTopImageChange: function(){
                $('#sliderItemZoom img').elevateZoom();
            }
        });

    </script>

    <!-- <script>
$(document).ready(function(){
  $("#ham").click(function(){
    $("#ham").toggleClass("color");
  });
});
</script> --> 
<script>
$('.sub-menu ul').show();
$(".sub-menu a").click(function () {
  $(this).parent(".sub-menu").children("ul").slideToggle("100");
  $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});
</script> 
<script>
    function checkItemStock(itemId,quantity) {
        $(".loader-div").show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: BASE_URL+'/check-item-stock',
            type: 'POST',
            data: {itemId: itemId, quantity:quantity},
            success: function (data) {
                response=JSON.parse(data);
                if(response.status == 1) {
                    $('#quantity').val(quantity);
                }else if(response.status == 2){
                    $('.stock-error').html('Out of stock.').show();
                }else if(response.status == 3){
                    $('.stock-error').html('Only '+(quantity-1)+' items available in stock.').show();
                }
                $(".loader-div").hide();
            },
            error: function () {
                console.log('There is some error to get seller name. Please try again.');
            }
        });
    }
$(document).ready(function(){
var quantitiy=1;
   $('.quantity-right-plus').click(function(e){
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
       var itemId = $(".item-dropdowm-list option:selected").val();
       checkItemStock(itemId,quantity+1);

    });
     $('.quantity-left-minus').click(function(e){
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        if(quantity>1){
            $('#quantity').val(quantity - 1);
            $('.stock-error').hide();
        }
    });
});

 </script>
 
 <script>

$('.wishlist').click(function(){
  $(this).toggleClass('fa-heart-o fa-heart');
});

</script>
    <script src="{{ asset('public/js/share.js') }}"></script>
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({appId: '2928389843902996', status: true, cookie: true,
                xfbml: true});
        };
        (function() {
            var e = document.createElement('script'); e.async = true;
            e.src = document.location.protocol +
                    '//connect.facebook.net/en_US/all.js';
            document.getElementById('fb-root').appendChild(e);
        }());
    </script>
    <script>
        $(document).ready(function(){
            $('#share_button').click(function(e){
                e.preventDefault();
                FB.ui(
                        {
                            method: 'feed',
                            name: $(".produt-title").text(),
                            link: '{{URL::to("product/".$product_details->slug)}}',
                            picture: "{{ URL::asset('public/admin/uploads/product/'.$product_details->product_image[0]->image)}}",
                            caption: $(".produt-title").text(),
                            description: "{{substr($product_details->description,0,10)}}",
                            message: ""
                        });
            });
        });
    </script>
 @stop
 <style>
  .product-slider #show-img{ width:100% }
 </style>
@endsection