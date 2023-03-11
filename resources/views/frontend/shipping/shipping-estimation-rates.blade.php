@extends('frontend.layouts.master')
@section('page_content')
      <section class="section pricing" id="make-shipping">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-12">
                  <div class="heading text-center">
                     <h2 class="mb-3">Calculated Rate</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 col-lg-812">
                  <div class="shipment-history">
                        <div class="shipment-table">
                              <table class="rwd-table">
                                 <thead>
                                    <tr>
                                       <th>Fuel Surcharge</th>
                                       <th>Freight Surcharge</th>
                                       <th>Total Charge</th>
                                       <th>Currency</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td >{{isset($final_data['fuel_surcharge'])?$final_data['fuel_surcharge']:"Incorrect Data"}} USD</td>
                                       <td>{{isset($final_data['total_freight'])?$final_data['total_freight']:"Incorrect Data"}} USD</td>
                                       <td>{{isset($final_data['total_fedex_charge'])?$final_data['total_fedex_charge']:"Incorrect Data"}} USD</td>
                                       <td>USD</td>
                                 
                                    </tr>
                                    
                                 </tbody>
                              </table>
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      
      <section class="footer">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-3">
                  <div class="widget footer-widget mb-5 mb-lg-0">
                     <img src="assets/images/logo-dark.png" alt="Digicon" class="img-fluid">
                     <p class="mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                  </div>
               </div>
               <div class="col-lg-2 col-md-2">
               </div>
               <div class="col-lg-3 col-md-3">
                  <div class="widget footer-widget mb-5 mb-lg-0">
                     <ul class="list-unstyled footer-links">
                        <li><a href="about-us.html">About us</a></li>
                        <li><a href="services.html">Services</a></li>
                           <li><a href="shipping.html">Shipping</a></li>
                        <li><a href="tracking.html">Tracking</a></li>
                        <li><a href="support.html">Support</a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-1 col-md-1">
               </div>
               <div class="col-lg-3 col-md-3">
                  <div class="widget footer-widget mb-5 mb-lg-0">
                     <ul class="list-unstyled footer-links">
                        <li><a href="support.html">Support</a></li>
                        <li><a href="faq's.html">FAQ's</a></li>
                        <li><a href="terms-and-condition.html">Terms & Condition</a></li>
                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection