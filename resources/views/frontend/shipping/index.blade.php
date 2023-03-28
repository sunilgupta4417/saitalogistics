@extends('frontend.layouts.master')
@section('page_content')
    <section class="banner">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7 col-lg-6">
                    <div class="banner-content">
                        <span class="trac-text">TAKING LOGISTICS TO ANOTHER LEVEL</span>
                        <h1 class="mt-2">Your Crypto Has New Utility: <span>Shipping Anything Worldwide</span></h1>
                        <p>We are the name of the game when it comes to Mooving things<br> from point A to point B.</p>
                        <a href="#" class="btn btn-main-2">Send Package </a>  
                        <a href="#" class="btn btn-main-2 track-shipment-clr">Track Shipment </a>  
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="banner-img mt-5 mt-lg-0">
                        <div id="all">
                            <a id="play-video" class="play-button" data-url="https://www.youtube.com/embed/XJj2PbenIsU?rel=0&autoplay=1" data-toggle="modal" data-target="#myModal" title="XJj2PbenIsU"><img src="assets/images/play-btn.svg" alt="" class="img-responsive"></a>
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
                        <img src="assets/images/banner/img-2.png" alt="" class="img-fluid">
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
                        <h2 class="mb-3 mt-2">How it works</h2>
                        <span class="text-color">Stacks Is A Production-Ready Library Of Stackable<br> Content Blocks Built In React Native.</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-3">
                            <div class="process-item text-center">
                                <img src="assets/images/how-it-works-icons/icon.svg" alt="" class="img-responsive">
                                <span>Step 1</span>
                                <h4>Order Upload</h4>
                                <p>Allotment Of Delivery Executives And The Shipments Based On The Allocation Sheet Provided By The Client.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="process-item text-center">
                                <img src="assets/images/how-it-works-icons/icon-2.svg" alt="" class="img-responsive">
                                <span>Step 2</span>
                                <h4>Dispatch</h4>
                                <p>Pack Your Orders, Print Labels And Hand It Over To The Delivery Executives.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="process-item text-center">
                                <img src="assets/images/how-it-works-icons/icon-3.svg" alt="" class="img-responsive">
                                <span>Step 3</span>
                                <h4>Tracking</h4>
                                <p>Track The Order And Keep Your Customers Informed Via Sms And Email Notifications.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="process-item text-center" id="broder-design">
                                <img src="assets/images/how-it-works-icons/icon-3.svg" alt="" class="img-responsive">
                                <span>Step 4</span>
                                <h4>Reporting</h4>
                                <p>Track The Order And Keep Your Customers Informed Via Sms And Email Notifications.</p>
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
                <div class="col-lg-4 col-md-4">
                    <div class="pricing-item mb-4 mb-lg-0">
                        <div class="price-header">
                            <img src="assets/images/package-icon/icon1.svg" alt="" class="img-fluid">
                            <h2>Package Shipment</h2>
                        </div>
                        <div class="price-features">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                        </div>

                        <a href="#" class="btn btn-main-2">Know More</a>
                    </div>
                </div> 

                <div class="col-lg-4 col-md-4">
                    <div class="pricing-item mb-4 mb-lg-0">
                        <div class="price-header">
                            <img src="assets/images/package-icon/icon2.svg" alt="" class="img-fluid">
                            <h2>Container Cargo</h2>
                        </div>
                        <div class="price-features">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                        </div>

                        <a href="#" class="btn btn-main-2">Know More</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="pricing-item">
                        <div class="price-header">
                            <img src="assets/images/package-icon/icon3-(1).png" alt="" class="img-fluid">
                            <h2>Global Logistics</h2>
                        </div>
                        <div class="price-features">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                        </div>

                        <a href="#" class="btn btn-main-2">Know More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section about we-give">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="about-img mb-5 mb-lg-0">
                        <img src="assets/images/bg/about_img.png" alt="" class="img-fluid">
                    </div>
                </div>

                <div class="col-lg-6 col-md-7">
                    <div class="about-item">
                        <h2>We Give You Control Of Your Shipments</h2>
                        <p>Saita logistics invest time and expertise to fully understand your business before designing plans to improve your supply chain. We take responsibility for the performance of all our suppliers and for ensuring the availability of resources and equipment needed to control the flow of goods under our charge. & easy Pay with crypto using <span class="orng-clr">SaitaPro</span> or <span class="orng-clr">ePay.me</span></p>
                        <a href="#" class="btn btn-main-2">Know More <i class="fa fa-angle-right ml-2"></i></a>  
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="payment-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="about-item">
                        <h2>Best payment Solution we Provide</h2>
                        <p><span class="orng-clr">Accepted Tokens (Saitama, Srlty, Usdt)</span> And Payment Through <span class="orng-clr">Epay.Me</span> Lorem Ipsum Is Simply Dummy Text Of The Printing And Typesetting Industry. Lorem Ipsum Has Been The Industry’s Standard Dummy Text Ever Since The 1500S, When An Unknown Printer Took A Galley Of Type And Scrambled.</p>
                        <a href="#" class="btn btn-main-2">Know More <i class="fa fa-angle-right ml-2"></i></a>  
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="about-img mb-5 mb-lg-0">
                        <img src="assets/images/bg/payment_img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-grey cta">
        <div class="container">
            <div class="track-div">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="cta-content text-center">
                            <h2 class="mt-3 mb-4">track your parcel</h2>
                            <form action="">
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
    </section>

    <section class="ai-based-section about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="about-img mb-5 mb-lg-0">
                        <img src="assets/images/bg/ai-based_img.png" alt="" class="img-fluid">
                    </div>
                </div>

                <div class="col-lg-6 col-md-7">
                    <div class="about-item">
                        <h2>Ai Based Shipment Option</h2>
                        <p>Saita Logistics Invest Time And Expertise To Fully Understand Your Business Before Designing Plans To Improve Your Supply Chain. We Take Responsibility For The Performance Of All Our Suppliers And For Ensuring The Availability Of Resources And Equipment Needed To Control The Flow Of Goods Under Our Charge. & Easy Pay With Crypto Using <span class="orng-clr">Saitapro</span> Or <span class="orng-clr">Epay.Me</span></p>
                        <a href="#" class="btn btn-main-2">Know More <i class="fa fa-angle-right ml-2"></i></a>  
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-grey cta contact-frm">
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
                                <form action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number" placeholder="Mobile Number">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" class="form-control" id="email" placeholder="Email"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-main-2">Submit</button>
                                </form>
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
                        <h2 class="mb-3 mt-2">About Saitama</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5 col-sm-6 col-md-6">
                            <div class="blog-item mb-5 mb-lg-0">
                                <img src="assets/images/saitama1.png" alt="" class="img-fluid">
                                <div class="blog-item-content">
                                    <h3 class="mt-3 mb-2"><a href="#">Connecting The People To Decentralized Finance</a></h3>
                                    <p>Saitama Is A Web 3.0 Technology Company Primarily Focused On Developing A Decentralized Finance Ecosystem For Everyday Life.</p>
                                    <a href="#" class="read-clr">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-6 col-md-6">
                            <div class="blog-item mb-5 mb-lg-0">
                                <img src="assets/images/saitama2.png" alt="" class="img-fluid">
                                <div class="blog-item-content">
                                    <h3 class="mt-3 mb-2"><a href="#">Our Journey</a></h3>
                                    <p>Saitama Started As A Community Token Project In June 2021. Led By A Team Of Professionals With Solid Backgrounds In Different Areas.</p>
                                    <a href="#" class="read-clr">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
