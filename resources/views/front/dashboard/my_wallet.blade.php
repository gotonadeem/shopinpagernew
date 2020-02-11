@extends('front.layout.front')
@section('content')
  <style>
    .txt-red-color{
      color: red;
    }
    .txt-green-color{
      color: green;
    }
  </style>
  <?PHP
  $array_list=array('coral'=>'pending','green'=>'approved','red'=>'rejecetd');
  ?>
  <div class="container-fluid my-3">
    <ul class="breadcrumb justify-content-start">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Wallet</li>
    </ul>
  </div>
  <section class="wallet my-5">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <h2 class="shoping-cart-text">Wallet</h2>
        </div>
        <div class="col-6 text-right">
         <a href="{{URL::to('/add-wallet-amount')}}/<?= Auth::user()->id ?>"  class="btn btn-primary"><i class="fa fa-print"></i> Add wallet amount </a>
        </div>
      </div>
      <div class="row">
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
        <div class="col-md-12 col-sm-12">
          <div class="wallet-ammout mb-md-3 mb-sm-5 text-center"> 
            <div class="wallet-img">
              <img src="{{ URL::asset('public/images/wallet.png') }}" class="img-fluid">
            </div>
            <div class="wallet-text">
              <h4>Available Amount</h4>
              <h5><i class="fa fa-inr" aria-hidden="true"></i>{{$total}}</h5>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <ul class="nav nav-pills wallet-tabs" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="wallet-tab mr-2 active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Shopinpager Wallet</a></li>
        <li class="nav-item">
          <a class="wallet-tab" id="pills-refer-tab" data-toggle="pill" href="#pills-refer" role="tab" aria-controls="pills-refer" aria-selected="false">Referral Wallet</a></li>
        <!-- <li><a data-toggle="tab" href="#menu2" class="wallet-tab">Withdraw History</a></li> -->
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="transaction-history mt-sm-3 mt-3">
                <h5>Shopinpager Wallet History</h5>
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr class="bg-blue">
                    <th width="30px">S.No.</th>
                    <th>Date / Time</th>
                    <th>Perticular</th>
                    <th>Amount</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?PHP

                  foreach($total_list as $ks=>$vs):
                  $class = $vs->type == 'withdraw'?'txt-red-color':'txt-green-color';
                  $perticular='';
                    if($vs->payment_type =='placed_order'){
                      $perticular = 'Purchase item';
                    }
                  if($vs->payment_type =='return_order'){
                    $perticular = 'Return order';
                  }
                  if($vs->payment_type =='add_balance'){
                    $perticular = 'Add wallet amount';
                  }
                  if($vs->payment_type =='cashback'){
                    $perticular = 'Cashback';
                  }
                  if($vs->payment_type =='first_order_cashback'){
                    $perticular = 'Fisrt order cashback';
                  }
                  if($vs->payment_type =='withdraw_by_admin'){
                    $perticular = 'Withdraw by admin';
                  }
                  ?>
                  <tr>
                    <td>{{$ks+1}}</td>
                    <td>{{$vs->created_at}}</td>
                    <td>{{$perticular}}</td>
                    <td><i class="fa fa-inr" aria-hidden="true"></i><span>{{$vs->amount}}</span></td>
                    <td><span class="{{$class}}" >{{$vs->type =='withdraw' ? 'CR' :'DR'}}</span></td>
                  </tr>
                  <?php
                  endforeach;
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-refer" role="tabpanel" aria-labelledby="pills-refer-tab">
          <div class="transaction-history mt-sm-3 mt-3">
            <h5>Referral Wallet History</h5>
            <table class="table table-bordered table-striped">
              <thead>
              <tr class="bg-blue">
                <th width="30px">S.No.</th>
                <th>Refered By</th>
                <th>Amount</th>
                <th>Created At</th>

              </tr>
              </thead>
              <tbody>
              @foreach($ref_wallet as $ks=>$vs)
                <?php $reffUser = Helper::getReffCode($vs->ref_id);?>
                <tr>
                  <td>{{$ks+1}}</td>
                  <td>{{$reffUser}}</td>
                  <td>{{$vs->amount}}</td>
                  <td>{{$vs->created_at}}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>

      {{--  <div id="menu2" class="tab-pane fade">
          <div class="transaction-history mt-sm-3 mt-3">
            <h5>Order Wallet History</h5>
            <table class="table table-bordered table-striped">
              <thead>
              <tr class="bg-blue">
                <th width="30px">S.No.</th>
                <th>Refered By</th>
                <th>Amount</th>
                <th>Created At</th>

              </tr>
              </thead>
              <tbody>
              @foreach($total_withdraw as $ks=>$vs)
                <tr>
                  <td>{{$ks+1}}</td>
                  <td>{{(!is_null($vs->order)?$vs->order->order_id:'')}}</td>
                  <td>{{$vs->amount}}</td>
                  <td>{{$vs->created_at}}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>--}}

      </div>
    </div>
  </section>

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
    } );
	

  </script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

@stop
@endSection