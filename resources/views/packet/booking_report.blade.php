@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Booking Report</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Reports Management</a></li>
                <li class="breadcrumb-item"><span> Booking Report</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               
                   <div class="card-body">
                   <form action="{{route('booking.report')}}" method="get" name="booking" id="booking">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Booking Report:</h3>
                                 </div>
                               </div>
                               @php
                               $client_id = app('request')->input('client_id');
                               $vendor_id = app('request')->input('vendor');
                               @endphp
                                <div class="form-group col-md-7 col-12">
                                   <div class="smalling-wdh">
                                      <label>Booking Date*</label>
                                     <input name="startdate" value="{{ app('request')->input('startdate') }}"  class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                     <input name="enddate"  value="{{ app('request')->input('enddate') }}" class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                   </div>
                                </div>
                                <div class="form-group col-md-5 col-12">
                                     <label>Consignee*</label>
                                     <input class="form-control" value="{{ app('request')->input('consignee') }}" name="consignee" id="consignee" type="text" placeholder="Enter Consignee">
                                </div>
                                <div class="form-group col-md-12 col-12">
                                     <label>AWB No.*</label>
                                     <textarea type="text" name="awb_no" id="awb_no" class="form-control" placeholder="Accepts multiple AWB No. comma(,) seperated or enter seperated">{{ app('request')->input('awb_no') }}</textarea>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Client*</label>
                                     <select class="form-control select" name="client_id" id="client_id">
                                        <option value="">---Select Client---</option>
                                        @foreach($client as $rowc)
                                        <option value="{{$rowc->id}}" <?php echo ($client_id==$rowc->id?'selected':'')?>>{{$rowc->client_name}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Status*</label>
                                     <select class="form-control select" name="booking_status" id="booking_status">
                                        <option value="">--Select Status--</option>
                                        <option value="INTRANSIT">INTRANSIT</option>
                                        <option value="DELIVERED">DELIVERED</option>
                                        <option value="UN-DELIVERED">UN-DELIVERED</option>
                                        <option value="RTO">RTO</option>
                                        <option value="PICKED UP">PICKED UP</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                     <label>Vendor*</label>
                                     <select class="form-control select" type="text" name="vendor" id="vendor">
                                        <option value="">---Select Vendor---</option>
                                        @foreach($vendor as $rowv)
                                            <option value="{{$rowv->id}}" {{($vendor_id==$rowv->id?'selected':'')}}>{{$rowv->name}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                     <label>Destination*</label>
                                     <input class="form-control"  value="{{ app('request')->input('destination') }}" type="text" name="destination" id="destination" placeholder="Enter Destination">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox" name="isCancel" id="isCancel"> Is Cancel</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                     <label>Consignor*</label>
                                     <input class="form-control" type="text" name="consignor" id="consignor" value="{{ app('request')->input('consignor') }}"  placeholder="Enter Consignor">
                                </div>
                                <div class="form-group col-md-5 col-12">
                                     <label>Forwarding No.*</label>
                                     <input class="form-control" type="text" name="forwarding_no" id="forwarding_no" value="{{ app('request')->input('forwarding_no') }}" placeholder="Enter Forwarding No.">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox" name="pod_upload" id="pod_upload"> POD Upload</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-5 col-12">
                                     <label>Consignor Mobile*</label>
                                     <input class="form-control" type="text" value="{{ app('request')->input('csr_mobile') }}" name="csr_mobile" id="csr_mobile" placeholder="Enter Consignor Mobile">
                                </div>
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('booking-report','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Submit</button>@endif
                              @if(checkAccess('booking-report','search_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-expand"></i> Search</button>@endif
                              <a href="{{route('booking.report')}}" class="btn btn-secondary btn-sm orng-btn"><i class="fa fa-dot-circle"></i> Reset</a>
                              </div>
                            </div>
                        </div>
                        </form>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                             <div class="row">
                                <div class="col-md-10">
                                    <div class="frm-heading">
                                        <h3>Total Record(s) Found: {{$packetBook->total()}}</h3>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             </div>

                             <div class="col-md-12">    
                                 <div class="x_content">
                                     <div class="table-responsive">
                                         <table>
                                             <thead>
                                                 <tr>
                                                     <th>View</th>
                                                     <th>Print</th>
                                                     <th>Booking Date</th>
                                                     <th>Consignee</th>
                                                     <th>AWB No.</th>
                                                     <th>Client</th>
                                                     <th>Status</th>
                                                     <th>Vendor</th>
                                                     <th>Destination</th>
                                                     <th>Consignor</th>
                                                     <th>Forwarding No.</th>
                                                     <th>Consignor Mobile</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                @foreach($packetBook as $row)
                                                 <tr>
                                                    <td><a class="btn btn-primary" href="{{route('packet.view',$row->id)}}"> <i class="fa fa-eye"></i></a></td>
                                                    <td><form action="{{route('print.awb.doc.pdf')}}" method="post" target="_blank">
                                                        @csrf
                                                            <input type="hidden" class="form-control" value="{{$row->awb_no}}" name="awb_no" placeholder="Awb No">
                                                            <input type="hidden" class="form-control" value="invoice" name="print_type" id="print_type">
                                                            <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i></button></form>
                                                        </td>
                                                     <td>{{$row->booking_date}} </td>
                                                     <td>{{$row->csn_consignor}}</td>
                                                     <td>{{$row->awb_no}}</td>
                                                     <td>{{$row->client_name}}</td>
                                                     <td>Pending</td>
                                                     <td>Vendor ??</td>
                                                     <td>{{$row->csn_city_id}}</td>
                                                     <td>{{$row->csr_consignor}}</td>
                                                     <td>RC1232??</td>
                                                     <td>{{$row->csr_mobile_no}}</td>
                                                 </tr> 
                                                 @endforeach
                                                 </tbody>                                                           
                                             </table>
                                             <div class="float-right mt-3">
                                             {{$packetBook->appends($_GET)->links()}}
                                            </div>
                                     </div>
                                 </div>
                             </div>

                        </div>
                     </div>
                   </div>
               
             </div>
          </div>
       </div>
    </div>
@endsection