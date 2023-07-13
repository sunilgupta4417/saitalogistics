import React, { useState, useEffect } from 'react';
import { createRoot } from "react-dom/client";
import axios from 'axios';
import { EthereumClient, w3mConnectors, w3mProvider } from '@web3modal/ethereum';
import { Web3Modal,Web3Button } from '@web3modal/react';
import {bsc, mainnet, polygon,goerli,bscTestnet} from 'wagmi/chains';
import { configureChains, createConfig, WagmiConfig} from "wagmi";
import {useAccount} from "wagmi";
import { useSendTransaction, usePrepareSendTransaction } from "wagmi";
import { parseEther } from "viem";
import * as constansts from './Constants';


function ShipmentPayment() {
    const chains = [bsc, mainnet, polygon,goerli,bscTestnet]
    const projectId = 'bc73d7505fd406159d095af056d4f4d4'
    const { publicClient } = configureChains(chains, [w3mProvider({ projectId })])
    const wagmiConfig = createConfig({
        autoConnect: true,
        connectors: w3mConnectors({ projectId, chains }),
        publicClient
    })
    const ethereumClient = new EthereumClient(wagmiConfig, chains);

    const [shipment, setShipment] = useState([]);
    const [buttonDisabled, setButtonDisabled] = useState(false);
    const [buttonText, setButtonText] = useState('Pay Now');
    const [csrfToken, setCsrfToken] = useState('');
    const [shipmentUpdateUrl, setShipmentUpdateUrl] = useState('');
    const [formData, setFormData] = useState({
        payment_gateway: 'epay',
      // Add more form fields here if needed
    });
    const baseUrl = window.location.protocol + '//' + window.location.host;
    useEffect(() => {
        const uriSegments = window.location.pathname.split('/');
        const shipment_id = uriSegments[uriSegments.length - 1];
        // Fetch user data from the API
        const endpoint=baseUrl+"/user/shipment/payments/"+shipment_id;
        axios.get(endpoint)
        .then(response => {
            // Update the state with the fetched data
            setShipment(response.data.shipments);
            setCsrfToken(response.data.csrfToken);
            setShipmentUpdateUrl(response.data.shipmentUpdateUrl);
        })
        .catch(error => {
            console.error(error);
        });
    }, []);
    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        if (type === 'checkbox') {
          setFormData({ ...formData, [name]: checked });
        } else {
          setFormData({ ...formData, [name]: value });
        }
    };

    const handleButtonClick = (e) => {
        e.preventDefault();
        // Perform any desired actions with the form data
        // Disable the button and change the text
        setButtonDisabled(true);
        setButtonText('Loading...');
        isLoader(true);
        const customerId=e.target.getAttribute("data-customerid");
        const userEmail=e.target.getAttribute("data-user_email");
        const orderID=e.target.getAttribute("data-orderid");
        const orderAmount=e.target.getAttribute("data-total");
        const orderCurrency="USD";
        const orderDescription=customerId+','+userEmail+','+orderID+','+orderAmount+','+orderCurrency;
        if(formData.payment_gateway=="epay"){
            paymentOptions(customerId,userEmail,orderID,orderAmount,orderCurrency,orderDescription);
        }else if(cryptoPayments.indexOf(formData.payment_gateway) != -1){
            makePaymentByCrypto(orderAmount,orderID,shipmentUpdateUrl,formData.payment_gateway);
        }
        // Simulate an asynchronous operation
        setTimeout(() => {
            // Re-enable the button and change the text back
            setButtonDisabled(false);
            setButtonText('Pay Now');
        },5000);
    };

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
                console.log(response);
                afterPaymentAction(response,true);             
            },
            failedHandler: async function(response) {
                afterPaymentAction(response,false);
            },
        };    
        const epay=new Epay(options);
        epay.open(options);
    }
    function afterPaymentAction(responseData,type=true){
        setTimeout(() => {
            isLoader(true);
        },500);
        // Set the CSRF token in the Axios headers
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        // Make the POST request with form data
        const requestedData={status:responseData.status, response:responseData.response,id:responseData.response.orderid}
        axios.post(shipmentUpdateUrl, requestedData)
        .then(res => {
            // Handle the response as needed
            var resp=res.data;
            console.log(resp);
            if((resp.status=="ok") && (resp.response.transt=="completed")){
                window.location.href=resp.redirect_url;
            }else{

            }
            isLoader(false);
        })
        .catch(error => {
            console.error(error);
            isLoader(false);
        });
    }
    /* use crypto setup */
    async function makePaymentByCrypto(orderAmount,orderID,shipmentUpdateUrl,selectPaymentType){
        console.log(orderAmount);
        console.log(orderID);
        console.log(shipmentUpdateUrl);
        console.log(selectPaymentType);
        /*const {config}= usePrepareSendTransaction({
            to: constansts.getReceiverAddress(selectPaymentType),
            value: parseEther(orderAmount)
        });
        console.log(config);
        const { data, isLoading, isSuccess} =useSendTransaction(config);
        console.log(data);
        console.log(isLoading);
        console.log(isSuccess);*/
    }

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
                                    <div className="walletConnected">
                                        <WagmiConfig config={wagmiConfig}>
                                            <ActionButton />
                                            <Configuration />
                                        </WagmiConfig>
                                        <Web3Modal projectId={projectId} ethereumClient={ethereumClient} />
                                    </div>
                                </div>  
                                <div className="col-md-8">
                                    <div className="cryptoPayments">
                                        <div className="form-group" id="eth-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon1.png" alt="" className="img-responsive" />
                                            <label>ETH</label>
                                            <input type="radio" name="payment_gateway" value="ETH" className="clickMeForPayInput" checked={formData.payment_gateway === 'ETH'} onChange={handleChange}/>
                                        </div>
                                        <div className="form-group" id="bnb-btn"> 
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon2.png" alt="" className="img-responsive" />
                                            <label>BNB</label>
                                            <input type="radio" name="payment_gateway" value="BNB" className="clickMeForPayInput"  checked={formData.payment_gateway === 'BNB'} onChange={handleChange} />
                                        </div>
                                        <div className="form-group" id="usdtbep-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon3.png" alt="" className="img-responsive" />
                                            <label>USDT (BEP 20)</label>
                                            <input type="radio" name="payment_gateway" value="USDT_BEP_20" className="clickMeForPayInput"  checked={formData.payment_gateway === 'USDT_BEP_20'} onChange={handleChange} />  
                                        </div>
                                        <div className="form-group" id="usdterc-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon4.png" alt="" className="img-responsive" />
                                            <label>USDT (ERC 20)</label>
                                            <input type="radio" name="payment_gateway" value="USDT_ERC_20" className="clickMeForPayInput"  checked={formData.payment_gateway === 'USDT_ERC_20'} onChange={handleChange} />
                                        </div>
                                        <div className="form-group" id="saitamaerc-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon5.png" alt="" className="img-responsive" />
                                            <label>SAITAMA (ERC 20)</label>
                                            <input type="radio" name="payment_gateway" value="SAITAMA_ERC_20" className="clickMeForPayInput"  checked={formData.payment_gateway === 'SAITAMA_ERC_20'} onChange={handleChange} />
                                        </div>
                                        <div className="form-group" id="mazi-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon6.png" alt="" className="img-responsive" />
                                            <label>Mazimatic (Mazi BEP 20)</label>
                                            <input type="radio" name="payment_gateway" value="MAZI_BEP_20" className="clickMeForPayInput"  checked={formData.payment_gateway === 'MAZI_BEP_20'} onChange={handleChange} />
                                        </div>
                                        <div className="form-group" id="ht-token-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon7.png" alt="" className="img-responsive" />
                                            <label>HT Token (TRC 20)</label>
                                            <input type="radio" name="payment_gateway" value="HUOBITOKEN_TRC_20" className="clickMeForPayInput" checked={formData.payment_gateway === 'HUOBITOKEN_TRC_20'} onChange={handleChange} />
                                        </div>
                                        <div className="form-group">
                                            <label>Mazimatic (Mazi ERC 20)</label>
                                            <input type="radio" name="payment_gateway" value="MAZI_ERC_20" className="clickMeForPayInput" checked={formData.payment_gateway === 'MAZI_ERC_20'} onChange={handleChange}/>
                                        </div>
                                        <div className="form-group" id="credit-crd-btn">
                                            <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon8.png" alt="" className="img-responsive" />
                                            <label>Credit/Debit Card (Epay)</label>
                                            <input type="radio" name="payment_gateway" value="epay" className="clickMeForPayInput" checked={formData.payment_gateway === 'epay'} onChange={handleChange}/>  
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
                        <button type="button" className="clickMeForPay" data-orderid={shipment.id}  data-user_email={shipment.csr_email_id} data-customerid={shipment.client_id} data-total={shipment.total_charges} onClick={handleButtonClick} disabled={buttonDisabled}>{buttonText}</button>
                    ) : ('')}
                </div>
            </div>
        </div>
    );
}
export default ShipmentPayment;
export function ActionButton() {
    return <Web3Button />
}
export const Configuration = () => {
    const [address, setAddress] = useState("");
    const [connector, setConnector] = useState({}); 
    
    const data1 = useAccount({
        onConnect({ address, connector, isReconnected }) {
            setAddress(address);
            console.log(connector);
            setConnector(connector);
        },
        onDisconnect() {
            setAddress("");
            console.log("Disconnected.");
            setConnector({});
        },
    });
  
    /*const { config } = usePrepareSendTransaction({
      to: "0x98dD76A9B39f05BfE6d9083D391eB74076Fd7560",
      value: parseEther("0.01"),
    });
  
    const { data, isLoading, isSuccess, sendTransaction } =
      useSendTransaction(config);
  
    useEffect(() => {
      setTxhash(data?.hash);
    }, [data, isLoading, isSuccess]);*/
  
    return (
        <div>
            <span>Address: {address}</span> <br />
            <span>Connected through: {connector?.name}</span><br />
        </div>
    );
}

if (document.getElementById('root')) {
    const rootElement = document.getElementById("root");
    const root = createRoot(rootElement);
    root.render(
        <React.StrictMode>
            <ShipmentPayment />
        </React.StrictMode>
    );
}
