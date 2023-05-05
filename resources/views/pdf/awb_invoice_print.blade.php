<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Saitalogistics</title>
    <meta name="author" content="Angfuzsoft">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="INDEX,FOLLOW">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.png">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="{{asset('admin/pdf/assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/pdf/assets/css/style.css')}}">  -->
    <style>
      body{font-family: sans-serif;font-size: 15px;}
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
  <div>
      <div class="div50">
        <img src="{{public_path('admin/pdf/assets/img/logo.png')}}" alt="Invce">
      </div>  
      <div class="div50" style="text-align: center;">
        <h1 class="big-title" style="font-size: 14px; font-family: sans-serif; margin-bottom: 3px;">CONSIGNMENT NOTE NUMBER</h1>
        <img src="{{public_path('admin/pdf/assets/img/codebar.png')}}" alt="" class="img-responsive">
        <p style="font-size: 13px; font-family: sans-serif; margin-top:5px; margin-bottom:0; margin-top: 0;">{{$invoiceData->awb_no}}</p>
      </div>  
      <div class="clear">&nbsp;</div>
      <div class="div100" style="margin-bottom:15px">
        
        <table width="100%">
          <tbody>
            <tr>
              <td><img src="{{public_path('admin/pdf/assets/img/bg/line_pattern.png')}}" alt="line"></td>
              <td><b style="font-size: 14px; font-family: sans-serif; margin-left: 20px;">SERVICE</b></td>
              <td><p class="invoice-date" style="font-size: 13px; font-family: sans-serif; margin-left: 20px;"><b>ORIGIN: </b>{{$invoiceData->csr_city_id}}</p></td>
              <td><p class="invoice-date" style="font-size: 13px; font-family: sans-serif; margin-left: 20px;"><b>DESTINATION: </b>{{$invoiceData->csn_city_id}}</p></td>
            </tr>
          </tbody>
      </table>
      </div>
      
      <div class="clear"></div>
      <div class="div50" style="width:47%;margin-right:2.5%"  >
        <p style="_display: block; border: 2px solid #333; font-size: 13px; padding: 6px 6px 6px 0; margin: 0; margin-bottom: 10px;">
        <b style="background: #000; font-family: sans-serif; color: #fff; padding:7px; margin-right: 5px;">SHIPPER A/C:</b> <span>........</span></p>
        
        <div style="border: 1px solid #000;">
        <table style="margin-top:10px; border: none;width: 100%; border-spacing: 0; text-align: left; padding: 10px;  font-family: sans-serif; font-size: 14px;">
        <thead>
          <tr>
            <th style="margin-bottom: 10px; display: block;text-align:left">{{$invoiceData->csr_consignor}} :</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$invoiceData->csr_state_id}}</td>
          </tr>
          <tr>
            <td>{{$invoiceData->csr_city_id}}</td>
          </tr>
          <tr>
            <td>{{$invoiceData->csr_address1}} - {{$invoiceData->csr_pincode}}, {{$invoiceData->country_name}}</td>
          </tr>
          <tr>
            <td>Mobile No: {{$invoiceData->csr_mobile_no}}</td>
          </tr>
        </tbody>
          </table>
        </div>
      </div>
      <div class="div50">
        <p style="display: inline-block; margin: 0; border: 2px solid #333; font-size: 13px; padding: 5px 0; margin-bottom: 2px; margin-top:10px; width: 48%; font-family: sans-serif;"><b style="background: #000; color: #fff; padding: 6px; margin-right: 5px;">DATE:</b> <span>{{date("d-M-Y",strtotime($invoiceData->booking_date))}}</span></p>
        <p style="display: inline-block; margin: 0; border: 2px solid #333; font-size: 13px; padding: 5px 0; margin-bottom: 2px; margin-top:10px; width: 49%; font-family: sans-serif;"><b style="background: #000; color: #fff; padding: 6px; margin-right: 5px;">ONFD.NO.</b> <span>........</span></p>
        <div style="border: 1px solid #000;">
        <table style="margin-top:10px;  border: none; width: 100%;  border-spacing: 0; text-align: left; padding: 10px; font-family: sans-serif; font-size: 14px;">
          <thead>
            <tr>
              <th style="margin-bottom: 10px; display: block;text-align:left">{{$invoiceData->csn_consignor}}:</th>
            </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{$invoiceData->csn_state_id}}</td>
          </tr>
          <tr>
            <td>{{$invoiceData->csn_city_id}}</td>
          </tr>
          <tr>
            <td>{{$invoiceData->csn_address1}}-{{$invoiceData->csn_pincode}},{{$invoiceData->csn_country_name}}</td>
          </tr>
          <tr>
            <td>Mobile No: {{$invoiceData->csn_mobile_no}}</td>
          </tr>
          </tbody>
        </table>
        </div>
      </div>
      <!-- Table -->
      <div class="clear"></div>
        <div class="div100">
          <table style="border: none; margin: 15px 0; width: 100%; border-collapse: collapse; border-spacing: 0;">
            <thead style="background: whitesmoke;">
              <tr style="text-align: center; border: 1px solid #4e4e4e; font-size: 13px; color: #fff; background: #000;">
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">NO.OF PCS.</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">Packing</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">CONTENTS - DESCRIPTION (SAID TO CONTAIN)</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">DIM(Cms.) L * W * H</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">ACTUAL WEIGHT</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">CHARGED WEIGHT</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px;">Special Remarks:</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">1</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">{{$invoiceData->packet_type}}</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;" >{{$invoiceData->packet_description}}</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;" >0*0*0</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">{{$invoiceData->actual_weight}}</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">{{$invoiceData->vendor_weight}}</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">{{$invoiceData->operation_remark}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Footer sign -->
        <div class="clear"></div>
        
        <div class="div50">
        <div style="padding-top:15px;">
        <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600; margin-bottom: 10px;">SENDER'S NAME <span>{{$invoiceData->csr_consignor}}</span></p>
        <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">SIGNATURE <span>.........................</span></p>
        </div>
        </div>
        <div class="div50">
          <div style="padding-top:15px;">
          <h5 style="text-align: right; font-size: 14px; font-weight: bold; color: #000; margin: 0; margin-bottom: 0px; font-family: sans-serif;">RECEIVED BY IT COMPANY</h5>
          <p class="mb-0" style="font-size: 13px; display: inline-block; color: #000; font-family: sans-serif;">SIGNATURE <span>.........................</span></p>
                    <p class="mb-0" style="font-size: 13px; display: inline-block; color: #000; font-family: sans-serif;">DATE <span>.........................</span></p>
                    <p class="mb-0" style="font-size: 13px; display: inline-block; color: #000; font-family: sans-serif;">TIME <span>.........................</span></p>
          </div>
        </div>
        <div class="">
        <div style="margin-top:80px;">
          <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">PAYMENT TYPE: <span>{{strtoupper($invoiceData->payment_type)}}</span></p>
          <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">PAYMENT AMOUNT: <span>{{$invoiceData->shipping_charge}}</span></p>
          <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">PAYMENT STATUS: <span>{{$invoiceData->payment_status}}</span></p>
        </div>
        </div>
        <div class="clear"></div>
        <div class="div100">
          <p class="invoice-note mt-3" style="font-size: 15px; font-weight: bold; color: #00000091; margin: 10px 0; margin-bottom: 0px; font-family: sans-serif;">
          THANKS FOR SHIPPING WITH IT COMPANY
          </p>
          <div class="cut-here" style="background: url({{public_path('admin/pdf/assets/img/cut-here.png')}}) no-repeat center; padding: 15px; 0;"> 
            <p style="text-align: center; font-family: sans-serif; font-weight: 600; color: #000;">Cut Here</p>
          </div>
        </div>
      

        <!-- SECOND PRINT -->
        <div class="clear">&nbsp;</div>
        <div class="clear">&nbsp;</div>
        <div class="clear">&nbsp;</div>
        <div class="clear" style="margin-top:50px">&nbsp;</div>
        <div class="div50">
        <img src="{{public_path('admin/pdf/assets/img/logo.png')}}" alt="Invce">
        </div>  
      <div class="div50" style="text-align: center;">
        <h1 class="big-title" style="font-size: 14px; font-family: sans-serif; margin-bottom: 3px;">CONSIGNMENT NOTE NUMBER</h1>
        <img src="{{public_path('admin/pdf/assets/img/codebar.png')}}" alt="" class="img-responsive">
        <p style="font-size: 13px; font-family: sans-serif; margin-top:5px; margin-bottom:0; margin-top: 0;">{{$invoiceData->awb_no}}</p>
      </div>  
      <div class="clear">&nbsp;</div>
      <div class="div100" style="margin-bottom:15px">
        
        <table width="100%">
          
          <tbody>
            <tr>
              <td><img src="{{public_path('admin/pdf/assets/img/bg/line_pattern.png')}}" alt="" class="img-responsive"></td>
              <td><b style="font-size: 14px; font-family: sans-serif; margin-left: 20px;">SERVICE</b></td>
              <td><p class="invoice-date" style="font-size: 13px; font-family: sans-serif; margin-left: 20px; margin-bottom: 0;"><b>ORIGIN: </b>100.000</p> 
              <p class="invoice-date" style="font-size: 13px; font-family: sans-serif; margin-left: 20px; margin-top: 5px;"><b>ORIGIN: </b>{{$invoiceData->csr_city_id}}</p>
              </td>
              <td><p class="invoice-date" style="font-size: 13px; font-family: sans-serif; margin-left: 20px; margin-bottom: 0;"><b>CREDIT AMOUNT: </b>-----</p> 
              <p class="invoice-date" style="font-size: 13px; font-family: sans-serif; margin-left: 20px; margin-top: 5px;"><b>DESTINATION: </b>{{$invoiceData->csn_city_id}}</p></td>
            </tr>
          </tbody>
      </table>
      </div>
      
      <div class="clear"></div>
      <div class="div50" style="width:47%;margin-right:2.5%">
        <p style="_display: block; border: 2px solid #333; font-size: 13px; padding: 6px 6px 6px 0; margin: 0; margin-bottom: 10px;">
        <b style="background: #000; font-family: sans-serif; color: #fff; padding:7px; margin-right: 5px;">SHIPPER A/C:</b> <span>........</span></p>
        
        <div style="border: 1px solid #000;">
        <table style="margin-top:10px; border: none;width: 100%; border-spacing: 0; text-align: left; padding: 10px;  font-family: sans-serif; font-size: 14px;">
        <thead>
          <tr>
            <th style="margin-bottom: 10px; display: block;text-align:left">{{$invoiceData->csr_consignor}} :</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td>{{$invoiceData->csr_state_id}}</td>
        </tr>
        <tr>
          <td>{{$invoiceData->csr_city_id}}</td>
        </tr>
        <tr>
          <td>{{$invoiceData->csr_address1}} - {{$invoiceData->csr_pincode}}, {{$invoiceData->country_name}}</td>
        </tr>
        <tr>
          <td>Mobile No: {{$invoiceData->csr_mobile_no}}</td>
        </tr>
        </tbody>
          </table>
        </div>
      </div>
      <div class="div50">
        <p style="display: inline-block; margin: 0; border: 2px solid #333; font-size: 13px; padding: 5px 0; margin-bottom: 2px; margin-top:10px; width: 48%; font-family: sans-serif;"><b style="background: #000; color: #fff; padding: 6px; margin-right: 5px;">DATE:</b> <span>{{date("d-M-Y",strtotime($invoiceData->booking_date))}}</span></p>
        <p style="display: inline-block; margin: 0; border: 2px solid #333; font-size: 13px; padding: 5px 0; margin-bottom: 2px; margin-top:10px; width: 49%; font-family: sans-serif;"><b style="background: #000; color: #fff; padding: 6px; margin-right: 5px;">ONFD.NO.</b> <span>........</span></p>
        <div style="border: 1px solid #000;">
        <table style="margin-top:10px;  border: none; width: 100%;  border-spacing: 0; text-align: left; padding: 10px; font-family: sans-serif; font-size: 14px;">
          <thead>
            <tr>
              <th style="margin-bottom: 10px; display: block;text-align:left">{{$invoiceData->csn_consignor}}:</th>
            </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{$invoiceData->csn_state_id}}</td>
          </tr>
          <tr>
            <td>{{$invoiceData->csn_city_id}}</td>
          </tr>
          <tr>
            <td>{{$invoiceData->csn_address1}}-{{$invoiceData->csn_pincode}},{{$invoiceData->csn_country_name}}</td>
          </tr>
          <tr>
            <td>Mobile No: {{$invoiceData->csn_mobile_no}}</td>
          </tr>
          </tbody>
        </table>
        </div>
      </div>
      <!-- Table -->
      <div class="clear"></div>
        <div class="div100">
          <table style="border: none; margin: 15px 0; width: 100%; border-collapse: collapse; border-spacing: 0;">
            <thead style="background: whitesmoke;">
              <tr style="text-align: center; border: 1px solid #4e4e4e; font-size: 13px; color: #fff; background: #000;">
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">NO.OF PCS.</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">Packing</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">CONTENTS - DESCRIPTION (SAID TO CONTAIN)</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">DIM(Cms.) L * W * H</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">ACTUA WEIGHT</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px; border-right: 1px solid #eeeeee94;">CHARGED WEIGHT</th>
                <th style="padding: 10px; font-family: sans-serif; font-size: 13px;">Special Remarks:</th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">1</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">{{$invoiceData->packet_type}}</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;" >{{$invoiceData->packet_description}}</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;" >{{$invoiceData->length}}*{{$invoiceData->width}}*{{$invoiceData->height}}</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">{{$invoiceData->actual_weight}}</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">{{$invoiceData->vendor_weight}}</td>
              <td style="padding: 8px 5px; text-align: center; border: 1px solid #4e4e4e; font-size: 12px; font-family: sans-serif;">{{$invoiceData->operation_remark}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Footer sign -->
        <div class="clear"></div>
        
        <div class="div50">
        <div style="padding-top:15px;">
        <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600; margin-bottom: 10px;">SENDER'S NAME <span>{{$invoiceData->csr_consignor}}</span></p>
        <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">SIGNATURE <span>.........................</span></p>
        </div>
        </div>
        <div class="div50">
          <div style="padding-top:15px;">
          <h5 style="text-align: right; font-size: 14px; font-weight: bold; color: #000; margin: 0; margin-bottom: 0px; font-family: sans-serif;">RECEIVED BY {{$website['company_name']}}</h5>
          <p class="mb-0" style="font-size: 13px; display: inline-block; color: #000; font-family: sans-serif;">SIGNATURE <span>.........................</span></p>
                    <p class="mb-0" style="font-size: 13px; display: inline-block; color: #000; font-family: sans-serif;">DATE <span>.........................</span></p>
                    <p class="mb-0" style="font-size: 13px; display: inline-block; color: #000; font-family: sans-serif;">TIME <span>.........................</span></p>
          </div>
        </div>
        <div class="">
        <div style="margin-top:80px;">
          <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">PAYMENT TYPE: <span>{{strtoupper($invoiceData->payment_type)}}</span></p>
          <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">PAYMENT AMOUNT: <span>{{$invoiceData->shipping_charge}}</span></p>
          <p class="mb-0" style="display: block; font-size: 14px; padding: 0; margin: 0; font-family: sans-serif; font-weight: 600;">PAYMENT STATUS: <span>{{$invoiceData->payment_status}}</span></p>
        </div>
        </div>
        <div class="clear"></div>
        <div class="div100">
          <p class="invoice-note mt-3" style="font-size: 15px; font-weight: bold; color: #00000091; margin: 10px 0; margin-bottom: 0px; font-family: sans-serif;">
          THANKS FOR SHIPPING WITH {{$website['company_name']}}
          </p>
          
        </div>
        <!-- SECOND PRINT -->

</div>
  </body>
</html>