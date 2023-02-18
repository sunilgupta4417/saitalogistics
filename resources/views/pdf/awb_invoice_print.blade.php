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
    <link rel="stylesheet" href="{{asset('admin/pdf/assets/css/app.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/pdf/assets/css/style.css')}}"> 
    <style>
    </style>
  </head>
  <body>

    <div class="invoice-container-wrap">
      <div class="invoice-container">
        <!-- First Slip Here Start -->
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
    	                    <h1 class="big-title">CONSIGNMENT NOTE NUMBER SERVICE</h1>
    	                    <img src="{{asset('admin/pdf/assets/img/codebar.png')}}" alt="" class="img-responsive">
    	                    <p>{{$invoiceData->awb_no}}</p>
    	                </div>
                      </div>
                    </div>
                    <div class="header-bottom">
                      <div class="row align-items-center">
                        <div class="col">
                          <div class="border-line">
                            <img src="pdf/assets/img/bg/line_pattern.svg" alt="line">
                          </div>
                        </div>
                        <div class="col-auto">
                          <p class="invoice-number">
                            <b>SERVICE </b>
                          </p>
                        </div>
                        <div class="col-auto">
                          <p class="invoice-date">
                            <b>ORIGIN: </b>{{$invoiceData->csr_city_id}}
                          </p>
                        </div>
                        <div class="col-auto">
                          <p class="invoice-date">
                            <b>DESTINATION: </b>{{$invoiceData->csn_city_id}}
                          </p>
                        </div>
                      </div>
                    </div>
                  </header>
                  <div class="row justify-content-between mb-2">
                    <div class="col-auto">
                      <div class="invoice-left">
                        <p><b style="background: #000; color: #fff; padding: 4px; margin-right: 5px;">SHIPPER A/C:</b> <span>........</span></p>
                        <div class="more-address">
                          <ul>
                            <li>C</li>
                            <li>O</li>
                            <li>N</li>
                            <li>S</li>
                            <li>I</li>
                            <li>G</li>
                            <li>N</li>
                            <li>O</li>
                            <li>R</li>
                          </ul>
                              <table class="table-resposnive" id="iner-table">
                                <thead>
                                  <tr>
                                    <th>{{$invoiceData->csr_consignor}} :</th>
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
                    </div>
                    <div class="col-auto">
                      <div class="invoice-right">
                        <p><b style="background: #000; color: #fff; padding: 4px; margin-right: 5px;">DATE:</b> <span>{{date("d-M-Y",strtotime($invoiceData->booking_date))}}</span></p>
                        <p><b style="background: #000; color: #fff; padding: 4px; margin-right: 5px;">ONFD.NO.</b> <span>........</span></p>
                        <div class="more-address">
                          <ul>
                            <li>C</li>
                            <li>O</li>
                            <li>N</li>
                            <li>S</li>
                            <li>I</li>
                            <li>G</li>
                            <li>N</li>
                            <li>O</li>
                            <li>E</li>
                            <li>E</li>
                          </ul>
                          <table class="table-resposnive" id="iner-table">
                            <thead>
                                <tr>
                                  <th>{{$invoiceData->csn_consignor}} :</th>
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
                    </div>
                  </div>
                  <table class="invoice-table">
                    <thead>
                      <tr>
                        <th>NO.OF PCS.</th>
                        <th>Packing</th>
                        <th>CONTENTS - DESCRIPTION (SAID TO CONTAIN)</th>
                        <th>DIM(Cms.) L * W * H</th>
                        <th>ACTUA WEIGHT</th>
                        <th>CHARGED WEIGHT</th>
                        <th>Special Remarks:</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>1</td>
                      <td>{{$invoiceData->packet_type}}</td>
                      <td>{{$invoiceData->packet_description}}</td>
                      <td>0*0*0</td>
                      <td>{{$invoiceData->actual_weight}}</td>
                      <td>{{$invoiceData->vendor_weight}}</td>
                      <td>{{$invoiceData->vendor_weight}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row justify-content-between">
                    <div class="col-auto" id="new-ids">
                      <div class="invoice-left">
                        <p class="mb-0">SENDER NAME <span>.........................</span></p>
                        <p class="mb-0">SIGNATURE <span>.........................</span></p>
                      </div>
                    </div>
                    <div class="col-auto">
                        <div class="received-text">
                        <h5>RECEIVED BY IT COMPANY</h5>
                        <p class="mb-0">SIGNATURE <span>.........................</span></p>
                        <p class="mb-0">DATE <span>.........................</span></p>
                        <p class="mb-0">TIME <span>.........................</span></p>
                      </div>
                    </div>
                  </div>
                  <p class="invoice-note mt-3">
                    THANKS FOR SHIPPING WITH IT COMPANY
                  </p>
                  <div class="body-shape1"></div>
                </div>

              </div>
            </main>
        <!-- First Slip Here End -->

        <div class="cut-here"> 
          <p>Cut Here</p>
        </div>

        <!-- Second Slip Here Start -->
            <main>
              <div class="as-invoice invoice_style1">
                <div class="download-inner" id="download_section">
                  <header class="as-header header-layout1">
                    <div class="row align-items-center justify-content-between">
                      <div class="col-auto">
                        <div class="header-logo">
                          <a href="index.html">
                            <img src="pdf/assets/img/logo.png" alt="Invce">
                          </a>
                        </div>
                      </div>
                      <div class="col-auto">
                        <div class="codebar">
                          <h1 class="big-title">CONSIGNMENT NOTE NUMBER SERVICE</h1>
                          <img src="{{asset('admin/pdf/assets/img/codebar.png')}}" alt="" class="img-responsive">
                          <p>AWB001</p>
                      </div>
                      </div>
                    </div>
                    <div class="header-bottom">
                      <div class="row align-items-center">
                        <div class="col">
                          <div class="border-line">
                            <img src="pdf/assets/img/bg/line_pattern.svg" alt="line">
                          </div>
                        </div>
                        <div class="col-auto">
                          <p class="invoice-number me-4">
                            <b>SERVICE </b>
                          </p>
                        </div>
                        <div class="col-auto second-toping">
                          <p class="invoice-date">
                            <b>CASH AMOUNT: </b>100.000
                          </p>
                          <p class="invoice-date">
                            <b>ORIGIN: </b>{{$invoiceData->csr_city_id}}
                          </p>
                        </div>
                        <div class="col-auto second-toping">
                          <p class="invoice-date">
                            <b>CREDIT AMOUNT: </b>---
                          </p>
                          <p class="invoice-date">
                            <b>DESTINATION: </b>{{$invoiceData->csn_city_id}}
                          </p>
                        </div>
                      </div>
                    </div>
                  </header>
                  <div class="row justify-content-between mb-2">
                    <div class="col-auto">
                      <div class="invoice-left">
                        <p><b style="background: #000; color: #fff; padding: 4px; margin-right: 5px;">SHIPPER A/C:</b> <span>........</span></p>
                        <div class="more-address">
                          <ul>
                            <li>C</li>
                            <li>O</li>
                            <li>N</li>
                            <li>S</li>
                            <li>I</li>
                            <li>G</li>
                            <li>N</li>
                            <li>O</li>
                            <li>R</li>
                          </ul>
                              <table class="table-resposnive" id="iner-table">
                              <thead>
                                  <tr>
                                    <th>{{$invoiceData->csr_consignor}} :</th>
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
                    </div>
                    <div class="col-auto">
                      <div class="invoice-right">
                        <p><b style="background: #000; color: #fff; padding: 4px; margin-right: 5px;">DATE:</b> <span>{{date("d-M-Y",strtotime($invoiceData->booking_date))}}</span></p>
                        <p><b style="background: #000; color: #fff; padding: 4px; margin-right: 5px;">ONFD.NO.</b> <span>........</span></p>
                        <div class="more-address">
                          <ul>
                            <li>C</li>
                            <li>O</li>
                            <li>N</li>
                            <li>S</li>
                            <li>I</li>
                            <li>G</li>
                            <li>N</li>
                            <li>O</li>
                            <li>E</li>
                            <li>E</li>
                          </ul>
                          <table class="table-resposnive" id="iner-table">
                          <thead>
                                <tr>
                                  <th>{{$invoiceData->csn_consignor}} :</th>
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
                    </div>
                  </div>
                  <table class="invoice-table">
                    <thead>
                      <tr>
                        <th>NO.OF PCS.</th>
                        <th>Packing</th>
                        <th>CONTENTS - DESCRIPTION (SAID TO CONTAIN)</th>
                        <th>DIM(Cms.) L * W * H</th>
                        <th>ACTUA WEIGHT</th>
                        <th>CHARGED WEIGHT</th>
                        <th>Special Remarks:</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>{{$invoiceData->packet_type}}</td>
                        <td>{{$invoiceData->packet_description}}</td>
                        <td>0*0*0</td>
                        <td>{{$invoiceData->actual_weight}}</td>
                        <td>{{$invoiceData->vendor_weight}}</td>
                        <td>{{$invoiceData->vendor_weight}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row justify-content-between">
                    <div class="col-auto" id="new-ids">
                      <div class="invoice-left">
                        <p class="mb-0">SENDER NAME <span>.........................</span></p>
                        <p class="mb-0">SIGNATURE <span>.........................</span></p>
                      </div>
                    </div>
                    <div class="col-auto">
                        <div class="received-text">
                        <h5>RECEIVED BY IT COMPANY</h5>
                        <p class="mb-0">SIGNATURE <span>.........................</span></p>
                        <p class="mb-0">DATE <span>.........................</span></p>
                        <p class="mb-0">TIME <span>.........................</span></p>
                      </div>
                    </div>
                  </div>
                  <p class="invoice-note mt-3">
                    THANKS FOR SHIPPING WITH IT COMPANY
                  </p>
                  <div class="body-shape1"></div>
                </div>

              </div>
            </main>
        <!-- Second Slip Here End -->
      </div>
    </div>
  </body>
</html>