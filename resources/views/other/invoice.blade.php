@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">INVOICE</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Accounts</a></li>
                <li class="breadcrumb-item"><span> Invoice</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="row">
       <div class="col-sm-5 col-4"></div>
       <div class="col-sm-7 col-8 text-right add-btn-col">
          <div class="btn-group btn-group-sm">
             <button class="btn btn-white">CSV</button>
             <button class="btn btn-white">PDF</button>
             <button class="btn btn-white"><i class="fas fa-print fa-lg"></i> Print</button>
          </div>
       </div>
    </div>
    <div class="row">
       <div class="col-md-12">
          <div class="card">
             <div class="card-body">
                <div class="row">
                   <div class="col-sm-6 m-b-20">
                      <img src="assets/img/logo.png" class="inv-logo" alt="">
                      <ul class="list-unstyled">
                         <li>3864 Quiet Valley Lane,</li>
                         <li>Sherman Oaks, CA, 91403</li>
                         <li>Gst No: ABCD123456</li>
                      </ul>
                   </div>
                   <div class="col-sm-6 m-b-20">
                      <div class="invoice-details">
                         <h3 class="text-uppercase">Invoice #INV-0001</h3>
                         <ul class="list-unstyled">
                            <li>Date: <span>October 12, 2018</span></li>
                            <li>Due date: <span>November 25, 2018</span></li>
                         </ul>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-sm-6 col-lg-9 m-b-20">
                      <h5>Invoice to:</h5>
                      <ul class="list-unstyled">
                         <li>
                            <h5><strong>Barry Cuda</strong></h5>
                         </li>
                         <li><span>Global Technologies</span></li>
                         <li>5754 Lorem Ipsum is </li>
                         <li>simply dummy text, 36020</li>
                         <li>UK</li>
                         <li>888-777-6655</li>
                         <li><a href="#"><span class="__cf_email__" data-cfemail="20424152525943554441604558414d504c450e434f4d">[email&nbsp;protected]</span></a></li>
                      </ul>
                   </div>
                   <div class="col-sm-6 col-lg-3 m-b-20">
                      <span class="text-muted">Payment Details:</span>
                      <ul class="list-unstyled invoice-payment-details">
                         <li>
                            <h5>Total Amount: <span class="text-right">$8,750</span></h5>
                         </li>
                         <li>Bank name: <span>Profit Bank Europe</span></li>
                         <li>Country: <span>United Kingdom</span></li>
                         <li>City: <span>London E1 8BF</span></li>
                         <li>Address: <span>3 Goodman street</span></li>
                         <li>IBAN: <span>KFH37784028476740</span></li>
                         <li>SWIft code: <span>BPT4E</span></li>
                      </ul>
                   </div>
                </div>
                <div class="table-responsive">
                   <table class="table custom-table">
                      <thead class="thead-light">
                         <tr>
                            <th>#</th>
                            <th>ITEM</th>
                            <th class="d-none d-sm-block">DESCRIPTION</th>
                            <th>UNIT COST</th>
                            <th>QUANTITY</th>
                            <th>TOTAL</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr>
                            <td>1</td>
                            <td>Android Application</td>
                            <td class="d-none d-sm-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit</td>
                            <td>$1000</td>
                            <td>2</td>
                            <td>$2000</td>
                         </tr>
                         <tr>
                            <td>2</td>
                            <td>Ios Application</td>
                            <td class="d-none d-sm-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit</td>
                            <td>$1750</td>
                            <td>1</td>
                            <td>$1750</td>
                         </tr>
                         <tr>
                            <td>3</td>
                            <td>Codeigniter Project</td>
                            <td class="d-none d-sm-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit</td>
                            <td>$90</td>
                            <td>3</td>
                            <td>$270</td>
                         </tr>
                         <tr>
                            <td>4</td>
                            <td>Phonegap Project</td>
                            <td class="d-none d-sm-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit</td>
                            <td>$1200</td>
                            <td>2</td>
                            <td>$2400</td>
                         </tr>
                         <tr>
                            <td>5</td>
                            <td>Website Optimization</td>
                            <td class="d-none d-sm-block">Lorem ipsum dolor sit amet, consectetur adipiscing elit</td>
                            <td>$200</td>
                            <td>2</td>
                            <td>$400</td>
                         </tr>
                      </tbody>
                   </table>
                </div>
                <div>
                   <div class="row invoice-payment">
                      <div class="col-sm-7"></div>
                      <div class="col-sm-5">
                         <div class="m-b-20 mt-2">
                            <h6>Total due</h6>
                            <div class="table-responsive no-border">
                               <table class="table m-b-0">
                                  <tbody>
                                     <tr>
                                        <th>Subtotal:</th>
                                        <td class="text-right">$7,000</td>
                                     </tr>
                                     <tr>
                                        <th>Tax: <span class="text-regular">(25%)</span></th>
                                        <td class="text-right">$1,750</td>
                                     </tr>
                                     <tr>
                                        <th>Total:</th>
                                        <td class="text-right text-primary">
                                           <h5>$8,750</h5>
                                        </td>
                                     </tr>
                                  </tbody>
                               </table>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="invoice-info">
                      <h5>Other information</h5>
                      <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero, eu finibus sapien interdum vel</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection