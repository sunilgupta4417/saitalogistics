@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Import Packet</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Operation Management</a></li>
                <li class="breadcrumb-item"><span> Import Packet</span></li>
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
                                     <p>1. Please Upload Only Excel File Of Format .xlsx.</p>
                                     <p>2. Below Given Fields and Excel Header Should Be Same</p>
                                     <p>3. Update <input type="checkbox" id="chkUpdate" name="chkUpdate" tabindex="1"> </p>
                                   </div>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                   <label>File Name*</label>
                                   <input type="file" class="form-control">
                                </div>
                           </div>
                         </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 
                              @if(checkAccess('import-packet','import_permission'))<button class="btn btn-primary mr-2" type="submit"><i class="fa fa-file-import"></i> Import</button>@endif
                                 <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-download"></i> Download Format</button>
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