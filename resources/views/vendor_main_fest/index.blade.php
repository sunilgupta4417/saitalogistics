@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Manifest to Vendor</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Operation Management</a></li>
                <li class="breadcrumb-item"><span> Manifest to Vendor</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               <form action="{{ route('vendor-manifest-create') }}" method="post">
                  @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Manifest to Vendor:</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-12 col-12">
                                   <div class="smalling-wdh">
                                      <label>Booking Date*</label>
                                     <input name="booking_date" class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                   </div>
                                </div>
                                  <div class="form-group col-md-12 col-12">
                                     <div class="row">
                                        <div class="form-group col-md-8 col-12">
                                            <label>Manifest No*</label>
                                            <input disabled="" id="main_fast_no" name="no" placeholder="System Generated" type="text" class="form-control" aria-label="...">
                                         </div>
                                           <div class="form-group col-md-4 col-12">
                                              <span class="input-group-addon">
                                                 <label><input type="checkbox" name="is_update" id="otherCheckbox" aria-label="..."> Update</label>
                                              </span>
                                           </div>
                                     </div>
                                  </div>
                                <div class="form-group col-md-6 col-12">
                                     <label>Forwarder*</label>
                                     <select class="form-control select" name="forwarder">
                                       <option>--Select Forwarder--</option>
                                       <option value="DHL">DHL</option>
                                       <option value="FEDEX">FEDEX</option>
                                       <!-- <option value="ARAMEX">ARAMEX</option>
                                       <option value="BLUEDART">BLUEDART</option>
                                       <option value="CRITICAL LOG">CRITICAL LOG</option>
                                       <option value="DELHIVERY">DELHIVERY</option>
                                       <option value="DELHIVERYB2B">DELHIVERYB2B</option>
                                       <option value="DPD">DPD</option>
                                       <option value="DTDC">DTDC</option>
                                       <option value="ECSSPL">ECSSPL</option>
                                       <option value="EKART">EKART</option>
                                       <option value="LINEX">LINEX</option>
                                       <option value="NIMBUSPOST">NIMBUSPOST</option>
                                       <option value="PROFESSIONAL">PROFESSIONAL</option>
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
                                <div class="form-group col-md-6 col-12">
                                     <label>Manifest Date*</label>
                                     <input class="form-control datetimepicker-input datetimepicker" name="date" type="text" data-toggle="datetimepicker">
                                </div>
                                <div class="form-group col-md-12 col-12">
                                     <label>Manifest Remarks*</label>
                                     <textarea type="text" class="form-control" name="remark" placeholder="Enter Manifest Remarks"></textarea>
                                </div>
                           </div>
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>No Record Found...!!</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-12 col-12">
                                     <label>AwbNo*</label>
                                     <input type="text" name="awbno" class="form-control" placeholder="AwbNo">
                                </div>
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('vendor-manifest','search_permission'))<button class="btn btn-primary mr-2" type="button"><i class="fa fa-search"></i> Search</button>@endif
                              @if(checkAccess('vendor-manifest','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Submit</button>@endif
                                 <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
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