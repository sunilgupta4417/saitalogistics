@extends('frontend.layouts.master')
@section('page_content')
<?php $shipmentType=Request::segment(4); ?>
<section id="where-from-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="where-from-design">
                    <h3 class="shipment-heading">Create New Air Freight Shipment</h3>
                    <p> With our global worldwide Associates offices and global network express service, we provide Air Import services to several destinations. We are able to offer on the economy services to reduce your freight cost with choice of reliable carriers and ensure your routine and shipping requirements to all major cities in the world on time collection and delivery. Our Company has a well-established communication system to monitor the movement of shipments from the time of departure until delivery at final destination.</p>
                    <form id="signUpForm" class="signUpForm" enctype='multipart/form-data'>
                        @csrf
                        <!-- start step indicators -->
                        <div class="form-header d-flex">
                            @include('frontend.dashboard.partials.step_indicators')
                        </div>
                        <!-- end step indicators -->
                        <div class="courier_type">
                            <input type="hidden" name="courier_type" value="air"/>
                        </div>
                        <!-- Step1 -->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    @include('frontend.dashboard.partials.origin_details')
                                </div>
                            </div>
                        </div>

                        <!-- Step2 -->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    @include('frontend.dashboard.partials.destination_details')
                                </div>
                            </div>
                        </div>

                        <!-- Step3 -->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    @include('frontend.dashboard.partials.shipment_mode')
                                </div>
                            </div>
                        </div>
                        
                        <!--  Step4 -->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    <div class="maining-heading">
                                        <h3 class="mb-4" style="margin-bottom: 8px !important;">Shipment details</h3>
                                        <p style="color:#000;">Do you know gross weight of your shipment ?</p>
                                    </div>
                                    <div class="where-boxing">
                                        <!-- <div class="form-group">
                                            <label>Mode</label>
                                            <select id="select-service" name="packet_type">
                                                <option value="export" selected>Export</option>
                                            </select>
                                        </div> -->
                                        <!-- <div class="form-group">
                                            <label>Gross Weight KG</label>
                                            <input type="number" name="pcs_weight" value="">
                                        </div> -->
                                        <!-- <div class="form-group">
                                            <label>Chargeable Weight KG</label>
                                            <input type="number" name="chargeable_weight" id="chargeableWeight" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Length CM</label>
                                            <input type="number" name="length"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Width CM</label>
                                            <input type="number" name="width"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Height CM</label>
                                            <input type="number" name="height"  value="">
                                        </div> -->
                                        <!-- <div class="form-group">
                                            <label>Declared Value $</label>
                                            <input type="number" name="dvalue"  value="">
                                        </div> -->
                                        <div class="form-group">
                                            <label>Number of Packages</label>
                                            <input type="number" name="no_of_package"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Attach Packing List</label>
                                            <input type="file" name="attach_package_list"  value="">  
                                        </div>
                                        <!--<div class="form-group">
                                            <button type="button" class="btn btn-main-2 track-shipment-clr" id="get-rates">Calcualte Chargeable Weight</button>
                                        </div>
                                        <input type="hidden" name="actual_weight" id="actual_weight">-->
                                    </div>
                                    <div class="step-image">
                                        <img src="{{asset('assets/images/step-img.png')}}" alt="" class="img-responsive">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step5 -->
                        <div class="step">
                            <div class="inter-form">
                                <div class="row">
                                    @include('frontend.dashboard.partials.review_details')
                                </div>
                            </div>
                        </div>

                        <!-- Step6 -->
                        <div class="step">
                            <div class="row">
                                <div class="inter-form">
                                    @include('frontend.dashboard.partials.shipment_success')
                                </div>
                            </div>
                        </div>
                        <!-- start previous / next buttons -->
                        <div class="form-footer">
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Back</button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)">Continue</button>
                        </div>
                        <!-- end previous / next buttons -->
                    </form>
                </div>
                <div class="modal fade" id="update_from_address_modal" role="dialog" >
                    @include('frontend.dashboard.partials.update_from_address')
                </div>
                <div class="modal fade" id="update_going_address_modal" role="dialog" >
                    @include('frontend.dashboard.partials.update_to_address')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('extra_body_scripts')
    @include('frontend.dashboard.partials.form_custom_js')
@endsection


