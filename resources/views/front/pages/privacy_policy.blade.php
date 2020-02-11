@extends('front.layout.front')
@section('content')
    <div class="breadcrumb_container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{URL::to('/')}}">Home ></a>
                            </li>
                            <li>Privacy Policy</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumb area end-->


    <!--about section area start-->
    <div class="about_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12">
                    <div class="about_section_one">
                        <h2 class="text-center">Privacy Policy</h2>
                        <hr>
                        {!!$content->description!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about section area end-->


    
@endsection