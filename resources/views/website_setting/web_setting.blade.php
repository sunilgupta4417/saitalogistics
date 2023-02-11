@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Website Setting</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Setting Management</a></li>
                <li class="breadcrumb-item"><span>Website Setting</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               <form action="{{route('website.setting.save')}}" enctype="multipart/form-data" method="post" name="frm_website" id="frm_website">
                  @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Company Profile</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Company Code*</label>
                                   <input type="text" class="form-control" name="data[company_code]" value="{{ (isset($website['company_code']) ? $website['company_code'] :'') }}" placeholder="CM1739">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Mobile No*</label>
                                   <input type="text" class="form-control" name="data[company_mobile_no]"  value="{{ (isset($website['company_mobile_no']) ? $website['company_mobile_no'] :'') }}" placeholder="9868404418">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Company Name*</label>
                                   <input type="text" name="data[company_name]" class="form-control"   value="{{ (isset($website['company_name']) ? $website['company_name'] :'') }}"  required value="sattvic">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Email ID*</label>
                                   <input type="text" class="form-control" name="data[company_email_id]" value="{{ (isset($website['company_email_id']) ? $website['company_email_id'] :'') }}" placeholder="sunildrishti@gmail.com">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Contact Person*</label>
                                   <input type="text" class="form-control" name="data[company_contact_person]" value="{{ (isset($website['company_contact_person']) ? $website['company_contact_person'] :'') }}" required value="Sunil">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>GSTIN*</label>
                                   <input type="text" class="form-control" value="{{(isset($website['company_gstin']) ? $website['company_gstin']:'')}}" name="data[company_gstin]" required placeholder="GSTIN">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>PAN*</label>
                                   <input type="text" class="form-control" name="data[company_pan]"  value="{{ (isset($website['company_pan']) ? $website['company_pan'] :'') }}" required placeholder="PAN">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Address 1*</label>
                                   <input type="text" class="form-control" name="data[company_address1]" value="{{ (isset($website['company_address1']) ? $website['company_address1'] :'') }}" required placeholder="Address 1">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Website*</label>
                                   <input type="text" class="form-control" name="data[company_website]" value="{{ (isset($website['company_website']) ? $website['company_website'] :'') }}" required placeholder="Website">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Address 2*</label>
                                   <input type="text" class="form-control" name="data[company_address2]" value="{{ (isset($website['company_address2']) ? $website['company_address2'] :'') }}" required placeholder="Address 2">
                                </div>
                                <?php
                                 if(isset($website['company_logo'])){
                                    $checkReqLogo = '';
                                    $img_url = asset('logistics/website/').'/'.$website['company_logo'];
                                 }else{
                                    $checkReqLogo = 'required';
                                    $img_url = asset('admin/img/logo.png');
                                 }?>
                                <div class="form-group col-md-5 col-12">
                                   <label>Company Logo*</label>
                                   <input type="file" class="form-control" {{$checkReqLogo}} name="data[company_logo]">
                                </div>
                                 
                                <div class="form-group col-md-3 col-12">
                                     <div class="upload-logo">
                                         <img src="{{$img_url}}">
                                     </div>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Pin Code*</label>
                                   <input type="text" required class="form-control" name="data[company_pincode]" required value="{{ (isset($website['company_pincode']) ? $website['company_pincode'] :'') }}" placeholder="Pin Code">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Country*</label>
                                   <input type="text" required class="form-control" name="data[company_country_id]"  value="{{ (isset($website['company_country_id']) ? $website['company_country_id'] :'') }}">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>State*</label>
                                   <input type="text" required class="form-control" name="data[company_state_id]"  value="{{ (isset($website['company_state_id']) ? $website['company_state_id'] :'') }}">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>City*</label>
                                   <input type="text" required class="form-control" name="data[company_city_id]" value="{{ (isset($website['company_city_id']) ? $website['company_city_id'] :'') }}">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>AWB Start From*</label>
                                   <input type="text" required class="form-control" name="data[company_awb_start_from]" value="{{ (isset($website['company_awb_start_from']) ? $website['company_awb_start_from'] :'') }}" placeholder="AWB Start From">
                                </div>
                                <?php
                                 $company_awb_start_from = '';
                                 $company_bill_currency = '';
                                 if(isset($website['company_awb_start_from'])){
                                    $company_awb_start_from = $website['company_awb_start_from'];
                                 }
                                 if(isset($website['company_bill_currency'])){
                                    $company_bill_currency = $website['company_bill_currency'];
                                 }

                                ?>
                                <div class="form-group col-md-3 col-12">
                                   <label>Weight Unit*</label>
                                       <select class="form-control select required" name="data[company_weight_unit]">
                                          <option value="">--Select Weight Unit--</option>
                                          <option value="KGS" <?php echo ($company_awb_start_from=='KGS'?'':'selected');?>>KGS</option>
                                          <option value="LBS" <?php echo ($company_awb_start_from=='LBS'?'':'selected');?>>LBS</option>
                                       </select>
                                </div>
                                <?php
                                 if(isset($website['company_dashboard_img'])){
                                    $checkReq = '';
                                    $img_url = asset('logistics/website/').'/'.$website['company_dashboard_img'];
                                 }else{
                                    $img_url = asset('admin/img/logo.png');
                                    $checkReq = 'required';
                                 }
                                 ?>
                                <div class="form-group col-md-4 col-12">
                                   <label>Dashboard Image*</label>
                                   <input type="file" {{$checkReq}} class="form-control" name="data[company_dashboard_img]">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="dashboard-logo">
                                       
                                         <img src="{{$img_url}}">
                                     </div>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Billing Currency*</label>
                                       <select class="form-control select" required name="data[company_bill_currency]">
                                          <option value="">--Select Currency--</option>
                                          <option value="AED" <?php echo ($company_bill_currency=='AED'?'':'selected');?>>AED</option>
                                          <option value="AUD" <?php echo ($company_bill_currency=='AUD'?'':'selected');?>>AUD</option>
                                          <option value="CAD" <?php echo ($company_bill_currency=='CAD'?'':'selected');?>>CAD</option>
                                          <option value="CHF" <?php echo ($company_bill_currency=='CHF'?'':'selected');?>>CHF</option>
                                          <option value="Euro" <?php echo ($company_bill_currency=='Euro'?'':'selected');?>>Euro</option>
                                          <option value="GBP" <?php echo ($company_bill_currency=='GBP'?'':'selected');?>>GBP</option>
                                          <option value="HKD" <?php echo ($company_bill_currency=='HKD'?'':'selected');?>>HKD</option>
                                          <option value="Rupees" <?php echo ($company_bill_currency=='Rupees'?'':'selected');?>>Rupees</option>
                                          <option value="JPY" <?php echo ($company_bill_currency=='JPY'?'':'selected');?>>JPY</option>
                                          <option value="RUB" <?php echo ($company_bill_currency=='RUB'?'':'selected');?>>RUB</option>
                                          <option value="SAR" <?php echo ($company_bill_currency=='SAR'?'':'selected');?>>SAR</option>
                                          <option value="SGD" <?php echo ($company_bill_currency=='SGD'?'':'selected');?>>SGD</option>
                                          <option value="USD" <?php echo ($company_bill_currency=='USD'?'':'selected');?>>USD</option>
                                       </select>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                   <div class="page-btns">
                                      <div class="form-group text-center custom-mt-form-group">
                                      @if(checkAccess('website-setting','edit_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>@endif
                                         <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                                      </div>
                                    </div>
                                </div>
                           </div>

                           <!-- <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Vendor Selection In Booking</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="radio"> Manual</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="radio">Lowest Rate</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="radio"> Rate List</label>
                                     </div>
                                </div>
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Mail Setting</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Host*</label>
                                   <input type="text" class="form-control" placeholder="Host">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Booking</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Client</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Consignor</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Consignee</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Port No*</label>
                                   <input type="text" class="form-control" placeholder="Port No">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Delivery</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Client</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Consignor</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Consignee</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Email ID*</label>
                                   <input type="text" class="form-control" placeholder="Email ID">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Password*</label>
                                   <input type="text" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> IsSecure</label>
                                     </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                   <div class="page-btns">
                                      <div class="form-group text-center custom-mt-form-group">
                                         <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                         <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                                      </div>
                                    </div>
                                </div>
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>SMS Setting</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-12 col-12">
                                   <label>SMS URL*</label>
                                   <textarea type="text" class="form-control" placeholder="Host"></textarea>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> Booking</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> Client</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> Consignor</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> Consignee</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> Delivery</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> Client</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> Consignor</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> Consignee</label>
                                     </div>
                                </div>

                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                   <div class="page-btns">
                                      <div class="form-group text-center custom-mt-form-group">
                                         <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                         <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                                      </div>
                                    </div>
                                </div>

                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Client Bill Setting</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Export Bill Series Prefix*</label>
                                   <input type="text" class="form-control" placeholder="Export Bill Series Prefix">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Import Bill Series Prefix*</label>
                                   <input type="text" class="form-control" placeholder="Import Bill Series Prefix">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Bill Start From*</label>
                                   <input type="text" class="form-control" placeholder="Bill Start From">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Client Bill*</label>
                                     <select class="form-control select">
                                         <option>--Select Format--</option>
                                         <option value="Format-A">Format-A</option>
                                         <option value="Format-B">Format-B</option>
                                         <option value="Format-C">Format-C</option>
                                     </select>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                   <label>Term & Condition*</label>
                                   <textarea type="text" class="form-control" placeholder="Client Term & Condition"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                   <div class="page-btns">
                                      <div class="form-group text-center custom-mt-form-group">
                                         <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                         <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                                      </div>
                                    </div>
                                </div>
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Other Setting</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-4 col-12">
                                     <div class="all-chk nw-hk">
                                         <label><input type="checkbox"> Allow customer to generate label</label>
                                     </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                   <div class="page-btns">
                                      <div class="form-group text-center custom-mt-form-group">
                                         <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                         <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                                      </div>
                                    </div>
                                </div>
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>AWB Print Setting</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Term Condition1*</label>
                                   <textarea type="text" class="form-control" placeholder="Term Condition1"></textarea>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Term Condition2*</label>
                                   <textarea type="text" class="form-control" placeholder="Term Condition2"></textarea>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Jurisdiction*</label>
                                   <textarea type="text" class="form-control" placeholder="Jurisdiction"></textarea>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                   <div class="page-btns">
                                      <div class="form-group text-center custom-mt-form-group">
                                         <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                         <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                                      </div>
                                    </div>
                                </div>
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Tracking Page Setting</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Mobile No On Tracking Page*</label>
                                   <input type="text" class="form-control" placeholder="Mobile No On Tracking Page">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                   <label>Email ID On Tracking Page*</label>
                                   <input type="text" class="form-control" placeholder="Email ID On Tracking Page">
                                </div>

                                <div class="form-group col-md-4 col-12">
                                     <div class="plusing-btn">
                                         <button class="btn btn-primary  btn-xs" tabindex="1" id="btnAddClientChargesDetails" type="button" title="Add Head"><i class="fa fa-retweet"></i> Generate Tracking Page Token
                                         </button>
                                     </div>
                                </div>

                                <div class="form-group col-md-8 col-12">
                                     <div class="g-link">
                                         <p>Tracking URL: http://app.couriermitra.com/tracking/Tracking?Token=&AwbNo=[[AwbNo]]</p>
                                     </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                   <div class="page-btns">
                                      <div class="form-group text-center custom-mt-form-group">
                                         <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                         <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                                      </div>
                                    </div>
                                </div>
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Tracking Field Setting</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-4 col-12">
                                     <div class="bodring-design">
                                         <label><input type="checkbox" id="select-all" /> Available Field [3]</label>
                                         <label><input type="checkbox"/>Consignor Name</label>
                                         <label><input type="checkbox"/>Consignee Name</label>
                                         <label><input type="checkbox"/>Weight</label>
                                     </div>
                                </div>

                                <div class="form-group col-md-1 col-12">
                                     <div class="plusing-btn">
                                         <button class="btn btn-primary  btn-xs" tabindex="1" id="btnAddClientChargesDetails" type="button" title="Add Head"> >>
                                         </button>
                                         <br>
                                         <br>
                                         <button class="btn btn-primary  btn-xs" tabindex="1" id="btnAddClientChargesDetails" type="button" title="Add Head"> <<
                                         </button>
                                     </div>
                                </div>

                                <div class="form-group col-md-4 col-12">
                                     <div class="bodring-design">
                                         <label><input type="checkbox" id="select-all" />Assigned Field [0]</label>
                                     </div>
                                </div>
                                
                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Third Party Tracking Setting</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-5 col-12">
                                   <label>Vendor*</label>
                                   <input type="text" class="form-control" placeholder="Vendor">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Third Party Vendor*</label>
                                       <select class="form-control select">
                                          <option>--Select--</option>
                                          <option value=""></option>
                                          <option value=""></option>
                                       </select>
                                </div>
                                
                                <div class="form-group col-md-3 col-12">
                                     <div class="plusing-btn" style="display:inline-block;">
                                         <button class="btn btn-primary  btn-xs" tabindex="1" id="btnAddClientChargesDetails" type="button" title="Add Head">Add <i class="fa fa-plus-circle"></i>
                                         </button>
                                         <button class="btn btn-default btn-xs" tabindex="1" id="btnResetClientChargesDetails" type="button" title="Reset Head">Reset <i class="fa fa-spinner"></i>
                                         </button>
                                     </div>
                                 </div> -->

                             <hr>
                                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                   <div class="page-btns">
                                      <div class="form-group text-center custom-mt-form-group">
                                         <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>
                                         <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                                      </div>
                                    </div>
                                </div> -->
                           </div>


                         </div>
                     </form></div>
                   </div>
               
             </div>
          </div>
       </div>
@endsection