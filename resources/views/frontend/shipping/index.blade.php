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
                     <form action="{{route('shipping_rate')}}" method="POST">
                        <!-- <form id="rate_calcu" action="javascript:void(0)"> -->
                        @csrf
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Packet type</label>
                                 <select id="select-service" name="package_type" required>
                                    <option></option>
                                    <option value="Envelope">Envelope</option>
                                    <option value="Documents">Documents</option>
                                    <option value="Non-Documents">Non Documents</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6 col-12">
                              <label>Mode</label>
                              <select id="select-service">
                                    <option value="export" selected>Export</option>
                              </select>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>From Country</label>
                                 <input type="text" readonly value="Germany" class=""/>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>To Country</label>
                                 <select id="select-service" class="to_country" name="recipient_country" required>
                                 <option disabled>Select Country</option>
                                    @foreach($country as $cou)
                                       @if(session()->get('max_rate'))
                                          @php 
                                             $max_rate = session()->get('max_rate');
                                             $data = session()->get('data');
                                          @endphp
                                          <option value="{{$cou->id}}" {{$cou->country == $data['destination'] ? 'selected' : ''}}>{{$cou->country}}</option>
                                       @else
                                       <option value="{{$cou->id}}">{{$cou->country}}</option>
                                       @endif
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Weight</label>
                                  <input type="text" id="weight" name="weight" required>
                              </div>
                           </div>
                           <div class="col-lg-12">
                              <br>
                                 <div class="sub-btns text-center">
                                    <button type="submit" id="submit_btn" class="btn">Get Estimation</button>
                                 </div>
                           </div>
                        </div>
                    </form>
                   </div>
               </div>
            </div>

               <!-- <div class="col-lg-4 col-md-4">
                  <div class="create-right">
                     <h3>Create Your Shipment</h3>
                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem.</p>
                     <img src="assets/images/creat-image.png" alt="" class="img-responsive">
                     <a href="shipping-history.html" class="btn btn-main-2"> Get Started</a>
                  </div>
               </div> -->
               @if(session()->get('max_rate'))
               <div class="col-lg-4 col-md-4" style="color: black;">
                  <div class="create-right">
                     <h3>Calculate Package Rates</h3><br>
                     @php 
                           $max_rate = session()->get('max_rate');
                           $data = session()->get('data');
                     @endphp
                     <div class="col-12"><div>
                     <span style="float: left;">Origin:</span>
                     <span id="fuel_sercharge" style="float: right;">{{$data['origin']}}</span><br/></div></div>
                     
                     <div class="col-12"> <div>
                     <span style="float: left;">Destination:</span>
                     <span id="freight_sercharge" style="float: right;">{{$data['destination']}}</span><br/>
                     </div>            </div>
                     <div class="col-12"> <div>
                     <span style="float: left;">Mode:</span>
                     <span id="freight_sercharge" style="float: right;">{{$data['mode']}}</span><br/>
                     </div>            </div>        
                     
                     <div class="col-12">
                     <div>
                     <span style="float: left;">Weight:</span>
                     <span id="day_of_deli" style="float: right;">{{$data['weight']}}</span><br/>
                     </div>      </div> <br>              
                     <b>Total Charge:<p style="color: black;"><i class="fas fa-euro-sign"></i> {{$max_rate}}</p></b>
                     <!-- <div class="col-12">
                     <div>
                     <span style="float: left;">Delivery Station:</span>
                     <span id="deli_station" style="float: right;"></span><br/>
                     </div>  </div>
                     <div class="col-12">
                      <div>
                     <span style="float: left;">Total Biling Units:</span>
                     <span id="tlt_bl_wight" style="float: right;"></span><br/>
                     </div></div>
                     <div class="col-12">
                     <div>
                     <span style="float: left;">Service Type:</span>
                      <span id="serv_type" style="float: right;"></span><br/>
                      </div>      </div>                -->
                      
                      
                  </div>
               </div>
               @else
               <div class="col-lg-4 col-md-4">
                  <div class="create-right">
                     <h3>Create Your Shipment</h3>
                     <p>Start booking a new shipment and pay with crypto.</p>
                     <img src="{{asset('assets/images/creat-image.png')}}" alt="" class="img-responsive">
                     <a href="{{route('user.create_shipment')}}" class="btn btn-main-2"> Get Started</a>
                  </div>
               </div>
               @endif
            </div>
         </div>
      </section>

      <!--========================= World Class Services Start Here ======================== -->
      <!-- <section class="section pricing">
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
      </section> -->

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
