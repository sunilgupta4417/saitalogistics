@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Change Password</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> User Management</a></li>
                <li class="breadcrumb-item"><span>Change Password</span></li>
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
                                   <h3>Password Policy:</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-12 col-12">
                                   <div class="note-clr">
                                     <p>1. White spaces not allowed.</p>
                                     <p>2. Password must be 6 to 15 character(s).</p>
                                     <p>3. Password Must be combination of atleast one numeric and one upper case letter.</p>
                                     <p>4. New Password and Confirm password should be same.</p>
                                     <p>5. Old Password and New Password should be different.</p>
                                   </div>
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Old Password*</label>
                                   <input type="password" class="form-control" placeholder="Enter Old Password">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>New Password*</label>
                                   <input type="password" class="form-control" placeholder="Enter New Password">
                                </div>
                                <div class="form-group col-md-4 col-12">
                                   <label>Confirm Password*</label>
                                   <input type="password" class="form-control" placeholder="Enter Confirm Passwordd">
                                </div>
                           </div>
                         </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('change-password','add_permission'))<button class="btn btn-primary mr-2" type="button"><i class="fa fa-check"></i> Save</button>@endif
                                 <button class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
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