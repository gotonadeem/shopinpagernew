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
                    <a href="{{ URL::to('admin/customer/user-notification') }}" class="pull-right btn btn-info btn-sm" ><i class="fa fa-info"></i>Back</a>
                <!-- form start -->
                {{ Form::open(array('url' => 'admin/customer/storeUserNotification','class'=>'form-horizontal','enctype'=>'multipart/form-data','name'=>'add_slider')) }}
                  <div class="box-body">

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
    <script>
        CKEDITOR.replace( "description");
    </script>
 @stop
