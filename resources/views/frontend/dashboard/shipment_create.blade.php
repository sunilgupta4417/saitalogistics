@extends('frontend.layouts.master')
@section('page_content')
    <section id="where-from-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="where-from-design">
                        <h3 class="shipment-heading">Create New Shipment</h3>
                        <form id="signUpForm" action="{{ url('user/shipment/store') }}" method="POST">
                            {{ csrf_field() }}
                              <!-- start step indicators -->
                              <div class="form-header d-flex">
                                    <span class="stepIndicator">Where From</span>
                                    <span class="stepIndicator">Where Going</span>
                                    <span class="stepIndicator">What</span>
                                    <span class="stepIndicator">How</span>
                                    <span class="stepIndicator">Review</span>
                                    <span class="stepIndicator">Payment</span>
                                    <span class="stepIndicator lasting">Complete</span>
                              </div>
                              <!-- end step indicators -->

                                <!-- Step1 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Where Are You Shipment Form?</h3>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                    <select id="select-service" required name="S_country"> 
                                                    <option label="Select a country ... " selected="selected" >Select a country ... </option>   
                                                    @foreach($country as $ctr)
                                                    <option value="{{$ctr->id}}" >{{$ctr->country_name}}</option>
                                                    @endforeach
                                                    </select>                                 
                                                
                                            </div>
                                            <div class="form-group">
                                                <label>Company Or Name</label>
                                                <input type="text" name="S_name" id="sname" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="number" name="S_contact" id="scontact" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="S_address" id="saddress" oninput="this.className = ''">
                                            </div>
                                            <div class="form-group">
                                                <label>Apartment / Suite / Unit / Building etc</label>
                                                <input type="text" name="S_appartment" id="sappartment" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>Department, C/D etc</label>
                                                <input type="text" name="S_department" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>Postcode</label>
                                                <input type="number" name="S_pincode" id="spincode" oninput="this.className = ''" >
                                            </div>
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" oninput="this.className = ''" name="S_city" id="scity">
                                            </div>
                                            <div class="form-group">
                                                <label>Other Address Information</label>
                                                <input type="text" oninput="this.className = ''" name="S_other">
                                            </div>

                                            <div class="form-group agreed-text not-boarding">
                                                <label class="container">
                                                    <p><b>Use this as my default address</b></p>
                                                    <input type="radio" name="S_address_type" value="Default">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                            <div class="form-group agreed-text not-boarding">
                                                <label class="container">
                                                    <p><b>This Is A Residential Address</b></p>
                                                    <input type="radio" name="S_address_type" value="Residential">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="form-group"></div>

                                            <div class="form-group">
                                                <label>Email Id</label>
                                                <input type="text" oninput="this.className = ''" name="S_email">
                                            </div>

                                            <div class="form-group">
                                                <label>Telephone</label>
                                                <input type="text" oninput="this.className = ''" name="S_phone">
                                            </div>

                                            <div class="form-group">
                                                <label>KYC Document</label>
                                                <select id="select-service" required="" oninput="this.className = ''" name="S_idProof">
                                                    <option></option>
                                                    <option value="aadhar card">Aadhar Card</option>
                                                    <option value="voter id card">Voter Id Card</option>
                                                    <option value="driving licence">Driving Licence</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Upload KYC Id Image Front</label>
                                                <input type="file" oninput="this.className = ''" accept=".jpg, .png, .jpeg, .heic" name="S_kycFront" class="">
                                            </div>

                                            <div class="form-group">
                                                <label>Upload KYC Id Image Back</label>
                                                <input type="file" oninput="this.className = ''" accept=".jpg, .png, .jpeg, .heic" name="S_kycBack">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step2 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Where Is Your Shipping Going?</h3>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select id="select-service" required="" oninput="this.className = ''" name="R_country" id="rcountry">
                                                    <option></option>
                                                    @foreach($country as $ctr)
                                                    <option value="{{$ctr->id}}" >{{$ctr->country_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Company Or Name</label>
                                                <input type="text" oninput="this.className = ''" name="R_name" id="rname">
                                            </div>
                                            <div class="form-group">
                                                <label>Contact</label>
                                                <input type="number" oninput="this.className = ''" name="R_contact" id="rcontact">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" oninput="this.className = ''" name="R_address" id="raddress">
                                            </div>
                                            <div class="form-group">
                                                <label>Apartment / Suite / Unit / Building etc</label>
                                                <input type="text" oninput="this.className = ''" name="R_appartment">
                                            </div>
                                            <div class="form-group">
                                                <label>Department, C/D etc</label>
                                                <input type="text" oninput="this.className = ''" name="R_department">
                                            </div>
                                            <div class="form-group">
                                                <label>Postcode</label>
                                                <input type="number" oninput="this.className = ''" name="R_pincode">
                                            </div>
                                            <div class="form-group">
                                                <label>City</label>
                                                 <input type="text" oninput="this.className = ''" name="R_city">
                                            </div>
                                            <div class="form-group">
                                                <label>Other Address Information</label>
                                                <input type="text" oninput="this.className = ''" name="R_other">
                                            </div>

                                            <div class="form-group">
                                                <label>Email Id</label>
                                                <input type="text" oninput="this.className = ''" name="R_email">
                                            </div>

                                            <div class="form-group">
                                                <label>Telephone</label>
                                                <input type="text" oninput="this.className = ''" name="R_phone">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--  Step3 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Whats Your Shipment</h3>
                                            </div>
                                            <div class="where-boxing">
                                                <div class="form-group">
                                                    <label>Courier Type</label>
                                                    <select id="select-service" required="" oninput="this.className = ''" name="courier_type">
                                                        <option value=""></option>
                                                        <option value="Fedex">Fedex</option>
                                                        <option value="DHL">DHL</option>
                                                        
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Weight</label>
                                                    <input type="text" oninput="this.className = ''" name="weight" id="weight">
                                                </div>
                                                <div class="form-group">
                                                    <label>Length</label>
                                                    <input type="text" oninput="this.className = ''" name="length" id="length">
                                                </div>
                                                <div class="form-group">
                                                    <label>Width</label>
                                                    <input type="text" oninput="this.className = ''" name="width" id="width">
                                                </div>
                                                <div class="form-group">
                                                    <label>Height</label>
                                                    <input type="text" oninput="this.className = ''" name="height" id="height">
                                                </div>
                                                <div class="form-group">
                                                    <label>Declared value</label>
                                                    <input type="text" oninput="this.className = ''" name="dvalue" id="dvalue">
                                                </div>
                                                <div class="form-group">
                                                    <label>Item type</label>
                                                    <input type="text" oninput="this.className = ''" name="item_type" id="item_type">
                                                </div>
                                                <div class="form-group">
                                                    <label>Shipping charges</label>
                                                    <input type="text" oninput="this.className = ''" name="shipping_charge">
                                                </div>
                                            </div>
                                            <div class="step-image">
                                                <img src="assets/images/step-img.png" alt="" class="img-responsive">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step4 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">How Would You Like To Ship?</h3>
                                            </div>

                                            <div class="form-group agreed-text full-widthing">
                                                <label>Would you like to pickup your shipment?</label>
                                                <label class="container">
                                                    <p><b>Would you like to drop your shipment?</b></p>
                 <input type="radio" checked="checked" name="dropPickup" value="cdrop" onclick="show1();">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                            <div class="form-group agreed-text full-widthing">
                                                <label class="container">
                                                    <p><b>Yes pickup my shipment</b></p>
                <input type="radio" name="dropPickup" value="cpickup" onclick="show2();">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label>Drop off date</label>
                                                <input data-provide="datepicker" id="dropDate" type="text" oninput="this.className = ''" name="date">
                                            </div>



                                        </div>
                                    </div>
                                </div>

                                <!-- Step5 -->
                                <div class="step">
                                    <div class="inter-form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="maining-heading">
                                                    <h3 class="mb-4">Where From</h3>
                                                    <a href="#" class="edit-clss" style="display:none">Edit</a>
                                                </div>
                                                <div class="maing-address">
                                                    <h4 class="rsname">Tayla Dhyll</h4>
                                                    <p  class="rsaddress">Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</p>
                                                    <b  class="rscontact">+15678987645</b>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="maining-heading">
                                                    <h3 class="mb-4">Where Going</h3>
                                                    <a href="#" class="edit-clss" style="display:none">Edit</a>
                                                </div>
                                                <div class="maing-address">
                                                    <h4 class="rrname">Tayla Dhyll</h4>
                                                    <p class="rraddress">Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</p>
                                                    <b class="rrcontact">+15678987645</b>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="what-details">
                                                    <div class="what-detail-iner">
                                                        <h3>What</h3>
                                                        <a href="#" class="edit-clss" style="display:none">Edit</a>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                  <td>Weight</td>
                                                                  <td class="rweight">8.1 Lbs/3.67 Kgs</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Dimensions</td>
                                                                  <td class="rdim">17X12X4 In.</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Total Pieces</td>
                                                                  <td class="rpiece">1</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Total Shipment Weight</td>
                                                                  <td class="rtweight">8.1 Lbs/3.67 Kgs</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Packaging</td>
                                                                  <td class="rpackaging">Your Packaging</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="what-details">
                                                    <div class="what-detail-iner">
                                                        <h3>How</h3>
                                                        <a href="#" class="edit-clss" style="display:none">Edit</a>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                  <td>Type selected</td>
                                                                  <td class="rdrop">I will drop it off</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Drop date</td>
                                                                  <td class="rdropdate">22 Feb 2023</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Drop address</td>
                                                                  <td>Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="what-details">
                                                    <div class="agreed-text not-boarding">
                                                        <label class="container">
                                                            <p style="font-size:14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                                                            <input type="radio" name="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step6 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Who Would You Like To Pay?</h3>
                                            </div>
                                            <div class="where-boxing">
                                                Coming soon
                                            </div>
                                            <div class="paymment-right-details">
                                                <h3>Amount Payables Details</h3>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                          <td><b>Particulars</b></td>
                                                          <td><b>Amount</b></td>
                                                        </tr>
                                                        <tr>
                                                          <td>Total</td>
                                                          <td>$<?php echo $total = rand(20 , 30);?></td>
                                                        </tr>
                                                        <tr>
                                                          <td>Tax & Duties</td>
                                                          <td>$<?php echo $tax = rand(5 , 10)?></td>
                                                        </tr>
                                                        <tr>
                                                          <td><b>Payable Amount</b></td>
                                                          <td><b>$ <?php echo $total + $tax?></b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="payment-details">
                                                <h3>Duties & Taxes</h3>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley .</p>
                                            </div>
                                             <div class="payment-btns">
                                                <input type="submit" class="down-btn" name="submit" value="Proceed to Pay">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               

                                <!-- Step7 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="payment-successful">
                                                <img src="assets/images/successful.svg" alt="" class="img-responsive">
                                                <h3>Payment Successful</h3>
                                                <p>Your shipment has been successfully added Track with your Waybill No. <b>3456789098</b></p>
                                            </div>
                                            <div class="payment-btns">
                                                <a href="#" class="down-btn">Download Invoice</a>
                                                <a href="#" class="done-btn">Done</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- start previous / next buttons -->
                                <div class="form-footer">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)"><img src="assets/images/back-btn.svg" alt="" class="img-responsive"> Back</button>
                                    <button type="button" id="cencalBtn">Cancel</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Continue</button>
                                </div>
                              <!-- end previous / next buttons -->
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_body_scripts')
<script>
     $('.tab-link').click( function() {
     var tabID = $(this).attr('data-tab');
     $(this).addClass('active').siblings().removeClass('active');
     $('#tab-'+tabID).addClass('active').siblings().removeClass('active');
     });
    </script>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab
            function showTab(n) {
              // This function will display the specified tab of the form...
              var x = document.getElementsByClassName("step");
              x[n].style.display = "block";
              //... and fix the Previous/Next buttons:
              if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
              } else {
                document.getElementById("prevBtn").style.display = "inline";
              }
              if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
              } else {
                document.getElementById("nextBtn").innerHTML = "Continue";
              }
              //... and run a function that will display the correct step indicator:
              fixStepIndicator(n)
            }
            
            function nextPrev(n) {
                console.log(n)
              // This function will figure out which tab to display
              var x = document.getElementsByClassName("step");
              // Exit the function if any field in the current tab is invalid:
              if (n == 1 && !validateForm()) return false;
              // Hide the current tab:
              x[currentTab].style.display = "none";
              // Increase or decrease the current tab by 1:
              currentTab = currentTab + n;
              console.log(currentTab);
              if(currentTab==5)
              {
                $(".form-footer").hide();
              }else{
                $(".form-footer").show();
              }
              if(currentTab==4)
              {
                $(".rsname").html($("#sname").val())
                $(".rsaddress").html($("#saddress").val())
                $(".rscontact").html($("#scontact").val())
                $(".rrname").html($("#rname").val())
                $(".rraddress").html($("#raddress").val())
                $(".rrcontact").html($("#rcontact").val())

                $(".rweight").html($("#weight").val())
                $(".rdim").html($("#length").val()+' * '+$("#width").val()+' * '+$("#height").val())
                $(".rpiece").html(1)
                $(".rtweight").html($("#weight").val())

                if($('input[name="dropPickup"]:checked').val()=='cdrop')
                {
                    $(".rdrop").html('I will drop it off')
                }
                else if($('input[name="dropPickup"]:checked').val()=='cdrop')
                {
                    $(".rdrop").html('Pickup my shipment')
                }
                else
                {
                    $(".rdrop").html()
                }
                
                $(".rdropdate").html($("#dropDate").val())
              }
              
              // if you have reached the end of the form...
              if (currentTab >= 6) {
                // ... the form gets submitted:
                document.getElementById("signUpForm").submit();
                return false;
              }
              // Otherwise, display the correct tab:
              showTab(currentTab);
            }
            
            function validateForm() {
              // This function deals with validation of the form fields
              var x, y, i, valid = true;
              x = document.getElementsByClassName("step");
              y = x[currentTab].getElementsByTagName("input");
              // A loop that checks every input field in the current tab:
              for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                  // add an "invalid" class to the field:
                  y[i].className += " invalid";
                  // and set the current valid status to false
                  valid = false;
                }
              }
              // If the valid status is true, mark the step as finished and valid:
              if (valid) {
                document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
              }
              return valid; // return the valid status
            }
            
            function fixStepIndicator(n) {
              // This function removes the "active" class of all steps...
              var i, x = document.getElementsByClassName("stepIndicator");
              for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
              }
              //... and adds the "active" class on the current step:
              x[n].className += " active";
            }
    </script>

<script type="text/javascript"> 
function show1(){
  document.getElementById('div1').style.display ='none';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
}
</script>
@endsection
