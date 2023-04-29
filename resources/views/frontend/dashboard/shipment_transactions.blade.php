@extends('frontend.layouts.master')
@section('page_content')
      <section class="section pricing" id="make-shipping">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-12">
                  <div class="heading text-center">
                     <h2 class="mb-3">Shipment Transactions</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 col-lg-812">
                  <div class="shipment-history">
                        <div class="shipment-table">
                              <table class="rwd-table">
                                 <thead>
                                    <tr>
                                       <th>Order ID</th>
                                       <th>Date</th>
                                       <th>Amount</th>
                                       <th>Gateway</th>
                                       <th>Tokens</th>
                                       <th>Status</th>
                                       <th>View</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php($i=1)
                                    @foreach($transactions as $transaction)
                                    <tr>
                                       <td>{{$i}}</td>
                                       <td>{{ \Carbon\Carbon::parse($transaction->created_at)->isoFormat('Do MMM YYYY') }}</td>
                                       <td>${{$transaction->shipping_charge}}</td>
                                       <td>{{$transaction->payment_gateway}}</td>
                                       <td class="og-clr">{{ucfirst($transaction->payment_status)}}</td>
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
                                                               $transactionData=$transaction->toArray();
                                                            ?>
                                                            @foreach($transactionData as $keyVal=>$transactionValue)
                                                            <div class="row mt-4">{{ucwords(str_replace("_"," ",$keyVal))}} : {{$transactionValue}}</div>
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
         console.log(modelId);
         $('#'+modelId).modal('show');
      });
    });
</script>

@endsection