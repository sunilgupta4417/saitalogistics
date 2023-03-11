@extends('frontend.layouts.master')
@section('page_content')
@php($i=1)
@php($j=1)
@foreach($cms as $content)
@if($i==1)
        <section class="section about we-give" id="about-page">
                <div class="container">
@if($j==1)
        <div class="row justify-content-center">
                <div class="col-lg-6">
                        <div class="heading text-center service-heading-iner">
                                <h2 class="mb-3">Ou Services</h2>
                                <span class="text-color">From Small To Big, Now Paid With Crypto.</span>
                        </div>
                </div>
        </div>

@endif
                <div class="row">
                        <div class="col-lg-6">
                                <div class="about-img mb-5 mb-lg-0">
                                        <img src="{{asset('assets/images/cms/'.$content->page_image.'')}}" alt="" class="img-fluid">
                                </div>
                        </div>

                        <div class="col-lg-6">
                                <div class="about-item">
                                        <h2>{{$content->page_title}}</h2>
                                        <p>{{$content->page_content}}</p>
                                        <a href="{{$content->page_link}}" class="btn btn-main-2 book-now track-shipment-clr">Book Now </a>  
                                </div>
                        </div>

                        
                </div>
        </div>
</section>
@php($i=0)
@php($j=0)        
@else

<section class="payment-section">
        <div class="container">
                <div class="row">
                        <div class="col-lg-6">
                                <div class="about-item">
                                        <h2>{{$content->page_title}}</h2>
                                        <p>{{$content->page_content}}</p>
                                        <a href="{{$content->page_link}}" class="btn btn-main-2 book-now track-shipment-clr">Book Now </a>  
                        
                                </div>
                        </div>
                        <div class="col-lg-6">
                                <div class="about-img mb-5 mb-lg-0">
                                        <img src="{{asset('assets/images/cms/'.$content->page_image.'')}}" alt="" class="img-fluid">
                                </div>
                        </div>
                        
                </div>
        </div>
</section>

@php($i=1)
@endif        

@endforeach        

@endsection
