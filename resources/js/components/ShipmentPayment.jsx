import React, { useState, useEffect } from 'react';
import { createRoot } from "react-dom/client";
import axios from 'axios';

function ShipmentPayment() {
    const [shipment, setShipment] = useState([]);
    useEffect(() => {
        const baseUrl = window.location.protocol + '//' + window.location.host;
        const uriSegments = window.location.pathname.split('/');
        const shipment_id = uriSegments[uriSegments.length - 1];
        // Fetch user data from the API
        const endpoint=baseUrl+"/user/shipment/payments/"+shipment_id;
        axios.get(endpoint)
        .then(response => {
            // Update the state with the fetched data
            setShipment(response.data.shipments);
        })
        .catch(error => {
            console.error(error);
        });
    }, []);
    return (
        <div className="col-md-12">
            <div className="where-from-design signUpForm" id="shipments-pg">
                <h3 className="shipment-heading">Shipment Payment</h3>
                <div className="row">
                    <div className="inter-form">
                        <div className="maining-heading table-responsive">
                            <table className="table shipmentInformation">
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
                                            {shipment.csr_consignor_person ? (
                                                <p><strong>Consignor Person: </strong>{shipment.csr_consignor_person}</p>
                                            ) : ('')}
                                            {shipment.csr_consignor ? (
                                                <p><strong>Consignor: </strong> {shipment.csr_consignor}</p>
                                            ) : ('')}
                                            {shipment.csr_contact_person ? (
                                                <p><strong>Contant No: </strong> {shipment.csr_contact_person_code} {shipment.csr_contact_person}</p>
                                            ) : ('')}
                                            {shipment.csr_country_id ? (
                                                <p><strong>Country: </strong>{shipment.csr_country_id}</p>
                                            ) : ('')}
                                            {shipment.csr_address1 ? (
                                                <p><strong>Address: </strong> {shipment.csr_address1 }, {shipment.csr_address2}, {shipment.csr_address3}, {shipment.csr_city_id}, {shipment.csr_state_id},{shipment.csr_country_id }-{shipment.csr_pincode}</p>
                                            ) : ('')}                                            
                                        </td>
                                        <td width="33%"> 
                                            {shipment.csn_consignor_person ? (
                                                <p><strong>Consignee Person: </strong> {shipment.csn_consignor_person}</p>
                                            ) : ('')}
                                            {shipment.csn_consignor ? (
                                                <p><strong>Consignee: </strong> {shipment.csn_consignor}</p>
                                            ) : ('')}
                                            {shipment.csn_contact_person ? (
                                                <p><strong>Contant No: </strong> {shipment.csn_contact_person_code }-{shipment.csn_contact_person}</p>
                                            ) : ('')}
                                            {shipment.csn_country_id ? (
                                                <p><strong>Country: </strong> {shipment.csn_country_id}</p>
                                            ) : ('')}
                                            {shipment.csn_address1 ? (
                                                <p><strong>Address: </strong> {shipment.csn_address1}, {shipment.csn_address2}, {shipment.csn_address3}, {shipment.csn_city_id}, {shipment.csn_state_id}, {shipment.csn_country_id}-{shipment.csn_pincode}</p>
                                            ) : ('')} 
                                        </td>
                                        <td width="33%"> 
                                            {shipment.courier_type ? (
                                                <p><strong>Shipment Type: </strong> {shipment.courier_type}</p>
                                            ) : ('')} 
                                            {shipment.packet_type ? (
                                                <p><strong>Packet Type: </strong> {shipment.packet_type}</p>
                                            ) : ('')} 
                                            {shipment.pcs_weight ? (
                                                <p><strong>Initial Weight: </strong>{shipment.pcs_weight}KG</p>
                                            ) : ('')} 
                                            {shipment.chargeable_weight ? (
                                                <p><strong>Chargeable Weight: </strong> {shipment.chargeable_weight} KG</p>
                                            ) : ('')} 
                                            {shipment.no_of_package ? (
                                                <p><strong>No Of Package: </strong>{shipment.no_of_package}</p>
                                            ) : ('')} 
                                            {shipment.container_type ? (
                                                <p><strong>Container Type: </strong> {shipment.container_type}</p>
                                            ) : ('')} 
                                            {shipment.commodity ? (
                                                <p><strong>Commodity: </strong> {shipment.commodity}</p>
                                            ) : ('')}
                                            {shipment.commodity_type ? (
                                                <p><strong>Commodity Type: </strong> {shipment.commodity_type}</p>
                                            ) : ('')}
                                            {shipment.length ? (
                                                <p><strong>Length: </strong> {shipment.length}</p>
                                            ) : ('')}
                                            {shipment.width ? (
                                                <p><strong>Width: </strong> {shipment.width}</p>
                                            ) : ('')}
                                            {shipment.height ? (
                                                <p><strong>Height: </strong> {shipment.height}</p>
                                            ) : ('')}
                                            {shipment.operation_remark ? (
                                                <p><strong>Operation Remark: </strong> {shipment.operation_remark}</p>
                                            ) : ('')}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div className="payment-gateway">
                            <div className="row">
                                <div className="col-md-12">
                                    <h4 className="mb-4">How Would You Like To Pay?</h4>
                                    <div className="walletConnected">Please connect your wallet <button type="button" className="walletConnect">Connect</button></div>
                                </div>  
                                <div className="col-md-8">
                                    <div className="cryptoPayments">
                                        <div className="form-group" id="eth-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon1.png" alt="" className="img-responsive" />
                                            <label>ETH</label>
                                            <input type="radio" name="payment_gateway" value="ETH" className="clickMeForPayInput" />
                                        </div>
                                        <div className="form-group" id="bnb-btn"> 
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon2.png" alt="" className="img-responsive" />
                                            <label>BNB</label>
                                            <input type="radio" name="payment_gateway" value="BNB" className="clickMeForPayInput" />
                                        </div>
                                        <div className="form-group" id="usdtbep-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon3.png" alt="" className="img-responsive" />
                                            <label>USDT (BEP 20)</label>
                                            <input type="radio" name="payment_gateway" value="USDT_BEP_20" className="clickMeForPayInput" />  
                                        </div>
                                        <div className="form-group" id="usdterc-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon4.png" alt="" className="img-responsive" />
                                            <label>USDT (ERC 20)</label>
                                            <input type="radio" name="payment_gateway" value="USDT_ERC_20" className="clickMeForPayInput" />
                                        </div>
                                        <div className="form-group" id="saitamaerc-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon5.png" alt="" className="img-responsive" />
                                            <label>SAITAMA (ERC 20)</label>
                                            <input type="radio" name="payment_gateway" value="SAITAMA_ERC_20" className="clickMeForPayInput" />
                                        </div>
                                        <div className="form-group" id="mazi-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon6.png" alt="" className="img-responsive" />
                                            <label>Mazimatic (Mazi BEP 20)</label>
                                            <input type="radio" name="payment_gateway" value="MAZI_BEP_20" className="clickMeForPayInput" />
                                        </div>
                                        <div className="form-group" id="ht-token-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon7.png" alt="" className="img-responsive" />
                                            <label>HT Token (TRC 20)</label>
                                            <input type="radio" name="payment_gateway" value="HUOBITOKEN_TRC_20" className="clickMeForPayInput" />
                                        </div>
                                        <div className="form-group">
                                            <label>Mazimatic (Mazi ERC 20)</label>
                                            <input type="radio" name="payment_gateway" value="MAZI_ERC_20" className="clickMeForPayInput" />
                                        </div>
                                        <div className="form-group" id="credit-crd-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon8.png" alt="" className="img-responsive" />
                                            <label>Credit/Debit Card (Epay)</label>
                                            <input type="radio" name="payment_gateway" value="epay" checked="checked" className="clickMeForPayInput" />  
                                        </div>
                                    </div>
                                </div>
                                <div className="col-md-4">
                                    <div className="paymment-right-details">
                                        <h3>Amount Payables Details</h3>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td><b>Particulars</b></td>
                                                    <td><b>Amount</b></td>
                                                </tr>
                                                {shipment.shipping_charge ? (
                                                    <tr>
                                                        <td>Shipping Charges</td>
                                                        <td className="subtotal">USD {shipment.shipping_charge}</td>
                                                    </tr>
                                                ) : ('')}
                                                {shipment.fca_charge ? (
                                                    <tr>
                                                        <td>FCA Charges</td>
                                                        <td className="fca_charge">USD {shipment.fca_charge}</td>
                                                    </tr>
                                                ) : ('')}
                                                {shipment.ex_work_charge ? (
                                                    <tr>
                                                        <td>Ex Work Charges</td>
                                                        <td className="ex_work_charge">USD {shipment.ex_work_charge}</td>
                                                    </tr>
                                                ) : ('')}
                                                {shipment.total_charges ? (
                                                    <tr>
                                                        <td><b>Payable Amount</b></td>
                                                        <td className="total_charges">USD {shipment.total_charges}</td>
                                                    </tr>
                                                ) : ('')} 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div className="payment-details">
                            <h3>Duties & Taxes</h3>
                            <p>Duties and taxes are to be paid by the consignee as per the local duty structure.</p>
                        </div>
                    </div>
                </div>
                <div className="form-footer">
                    {shipment.total_charges ? (
                        <button type="button" className="clickMeForPay" data-orderid={shipment.id}  data-user_email={shipment.csr_email_id} data-customerid={shipment.client_id} data-total={shipment.total_charges}>Pay Now</button>
                    ) : ('')}
                </div>
            </div>
        </div>
    );
}

export default ShipmentPayment;

if (document.getElementById('root')) {
    const rootElement = document.getElementById("root");
    const root = createRoot(rootElement);
    root.render(
    <React.StrictMode>
        <ShipmentPayment />
    </React.StrictMode>
    );
}
