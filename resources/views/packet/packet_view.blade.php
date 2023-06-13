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
                        <div class="shipmentStepsFlow">
                            <div class="process-wrap active-step{{($packet->booking_status+1)}}">
                                <div class="process-main">
                                    <div class="col-3 ">
                                        <div class="process-step-cont">
                                            <div class="process-step step-1"></div>
                                            <span class="process-label">Shipment Request</span>
                                            <?php /*<div class="process-dot-cont">
                                                <div class="process-dots ship-process-dot-1"></div>
                                                <div class="process-dots ship-process-dot-2"></div>
                                                <div class="process-dots ship-process-dot-3"></div>
                                                <div class="process-dots ship-process-dot-4"></div>
                                            </div>*/?>
                                        </div>
                                    </div>
                                    <div class="col-3 ">
                                        <div class="process-step-cont">
                                            <div class="process-step step-2"></div>
                                            <span class="process-label">Quotation Sended</span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="process-step-cont">
                                            <div class="process-step step-3"></div>
                                            <span class="process-label">Quotation Accepted</span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="process-step-cont">
                                            <div class="process-step step-4"></div>
                                            <span class="process-label">Space Arranged</span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="process-step-cont">
                                            <div class="process-step step-5"></div>
                                            <span class="process-label">Completed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <?php if(in_array($packet->courier_type,getCourierTypes()) && isset($packet->booking_status) && ($packet->booking_status!=4)){ ?>
                            <div class="paymentUpdateForm">
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#paymentUpdateForm">Update shipping rates</button>
                                <!-- Modal -->
                                <div id="paymentUpdateForm" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ ucfirst($packet->courier_type)}} Shipment</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('packet.update.shipping.charge')}}">
                                                    @csrf
                                                    @if($packet->no_of_package)
                                                        <p><strong>No Of Package: </strong>{{$packet->no_of_package}}</p>
                                                    @endif
                                                    <input type="hidden" class="form-control" name="id" value="{{$packet->id}}">
                                                    <div class="form-group">
                                                        <label>Weight(KG)*</label>
                                                        <input type="text" class="form-control" name="pcs_weight" value="{{$packet->pcs_weight}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Chargeable Weight(KG)*</label>
                                                        <input type="text" class="form-control" name="chargeable_weight" value="{{$packet->chargeable_weight}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Shipping Charge($)*</label>
                                                        <input type="text" class="form-control" name="shipping_charge" value="{{$packet->shipping_charge}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>FCA Charges($)</label>
                                                        <input type="text" class="form-control" name="fca_charge" value="{{$packet->fca_charge}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ex Work Charge($)</label>
                                                        <input type="text" class="form-control" name="ex_work_charge" value="{{$packet->ex_work_charge}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <?php /*<div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>*/?>
                                        </div>

                                    </div>
                                </div>
                                @if(!empty($packet->shipping_charge))
                                <?php //echo $packet->booking_status; exit;?>
                                    @if(($packet->booking_status==0) || ($packet->booking_status==1))
                                        <a href="{{ route('packet.send.shipment.quotation.email.to.customer',$packet->id)}}" class="btn btn-info btn-sm" title="Send {{ ($packet->booking_status!=0)?'again':'' }} quotation email to customer">Send {{ ($packet->booking_status!=0)?'again':'' }} quotation email to customer</a>
                                    @endif
                                    @if(!empty($packet->booking_status) && ($packet->booking_status==2))
                                        <a href="{{ route('packet.send.shipment.payment.email.to.customer',$packet->id)}}" class="btn btn-info btn-sm" title="Send Payment Email To Customer">Send Payment Email To Customer</a>
                                    @endif
                                @endif
                            </div> 
                        <?php } ?> 
                        <br>
                        <div class="x_content">     
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <?php /*<tr>
                                            <th>Ref No</th>
                                            <th>:</th>
                                            <td>{{$packet->reference_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Client</th>
                                            <th>:</th>
                                            <td>{{$packet->client_id}}</td>
                                        </tr>*/?>
                                        <tr>
                                            <th style="width:25%">Reference No</th>
                                            <th style="width:2%">:</th>
                                            <td>{{$packet->reference_no}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Booking Date</th>
                                            <th>:</th>
                                            <td>{{$packet->booking_date}}</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="height-light">Orgin Details</th>
                                        </tr>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_consignor}}</td>
                                        </tr>
                                        @if(!empty($packet->csr_consignor_person))
                                        <tr>
                                            <th>Contact Person Name</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_consignor_person }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th>Contact Number</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_contact_person_code?$packet->csr_contact_person_code:""}}-{{$packet->csr_contact_person}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address1</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_address1}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address2</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_address2}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address3</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_address3}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin Code</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_pincode}}</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <th>:</th>
                                            <td>{{getCountries($packet->csr_country_id)}}</td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_state_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_city_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>Alternate Number</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_mobile_code?$packet->csr_mobile_code:""}}-{{$packet->csr_mobile_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_email_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>PAN</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_pan}}</td>
                                        </tr>
                                        <tr>
                                            <th>GSTIN</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_gstin}}</td>
                                        </tr>
                                        <tr>
                                            <th>IEC</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_iec}}</td>
                                        </tr>
                                        @if(!empty($packet->csr_aadharno))
                                        <tr>
                                            <th>AadhaarNo</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_aadharno}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->csr_address1_type))
                                        <tr>
                                            <th>Address Type</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_address1_type}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->S_idProof))
                                        <tr>
                                            <th>KYC Document</th>
                                            <th>:</th>
                                            <td>{{$packet->S_idProof}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->S_idFront))
                                        <tr>
                                            <th>Front Side</th>
                                            <th>:</th>
                                            <td><img width="100" height="100" src="{{url(getLogisRefImagePath($packet->S_idFront))}}" alt="Image"/></td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->S_idBack))
                                        <tr>
                                            <th>Back Side</th>
                                            <th>:</th>
                                            <td><img width="100" height="100" src="{{url(getLogisRefImagePath($packet->S_idBack))}}" alt="Image"/></td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th colspan="3" class="height-light">Destination Details</th>
                                        </tr>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_consignor}}</td>
                                        </tr>
                                        @if(!empty($packet->csn_consignor_person))
                                        <tr>
                                            <th>Contact Person Name</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_consignor_person}}</td>
                                        </tr>
                                        @endif                                        
                                        <tr>
                                            <th>Contact Number</th>
                                            <th>:</th>
                                            <td>{{ $packet->csn_contact_person_code?$packet->csn_contact_person_code:""}}-{{$packet->csn_contact_person}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address1</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_address1}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address2</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_address2}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address3</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_address3}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin Code</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_pincode}}</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <th>:</th>
                                            <td>{{ getCountries($packet->csn_country_id)}}</td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_state_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_city_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>Alternate Number</th>
                                            <th>:</th>
                                            <td>{{$packet->csr_mobile_code?$packet->csr_mobile_code:""}}-{{$packet->csn_mobile_no}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Email</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_email_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>TAN Number</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_tan_number}}</td>
                                        </tr>
                                        @if(!empty($packet->csn_iec_number))
                                        <tr>
                                            <th>IEC (Import and Export Code)</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_iec_number}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->csn_bn_number))
                                        <tr>
                                            <th>Business Registration Number</th>
                                            <th>:</th>
                                            <td>{{$packet->csn_bn_number}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th colspan="3" class="height-light">Shipment Mode Details</th>
                                        </tr>
                                        @if(!empty($packet->cpickup))
                                        <tr>
                                            <th>CPickup</th>
                                            <th>:</th>
                                            <td>{{$packet->cpickup?"PICKUP":"DROPOFF"}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->booking_date))
                                        <tr>
                                            <th>Booking Date</th>
                                            <th>:</th>
                                            <td>{{ date("Y-m-d", strtotime($packet->booking_date)) }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th colspan="3" class="height-light">Packet Details</th>
                                        </tr>
                                        @if(!empty($packet->container_type))
                                        <tr>
                                            <th>Container Type</th>
                                            <th>:</th>
                                            <td>{{ $packet->container_type }}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->packet_type))
                                        <tr>
                                            <th>Packet Type</th>
                                            <th>:</th>
                                            <td>{{$packet->packet_type}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->pcs_weight))
                                        <tr>
                                            <th>Weight</th>
                                            <th>:</th>
                                            <td>{{ $packet->pcs_weight }}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->commodity))
                                        <tr>
                                            <th>Commodity</th>
                                            <th>:</th>
                                            <td>{{ $packet->commodity }}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->commodity_type))
                                        <tr>
                                            <th>Commodity Type</th>
                                            <th>:</th>
                                            <td>{{ $packet->commodity_type }}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->no_of_package))
                                        <tr>
                                            <th>Number of Packages</th>
                                            <th>:</th>
                                            <td>{{ $packet->no_of_package }}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->length))
                                        <tr>
                                            <th>Length</th>
                                            <th>:</th>
                                            <td>{{$packet->length}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->width))
                                        <tr>
                                            <th>Width</th>
                                            <th>:</th>
                                            <td>{{$packet->width}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->height))
                                        <tr>
                                            <th>Height</th>
                                            <th>:</th>
                                            <td>{{$packet->height}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->dvalue))
                                        <tr>
                                            <th>Declared Value $</th>
                                            <th>:</th>
                                            <td>{{$packet->dvalue}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->chargeable_weight))
                                        <tr>
                                            <th>Chargeable Weight</th>
                                            <th>:</th>
                                            <td>{{$packet->chargeable_weight?$packet->chargeable_weight:$packet->actual_weight}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->attach_package_list))
                                        <tr>
                                            <th>Attach Packing List</th>
                                            <th>:</th>
                                            <td>
                                                <?php 
                                                    $imagesExt=array("jpeg","jpg","png");
                                                    $extName = pathinfo($packet->attach_package_list, PATHINFO_EXTENSION);
                                                    if(in_array($extName,$imagesExt)){
                                                ?>
                                                        <img width="100" height="100" src="{{url(getLogisRefImagePath($packet->attach_package_list))}}" alt="Image"/>
                                                <?php }else{ ?>
                                                        <a href="{{url('logistics/reference_files/'.$packet->attach_package_list)}}" target="_blank">Download Document</a>
                                                <?php }?>
                                                
                                            </td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th colspan="3" class="height-light">Payment Details</th>
                                        </tr>
                                        @if(!empty($packet->shipping_charge))
                                        <tr>
                                            <th>Shipping Charges</th>
                                            <th>:</th>
                                            <td>USD {{$packet->shipping_charge?$packet->shipping_charge:""}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->fca_charge))
                                        <tr>
                                            <th>FCA Charges</th>
                                            <th>:</th>
                                            <td>USD {{$packet->fca_charge?$packet->fca_charge:""}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->ex_work_charge))
                                        <tr>
                                            <th>EX Work Charges</th>
                                            <th>:</th>
                                            <td>USD {{$packet->ex_work_charge?$packet->ex_work_charge:""}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->total_charges))
                                        <tr>
                                            <th>Total Charges</th>
                                            <th>:</th>
                                            <td>USD {{$packet->total_charges?$packet->total_charges:""}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->payment_type))
                                        <tr>
                                            <th>Payment Type</th>
                                            <th>:</th>
                                            <td>{{$packet->payment_type}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->payment_gateway))
                                        <tr>
                                            <th>Payment Gateway</th>
                                            <th>:</th>
                                            <td>{{$packet->payment_gateway}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->payment_status))
                                        <tr>
                                            <th>Payment Status</th>
                                            <th>:</th>
                                            <td>{{$packet->payment_status}}</td>
                                        </tr>
                                        @endif
                                        @if(!empty($packet->payment_response))
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>:</th>
                                            <td>{{ checkKeyExists("transactionid",jsonToArrayConvert($packet->payment_response)) }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th colspan="3" class="height-light">Remarks</th>
                                        </tr>
                                        <tr>
                                            <th>Operation Remarks</th>
                                            <th>:</th>
                                            <td>{{$packet->operation_remark}}</td>
                                        </tr>
                                        <tr>
                                            <th>Accounting Remarks</th>
                                            <th>:</th>
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