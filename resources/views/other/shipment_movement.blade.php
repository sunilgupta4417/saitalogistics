@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Shipment Movement</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><span> Shipment Movement</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
             @include('message.error_validation')
                <form action="{{route('shipment.save')}}" method="post" id="shipment_frm" name="shipment_frm">
                @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Shipment Movement:</h3>
                                 </div>
                               </div>
                               <?php
                               $shipment_id  = isset($shipmentEdit->id) ? $shipmentEdit->id  :0;
                               $awb_id = isset($shipmentEdit->awb_id) ? $shipmentEdit->awb_id  :0;
                               $shipment_date = isset($shipmentEdit->shipment_date) ? date("d-m-Y",strtotime($shipmentEdit->shipment_date))  :NULL;
                               $shipment_time = isset($shipmentEdit->shipment_time) ? $shipmentEdit->shipment_time  :NULL;
                               $status = isset($shipmentEdit->status) ? $shipmentEdit->status  :NULL;
                               $location = isset($shipmentEdit->location) ? $shipmentEdit->location  :NULL;
                               $status_details = isset($shipmentEdit->status_details) ? $shipmentEdit->status_details  :NULL;
                               ?>
                                <div class="form-group col-md-6 col-12">
                                      <label>AwbNo*</label>
                                      <input type="hidden" name="shipment_id" id="shipment_id" value="{{$shipment_id}}" />
                                      <select class="form-control select" name="awb_id" id="awb_id" required>
                                      <option value="">Select</option>
                                      @foreach($packetbooking as $rowa)
                                        <option value="{{$rowa->id}}" <?php echo ($awb_id==$rowa->id?'selected':'')?>>{{$rowa->awb_no}}</option>
                                      @endforeach
                                      </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                      <label>Date*</label>
                                     <input name="shipment_date" value="{{$shipment_date}}" required id="shipment_date" class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                      <label>Time*</label>
                                     <input name="shipment_time" value="{{$shipment_time}}" required id="shipment_time" class="form-control" type="time" placeholder="eg.23:59">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Status*</label>
                                     <select class="form-control select" name="status" id="status" required>
                                        <option value="">--Select Status--</option>
                                        @foreach($reason as $row)
                                            <option value="{{$row->reason_text}}" <?php echo ($status==$row->reason_text?'selected':'') ?>>{{$row->reason_text}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Location*</label>
                                     <input class="form-control" value="{{$location}}" required name="location" id="location" type="text" placeholder="Enter Location">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Status Details*</label>
                                     <input class="form-control" value="{{$status_details}}" required name="status_details" id="status_details" type="text" placeholder="Enter Status Details">
                                </div>
                           </div>
                         </div>

                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('shipment-movement','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Submit</button>@endif
                                 <a href="{{route('shipment.movement')}}" class="btn btn-secondary orng-btn btn-sm"><i class="fa fa-dot-circle"></i> Reset</a>
                              </div>
                            </div>
                        </div>
                         
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                                 <div class="row">
                                 <div class="col-md-10">
                                    <div class="frm-heading">
                                        <h3>Total Record(s) Found: {{$shipment->total();}}</h3>
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
                                                 @if(checkAccess('shipment-movement','edit_permission'))<th>Edit</th>@endif
                                                 @if(checkAccess('shipment-movement','delete_permission')) <th>Delete</th>@endif
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
                                                @foreach($shipment as $row)
                                                 <tr>
                                                 @if(checkAccess('shipment-movement','edit_permission'))<td><a class="btn btn-primary" href="{{route('shipment.movement')}}?id={{$row->id}}"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                                 @if(checkAccess('shipment-movement','delete_permission'))<td><a class="btn btn-primary" href="{{route('shipment.delete',$row->id)}}" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                                     <td>{{$row->booking_date}}</td>
                                                     <td>{{$row->csn_consignor}}</td>
                                                     <td>{{$row->awb_no}}</td>
                                                     <td>{{$row->client_name}}</td>
                                                     <td>{{$row->status}}</td>
                                                     <td></td>
                                                     <td>{{$row->csn_city_id}}</td>
                                                     <td>{{$row->csr_consignor}}</td>
                                                     <td>RC1232</td>
                                                     <td>{{$row->csr_mobile_no}}</td>
                                                 </tr>
                                                 @endforeach
                                                 </tbody>                                                           
                                             </table>
                                             {{ $shipment->links()}}
                                     </div>
                                 </div>
                             </div>

                        </div>
                     </div>
                   </form></div>
               
             </div>
          </div>
       </div>
    </div>
@endsection