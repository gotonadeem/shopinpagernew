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
                        <h4 class="header-title m-t-0">Edit Banner</h4>
                    </div>
                    <a href="{{ URL::to('admin/banner/banner-list') }}" class="pull-right btn btn-info btn-sm" ><i class="fa fa-info"></i> View All</a>
                    <!-- form start -->
                     {{ Form::model($banner,array('url' => 'admin/Banner/updateBanner/'.$banner->id, 'enctype'=>'multipart/form-data', 'class'=>'form-horizontal')) }}
                   <div class="box-body">



                       <div class="form-group">
                           <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Banner Image</label>
                           <div class="col-sm-7">
                               <?PHP
                               $img=empty($banner->images) ? '':$banner->images;
                               ?>
                               <img src="{{ URL::asset('public/admin/uploads/banner_image/'.$img) }}" height="100" width="150">

                               <input type="file" class="form-control" name="images" id="images">
                               <div class="error-message">{{ $errors->first('images') }}</div>
                                   <input type="hidden" value="{{ $banner->images or ''}}" name="old_img">
                           </div>
                       </div>
                       <!-- <div class="form-group">
                           <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Title</label>
                           <div class="col-md-6">
                               {{Form::textarea('title',empty($banner->title) ? '' : $banner->title,['class'=>'form-control','id'=>'title','placeholder'=>'Enter Title'])}}
                               <div class="error-message">{{ $errors->first('title') }}</div>
                           </div>
                        </div> -->
                     <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Link Category</label>
                          <div class="col-md-6">
                             <select class="form-control" name="link">
                                      <option value="">Select Category</option>
                                      <?PHP foreach($category_list as $vs): 
                                      if($banner->link==$vs->id):
                                      ?>
                                      <option  selected value="<?=$vs->id?>"><?=$vs->name?></option>
                                      <?PHP else: ?>
                                      <option  value="<?=$vs->id?>"><?=$vs->name?></option>
                                      <?PHp  endif; endforeach; ?>

                             </select>
                              <div class="error-message">{{ $errors->first('link') }}</div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1" class="col-sm-3 form-control-label">Banner type</label>
                          <div class="col-md-6">
                             <select class="form-control" name="type">
                                      <option value="slider_first">Slider First</option>
                                      <option value="slider_second">Slider Second</option>
                                      <option value="slider_third">Slider Third</option>
                                      <option value="banner_first">Banner First</option>
                                      <option value="banner_second">Banner Second</option>
                                      <option value="banner_footer">Banner Footer</option>
                             </select>
                             
                              <div class="error-message">{{ $errors->first('link') }}</div>
                          </div>
                      </div>

					   
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" id="submit" value="submit" class="btn btn-primary">Submit</button>
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
