@extends('front.layout.front')
@section('content')
    <section class="banner ab-us"><img src="{{URL::asset('public/images/grocerybanner.jpg')}}" class="img-fluid"><h2 class="text-center">Discount &amp; Offers</h2></section>
    <section class="about-sec  my-5">
        <div class="container">

            <div class="pb-5">
                <div class="privacy-policy">
                    <h5>DISCOUNT AND OFFERS</h5>
                    {!! $content->description !!}
                </div>
            </div>
        </div>
    </section>

@endsection