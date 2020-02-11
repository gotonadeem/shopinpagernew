                        <div class="modal-scroll no-footer-popup">
                        <div class="catalog-name">(ID: {{$catatlog_details['id']}})</div>
                        <div class="catalog-name"><span>Catlog Name:-
                            {{$catatlog_details['name']}}</span>
                        </div>
                        <div class="catalog-description"><span><!-- react-text: 546 -->Description	 :-
						{{$catatlog_details['description']}}</span>
						</div>

                        <div class="catalog-data border-bottom">

							<div class="catalog-content"><strong>Created At :</strong>{{$catatlog_details['created_at']}}</div>
                            @if($catatlog_details['main_category']['name'])
							<div class="catalog-content"><strong>Main Category:</strong> {{$catatlog_details['main_category']['name']}}</div>
							@endif

							@if($catatlog_details['sub_category']['name'])
							<div class="catalog-content"><strong>Sub Category:</strong> {{$catatlog_details['sub_category']['name']}}</div>
							@endif
							
							@if($catatlog_details['super_sub_category']['name'])
							<div class="catalog-content"><strong>Super Sub Category:</strong> {{$catatlog_details['super_sub_category']['name']}}</div>
							@endif
							
                        </div>
                        <div class="margin-top-10">
                            <div class="relative">
							
                                <div class="text-bold">Images</div>
								<div class="stock-message"><span id="message"></span></div>
                                <div class="row-5">
                                    <div class="drop-image-preview">
									 @foreach($catatlog_details['product_image'] as $vs)
                                        <div class="relative border">
						                 <img src="{{ URL::asset('public/admin/uploads/product') }}/{{$vs['image']}}" data-src="{{ URL::asset('public/admin/uploads/product') }}/{{$vs['image']}}" style="height:60px; width:60px;border:1px solid #ccc;" >
                                         
                                         <div class="input-check-btn">
                                         <p style="padding:10px 0px;">{{$vs->size}}</p>
                                         <p>
                                        
                                         </p>   
                                         </div>                   
									   </div>
										    @endforeach
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                    </div>
<script>					
$('input[id="stock_image"]').click(function(){
	        var id= $(this).val();
			if($(this).prop("checked") == true){
			  var status=0;		  
            }
            else if($(this).prop("checked") == false){
              var status=1;
			}
			$.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: BASE_URL + '/seller/catalog/stock-image',
                data: {id:id,status:status},
                cache: false,
                success: function (response, textStatus, jqXHR) {
					data= JSON.parse(response);
					if(data.status)
					{
						if(status==0)
						{
							$("#message").html("Mark Out Stock Successfully").css('color','red');
						}
						
						if(status==1)
						{
							$("#message").html("Mark In Stock Successfully").css('color','green');
						}
						
					}
                }
            });
        });
</script>