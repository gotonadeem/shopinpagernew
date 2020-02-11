@extends('front.layout.front')
@section('content')
    <div class="breadcrumb_container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ul>
                            <li>
                                <a href="index.html">Home ></a>
                            </li>
                            <li>FAQ</li>
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
                        <h2 class="text-center">FAQ</h2>
                        {!!$data->description!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about section area end-->
@endsection