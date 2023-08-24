import React from "react";
import { useState} from "react";
import { Modal} from "react-bootstrap";
import { useContractWrite } from "wagmi";
import { parseEther,parseUnits} from "viem";
import { useSendTransaction } from "wagmi";
import * as constants from './Constants';
import { fetchTransaction } from '@wagmi/core';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css'; 

export default function CryptoTransaction(props){
  const selectedAddressId="Test";
  /*const contractRead = useContractRead({
    address:constants.getContractAddress(selectedAddressId),
    abi:constants.getContractAbi(selectedAddressId),
    functionName: "owner",
    chainId: 5,
  });*/
  const [formData, setFormData] = useState({
    payment_gateway: 'epay',
  });
  let [enabled, setEnabled] = useState(true);
  const [show, setShow] = useState(false);
  const [receiverAddress, setReceiverAddress] = useState("");
  const [contractAddress, setContractAddress] = useState("");
  const [contractAbi, setContractAbi] = useState("");
  const [paybleAmount, setPaybleAmount] = useState("");
  const [coinPayment, setCoinPayment] = useState(false);
  const [ethereumPayment, setEthereumPayment] = useState(false);
  const [payNowButton, setPayNowButton] = useState(true);
  const handleClose = () =>{
    setShow(false);
    setPayNowButton(true);
    setFormData({ ...formData,payment_gateway: 'epay' });
  }
  const handleShow = () =>{
    setShow(true);
    setPayNowButton(false);
  }
  const handleChange = async (e) => {
    const { name, value, type, checked } = e.target;
    if (type === 'checkbox') {
      setFormData({ ...formData, [name]: checked });
    }else if (type === 'radio') {
      setFormData({ ...formData, [name]: value });
      console.log(value);
      setReceiverAddress(constants.getReceiverAddress(value));
      setContractAddress(constants.getContractAddress(value));
      setContractAbi(constants.getContractAbi(value));
      /*var finalPaybleAmount=(props.shipmentData.total_charges*1000000000000000000);*/
      const ethPayments=["ETH","BNB"];
      if(ethPayments.indexOf(value) != -1) {
        setEthereumPayment(true);
        setCoinPayment(false);
        var finalPaybleAmount=await constants.getUsdToConvertAmount(1,value);
        finalPaybleAmount=parseEther(finalPaybleAmount);
      }else{
        setEthereumPayment(false);
        setCoinPayment(true);
        var finalPaybleAmount=await constants.getUsdToConvertAmount(1,value);
        finalPaybleAmount=parseUnits(finalPaybleAmount.toString(),constants.getDecimalNumber(value));
        console.log(finalPaybleAmount);
      }
      setPaybleAmount(finalPaybleAmount);
      setShow(true);
      setPayNowButton(false);
    }else {
      setFormData({ ...formData, [name]: value });
    }
  };
  
  const {
    data: contractWriteData,
    isLoading: contractWriteIsLoading,
    isSuccess: contractWriteIsSuccess,
    write: contractWrite
  } = useContractWrite({
    address:contractAddress,
    abi:contractAbi,
    functionName: 'transfer',
    chainId:constants.getChainId(formData.payment_gateway),    
  })
  if(contractWriteIsLoading){
    console.log("Chain ID: "+constants.getChainId(formData.payment_gateway));
    console.log("receiverAddress: "+receiverAddress);
    console.log("contractAddress: "+contractAddress);
    isLoader(true);
  }
  if(contractWriteIsSuccess){
    setTimeout(() => {
      getTransaction(contractWriteData);
    },5000);
  }else if(!contractWriteIsLoading){
    isLoader(false);
  }
  const {
    data: transactionData,
    isLoading: transactionIsLoading,
    isSuccess: transactionIsSuccess,
    sendTransaction
  }=useSendTransaction({
    to:receiverAddress,
    value:paybleAmount,
    chainId:constants.getChainId(formData.payment_gateway),    
  }); 
  if(transactionIsLoading){
    console.log("Chain ID E: "+constants.getChainId(formData.payment_gateway));
    isLoader(true);
  } 
  if(transactionIsSuccess){
    setTimeout(() => {
      getTransaction(transactionData);
    },5000);
  }else if(!transactionIsLoading){
    isLoader(false);
  }
  
  /*const transactionObj=fetchTransaction({
    hash:"0x6b133b06c624911ce449308a906569a3a69412660b271e0e5b154d64a003ae9b"
  });
  console.log(transactionObj);*/
  async function getTransaction(hashObj){
    setEnabled(false);
    if(enabled){
      const transaction=await fetchTransaction(hashObj);
      if(transaction){
        console.log(transaction);
        if(constants.ethPayments().indexOf(formData.payment_gateway) != -1) {
          var payStatus=(transaction.status==true)?"completed":transaction.hasOwnProperty("status")?"failed":"waiting";
          var amountPaid=(Number(transaction.value)/1000000000000000000);
          const paymentResp = { transactionid : transaction.hash,blockHash : transaction.blockHash, blockNumber: Number(transaction.blockNumber), from: transaction.from, to: transaction.to, amount:amountPaid, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin:formData.payment_gateway+" Coin",transt:payStatus,orderid:props.shipmentData.id,transactionHash:transaction.hash};
          afterPaymentAction(paymentResp);
        }else{
          var payStatus=(transaction.status==true)?"completed":transaction.hasOwnProperty("status")?"failed":"waiting";
          var amountPaid=(Number(transaction.value)/1000000000000000000);
          const paymentResp = { transactionid : transaction.hash,blockHash : transaction.blockHash, blockNumber:Number(transaction.blockNumber), from: transaction.from, to: transaction.to, amount:amountPaid, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin:formData.payment_gateway+" Coin",transt:payStatus,orderid:props.shipmentData.id,transactionHash:transaction.hash};
          afterPaymentAction(paymentResp);
        }
        setEnabled(true);
      }
    }
    isLoader(false);
  }
  async function afterPaymentAction(responseData,type=true){
    setTimeout(() => {
      isLoader(true);
    },5000);
    // Set the CSRF token in the Axios headers
    axios.defaults.headers.common['X-CSRF-TOKEN'] = props.csrfToken;
    const constPaymentStatus=["completed","waiting"];
    var statusResp=(constPaymentStatus.indexOf(responseData.transt) != -1)?"ok":"notok";
    console.log(statusResp);
    // Make the POST request with form data
    const requestedData={status:statusResp,response:responseData,id:responseData.orderid,payment_gateway:formData.payment_gateway}
    console.log(requestedData);
    console.log(props);
    await axios.post(props.shipmentUpdateUrl,requestedData).then(res => {
      // Handle the response as needed
      var resp=res.data;
      console.log(resp);
      if((resp.status=="ok") && (constPaymentStatus.indexOf(resp.response.transt) != -1)){
        window.location.href=resp.redirect_url;
      }else{

      }
      isLoader(false);
    }).catch(error => {
        console.error(error);
        isLoader(false);
    });
  }
  return (
    <div className="cryptoPaymentList">
      <div className="cryptoPaymentsList">
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
          <input type="radio" name="payment_gateway" value="USDT_ERC_20" className="clickMeForPayInput"  checked={formData.payment_gateway === "USDT_ERC_20"} onChange={handleChange} />
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
        {/*<div className="form-group" id="mazierc-btn">
          <label>Mazimatic (Mazi ERC 20)</label>
          <input type="radio" name="payment_gateway" value="MAZI_ERC_20" className="clickMeForPayInput" checked={formData.payment_gateway === 'MAZI_ERC_20'} onChange={handleChange}/>
        </div>
        <div className="form-group" id="ht-token-btn">
          <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon7.png" alt="" className="img-responsive" />
          <label>HT Token (TRC 20)</label>
          <input type="radio" name="payment_gateway" value="HUOBITOKEN_TRC_20" className="clickMeForPayInput" checked={formData.payment_gateway === 'HUOBITOKEN_TRC_20'} onChange={handleChange} />
        </div>*/}
      </div>
      <Modal show={show} onHide={handleClose} backdrop="static" className="cryptoPaymentConfirmationBox">
        <Modal.Header closeButton>
          <p>Booking Date: {props.shipmentData.booking_date} Payment</p>
        </Modal.Header>
        <Modal.Body>
          <div>
            <p>Shipping Amount: USD {props.shipmentData.shipping_charge}</p>
            <p>FCA Amount: USD {props.shipmentData.fca_charge}</p>
            <p>Ex Work Amount: USD {props.shipmentData.fca_charge}</p>
            <p>Total Amount: USD {props.shipmentData.total_charges}</p>
          </div>
          { coinPayment && (
            <div className="coinPayment">
              <button className="clickMeForPay" disabled={!contractWrite} onClick={() =>contractWrite({
                args: [
                  receiverAddress,
                  paybleAmount
                ]
              })} >Pay Now </button>
              {contractWriteIsLoading && <div>Check Wallet</div>}
              {contractWriteIsSuccess && <div>Transaction: {JSON.stringify(contractWriteData)}</div>}
            </div>
          )}
          { ethereumPayment && (
            <div className="etheriumPayment">
              <button className="clickMeForPay" onClick={() => sendTransaction()}
              >Pay Now </button><br />
              {transactionIsLoading && <div>Check Wallet</div>}
              {transactionIsSuccess && <div>Transaction: {JSON.stringify(transactionData)}</div>}
            </div>
          )}
        </Modal.Body>
      </Modal>
    </div>
  )
};