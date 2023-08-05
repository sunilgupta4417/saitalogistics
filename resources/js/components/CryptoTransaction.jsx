import React from "react";
import { useState,useEffect } from "react";
import { Modal, Button} from "react-bootstrap";
import { usePrepareContractWrite,useContractWrite } from "wagmi";
import { useContractRead} from "wagmi";
/*import { parseEther } from "viem";
import { ethers } from "ethers";*/
import * as constansts from './Constants';

export default function CryptoTransaction(props){
  const selectedAddressId="Test";
  /*const contractRead = useContractRead({
    address:constansts.getContractAddress(selectedAddressId),
    abi:constansts.getContractAbi(selectedAddressId),
    functionName: "owner",
    chainId: 5,
  });*/
  const [formData, setFormData] = useState({});
  const [show, setShow] = useState(false);
  const handleClose = () =>setShow(false);
  const handleShow = () =>setShow(true);
  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    if (type === 'checkbox') {
      setFormData({ ...formData, [name]: checked });
    }else if (type === 'radio') {
      setFormData({ ...formData, [name]: value });
      setShow(true);
    }else {
      setFormData({ ...formData, [name]: value });
    }
  };
  const receiverAddress=constansts.getReceiverAddress(selectedAddressId);
  const paybleAmount=(props.shipmentData.total_charges*1000000000000000000);
  /*const config = usePrepareContractWrite({
    address:constansts.getContractAddress(selectedAddressId),
    abi:constansts.getContractAbi(selectedAddressId),
    functionName: 'transfer',
    chainId:5,
    args: [
      receiverAddress,
      paybleAmount
    ]
  });
  const { data, isLoading, isSuccess, write } = useContractWrite(config);*/
  const { data, isLoading, isSuccess, write } = useContractWrite({
    address:constansts.getContractAddress(selectedAddressId),
    abi:constansts.getContractAbi(selectedAddressId),
    functionName: 'transfer',
    chainId: 5,    
  })
  if(isSuccess){
    console.log(data);
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
        <div className="form-group" id="ht-token-btn">
          <img src="https://staging.saitalogistics.com/assets/images/btn-icons/icon7.png" alt="" className="img-responsive" />
          <label>HT Token (TRC 20)</label>
          <input type="radio" name="payment_gateway" value="HUOBITOKEN_TRC_20" className="clickMeForPayInput" checked={formData.payment_gateway === 'HUOBITOKEN_TRC_20'} onChange={handleChange} />
        </div>
        <div className="form-group" id="mazierc-btn">
          <label>Mazimatic (Mazi ERC 20)</label>
          <input type="radio" name="payment_gateway" value="MAZI_ERC_20" className="clickMeForPayInput" checked={formData.payment_gateway === 'MAZI_ERC_20'} onChange={handleChange}/>
        </div>
      </div>
      <Modal show={show} onHide={handleClose} className="cryptoPaymentConfirmationBox">
        <Modal.Header closeButton>
          <p>Payment</p>
        </Modal.Header>
        <Modal.Body>
          <div>
            <p>Booking Date: {props.shipmentData.booking_date}</p>
            <p>Shipping Amount: USD {props.shipmentData.shipping_charge}</p>
            <p>FCA Amount: USD {props.shipmentData.fca_charge}</p>
            <p>Ex Work Amount: USD {props.shipmentData.fca_charge}</p>
            <p>Total Amount: USD {props.shipmentData.total_charges}</p>
          </div>
          <button className="clickMeForPay" disabled={!write} onClick={() =>write({
            args: [
              receiverAddress,
              paybleAmount
            ]
          })} >Pay Now </button>
          {isLoading && <div>Check Wallet</div>}
          {isSuccess && <div>Transaction: {JSON.stringify(data)}</div>}
        </Modal.Body>
      </Modal>
    </div>
  )
};