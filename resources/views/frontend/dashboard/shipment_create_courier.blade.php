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
                                        <input type="text" name="csr_pincode"  value="">
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
                                        <input type="text" name="csr_aadharno" value="">
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
                                        <input type="text" name="csn_pincode"  value="">
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
                                            <input type="number" name="pcs_weight" placeholder="Please enter approximate value" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Chargeable Weight KG</label>
                                            <input type="number" placeholder="It will be automatically filled" name="chargeable_weight" id="chargeableWeight" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Length CM</label>
                                            <input type="number" name="length" placeholder="Please enter approximate value"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Width CM</label>
                                            <input type="number" name="width" placeholder="Please enter approximate value"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Height CM</label>
                                            <input type="number" name="height" placeholder="Please enter approximate value"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Declared Value $</label>
                                            <input type="number" name="dvalue" placeholder="Please enter approximate value"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Estimated Air Freight Cost $</label>
                                            <input type="text" name="shipping_charge" placeholder="It will be automatically filled" readonly>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-main-2 track-shipment-clr" id="get_courier_rates">Get Rates</button>
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
    @include('frontend.dashboard.partials.form_custom_js')
@endsection