@extends('frontend.layouts.master')
@section('page_content')
    <section id="faq-page">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-6">
                  <div class="heading text-center service-heading-iner">
                     <span class="text-color">Learn How To Get Started</span>
                     <h2 class="mb-3">Frequently Asked Questions</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="wrapper">
                     <div class="tab-wrapper">
                        <ul class="tabs">
                           <li class="tab-link active" data-tab="1">General</li>
                           <li class="tab-link" data-tab="2">Shipping</li>
                           <li class="tab-link" data-tab="3">Payment</li>
                           <li class="tab-link" data-tab="4">Tracking</li>
                        </ul>
                     </div>
                     <div class="content-wrapper">
                        <div id="tab-1" class="tab-content active">
                           <div id="accordion" class="myaccordion">
                              <div class="card">
                                 <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                       <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                       What is Lorem Ipsum?
                                       <span class="fa-stack fa-sm">
                                          <img src="assets/images/down-arrow.png" alt="" class="img-responsive">
                                       </span>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                       <div class="row">
                                          <div class="col-md-5">
                                             <div class="left-video">
                                                <div class="banner-img mt-5 mt-lg-0">
                                                   <div id="all">
                                                   <a id="play-video" class="play-button" data-url="https://www.youtube.com/embed/XJj2PbenIsU?rel=0&autoplay=1" data-toggle="modal" data-target="#myModal" title="XJj2PbenIsU"><img src="assets/images/faq-play-video.svg" alt="" class="img-responsive"></a>
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
                                                     <img src="assets/images/faq-img.png" alt="" class="img-fluid">
                                                 </div>
                                             </div>
                                          </div>
                                          <div class="col-md-2"></div>
                                          <div class="col-md-5">
                                             <div class="right-video-text">
                                                <h3>You don’t need to do anything else</h3>
                                                <p>Mix-and-match dozens of responsive elements to quickly configure your favorite landing page layouts. <br> <br> Or hit the ground running with 10 pre-built templates, all in light or dark mode."</p>
                                                <a href="#" class="btn btn-main-2 track-shipment-clr">Learn More </a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                       <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                       Why do we use it?
                                       <span class="fa-stack fa-2x">
                                          <img src="assets/images/down-arrow.png" alt="" class="img-responsive">
                                       </span>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                       <div class="row">
                                          <div class="col-md-5">
                                             <div class="right-video-text">
                                                <h3>You don’t need to do anything else</h3>
                                                <p>Mix-and-match dozens of responsive elements to quickly configure your favorite landing page layouts. <br> <br> Or hit the ground running with 10 pre-built templates, all in light or dark mode."</p>
                                                <a href="#" class="btn btn-main-2 track-shipment-clr">Learn More </a>
                                             </div>
                                          </div>
                                          <div class="col-md-2"></div>
                                          <div class="col-md-5">
                                             <div class="left-video">
                                                <div class="banner-img mt-5 mt-lg-0">
                                                   <div id="all">
                                                   <a id="play-video" class="play-button" data-url="https://www.youtube.com/embed/XJj2PbenIsU?rel=0&autoplay=1" data-toggle="modal" data-target="#myModal" title="XJj2PbenIsU"><img src="assets/images/faq-play-video.svg" alt="" class="img-responsive"></a>
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
                                                     <img src="assets/images/faq-img.png" alt="" class="img-fluid">
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                       <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                       Where does it come from?
                                       <span class="fa-stack fa-2x">
                                          <img src="assets/images/down-arrow.png" alt="" class="img-responsive">
                                       </span>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                       <div class="row">
                                          <div class="col-md-5">
                                             <div class="left-video">
                                                <div class="banner-img mt-5 mt-lg-0">
                                                   <div id="all">
                                                   <a id="play-video" class="play-button" data-url="https://www.youtube.com/embed/XJj2PbenIsU?rel=0&autoplay=1" data-toggle="modal" data-target="#myModal" title="XJj2PbenIsU"><img src="assets/images/faq-play-video.svg" alt="" class="img-responsive"></a>
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
                                                     <img src="assets/images/faq-img.png" alt="" class="img-fluid">
                                                 </div>
                                             </div>
                                          </div>
                                          <div class="col-md-2"></div>
                                          <div class="col-md-5">
                                             <div class="right-video-text">
                                                <h3>You don’t need to do anything else</h3>
                                                <p>Mix-and-match dozens of responsive elements to quickly configure your favorite landing page layouts. <br> <br> Or hit the ground running with 10 pre-built templates, all in light or dark mode."</p>
                                                <a href="#" class="btn btn-main-2 track-shipment-clr">Learn More </a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header" id="headingFour">
                                    <h2 class="mb-0">
                                       <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                       Where can I get some?
                                       <span class="fa-stack fa-2x">
                                          <img src="assets/images/down-arrow.png" alt="" class="img-responsive">
                                       </span>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                    <div class="card-body">
                                       <div class="row">
                                          <div class="col-md-5">
                                             <div class="right-video-text">
                                                <h3>You don’t need to do anything else</h3>
                                                <p>Mix-and-match dozens of responsive elements to quickly configure your favorite landing page layouts. <br> <br> Or hit the ground running with 10 pre-built templates, all in light or dark mode."</p>
                                                <a href="#" class="btn btn-main-2 track-shipment-clr">Learn More </a>
                                             </div>
                                          </div>
                                          <div class="col-md-2"></div>
                                          <div class="col-md-5">
                                             <div class="left-video">
                                                <div class="banner-img mt-5 mt-lg-0">
                                                   <div id="all">
                                                   <a id="play-video" class="play-button" data-url="https://www.youtube.com/embed/XJj2PbenIsU?rel=0&autoplay=1" data-toggle="modal" data-target="#myModal" title="XJj2PbenIsU"><img src="assets/images/faq-play-video.svg" alt="" class="img-responsive"></a>
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
                                                     <img src="assets/images/faq-img.png" alt="" class="img-fluid">
                                                 </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="card">
                                 <div class="card-header" id="headingFive">
                                    <h2 class="mb-0">
                                       <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                       Where does it come from?
                                       <span class="fa-stack fa-2x">
                                          <img src="assets/images/down-arrow.png" alt="" class="img-responsive">
                                       </span>
                                       </button>
                                    </h2>
                                 </div>
                                 <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                    <div class="card-body">
                                       <div class="row">
                                          <div class="col-md-5">
                                             <div class="left-video">
                                                <div class="banner-img mt-5 mt-lg-0">
                                                   <div id="all">
                                                   <a id="play-video" class="play-button" data-url="https://www.youtube.com/embed/XJj2PbenIsU?rel=0&autoplay=1" data-toggle="modal" data-target="#myModal" title="XJj2PbenIsU"><img src="assets/images/faq-play-video.svg" alt="" class="img-responsive"></a>
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
                                                     <img src="assets/images/faq-img.png" alt="" class="img-fluid">
                                                 </div>
                                             </div>
                                          </div>
                                          <div class="col-md-2"></div>
                                          <div class="col-md-5">
                                             <div class="right-video-text">
                                                <h3>You don’t need to do anything else</h3>
                                                <p>Mix-and-match dozens of responsive elements to quickly configure your favorite landing page layouts. <br> <br> Or hit the ground running with 10 pre-built templates, all in light or dark mode."</p>
                                                <a href="#" class="btn btn-main-2 track-shipment-clr">Learn More </a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div id="tab-2" class="tab-content">
                           <div class="accordion-iner">
                              <h3>Welcome to Saitalogistics-2</h3>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                           </div>
                        </div>
                        <div id="tab-3"class="tab-content">
                           <div class="accordion-iner">
                              <h3>Welcome to Saitalogistics-3</h3>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                           </div>
                        </div>
                        <div id="tab-4"class="tab-content"> 
                           <div class="accordion-iner">
                              <h3>Welcome to Saitalogistics-4</h3>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <section class="section we-help">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-lg-6">
               <div class="heading text-center">
                  <h2 class="mb-3">How Can We Help You</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-4 col-md-6 ">

               <div class="pricing-item mb-4 mb-lg-0">
                  <div class="price-header">
                     <img src="assets/images/faq-icon/02.svg" alt="" class="img-fluid">
                     <h2>I Have A Question About Receiving A Package</h2>
                  </div>
                  <br>
                  <a href="#" class="number-text">+44 1234567890</a>
               </div>
            </div> 

            
            <div class="col-lg-4 col-md-6 ">
               <div class="pricing-item mb-4 mb-lg-0">
                  <div class="price-header">
                     <img src="assets/images/faq-icon/01.svg" alt="" class="img-fluid">
                     <h2>I Have A Question About Receiving A Package</h2>
                  </div>
                  <br>
                  <a href="#" class="number-text">+44 1234567890</a>
               </div>
            </div> 

            
            <div class="col-lg-4 col-md-6 ">
               <div class="pricing-item mb-4 mb-lg-0">
                  <div class="price-header">
                     <img src="assets/images/faq-icon/03.svg" alt="" class="img-fluid">
                     <h2>I Have A Question About Receiving A Package</h2>
                  </div>
                  <br>
                  <a href="#" class="number-text">+44 1234567890</a>
               </div>
            </div> 

         </div>
      </div>
   </section>

   <section class="section contact-frm">
      <div class="container">
            <div class="row">
               <div class="col-lg-6">
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
               <div class="col-lg-6">
                  <div class="contact-form">
                     <img src="assets/images/form-img.png" alt="" class="img-responsive">
                  </div>
               </div>
            </div>
      </div>
   </section>

@endsection
