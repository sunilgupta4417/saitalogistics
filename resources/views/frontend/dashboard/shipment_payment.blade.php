@extends('frontend.layouts.master')
@section('page_content')
<?php $userData=auth()->user();?>


<section id="where-from-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="where-from-design" id="shipments-pg">
                    <h3 class="shipment-heading">Shipment Payment</h3>
                    @if(!empty($shipments))
                        <form id="signUpForm" class="signUpForm" enctype='multipart/form-data'>
                            @csrf
                            <div class="row">
                                <div class="inter-form">
                                    <div class="maining-heading table-responsive">
                                        <table class="table shipmentInformation">
                                            <thead>
                                                <tr>
                                                    <th>Origin Details</th>
                                                    <th>Destination Details</th>
                                                    <th>Shipment Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="33%">
                                                        @if(!empty($shipments['csr_consignor_person']))
                                                            <p><strong>Consignor Person: </strong> {{ $shipments['csr_consignor_person'] }}</p>
                                                        @endif
                                                        @if(!empty($shipments['csr_consignor']))
                                                            <p><strong>Consignor: </strong> {{ $shipments['csr_consignor'] }}</p>
                                                        @endif
                                                        @if(!empty($shipments['csr_contact_person_code']) || !empty($shipments['csr_contact_person']) )
                                                            <p><strong>Contant No: </strong> {{$shipments['csr_contact_person_code']}}-{{ $shipments['csr_contact_person'] }}</p>
                                                        @endif
                                                        @if($shipments['csr_country_id'])
                                                            <p><strong>Country: </strong> {{ getCountries($shipments['csr_country_id']) }}</p>
                                                        @endif
                                                        @if($shipments['csr_address1'])
                                                            <p><strong>Address: </strong> {{ $shipments['csr_address1'] }}, {{ $shipments['csr_address2'] }}, {{ $shipments['csr_address3'] }}, {{ $shipments['csr_city_id'] }}, {{ $shipments['csr_state_id'] }}, {{ getCountries($shipments['csr_country_id']) }}-{{ $shipments['csr_pincode'] }}</p>
                                                        @endif
                                                    </td>
                                                    <td width="33%">
                                                        @if(!empty($shipments['csn_consignor_person']))
                                                            <p><strong>Consignee Person: </strong> {{ $shipments['csn_consignor_person'] }}</p>
                                                        @endif
                                                        @if(!empty($shipments['csn_consignor']))
                                                            <p><strong>Consignee: </strong> {{ $shipments['csn_consignor'] }}</p>
                                                        @endif
                                                        @if(!empty($shipments['csn_contact_person_code']) || !empty($shipments['csn_contact_person']) )
                                                            <p><strong>Contant No: </strong> {{$shipments['csn_contact_person_code']}}-{{ $shipments['csn_contact_person'] }}</p>
                                                        @endif
                                                        @if($shipments['csn_country_id'])
                                                            <p><strong>Country: </strong> {{ getCountries($shipments['csn_country_id']) }}</p>
                                                        @endif
                                                        @if($shipments['csn_address1'])
                                                            <p><strong>Address: </strong> {{ $shipments['csn_address1'] }}, {{ $shipments['csn_address2'] }}, {{ $shipments['csn_address3'] }}, {{ $shipments['csn_city_id'] }}, {{ $shipments['csn_state_id'] }}, {{ getCountries($shipments['csn_country_id']) }}-{{ $shipments['csn_pincode'] }}</p>
                                                        @endif
                                                    </td>
                                                    <td width="33%">
                                                        @if(!empty($shipments['courier_type']))
                                                            <p><strong>Shipment Type: </strong> {{ ucfirst($shipments['courier_type']) }}</p>
                                                        @endif
                                                        @if(!empty($shipments['packet_type']))
                                                            <p><strong>Packet Type: </strong> {{ $shipments['packet_type'] }}</p>
                                                        @endif
                                                        @if(!empty($shipments['pcs_weight']) )
                                                            <p><strong>Initial Weight: </strong> {{$shipments['pcs_weight'] }}KG</p>
                                                        @endif
                                                        @if($shipments['chargeable_weight'])
                                                            <p><strong>Chargeable Weight: </strong> {{ $shipments['chargeable_weight'] }} KG</p>
                                                        @endif
                                                        @if($shipments['no_of_package'])
                                                            <p><strong>No Of Package: </strong>{{ $shipments['no_of_package'] }}</p>
                                                        @endif
                                                        @if($shipments['container_type'])
                                                            <p><strong>Container Type: </strong> {{ $shipments['container_type'] }}</p>
                                                        @endif
                                                        @if($shipments['commodity'])
                                                            <p><strong>Commodity: </strong> {{ $shipments['commodity'] }}</p>
                                                        @endif
                                                        @if($shipments['commodity_type'])
                                                            <p><strong>Commodity Type: </strong> {{ $shipments['commodity_type'] }}</p>
                                                        @endif
                                                        @if($shipments['length'])
                                                            <p><strong>Length: </strong> {{ $shipments['length'] }}</p>
                                                        @endif
                                                        @if($shipments['width'])
                                                            <p><strong>Width: </strong> {{ $shipments['width'] }}</p>
                                                        @endif
                                                        @if($shipments['height'])
                                                            <p><strong>Height: </strong> {{ $shipments['height'] }}</p>
                                                        @endif
                                                        @if($shipments['operation_remark'])
                                                            <p><strong>Operation Remark: </strong> {{ $shipments['operation_remark'] }}</p>
                                                        @endif
                                                        <?php 
                                                        /*@if($shipments['shipping_charge'])
                                                            <p><strong>Shipping Charges: </strong>USD {{ $shipments['shipping_charge'] }}</p>
                                                        @endif
                                                        @if($shipments['fca_charge'])
                                                            <p><strong>FCA Charges: </strong>USD {{ $shipments['fca_charge'] }}</p>
                                                        @endif
                                                        @if($shipments['ex_work_charge'])
                                                            <p><strong>Ex Work Charges: </strong>USD {{ $shipments['ex_work_charge'] }}</p>
                                                        @endif
                                                        @if($shipments['total_charges'])
                                                            <p><strong>Total Charges: </strong>USD {{ $shipments['total_charges'] }}</p>
                                                        @endif
                                                        */
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p></p>
                                    </div>
                                    <div class="payment-gateway">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="mb-4">How Would You Like To Pay?</h4>
                                                <div class="walletConnected">Please connect your wallet <button type="button" class="walletConnect">Connect</button></div>
                                            </div>  
                                            <div class="col-md-8">
                                                <div class="cryptoPayments">
                                                    <div class="form-group" id="eth-btn"> 
                                                        <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon1.png" alt="" class="img-responsive">
                                                        <label>ETH</label>
                                                        <input type="radio" name="payment_gateway" value="ETH" class="clickMeForPayInput" />
                                                    </div>
                                                    <div class="form-group" id="bnb-btn"> 
                                                        <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon2.png" alt="" class="img-responsive">
                                                        <label>BNB</label>
                                                        <input type="radio" name="payment_gateway" value="BNB" class="clickMeForPayInput" />
                                                    </div>
                                                    <?php /*<div class="form-group" id="usdtbep-btn">
                                                        <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon3.png" alt="" class="img-responsive">
                                                        <label>USDT (BEP 20)</label>
                                                        <input type="radio" name="payment_gateway" value="USDT_BEP_20" class="clickMeForPayInput" />  
                                                    </div>
                                                    <div class="form-group" id="usdterc-btn">
                                                        <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon4.png" alt="" class="img-responsive">
                                                        <label>USDT (ERC 20)</label>
                                                        <input type="radio" name="payment_gateway" value="USDT_ERC_20" class="clickMeForPayInput">
                                                    </div>
                                                    <div class="form-group" id="saitamaerc-btn">
                                                        <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon5.png" alt="" class="img-responsive">
                                                        <label>SAITAMA (ERC 20)</label>
                                                        <input type="radio" name="payment_gateway" value="SAITAMA_ERC_20" class="clickMeForPayInput">
                                                    </div>
                                                    <div class="form-group" id="mazi-btn">
                                                        <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon6.png" alt="" class="img-responsive">
                                                        <label>Mazimatic (Mazi BEP 20)</label>
                                                        <input type="radio" name="payment_gateway" value="MAZI_BEP_20" class="clickMeForPayInput">
                                                    </div>
                                                    <!--<div class="form-group" id="ht-token-btn">
                                                        <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon7.png" alt="" class="img-responsive">
                                                        <label>HT Token (TRC 20)</label>
                                                        <input type="radio" name="payment_gateway" value="HUOBITOKEN_TRC_20" class="clickMeForPayInput">
                                                    </div>-->
                                                    <!--<div class="form-group">
                                                        <label>Mazimatic (Mazi ERC 20)</label>
                                                        <input type="radio" name="payment_gateway" value="MAZI_ERC_20" class="clickMeForPayInput">
                                                    </div>-->*/?>
                                                    <div class="form-group" id="credit-crd-btn">
                                                        <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon8.png" alt="" class="img-responsive">
                                                        <label>Credit/Debit Card (Epay)</label>
                                                        <input type="radio" name="payment_gateway" value="epay" checked="checked" class="clickMeForPayInput" >  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="paymment-right-details">
                                                    <h3>Amount Payables Details</h3>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td><b>Particulars</b></td>
                                                                <td><b>Amount</b></td>
                                                            </tr>
                                                            @if($shipments['shipping_charge'])
                                                                <tr>
                                                                    <td>Shipping Charges</td>
                                                                    <td class="subtotal">USD {{ $shipments['shipping_charge'] }}</td>
                                                                </tr>
                                                            @endif
                                                            @if($shipments['fca_charge'])
                                                                <tr>
                                                                    <td>FCA Charges</td>
                                                                    <td class="fca_charge">USD {{ $shipments['fca_charge'] }}</td>
                                                                </tr>
                                                            @endif
                                                            @if($shipments['ex_work_charge'])
                                                                <tr>
                                                                    <td>Ex Work Charges</td>
                                                                    <td class="ex_work_charge">USD {{ $shipments['ex_work_charge'] }}</td>
                                                                </tr>
                                                            @endif
                                                            @if($shipments['total_charges'])
                                                                <tr>
                                                                    <td><b>Payable Amount</b></td>
                                                                    <td class="total_charges">USD {{ $shipments['total_charges'] }}</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="payment-details">
                                        <h3>Duties & Taxes</h3>
                                        <p>Duties and taxes are to be paid by the consignee as per the local duty structure.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                @if(!empty($shipments['total_charges']))
                                    <button type="button" class="clickMeForPay" data-orderid="{{ $shipments['id'] }}"  data-user_email="{{ $shipments['csr_email_id'] }}" data-customerid="{{ $shipments['client_id'] }}" data-total="{{ $shipments['total_charges'] }}">Pay Now</button>
                                @else
                                    <p>Please wait for payment, maybe your shipment is under maintenance. For more please contact on support.</p>
                                @endif
                            </div>
                        </form>
                    @else
                        <p>Sorry your link has beed expired</p>
                    @endif
                </div>
            </div>
        </div>
    </div> 
    <div class="paymentUpdateForm">
        <!-- Modal -->
        <div id="paymentUpdateForm" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Connect your wallet</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="pp-btns">
                        <button onclick="connectWC()" class="btn btn-info btn-sm"><img src="https://staging.saitalogistics.com/assets/images/wallet-connect.png" alt=""> Connect Wallet Connect</button>
                        <button onclick="connectMetamaskWC()" class="btn btn-info btn-sm"><img src="https://staging.saitalogistics.com/assets/images/wallet-metamask.png" alt=""> Connect Metamask</button>
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
    <script src="https://epay.me/sdk/v2/websdk.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@walletconnect/web3-provider@1.7.1/dist/umd/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <script src="{{ asset('assets/js/crypto-payment.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("input.clickMeForPayInput").on("click",function(e){
                var inputValue=$(this).val();
                if(cryptoPayments.indexOf(inputValue) != -1) {
                    if(!getWalletProvider()){
                        $('#paymentUpdateForm').modal('show');
                    }
                    //checkExtentions();
                }
            });
        });
        function paymentOptions(customerId,userEmail,orderID,orderAmount,orderCurrency,orderDescription){
            const options = {
                channelId: "WEB",
                merchantType: "ECOMMS",
                merchantId:"6447cf5a37cd07f8a9a59435",
                customerId:customerId,
                orderID:orderID,
                orderDescription:orderDescription,
                orderAmount:orderAmount,
                userEmail:userEmail,
                merchantLogo:"https://epay.me/assets/images/logo.png",
                showSavedCardFeature:true,
                showCancelButton: true,
                orderCurrency:orderCurrency,
                successHandler: async function(response) {
                    afterPaymentAction(response,true);             
                },
                failedHandler: async function(response) {
                    afterPaymentAction(response,false);
                },
            };    
            const epay=new Epay(options);
            epay.open(options);
        }
        function afterPaymentAction(response,type=true){
            setTimeout(() => {
                isLoader(true);
            }, 1000);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{route("user.store_shipment_payment")}}',
                data: {status:response.status, response:response.response,id:response.response.orderid},
                cache: false,
                dataType:'JSON',
                success: function (res) {
                    if((res.status=="ok") && (res.response.transt=="completed")){
                        $(".payment-successful b.successOrderNumber").html(res.response.orderid);
                        window.location.href="{{ route('user.shipment.payment.success',$encrypt_shipment_id) }}";
                    }else{

                    }
                    isLoader(false);
                },
                error: function (res) {
                    console.log(res);
                    isLoader(false);
                }
            });
        }
        $(document).ready(function(){
            $(".clickMeForPay").on("click",function(e){
                e.preventDefault();
                const customerId=$(this).attr("data-customerid");
                const userEmail=$(this).attr("data-user_email");
                const orderID=$(this).attr("data-orderid");
                const orderAmount=$(this).attr("data-total");
                const orderCurrency="USD";
                const orderDescription=customerId+','+userEmail+','+orderID+','+orderAmount+','+orderCurrency;
                var selectPaymentType=$('input.clickMeForPayInput:checked').val();
                if(selectPaymentType=="epay"){
                    paymentOptions(customerId,userEmail,orderID,orderAmount,orderCurrency,orderDescription);
                }else if(cryptoPayments.indexOf(selectPaymentType) != -1){
                    makePayment(orderAmount,orderID,"{{ route('user.store_shipment_payment') }}",selectPaymentType);
                }
            });
        });  
        $('.walletConnected button.walletConnect').on('click',function(){
            if(!getWalletProvider()){
                $('#paymentUpdateForm').modal('show');
            }
        });
        checkWalletConnection();
    </script>
@endsection