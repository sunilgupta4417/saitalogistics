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
                            <h2 class="mb-3">Our Services</h2>
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
<section class="section process how-it-works" id="how-it-works-iner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="process-heading text-center">
                        <h2 class="mb-3 mt-2">How It Works</h2>
                        <span class="text-color">Easily Revolutionize Your Global Logistics And Simplify<br> Payments In Just A Few Simple Steps.</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-3">
                            <div class="process-item text-center">
                                <img src="{{asset('assets/images/cms/'.$cms1[0]->page_image.'')}}" alt="" class="img-responsive">
                                <span>Step 1</span>
                                <h4>{{$cms1[0]->page_title}}</h4>
                                <p>{{$cms1[0]->page_content}}</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="process-item text-center">
                                <img src="{{asset('assets/images/cms/'.$cms1[1]->page_image.'')}}" alt="" class="img-responsive">
                                <span>Step 2</span>
                                <h4>{{$cms1[1]->page_title}}</h4>
                                <p>{{$cms1[1]->page_content}}</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="process-item text-center">
                                <img src="{{asset('assets/images/cms/'.$cms1[2]->page_image.'')}}" alt="" class="img-responsive">
                                <span>Step 3</span>
                                <h4>{{$cms1[2]->page_title}}</h4>
                                <p>{{$cms1[2]->page_content}}</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="process-item text-center" id="broder-design">
                                <img src="{{asset('assets/images/cms/'.$cms1[3]->page_image.'')}}" alt="" class="img-responsive">
                                <span>Step 4</span>
                                <h4>{{$cms1[3]->page_title}}</h4>
                                <p>{{$cms1[3]->page_content}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ai-based-section about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="about-img mb-5 mb-lg-0">
                        <img src="{{asset('assets/images/cms/'.$cms2->page_image.'')}}" alt="" class="img-fluid">
                    </div>
                </div>

                <div class="col-lg-6 col-md-7">
                    <div class="about-item">
                        <h2>{{$cms2->page_title}}</h2>
                        <p>{!! $cms2->page_content !!}</p>
                        <a href="{{$cms2->page_link}}" class="btn btn-main-2">Book Now <i class="fa fa-angle-right ml-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
