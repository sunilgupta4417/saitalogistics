@extends('frontend.layouts.master')
@section('page_content')
<section id="where-from-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="where-from-design">
                        <h3 class="shipment-heading">Create New Shipment</h3>
                        <form id="signUpForm" action="{{route('user.store_shipment')}}" class="signUpForm" method="POST" enctype='multipart/form-data'>
                            @csrf
                              <!-- start step indicators -->
                              <div class="form-header d-flex">
                                    <span class="stepIndicator">Origin</span>
                                    <span class="stepIndicator">Destination</span>
                                    <span class="stepIndicator">How</span>
                                    <span class="stepIndicator">What</span>
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
                                                <label>Country*</label>
                                                <input type="text" name="S_country" readonly value="Germany">                                                                           
                                            </div>
                                            <div class="form-group">
                                                <label>Company Or Name*</label>
                                                <input type="text" name="S_name">
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Number*</label>
                                                <input type="number" name="S_contact">
                                            </div>
                                            <div class="form-group">
                                                <label>Address*</label>
                                                <input type="text" name="S_address">
                                            </div>
                                            <div class="form-group">
                                                <label>Apartment / Suite / Unit / Building etc*</label>
                                                <input type="text" name="S_appartment">
                                            </div>
                                            <div class="form-group">
                                                <label>Department, C/D etc</label>
                                                <input type="text" name="S_department">
                                            </div>
                                            <div class="form-group">
                                                <label>Postcode*</label>
                                                <input type="number" name="S_pincode">
                                            </div>
                                            <div class="form-group">
                                                <label>City*</label>
                                                <input type="text" name="S_city">
                                            </div>
                                            <div class="form-group">
                                                <label>State*</label>
                                                <input type="text" name="S_state">
                                            </div>
                                            <div class="form-group">
                                                <label>Land Mark</label>
                                                <input type="text" name="S_other">
                                            </div>

                                            <div class="form-group">
                                                <label>PAN</label>
                                                <input type="text" name="S_pan">
                                            </div>
                                            <div class="form-group">
                                                <label>GSTIN</label>
                                                <input type="text" name="S_gstin">
                                            </div>
                                            <div class="form-group">
                                                <label>IEC</label>
                                                <input type="text" name="S_iec">
                                            </div>
                                            <div class="form-group">
                                                <label>Aadhaar No</label>
                                                <input type="text" name="S_aadhaar">
                                            </div>

                                            <div class="form-group">
                                                &nbsp;
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
                                                <label>Email Id*</label>
                                                <input type="text" name="S_email">
                                            </div>

                                            <div class="form-group">
                                                <label>Telephone*</label>
                                                <input type="text" name="S_phone">
                                            </div>

                                            <div class="form-group">
                                                <label>KYC Document*</label>
                                                <select id="select-service" required name="S_idProof">
                                                    <option></option>
                                                    <option value="aadhar card">Aadhar Card</option>
                                                    <option value="voter id card">Voter Id Card</option>
                                                    <option value="driving licence">Driving Licence</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Upload KYC Id Image Front*</label>
                                                <div class="file-upload-wrapper">
                                                  <input name="S_idFront" type="file" class="file-upload-field">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Upload KYC Id Image Back*</label>
                                                <div class="file-upload-wrapper">
                                                  <input name="S_idBack" type="file" class="file-upload-field" >
                                                </div>
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
                                                <label>Country*</label>
                                                <select id="select-service" required name="R_country">
                                                <option label="Select a country ... " selected="selected">Select a country ... </option>  
                                                    @foreach($country as $coun)
                                                    <option value="{{$coun->id}}">{{$coun->country}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Company Or Name*</label>
                                                <input type="text" name="R_name">
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Number*</label>
                                                <input type="number" name="R_contact">
                                            </div>
                                            <div class="form-group">
                                                <label>Address*</label>
                                                <input type="text" name="R_address">
                                            </div>
                                            <div class="form-group">
                                                <label>Apartment / Suite / Unit / Building etc*</label>
                                                <input type="text" name="R_appartment">
                                            </div>
                                            <div class="form-group">
                                                <label>Department, C/D etc</label>
                                                <input type="text" name="R_department">
                                            </div>
                                            <div class="form-group">
                                                <label>Postcode*</label>
                                                <input type="number" name="R_pincode">
                                            </div>
                                            <div class="form-group">
                                                <label>City*</label>
                                                 <input type="text" name="R_city">
                                            </div>
                                            <div class="form-group">
                                                <label>State*</label>
                                                 <input type="text" name="R_state">
                                            </div>
                                            <div class="form-group">
                                                <label>Landmark</label>
                                                <input type="text" name="R_other">
                                            </div>

                                            <div class="form-group">
                                                <label>Email Id*</label>
                                                <input type="text" name="R_email">
                                            </div>

                                            <div class="form-group">
                                                <label>Telephone*</label>
                                                <input type="text" name="R_phone">
                                            </div>

                                            <div class="form-group">
                                                <label>TAN Number</label>
                                                <input type="text" name="R_tan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Step3 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">How Would You Like To Ship?</h3>
                                            </div>

                                            <div class="form-group agreed-text full-widthing">
                                                <label>Would you like to pickup your shipment?</label>
                                                <label class="container">
                                                    <p><b>I'll Drop off shipment</b></p>
                                                    <input type="radio" checked="checked" name="dropPickup" value="DROPOFF" onclick="show1();">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                            <div class="form-group agreed-text full-widthing">
                                                <label class="container">
                                                    <p><b>Yes pickup my shipment</b></p>
                                                    <input type="radio" name="dropPickup" value="PICKUP" onclick="show2();">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label>Appointment date and time</label>
                                                <input  type="datetime-local" name="date">
                                            </div>
                                            <div id="div1" class="">
                                            <div class="pickup-details">
                                                <div class="pickup-details-iner">
                                                <h3>Pickup Address</h3>
                                                <div class="maing-address">
                                                    <h4 id="pickup_from_name">Tayla Dhyll</h4>
                                                    <p id="pickup_from_address">Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</p>
                                                    <b id="pickup_from_number">+15678987645</b>
                                                    <div class="pickup-details-link">
                                                        <a href="javascript:void(0);" class="edit_frm_ad_btn">Edit</a>
                                                    </div>
                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  Step4 -->
                                <div class="step">
                                    <div class="row">
                                        <div class="inter-form">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Whats Your Shipment</h3>
                                            </div>
                                            <div class="where-boxing">
                                                <div class="form-group">
                                                <label>Packet type</label>
                                                <select id="select-service" name="package_type" required>
                                                    <option></option>
                                                    <option value="Envelope">Envelope</option>
                                                    <option value="Documents">Documents</option>
                                                    <option value="Non-Documents">Non Documents</option>
                                                </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Weight KG</label>
                                                    <input type="text" name="weight">
                                                </div>
                                                <div class="form-group">
                                                    <label>Length CM</label>
                                                    <input type="text" name="length">
                                                </div>
                                                <div class="form-group">
                                                    <label>Width CM</label>
                                                    <input type="text" name="width">
                                                </div>
                                                <div class="form-group">
                                                    <label>Height CM</label>
                                                    <input type="text" name="height">
                                                </div>
                                                <div class="form-group">
                                                    <label>Declared value $</label>
                                                    <input type="text" name="dvalue">
                                                </div>
                                                {{--<div class="form-group">
                                                    <label>Item type</label>
                                                    <input type="text" name="item_type">
                                                </div>--}}
                                                <div class="form-group">
                                                    <label>Shipping charges $</label>
                                                    <input type="text" name="shipping_charge" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-main-2 track-shipment-clr" id="get-rates">Get Rates</button>
                                                </div>
                                                <input type="hidden" name="actual_weight" id="actual_weight">
                                            </div>
                                            <div class="step-image">
                                                <img src="{{asset('assets/images/step-img.png')}}" alt="" class="img-responsive">
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
                                                    <a href="javascript:void(0);" class="edit-clss edit_frm_ad_btn">Edit</a>
                                                </div>
                                                <div class="maing-address">
                                                    <h4 id="from_name">Tayla Dhyll</h4>
                                                    <p id="from_address">Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</p>
                                                    <b id="from_number">+15678987645</b>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="maining-heading">
                                                    <h3 class="mb-4">Where Going</h3>
                                                    <a href="javascript:void(0);" class="edit-clss edit_go_ad_btn">Edit</a>
                                                </div>
                                                <div class="maing-address">
                                                    <h4 id="to_name">Tayla Dhyll</h4>
                                                    <p id="to_address">Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</p>
                                                    <b id="to_number">+15678987645</b>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="what-details">
                                                    <div class="what-detail-iner">
                                                        <h3>What</h3>
                                                        <a href="#" class="edit-clss">Edit</a>
                                                        <table style="width: 50%;">
                                                            <tbody>
                                                                <tr>
                                                                  <td>Weight</td>
                                                                  <td id="weight">8.1 Lbs/3.67 Kgs</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Dimensions</td>
                                                                  <td id="dimensions">17X12X4 In.</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Total Pieces</td>
                                                                  <td>1</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Total Shipment Weight</td>
                                                                  <td id="total_shipment_weight">8.1 Lbs/3.67 Kgs</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Packaging</td>
                                                                  <td id="packaging">Your Packaging</td>
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
                                                        <a href="#" class="edit-clss">Edit</a>
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                  <td>Type selected</td>
                                                                  <td id="ship_type">I will drop it off</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>Drop date</td>
                                                                  <td id="shipment_date">22 Feb 2023</td>
                                                                </tr>
                                                                <!-- <tr>
                                                                  <td>Drop address</td>
                                                                  <td>Unit 222, Rosden House 372 Old St, London, Greater London EC1 9AU, GB</td>
                                                                </tr> -->
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
                                                <div class="form-group">
                                                    <label>Payment type</label>
                                                    <select id="select-service" name="payment_gateway" class="">
                                                        <option></option>
                                                        <option value="Development">Development</option>
                                                        <option value="Graphics">Graphics</option>
                                                        <option value="Mobile App">Mobile App</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Card number</label>
                                                    <input type="text" name="Card number">
                                                </div>
                                                <div class="form-group">
                                                    <label>Name on card</label>
                                                    <input type="text" name="Name on card">
                                                </div>
                                                <div class="form-group">
                                                    <label>Expiry on card</label>
                                                    <input type="text" name="Expiry on card">
                                                </div>
                                                <div class="form-group">
                                                    <label>CVV</label>
                                                    <input type="text" name="CVV">
                                                </div>
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
                                                          <td>Total (2 Items)</td>
                                                          <td>$22.22</td>
                                                        </tr>
                                                        <tr>
                                                          <td>Tax & Duties</td>
                                                          <td>$5.13</td>
                                                        </tr>
                                                        <tr>
                                                          <td><b>Payable Amount</b></td>
                                                          <td><b>$ 27.53</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="payment-details">
                                                <h3>Duties & Taxes</h3>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley .</p>
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
        <div class="modal fade" id="update_from_address_modal" role="dialog" >
            <div class="modal-dialog modal-lg vertical-align-center" style="margin-top: 80px;">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Shipping From Address</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body ">
                    <div class="row">
                        <div class="inter-form signUpForm">
                            <div class="row mt-4">
                                <label class="col-sm-3">Address</label>
                                <input  class="col-sm-9" type="text" name="edit_S_address">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">Apartment / Suite / Unit / Building etc</label>
                                <input  class="col-sm-9" type="text" name="edit_S_appartment">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">Department, C/D etc</label>
                                <input  class="col-sm-9" type="text" name="edit_S_department">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">Postcode</label>
                                <input  class="col-sm-9" type="number" name="edit_S_pincode">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">City</label>
                                <input  class="col-sm-9" type="text" name="edit_S_city">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">State</label>
                                <input  class="col-sm-9" type="text" name="edit_S_state">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">Land Mark</label>
                                <input  class="col-sm-9" type="text" name="edit_S_other">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                    <button type="button" data-dismiss="modal" id="udt_frm_add" class="btn btn-info">Update</button>
                </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="update_going_address_modal" role="dialog" >
            <div class="modal-dialog modal-lg vertical-align-center" style="margin-top: 80px;">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Shipping Going Address</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body ">
                    <div class="row">
                        <div class="inter-form signUpForm">
                            <div class="row mt-4">
                                <label class="col-sm-3">Address</label>
                                <input  class="col-sm-9" type="text" name="edit_R_address">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">Apartment / Suite / Unit / Building etc</label>
                                <input  class="col-sm-9" type="text" name="edit_R_appartment">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">Department, C/D etc</label>
                                <input  class="col-sm-9" type="text" name="edit_R_department">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">Postcode</label>
                                <input  class="col-sm-9" type="number" name="edit_R_pincode">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">City</label>
                                <input  class="col-sm-9" type="text" name="edit_R_city">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">State</label>
                                <input  class="col-sm-9" type="text" name="edit_R_state">
                            </div>
                            <div class="row mt-4">
                                <label class="col-sm-3">Land Mark</label>
                                <input  class="col-sm-9" type="text" name="edit_R_other">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                    <button type="button" data-dismiss="modal" id="udt_go_add" class="btn btn-info">Update</button>
                </div>
              </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_body_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $('input').keyup(function(){
        // console.log($("input[name=dropPickup]:checked").val());
        $('#from_name').html($("input[name=S_name]").val());
        $('#from_address').html($('input[name=S_address]').val()+' , '+$('input[name=S_appartment]').val()+' , '+$('input[name=S_department]').val()+' , '+$('input[name=S_pincode]').val()+' , '+$('input[name=S_city]').val()+' , '+$('input[name=S_state]').val()+' , '+$('input[name=S_other]').val());
        $('#from_number').html($("input[name=S_contact]").val());
        $('#pickup_from_name').html($("input[name=S_name]").val());
        $('#pickup_from_address').html($('input[name=S_address]').val()+' , '+$('input[name=S_appartment]').val()+' , '+$('input[name=S_department]').val()+' , '+$('input[name=S_pincode]').val()+' , '+$('input[name=S_city]').val()+' , '+$('input[name=S_state]').val()+' , '+$('input[name=S_other]').val());
        $('#pickup_from_number').html($("input[name=S_contact]").val());
        $('#to_name').html($("input[name=R_name]").val());
        $('#to_address').html($('input[name=R_address]').val()+' , '+$('input[name=R_appartment]').val()+' , '+$('input[name=R_department]').val()+' , '+$('input[name=R_pincode]').val()+' , '+$('input[name=R_city]').val()+' , '+$('input[name=R_other]').val());
        $('#to_number').html($("input[name=R_contact]").val());
        $('#weight').html($("input[name=weight]").val() + " KG");
        $('#dimensions').html($("input[name=width]").val()+' X '+$("input[name=height]").val()+' X '+$("input[name=length]").val()+ ' CM');
        $('#total_shipment_weight').html($("input[name=weight]").val()+ ' KG');
        $('#packaging').html($("input[name=item_type]").val());
        $('#ship_type').html($("input[name=dropPickup]:checked").val());
        $('#shipment_date').html($("input[name=date]").val());
    });
     $('.tab-link').click( function() {
     
        var tabID = $(this).attr('data-tab');
        
        $(this).addClass('active').siblings().removeClass('active');
        
        $('#tab-'+tabID).addClass('active').siblings().removeClass('active');
     });
    $('#get-rates').click(function(){
        getRates();
    });
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
              if (n ==3) {
                    $('#nextBtn').prop('disabled', true);
                }else {
                    $('#nextBtn').prop('disabled', false);
                }
              fixStepIndicator(n)
            }
            
            function nextPrev(n) {
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("step");
                // Exit the function if any field in the current tab is invalid:
                if (n == 1 && !validateForm()) return false;
                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                // if you have reached the end of the form...
                if (currentTab >= x.length) {
                    // ... the form gets submitted:
                    document.getElementById("signUpForm").submit();
                    return false;
                }
                // Otherwise, display the correct tab:
                showTab(currentTab);
            }
            
            function getRates() {
                $('#nextBtn').html('Loading');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                package_type = $("select[name=package_type]").find(":selected").val();
                R_country = $("select[name=R_country]").find(":selected").val();
                weight = $("input[name=weight]").val();
                length = $("input[name=length]").val();
                width = $("input[name=width]").val();
                height = $("input[name=height]").val();
                if (weight == "" || length == "" || width == "" || height == "") {
                    alert('Please fill all field');
                    return;
                }
                const volumetricWeight = (length * width * height) / 6000;
                const roundedWeight = Math.ceil(volumetricWeight);
                $('#actual_weight').val(roundedWeight);
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
                            $('#nextBtn').prop('disabled', true);
                            currentTab = 3;
                            alert(res.error);
                            // return false;
                        }else {
                            $('#nextBtn').prop('disabled', false);
                            $('#nextBtn').html('Continue');
                            $('input[name=shipping_charge]').val(res.rate)
                            // return false
                        }
                    },
                    error: function (res) {
                        $('#nextBtn').html('Continue');
                        $('#nextBtn').prop('disabled', true);
                        console.log(res);
                        // return false
                    }
                });
            }
            function validateForm() {
              // This function deals with validation of the form fields
              var x, y, i, valid = true;
              x = document.getElementsByClassName("step");
              y = x[currentTab].getElementsByTagName("input");
              // A loop that checks every input field in the current tab:
              const notRequired = ['S_department','S_other', 'S_pan', 'S_gstin', 'S_iec', 'S_aadhaar', 'R_department', 'R_other','R_tan'];
              for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == ""  && !notRequired.includes(y[i].name)) {
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
        function show1(){
          document.getElementById('div1').style.display ='none';
        }
        function show2(){
          document.getElementById('div1').style.display = 'block';
        }
    $("form").on("change", ".file-upload-field", function(){ 
        $(this).parent(".file-upload-wrapper").attr("data-text",         $(this).val().replace(/.*(\/|\\)/, '') );
    });

    $('.edit_frm_ad_btn').click(function() {
        $('input[name=edit_S_address]').val($('input[name=S_address]').val())
        $('input[name=edit_S_appartment]').val($('input[name=S_appartment]').val())
        $('input[name=edit_S_department]').val($('input[name=S_department]').val())
        $('input[name=edit_S_pincode]').val($('input[name=S_department]').val())
        $('input[name=edit_S_city]').val($('input[name=S_city]').val())
        $('input[name=edit_S_state]').val($('input[name=S_state]').val())
        $('input[name=edit_S_other]').val($('input[name=S_other]').val())

        $('#update_from_address_modal').modal('show');
    });

    $('.edit_go_ad_btn').click(function() {
        $('input[name=edit_R_address]').val($('input[name=R_address]').val())
        $('input[name=edit_R_appartment]').val($('input[name=R_appartment]').val())
        $('input[name=edit_R_department]').val($('input[name=R_department]').val())
        $('input[name=edit_R_pincode]').val($('input[name=R_pincode]').val())
        $('input[name=edit_R_city]').val($('input[name=R_city]').val())
        $('input[name=edit_R_state]').val($('input[name=R_state]').val())
        $('input[name=edit_R_other]').val($('input[name=R_other]').val())

        $('#update_going_address_modal').modal('show');
    });

    $("#udt_frm_add").click(function(){
        $('input[name=S_address]').val($('input[name=edit_S_address]').val())
        $('input[name=S_appartment]').val($('input[name=edit_S_appartment]').val())
        $('input[name=S_department]').val($('input[name=edit_S_department]').val())
        $('input[name=S_pincode]').val($('input[name=edit_S_pincode]').val())
        $('input[name=S_city]').val($('input[name=edit_S_city]').val())
        $('input[name=S_state]').val($('input[name=edit_S_state]').val())
        $('input[name=S_other]').val($('input[name=edit_S_other]').val())
        
        $('#from_name').html($("input[name=S_name]").val());
        $('#from_address').html($('input[name=S_address]').val()+' , '+$('input[name=S_appartment]').val()+' , '+$('input[name=S_department]').val()+' , '+$('input[name=S_pincode]').val()+' , '+$('input[name=S_city]').val()+' , '+$('input[name=S_state]').val()+' , '+$('input[name=S_other]').val());
        $('#from_number').html($("input[name=S_contact]").val());
        $('#pickup_from_name').html($("input[name=S_name]").val());
        $('#pickup_from_address').html($('input[name=S_address]').val()+' , '+$('input[name=S_appartment]').val()+' , '+$('input[name=S_department]').val()+' , '+$('input[name=S_pincode]').val()+' , '+$('input[name=S_city]').val()+' , '+$('input[name=S_state]').val()+' , '+$('input[name=S_other]').val());
        $('#pickup_from_number').html($("input[name=S_contact]").val());
        
        $('#update_from_address_modal').modal('hide');
    });

    $("#udt_go_add").click(function(){
        $('input[name=R_address]').val($('input[name=edit_R_address]').val())
        $('input[name=R_appartment]').val($('input[name=edit_R_appartment]').val())
        $('input[name=R_department]').val($('input[name=edit_R_department]').val())
        $('input[name=R_pincode]').val($('input[name=edit_R_pincode]').val())
        $('input[name=R_city]').val($('input[name=edit_R_city]').val())
        $('input[name=R_state]').val($('input[name=edit_R_state]').val())
        $('input[name=R_other]').val($('input[name=edit_R_other]').val())
        
        $('#to_name').html($("input[name=R_name]").val());
        $('#to_address').html($('input[name=R_address]').val()+' , '+$('input[name=R_appartment]').val()+' , '+$('input[name=R_department]').val()+' , '+$('input[name=R_pincode]').val()+' , '+$('input[name=R_city]').val()+' , '+$('input[name=R_other]').val());
        $('#to_number').html($("input[name=R_contact]").val());
        
        $('#update_going_address_modal').modal('hide'); 
    });
    </script>



@endsection
