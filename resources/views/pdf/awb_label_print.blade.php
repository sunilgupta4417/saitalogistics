<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Saitalogistics</title>
   
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.png">
    <link rel="stylesheet" href="{{public_path('admin/pdf/assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{public_path('admin/pdf/assets/css/style.css')}}">
    <style>
      body{font-family: sans-serif;
    font-size: 15px;}
    .div50{width:50%;_border:1px solid #000;float:left;}
    .div100{width:100%;}
    .clear{clear:both;width:100%;height:2px;}
    .big-title{font-size:16px;margin-bottom:5px;}
    .packet_tbl thead tr{text-align: center;border: 1px solid #4e4e4e;color: #fff;background: #000;}
    .packet_tbl thead tr th{padding: 8px 5px;text-align: center;border: 1px solid #4e4e4e;font-family: sans-serif;}
    .packet_tbl tbody tr td{    padding: 8px 5px;text-align: center;border: 1px solid #4e4e4e;font-family: sans-serif;}
    .pd-10{padding:10px;}
    .pd-l10{padding-left:10px;}
    </style>
  </head>
  <body>
    <div style="width:100%;_border:1px solid  #000;">
      <div class="div50">
        <img src="{{public_path('admin/pdf/assets/img/logo.png')}}" alt="Invce">
      </div>  
      <div class="div50" style="text-align: right;">
        <h1 class="big-title" style="font:size:18px;text-transform:uppercase">{{$website['company_name']}}</h1>
        <a href="mailto:{{isset($labelData->csr_email_id)?$labelData->csr_email_id:''}}" style="font:size:17px;">{{isset($labelData->csr_email_id)?$labelData->csr_email_id:''}}</a>
      </div>  
      <div class="clear">&nbsp;</div>
      <div class="div100" style="margin-bottom:15px">
        <img src="{{public_path('admin/pdf/assets/img/bg/line_pattern.png')}}" alt="line">
      </div>
      <div class="clear"></div>
      <div class="div50" >
        <div style="padding-right:10px">
          <p style="display: block; border: 2px solid #333; font-size: 15px; padding: 2px 0px; 
       margin-bottom: 10px;">
          <b style="background: #000; font-family: sans-serif; color: #fff; padding:7px 6px ; margin-right: 5px;">Client:</b>
          <span style="font-family: sans-serif;">{{isset($labelData->client_code)?$labelData->client_code:''}}</span>
      </p>
        <table style="border:1px solid;">
          <thead >
             <tr>
               <th class="pd-10" style="font-size:16px;">From: {{isset($labelData->csr_state_id)?$labelData->csr_state_id:''}}</th>
             </tr>
           </thead>
           <tbody>
            <tr>
              <td class="pd-l10">{{isset($labelData->csr_consignor)?$labelData->csr_consignor:''}}</td>
            </tr>
            <tr>
            <td class="pd-l10"> {{isset($labelData->csr_state_id)?$labelData->csr_state_id:''}}</td>
            </tr>
            <tr>
            <td class="pd-l10">{{isset($labelData->csr_city_id)?$labelData->csr_city_id:''}}</td>
            </tr>
            <tr>
            <td class="pd-l10">{{isset($labelData->csr_address1)?$labelData->csr_address1:''}} - {{isset($labelData->csr_pincode)?$labelData->csr_pincode:''}}, {{isset($labelData->country_name)?$labelData->country_name:''}}</td>
            </tr>
            <tr>
            <td class="pd-l10" style="padding-bottom:15px;">Mobile No: {{isset($labelData->csr_mobile_no)?$labelData->csr_mobile_no:''}}</td>
            </tr>
            </tbody>
          </table>
    </div>
      </div>
      <div class="div50">
        <div style="margin-top:7px;">
      <p style="display: inline-block; margin: 0; border: 2px solid #333; font-size: 15px; padding: 1px 0; margin-bottom: 6px; width: 48%; font-family: sans-serif;">
      <b style="background: #000; color: #fff; padding: 6px; margin-right: 5px;">DATE:</b> <span>{{isset($labelData->booking_date)?date("d-M-Y",strtotime($labelData->booking_date)):''}}</span></p>
      <p style="display: inline-block; margin: 0; border: 2px solid #333; font-size: 15px; padding: 1px 0; margin-bottom: 6px; width: 49%; font-family: sans-serif;">
      <b style="background: #000; color: #fff; padding: 6px; margin-right: 5px;">ONFD.NO.</b> <span>........</span></p>
        </span></p>
        <table style="border:1px solid;">
          <thead>
            <tr>
              <th class="pd-10" style="font-size:16px;">To: {{isset($labelData->csn_state_id)?$labelData->csn_state_id:''}}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="pd-l10">{{isset($labelData->csn_consignor)?$labelData->csn_consignor:''}}</td>
            </tr>
            <tr>
              <td class="pd-l10">{{isset($labelData->csn_state_id)?$labelData->csn_state_id:''}}</td>
          </tr>
          <tr>
              <td class="pd-l10">{{isset($labelData->csn_city_id)?$labelData->csn_city_id:''}}</td>
          </tr>
          <tr>
              <td class="pd-l10">{{isset($labelData->csn_address1)?$labelData->csn_address1:''}}-{{isset($labelData->csn_pincode)?$labelData->csn_pincode:''}},{{isset($labelData->csn_country_name)?$labelData->csn_country_name:''}}</td>
          </tr>
          <tr>
              <td class="pd-l10" style="padding-bottom:15px;">Mobile No: {{isset($labelData->csn_mobile_no)?$labelData->csn_mobile_no:''}}</td>
          </tr>
          </tbody>
        </table>
    </div>
      </div>
      <div class="clear"></div>
      <table width="100%" class="packet_tbl" cellspacing="1">
        <thead>
          <tr>
            <th>PCS</th>
            <th>TYPE</th>
            <th>CONTENTS</th>
            <th>DIM(CM) L * W * H</th>
            <th>ACTUAL WEIGHT</th>
            <th>CHARGED WEIGHT</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>{{isset($labelData->packet_type)?$labelData->packet_type:''}}</td>
            <td>{{isset($labelData->packet_description)?$labelData->packet_description:''}}</td>
            <td>{{(!isset($labelData->length) || $labelData->length==null)?0:$labelData->length}}*{{(!isset($labelData->width) || $labelData->width==null)?0:$labelData->width}}*{{(!isset($labelData->height)||$labelData->height==null)?0:$labelData->height}}</td>
            <td>{{isset($labelData->actual_weight)?$labelData->actual_weight:''}}</td>
            <td>{{isset($labelData->vendor_weight)?$labelData->vendor_weight:''}}</td>
          </tr>
        </tbody>
      </table>
      <div class="clear"></div>
      <div class="">
        <div style="margin-top:80px;">
          <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">PAYMENT TYPE: <span>{{isset($labelData->payment_type)?strtoupper($labelData->payment_type):''}}</span></p>
          <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">PAYMENT AMOUNT: <span>{{isset($labelData->shipping_charge)?$labelData->shipping_charge:''}}</span></p>
          <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">PAYMENT STATUS: <span>{{isset($labelData->payment_status)?$labelData->payment_status:''}}</span></p>
        </div>
        </div>
      <div style="text-align: center;">
        <h3 style="font-size: 24px; font-family:sans-serif; margin: 0;">AWB</h3>
        <div class="clear"></div>
        <img src="{{public_path('admin/pdf/assets/img/codebar.png')}}" alt=""
         style="display: block; margin: 5px auto;">
        <div class="clear"></div>
        <b style="font-size: 14px; text-align: left; font-family:sans-serif;">{{$awb_no}}</b>
        <div class="clear"></div>
        <div class="clear"></div>
        <div class="clear"></div>
      </div>
    </div>
  </body>
</html>