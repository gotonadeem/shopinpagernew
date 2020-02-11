
@extends('admin.layout.admin')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Category</h5>
                        <div class="text-right"><a href="{{ URL::to('admin/category/category-list') }}" class="btn btn-info">View All</a>
                            <div class="ibox-tools">
                            </div>
                        </div>
                        <!-- form start -->
                    {{ Form::model($category,array('url' => ['admin/category/update/'.$category->id],'class'=>'form-horizontal','method'=>'post','enctype'=>'multipart/form-data')) }}
                            <div class="form-group row">
                                <label for="title" class="col-md-3 control-label">Name <span class="star_important">*</span></label>
                                <div class="col-md-6">
                                    {{Form::text('name',NULL,['class'=>'form-control','placeholder'=>'Enter name'])}}
                                    <div class="error-message">{{ $errors->first('name') }}</div>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="iamge" class="col-md-3 control-label">Icon </label>
                                <div class="col-md-6">
                                    {{Form::file('image')}}
                                    <div class="error-message">{{ $errors->first('image') }}</div>
                                    <input type="hidden" value="{{ $category->image}}" name="old_img">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="banner_img" class="col-md-3 control-label">Banner Image</label>
                                <div class="col-md-6">
                                    {{Form::file('banner_img')}}
                                    <div class="error-message">{{ $errors->first('banner_img') }}</div>
                                    <input type="hidden" value="{{ $category->banner_img}}" name="cat_old_img">
                                </div>
                            </div>
                        
                            <div class="form-group row">
                                <label for="email" class="col-md-3 control-label">Status </label>

                                <div class="col-sm-7 row">
                                    {{Form::select('status', array('1' => 'Active', '0' => 'Inactive'),'1',['class'=>'form-control'])}}
                                    <div class="error-message">{{ $errors->first('status') }}</div>
                                </div>
                            </div>

                        <div class="form-group row">
                            <div class="col-sm-8 col-sm-offset-4">
                                <button name="submit" class="btn btn-primary">Submit</button>
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
        <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'title' );
        </script>
        <!-- Page-Level Scripts -->
    <script>
        ASSET_URL = '{{ URL::asset('public') }}/';
        BASE_URL='{{ URL::to('/') }}';
    </script>
    </div>
@stop