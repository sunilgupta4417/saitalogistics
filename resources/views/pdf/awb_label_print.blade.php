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
    <link rel="stylesheet" href="{{asset('admin/pdf/assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/pdf/assets/css/style.css')}}">

  </head>
  <body>
    <div class="invoice-container-wrap">
      <div class="invoice-container">
        <main>
          <div class="as-invoice invoice_style1">
            <div class="download-inner" id="download_section">
              <header class="as-header header-layout1">
                <div class="row align-items-center justify-content-between">
                  <div class="col-auto">
                    <div class="header-logo">
                      <a href="index.html">
                        <img src="{{asset('admin/pdf/assets/img/logo.png')}}" alt="Invce">
                      </a>
                    </div>
                  </div>
                  <div class="col-auto">
                  	<div class="codebar">
	                    <h1 class="big-title">IT COMPANY</h1>
	                    <a href="#">sunilsingh.dhani@gmail.com</a>
	                </div>
                  </div>
                </div>
                <div class="header-bottom">
                  <div class="row align-items-center">
                    <div class="col">
                      <div class="border-line">
                        <img src="{{asset('admin/pdf/assets/img/bg/line_pattern.svg')}}" alt="line">
                      </div>
                    </div>
                  </div>
                </div>
              </header>
              <div class="row justify-content-between mb-4">
                <div class="col-auto">
                  <div class="invoice-left">
                    <p><b style="background: #000; color: #fff; padding: 4px; margin-right: 5px;">Client: </b> <span>{{$labelData->client_name}}</span></p>
                    <div class="sec-more-address">
                      <div class="more-iner-text">
                          <table class="table-resposnive" id="iner-table">
                            <thead>
                              <tr>
                                <th>From :</th>
                                <th>{{$labelData->csr_state_id}}</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{$labelData->csr_consignor}}</td>
                              </tr>
                              <tr>
                            <td>{{$labelData->csr_state_id}}</td>
                            </tr>
                            <tr>
                            <td>{{$labelData->csr_city_id}}</td>
                            </tr>
                            <tr>
                            <td>{{$labelData->csr_address1}} - {{$labelData->csr_pincode}}, {{$labelData->country_name}}</td>
                            </tr>
                            <tr>
                            <td>Mobile No: {{$labelData->csr_mobile_no}}</td>
                            </tr>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="invoice-right second-right">
                    <p><b style="background: #000; color: #fff; padding: 4px; margin-right: 5px;">DATE:</b> <span>{{date("d-M-Y",strtotime($labelData->booking_date))}}</span></p>
                    <div class="sec-more-address">
                      <div class="more-iner-text">
                          <table class="table-resposnive" id="iner-table">
                            <thead>
                              <tr>
                                <th>To :</th>
                                <th>{{$labelData->csn_state_id}}</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{$labelData->csn_consignor}}</td>
                              </tr>
                              <tr>
                                <td>{{$labelData->csn_state_id}}</td>
                            </tr>
                            <tr>
                                <td>{{$labelData->csn_city_id}}</td>
                            </tr>
                            <tr>
                                <td>{{$labelData->csn_address1}}-{{$labelData->csn_pincode}},{{$labelData->csn_country_name}}</td>
                            </tr>
                            <tr>
                                <td>Mobile No: {{$labelData->csn_mobile_no}}</td>
                            </tr>
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <table class="invoice-table">
                <thead>
                  <tr>
                    <th>PCS</th>
                    <th>TYPE</th>
                    <th>CONTENTS</th>
                    <th>DIM(CM) L * W * H</th>
                    <th>ACTUA WEIGHT</th>
                    <th>CHARGED WEIGHT</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>{{$labelData->packet_type}}</td>
                    <td>{{$labelData->packet_description}}</td>
                    <td>0*0*0</td>
                    <td>{{$labelData->actual_weight}}</td>
                    <td>{{$labelData->vendor_weight}}</td>
                  </tr>
                </tbody>
              </table>

              <div class="awb-data">
                <h3>AWB</h3>
                <img src="{{asset('admin/pdf/assets/img/codebar.png')}}" alt="" class="img-responsive">
                <b>{{$labelData->awb_no}}</b>
              </div>

              <div class="body-shape1"></div>
            </div>

          </div>
        </main>
      </div>
    </div>
    

  </body>
</html>