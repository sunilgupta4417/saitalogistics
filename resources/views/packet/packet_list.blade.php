@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Packet Listing</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Operation Management</a></li>
                <li class="breadcrumb-item"><span> Packet Listing</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               <form action="{{route('packet.listing')}}" method="get" name="booking" id="booking">
                @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>
                                    <?php
                                    $courierType=Request::segment(2); 
                                    if(in_array($courierType,getCourierTypes())){
                                       if($courierType!="courier"){
                                          echo ucfirst($courierType)." Freight";
                                       }else{
                                          echo ucfirst($courierType);
                                       }
                                    } 
                                    ?> Packet Listing:</h3>
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
                                     <label>Reference No.*</label>
                                     <textarea type="text" name="awb_no" id="awb_no" class="form-control" placeholder="Accepts multiple Reference No. comma(,) seperated or enter seperated">{{ app('request')->input('awb_no') }}</textarea>
                                </div>
                                <?php /*<div class="form-group col-md-4 col-12">
                                     <label>Client*</label>
                                     <select class="form-control select" name="client_id" id="client_id">
                                        <option value="">---Select Client---</option>
                                        @foreach($client as $rowc)
                                        <option value="{{$rowc->id}}" <?php echo ($client_id==$rowc->id?'selected':'')?>>{{$rowc->client_name}}</option>
                                        @endforeach
                                     </select>
                                </div>*/?>
                                <div class="form-group col-md-4 col-12">
                                     <label>Consignor*</label>
                                     <input class="form-control" type="text" name="consignor" id="consignor" value="{{ app('request')->input('consignor') }}"  placeholder="Enter Consignor">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                     <label>Consignor Mobile*</label>
                                     <input class="form-control" type="number" value="{{ app('request')->input('csr_mobile') }}" name="csr_mobile" id="csr_mobile" placeholder="Enter Consignor Mobile">
                                </div>
                                <?php if(!in_array($courierType,getCourierTypes())){ ?>
                                    <div class="form-group col-md-5 col-12">
                                       <label>Courier Type*</label>
                                       <select class="form-control select" name="courier_type" id="courier_type">
                                          <option value="">---Select Courier Type---</option>
                                          <option value="air">Air Shipment</option>
                                          <option value="ocean">Ocean Shipment</option>
                                          <option value="courier">Courier Shipment</option>
                                       </select>
                                    </div>
                                 <?php } ?>
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('packet-booking','search_permission'))<button class="searchList btn btn-primary mr-2 " type="submit"><i class="fa fa-search"></i> Search</button>@endif
                              @if(checkAccess('packet-booking','import_permission'))<button class="searchExpo btn btn-primary mr-2 " type="submit"><i class="fa fa-expand"></i> Export</button>@endif
                              <a href="{{route('packet.listing')}}" class="btn btn-secondary btn-sm orng-btn"><i class="fa fa-dot-circle"></i> Reset</a>
                              </div>
                            </div>
                        </div>
                        <script>
                           $(document).ready(function() {
                              $(".searchList").click(function () {
                                 $('#booking').attr('method', "get")
                                 $('#booking').attr('action', "{{route('packet.listing')}}")
                              });
                              $(".searchExpo").click(function () {
                                 $('#booking').attr('method', "post")
                                 
                                 <?php if($courierType=="courier"){ ?>
                                    $('#booking').attr('action', "{{route('packet.listing.expo')}}")
                                 <?php }else{?>
                                    $('#booking').attr('action', "{{route('custom.packet.listing.expo',$courierType)}}")
                                 <?php } ?>
                              });
                           });
                        </script>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                             <div class="row">
                                <div class="col-md-10">
                                    <div class="frm-heading">
                                        <h3>Total Record(s) Found: {{$packetBook->total()}}</h3>
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
                                                     <th>Booking Date</th>
                                                     <th>Consignee</th>
                                                     <th>Reference No.</th>
                                                     <th>Courier Type</th>
                                                     <th>Consignor</th>
                                                     <th>Consignor Mobile</th>
                                                     <th>Packet Type</th>
                                                     <th>Payment Type</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                @foreach($packetBook as $row)
                                                 <tr>
                                                     <td><a class="btn btn-primary" href="{{route('packet.view',$row->id)}}"> <i class="fa fa-eye"></i></a></td>
                                                     <td>{{$row->booking_date}} </td>
                                                     <td>{{$row->csn_consignor}}</td>
                                                     <td>{{$row->awb_no}}</td>
                                                     <td>{{ucfirst($row->courier_type)}}</td>
                                                     <td>{{$row->csr_consignor}}</td>
                                                     <td>{{$row->csr_mobile_no}}</td>
                                                     <td>{{$row->packet_type}}</td>
                                                     <td>{{$row->payment_type?$row->payment_type:$row->payment_status}}</td>
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
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>

@endsection