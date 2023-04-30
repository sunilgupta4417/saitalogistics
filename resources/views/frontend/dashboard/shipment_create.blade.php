@extends('frontend.layouts.master')
@section('page_content')
<?php $userData=auth()->user();?>
<section id="where-from-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="where-from-design">
                    <h3 class="shipment-heading">Create New Shipment</h3>
                    <form id="signUpForm" class="signUpForm" enctype='multipart/form-data'>
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
                                        <h3 class="mb-4">Where Are You Shipment Origin?</h3>
                                    </div>
                                    <div class="form-group">
                                        <label>Country*</label>
                                        <input type="text" name="S_country" readonly value="Germany">                                                                           
                                    </div>
                                    <div class="form-group">
                                        <label>Company Or Name*</label>
                                        <input type="text" name="S_name" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number*</label>
                                        <input type="number" name="S_contact" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Address*</label>
                                        <input type="text" name="S_address"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Apartment / Suite / Unit / Building etc*</label>
                                        <input type="text" name="S_appartment"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Department, C/D etc</label>
                                        <input type="text" name="S_department"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Postcode*</label>
                                        <input type="number" name="S_pincode"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>City*</label>
                                        <input type="text" name="S_city" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>State*</label>
                                        <input type="text" name="S_state" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Land Mark</label>
                                        <input type="text" name="S_other" value="">
                                    </div>

                                    <div class="form-group">
                                        <label>PAN</label>
                                        <input type="text" name="S_pan" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>GSTIN</label>
                                        <input type="text" name="S_gstin" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>IEC</label>
                                        <input type="text" name="S_iec" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Aadhaar No</label>
                                        <input type="text" name="S_aadhaar" value="">
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
                                        <input type="text" name="S_email" value="">
                                    </div>

                                    <div class="form-group">
                                        <label>Telephone*</label>
                                        <input type="number" name="S_phone"  value="">
                                    </div>

                                    <div class="form-group">
                                        <label>KYC Document*</label>
                                        <select id="select-service" required name="S_idProof">
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
                                        <h3 class="mb-4">Where Is Your Shipping Destination?</h3>
                                    </div>
                                    <div class="form-group">
                                        <label>Country*</label>
                                        <select id="select-service" required name="R_country">
                                        <option label="Select a country ... " selected="selected" disabled>Select a country ... </option> 
                                            
                                            @foreach($country as $coun)
                                                <option value="{{$coun->id}}">{{$coun->country}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Company Or Name*</label>
                                        <input type="text" name="R_name"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number*</label>
                                        <input type="number" name="R_contact"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Address*</label>
                                        <input type="text" name="R_address"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Apartment / Suite / Unit / Building etc*</label>
                                        <input type="text" name="R_appartment"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Department, C/D etc</label>
                                        <input type="text" name="R_department"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Postcode*</label>
                                        <input type="number" name="R_pincode"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>City*</label>
                                            <input type="text" name="R_city"   value="">
                                    </div>
                                    <div class="form-group">
                                        <label>State*</label>
                                            <input type="text" name="R_state"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Landmark</label>
                                        <input type="text" name="R_other"  value="">
                                    </div>

                                    <div class="form-group">
                                        <label>Email Id*</label>
                                        <input type="text" name="R_email"  value="">
                                    </div>

                                    <div class="form-group">
                                        <label>Telephone*</label>
                                        <input type="number" name="R_phone"  value="">
                                    </div>

                                    <div class="form-group">
                                        <label>TAN Number</label>
                                        <input type="text" name="R_tan"  value="">
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
                                                    <h4 id="pickup_from_name">xxxxx</h4>
                                                    <p id="pickup_from_address">xxxxxxx</p>
                                                    <b id="pickup_from_number">+xxxxxx</b>
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
                                            <option value="Envelope">Envelope</option>
                                            <option value="Documents">Documents</option>
                                            <option value="Non-Documents">Non Documents</option>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Weight KG</label>
                                            <input type="text" name="weight"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Length CM</label>
                                            <input type="text" name="length"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Width CM</label>
                                            <input type="text" name="width"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Height CM</label>
                                            <input type="text" name="height"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Declared value $</label>
                                            <input type="text" name="dvalue"  value="">
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
                                            <h3 class="mb-4">Origin/Pickup</h3>
                                            <a href="javascript:void(0);" class="edit-clss edit_frm_ad_btn">Edit</a>
                                        </div>
                                        <div class="maing-address">
                                            <h4 id="from_name">xxxxx</h4>
                                            <p id="from_address">xxxxx</p>
                                            <p id="from_number">xxxxx</p>
                                            <p id="from_email">xxxxx</p>
                                            <p id="from_phone_number">xxxxx</p>
                                            <p id="from_pan_no">xxxxx</p>
                                            <p id="from_gstin">xxxxx</p>
                                            <p id="from_iec">xxxxx</p>
                                            <p id="from_adhaar_no">xxxxx</p>
                                            <p id="from_address_type">xxxxx</p> 
                                            <p id="from_kyc_document">xxxxx</p>                                              
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="maining-heading">
                                            <h3 class="mb-4">Destination</h3>
                                            <a href="javascript:void(0);" class="edit-clss edit_go_ad_btn">Edit</a>
                                        </div>
                                        <div class="maing-address">
                                            <h4 id="to_name">xxxxx</h4>
                                            <p id="to_address">xxxxxx</p>
                                            <p id="to_number">xxxxx</p>
                                            <p id="to_email">xxxxx</p>
                                            <p id="to_phone_number">xxxxx</p>
                                            <p id="to_tan_no">xxxxx</p> 
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="what-details">
                                            <div class="what-detail-iner">
                                                <h3>What</h3>
                                                <?php /*<a href="#" class="edit-clss">Edit</a>*/ ?>
                                                <table style="width: 50%;">
                                                    <tbody>
                                                        <tr>
                                                            <td>Packet Type</td>
                                                            <td id="packetType">xxxx</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Weight</td>
                                                            <td id="weight">xxxx</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dimensions</td>
                                                            <td id="dimensions">xxxx</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Shipment Weight</td>
                                                            <td id="total_shipment_weight">xxxx</td>
                                                        </tr>
                                                        <?php /*<tr>
                                                            <td>Packaging</td>
                                                            <td id="packaging">xxxxx</td>
                                                        </tr>*/?>
                                                        <tr>
                                                            <td>Declared Value</td>
                                                            <td id="declaredvalue">xxxxx</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shipping Charge</td>
                                                            <td id="shippingCharge">xxxxx</td>
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
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td>Type selected</td>
                                                            <td id="ship_type">xxxxx</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Drop date</td>
                                                            <td id="shipment_date">xx xx xxxx</td>
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
                                                    <p style="font-size:14px;">xxxxxx</p>
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
                                        <?php /*<div class="form-group">
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
                                        </div>*/?>
                                        <div class="form-group">
                                            <input type="radio" checked="checked" class="clickMeForPayInput" data-orderid="0"  data-user_email="test@gmail.com"  data-customerid="0"  data-shipping_charge="0" data-tax="0" data-total="0">Epay
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
                                                    <td>Subtotal</td>
                                                    <td class="subtotal">$0.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Tax & Duties</td>
                                                    <td class="tax">$0.00</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Payable Amount</b></td>
                                                    <td><b class="total">$0.00</b></td>
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
                                        <p>Your shipment has been successfully added Track with your order No. <b class="successOrderNumber">xxxxx</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- start previous / next buttons -->
                        <div class="form-footer">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                            <?php /*<button type="button" id="cencalBtn">Cancel</button>*/?>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Continue</button>
                            <button type="button" class="clickMeForPay" style="display:none;">Pay By Epay</button>
                        </div>
                        <!-- end previous / next buttons -->
                    </form>
                </div>
                <div class="modal fade" id="update_from_address_modal" role="dialog" >
                    <div class="modal-dialog modal-lg vertical-align-center" style="margin-top: 80px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Shipping Origin Address</h4>
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
                                <h4 class="modal-title">Update Shipping Destination Address</h4>
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
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_body_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://epay.me/sdk/v2/stage-websdk.js"></script>
<script>   
    function paymentOptions(customerId,userEmail,orderID,orderAmount,orderCurrency,orderDescription){
        const options = {
            channelId: "WEB",
            merchantType: "ECOMMS",
            merchantId:"6447cf5a37cd07f8a9a59435",
            customerId:customerId,
            orderID:orderID,
            orderDescription:orderDescription,
            orderAmount:orderAmount,
            userEmail:userEmail,
            merchantLogo:"https://epay.me/assets/images/logo.png",
            showSavedCardFeature:true,
            orderCurrency:orderCurrency,
            successHandler: async function(response) {
                afterPaymentAction(response,true);  
                $(".form-footer").hide();              
            },
            failedHandler: async function(response) {
                console.log(response);
                afterPaymentAction(response,false);
            },
        };
        console.log(options);     
        const epay=new Epay(options);
        epay.open(options);
    }
    function afterPaymentAction(response,type=true){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'post',
            url: '{{route("user.store_shipment_payment")}}',
            data: {status:response.status, response:response.response,id:response.response.orderid},
            cache: false,
            dataType:'JSON',
            success: function (res) {
                if((res.status=="ok") && (res.response.transt=="completed")){
                    $(".form-footer button#nextBtn").trigger("click");
                    //console.log(res)
                    $(".payment-successful b.successOrderNumber").html(res.response.orderid);
                    $(".form-footer button#nextBtn").hide();
                    $(".form-footer button.clickMeForPay").remove();
                }else{
                    $(".form-footer button#nextBtn").hide();
                    $(".form-footer button.clickMeForPay").show();
                }
            },
            error: function (res) {
                console.log(res)
            }
        });
    }
    $(document).ready(function(){
        $(".clickMeForPay").on("click",function(e){
            e.preventDefault();
            const customerId=$(".clickMeForPayInput").attr("data-customerid");
            const userEmail=$(".clickMeForPayInput").attr("data-user_email");
            const orderID=$(".clickMeForPayInput").attr("data-orderid");
            const orderAmount=$(".clickMeForPayInput").attr("data-total");
            const orderCurrency="USD";
            const orderDescription=customerId+','+userEmail+','+orderID+','+orderAmount+','+orderCurrency;
            paymentOptions(customerId,userEmail,orderID,orderAmount,orderCurrency,orderDescription);
        });
    });
</script>
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
    $('input').keyup(function(){
        getReviewFormData();
    });

    function getReviewFormData(){
        // console.log($("input[name=dropPickup]:checked").val());
        $('#from_name').html($("input[name=S_name]").val());
        $('#from_address').html($('input[name=S_address]').val()+' , '+$('input[name=S_appartment]').val()+' , '+$('input[name=S_department]').val()+' , '+$('input[name=S_pincode]').val()+' , '+$('input[name=S_city]').val()+' , '+$('input[name=S_state]').val()+' , '+$('input[name=S_other]').val()+" - "+$("input[name=S_country]").val());
        $('#from_number').html($("input[name=S_contact]").val());
        $('#from_phone_number').html("Telephone: "+$("input[name=S_phone]").val());
        $('#from_pan_no').html("Pan No: "+$("input[name=S_pan]").val());
        $('#from_gstin').html("GSTIN: "+$("input[name=S_gstin]").val());
        $('#from_iec').html("IEC: "+$("input[name=S_iec]").val());
        $('#from_adhaar_no').html("Adhaar No: "+$("input[name=S_aadhaar]").val());
        $('#from_address_type').html("Address Type: "+$("input[name=S_address_type]").val());
        $('#from_email').html("Email: "+$("input[name=S_email]").val());
        $('#from_kyc_document').html("KYC Document: "+$("select[name=S_idProof] option:selected").val());
        $('#pickup_from_name').html($("input[name=S_name]").val());
        $('#pickup_from_address').html($('input[name=S_address]').val()+' , '+$('input[name=S_appartment]').val()+' , '+$('input[name=S_department]').val()+' , '+$('input[name=S_pincode]').val()+' , '+$('input[name=S_city]').val()+' , '+$('input[name=S_state]').val()+' , '+$('input[name=S_other]').val());
        $('#pickup_from_number').html($("input[name=S_contact]").val());
        $('#to_name').html($("input[name=R_name]").val());
        $('#to_address').html($('input[name=R_address]').val()+' , '+$('input[name=R_appartment]').val()+' , '+$('input[name=R_department]').val()+' , '+$('input[name=R_pincode]').val()+' , '+$('input[name=R_city]').val()+' , '+$('input[name=R_other]').val()+"-"+$("select[name=R_country] option:selected").text());
        $('#to_number').html($("input[name=R_contact]").val());
        $('#to_phone_number').html("Telephone: "+$("input[name=R_phone]").val());
        $('#to_email').html("Email: "+$("input[name=R_email]").val());
        $('#to_tan_no').html("Tan No: "+$("input[name=R_tan]").val());

        $('#weight').html($("input[name=weight]").val() + " KG");
        $('#dimensions').html($("input[name=width]").val()+' X '+$("input[name=height]").val()+' X '+$("input[name=length]").val()+ ' CM');
        $('#total_shipment_weight').html($("input[name=weight]").val()+ ' KG');
        $('#packaging').html($("input[name=item_type]").val());
        $('#ship_type').html($("input[name=dropPickup]:checked").val());
        $('#shipment_date').html($("input[name=date]").val());
        $('#packetType').html($("select[name=package_type] option:selected").val());
        $('#shippingCharge').html("$"+$("input[name=shipping_charge]").val());
        $('#declaredvalue').html("$"+$("input[name=dvalue]").val());
    }
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
        getReviewFormData();
        if (n == 3) {
            // $('#nextBtn').prop('disabled', true);
        } 
        else if (n == 5) {
            $(".form-footer button#prevBtn").remove();
            $(".form-footer button#nextBtn").hide();
            $(".form-footer button.clickMeForPay").show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{route("user.store_shipment")}}',
                data:  new FormData($('#signUpForm')[0]),
                contentType: false,
                cache: false,
                processData:false,
                success: function (res) {
                    $(".clickMeForPayInput").attr("data-orderid",res.id);
                    $(".clickMeForPayInput").attr("data-user_email",res.user_email);
                    $(".clickMeForPayInput").attr("data-customerid",res.client_id);
                    $(".clickMeForPayInput").attr("data-shipping_charge",res.shipping_charge);
                    $(".clickMeForPayInput").attr("data-tax",res.tax);
                    $(".clickMeForPayInput").attr("data-total",res.total);
                    $('.paymment-right-details').find("td.subtotal").html("$"+res.shipping_charge);
                    $('.paymment-right-details').find("td.tax").html("$"+res.tax);
                    $('.paymment-right-details').find("td b.total").html("$"+res.total);
                    //console.log(res);
                },
                error: function (res) {
                    console.log(res)
                }
            });                
        } else {
            $('#nextBtn').prop('disabled', false);
        }
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("step");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        var prevBtn = document.getElementById("prevBtn");
        var nextBtn = document.getElementById("nextBtn");
        if (n == 0) {
            if(prevBtn) {
                prevBtn.style.display = "none";
            }
        } else {
            if(prevBtn) {
                prevBtn.style.display = "inline";
            }
        }
        if (n == (x.length - 1)) {
            if(nextBtn) {
                nextBtn.innerHTML = "Submit";
            }
        } else {
            if(nextBtn) {
                nextBtn.innerHTML = "Continue";
            }
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n);
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
        // if (currentTab >= x.length) {
        //     // ... the form gets submitted:
        //     document.getElementById("signUpForm").submit();
        //     return false;
        // }
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
    document.getElementById('div1').style.display ='none';
    function show1(){
        document.getElementById('div1').style.display ='none';
    }
    function show2(){
        document.getElementById('div1').style.display = 'block';
    }
    $("form").on("change", ".file-upload-field", function(){ 
        $(this).parent(".file-upload-wrapper").attr("data-text",$(this).val().replace(/.*(\/|\\)/, '') );
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
