<div class="row">
    <!-- Type Product List -->
    @foreach($product as $pList)
        <?php $getProductPriceData = Helper::getProductItemBySellerId($pList->id,$pList->user_id);
        if(!empty($getProductPriceData)){
            $ifSchemeProduct = Helper::getIfSchemeProduct($pList->id, $getProductPriceData[0]['id']);
        }
        ?>
        <div class="col-md-3 col-sm-6 product-list-div">
            <div class="single__product" id="list-div-{{$pList->id}}">
                <div class="single_product__inner">
                    <?php
                    if($getProductPriceData[0]['qty'] == 0){
                        $stockHide = 'block';
                    }else{
                        $stockHide = 'none';
                    } ?>
                    <div class="out-stock-item out-stock-item-ajax-{{$pList->id}}" style="display:{{$stockHide}};">
                        <span> OUT OF STOCK </span>
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
                            $offer = $getProductPriceData[0]['offer'].' OFF';
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