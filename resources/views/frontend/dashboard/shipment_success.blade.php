@extends('frontend.layouts.master')
@section('page_content')
    <section id="where-from-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="where-from-design">
                        <h3 class="shipment-heading"></h3>
                        <!-- Step7 -->
                        <div class="step">
                          <div class="row">
                              <div class="inter-form">
                                  <div class="payment-successful">
                                      <img src="{{asset('assets/images/successful.svg')}}" alt="" class="img-responsive">
                                      <h3>Payment Successful</h3>
                                      <p>Your shipment has been successfully added Track with your order No <b>{{$shipments['id']}}</b></p>
                                  </div>
                                  <?php /*<div class="payment-btns">
                                      <a href="#" class="down-btn">Download Invoice</a>
                                      <a href="{{ url('user/shipment/history') }}" class="done-btn">Done</a>
                                  </div>*/?>
                              </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_body_scripts')

@endsection
