@extends('front.layout.front')
@section('content')
    <section class="myAccount my-5">

        <div class="container">
            <h2 class="shoping-cart-text border-0 text-center">Update Mobile Number</h2>
            <div class="row">
                <div class="col-12">
                    <div class="account-info">
                        <div class="block-content">
                            <div class="row">
                                 <div class="col-6 m-auto">
                                    <div class="box box-shipping-address mt-4">
                                        <div class="box-content">
                                            <div class="my-profile-content">

                                                <div class="alert alert-success message" style="display:none" id="success_alert"><li class="fa fa-check"></li></div>
                                                @if(Session::has('success_message'))
                                                    <div class="alert alert-success message"><li class="fa fa-check"></li>{{ Session::get('success_message') }}</div>
                                                @endif
                                                @if(Session::has('error_message'))
                                                    <div class="alert alert-danger message"><li  class="fa fa-window-close"></li>{{ Session::get('error_message') }}</div>
                                                @endif
                                                {{ Form::model('',array('url' => 'update-user-mobile','class'=>'form-horizontal','name'=>'update_profile',"enctype"=>"multipart/form-data")) }}
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-4">
                                                                <label>New Mobile Number<sub>*</sub></label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="number" class="form-control" placeholder="Enter Mobile Number" id="mobile" name="mobile">
                                                                <span class="mobileMsg error">{{ $errors->first('mobile') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 text-right">
                                                        <button type="submit" class="btn btn-submit custom-btn">Update </button>
                                                    </div>
                                                    </form>




                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @endSection