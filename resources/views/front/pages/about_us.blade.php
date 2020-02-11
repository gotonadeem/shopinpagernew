@extends('front.layout.front')
@section('content')
    <!--about section area start-->
    <div class="about_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                    <div class="about_section_one">
                        {!! $content->description!!}
                    </div>
                    <div class="about__store__btn">
                        <a href="{{URL::to('/contact-us')}}">contact us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about section area end-->
@endsection

