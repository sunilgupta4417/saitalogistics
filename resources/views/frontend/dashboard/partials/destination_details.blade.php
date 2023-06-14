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
    <label>Contact Person Name*</label>
    <input type="text" name="csn_consignor_person"  value="">
</div>
<div class="form-group">
    <label>Company Name*</label>
    <input type="text" name="csn_consignor"  value="">
</div>
<div class="form-group select-code-packb">
    <label>Contact Number*</label>
    <select name="csn_contact_person_code" class="select-code-packb">
        @foreach(getCountryBMDCodes() as $countries)
            <option value="{{$countries['mobile_code']}}" >{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</option>
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
            <option value="{{$countries['mobile_code']}}" >{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</option>
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