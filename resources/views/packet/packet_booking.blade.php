@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Packet Booking</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Operation Management</a></li>
                <li class="breadcrumb-item"><span> Packet Booking</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               @include('message.error_validation')
               <form method="POST" name="packet_booking" id="packet_booking" action="{{ url('admin/save-packet-booking') }}" enctype="multipart/form-data" >
                  @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                                <div class="form-group col-md-3 col-12">
                                   <label>AWB No*</label>
                                   <input type="text" name="awb_no" required id="awb_no" class="form-control" placeholder="Enter AWB No">
                                   <input type="hidden" name="id" id="id" value="0">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Ref No*</label>
                                   <input type="text" required name="ref_no" id="ref_no" class="form-control" placeholder="Enter Ref No">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Booking Date*</label>
                                   <input type="date" required name="booking_date" id="booking_date" class="form-control" placeholder="">
                                </div>
                                <!-- <div class="form-group col-md-3 col-12">
                                   <label>Client*</label>
                                    <select class="form-control select" required name="client_id" id="client_id">
                                       <option>--Select Client--</option>
                                       @foreach($client as $rowc)
                                       <option value="{{$rowc->id}}">{{$rowc->client_name}}</option>
                                       @endforeach
                                    </select>
                                </div> -->
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Consignor Details</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Consignor*</label>
                                   <input type="text" required name="consignor" id="consignor" class="form-control" placeholder="Enter Consignor">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>CPerson*</label>
                                   <input type="text" required name="consignor_c_person" id="consignor_c_person" class="form-control" placeholder="Enter Contact Person">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Address1*</label>
                                   <input type="text" required name="consignor_address_1" id="consignor_address_1" class="form-control" placeholder="Enter Address1">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Apartment / Suite / Unit / Building etc*</label>
                                   <input type="text" required name="consignor_address_2" id="consignor_address_2" class="form-control" placeholder="Enter Address2">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Landmark*</label>
                                   <input type="text" required name="consignor_address_3" id="consignor_address_3" class="form-control" placeholder="Enter Address3">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Pin Code*</label>
                                   <input type="text" required name="consignor_pin_code" id="consignor_pin_code" class="form-control" placeholder="Enter Pin Code">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Country*</label>
                                   <input type="text" required name="consignor_country" id="consignor_country" class="form-control" placeholder="Enter Pin Code" value="Germany" readonly>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>State*</label>
                                   <input type="text" required name="consignor_state" id="consignor_state" class="form-control" placeholder="Enter State">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>City*</label>
                                   <input type="text" required name="consignor_city" id="consignor_city" class="form-control" placeholder="Enter City">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Mobile No*</label>
                                   <input type="text"  required name="consignor_mobile" id="consignor_mobile" class="form-control" placeholder="Enter Mobile No">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Email ID*</label>
                                   <input type="text" required name="consignor_email" name="consignor_email" id="consignor_email" class="form-control" placeholder="Enter Email ID">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>PAN</label>
                                   <input type="text" name="consignor_pan" name="consignor_pan" id="consignor_pan" class="form-control" placeholder="Enter PAN">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>GSTIN</label>
                                   <input type="text" name="consignor_gstin" name="consignor_gstin" id="consignor_gstin" class="form-control" placeholder="Enter GSTIN">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>IEC</label>
                                   <input type="text" name="consignor_IEC" name="consignor_IEC" id="consignor_IEC" class="form-control" placeholder="Enter IEC">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>AadhaarNo</label>
                                   <input type="text" name="consignor_aadhaar_no" id="consignor_aadhaar_no" class="form-control" placeholder="Enter AadhaarNo">
                                </div>
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Consignee Details</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Consignee*</label>
                                   <input type="text" required name="consignee" id="consignee" class="form-control" placeholder="Enter Consignee">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>CPerson*</label>
                                   <input type="text" required name="consignee_cname" id="consignee_cname" class="form-control" placeholder="Enter Contact Person">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Address1*</label>
                                   <input type="text" required name="consignee_address_1" id="consignee_address_1" class="form-control" placeholder="Enter Address1">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Apartment / Suite / Unit / Building etc*</label>
                                   <input type="text" required name="consignee_address_2" id="consignee_address_2" class="form-control" placeholder="Enter Address2">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Landmark*</label>
                                   <input type="text" required name="consignee_address_3" id="consignee_address_3" class="form-control" placeholder="Enter Address3">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Pin Code*</label>
                                   <input type="text" required name="consignee_pincode" id="consignee_pincode" class="form-control" placeholder="Enter Pin Code">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Country*</label>
                                   <select class="form-control select" required name="consignee_country" id="consignee_country" >
                                       <option>--Select County--</option>
                                       @foreach(getCountries() as $key=>$rowct)
                                       <option value="{{$key}}">{{$rowct}}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>State*</label>
                                   <input type="text" required name="consignee_state" id="consignee_state" class="form-control" placeholder="Enter State">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>City*</label>
                                   <input type="text" required name="consignee_city" id="consignee_city" class="form-control" placeholder="Enter City">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Mobile No*</label>
                                   <input type="text" required name="consignee_mobile" id="consignee_mobile" class="form-control" placeholder="Enter Mobile No">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Email ID*</label>
                                   <input type="text" required name="consignee_email" id="consignee_email" class="form-control" placeholder="Enter Email ID">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>TAN</label>
                                   <input type="text" name="consignee_tan" id="consignee_tan" class="form-control" placeholder="Enter TAN">
                                </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Packet & Weight Details</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-3 col-12">
                                 <label>Courier Type*</label>
                                 <select class="form-control select" required name="packet_type" id="packet_type">
                                    <option>--Select Packet Type--</option>
                                    <option value="Envelope">DHL</option>
                                    <option value="Documents">DPD</option>
                                    
                                 </select>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                 <label>Packet Type*</label>
                                 <select class="form-control select" required name="package_type" id="package_type">
                                    <option value="Envelope" selected>Envelope</option>
                                    <option value="Documents">Documents</option>
                                     <option value="Non Documents">Non Documents</option>
                                    
                                 </select>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                 <label>Payment Type*</label>
                                 <select class="form-control select" required name="payment_type" id="payment_type">
                                    <option>--Select Payment Type--</option>
                                    <option value="CASH">CASH</option>
                                    <option value="COD">COD</option>
                                    <option value="CREDIT">CREDIT</option>
                                 </select>
                                </div>
                                {{--<div class="form-group col-md-3 col-12">
                                   <label>Invoice No*</label>
                                   <input type="text" required name="invoice_no" id="invoice_no" class="form-control" placeholder="Enter Invoice No">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Packet Description*</label>
                                   <input type="text" required name="packet_detail" id="packet_detail" class="form-control" placeholder="Enter Packet Description">
                                </div>--}}

                             <div class="form-group col-md-3 col-12">
                                 <label>Gross Weight *</label>
                                 <input type="text" name="pcs_weight" id="pcs_weight" required class="form-control" placeholder="Enter Weight">
                             </div>
                             <div class="form-group col-md-3 col-12">
                                 <label>Chargeable Weight *</label>
                                 <input type="text" name="chargeable_weight" id="chargeable_weight" required class="form-control" placeholder="Enter Chargeble Weight">
                             </div>
                             <div class="form-group col-md-3 col-12">
                                 <label>Length*</label>
                                 <input type="text" name="length" id="length" required class="form-control" placeholder="Enter Length">
                             </div>
                             <div class="form-group col-md-3 col-12">
                                 <label>Width*</label>
                                 <input type="text" name="width" id="width" required class="form-control" placeholder="Enter Width">
                             </div>
                             <div class="form-group col-md-3 col-12">
                                 <label>Height*</label>
                                 <input type="text" name="height" id="height" required class="form-control" placeholder="Enter Height">
                             </div>
                             <div class="form-group col-md-3 col-12">
                                 <label>Declared value*</label>
                                 <input type="text" name="dvalue" id="dvalue" required class="form-control" placeholder="Enter Declared value">
                             </div>
                             <div class="form-group col-md-3 col-12">
                                 <label>Shipping charges*</label>
                                 <input type="text" name="shipping_charge" id="shipping_charge" required class="form-control" placeholder="Enter Shipping charges">
                             </div>
                             <div class="form-group col-md-3 col-12">
                                 <button id="getShippingEstimation" class="btn">Get Rates</button>
                             </div>

                             

                           </div>

                           {{--<div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Weight Details</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>PCS*</label>
                                   <input type="text" required name="pcs" id="pcs" class="form-control" placeholder="Enter Pieces">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Actual Weight*</label>
                                   <input type="text" required name="actual_weight" id="actual_weight" class="form-control" placeholder="Enter Actual Weight">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <div class="smalling-wdh">
                                     <label>Vendor Weight*</label>
                                     <input type="text" required name="vendor_weight" id="vendor_weight" class="form-control" placeholder="Enter Vendor Weight">
                                    <select class="form-control select" required name="vendor_packet_type" id="vendor_packet_type">
                                       <option>--Select Packet Type--</option>
                                       <option value="DOX">DOX</option>
                                       <option value="SPX">SPX</option>
                                    </select>
                                   </div>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <div class="smalling-wdh">
                                     <label>Total Value*</label>
                                     <input type="text" required name="total_value" id="total_value" class="form-control" placeholder="Total Value">
                                      <select id="ddlCurrencyType" class="form-control" tabindex="1" required name="ddlCurrencyType">
                                          <option value="AED">AED</option>
                                          <option value="AUD">AUD</option>
                                          <option value="CAD">CAD</option>
                                          <option value="CHF">CHF</option>
                                          <option value="CNY">CNY</option>
                                          <option value="EUR">EUR</option>
                                          <option value="GBP">GBP</option>
                                          <option value="HKD">HKD</option>
                                          <option value="INR">INR</option>
                                          <option value="JPY">JPY</option>
                                          <option value="RUB">RUB</option>
                                          <option value="SAR">SAR</option>
                                          <option value="SGD">SGD</option>
                                          <option value="USD">USD</option>
                                       </select>
                                   </div>
                                   
                                </div>--}}
                               
                                {{--<div class="form-group col-md-3 col-12">
                                   <label>Divisor*</label>
                                   <select class="form-control select" required name="divisor" id="divisor">
                                       <option>Select</option>
                                       <option value="5000">5000</option>
                                       <option value="6000">6000</option>
                                       <option value="4500">4500</option>
                                    </select>
                                </div>--}}
                                
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Remarks</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Operation Remarks*</label>
                                   <textarea type="text" required name="operation_remark" id="operation_remark" class="form-control" placeholder="Enter Operation Remarks"></textarea>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Accounting Remarks*</label>
                                   <textarea type="text" required name="accounting_remark" id="accounting_remark" class="form-control" placeholder="Enter Accounting Remarks"></textarea>
                                </div>
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Upload Invoice Document</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Choose File*</label>
                                   <input type="file" name="invoice_document" id="invoice_document" accept=".pdf" class="form-control">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                   <div class="formet-clr">
                                     <p>1. File Format should be PDF</p>
                                     <p>2. File Size should be less than 1024 KB.</p>
                                   </div>
                                </div>
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('packet-booking','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Submit</button>@endif
                              <button class="btn btn-primary mr-2 getVal" value="invoice" type="submit"><i class="fa fa-print"></i> Invoice Print</button>
                                 <button class="btn btn-primary mr-2 getlabel" value="label" type="submit"><i class="fa fa-print"></i> Label Print</button>                              
                                 <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                              </div>
                            </div>
                        </div>
                     </div>
                     <input type="hidden" name="print_type" id="print_type" />
                   </form></div>
               
             </div>
          </div>
       </div>
    </div>
@endsection

@section('script')
<script>
   $(document).ready(function() {
   $(".getVal").click(function () {
      $('#print_type').val($('.getVal').val());
      $('#packet_booking').attr('action', "{{route('print.awb.doc.pdf')}}")
    });
    $(".getlabel").click(function () {
      $('#print_type').val($('.getlabel').val());
      $('#packet_booking').attr('action', "{{route('print.awb.doc.pdf')}}")
    });
});

$(document).ready(function() {
    $("#awb_no").on("blur",function(){
      var awb_no = $(this).val();
      $.ajax({
        url: "{{ url('admin/search-packet-booking') }}",
        dataType: "json",
        type: "Post",
        async: true,
        data: {"awb_no":awb_no},
        success: function (data) {
            if(data!=null){
               $("#id").val(data.id);
               $("#ref_no").val(data.reference_no);
               $("#booking_date").val(data.booking_date);
               $("#client_id").val(data.client_id).trigger('change');
               $("#consignor").val(data.csr_consignor);
               $("#consignor_c_person").val(data.csr_contact_person);
               $("#consignor_address_1").val(data.csr_address1);
               $("#consignor_address_2").val(data.csr_address2);
               $("#consignor_address_3").val(data.csr_address3);
               $("#consignor_pin_code").val(data.csr_pincode);
               $("#consignor_country").val(data.csr_country_id).trigger('change');
               $("#consignor_state").val(data.csr_state_id);
               $("#consignor_city").val(data.csr_city_id);
               $("#consignor_mobile").val(data.csr_mobile_no);
               $("#consignor_email").val(data.csr_email_id);
               $("#consignor_pan").val(data.csr_pan);
               $("#consignor_gstin").val(data.csr_gstin);
               $("#consignor_IEC").val(data.csr_iec);
               $("#consignor_aadhaar_no").val(data.csr_aadharno);
               $("#consignee").val(data.csn_consignor);
               $("#consignee_cname").val(data.csn_contact_person);
               $("#consignee_address_1").val(data.csn_address1);
               $("#consignee_address_2").val(data.csn_address2);
               $("#consignee_address_3").val(data.csn_address3);
               $("#consignee_pincode").val(data.csn_pincode);
               $("#consignee_country").val(data.csn_country_id).trigger('change');
               $("#consignee_state").val(data.csn_state_id);
               $("#consignee_city").val(data.csn_city_id);
               $("#consignee_mobile").val(data.csn_mobile_no);
               $("#consignee_email").val(data.csn_email_id);
               $("#consignee_pan").val(data.csn_pan);
               $("#consignee_gstin").val(data.csn_gstin);
               $("#consignee_iec").val(data.csn_iec);
               $("#consignee_aadhar_no").val(data.csn_aadharno);
               $("#packet_type").val(data.packet_type).trigger('change');
               $("#payment_type").val(data.payment_type).trigger('change');
               $("#invoice_no").val(data.invoice_no);
               $("#packet_detail").val(data.packet_description);
               $("#pcs").val(data.pcs_weight);
               $("#actual_weight").val(data.actual_weight);
               $("#chargeable_weight").val(data.chargeable_weight);
               $("#vendor_weight").val(data.vendor_weight);
               $("#vendor_packet_type").val(data.vendor_weight_type).trigger('change');
               $("#total_value").val(data.total_weight);
               $("#ddlCurrencyType").val(data.currency);
               $("#divisor").val(data.devisor).trigger('change');;
               $("#operation_remark").val(data.operation_remark);
               $("#accounting_remark").val(data.accounting_remark);

               $("#pcs_weight").val(data.pcs_weight);
               $("#length").val(data.length);
               $("#width").val(data.width);
               $("#height").val(data.height);
               $("#dvalue").val(data.dvalue);
               $("#shipping_charge").val(data.shipping_charge);
               
            }else{
               $("#id").val("");
               $("#ref_no").val("");
               $("#booking_date").val("");
               $("#client_id").val("").trigger('change');
               $("#consignor").val("");
               $("#consignor_c_person").val("");
               $("#consignor_address_1").val("");
               $("#consignor_address_2").val("");
               $("#consignor_address_3").val("");
               $("#consignor_pin_code").val("");
               $("#consignor_country").val("").trigger('change');
               $("#consignor_state").val("");
               $("#consignor_city").val("");
               $("#consignor_mobile").val("");
               $("#consignor_email").val("");
               $("#consignor_pan").val("");
               $("#consignor_gstin").val("");
               $("#consignor_IEC").val("");
               $("#consignor_aadhaar_no").val("");
               $("#consignee").val("");
               $("#consignee_cname").val("");
               $("#consignee_address_1").val("");
               $("#consignee_address_2").val("");
               $("#consignee_address_3").val("");
               $("#consignee_pincode").val("");
               $("#consignee_country").val("").trigger('change');
               $("#consignee_state").val("");
               $("#consignee_city").val("");
               $("#consignee_mobile").val("");
               $("#consignee_email").val("");
               $("#consignee_pan").val("");
               $("#consignee_gstin").val("");
               $("#consignee_iec").val("");
               $("#consignee_aadhar_no").val("");
               $("#packet_type").val("").trigger('change');
               $("#payment_type").val("").trigger('change');
               $("#invoice_no").val("");
               $("#packet_detail").val("");
               $("#pcs").val("");
               $("#actual_weight").val("");
               $("#chargeable_weight").val("");
               $("#vendor_weight").val("");
               $("#vendor_packet_type").val("").trigger('change');
               $("#total_value").val("");
               $("#ddlCurrencyType").val("");
               $("#divisor").val("").trigger('change');;
               $("#operation_remark").val("");
               $("#accounting_remark").val("");

               $("#pcs_weight").val("");
               $("#length").val("");
               $("#width").val("");
               $("#height").val("");
               $("#dvalue").val("");
               $("#shipping_charge").val("");
            }
        },
      });
   });
});


$('#pcs_weight').keypress(function(){
      var package_type=$("select[name=package_type] option:selected").val();
      if(package_type=="Envelope"){
         if($('#pcs_weight').val()>0.3){
            alert("Please enter less then or equal 0.3");
            $('#pcs_weight').val("");
         }
      }
   });
   $('#getShippingEstimation').click(function(e){
      e.preventDefault();
      getRates();
   });
   $('#dvalue').on("blur",function(e){
      e.preventDefault();
      getRates();
   });
   //dvalue
   function getRates() {
      $('#getShippingEstimation').html('Loading');
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
         }
      });
      var package_type = $("select[name=package_type]").find(":selected").val();
      var fromCountry = $("input[name=consignor_country]").val();
      var R_country = $("select[name=consignee_country]").find(":selected").val();
      var pcs_weight = $("input[name=pcs_weight]").val();
      var length = $("input[name=length]").val();
      var width = $("input[name=width]").val();
      var height = $("input[name=height]").val();
      if (pcs_weight == "" || length == "" || width == "" || height == "") {
         alert('Please fill all field');
         return;
      }
      const weight = (length * width * height) / 5000;
      $('.actualWeight').val(weight);
      $("#chargeable_weight").val(weight);
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
               $('input[name="shipping_charge"]').val("");
               $('#getShippingEstimation').html('Get Rates');
               alert(res.error);
               // return false;
            }else {
               $('input[name="shipping_charge"]').val(res.rate)
               $('#getShippingEstimation').html('Get Rates');
               // return false
            }
         },
         error: function (res) {
            $('input[name="shipping_charge"]').val("");
            $('#getShippingEstimation').html('Get Rates');
            console.log(res);
            // return false
         }
      });
    }
</script>
@endsection

