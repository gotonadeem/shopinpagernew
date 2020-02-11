@extends('seller.layouts.seller')

@section('content')
<div id="rightSidenav" class="right_side_bar">
<div class="container-fluid">
  <div class="panel panel-default custom-margin">
    <div class="panel-body">
    <div class="pull-left">
	<A href="{{url()->previous()}}" class="btn btn-primary">Back</a>
    Order ID : <span>{{$order_info->order_id}}</span>
    </div>
    <div class="pull-right">
    Total Item : <span><?=Helper::get_number_of_product($order_info->	id,Auth::user()->id);?></span>
    </div>
    </div>
  </div>
</div>

<div class="container-fluid">
	  <?PHP $sum=0; ?>
	  @foreach($orders as $vs)
	  <div class="panel panel-default">
	  <div class="page-header page-header-custom">
		<h5 class="prodct-text">Sale Details</h5>      
	  </div>
		<div class="panel-body">
		<div class="col-md-1">
		<span class="img-inline-img odr-details"><img class="img-responsive" src="{{ URL::asset('public/admin/uploads/product/') }}/{{$vs->product_image}}" alt="Stylish Gota Patti Work Chiffon Saree (JBL-1012)"></span>
		</div>
		<div class="col-md-7">
		<h5 class="title-product">{{$vs->product_name}}</h5>
		<ul class="list-group" style="margin-left: 9%;">
		<li class="itemd price"><b>Price (Incl. GST)</b> : <span><i class="fa fa-inr" aria-hidden="true"></i> {{$vs->price}} </span></li>
		
		
		<li class="itemd"><b>QTY</b> : <span>{{$vs->qty}}</span></li>
		<li class="itemd size"><b>Size</b> : <span>{{$vs->weight}}</span></li>
		<li class="itemd size"><b>Status</b> : <span>{{$vs->status}}</span></li>
	  </ul>
		</div>
		<div class="col-md-4">
		<div class="order-btn">
		<!--<p><button type="button" class="btn trck">Order Track</button></p>
		<p><button type="button" class="btn cancel-odr">Cancel Order</button></p>-->
		</div>
		</div>
		
		</div>
	  </div>
	  <?PHP
       if($vs->status != 'exchange' ){
           $sum= $sum+ $vs->price*$vs->qty;
       }

	  ?>
	  @endforeach
</div>

<div class="container-fluid">
<div class="row">

<div class="col-md-6">
<div class="panel panel-default">
  <div class="page-header page-header-custom">
    <h5 class="prodct-text">Sale Details</h5>      
  </div>
    <div class="panel-body">
    <div class="col-md-12">
    <div class="table-responsive">
     <table class="table table-custom">
    
    <tbody>
      <tr>
        <td>Order Amount(Incl. GST)</td>
        <td><i class="fa fa-inr" aria-hidden="true"></i><span>{{$sum}}</span></td>
        
      </tr>
      <tr>
          <td>Shipping Charge</td>
          <td><i class="fa fa-inr" aria-hidden="true"></i><span>{{$vs->order->shipping_charge}}</span></td>

      </tr>
       <tr>
        <td class="border-top"><b>Total Amount</b></td>
        <td class="border-top"><i class="fa fa-inr" aria-hidden="true"></i><span><b>{{round($sum+$vs->order->shipping_charge,2)}} </b></span></td>
      </tr>
    </tbody>
  </table>
  </div>
    </div>
 
    </div>
  </div>
</div>

<div class="col-md-6">
<div class="panel panel-default">
  <div class="page-header page-header-custom">
    <h5 class="prodct-text">Payment Details</h5>      
  </div>
    <div class="panel-body">
    <div class="col-md-12">
    <div class="shipping-filed">
    <p>Delivery : <span>{{$order_info->shipped_date}}</span></p>
    <p>Payment Mode : <span>{{$order_info->payment_mode}}</span></p>
    </div>
    </div>
 
    </div>
  </div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="panel panel-default">
  <div class="page-header page-header-custom">
    <h5 class="prodct-text">Address</h5>      
  </div>
    <div class="panel-body">
    <div class="col-md-12">
    <div class="shipping-details">
    <!--<h5 class="customer-name">{{$order_info->address->name}}</h5>
    <p>Mobile Number : <span>{{$order_info->address->mobile}}</span></p>-->
    <p>Plot no : {{$order_info->address->landmark}}, {{$order_info->address->street}} ,{{$order_info->address->house}}</p>
    <p>{{$order_info->address->city}}</p>
    <p>{{$order_info->address->state}}<b>{{$order_info->address->pincode}}</b></p>
    </div>
    </div>
 
    </div>
  </div>
</div>

<div class="col-md-12">

  </div>

</div>
</div>

</div>
</div>




</div>

<script>

    function openTab(evt, tabName) {

        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {

            tabcontent[i].style.display = "none";

        }

        tablinks = document.getElementsByClassName("tablinks");

        for (i = 0; i < tablinks.length; i++) {

            tablinks[i].className = tablinks[i].className.replace(" active", "");

        }

        document.getElementById(tabName).style.display = "block";

        evt.currentTarget.className += " active";

    }



    // Get the element with id="defaultOpen" and click on it

    document.getElementById("defaultOpen").click();

</script>
<script>

    $( function() {

        $( "#datepicker" ).datepicker();

    } );

</script>
@endsection