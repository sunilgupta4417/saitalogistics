
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
    <h3 class="mb-4">Origin Details</h3>
</div>
<div class="form-group" id="ocean-fld">
    <label>Country*</label>
    <select id="select-service" class="selectpicker" required name="csr_country_id" style="width: 100% !important;">
        @foreach(getCountriesByIds() as $key=>$coun)
            <?php $selected=($coun['id']==71)?"selected='selected'":""; ?>
            <option value="{{$coun['id']}}" {{$selected}}>{{$coun['country']}}</option>
        @endforeach
    </select>                                                                          
</div>
<div class="form-group">
    <label>Contact Person Name*</label>
    <input type="text" name="csr_consignor_person" value="{{ $user->name }}">
</div>
<div class="form-group">
    <label>Company Name*</label>
    <input type="text" name="csr_consignor" value="">
</div>
<div class="form-group select-code-packb">
    <label>Contact Number*</label>
    <select name="csr_contact_person_code" class="select-code-packb" id="common_mc_1">
         @foreach(getCountryBMDCodes() as $countries)
            <option data-text="{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})" value="{{$countries['mobile_code']}}" @if($user->phn_code==$countries['mobile_code']) selected @endif >{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</option>
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
    <label>Business Registration Number (TIN)</label>
    <input type="text" name="csr_pan" value="">
</div>
<div class="form-group">
    <label>VAT (Optional)</label>
    <input type="text" name="csr_gstin" value="">
</div>
<div class="form-group">
    <label>IEC (Import and Export Code)</label>
    <input type="text" name="csr_iec" value="">
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
    <input type="email" name="csr_email_id" value="{{ $user->email }}">
</div>
<div class="form-group  select-code-packb">
    <label>Alternate Number</label>
    <select name="csr_mobile_code" class="select-code-packb" id="common_mc_2">
         @foreach(getCountryBMDCodes() as $countries)
            <option data-text="{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})" value="{{$countries['mobile_code']}}" @if($user->phn_code==$countries['mobile_code']) selected @endif >{{ $countries['country_name'] }} ({{ $countries['mobile_code'] }})</otion>
        @endforeach        
    </select>
    <i class="fa fa-mobile"></i>
    <input type="text" id="csr_mobile_no" name="csr_mobile_no" value="{{ $user->mobile_no }}">
</div>
<div class="form-group">
    <label>KYC Document* (Please Select Any One)</label>
    <select id="select-service" required name="S_idProof">
        <option value="Business Registration Copy">Business Registration Copy</option>
        <option value="Import and Export Code Copy">Import and Export Code Copy</option>
        <option value="GST Registration Copy">GST Registration Copy</option>
            <option value="VAT Registration Doc Copy">VAT Registration Doc Copy</option>
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