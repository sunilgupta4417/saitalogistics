@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">POD Upload</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><span> POD Upload</span></li>
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
                                   <h3>Note:</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-12 col-12">
                                   <div class="note-clr">
                                     <p>1. Please upload file(s) only with extension jpg, jpeg, png, pdf.</p>
                                     <p>2. File name should be same as AWB No</p>
                                     <p>3. Maximum 10 File allowed</p>
                                     <p>3. File Size should be upto 500 KB.</p>
                                   </div>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                   <label>Choose File*</label>
                                   <input type="file" class="form-control">
                                </div>
                           </div>
                         </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 <button class="btn btn-primary mr-2" type="bu"><i class="fa fa-file-import"></i> Upload Files</button>
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