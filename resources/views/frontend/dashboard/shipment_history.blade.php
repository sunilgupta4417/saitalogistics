@extends('frontend.layouts.master')
@section('page_content')
      <section class="section pricing" id="make-shipping">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-12">
                  <div class="heading text-center">
                     <h2 class="mb-3">Shipping History</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 col-lg-812">
                  <div class="shipment-history">
                        <div class="shipment-table table-responsive">
                              <table class="table custom-table datatable dataTable no-footer">
                                 <thead>
                                    <tr>
                                       <th>Sr. No.</th>
                                       <th>Reference No.</th>
                                       <th>Date</th>
                                       <th>Shipment Type</th>
                                       <th>From</th>
                                       <th>To</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php($i=1)
                                    @foreach($shipments as $ship)
                                    <tr>
                                       <td>{{$i}}</td>
                                       <td>{{$ship->reference_no}}</td>
                                       <td>{{ \Carbon\Carbon::parse($ship->created_at)->isoFormat('Do MMM YYYY') }}</td>
                                       <td>{{$ship->packet_type}}</td>
                                       <td>{{$ship->csr_city_id}}</td>
                                       <td>{{$ship->csn_city_id}}</td>
                                       <td class="og-clr">
                                          @if($ship->booking_status==1)
                                             <a href="{{ route('user.create.shipment.acceptance',encryptToBase64($ship->id)) }}" class="view-btn btn-primary btn btn-sm">{{ getBookingStatus($ship->booking_status) }}</a>
                                          @elseif($ship->booking_status==3)
                                             <a href="{{ route('user.create.shipment.payment',encryptToBase64($ship->id)) }}" class="view-btn btn-primary btn btn-sm">{{ getBookingStatus($ship->booking_status) }}</a>
                                          @else
                                             {{ ucwords(getBookingStatus($ship->booking_status)) }}
                                          @endif                                    
                                       </td> 
                                       <td class="view-btn"> 
                                          <a href="javascript:void(0);" class="clickMeForViewDetails">View Details</a>
                                          <div class="modal fade clickMeForViewBox" id="clickMeForViewDetails{{$i}}" role="dialog" >
                                             <div class="modal-dialog modal-lg vertical-align-center" style="margin-top: 80px;">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h4 class="modal-title">Shipment Details</h4>
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                   <div class="modal-body ">
                                                      <div class="row">
                                                         <div class="inter-form signUpForm">
                                                            <?php 
                                                               $shipData=$ship->toArray(); 
                                                               //mydd(array_keys($shipData));
                                                               $ignoreFields=array("id","uuid","awb_no","client_id","S_idFront","S_idBack","dpDate","invoice_no","packet_description","attach_package_list","currency","invoice_doc","created_by","booking_status","payment_response","cdrop","cpickup","quatation_email_date","deleted_at","created_at","updated_at"); 
                                                            ?>
                                                            @foreach($shipData as $keyVal=>$shipValue)
                                                               <?php 
                                                                  if(!in_array($keyVal,$ignoreFields) && !empty($shipValue)){
                                                                     $keyVal= str_replace("csr_","",$keyVal);
                                                                     $keyVal= str_replace("csn_","",$keyVal);
                                                                     $keyVal= str_replace("S_","",$keyVal);
                                                                     $keyVal= str_replace("R_","",$keyVal);
                                                               ?>
                                                                     <div class="row mt-4">{{ucwords(str_replace("_"," ",$keyVal))}} : {{$shipValue}}</div>
                                                               <?php } ?>
                                                            @endforeach
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    @php($i++)
                                     @endforeach
                                    
                                 </tbody>
                              </table>
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
@endsection
@section('extra_body_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>   
   $(document).ready(function(){
      $(".clickMeForViewDetails").on("click",function(e){
         var modelId=$(this).parent("td.view-btn").find(".clickMeForViewBox").attr('id');
         $('#'+modelId).modal('show');
      });
    });
</script>

@endsection