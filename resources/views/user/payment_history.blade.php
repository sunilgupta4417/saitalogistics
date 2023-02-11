@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Payment History Report</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Setting Management</a></li>
                <li class="breadcrumb-item"><span> Payment History Report</span></li>
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
                                   <h3>Payment History:</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-7 col-12">
                                   <div class="smalling-wdh">
                                      <label>Date From*</label>
                                     <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                     <input class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker">
                                   </div>
                                </div>
                                
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('payment-history','search_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-search"></i> Search</button>@endif
                              @if(checkAccess('payment-history','import_permission'))<button class="btn btn-primary mr-2" type="button"><i class="fa fa-expand"></i> Export</button>@endif
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
                                                @if(checkAccess('payment-history','edit_permission'))<th>Edit</th>@endif
                                                @if(checkAccess('payment-history','delete_permission'))<th>Delete</th>@endif
                                                    <th>Date From</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                            @if(checkAccess('payment-history','edit_permission'))<td><a class="btn btn-primary" href="#"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                            @if(checkAccess('payment-history','delete_permission'))<td><a class="btn btn-primary" href="#"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                                <td>12-1-2023 10:20 PM</td>
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