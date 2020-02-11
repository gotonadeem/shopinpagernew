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
                        <h4 class="header-title m-t-0">Add Slider</h4>
                    </div>
                <!-- form start -->
                {{ Form::open(array('url' => 'admin/banner/storeBanner','class'=>'form-horizontal','enctype'=>'multipart/form-data','name'=>'add_banner')) }}
                  <div class="box-body">



                      <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Slider Image</label>
                          <div class="col-sm-7">
                              <input type="file"   required class="form-control" name="images" id="images">
                              <div class="error-message">{{ $errors->first('images') }}</div>

                          </div>
                      </div>
                      <!-- <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Title</label>
                          <div class="col-md-6">
                              {{Form::textarea('title',NULL,['class'=>'form-control','id'=>'title','required'=>'required','placeholder'=>'Enter Title'])}}
                              <div class="error-message">{{ $errors->first('title') }}</div>
                          </div>
                      </div> -->
					            <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Link Category</label>
                          <div class="col-md-6">
                             <select class="form-control" name="link">
                                     <option value="">Select Category</option>
                                    <?PHP foreach($category_list as $vs): ?>
                                       <option value="<?=$vs->id?>"><?=$vs->name?></option>
                                    <?PHp endforeach; ?>
                                    </select>
                              <div class="error-message">{{ $errors->first('link') }}</div>
                          </div>
                      </div>
            <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Slider type</label>
                          <div class="col-md-6">
                               
                             <select class="form-control" name="type">
                                    <option value="">Select Slider</option>
                                    <option value="slider_first">Slider First</option>
                                    <option value="slider_second">Slider Second</option>
                                    <option value="slider_third">Slider Third</option>
                                    <option value="banner_first">Banner First</option>
                                    <option value="banner_second">Banner Second</option>
                                    <option value="banner_footer">Banner Footer</option>  
                                    
                             </select>
                              <div class="error-message">{{ $errors->first('') }}</div>
                              
                          </div>
                      </div> 


                  </div><!-- /.box-body -->

                    <div class="box-footer">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                    <button type="submit" id="submit" name="add_banner" class="btn btn-primary">Submit</button>
                    
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
        CKEDITOR.replace( 'title' );
    </script>
 @stop
