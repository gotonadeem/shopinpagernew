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
                        <h5>Delivery Boy List</h5>
                    <div class="ibox-content">
                        <div class="table-responsive">
                        <div id="map" style="width:100%;height:400px;">
                        </div>
                        <script>
                            function initMap() {
                                var riderLat =  '<?= $rider->rider_lat?$rider->rider_lat:'26.8505899' ?>';
                                var riderLong = '<?= $rider->rider_long?$rider->rider_long:'75.7909157' ?>';
                                var myLatLng = {lat: parseFloat(riderLat), lng: parseFloat(riderLong)};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                    zoom: 16,
                                    center: myLatLng
                                });

                                var marker = new google.maps.Marker({
                                    position: myLatLng,
                                    map: map,
                                    title: 'Current location'
                                });
                            }
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXeEpNyvOxirxB38hoys2_U7lTvQllS9g&callback=initMap"></script>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.admin_right_sidebar')
    <!-- Mainly scripts -->

    <script src="{{ URL::asset('public/admin/js/jquery-3.1.1.min.js') }}"></script>
   
	
@stop
