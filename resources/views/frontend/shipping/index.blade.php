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
                                 <input type="text" readonly value="Germany" name="from_country" class=""/>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>To Country</label>
                                 <select id="select-service" name="to_country" class="to_country" name="recipient_country" required>
                                 <option disabled>Select Country</option>
                                    @foreach(getCountries() as $key=>$coun)
                                       @if(session()->get('max_rate'))
                                          @php 
                                             $max_rate = session()->get('max_rate');
                                             $data = session()->get('data');
                                          @endphp
                                          <option value="{{$key}}" {{$cou->country == $data['destination'] ? 'selected' : ''}}>{{$coun}}</option>
                                       @else
                                       <option value="{{$key}}">{{$coun}}</option>
                                       @endif
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Weight KG</label>
                                  <input type="text" id="weight" name="weight" required>
                              </div>
                           </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Length CM</label>
                                  <input type="text" id="length" name="length" required>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Width CM</label>
                                  <input type="text" id="width" name="width" required>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Height CM</label>
                                  <input type="text" id="height" name="height" required>
                              </div>
                           </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                 <label>Declared value $</label>
                                  <input type="text" id="dvalue" name="dvalue" required>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="shipmentEstimationDetails">
                                 <div class="actualWeight"></div>
                                 <div class="actualShippingRates"></div>
                              </div>
                           </div>

                           <div class="col-lg-12">
                              <br>
                                 <div class="sub-btns text-center">
                                    <button id="getShippingEstimation" class="btn">Get Estimation</button>
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
                     <textarea type="text" class="form-control" id="email" placeholder="Message"></textarea>
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
@section('extra_body_scripts')
<script>
   $('#weight').keypress(function(){
      var package_type=$("select[name=package_type] option:selected").val();
      if(package_type=="Envelope"){
         if($('#weight').val()>0.3){
               alert("Please enter less then or equal 0.3");
               $('#weight').val("");
         }
      }
   });
   $('#getShippingEstimation').click(function(e){
      e.preventDefault();
      getRates();
   });
   function getRates() {
      $('#getShippingEstimation').html('Loading');
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
         }
      });
      var package_type = $("select[name=package_type]").find(":selected").val();
      var fromCountry = $("input[name=from_country]").val();
      var R_country = $("select[name=to_country]").find(":selected").val();
      var weight = $("input[name=weight]").val();
      var length = $("input[name=length]").val();
      var width = $("input[name=width]").val();
      var height = $("input[name=height]").val();
      if (weight == "" || length == "" || width == "" || height == "") {
         alert('Please fill all field');
         return;
      }
      const volumetricWeight = (length * width * height) / 6000;
      const roundedWeight = Math.ceil(volumetricWeight);
      $('.actualWeight').val(roundedWeight);
      var formData = {
         package_type,
         R_country,
         weight,
      };
      $.ajax({
         type: 'post',
         url: '/shipping/get-rates',
         data: formData,
         dataType: 'json',
         success: function (res) {
            console.log(res)
            if(res.error){
               alert(res.error);
               // return false;
            }else {
               $('.actualShippingRates').html("$"+res.rate)
               // return false
            }
         },
         error: function (res) {
            console.log(res);
            // return false
         }
      });
    }
    
</script>
@endsection