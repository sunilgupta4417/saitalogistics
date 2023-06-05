@extends('frontend.layouts.master')
@section('page_content')
<section class="banner">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="banner-content">
                    <span class="trac-text">{{$cms->page_title}}</span>
                    <h1 class="mt-2">{!! $cms->page_content !!}</p>
                        <a href="{{$cms->page_link[1]}}" class="btn btn-main-2">Send Package </a>
                        <a href="{{$cms->page_link[2]}}" class="btn btn-main-2 track-shipment-clr">Track Shipment </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                <div class="banner-img mt-5 mt-lg-0">
                    <div id="all">
                        <a id="play-video" class="play-button" data-url="{{$cms->page_link[0]}}" data-toggle="modal" data-target="#myModal" title="XJj2PbenIsU"><img src="assets/images/play-btn.svg" alt="" class="img-responsive"></a>
                    </div>
                    <!-- VIDEO MODAL -->
                    <div class="modal fade youtube-video" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div id="video-container" class="video-container">
                                        <iframe id="youtubevideo" src="" width="640" height="360" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="close-video" type="button" class="button btn btn-default" data-dismiss="modal"><i class="fas fa-times" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- VIDEO MODAL -->
                    <img src="{{asset('assets/images/cms/'.$cms->page_image.'')}}" alt="" class="img-fluid">
                </div>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>

<section class="section process how-it-works">
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

<section class="section pricing">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="heading text-center">
                    <h2 class="mb-3">World Class Services For New Generation Of Global Logistics</h2>
                    <span class="text-color">Best Service World Wide & Local Logistics.</span>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($service as $ser)
            <div class="col-lg-4 col-md-4">
                <div class="pricing-item mb-4 mb-lg-0">
                    <div class="price-header">
                        <img src="{{asset('assets/images/cms/'.$ser->page_image.'')}}" alt="" class="img-fluid">
                        <h2>{{$ser->page_title}}</h2>
                    </div>
                    <div class="price-features">
                        <p>{!! $ser->page_content !!}</p>
                    </div>

                    <a href="{{$ser->page_link}}" class="btn btn-main-2">Read More</a>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</section>



<!-- <section class="section bg-grey cta">
    <div class="container">
        <div class="track-div">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-content text-center">
                        <h2 class="mt-3 mb-4">track your parcel</h2>
                        <form action="tracking.html">
                            <div class="form-group">
                                <input type="email" class="form-control" id="tracking-id" placeholder="Tracking ID">
                                <button type="submit" class="btn btn-main-2">Track</button>
                            </div>
                        </form>
                        <span class="text-color">
                            <a href="#">Multiple Tracking Numbers | Need Help?</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

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

<section class="section bg-grey cta contact-frm" style="margin-bottom:0px;">
    <div class="container">
        <div class="track-div">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7">
                    <div class="track-boxing">
                        <div class="contact-heading">
                            <b>Contact Us</b>
                            <h3>Need To Make<br> An Enquiry</h3>
                        </div>
                        <div class="cta-content">
                            <form method="POST" action="{{route('contactus.store')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="phoneno" name="phoneno" placeholder="Mobile Number">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" id="message" name="message" placeholder="Message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-main-2">Submit</button>
                            </form>
                            @if (Session::get('message'))
                            <div class="alert alert-success alert-block mb-0">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="contact-form">
                        <img src="assets/images/form-img.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section process how-it-works">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="process-heading text-center">
                    <h2 class="mb-3 mt-2">About Us</h2>
                </div>
                <div class="row">
                    @foreach($about as $ser)
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="blog-item mb-5 mb-lg-0">
                            <img src="{{asset('assets/images/cms/'.$ser->page_image.'')}}" alt="" class="img-fluid">
                            <div class="blog-item-content">
                                <h3 class="mt-3 mb-2"><a href="{{$ser->page_link}}" style="text-decoration: underline;">{{$ser->page_title}}</a></h3>

                            </div>
                        </div>
                    </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>
</section>
@endsection