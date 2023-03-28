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
                                       <th>Packet Type</th>
                                       <th>Courier Type</th>
                                       <th>Receiver Name</th>
                                       <th>Receiver Email</th>
                                       <th>Payment Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @php($i=1)
                                    @foreach($shipments as $ship)
                                    <tr>
                                       <td>{{$i}}</td>
                                       <td></td>
                                       <td>{{$ship->created_at}}</td>
                                       <td>{{$ship->courier_type}}</td>
                                       <td>{{$ship->R_name}}</td>
                                       <td>{{$ship->R_email}}</td>
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
