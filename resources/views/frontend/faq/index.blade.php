@extends('frontend.layouts.master')
@section('page_content')
<section id="faq-page">
       <div class="container">
       <div class="row justify-content-center">
              <div class="col-lg-6">
              <div class="heading text-center service-heading-iner">
              <span class="text-color">Learn How To Get Started</span>
              <h2 class="mb-3">Frequently Asked Questions</h2>
              </div>
              </div>
       </div>
       <div class="row">
              <div class="col-md-12">
              <div class="wrapper">
              <div class="tab-wrapper">
              <ul class="tabs">
                     @php 
                     $i=1
                     @endphp
                     @foreach($cms as $row)
                     <li class="tab-link {{($i==1?'active':'')}} " data-tab="{{$i}}">{{$row->page_image}}</li>
                     @php $i++ @endphp
                     @endforeach
                     <!-- <li class="tab-link" data-tab="2">Shipping</li>
                     <li class="tab-link" data-tab="3">Payment</li>
                     <li class="tab-link" data-tab="4">Tracking</li> -->
              </ul>
              </div>
              <div class="content-wrapper">
                     @php $i=1 @endphp
                     @foreach($cms as $row)
                     <div id="tab-{{$i}}" class="tab-content {{($i==1?'active':'')}}">
                            <?php 
                                   $cmsDetail = DB::table('cms')->where('page_image',$row->page_image)->get();
                            ?>
                            @foreach($cmsDetail as $rowd)
                            <div class="accordion-iner">
                                   <h3>{{$rowd->page_title}}</h3>
                                   <p>{!!$rowd->page_content!!}</p>
                            </div>
                            @endforeach
                     </div>
                     @php $i++ @endphp
                     @endforeach
                     
              </div>
              </div>
              </div>
       </div>
       </div>
</section>
@endsection
