<div class="shop_sidebar">
        <div class="block_categories">
            <div class="category_top_menu widget">
                <div class="widget_title">
                    <h3>Categories</h3>
                </div>
                <ul class="shop_toggle">
				     
                     @foreach($category_filter as $vs)
							<li class="has-sub"><a class="nav-link" href="{{URL::to('category/'.$catData->slug.'/'.$vs->cat_slug)}}">{{$vs->cat_name}}</a> <span class="holder"></span>
								<ul class="categorie_sub">
								  <?php $superSubCatData =Helper::get_super_sub_category($vs->cat_id);?>
                                      @foreach($superSubCatData as $ks2=>$superSubCatVal)
									  <li> <a class="nav-link" href="{{URL::to('category/'.$catData->slug.'/'.$vs->cat_slug.'/'.$superSubCatVal['slug'])}}">{{$superSubCatVal['name']}}</a> </li>
									   @endforeach
								</ul>
							</li>
					  @endforeach
                </ul>
            </div>
        </div>
        <div class="search_filters_wrapper">
            <div class="price_filter widget">
                <div class="widget_title">
                    <h3>Price</h3>
                </div>
                <div class="search_filters widget">
                    <div id="slider-range"></div>
                    <div class="d-flex align-items-center justify-content-between my-4">
                    <input type="number" min="0" max="9900" oninput="validity.valid||(value='0');" readonly="" id="min_price" class="price-range-field">
                    <span class="d-flex align-items-center" style="color:#999;">to</span>
                    <input type="number" min="0" max="10000" oninput="validity.valid||(value='10000');" readonly="" id="max_price" class="price-range-field">
                </div>
                <div id="searchResults" class="search-results-block"></div>
                </div>
            </div>
            <div class="size_clearfix widget mb-30">
                <div class="widget_title">
                    <h3>Brand</h3>
                </div>
                <ul>
                    @foreach($brand_filter as $ks=>$vs)
                    <?php if($vs->name){?>
                    <li>
                        <input onclick="filter_now()" type="checkbox" value="{{$vs->id}}" id="FruitsDrinks{{$ks}}" name="brand_value" class="brand_value">
                        <label class="custom-control-label" for="FruitsDrinks{{$ks}}">{{$vs->name}}</label>
                    </li>
                    <?php } ?>
                @endforeach
                </ul>
        </div>


         
        <div class="Compositions widget mb-30">
            <div class="widget_title">
                <h3>Discount</h3>
            </div>
            <ul>
                <li>
                    <input type="radio" onclick="filter_now()" value="50-0" id="discont1" name="discont" class="offer_value">
                    <label class="custom-control-label" for="discont1">upto 50 <i class="fa fa-rupee"></i></label>
                </li>
                <li class="nav-item">
                    <input type="radio" onclick="filter_now()" id="discont2" name="discont" value="50-100" class="offer_value">
                    <label class="custom-control-label" for="discont2">50 <i class="fa fa-rupee"></i> - 100 <i class="fa fa-rupee"></i></label>
                </li>
                <li class="nav-item">
                    <input type="radio" onclick="filter_now()" id="discont3" name="discont" value="100-150" class="offer_value">
                    <label class="custom-control-label" for="discont3">100 <i class="fa fa-rupee"></i> - 150 <i class="fa fa-rupee"></i></label>
                </li>
                <li class="nav-item">
                    <input type="radio" onclick="filter_now()" id="discont4" value="150-250" name="discont" class="offer_value">
                    <label class="custom-control-label" for="discont4">150 <i class="fa fa-rupee"></i> - 250 <i class="fa fa-rupee"></i></label>
                </li>
            </ul>
        </div>

        </div>

    </div>