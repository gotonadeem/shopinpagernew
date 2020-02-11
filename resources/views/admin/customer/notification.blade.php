<?php
/**
 * Created by PhpStorm.
 * User: wingstud
 * Date: 10/8/17
 * Time: 12:49 PM
 */
?>
@extends('admin.layout.admin')
@section('content')
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content" style="
    padding: 0 0px 0px 0px;
    margin-top: 29px;">
            <div class="container">
                <!-- end row -->
                <br>
                <div class="row coin-add" style="background:#fff; padding:10px;">
                    <div class="col-sm-12">
                        <h4 class="header-title m-t-0">Add Notification</h4>
                    </div>
                    <a href="{{ URL::to('admin/site-setting/user-notification') }}" class="pull-right btn btn-info btn-sm" ><i class="fa fa-info"></i>Back</a>
                    <!-- form start -->
                    {{ Form::open(array('url' => 'admin/customer/storeNotification','class'=>'form-horizontal','enctype'=>'multipart/form-data','name'=>'add_slider')) }}
                    <div class="box-body">

                     {{--   <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-3 form-control-label">City Name</label>
                            <div class="col-md-6">
                                <select name="city_name" class="form-control">
                                    <option value="">Select City</option>
                                    @foreach($data as $vs)
                                        @if($vs->city_name)
                                            <option value="{{$vs->city_name}}">{{$vs->city_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="error-message">{{ $errors->first('city_name') }}</div>
                            </div>
                        </div>--}}
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Title</label>
                            <div class="col-md-6">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                                <div class="error-message">{{ $errors->first('title') }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Image</label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" name="image" id="image">
                                <div class="error-message">{{ $errors->first('image') }}</div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Description</label>
                            <div class="col-md-6">
                                {{Form::textarea('description',NULL,['class'=>'form-control','id'=>'description','required'=>'required','placeholder'=>'Enter Description'])}}
                                <div class="error-message">{{ $errors->first('description') }}</div>
                            </div>
                        </div>
						
						<div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Select Redirection</label>
                          <div class="col-md-6">
                              <select class="form-control" name="redirect_type">
							      <option value="category">Category</option>
							      <option value="homepage">Homepage</option>
							  </select>
                              <div class="error-message">{{ $errors->first('redirect_type') }}</div>
                          </div>
                      </div>
					  
					  <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Send Type</label>
                          <div class="col-md-6">
                              <select class="form-control" name="send_type">
							      <option value="now">Send Now</option>
							      <option value="later">Later</option>
							  </select>
                              <div class="error-message">{{ $errors->first('send_type') }}</div>
                          </div>
                      </div>
					  
					   <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Date</label>
                            <div class="col-md-6">
                                <input type="text" name="date" class="form-control" id="date" placeholder="Enter date">
                                <div class="error-message">{{ $errors->first('date') }}</div>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Time</label>
                            <div class="col-md-6">
                                <input type="text" name="time" class="form-control timepicker" id="time" placeholder="Enter time">
                                <div class="error-message">{{ $errors->first('time') }}</div>
                            </div>
                        </div>
					  
					  <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Select category</label>
                          <div class="col-md-6">
                              <select class="form-control" name="category_id">
							     @foreach($data as $vs)
							      <option value="{{$vs->id}}">{{$vs->name}}</option>
							     @endforeach
								 
							  </select>
                              <div class="error-message">{{ $errors->first('redirect_type') }}</div>
                          </div>
                      </div>
                


                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" id="submit" name="add_slider" class="btn btn-primary">Submit</button>

                        </div>
                    </div>
                    {{ Form::close() }}
                </div> <!-- container -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('admin.includes.admin_right_sidebar')
    @include('admin.includes.admin_footer')
    <script type="text/javascript" src="{{ URL::asset('public/admin/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ URL::asset('public/admin/developer/js/sub_admin.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
  $( function() {
    $( "#date" ).datepicker();
    $('.timepicker').timepicker({
		interval: 60,
		
	});
  });

  </script>
@stop
