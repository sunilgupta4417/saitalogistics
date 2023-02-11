@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Zone Master</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Master Management</a></li>
                <li class="breadcrumb-item"><span> Zone Master</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               @include('message.error_validation')

               <form action="{{route('zone.master.save')}}" method="post" name="zone_frm" id="zone_frm">
                @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Zone Master</h3>
                                 </div>
                               </div>
                               <?php
                               $id =    isset($editZone->id) ? $editZone->id : 0;
                               $vendor_id =    isset($editZone->vendor_id) ? $editZone->vendor_id : 0;
                               $service_name = isset($editZone->service_name) ? $editZone->service_name : NULL;
                               $zone_name =    isset($editZone->zone_name) ? $editZone->zone_name : NULL;
                               $zone_type =    isset($editZone->zone_type) ? $editZone->zone_type : NULL;
                               $effctv_from =    isset($editZone->effctv_from) ? $editZone->effctv_from : NULL;
                               ?>
                                <div class="form-group col-md-4 col-12">
                                   <input type="hidden" value="{{$id}}" name="id" id="id" class="form-control">
                                   <label>Vendor*</label>
                                   <select name="vendor_id" id="vendor_id" required class="form-control select">
                                       <option value=""  disabled selected>Select</option>
                                       @foreach($vendorMaster as $row)
                                          <option value="{{$row->id}}" <?php echo ($vendor_id==$row->id?'selected':'')?>>{{$row->name}}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Service*</label>
                                   <input type="text" value="{{$service_name}}" required name="service_name" id="service_name" class="form-control" placeholder="Enter Service">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Zone Name*</label>
                                   <input type="text" name="zone_name" required value="{{$zone_name}}" id="zone_name" class="form-control" placeholder="Enter Zone Name">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Zone Type*</label>
                                   <select class="form-control select" required name="zone_type" id="zone_type">
                                        <option>--Select--</option>
                                        <option value="International" <?php echo ($zone_type=='International'?'selected' :'')?>>International</option>
                                        <option value="Domestic" <?php echo ($zone_type=='Domestic'?'selected' :'')?>>Domestic</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Effect From*</label>
                                     <input  name="effctv_from" required id="effctv_from" value="{{$effctv_from}}" class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                </div>

                           </div>

                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('zone-master','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>@endif
                              @if(checkAccess('zone-master','import_permission'))<a href="{{route('export.zone')}}" class="btn btn-primary mr-2 btn-sm" type="button"><i class="fa fa-expand"></i> Export</a>@endif
                                 <a href="{{route('zone.master')}}"  class="btn btn-secondary orng-btn btn-sm" type="reset"><i class="fa fa-dot-circle"></i> Reset</a>
                              </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                             <div class="row">
                                <div class="col-md-3">
                                    <div class="frm-heading">
                                        <h3>Total Zone (s) Found: {{$total}}</h3>
                                    </div>
                                </div>
                                {{--<div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>--}}
                                <div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="CM.CCode">Client Code</option>
                                            <option value="CM.CName">Client Name</option>
                                            <option value="CM.SalesPerson">Sales Person</option>
                                            <option value="CM.Address1">Address</option>
                                            <option value="CM.CityName">City Name</option>
                                            <option value="CM.ZipCode">Pin Code</option>
                                            <option value="CM.MobileNo">Mobile No</option>
                                            <option value="CM.GSTIN">GSTIN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="searching-fld">
                                        <select class="form-control select">
                                            <option value="1">Exactly</option>
                                            <option value="2">Contains</option>
                                            <option value="3">Start with</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">                
                                    <div class="search-container">
                                            <input type="text" placeholder="Search Here.." name="search">
                                            <button type="submit"><i class="fa fa-search"></i></button>
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
                                                @if(checkAccess('zone-master','edit_permission'))<th>Edit</th>@endif
                                                @if(checkAccess('zone-master','delete_permission'))<th>Delete</th>@endif
                                                    <th>Vendor</th>
                                                    <th>Service</th>
                                                    <th>Zone Name</th>
                                                    <th>Zone Type</th>
                                                    <th>Effect From</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($zoneMaster as $rowz)
                                                <tr>
                                                @if(checkAccess('zone-master','edit_permission'))<td><a class="btn btn-primary" href="{{route('zone.master')}}?id={{$rowz->id}}"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                                @if(checkAccess('zone-master','delete_permission'))<td><a class="btn btn-primary" href="{{route('zone.master.delete',$rowz->id)}}" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                                    <td>{{$rowz->name}}</td>
                                                    <td>{{$rowz->service_name}}</td>
                                                    <td>{{$rowz->zone_name}}</td>
                                                    <td><?php echo ($rowz->zone_type=='Domestic' ?'Domestic' :'International' );?></td>
                                                    <td>{{$rowz->effctv_from}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="mt-3 float-right">
                                            {{$zoneMaster->links()}}
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