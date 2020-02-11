@extends('admin.layout.admin')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Assigned to Rider Order List</h5>
                       
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="order-table" class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr>
                                <th>Sr.</th>
                                <th>O-Id</th>
                                <th>C-Name</th>
                                <th>C-Mob</th>
								<th>Amt</th>
                                <th>O-Status</th>
                                <th>Items</th>
                                <th>Qty</th>
                                <th>P-mode</th>
                                <th>Date</th>
                           </tr>
							</thead>
							<tbody>
							@foreach(@$data as $ks=>$vs)
							<tr>
                                <th>{{$ks+1}}</th>
                                <th>{{$vs->order_id}}</th>
                                <th>{{$vs->name}}</th>
                                <th>{{$vs->mobile}}</th>
								<th></th>
                                <th>{{$vs->status}}</th>
                                <th>Items</th>
                                <th>Qty</th>
                                <th>{{$vs->payment_mode}}</th>
                                <th>{{date('d-m-Y',strtotime($vs->created_at))}}</th>
         
                            </tr>
							@endforeach
							</tbody>
                            
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
 {{ Form::open(array('url' => 'admin/assign-rider','class'=>'form-horizontal','enctype'=>'multipart/form-data','name'=>'assign_rider','id'=>'assign_rider')) }}
               
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">List Of Rider</h4>
		<input type="hidden" id="order_id">
      </div>
      <div class="modal-body" id="data">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
      </div>
    </div>
  </form>
  
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
<script language="JavaScript" type="text/javascript" src="{{ URL::asset('public/admin/developer/js/manage_order.js') }}"></script>

<script>
    ASSET_URL = '{{ URL::asset('public') }}/';
    BASE_URL='{{ URL::to('/') }}';
</script>
@stop
