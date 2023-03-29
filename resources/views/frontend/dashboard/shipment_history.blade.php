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
                        <div class="shipment-table">
                              <table class="rwd-table">
                                 <thead>
                                    <tr>
                                       <th>Sr. No.</th>
                                       <th>Waybill No.</th>
                                       <th>Date</th>
                                       <th>Shipment Type</th>
                                       <th>Qty</th>
                                       <th>For</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php($i=1)
                                    @foreach($shipments as $ship)
                                    <tr>
                                       <td>{{$i}}</td>
                                       <td></td>
                                       <td>{{ \Carbon\Carbon::parse($ship->created_at)->isoFormat('Do MMM YYYY') }}</td>
                                       <td>{{$ship->packet_type}}</td>
                                       <td>Qty</td>
                                       <td>{{$ship->csn_city_id}}</td>
                                       <td class="og-clr">Pending</td>
                                       <td class="view-btn"> <a href="#">View Details</a></td>
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
