
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
				<!-- <span class="cart_count">{{$vs->qty}}</span> -->

			</div>
			<div class="cart_info">
				<h5>{{$vs->product_name}}</h5>
				<div class="cart_info-content">
					<span class="weight"> {{$vs->weight}}</span>
					<span class="cart_multi"> {{$vs->qty}} x {{$vs->sprice}}</span>
					<span class="cart_price"> Rs {{$vs->qty*$vs->sprice}}</span>
				</div>
				<div class="input-group input-group-custom qty-sec">
					<span class="input-group-btn">
						<button type="button" onclick="cart_qty_decrement(this.id)" id="{{$vs->id}}"  class="quantity-cart-minus btn btn-danger btn-number quantity-right-plus"  data-type="minus" data-field=""> <i class="fa fa-minus" aria-hidden="true"></i> </button>
					</span>
					<input type="text" id="cart_quantity" value="{{$vs->qty}}" name="quantity" class="form-control input-number qty_{{$vs->id}}"  min="1" max="100" readonly>
					<span class="input-group-btn">
						<button type="button" onclick="cart_qty_increment(this.id)" id="{{$vs->id}}"  class="quantity-cart-plus btn btn-success btn-number" data-type="plus" data-field=""> <i class="fa fa-plus" aria-hidden="true"></i> </button>
					</span> 
				</div>
				<small class="cart_stock_error_{{$vs->id}} error d-block w-100" style="display: none;float: left"></small>
			</div>

			<input type="hidden" class="item_id_{{$vs->id}}" value="{{$vs->item_id}}">
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
		<p class="pt-2 pl-2 pr-2 text-center m-0">Your basket is empty. Start shopping now!</p>
		<div class="cantinue-shopping text-center p-3">
                        <a href="" class="btn btn-submit"><i class="fa fa-angle-double-left mr-1"></i> Continue Shopping</a>
                      </div>
	</div>
@endif
</div>
@if($cart_count>0)
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
		@endif
</div>
</div>