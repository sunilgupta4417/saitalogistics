@extends('layouts.admin')

@section('content')

<div class="content container-fluid">
    <div class="page-header">
       <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <h5 class="text-uppercase mb-0 mt-0 page-title">Vendor Master</h5>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-12">
             <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#"> Master Management</a></li>
                <li class="breadcrumb-item"><span> Vendor Master</span></li>
             </ul>
          </div>
       </div>
    </div>
    <div class="page-content">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="card">
               @include('message.error_validation')
               <!--  -->
               <form action="{{route('vendor.master.save')}}" method="post" name="vendor_frm" id="vendor_frm">
                   <div class="card-body">
                     @csrf
                         <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Vendor Master</h3>
                                 </div>
                               </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Vendor Code*</label>
                                   <input type="text" name="vendor_code" id="vendor_code" required class="form-control" placeholder="Enter Vendor Code">
                                   <input type="hidden" name="vendor_id" id="vendor_id" value="0">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Pin Code*</label>
                                   <input type="text" name="pincode" id="pincode" required class="form-control" placeholder="Enter Pin Code">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Email ID*</label>
                                   <input type="email" name="email" id="email" required class="form-control" placeholder="Enter Email ID">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Vendor Name*</label>
                                   <input type="text" name="name" id="name" required class="form-control" placeholder="Enter Vendor Name">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>City*</label>
                                   <input type="text" name="city_id" id="city_id" required class="form-control" placeholder="Enter City Name">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Mobile No*</label>
                                   <input type="text" name="mobile_no" id="mobile_no" required class="form-control" placeholder="Enter Mobile No">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>Address1*</label>
                                   <input type="text" name="address1" id="address1" required class="form-control" placeholder="Enter Address1">
                                </div>
                                <div class="form-group col-md-3 col-12">
                                   <label>State*</label>
                                   <input type="text" name="state_id" id="state_id" required class="form-control" placeholder="Enter State">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                   <label>GSTIN*</label>
                                   <input type="text" name="gstin" id="gstin" required class="form-control" placeholder="Enter GSTIN">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                   <label>Address2*</label>
                                   <input type="text" name="address2" id="address2" required  class="form-control" placeholder="Enter Address2">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                   <label>Country*</label>
                                    <select class="form-control select" name="country_id" id="country_id" required >
                                       <option value="" readonly disable selected>--Select--</option>
                                       @foreach($country as $row)
                                          <option value="{{$row->id}}">{{$row->country_name}} - {{$row->country_code}}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-1 col-12 pr-0">
                                     <div class="all-chk">
                                         <label><input type="checkbox" name="isActive" id="isActive" value="1" checked=""> Active</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-2 col-12 pr-0">
                                     <div class="all-chk">
                                         <label><input type="checkbox" name="selfVendor" id="selfVendor" value="1"> Self Vendor</label>
                                     </div>
                                </div>
                                <div class="form-group col-md-3 col-12">
                                     <div class="all-chk">
                                         <label><input type="checkbox" name="third_party_tracking" id="third_party_tracking" value="1"> Third Party Tracking</label>
                                     </div>
                                </div>

                           </div>

                           <div class="row">
                               <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                 <div class="frm-heading">
                                   <h3>Vendor Service Type</h3>
                                 </div>
                               </div>

                                <div class="form-group col-md-2 col-12">
                                 <label>Forwarder*</label>
                                 <select class="form-control select" name="vendor[0][forwarder]">
                                    <option>--Select--</option>
                                    <option value="DHL">DHL</option>
                                    <option value="FEDEX">FEDEX</option>
                                    
                                    <!-- <option value="ARAMEX">ARAMEX</option>
                                    <option value="BLUEDART">BLUEDART</option>
                                    <option value="CRITICAL LOG">CRITICAL LOG</option>
                                    <option value="DELHIVERY">DELHIVERY</option>
                                    <option value="DELHIVERYB2B">DELHIVERYB2B</option>
                                    <option value="DPD">DPD</option>
                                    <option value="DTDC">DTDC</option>
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
                                <div class="form-group col-md-3 col-12">
                                 <label>Service Name*</label>
                                   <input type="text" class="form-control" name="vendor[0][service]" placeholder="Enter Service Name">
                                </div>
                                <div class="form-group col-md-2 col-12">
                                    <label>Packaging Group*</label>
                                    <select class="form-control select" name="vendor[0][packaging]">
                                          <option>--Select--</option>
                                          <option value="FEDEX">FEDEX</option>
                                          <!-- <option value="UPS">UPS</option> -->
                                    </select>
                                 </div>
                                 <div class="form-group col-md-2 col-12">
                                    <label>Mode*</label>
                                    <select class="form-control select" name="vendor[0][mode]">
                                          <option>--Select--</option>
                                          <option value="FEDEX">FEDEX</option>
                                          <!-- <option value="UPS">UPS</option> -->
                                    </select>
                                 </div>
                                <div class="form-group col-md-3 col-12 pl-0">
                                     <div class="all-chk" style="display:inline-block; margin-right: 10px;">
                                         <label><input type="checkbox" checked="" value="1" name="vendor[0][status]"> Active</label>
                                     </div>
                                     <div class="plusing-btn" style="display:inline-block;">
                                         <button class="btn btn-primary  btn-xs" tabindex="1" id="btnAddClientChargesDetails" type="button" title="Add Head">Add <i class="fa fa-plus-circle"></i>
                                         </button>
                                         <button class="btn btn-default btn-xs" tabindex="1" id="btnResetClientChargesDetails" type="button" title="Reset Head">Reset <i class="fa fa-spinner"></i>
                                         </button>
                                     </div>
                                </div>
                           </div>
                         </div>
                         <div id="dynamicAddFiled"> 

                         </div>
                         <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                           <div class="page-btns">
                              <div class="form-group text-center custom-mt-form-group">
                              @if(checkAccess('vendor-master','add_permission')) <button class="btn btn-primary mr-2" type="submit"><i class="fa fa-check"></i> Save</button>@endif
                              @if(checkAccess('vendor-master','edit_permission'))<a href="{{route('export.vendor.master')}}" class="btn btn-primary mr-2 btn btn-sm" type="button"><i class="fa fa-expand"></i> Export</a>@endif
                                 <button onclick="window.location.reload();" class="btn btn-secondary orng-btn" type="reset"><i class="fa fa-dot-circle"></i> Reset</button>
                              </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="bg-clr">
                             <div class="row">
                                 <div class="col-md-3">
                                       <div class="frm-heading">
                                       <h3>Total Record(s) Found: {{$totalVendor}}</h3>
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
                                          @if(checkAccess('vendor-master','edit_permission'))<th>Edit</th>@endif
                                          @if(checkAccess('vendor-master','delete_permission'))<th>Del</th>@endif
                                             <th>Vendor Code</th>
                                             <th>Vendor Name</th>
                                             <th>Address1</th>
                                             <th>Address2</th>
                                             <th>Pin Code</th>
                                             <th>City</th>
                                             <th>State</th>
                                             <th>Country</th>
                                             <th>Email ID</th>
                                             <th>Mobile No</th>
                                             <th>GSTIN</th>
                                             <th>SelfVendor</th>
                                             <th>Active</th>
                                             <th>ThirdPartyTracking</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($vendor as $row)
                                       <tr>
                                       @if(checkAccess('vendor-master','edit_permission'))<td><a class="btn btn-primary editData" data-value="{{$row->id}}" href="javascript:void(0);"> <i class="fa fa-pencil-alt"></i></a></td>@endif
                                       @if(checkAccess('vendor-master','delete_permission'))<td><a class="btn btn-primary" href="{{route('vendor.master.delete',$row->id)}}" onclick="return confirm('Are you sure you want to delete this record?')"> <i class="fa fa-trash-alt"></i></a></td>@endif
                                          <td>{{$row->vendor_code}}</td>
                                          <td>{{$row->name}}</td>
                                          <td>{{$row->address1}}</td>
                                          <td>{{$row->address2}}</td>
                                          <td>{{$row->pincode}}</td>
                                          <td>{{$row->city_id}}</td>
                                          <td>{{$row->state_id}}</td>
                                          <td>{{$row->country_name}}</td>
                                          <td>{{$row->email}}</td>
                                          <td>{{$row->mobile_no}}</td>
                                          <td>{{$row->gstin}}</td>
                                          <td>{{ ($row->selfVendor==1?'YES':'NO')}}</td>
                                          <td>{{ ($row->isActive==1?'Active':'Inactive')}}</td>
                                          <td>{{ ($row->third_party_tracking==1?'YES':'NO')}}</td>
                                          <td style="display: none;">{{$row->country_id}}</td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                 </table>
                                 <div class="mt-3 float-right">
                                 {{$vendor->links()}}
                                 </div>
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

@section('script')
<script>
   $( document ).ready(function() {
    var i = 1;
    $("#btnAddClientChargesDetails").on("click",function(){
      var addHml = GenrateHtml(i);
      $("#dynamicAddFiled").append(addHml);
      i++;
   });

   $("#btnResetClientChargesDetails").on("click",function(){
      $(".dynamic_add_filed").remove();
      i=1;
   });
   

   $("body").on("click",".deleteAdd",function(){
      var id = $(this).data('id');
      $("#dynamic_"+id).remove();
   });

   $("body").on("click",".dynamic_edit_delete",function(){
      var id = $(this).data('id');
      $("#dynamic_edit_"+id).remove();
   });

   $("body").on("click",".editData",function(){
      var id = $(this).data('value');
      $("#vendor_id").val(id);

      var code = $(this).closest("tr").find('td:eq(2)').text();
      $("#vendor_code").val(code);

      var pincode = $(this).closest("tr").find('td:eq(6)').text();
      $("#pincode").val(pincode);

      var email = $(this).closest("tr").find('td:eq(10)').text();
      $("#email").val(email);

      var name = $(this).closest("tr").find('td:eq(3)').text();
      $("#name").val(name);

      var city_id = $(this).closest("tr").find('td:eq(7)').text();
      $("#city_id").val(city_id);

      var mobile_no = $(this).closest("tr").find('td:eq(11)').text();
      $("#mobile_no").val(mobile_no);

      var address1 = $(this).closest("tr").find('td:eq(4)').text();
      $("#address1").val(address1);

      var state_id = $(this).closest("tr").find('td:eq(8)').text();
      $("#state_id").val(state_id);

      var gstin = $(this).closest("tr").find('td:eq(12)').text();
      $("#gstin").val(gstin);

      var address2 = $(this).closest("tr").find('td:eq(5)').text();
      $("#address2").val(address2);

      var country_id = $(this).closest("tr").find('td:eq(16)').text();
      $("#country_id").val(country_id).trigger('change');

      var isActive = $(this).closest("tr").find('td:eq(14)').text();
      if(isActive=='YES'){
         $('#isActive').prop('checked', true);
      }else{
         $('#isActive').prop('checked', false);
      }
      

      var selfVendor = $(this).closest("tr").find('td:eq(13)').text();
      if(selfVendor=='YES'){
         $('#selfVendor').prop('checked', true);
      }else{
         $('#selfVendor').prop('checked', false);
      }

      var third_party_tracking = $(this).closest("tr").find('td:eq(15)').text();
      if(third_party_tracking=='YES'){
         $('#third_party_tracking').prop('checked', true);
      }else{
         $('#third_party_tracking').prop('checked', false);
      }

      $.ajax({
        url: "{{ route('get-vendor-service') }}",
        dataType: "json",
        type: "Post",
        async: true,
        data: {"id":id},
        success: function (data) {
         var addHml = GenrateAjaxHtml(data);
         $("#dynamicAddFiled").html(addHml);
        },
      }); 
   });
   
});

function GenrateAjaxHtml(data){
   var html = "";
   var addval = "";
   $.each(data, function(index,value) {
      addval = "edit_"+ index;
      // console.log(addval);
      html+= '<div class="row col-md-12 dynamic_add_filed" id="dynamic_edit_'+index+'">'+
                  '<div class="form-group col-md-2 col-12">'+
                     '<label>Forwarder*</label>'+
                     '<input type="hidden" name="vendor['+addval+'][id]" value="'+value.id+'">'+
                     '<select class="form-control select" name="vendor['+addval+'][forwarder]">'+
                        '<option>--Select--</option>'+
                        '<option value="DHL" '+(value.forwarder=='DHL'?'selected':'')+'>DHL</option>'+
                        '<option value="FEDEX" '+(value.forwarder=='FEDEX'?'selected':'')+'>FEDEX</option>'+
                        // '<option value="ARAMEX" '+(value.forwarder=='ARAMEX'?'selected':'')+'>ARAMEX</option>'+
                        // '<option value="BLUEDART" '+(value.forwarder=='BLUEDART'?'selected':'')+'>BLUEDART</option>'+
                        // '<option value="CRITICAL LOG" '+(value.forwarder=='CRITICAL LOG'?'selected':'')+'>CRITICAL LOG</option>'+
                        // '<option value="DELHIVERY" '+(value.forwarder=='DELHIVERY'?'selected':'')+'>DELHIVERY</option>'+
                        // '<option value="DELHIVERYB2B" '+(value.forwarder=='DELHIVERYB2B'?'selected':'')+'>DELHIVERYB2B</option>'+
                        
                        // '<option value="DPD" '+(value.forwarder=='DPD'?'selected':'')+'>DPD</option>'+
                        // '<option value="DTDC" '+(value.forwarder=='DTDC'?'selected':'')+'>DTDC</option>'+
                        // '<option value="EKART" '+(value.forwarder=='EKART'?'selected':'')+'>EKART</option>'+
                        
                        // '<option value="LINEX" '+(value.forwarder=='LINEX'?'selected':'')+'>LINEX</option>'+
                        // '<option value="NIMBUSPOST" '+(value.forwarder=='NIMBUSPOST'?'selected':'')+'>NIMBUSPOST</option>'+
                        // '<option value="PROFESSIONAL" '+(value.forwarder=='PROFESSIONAL'?'selected':'')+'>PROFESSIONAL</option>'+
                        // '<option value="SELF" '+(value.forwarder=='SELF'?'selected':'')+'>SELF</option>'+
                        // '<option value="SKYNET" '+(value.forwarder=='SKYNET'?'selected':'')+'>SKYNET</option>'+
                        // '<option value="SPOTON" '+(value.forwarder=='SPOTON'?'selected':'')+'>SPOTON</option>'+
                        // '<option value="TNT" '+(value.forwarder=='TNT'?'selected':'')+'>TNT</option>'+
                        // '<option value="TRACKON" '+(value.forwarder=='TRACKON'?'selected':'')+'>TRACKON</option>'+
                        // '<option value="UPS" '+(value.forwarder=='UPS'?'selected':'')+'>UPS</option>'+
                        // '<option value="USPS" '+(value.forwarder=='USPS'?'selected':'')+'>USPS</option>'+
                        // '<option value="XPRESSBEES" '+(value.forwarder=='XPRESSBEES'?'selected':'')+'>XPRESSBEES</option>'+
                        // '<option value="YODEL" '+(value.forwarder=='YODEL'?'selected':'')+'>YODEL</option>'+
                     '</select>'+
                  '</div>'+
                  '<div class="form-group col-md-3 col-12">'+
                     '<label>Service Name*</label>'+
                     '<input type="text" class="form-control" value="'+value.service_name+'" name="vendor['+addval+'][service]" placeholder="Enter Service Name">'+
                  '</div>'+
                  '<div class="form-group col-md-2 col-12">'+
                     '<label>Packaging Group*</label>'+
                     '<select class="form-control select"  name="vendor['+addval+'][packaging]">'+
                        '<option>--Select--</option>'+
                        '<option value="FEDEX" '+(value.packagin_group=='FEDEX'?'selected':'')+'>FEDEX</option>'+
                        // '<option value="UPS" '+(value.packagin_group=='UPS'?'selected':'')+'>UPS</option>'+
                     '</select>'+
                  '</div>'+
                  '<div class="form-group col-md-2 col-12">'+
                     '<label>Mode*</label>'+
                     '<select class="form-control select" name="vendor['+addval+'][mode]">'+
                        '<option>--Select--</option>'+
                        '<option value="FEDEX" '+(value.mode=='FEDEX'?'selected':'')+'>FEDEX</option>'+
                        // '<option value="UPS" '+(value.mode=='UPS'?'selected':'')+'>UPS</option>'+
                     '</select>'+
                  '</div>'+
                  
                  '<div class="form-group col-md-3 col-12 pl-0">'+
                     '<div class="all-chk" style="display:inline-block; margin-right: 10px;">'+
                        '<label><input type="checkbox" checked="" value="1" name="vendor['+addval+'][active]"> Active</label>'+
                     '</div>'+
                     '<div class="plusing-btn" style="display:inline-block;">'+
                        '<button class="btn btn-danger dynamic_edit_delete btn-xs" tabindex="1" data-id="'+index+'" type="button" title="Delete Head">Delete<i class="fa fa-trash"></i>'+
                        '</button>'+
                     '</div>'+
                  '</div>'+
               '</div>';
   });

   return html;
}

function GenrateHtml(addval) { 
   return '<div class="row col-md-12 dynamic_add_filed" id="dynamic_'+addval+'">'+
      '<div class="form-group col-md-2 col-12">'+
      '<label>Forwarder*</label>'+
      '<select class="form-control select" name="vendor['+addval+'][forwarder]">'+
         '<option>--Select--</option>'+
         '<option value="DHL">DHL</option>'+
         '<option value="FEDEX">FEDEX</option>'+
         // '<option value="ARAMEX">ARAMEX</option>'+
         // '<option value="BLUEDART">BLUEDART</option>'+
         // '<option value="CRITICAL LOG">CRITICAL LOG</option>'+
         // '<option value="DELHIVERY">DELHIVERY</option>'+
         // '<option value="DELHIVERYB2B">DELHIVERYB2B</option>'+
         
         // '<option value="DPD">DPD</option>'+
         // '<option value="DTDC">DTDC</option>'+
         // '<option value="EKART">EKART</option>'+
         
         // '<option value="LINEX">LINEX</option>'+
         // '<option value="NIMBUSPOST">NIMBUSPOST</option>'+
         // '<option value="PROFESSIONAL">PROFESSIONAL</option>'+
         // '<option value="SELF">SELF</option>'+
         // '<option value="SKYNET">SKYNET</option>'+
         // '<option value="SPOTON">SPOTON</option>'+
         // '<option value="TNT">TNT</option>'+
         // '<option value="TRACKON">TRACKON</option>'+
         // '<option value="UPS">UPS</option>'+
         // '<option value="USPS">USPS</option>'+
         // '<option value="XPRESSBEES">XPRESSBEES</option>'+
         // '<option value="YODEL">YODEL</option>'+
         '</select>'+
         '</div>'+
         '<div class="form-group col-md-3 col-12">'+
            '<label>Service Name*</label>'+
            '<input type="text" class="form-control"  name="vendor['+addval+'][service]" placeholder="Enter Service Name">'+
            '</div>'+
            '<div class="form-group col-md-2 col-12">'+
               '<label>Packaging Group*</label>'+
               '<select class="form-control select"  name="vendor['+addval+'][packaging]">'+
                  '<option>--Select--</option>'+
                  '<option value="FEDEX">FEDEX</option>'+
                  // '<option value="UPS">UPS</option>'+
                  '</select>'+
                  '</div>'+
                  '<div class="form-group col-md-2 col-12">'+
                     '<label>Mode*</label>'+
                     '<select class="form-control select" name="vendor['+addval+'][mode]">'+
                        '<option>--Select--</option>'+
                        '<option value="FEDEX">FEDEX</option>'+
                        // '<option value="UPS">UPS</option>'+
                     '</select>'+
                  '</div>'+
                  '<div class="form-group col-md-3 col-12 pl-0">'+
                     '<div class="all-chk" style="display:inline-block; margin-right: 10px;">'+
                        '<label><input type="checkbox" checked="" value="1" name="vendor['+addval+'][active]"> Active</label>'+
                     '</div>'+
                     '<div class="plusing-btn" style="display:inline-block;">'+
                        '<button class="btn btn-danger deleteAdd btn-xs" tabindex="1" data-id="'+addval+'" type="button" title="Delete Head">Delete <i class="fa fa-trash"></i>'+
                        '</button>'+
                     '</div>'+
                  '</div>'+
               '</div>';
}
</script>
@endsection