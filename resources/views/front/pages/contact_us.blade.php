@extends('front.layout.front')
@section('content')
    <!--breadcrumb area start-->
    <div class="breadcrumb_container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{URL::to('/')}}">Home ></a>
                            </li>
                            <li>contact</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="contact_area ptb-90">
      <div class="container">
       <div class="row">
         <div class="col-lg-8 col-md-7">
            <div class="contact_map_wrapper" >
                <div class="contact_map mb-40">
                   
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3560.2897192349437!2d75.8401568143639!3d26.830735970074972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396dc9dca6d43983%3A0x8077858ce6ccb529!2sShopinpager!5e0!3m2!1sen!2sin!4v1575704564352!5m2!1sen!2sin" width="750" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
				
                    
                </div>
                 <div class="contact-message">
                    <div class="contact_title">
                        <h4>Query Information</h4>
                        <div id="c_message"></div> 
                    </div>
                     
                    <form action="javascript:void(0)" id="contact_form" name="contact_form" novalidate>
                        <div class="row">
                            <div class="col-lg-6" >
                                <label for="name">Name<span>*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                            </div>
                            <div class="col-lg-6">
                                <label for="email">Email<span>*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                            </div>
                            <div class="col-lg-6">
                                <label for="mobile">Mobile<span>*</span> </label>
                                <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number">
                            </div>
                            <div class="col-lg-6">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject">
                            </div>
                            <div class="col-12">
                                <div class="contact-textarea">
                                    <label>Comment<span>*</span></label>
                                    <textarea name="comment" class="form-control" class="comment" id="comment" placeholder="Enter comment"></textarea>
                                </div>
                                <button type="button"  id="contact_button"> Send Message </button>
                            </div>
                        </div>
                        <p class="form-messege"></p>
                    </form>
                </div>
            </div>
        </div>
                <div class="col-lg-4 col-md-5">
                    <div class="contact_info_wrapper">
                        <div class="contact_title">
                            <h4>Location & Details</h4>
                        </div>
                        <div class="contact_info mb-15">
                            <div class="contact_info_icone">
                                <a href="#"><i class="icofont icofont-location-pin"></i></a>
                            </div>
                            <div class="contact_info_text">
                                <p><span>Address:</span> 251/1, PR TOWER, BRAJ VIHAR COLONY, OPPOSITE GURUDWARA  NEAR JAGATPURA FLYOVER, JAGATPURA, JAIPUR-302017 (RAJ.)</p>
                            </div>
                        </div>
                        <div class="contact_info mb-15">
                            <div class="contact_info_icone">
                                <a href="#"><i class="icofont icofont-email"></i></a>
                            </div>
                            <div class="contact_info_text">
                                <p><span>Email: </span> support@shopinpager.com </p>
                            </div>
                        </div>
                        <div class="contact_info mb-15">
                            <div class="contact_info_icone">
                                <a href="#"><i class="icofont icofont-phone"></i></a>
                            </div>
                            <div class="contact_info_text">
                                <p><span>Phone:</span> +91-8890701007  </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 @section('scripts')
 <script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
//var map = new google.maps.Map(document.getElementById("contact-map"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXeEpNyvOxirxB38hoys2_U7lTvQllS9g&callback=myMap"></script>
<script language="javascript" src="{{ URL::asset('/public/js/validation/jquery.validate.min.js') }}"></script>
<script language="javascript" src="{{ URL::asset('public/js/developer/contact_us.js') }}"></script>

@stop   
@endsection