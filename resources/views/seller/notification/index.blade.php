@extends('seller.layouts.seller')
@section('content')
<div id="rightSidenav" class="right_side_bar">
    <div class="notice">
        <div class="notice-page-heading">Notifications</div>
        <div class="notice_page">
		<?PHP foreach($sellerNotification as $vs): ?>
            <div class="notice-container unread-notice">
                <div class="notice-header clearfix">
                    <div class="notice-date float-left">Posted: <?=date('d M Y h:i:a', strtotime($vs->created_at))?></div>
                    <div class="float-right">
                        <div class="notice-right-buttons notice-tags"></div>
                    </div>
                </div>
                <div class="notice-body">	
                    <div class="admin-notice-title"><?=$vs->title;?></div>
                    <div class="admin-notice-description">
					 <?=$vs->message;?>
					</div>
                </div>
            </div>
         <?PHP endforeach; ?>
		 <div class="payment-pagination text-center">

                            <div class="pagination-testing text-center">

							{{$sellerNotification->links()}}
                               

                            </div>

                        </div>
		 </div>
    </div>
</div>
@endsection