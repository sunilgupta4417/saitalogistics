@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Manifest Report</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><span> Manifest Report</span></li>
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
                                   <h3>Manifest Report:</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-7 col-12">
                                   <div class="smalling-wdh">
                                      <label>Manifest Date*</label>
                                     <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                     <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                   </div>
                                </div>
                                <div class="form-group col-md-5 col-12">
                                     <label>Manifest No*</label>
                                     <input class="form-control" type="text" placeholder="Manifest No">
                                </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Forwarder*</label>
                                     <select class="form-control select">
                                        <option>--Select Forwarder--</option>
                                        <option value="DHL">DHL</option>
                                        <option value="FEDEX">FEDEX</option>
                                        <!-- <option value="ARAMEX">ARAMEX</option>
                                        <option value="BLUEDART">BLUEDART</option>
                                        <option value="CRTCL">CRITICAL LOG</option>
                                        <option value="DELHIVERY">DELHIVERY</option>
                                        <option value="DELIVRYB2B">DELHIVERYB2B</option>
                                        
                                        <option value="DPD">DPD</option>
                                        <option value="DTDC">DTDC</option>
                                        <option value="ECSSPL">ECSSPL</option>
                                        <option value="EKART">EKART</option>
                                        
                                        <option value="LINEX">LINEX</option>
                                        <option value="NIMBUSPOST">NIMBUSPOST</option>
                                        <option value="PROF">PROFESSIONAL</option>
                                        <option value="SELF">SELF</option>
                                        <option value="SKYNET">SKYNET</option>
                                        <option value="SPOTON">SPOTON</option>
                                        <option value="TNT">TNT</option>
                                        <option value="TRACKON">TRACKON</option>
                                        <option value="UPS">UPS</option>
                                        <option value="USPS">USPS</option>
                                        <option value="XPRESSBEES">XPRESSBEES</option>
                                        <option value="YODEL">YODEL</option> -->
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Summarized</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox"> Detailed</label>
                                     </div>
                                </div>
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 <button class="btn btn-primary mr-2" type="button"><i class="fa fa-search"></i> Search</button>
                                 <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Submit</button>
                                 <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                              </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                             <div class="row">
                                <div class="col-md-10">
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
                                                             <th>Edit</th>
                                                             <th>Delete</th>
                                                             <th>Manifest Date</th>
                                                             <th>Manifest No</th>
                                                             <th>Forwarder</th>
                                                             <th>Status</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>
                                                     <tr>
                                                         <td><a class="btn btn-primary" href="#"> <i class="fa fa-pencil-alt"></i></a></td>
                                                         <td><a class="btn btn-primary" href="#"> <i class="fa fa-trash-alt"></i></a></td>
                                                         <td>12-1-2023 10:20 PM  </td>
                                                         <td>XYZ123S</td>
                                                         <td></td>
                                                         <td>Done</td>
                                                     </tr>
                                                     <tr>
                                                         <td><a class="btn btn-primary" href="#"> <i class="fa fa-pencil-alt"></i></a></td>
                                                         <td><a class="btn btn-primary" href="#"> <i class="fa fa-trash-alt"></i></a></td>
                                                         <td>12-1-2023 10:20 PM  </td>
                                                         <td>XYZ123S</td>
                                                         <td></td>
                                                         <td>Done</td>
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