@extends('layouts.admin')

@section('content')
<style>
    table tr th,td{padding:5px}
    .height-light{background-color: #555;color: #FFF;}
</style>
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Packet Booking Detail</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Operation Management</a></li>
                <li class="breadcrumb-item"><span>Packet Booking Detail</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="col-md-12">    
                        <div class="x_content">
                            
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr>
                                            <th style="width:25%">AWB NO</th>
                                            <th style="width:2%">:</th>
                                            <td>{{$packet->awb_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Ref No</th>
                                            <th >:</th>
                                            <td>{{$packet->reference_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Booking Date</th>
                                            <th >:</th>
                                            <td>{{$packet->booking_date}}</td>
                                        </tr>
                                        <tr>
                                            <th>Client</th>
                                            <th >:</th>
                                            <td>{{$packet->client_id}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="height-light">Consignor Details</th>
                                        </tr>
                                        <tr>
                                            <th>Consignor</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_consignor}}</td>
                                        </tr>
                                        <tr>
                                            <th>CPerson</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_contact_person}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address1</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_address1}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address2</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_address2}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address3</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_address3}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin Code</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_pincode}}</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_country_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_state_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_city_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile No</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_mobile_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_email_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>PAN</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_pan}}</td>
                                        </tr>
                                        <tr>
                                            <th>GSTIN</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_gstin}}</td>
                                        </tr>
                                        <tr>
                                            <th>IEC</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_iec}}</td>
                                        </tr>
                                        <tr>
                                            <th>AadhaarNo</th>
                                            <th >:</th>
                                            <td>{{$packet->csr_aadharno}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="height-light">Consignee Details</th>
                                        </tr>
                                        <tr>
                                            <th>Consignee</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_consignor}}</td>
                                        </tr>
                                        <tr>
                                            <th>CPerson</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_contact_person}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address1</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_address1}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address2</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_address2}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address3</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_address3}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin Code</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_pincode}}</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <th >:</th>
                                            <td>{{ getCountries($packet->csn_country_id)}}</td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_state_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_city_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile No</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_mobile_no}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Email</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_email_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>TAN Number</th>
                                            <th >:</th>
                                            <td>{{$packet->csn_tan_number}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="height-light">Packet Details</th>
                                        </tr>
                                        <tr>
                                            <th>Packet Type</th>
                                            <th >:</th>
                                            <td>{{$packet->packet_type}}</td>
                                        </tr>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th >:</th>
                                            <td>{{$packet->invoice_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Packet Description</th>
                                            <th >:</th>
                                            <td>{{$packet->packet_description}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="height-light">Weight Details</th>
                                        </tr>
                                        <tr>
                                            <th>Package Weight</th>
                                            <th >:</th>
                                            <td>{{$packet->pcs_weight}}</td>
                                        </tr>
                                        <tr>
                                            <th>Chargeable Weight</th>
                                            <th >:</th>
                                            <td>{{$packet->chargeable_weight?$packet->chargeable_weight:$packet->actual_weight}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="height-light">Payment Details</th>
                                        </tr>
                                        <tr>
                                            <th>Payment Type</th>
                                            <th >:</th>
                                            <td>{{$packet->payment_type}}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Gateway</th>
                                            <th >:</th>
                                            <td>{{$packet->payment_gateway}}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <th >:</th>
                                            <td>{{$packet->payment_status}}</td>
                                        </tr>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th >:</th>
                                            <td>{{ checkKeyExists("transactionid",jsonToArrayConvert($packet->payment_response)) }}</td>
                                        </tr>
                                        <!-- <tr>
                                            <th>Total Value</th>
                                            <th >:</th>
                                            <td>{{$packet->total_weight}}</td>
                                        </tr> -->
                                        <tr>
                                            <th>Amount</th>
                                            <th >:</th>
                                            <td>${{$packet->shipping_charge}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="height-light">Remarks</th>
                                        </tr>
                                        <tr>
                                            <th>Operation Remarks</th>
                                            <th >:</th>
                                            <td>{{$packet->operation_remark}}</td>
                                        </tr>
                                        <tr>
                                            <th>Accounting Remarks</th>
                                            <th >:</th>
                                            <td>{{$packet->accounting_remark}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection