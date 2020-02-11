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
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Brand Details</h5>
                        <div class="text-right"><a href="{{ URL::to('admin/brand/brand-list') }}" class="btn btn-info">Back</a>
                            <div class="ibox-tools">
                            </div>
                        </div>

                        {{ Form::model($brand,array('url' => 'admin/brand/update/'.$brand->id,'class'=>'form-horizontal','name'=>'add_brand','enctype'=>'multipart/form-data')) }}


                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 form-control-label">Brand Name<span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                {{Form::text('name',$brand->name,['class'=>'form-control','id'=>'name','placeholder'=>'name'])}}
                                <div class="error-message">{{ $errors->first('name') }}</div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-4 form-control-label">Brand Icon</label>
                            <div class="col-sm-7">
                                <?PHP
                                $img=empty($brand->images) ? '':$brand->images;
                                ?>
                                <img src="{{ URL::asset('public/admin/uploads/brand_icon/'.$img) }}" height="100" width="150">

                                <input type="file" class="form-control" name="images" id="images">
                                <div class="error-message">{{ $errors->first('images') }}</div>
                                <input type="hidden" value="{{ $slider->images or ''}}" name="old_img">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 col-sm-offset-4">
                                <button type="submit" name="add_user" value="add_user"  class="btn btn-primary waves-effect waves-light">
                                    Update
                                </button>

                            </div>
                        </div>
                        {{ Form::close() }}


                    </div>
                </div>
            </div>
        </div>
    @include('admin.includes.admin_right_sidebar')
    <!-- Mainly scripts -->
        <script src="{{ URL::asset('public/admin/js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ URL::asset('public/admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ URL::asset('public/admin/js/plugins/dataTables/datatables.min.js') }}"></script>
        <!-- Custom and plugin javascript -->
        <script src="{{ URL::asset('public/admin/js/inspinia.js') }}"></script>
        <script src="{{ URL::asset('public/admin/js/plugins/pace/pace.min.js') }}"></script>
        <!-- Page-Level Scripts -->
        <script>
            ASSET_URL = '{{ URL::asset('public') }}/';
            BASE_URL='{{ URL::to('/') }}';
        </script>
        <script type="text/javascript" src="{{ URL::asset('public/admin/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
        <script language="JavaScript" type="text/javascript" src="{{ URL::asset('public/admin/developer/js/brand.js') }}"></script>

@stop
