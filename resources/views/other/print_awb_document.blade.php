@extends('layouts.admin')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Print AWB Document</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Operation Management</a></li>
                <li class="breadcrumb-item"><span> Print AWB Document</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               <form action="{{route('print.awb.doc.pdf')}}" method="post" target="_blank">
                 @csrf
                   <div class="card-body">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Print AWB Document:</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-12 col-12">
                                   <label>Awb No.*</label>
                                   <input type="text" class="form-control" required name="awb_no" placeholder="Awb No">
                                   <input type="hidden" class="form-control" name="print_type" id="print_type">
                                </div>
                           </div>
                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                                 <button class="btn btn-primary mr-2 getVal" value="invoice" type="submit"><i class="fa fa-print"></i> Invoice Print</button>
                                 <button class="btn btn-primary mr-2 btn-sm orng-btn getlabel" value="label" type="submit"><i class="fa fa-print"></i> Label Print</button>
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
    <script>
$(document).ready(function() {
   $(".getVal").click(function () {
      $('#print_type').val($('.getVal').val());
    });
    $(".getlabel").click(function () {
      $('#print_type').val($('.getlabel').val());
    });
    
}); 

    </script>
@endsection