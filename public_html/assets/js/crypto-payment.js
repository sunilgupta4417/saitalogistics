async function checkExtentions(){
    if (window.ethereum) {
		  window.web3 = new Web3(window.ethereum);
    } else if (window.web3) {
		  window.web3 = new Web3(window.web3.currentProvider);
    } else {
		  alert("Non-Ethereum browser detected. You should consider trying MetaMask!");
    }
    connectToMetamask();
    var currentAddress=getAccount();
    if(currentAddress==null){
      return false;
    }else{
      return true;
    }
}
async function connectToMetamask() {
    return window.ethereum.enable();
};

function getAccount(){
  accountId=localStorage.getItem("walletToken");
  if (accountId == null) {
    window.web3.eth.getAccounts((err, retAccount) => {
      if (err != null) {
        alert("transfer.service :: getAccount :: error retrieving account");
        //reject("Error retrieving account");
      }else if (retAccount.length > 0) {
        accountId = retAccount[0];
        localStorage.setItem("walletToken", accountId);
        return accountId;
      } else {
        alert('No accounts found. Please make sure your wallet connected with your metamask');
        return "";
      }
    });
  }
  return accountId;
}

async function makePayment(amount, orderid,paymentUpdateUrl){
    if(checkExtentions()){
      let currentChain = window.ethereum.request({ method: 'eth_chainId' });
      if(currentChain != 0x61){
        return alert("Please Select BNB Mainnet network before payment !!");
      }
      this.isLoading = true;//add new loader
      return new Promise((resolve, reject) => {     
          if (window.ethereum) {
            makeFinalPayment(amount).then((res) => {
              if(res){
                var payStatus=(res.status==true)?"completed":"failed";
                const paymentResp = { transactionid : res.blockHash,blockHash : res.blockHash, blockNumber: res.blockNumber, from: res.from, to: res.to, amount: res.events.Transfer.returnValues.value/1000000000000000000, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin: "USDT",transt:payStatus,orderid:orderid}
                
                //const data =  this.service.paymentCall(payment, token)
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                  }
                });
                $.ajax({
                  type: 'post',
                  url: paymentUpdateUrl,
                  data: {status:"ok", response:paymentResp,id:orderid,payment_gateway:"Crypto Coin"},
                  cache: false,
                  dataType:'JSON',
                  success: function (res) {
                      if((res.status=="ok")){
                          $(".form-footer button#nextBtn").trigger("click");
                          //console.log(res)
                          $(".payment-successful b.successOrderNumber").html(res.response.orderid);
                          $(".form-footer button#nextBtn").hide();
                          $(".form-footer button.clickMeForPay").remove();
                      }else{
                          $(".form-footer button#nextBtn").hide();
                          $(".form-footer button.clickMeForPay").show();
                      }
                  },
                  error: function (res) {
                      console.log(res)
                  }
                });
                if(amount){
                  localStorage.setItem('payment', paymentResp);
                  resolve(res)
                }
              }
            }).catch((err) => {
              //this.isLoading = false;
              console.log(err);
              alert("Something went wrong ! If your amount is deducted then  please contact to admin !!");
          })
         }else {
          alert("Non-Ethereum browser detected. You should consider trying MetaMask!");
        }
      });
    }
}

async function makeFinalPayment(amount){
    try {
        const CONTRACT_ABI =[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];
      const CONTARCT_ADDRESS="0xB1C0744481315c3469968f9d89D4D764E58e117D";
      const contract = new window.web3.eth.Contract(
        CONTRACT_ABI,
        CONTARCT_ADDRESS
      );
      /*console.log("this.web3.utils.toWei(amount.toString())",  window.web3.utils.toWei((amount).toString()));*/
      let userAddress = await getAccount(); 
      return new Promise((resolve, reject) => {
        //window.web3.eth.sendTransaction({from: userAddress, to: contract, value: amount})
        contract.methods
          .transfer("0x4Ff19AE160EE847c6CcC167c9721269D6243D423", window.web3.utils.toWei((amount).toString()))
          .send({
            from: userAddress.toString()
          })
          .then((data) => {
            alert("Payment done successfully");
            console.log(data);
            resolve(data);
          })
          .catch((err) => {
            // this.toastr.error("Something went wrong");
            reject(err);
          });
      });
    } catch (error) {
    console.log(error);
    }
 }