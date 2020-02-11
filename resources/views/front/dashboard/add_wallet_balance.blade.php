@extends('front.layout.front')
@section('content')
<div class="container-fluid my-3">
  <ul class="breadcrumb justify-content-start">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Add wallet amount</li>
  </ul>
</div>
<section class="add-wallet my-5">
  <div class="container">
    <h2 class="shoping-cart-text text-center">Add wallet amount</h2>
    <div class="box box-shipping-address">
      <div class="box-content">
        <div class="my-profile-content my-profile-content mt-sm-5 mt-3 mb-sm-5 mb-3">
          {{ Form::model('',array('url' => 'add-wallet','class'=>'form-horizontal','name'=>'add_waalet')) }}
          <div class="row">
            <div class="col-sm-6 m-auto">
              <div class="form-group row align-items-center">
                <div class="col-sm-3 col-4">
                  <label>Amount<sub>*</sub></label>
                </div>
                <div class="col-sm-7 col-8">
                  <input type="text" class="form-control"  value="0" placeholder="Enter Amount" id="wallet_amount" name="wallet_amount">
                  <span class="mobileMsg error">{{ $errors->first('wallet_amount') }}</span>
                </div>
                <div class="col-sm-2 col-12">
                  <button type="submit" class="btn btn-submit py-1" style="height:auto;">Submit</button>
                </div>
              </div>
            </div>
          </div>
          </form>

        </div>
      </div>
    </div>

  </div>
</section>
@endSection