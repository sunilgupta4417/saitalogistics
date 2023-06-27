

<style>
#ocean-fld .select2.select2-container.select2-container--default {
    margin-top: 0;
    height: auto;
    padding: 8px 12px;
    color: #000 !important;
}
#ocean-fld .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: initial !important;
}
#ocean-fld .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px !important;
    right: 20px !important;
}
#ocean-fld .select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: #000 transparent transparent transparent;
}
.select2-container--open .select2-dropdown--below {
    border-top: none;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    background: #eee;
    border: none;
    padding: 5px;
}
.select2-results__option[aria-selected] {
    cursor: pointer;
    background: #fff;
    font-size: 16px;
    border-bottom: 1px solid #eee;
    padding-left: 15px;
}
.select2-search--dropdown {
    display: block;
    padding: 1px;
    background: #ccc;
    margin-bottom: 5px;
}
</style>

<div class="maining-heading">
    <h3 class="mb-4">Destination Details</h3>
</div>
<div class="form-group" id="ocean-fld">
    <label>Country*</label>
    <select id="select-service1" class="selectpicker" required name="csn_country_id"  style="width: 100% !important;">
    <option label="Select a country ... " selected="selected" disabled>Select a country ... </option> 
        @foreach(getCountries() as $key=>$coun)
            <option value="{{$key}}">{{$coun}}</option>
        @endforeach
    </select>
</div>
    <div class="form-group">
    <label>Contact Person Name*</label>
    <input type="text" name="csn_consignor_person"  value="">
</div>
<div class="form-group">
    <label>Company Name*</label>
    <input type="text" name="csn_consignor"  value="">
</div>
<div class="form-group select-code-packb">
    <label>Contact Number*</label>
    <select name="csn_contact_person_code" class="select-code-packb" id="common_mc_3">
        @foreach(getCountryBMDCodes() as $countries)
            <option data-text="{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})" value="{{$countries['mobile_code']}}" >{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</option>
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
    <select name="csn_mobile_code" class="select-code-packb" id="common_mc_4">
        @foreach(getCountryBMDCodes() as $countries)
            <option data-text="{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})" value="{{$countries['mobile_code']}}" >{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</option>
        @endforeach        
    </select>
    <i class="fa fa-mobile"></i>
    <input type="text" id="csn_mobile_no" name="csn_mobile_no" value="">
</div>
<div class="form-group">
    <label>IEC (Import and Export Code)</label>
    <input type="text" name="csn_iec_number"  value="">
</div>
<div class="form-group">
    <label>VAT / GST Number </label>
    <input type="text" name="csn_tan_number"  value="">
</div>
<div class="form-group">
    <label>Business Registration Number (TIN)</label>
    <input type="text" name="csn_bn_number"  value="">
</div>