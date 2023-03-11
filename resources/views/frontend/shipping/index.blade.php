@extends('frontend.layouts.master')
@section('page_content')
     <!--========================= World Class Services Start Here ======================== -->
      <section class="section pricing" id="make-shipping">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-12">
                  <div class="heading text-center">
                     <h2 class="mb-3">Make Your Shipping Lightning Fast</h2>
                  </div>
               </div>
            </div>
            <div class="row">
            <div class="col-md-7 col-lg-8">
               <div class="shipment-details">
                  <h3>Calculate Shipping</h3>
                   <div class="shipment-form" id="calculate-form">
                     <form id="rate_calcu" action="{{route('shipping_rate')}}" method="POST">
                        @csrf
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Email ID</label>
                                  <input type="text" id="email" name="email" required>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Select Service</label>
                                 <select id="select-service" name="service_type">
                                    <option></option>
                                    <option value="Development">Development</option>
                                    <option value="Graphics">Graphics</option>
                                    <option value="Mobile App">Mobile App</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>From Country</label>
                                 <select id="select-service" name="shipper_country">
                                    <option></option>
                                    <option value="Development">Development</option>
                                    <option value="Graphics">Graphics</option>
                                    <option value="Mobile App">Mobile App</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>From State</label>
                                 <select id="select-service" name="shipper_state">
                                    <option></option>
                                    <option value="Development">Development</option>
                                    <option value="Graphics">Graphics</option>
                                    <option value="Mobile App">Mobile App</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Shipper Postal Code</label>
                                  <input type="text" id="shipper_postal" name="shipper_postal" required>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>To Country</label>
                                 <select id="select-service" name="recipient_country">
                                    <option></option>
                                    <option value="Development">Development</option>
                                    <option value="Graphics">Graphics</option>
                                    <option value="Mobile App">Mobile App</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>To State</label>
                                 <select id="select-service" name="recipient_state">
                                    <option></option>
                                    <option value="Development">Development</option>
                                    <option value="Graphics">Graphics</option>
                                    <option value="Mobile App">Mobile App</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Recipient Postal Code</label>
                                  <input type="text" id="recipient_postal" name="recipient_postal" required>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label>Width</label>
                                  <input type="text" id="weight" name="width" required>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label>Length</label>
                                  <input type="text" id="length" name="length" required>
                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="form-group">
                                 <label>Height</label>
                                  <input type="text" id="height" name="height" required>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <br>
                                 <div class="sub-btns text-center">
                                    <button type="submit" class="btn">Get Estimation</button>
                                 </div>
                           </div>
                        </div>
                    </form>
                   </div>
               </div>
            </div>

               <div class="col-lg-4 col-md-4">
                  <div class="create-right">
                     <h3>Create Your Shipment</h3>
                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem.</p>
                     <img src="assets/images/creat-image.png" alt="" class="img-responsive">
                     <a href="shipping-history.html" class="btn btn-main-2"> Get Started</a>
                  </div>
               </div>

            </div>
         </div>
      </section>

      <!--========================= World Class Services Start Here ======================== -->
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
