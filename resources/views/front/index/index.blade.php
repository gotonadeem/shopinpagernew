@extends('front.layout.front')
@section('content')
<!--Slider start-->

<div class="slider_area">
  <div id="main-slider" class="owl-carousel">
     @foreach($slider_list as $item)
     <div class="item">
      <div class="single_slide">
	  <?PHP 
	    $slug=!is_null($item->main_category)?$item->main_category->slug:"";
	  ?>
        <a href="{{URL::to('category/'.$slug)}}">
          <img src="{{URL::to('public/admin/uploads/slider_image/'.$item->images)}}">
        </a>
      </div>
     </div>
    @endforeach
  </div>
</div>
<!--Slider end-->


<!--Advertisement Banner-->
<div class="add-banner">
  <div class="container-fluid">
    <div class="add-box-main">
      <ul class="clearfix">
        @foreach($secondBanner as $sBanner)
          <?PHP 
	    $slug=!is_null($sBanner->main_category)?$sBanner->main_category->slug:"";
	     ?>
		<li>
          <a href="{{URL::to('category/'.$slug)}}"><img src="{{ URL::asset('public/admin/uploads/banner_image/'.$sBanner->images) }}"></a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

<!--New product area-->
<div class="new_product pt-5">
  <div class="container-fluid">
    <div class="section_title">
    <div class="row">
      <div class="col-9">
        <div class="space_2 text-left">
          <h3>Best Selling Products</h3>
        </div>
      </div>
        <div class="col-3 text-right">
            <a href="{{URL::to('product-type-list/'.encrypt('is_best_selling'))}}" class="btn btn-submit">View All</a>
        </div>
    </div>
    
    </div>
    <div class="row">
      <div id="features_product_active" class="features_product_active owl-carousel">
        <!-- product-->
        <?php $newProduct = Helper::getBestSellingProduct(); ?>
        @foreach($newProduct as $nList)
          <div class="col-lg-2">
            <a href="{{URL::to('product/'.$nList->slug)}}">
            <div class="single__product">
              <div class="single_product__inner">
                <?php $ifSchemeOnProduct = Helper::getProductScheme($nList->id);
                if($ifSchemeOnProduct){
                  $pName = $ifSchemeOnProduct->offer_name;
                  $imageUrl = 'public/admin/uploads/scheme_product/'.$ifSchemeOnProduct->image;

                }else{
                  $pName = $nList->name;
                  $imageUrl = 'public/admin/uploads/product/'.$nList->image;
                }
                ?>
                <div class="product_img">

                    <img src="{{URL::asset($imageUrl)}}" alt="">

                </div>
                <div class="product__content text-center">
                  <div class="produc_desc_info">
                    <div class="product_title">
                      <h4>{{$pName}}</h4>
                    </div>

                  </div>

                </div>
              </div>
            </div>
              </a>
          </div>
      @endforeach
      <!-- end product-->
      </div>
    </div>
  </div>
</div>
<!--new product end-->
<!-- today offer -->
<div class="new_product pt-5">
  <div class="container-fluid">
    <div class="section_title">
      <div class="row">
        <div class="col-9">
          <div class="space_2 text-left">
            <h3>Todays Offer</h3>
          </div>
        </div>
          <div class="col-3 text-right">
              <a href="{{URL::to('product-type-list/'.encrypt('is_today_offer'))}}" class="btn btn-submit">View All</a>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="features_product_active owl-carousel">
        <!-- product-->
        <?php $offerProduct = Helper::getProductByType('is_today_offer'); ?>
        @foreach($offerProduct as $offer)
		 <?php $getProductPriceData = Helper::getProductItemBySellerId($offer->id,$offer->user_id);
		 //if offer > 0
                                            if($getProductPriceData[0]['offer'] > 0){
                                                $offerClass = 'off-discont';
                                                $offer1 = $getProductPriceData[0]['offer'].'&nbsp;OFF';
                                            }else{
                                                $offerClass = '';
                                                $offer1 = '';
                                            }
											?>
          <div class="col-lg-2">
            <a href="{{URL::to('product/'.$offer->slug)}}">
            <div class="single__product">
              <div class="single_product__inner">
                <div class="product_img">
                  <?php $ifSchemeOnProduct = Helper::getProductScheme($offer->id);
                  if($ifSchemeOnProduct){
                    $pName = $ifSchemeOnProduct->offer_name;
                    $imageUrl = 'public/admin/uploads/scheme_product/'.$ifSchemeOnProduct->image;

                  }else{
                    $pName = $offer->name;
                    $imageUrl = 'public/admin/uploads/product/'.$offer->image;
                  }


                  ?>
                     <img src="{{URL::asset($imageUrl)}}" alt="">
                     <span class="{{$offerClass}} set-offer-{{$offer->id}}">{{$offer1}}</span>
                </div>
                <div class="product__content text-center">
                  <div class="produc_desc_info">
                    <div class="product_title">
                      <h4>{{$pName}}</h4>
                    </div>

                  </div>

                </div>
              </div>
            </div>
              </a>
          </div>
      @endforeach
      <!-- end product-->
      </div>
    </div>
  </div>
</div>
<!--new product end-->

<!--Banner area start-->
<div class="banner_area home1_banner2 pt-4">
<div class="slider_area">
  <div id="slider_list" class="owl-carousel">
     @foreach($firstSlider as $firstb)
	   <?PHP 
	    $slug=!is_null($firstb->main_category)?$firstb->main_category->slug:"";
	     ?>
    <div class="single_slide" >
    <a href="{{URL::to('category/'.$slug)}}">
        <img src="{{URL::to('public/admin/uploads/banner_image/'.$firstb->images)}}">
    </a>

    </div>
    @endforeach
  </div>
</div>
</div>
<!--Banner area end-->

<div class="new_product pt-5">
  <div class="container-fluid">
    <div class="section_title">
      <div class="row">
        <div class="col-9">
          <div class="space_2 text-left">
            <h3>New Product</h3>
          </div>
        </div>
          <div class="col-3 text-right">
              <a href="{{URL::to('product-type-list/'.encrypt('new'))}}" class="btn btn-submit">View All</a>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="features_product_active owl-carousel">
        <!-- product-->
        <?php $newProduct = Helper::getNewProduct(); ?>
        @foreach($newProduct as $nList)
        <div class="col-lg-2">
          <a href="{{URL::to('product/'.$nList->slug)}}">
          <div class="single__product">
            <div class="single_product__inner">
              <div class="product_img">
              <?php $ifSchemeOnProduct = Helper::getProductScheme($nList->id);
                if($ifSchemeOnProduct){
                  $pName = $ifSchemeOnProduct->offer_name;
                  $imageUrl = 'public/admin/uploads/scheme_product/'.$ifSchemeOnProduct->image;

                }else{
                  $pName = $nList->name;
                  $imageUrl = 'public/admin/uploads/product/'.$nList->image;
                }


                ?>
                  <img src="{{URL::asset($imageUrl)}}" alt="">

              </div>
              <div class="product__content text-center">
                <div class="produc_desc_info">
                  <div class="product_title">
                    <h4>{{$pName}}</h4>
                  </div>

                </div>

              </div>
            </div>
          </div>
            </a>
        </div>
          @endforeach
      <!-- end product-->
      </div>
    </div>
  </div>
</div>

<!--Advertisement Banner-->
<div class="add-banner pt-5">
  <div class="container-fluid">
    <div class="add-box-main">
      <ul class="clearfix">
        @foreach($firstBanner as $fbanner)
		 <?PHP 
	    $slug=!is_null($fbanner->main_category)?$fbanner->main_category->slug:"";
	     ?>
        <li>
          <a href="{{URL::to('category/'.$slug)}}"><img src="{{ URL::asset('public/admin/uploads/banner_image/'.$fbanner->images) }}"></a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

<div class="new_product pt-5">
  <div class="container-fluid">
    <div class="section_title">
      <div class="row">
        <div class="col-9">
          <div class="space_2 text-left">
            <h3>Monthly Essentials</h3>
          </div>
        </div>
          <div class="col-3 text-right">
              <a href="{{URL::to('product-type-list/'.encrypt('monthly_essentials'))}}" class="btn btn-submit">View All</a>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="features_product_active owl-carousel">
        <!-- product-->
        <?php $monthlyEssentialsProduct = Helper::getProductByType('monthly_essentials'); ?>
        @foreach($monthlyEssentialsProduct as $monthlyList)
        <div class="col-lg-2">
          <a href="{{URL::to('product/'.$monthlyList->slug)}}">
          <div class="single__product">
            <div class="single_product__inner">
              <div class="product_img">
                <?php $ifSchemeOnProduct = Helper::getProductScheme($monthlyList->id);
                if($ifSchemeOnProduct){
                  $pName = $ifSchemeOnProduct->offer_name;
                  $imageUrl = 'public/admin/uploads/scheme_product/'.$ifSchemeOnProduct->image;

                }else{
                  $pName = $monthlyList->name;
                  $imageUrl = 'public/admin/uploads/product/'.$monthlyList->image;
                }


                ?>
                  <img src="{{URL::asset($imageUrl)}}" alt="">

              </div>
              <div class="product__content text-center">
                <div class="produc_desc_info">
                  <div class="product_title">
                    <h4>{{$pName}}</h4>
                  </div>

                </div>

              </div>
            </div>
          </div>
            </a>
        </div>
          @endforeach
      <!-- end product-->
      </div>
    </div>
  </div>
</div>

<!--Banner area start-->
<div class="banner_area home1_banner2 pt-4">
<div class="slider_area">
  <div class="slider_list owl-carousel">
     @foreach($secondSlider as $bSecond)
	  <?PHP 
	    $slug=!is_null($bSecond->main_category)?$bSecond->main_category->slug:"";
	     ?>
    <div class="single_slide" >
    <a href="{{URL::to('category/'.$slug)}}">
        <img src="{{URL::to('public/admin/uploads/banner_image/'.$bSecond->images)}}">
    </a>
    </div>
    @endforeach
  </div>
</div>
</div>
<!--Banner area end-->


<div class="new_product pt-5">
  <div class="container-fluid">
    <div class="section_title">
      <div class="row">
        <div class="col-9">
          <div class="space_2 text-left">
            <h3>Weather Special</h3>
          </div>
        </div>
          <div class="col-3 text-right">
              <a href="{{URL::to('product-type-list/'.encrypt('weather_special'))}}" class="btn btn-submit">View All</a>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="features_product_active owl-carousel">
        <!-- product-->
        <?php $weatherProduct = Helper::getProductByType('weather_special'); ?>
        @foreach($weatherProduct as $wList)
        <div class="col-lg-2">
          <a href="{{URL::to('product/'.$wList->slug)}}">
          <div class="single__product">
            <div class="single_product__inner">
              <div class="product_img">
                <?php $ifSchemeOnProduct = Helper::getProductScheme($monthlyList->id);
                if($ifSchemeOnProduct){
                  $pName = $ifSchemeOnProduct->offer_name;
                  $imageUrl = 'public/admin/uploads/scheme_product/'.$ifSchemeOnProduct->image;

                }else{
                  $pName = $wList->name;
                  $imageUrl = 'public/admin/uploads/product/'.$wList->image;
                }


                ?>
                  <img src="{{URL::asset($imageUrl)}}" alt="">

              </div>
              <div class="product__content text-center">
                <div class="produc_desc_info">
                  <div class="product_title">
                    <h4>{{$pName}}</h4>
                  </div>

                </div>

              </div>
            </div>
          </div>
            </a>
        </div>
          @endforeach
      <!-- end product-->
      </div>
    </div>
  </div>
</div>

<div class="new_product pt-5">
  <div class="container-fluid">
    <div class="section_title">
      <div class="row">
        <div class="col-9">
          <div class="space_2 text-left">
            <h3>Saving Pack</h3>
          </div>
        </div>
          <div class="col-3 text-right">
              <a href="{{URL::to('product-type-list/'.encrypt('saving_pack'))}}" class="btn btn-submit">View All</a>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="features_product_active owl-carousel">
        <!-- product-->
        <?php $savingProduct = Helper::getProductByType('saving_pack'); ?>
        @foreach($savingProduct as $savingList)
        <div class="col-lg-2">
          <a href="{{URL::to('product/'.$savingList->slug)}}">
          <div class="single__product">
            <div class="single_product__inner">
              <div class="product_img">
                <?php $ifSchemeOnProduct = Helper::getProductScheme($monthlyList->id);
                if($ifSchemeOnProduct){
                  $pName = $ifSchemeOnProduct->offer_name;
                  $imageUrl = 'public/admin/uploads/scheme_product/'.$ifSchemeOnProduct->image;

                }else{
                  $pName = $savingList->name;
                  $imageUrl = 'public/admin/uploads/product/'.$savingList->image;
                }


                ?>
                  <img src="{{URL::asset($imageUrl)}}" alt="">

              </div>
              <div class="product__content text-center">
                <div class="produc_desc_info">
                  <div class="product_title">
                    <h4>{{$pName}}</h4>
                  </div>

                </div>

              </div>
            </div>
          </div>
            </a>
        </div>
          @endforeach
      <!-- end product-->
      </div>
    </div>
  </div>
</div>


<!--Banner area start-->
<div class="beauty-groom pt-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 p-0">
        <div class="beauty-groom-item">
          <a href=""><img src="{{ URL::asset('public/admin/uploads/banner_image/'.$is_special->images) }}"></a>
        </div>
      </div>
      <div class="col-sm-6 p-0">
        @foreach($footerBanner as $footer)
		 <?PHP 
	    $slug=!is_null($footer->main_category)?$footer->main_category->slug:"";
	     ?>
        <div class="beauty-groom-item groom-item-items">
          <a href="{{URL::to('category/'.$slug)}}"><img src="{{ URL::asset('public/admin/uploads/banner_image/'.$footer->images) }}"></a>
        </div>
        @endforeach

      </div> 
      </div>
  </div>
</div>
<!--Banner area end-->
<!--Brand logo start-->
<div class="brand_logo pt-5 pb-5">
            <div class="container-fluid">
            <div class="section_title space_2 text-left">
              <h3>Lover Brands</h3>
            </div>
            <div class="brand-logo-list clearfix">
              
                  @foreach($brand as $br)
                    <?php if($br->images){?>
                  <div class="single_brand_logo">
                      <a href="{{URL::to('product-type-list/'.encrypt('brand').'?brandid='.$br->id)}}">
                      <img src="{{ URL::asset('public/admin/uploads/brand_icon/'.$br->images) }}" alt="brand logo">
                      </a>
                  </div>
                    <?php }?>
                  @endforeach

              </div>
            </div>
        </div>
        <!--Brand logo end-->
        <div class="about-section mb-5">
          <div class="container-fluid">
            <div class="section_title space_2">
              <h3>Shopinpager – online grocery store</h3>
            </div>
            <div class="about-content">
              <p>Did you ever imagine that the freshest of fruits and vegetables, top quality pulses and food grains, dairy products and hundreds of branded items could be handpicked and delivered to your home, all at the click of a button? India’s first comprehensive online megastore, Shopinpager.com, brings a whopping 20000+ products with more than 1000 brands, to over 4 million happy customers. From household cleaning products to beauty and makeup, Shopinpager has everything you need for your daily needs. Shopinpager.com is convenience personified We’ve taken away all the stress associated with shopping for daily essentials, and you can now order all your household products and even buy groceries online without travelling long distances or standing in serpentine queues. Add to this the convenience of finding all your requirements at one single source, along with great savings, and you will realize that Shopinpager- India’s largest online supermarket, has revolutionized the way India shops for groceries. Online grocery shopping has never been easier. Need things fresh? Whether it’s fruits and vegetables or dairy and meat, we have this covered as well! Get fresh eggs, meat, fish and more online at your convenience. Hassle-free Home Delivery options</p>
            </div>
          </div>
        </div>
        <!--Shipping area start-->
<!-- <div class="shipping_area">
  <div class="container-fluid">
  <div class="shipping_list d-flex justify-content-between flex-xs-column">
          <div class="single_shipping_box d-flex">
            <div class="shipping_icon">
              <img src="{{asset('public/img/ship/1.png')}}" alt="shipping icon">
            </div>
            <div class="shipping_content">
              <h6>Quailty </h6>
              <p>You can trust</p>
            </div>
          </div>
          <div class="single_shipping_box one d-flex">
            <div class="shipping_icon">
              <img src="{{asset('public/img/ship/2.png')}}" alt="shipping icon">
            </div>
            <div class="shipping_content">
              <h6>On Time Guarantee</h6>
              <p>10% value back if we are late</p>
            </div>
          </div>
          <div class="single_shipping_box two d-flex">
            <a href="{{URL::to('cancelation-returns')}}"></a>
            <div class="shipping_icon">
              <img src="{{asset('public/img/ship/3.png')}}" alt="shipping icon">
            </div>
            <div class="shipping_content">
              <h6>Return Policy</h6>
              <p>No question asked</p>
            </div>
          </div>
          <div class="single_shipping_box three d-flex">
              <?php
              $supportUrl = URL::to('user-login');
              if(Auth::check()){
                if(Auth::user()->role_id==3){
                    $supportUrl = URL::to('user-support');
                }
              }

              ?>
            <a href="{{$supportUrl}}"></a>
            <div class="shipping_icon">
              <img src="{{asset('public/img/ship/4.png')}}" alt="shipping icon">
            </div>
            <div class="shipping_content">
              <h6>Online Support 24/7</h6>
            </div>
          </div>
        </div>
  </div>
</div> -->



@endsection