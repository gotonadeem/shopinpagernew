@extends('front.layout.front')
@section('content')
    <!--about section area start-->
    <div class="about_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                    <div class="about_section_one">
                        <h2 class="text-center">Cancelation and Returns</h2>
                        {!! $content->description!!}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!--about section area end-->
@endsection

