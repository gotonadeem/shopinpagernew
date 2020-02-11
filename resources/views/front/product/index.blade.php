@extends('front.layout.front')
@section('content')
    <div class="alert-box clearfix pl-2 pr-2">
        <div class="alert alert-success text-center " role="alert" style="display:none;">

        </div>
        <div class="alert alert-danger text-center" role="alert" style="display:none;">

        </div>
    </div>
    <section class="breadcrumb_container">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <nav>
                        <ul>
                            <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                            <li class="breadcrumb-item">{{$catData['name']}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="organic_food_wrapper">
        <div class="shop_wrapper pt-4 pb-4">
        <div class="container-fluid">
            <div class="categories_banner">
                <div class="categories_banner_inner">
                  <?php $img = empty($catData->banner_img)? '' : $catData->banner_img  ?>
                  @if($img)
                      <img src="{{ URL::asset('/public/admin/uploads/category/banner/'.$img) }}"> 
                  @else
                      <img src="{{URL::asset('public/images/grocerybanner.jpg')}}" >                      
                  @endif
                </div>
                <h3>{{$catData['name']}}</h3>
            </div>
            <div class="row">
                <div class="col-lg-3 col-12">
                    @include('front.product.filter')
                </div>
                <div class="col-lg-9 col-12">


                    <div class="product-list-sec">
                        <div class="product-listing" id="product_listing">
                            <div class="row">
                                <!-- Category Product List -->
                                <?php $catProduct = Helper::getProductByCat($catId,$subCatId,$sup_sub_category); ?>
                                @foreach($catProduct as $pList)
                                    <?php $getProductPriceData = Helper::getProductItemBySellerId($pList->id,$pList->user_id);
                                        if(!empty($getProductPriceData)){
                                        $ifSchemeProduct = Helper::getIfSchemeProduct($pList->id, $getProductPriceData[0]['id']);
                                    }
                                    ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                    <div class="single__product" >
                                        <div class="single_product__inner" id="list-div-{{$pList->id}}">
                                            <?php
                                            if($getProductPriceData[0]['qty'] == 0){
                                                $stockHide = 'block';
                                            }else{
                                                $stockHide = 'none';
                                            } ?>
                                        <div class="out-stock-item out-stock-item-ajax-{{$pList->id}}" style="display:{{$stockHide}};">
                                            <span class="error"> OUT OF STOCK </span>
                                        </div>
                                        <a href="{{URL::to('product/'.$pList->slug)}}">
                                            <?php if($ifSchemeProduct ){
                                                $productName = $ifSchemeProduct->offer_name;
                                                $imageUrl = 'public/admin/uploads/scheme_product/'.$ifSchemeProduct->image;
                                            }else{
                                                $productName = $pList->name;
                                                $imageUrl = 'public/admin/uploads/product/'.$pList->image;
                                            }
                                                //if offer > 0
                                            if($getProductPriceData[0]['offer'] > 0){
                                                $offerClass = 'off-discont';
                                                $offer = $getProductPriceData[0]['offer'].'&nbsp;OFF';
                                            }else{
                                                $offerClass = '';
                                                $offer = '';
                                            }
                                            ?>
                                            <div class="img-content"> <img src="{{URL::asset($imageUrl)}}" class="img-fluid product-image-{{$pList->id}}">
                                                <span class="{{$offerClass}} set-offer-{{$pList->id}}">{{$offer}}</span>
                                            </div>
                                        </a>
                                        <div class="product__content">
                                            <div class="produc_desc_info">
                                                <div class="product_title">
                                                    <h4 class="product-name-{{$pList->id}}">
                                                        <a href="{{URL::to('product/'.$pList->slug)}}">{{$productName}}</a>
                                                    </h4>
                                                </div>
                                                <div class="brand">{{$pList->brand_name ? $pList->brand_name : ''}}</div>
                                                
                                                <div class="product_price">
                                                    <p>
                                                    <span class="new-price ">
                                                        <i class="fa fa-rupee"></i>
                                                        <span class="set-sprice-{{$pList->id}}">{{$getProductPriceData[0]['sprice']}}</span>
                                                    </span>
                                                    <del class="old-price text-danger ">
                                                            <i class="fa fa-rupee"></i>
                                                            <span class="set-price-{{$pList->id}}">{{$getProductPriceData[0]['price']}}</span></del>
                                                    </p>
                                                </div>

                                            </div>
                                            
                                            
                                            
                                            <div class="custom-select-size">

                                                <?php   $productSeller = Helper::getProductSellerName($pList->id);
                                                        $sellerList = Helper::getDuplicateSeller($pList->id); ?>
                                                <input type="hidden" value="{{$pList->id}}" class="product_id_item" data-id="{{$pList->id}}">
                                                <select name="seller_id" class="custom-select  get-seller-id-{{$pList->id}} get-product-item">
                                                    <option value="{{$productSeller->user_name->id}}">{{$productSeller->user_name->username}} </option>
                                                    @foreach($sellerList as $vs)
                                                    <option value="{{$vs->get_seller->id}}">{{$vs->get_seller->username}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                <div class="custom-select-size">
                                                    <input type="hidden" value="{{$pList->id}}" class="product_id" data-id="{{$pList->id}}">
                                                    <select name="item-size" class="custom-select change-product-price get-item-id-{{$pList->id}} item-dropdowm-list-{{$pList->id}}">
                                                        @foreach($getProductPriceData as $vs)
                                                        <option value="{{$vs->id}}">{{$vs->weight}} - RS {{$vs->sprice}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--<div class="delivery-date"><i class="fa fa-truck" aria-hidden="true"></i>Standard Delivery: Tomorrow Morning</div>-->
                                                <span class="stock-error-{{$pList->id}} error" style="display: none"></span>
                                                <div class="d-flex justify-content-between align-items-center addto-cart">
                                                <div class="input-group input-group-custom">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-left-minus btn btn-number"  data-type="minus" data-field="" data-id="{{$pList->id}}">
                                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                                    </button>
                                                    </span>
                                                    <input type="text" id="quantity-{{$pList->id}}" name="quantity" class="form-control input-number" value="1" min="1" max="100" readonly>
                                                    <span class="input-group-btn">
                                                    <button type="button" class="quantity-right-plus btn btn-number" data-type="plus" data-field="" data-id="{{$pList->id}}">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                    </button>
                                                    </span>
                                                </div>
                                                <input type="hidden" id="is-return-{{$pList->id}}" name="is_return" value="{{$pList->is_return}}">
                                                <input type="hidden" id="is-exchange-{{$pList->id}}" name="is_exchange" value="{{$pList->is_exchange}}">
                                                <?php
                                                if($getProductPriceData[0]['qty'] == 0){
                                                    $cartHide = 'none';
                                                }else{
                                                    $cartHide = 'block';
                                                } ?>
                                                <button class="btn custom-btn in-out-stock-{{$pList->id}}" onclick="listing_product_add_to_cart({{$pList->id}})" id="add_to_cart" style="display: {{$cartHide}}">
                                            <i class="fa fa-shopping-cart"></i> Add</button>
                                            </div>
                                            
                                        </div>
                                        
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                                <!-- End Category Product List -->


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
       
    </section>
@section('scripts')
  
  <script>
      var cat_url="{{Request::segment(2)}}";
      var s_cat_url="{{Request::segment(3)}}";
$('.sub-menu ul').show();
$(".sub-menu a").click(function () {
  $(this).parent(".sub-menu").children("ul").slideToggle("100");
  $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});


</script>
<script src="{{ URL::asset('public/js/jquery-ui.min.js') }}"></script>
<script src="{{URL::asset('public/js/developer/filter.js')}}"></script>
<script>

$('.wishlist').click(function(){
  $(this).toggleClass('fa-heart-o fa-heart');
});
//window.history.pushState("Details", "Title", "yourNewPage");
</script>
<script>
    $( document ).ready(function() {
        console.log( "ready!" );
    });
</script>
  <script>
      function checkItemStock(productId,itemId,quantity) {
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
                  if(response.status ==1) {
                      $('#quantity-'+productId).val(quantity);
                  }else if(response.status == 2) {
                      $('.stock-error-'+productId).html('Out of stock.').show();
                  }else if(response.status == 3){
                      $('.stock-error-'+productId).html('Only '+(quantity-1)+' items available in stock.').show();
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
              var productId =  $(this).data("id");
              e.preventDefault();
              var quantity = parseInt($('#quantity-'+productId).val());
              var itemId = $(".item-dropdowm-list-"+productId+" option:selected").val();
              checkItemStock(productId,itemId,quantity+1);

          });
          $('.quantity-left-minus').click(function(e){
              var productId =  $(this).data("id");
              e.preventDefault();
              var quantity = parseInt($('#quantity-'+productId).val());
              if(quantity>1){
                  $('#quantity-'+productId).val(quantity - 1);
                  $('.stock-error-'+productId).hide();
              }
          });
      });

  </script>
    <script>
        $(document).on('change','.get-product-item', function () {
            var sellerId = $(this).val();
            var productId =  $(this).closest("div").find(".product_id_item").val();
            $('.stock-error-'+productId).hide();
            $('#quantity-'+productId).val(1);
            $(".loader-div").show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: BASE_URL+'/get-item-list',
                type: 'POST',
                data: {sellerId: sellerId, productId:productId },
                success: function (data) {
                    $('.item-dropdowm-list-'+productId).html(data);
                    var priceId = $(".item-dropdowm-list-"+productId+" option:selected").val();
                    //To get product item data.....
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
                                if(productOffer == 0){
                                    $('.set-offer-'+productId).text('').removeClass( "off-discont" );
                                }else {
                                    $('.set-offer-'+productId).text(productOffer+' OFF').addClass( "off-discont" );
                                }
                                var itemQty = response.qty;
                                if(itemQty == 0){
                                    $('.in-out-stock-'+productId).hide();
                                    $('#list-div-'+productId+' > div:eq(0)').css("display", "block");
                                }else {
                                    $('.in-out-stock-'+productId).show();
                                    $('#list-div-'+productId+' > div:eq(0)').css("display", "none");
                                }
                                $('.set-price-'+productId).text(productPrice);
                                $('.set-sprice-'+productId).text(productSprice);
                                $('.product-name-'+productId).text(productSchemeName);
                                if(productImagePath){
                                    $('.product-image-'+productId).prop('src', productImagePath);
                                }

                                //$("#success").html(response.message).show();
                            }else{
                                $("#error").html(response.message).show();
                            }
                        },
                        error: function () {
                            console.log('There is some error in user deleting. Please try again.');
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
            $(".loader-div").hide();
            var priceId = $(this).val();
            $('.stock-error-'+productId).hide();
            $('#quantity-'+productId).val(1);
            var productId =  $(this).closest("div").find(".product_id").val();

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
                        if(productOffer == 0){
                            $('.set-offer-'+productId).text('').removeClass( "off-discont" );
                        }else {
                            $('.set-offer-'+productId).text(productOffer+' OFF').addClass( "off-discont" );
                        }
                        var itemQty = response.qty;
                        if(itemQty == 0){
                            $('.in-out-stock-'+productId).hide();
                            $('#list-div-'+productId+' > div:eq(0)').css("display", "block");
                        }else {
                            $('.in-out-stock-'+productId).show();
                            $('#list-div-'+productId+' > div:eq(0)').css("display", "none");
                        }
                       // $('.set-offer-'+productId).text(productOffer+'% OFF');
                        $('.set-price-'+productId).text(productPrice);
                        $('.set-sprice-'+productId).text(productSprice);
                        $('.product-name-'+productId).text(productSchemeName);
                        if(productImagePath){
                            $('.product-image-'+productId).prop('src', productImagePath);
                        }

                        $(".loader-div").hide();
                        //$("#success").html(response.message).show();
                    }else{
                        $("#error").html(response.message).show();
                    }
                },
                error: function () {
                    console.log('There is some error in user deleting. Please try again.');
                }
            });
        })
		


    </script>
@stop

@endsection