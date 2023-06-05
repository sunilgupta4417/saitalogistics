@extends('frontend.layouts.master')
@section('page_content')
<?php $shipmentType=Request::segment(4); ?>
<section id="where-from-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="where-from-design">
                    <h3 class="shipment-heading">Create New Ocean Freight Shipment</h3>
                    <p>We have the expertise in providing international shipping services from all major ports. We offer cost effective customized solutions for all kinds of cargo needs with no restriction in the size and weight of goods. Our exemplary service includes choosing the right carrier & equipment, door to door pick up, managing all shipping documents and advance tracking technology. </p> 
                    <p>As a leading player in this segment, we maintain good relations with regional and global carriers resulting in a wide range of options for you to choose from. </p>
                    <p>We provide flexible sailing schedule, shipment tracking, purchase order management and also space protection during period of high demand. Our experts make sure that the cargo is suitably packed for safe and damage free transfer. Customer satisfaction is our top priority and we ensure that by providing cost effective, timely, safe and hassle-free solutions. We are a one stop comprehensive logistics service provider for all your shipping needs with high service standards.</p>
                    <form id="signUpForm" class="signUpForm" enctype='multipart/form-data'>
                        @csrf
                        <!-- start step indicators -->
                        <div class="form-header d-flex">
                            @include('frontend.dashboard.partials.step_indicators')
                        </div>
                        <!-- end step indicators -->
                        <div class="courier_type">
                            <input type="hidden" name="courier_type" value="ocean"/>
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
                                        <h3 class="mb-4">Shipment details</h3>
                                    </div>
                                    <div class="where-boxing">
                                         <div class="form-group">
                                            <label>Container Type</label>
                                            <select id="select-service" name="container_type" required>
                                                <option value="20 FT">20 FT</option>
                                                <option value="40 HQ">40 HQ</option>
                                            </select>
                                        </div> 
                                        <div class="form-group">
                                            <label>Packet Mode</label>
                                            <select id="select-service" name="packet_type">
                                                <option value="export" selected>Export</option>
                                            </select>
                                        </div>
                                         <div class="form-group">
                                            <label>Container Weight</label>
                                            <input type="number" name="pcs_weight" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Commodity</label>
                                            <input type="text" name="commodity" id="commodity">
                                        </div>
                                         <div class="form-group">
                                            <label>Commodity Type </label>
                                            <select id="select-service" name="commodity_type">
                                                <option value="DG Cargo" selected>DG Cargo</option>
                                                <option value="Non-DG Cargo" >Non-DG Cargo</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Number of Packages</label>
                                            <input type="number" name="no_of_package"  value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Attach Packing List</label>
                                            <input type="file" name="attach_package_list"  value="">  
                                        </div>
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