@extends('frontend.layouts.master')
@section('page_content')
<section id="where-from-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="where-from-design">
                    <h3 class="shipment-heading">Create New Courier Shipment</h3>
                    <form id="signUpForm" class="signUpForm" enctype='multipart/form-data'>
                        @csrf
                        <!-- start step indicators -->
                        <div class="form-header d-flex">
                            @include('frontend.dashboard.partials.step_indicators')
                        </div>
                        <!-- end step indicators -->
                        <div class="courier_type">
                            <input type="hidden" name="courier_type" value="courier"/>
                        </div>
                        <!-- Step1 Origin -->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    <div class="maining-heading">
                                        <h3 class="mb-4">Origin Details</h3>
                                    </div>
                                    <div class="form-group">
                                        <label>Country*</label>
                                        <select id="select-service" required name="csr_country_id">
                                            @foreach(getCountriesByIds(array(235,71)) as $key=>$coun)
                                                <?php $selected=($coun['id']==235)?"selected='selected'":""; ?>
                                                <option value="{{$coun['id']}}" {{$selected}}>{{$coun['country']}}</option>
                                            @endforeach
                                        </select>                                                                           
                                    </div>
                                    <div class="form-group">
                                        <label>Company Or Name*</label>
                                        <input type="text" name="csr_consignor" value="">
                                    </div>
                                    <div class="form-group select-code-packb">
                                        <label>Contact Number*</label>
                                        <select name="csr_contact_person_code" class="select-code-packb">
                                            @foreach(getCountryBMDCodes() as $countries)
                                                <option value="{{$countries['mobile_code']}}" @if($user->phn_code==$countries['mobile_code']) selected @endif>{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</option>
                                            @endforeach         
                                        </select>
                                        <i class="fa fa-mobile"></i>
                                        <input type="text" id="csr_contact_person" name="csr_contact_person" value="{{ $user->mobile_no }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Address*</label>
                                        <input type="text" name="csr_address1"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Apartment / Suite / Unit / Building etc*</label>
                                        <input type="text" name="csr_address2"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Department, C/D etc</label>
                                        <input type="text" name="csr_address3"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Postcode*</label>
                                        <input type="number" name="csr_pincode"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>City*</label>
                                        <input type="text" name="csr_city_id" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>State*</label>
                                        <input type="text" name="csr_state_id" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Landmark</label>
                                        <input type="text" name="S_other" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Business Registration Number</label>
                                        <input type="text" name="csr_pan" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>VAT</label>
                                        <input type="text" name="csr_gstin" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>IEC (Import and Export Code)</label>
                                        <input type="text" name="csr_iec" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Individual ID</label>
                                        <input type="number" name="csr_aadharno" value="">
                                    </div>
                                    <div class="form-group">
                                        &nbsp;
                                    </div>
                                    <div class="form-group agreed-text not-boarding">
                                        <label class="container">
                                            <p><b>Use this as my default address</b></p>
                                            <input type="radio" name="csr_address1_type" value="Default">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="form-group agreed-text not-boarding">
                                        <label class="container">
                                            <p><b>This Is A Residential Address</b></p>
                                            <input type="radio" name="csr_address1_type" value="Residential">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="form-group"></div>
                                    <div class="form-group">
                                        <label>Email Id*</label>
                                        <input type="email" name="csr_email_id" value="{{$user->email}}">
                                    </div>
                                    <div class="form-group  select-code-packb">
                                        <label>Alternate Number</label>
                                        <select name="csr_mobile_code" class="select-code-packb">
                                            @foreach(getCountryBMDCodes() as $countries)
                                                <option value="{{$countries['mobile_code']}}" @if($user->phn_code==$countries['mobile_code']) selected @endif>{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</option>
                                            @endforeach             
                                        </select>
                                        <i class="fa fa-mobile"></i>
                                        <input type="text" id="csr_mobile_no" name="csr_mobile_no" value="{{$user->mobile_no}}">
                                    </div>
                                    <div class="form-group">
                                        <label>KYC Document* (Please Select Any One)</label>
                                        <select id="select-service" required name="S_idProof">
                                            <option value="passport">Passport</option>
                                            <option value="driving licence">Driving Licence</option>
                                            <option value="other id card">Other ID Card</option>
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

                        <!-- Step2 Destination-->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    <div class="maining-heading">
                                        <h3 class="mb-4">Destination Details</h3>
                                    </div>
                                    <div class="form-group">
                                        <label>Country*</label>
                                        <select id="select-service" required name="csn_country_id">
                                            <option label="Select a country ... " selected="selected" disabled>Select a country ... </option> 
                                            @foreach(getCountries() as $key=>$coun)
                                                <option value="{{$key}}">{{$coun}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Company Or Name*</label>
                                        <input type="text" name="csn_consignor"  value="">
                                    </div>
                                    <div class="form-group select-code-packb">
                                        <label>Contact Number*</label>
                                        <select name="csn_contact_person_code" class="select-code-packb">
                                            @foreach(getCountryBMDCodes() as $countries)
                                                <option value="{{$countries['mobile_code']}}" <?php /*echo ($user->phn_code == $countries['mobile_code']) ? "selected='selected'" : "";*/ ?>>{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</option>
                                            @endforeach 
                                        </select>
                                        <i class="fa fa-mobile"></i>
                                        <input type="text" id="csn_contact_person" name="csn_contact_person" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Address*</label>
                                        <input type="text" name="csn_address1"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Apartment / Suite / Unit / Building etc*</label>
                                        <input type="text" name="csn_address2"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Department, C/D etc</label>
                                        <input type="text" name="csn_address3"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Postcode*</label>
                                        <input type="number" name="csn_pincode"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>City*</label>
                                            <input type="text" name="csn_city_id"   value="">
                                    </div>
                                    <div class="form-group">
                                        <label>State*</label>
                                            <input type="text" name="csn_state_id"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Landmark</label>
                                        <input type="text" name="R_other"  value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email Id*</label>
                                        <input type="email" name="csn_email_id"  value="">
                                    </div>
                                    <div class="form-group  select-code-packb">
                                        <label>Alternate Number</label>
                                        <select name="csn_mobile_code" class="select-code-packb">
                                            @foreach(getCountryBMDCodes() as $countries)
                                                <option value="{{$countries['mobile_code']}}" <?php /*echo ($user->phn_code == $countries['mobile_code']) ? "selected='selected'" : "";*/ ?>>{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</option>
                                            @endforeach 
                                        </select>
                                        <i class="fa fa-mobile"></i>
                                        <input type="text" id="csn_mobile_no" name="csn_mobile_no" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>TAN Number</label>
                                        <input type="text" name="csn_tan_number"  value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step3 Shipping Mode-->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    @include('frontend.dashboard.partials.shipment_mode')
                                </div>
                            </div>
                        </div>
                        <!--  Step4 Shipment Details-->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    <div class="maining-heading">
                                        <h3 class="mb-4">Shipment details</h3>
                                    </div>
                                    <div class="where-boxing">
                                        <div class="form-group">
                                            <label>Packet type</label>
                                            <select id="select-service" name="packet_type" required>
                                                <option value="Envelope">Envelope</option>
                                                <option value="Documents">Documents</option>
                                                <option value="Non-Documents">Non Documents</option>
                                            </select>
                                        </div>       
                                        <div class="form-group">
                                            <label>Mode</label>
                                            <select id="select-service" readonly>
                                                <option value="export" readonly selected>Export</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Gross Weight KG</label>
                                            <input type="number" name="pcs_weight" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Chargeable Weight KG</label>
                                            <input type="number" name="chargeable_weight" id="chargeableWeight" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Length CM</label>
                                            <input type="number" name="length"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Width CM</label>
                                            <input type="number" name="width"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Height CM</label>
                                            <input type="number" name="height"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Declared Value $</label>
                                            <input type="number" name="dvalue"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Estimated Air Freight Cost $</label>
                                            <input type="text" name="shipping_charge" readonly>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-main-2 track-shipment-clr" id="getCourierRates">Get Rates</button>
                                        </div>
                                        <input type="hidden" name="actual_weight" id="actual_weight">
                                    </div>
                                    <div class="step-image">
                                        <img src="{{asset('assets/images/step-img.png')}}" alt="" class="img-responsive">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="shp-list">
                                            <p style="margin-bottom:0px;"><strong style="font-size: 20px;">All prices given in USD Currency </strong> </p>
                                            <p style="margin-bottom:0px;"><strong>Peak surcharge to be added on above rates </strong></p>
                                            <ul> 
                                                <li>Dynamic fuel surcharge to be added on above rates</li>
                                                <li>Each package of a shipment is calculated according to the dimensional weight as soon as the dimensional weight exceeds the actual weight. </li>
                                                <li>Final weight shall be chargeable as per Airlines </li>
                                            </ul>
                                            <p style="margin-bottom:0px;"> <strong>Extra Charges as below may apply to  any shipment </strong> </p>
                                            <ul> 
                                                <li>Residential Delivery Address</li>
                                                <li>Direct Signature Delivery</li>
                                                <li>DDP/DTP  charges</li>
                                                <li>Remote Area charges</li>
                                                <li>Overweight Charges</li>
                                                <li>Oversize charges</li>
                                                <li>Address Correction Charges</li>
                                            </ul>
                                           <!--  <p style="margin-bottom:0px;"> <strong>TIME BOUND DELIVERIES (if service available for that particular destination) </strong> </p>
                                            <p> 
                                                <ul>
                                                    <li>Premium 9:00: Zuschlag von 35.00 USD auf den Preis von DHL EXPRESS WORLDWIDE EXPORT </li>
                                                    <li>Premium 10:30: Zuschlag von 25.00 USD auf den Preis von DHL EXPRESS WORLDWIDE EXPORT </li>
                                                    <li>Premium 12:00: Zuschlag von 20.00 USD auf den Preis von DHL EXPRESS WORLDWIDE EXPORT</li>
                                                </ul>
                                            </p> -->
                                            <p>The above rates are estimated and the final rates will be confirmed on the confirmation from the Airlines are sharing the details</p>
                                            <p><strong>“WILL GET BACK TO YOU SOON”</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step5 Review Packet -->
                        <div class="step">
                           <div class="inter-form">
                                <div class="row">
                                    @include('frontend.dashboard.partials.review_details')
                                    <?php /*<div class="row">
                                        <div class="col-md-6">
                                            <div class="maining-heading">
                                                <h3 class="mb-4">Origin/Pickup Details</h3>
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
                                                <h3 class="mb-4">Destination details</h3>
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
                                                    <h3>Shipment details</h3>
                                                    <table style="width: 50%;">
                                                        <tbody>
                                                            <tr>
                                                                <td>Packet Type</td>
                                                                <td id="packetType">xxxx</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Weight</td>
                                                                <td id="pcs_weight">xxxx</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Dimensions</td>
                                                                <td id="dimensions">xxxx</td>
                                                            </tr>
                                                            <tr>
                                                            <td>Total Chargeable Weight</td>
                                                                <td id="total_shipment_weight">xxxx</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Declared Value</td>
                                                                <td id="declaredvalue">xxxxx</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Estimated Air Freight Cost</td>
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
                                                    <h3>Shipment Mode</h3>
                                                    <table width="50%">
                                                        <tbody>
                                                            <tr>
                                                                <td>Type selected</td>
                                                                <td id="ship_type">xxxxx</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Drop date</td>
                                                                <td id="shipment_date">xx xx xxxx</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>*/?>
                                </div>
                            </div>
                        </div>
                        <!-- Step6 Success -->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    @include('frontend.dashboard.partials.shipment_success')
                                </div>
                            </div>
                        </div>
                        <!-- start previous / next buttons -->
                        <div class="form-footer">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Continue</button>
                        </div>
                        <!-- end previous / next buttons -->
                    </form>
                </div>

                <div class="modal fade" id="update_from_address_modal" role="dialog" >
                    @include('frontend.dashboard.partials.update_from_address')
                </div>
                <div class="modal fade" id="update_going_address_modal" role="dialog" >
                    @include('frontend.dashboard.partials.update_to_address')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_body_scripts')
    <script>
        $('#pcs_weight').keypress(function(){
            var packet_type=$("select[name=packet_type] option:selected").val();
            if(packet_type=="Envelope"){
                if($('#pcs_weight').val()>0.3){
                    alert("Please enter less then or equal 0.3");
                    $('#pcs_weight').val("");
                }
            }
        });
        $('#getCourierRates').click(function(){
            getCourierRates();
        });     
        function getCourierRates() {
            $('#nextBtn').html('Loading');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            packet_type = $("select[name=packet_type] option:selected").val();
            csn_country_id = $("select[name=csn_country_id]").find(":selected").val();
            csr_country_id=$("select[name=csr_country_id] option:selected").val();
            grossWeight = $("input[name=pcs_weight]").val();
            length = $("input[name=length]").val();
            width = $("input[name=width]").val();
            height = $("input[name=height]").val();
            
            if (grossWeight == "" || length == "" || width == "" || height == "") {
                alert('Please fill all field');
                return;
            }
            /*const volumetricWeight = (length * width * height) / 6000;
            const roundedWeight = Math.ceil(volumetricWeight);*/
            const chargeableWeight = (length * width * height) / 5000;
            var pcs_weight=chargeableWeight;
            if(grossWeight>chargeableWeight){
                pcs_weight=grossWeight;
            }
            /*console.log(pcs_weight);*/
            /*const pcs_weight = Math.ceil(volumetricWeight);*/
            $('#chargeableWeight').val(pcs_weight);
            $('#actual_weight').val(pcs_weight);
            var formData = {packet_type:packet_type,from_country:csr_country_id,to_country:csn_country_id,weight:pcs_weight};
            $.ajax({
                type: 'post',
                url: '/shipping/get-rates',
                data: formData,
                dataType: 'json',
                success: function (res) {
                    if(res.error){
                        $('#nextBtn').prop('disabled', true);
                        currentTab = 3;
                        $('input[name=shipping_charge]').val("");
                        $('#nextBtn').html('Continue');
                        alert(res.error);
                        // return false;
                    }else {
                        $('#nextBtn').prop('disabled', false);
                        $('#nextBtn').html('Continue');
                        $('input[name=shipping_charge]').val(res.rate);
                        // return false
                    }
                },
                error: function (res) {
                    $('#nextBtn').prop('disabled', true);
                    $('input[name=shipping_charge]').val("");
                    $('#nextBtn').html('Continue');
                    /*alert(res.error);*/
                    // return false
                }
            });
        }
    </script>
    @include('frontend.dashboard.partials.form_custom_js')
@endsection
