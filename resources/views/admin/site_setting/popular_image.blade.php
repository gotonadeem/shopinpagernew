@extends('admin.layout.admin')
@section('content') 
<!-- ============================================================== -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   
                </div>
                <div class="ibox-content">
            <h4 class="header-title m-t-0">Popular Image</h4><br>
            <p class="text-muted font-13 m-b-10"></p>
           {{ Form::open(array('url' => 'admin/site-setting/popular-thumbnail-store','class'=>'form-horizontal','id'=>'add_coin','name'=>'add_fcoin','files'=>true)) }}
              <div class="form-group row">
			      <?PHP
                                    $img=empty($setting->popular_image) ? '':$setting->popular_image;
                                    ?>
                  <img class="img-responsive" src="{{ URL::asset('public/admin/uploads/category/'.$img) }}" height="100" width="150">

                <label for="inputEmail3" class="col-sm-4 form-control-label">Popular Thumbnail</label>
                <div class="col-sm-7"> {{Form::file('popular_image','',['class'=>'form-control','id'=>'app_version'])}}
                  <div class="error-message">{{ $errors->first('app_version') }}</div>
                </div>
				                                   
              </div>
              <div class="form-group row">
                <div class="col-sm-8 col-sm-offset-4">
                  <button type="submit" name="add_general_setting" value="general_setting"  class="btn btn-primary waves-effect waves-light"> Submit </button>
                  <button type="reset" class="btn btn-default waves-effect m-l-5"> Cancel </button>
                </div>
              </div>
              {{ Form::close() }} 

			  <h4 class="header-title m-t-0">New Update Icon</h4><br>
            <p class="text-muted font-13 m-b-10"></p>
           {{ Form::open(array('url' => 'admin/site-setting/popular-thumbnail-store','class'=>'form-horizontal','id'=>'add_coin','name'=>'add_fcoin','files'=>true)) }}
              <div class="form-group row">
			      <?PHP
                                    $img=empty($setting->special_image) ? '':$setting->special_image;
                                    ?>
                  <img class="img-responsive" src="{{ URL::asset('/public/admin/uploads/general_setting/'.$img) }}" height="100" width="150">

                <label for="inputEmail3" class="col-sm-4 form-control-label">Special Thumbnail</label>
                <div class="col-sm-7"> {{Form::file('special_image','',['class'=>'form-control','id'=>'app_version'])}}
                  <div class="error-message">{{ $errors->first('app_version') }}</div>
                </div>
				                                   
              </div>
			  <div class="form-group row">
			      <?PHP
                                    $img=empty($setting->popular_image2) ? '':$setting->popular_image2;
                                    ?>
                  <img class="img-responsive" src="{{ URL::asset('/public/admin/uploads/general_setting/'.$img) }}" height="100" width="150">

                <label for="inputEmail3" class="col-sm-4 form-control-label">Popular Thumnnail</label>
                <div class="col-sm-7"> {{Form::file('popular_image2','',['class'=>'form-control','id'=>'app_version'])}}
                  <div class="error-message">{{ $errors->first('app_version') }}</div>
                </div>
				                                   
              </div>
			  <div class="form-group row">
			      <?PHP
                                    $img=empty($setting->deal_of_the_day_image) ? '':$setting->deal_of_the_day_image;
                                    ?>
                  <img class="img-responsive" src="{{ URL::asset('/public/admin/uploads/general_setting/'.$img) }}" height="100" width="150">

                <label for="inputEmail3" class="col-sm-4 form-control-label">Deal Of The day</label>
                <div class="col-sm-7"> {{Form::file('deal_of_the_day_image','',['class'=>'form-control','id'=>'app_version'])}}
                  <div class="error-message">{{ $errors->first('app_version') }}</div>
                </div>
				                                   
              </div>
			  <div class="form-group row">
			      <?PHP
                                    $img=empty($setting->more_image) ? '':$setting->more_image;
                                    ?>
                  <img class="img-responsive" src="{{ URL::asset('/public/admin/uploads/general_setting/'.$img) }}" height="100" width="150">

                <label for="inputEmail3" class="col-sm-4 form-control-label">More Thumbnail</label>
                <div class="col-sm-7"> {{Form::file('more_image','',['class'=>'form-control','id'=>'app_version'])}}
                  <div class="error-message">{{ $errors->first('app_version') }}</div>
                </div>                                   
              </div>
			  
              <div class="form-group row">
                <div class="col-sm-8 col-sm-offset-4">
                  <button type="submit" name="add_general_setting" value="general_setting"  class="btn btn-primary waves-effect waves-light"> Submit </button>
                  <button type="reset" class="btn btn-default waves-effect m-l-5"> Cancel </button>
                </div>
              </div>
              {{ Form::close() }} 
          </div>
        </div>
      </div>
    </div>
    <!-- container --> 
  </div>
  <!-- container --> 
<!-- content -->
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
<script language="JavaScript" type="text/javascript" src="{{ URL::asset('public/admin/developer/js/general_setting.js') }}"></script> 
@stop 