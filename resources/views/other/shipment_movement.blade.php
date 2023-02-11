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
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><span> Shipment Movement</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               <form>
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Shipment Movement:</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-6 col-12">
                                      <label>AwbNo*</label>
                                     <input class="form-control" type="text" placeholder="Enter AwbNo">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                      <label>Date*</label>
                                     <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                      <label>Time*</label>
                                     <input class="form-control" type="text" placeholder="eg.23:59">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Status*</label>
                                     <select class="form-control select">
                                        <option>--Select Status--</option>
                                        <option value="DELIVERED">DELIVERED</option>
                                        <option value="INTRANSIT">INTRANSIT</option>
                                        <option value="PICKED UP">PICKED UP</option>
                                        <option value="RTO">RTO</option>
                                        <option value="UN-DELIVERED">UN-DELIVERED</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Location*</label>
                                     <input class="form-control" type="text" placeholder="Enter Location">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Status Details*</label>
                                     <input class="form-control" type="text" placeholder="Enter Status Details">
                                </div>
                           </div>
                         </div>

                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('shipment-movement','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Submit</button>@endif
                                 <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                              </div>
                            </div>
                        </div>
                         
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                                 <div class="row">
                                 <div class="col-md-10">
                                    <div class="frm-heading">
                                        <h3>Total Record(s) Found: 39</h3>
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
                                                 <tr>
                                                 @if(checkAccess('shipment-movement','edit_permission'))<td><a class="btn btn-primary" href="#"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                                 @if(checkAccess('shipment-movement','delete_permission'))<td><a class="btn btn-primary" href="#"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                                     <td>12-1-2023 10:20 PM </td>
                                                     <td></td>
                                                     <td>ABCD123</td>
                                                     <td>Sunil</td>
                                                     <td>Pickup</td>
                                                     <td></td>
                                                     <td></td>
                                                     <td></td>
                                                     <td>RC1232</td>
                                                     <td>0123456789</td>
                                                 </tr>
                                                 
                                                 </tbody>                                                           
                                             </table>
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