@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Delivered Report</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Reports Management</a></li>
                <li class="breadcrumb-item"><span> Delivered Report</span></li>
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
                                   <h3>Delivered Report:</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-7 col-12">
                                   <div class="smalling-wdh">
                                      <label>Booking Date*</label>
                                     <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                     <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                   </div>
                                </div>
                                <div class="form-group col-md-5 col-12">
                                     <label>AWB No*</label>
                                     <input class="form-control" type="text" placeholder="AWB No">
                                </div>
                                
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('delivered-report','add_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Submit</button>@endif
                              @if(checkAccess('delivered-report','search_permission'))<button class="btn btn-primary mr-2" type="button"><i class="fa fa-search"></i> Search</button>@endif
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
                                                @if(checkAccess('delivered-report','edit_permission'))<th>Edit</th>@endif
                                                @if(checkAccess('delivered-report','delete_permission'))<th>Delete</th>@endif
                                                    <th>Booking Date</th>
                                                    <th>Status</th>
                                                    <th>AWB No.</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                @if(checkAccess('delivered-report','edit_permission'))<td><a class="btn btn-primary" href="#"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                                @if(checkAccess('delivered-report','delete_permission'))<td><a class="btn btn-primary" href="#"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                                    <td>12-1-2023 10:20 PM</td>
                                                    <td>Done</td>
                                                    <td>ABCD123</td>
                                                </tr>
                                            </tbody>
                                        </table>
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