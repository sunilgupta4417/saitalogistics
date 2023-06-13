const cryptoPayments=["ETH","BNB","MAZI_BEP_20","USDT_BEP_20","USDT_ERC_20","HUOBITOKEN_TRC_20","MAZI_ERC_20","SAITAMA_ERC_20"];
var account;
// https://docs.walletconnect.com/quick-start/dapps/web3-provider
var provider = new WalletConnectProvider.default({
  rpc: {
    1: "https://cloudflare-eth.com/", // https://ethereumnodes.com/
    137: "https://polygon-rpc.com/", // https://docs.polygon.technology/docs/develop/network-details/network/
    56: "https://bsc-dataseed.binance.org/",
    88: "https://trx.getblock.io/03d6b03d-b069-4eee-bcab-77f2363e4df9/mainnet/"
  },
  bridge: 'https://bridge.walletconnect.org',
});

var connectWC = async () => {
  await provider.enable();
  var currentAddress=getAccount("wallet_connect");
  $('#paymentUpdateForm').modal('hide');
  if(currentAddress==null){
    return false;
  }else{
    return true;
  }
}
//disconnectWC();
async function disconnectWC(){
  // Close provider session
  sessionStorage.removeItem("walletProvider");
  sessionStorage.removeItem("walletToken");
  await provider.disconnect();
}

async function connectMetamaskWC(){
  if (window.ethereum) {
    window.web3 = new Web3(window.ethereum);
  } else if (window.web3) {
    window.web3 = new Web3(window.web3.currentProvider);
  } else {
    alert("Non-Ethereum browser detected. You should consider trying MetaMask!");
  }
  window.ethereum.enable();
  var currentAddress=getAccount("metamask");
  $('#paymentUpdateForm').modal('hide');
  if(currentAddress==null){
    return false;
  }else{
    return true;
  }
}
function getWalletProvider(){
  const getWalletProviderName=sessionStorage.getItem("walletProvider");
  if(getWalletProviderName==null){
    return false;
  }
  return getWalletProviderName;
}

async function getAccount(walletType=""){
  var accountId=sessionStorage.getItem("walletToken");
  if (accountId == null) {
    if(walletType=="metamask"){
      window.web3.eth.getAccounts((err, retAccount) => {
        if (err != null) {
          alert("transfer.service :: getAccount :: error retrieving account");
          //reject("Error retrieving account");
        }else if (retAccount.length > 0) {
          accountId = retAccount[0];
          sessionStorage.setItem("walletToken", accountId);
          sessionStorage.setItem("walletProvider","metamask");
          return accountId;
        } else {
          alert('No accounts found. Please make sure your wallet connected with your metamask');
          return "";
        }
      });
    }else if(walletType=="wallet_connect"){
      const web3 = new Web3(provider);
      window.w3 = web3;
      var accounts  = await web3.eth.getAccounts(); // get all connected accounts
      accountId = accounts[0];// get the primary account
      alert(accountId);
      sessionStorage.setItem("walletToken", accountId);
      sessionStorage.setItem("walletProvider","wallet_connect");
      console.log(">>>>>>.Primary Account: ", accountId);
      return accountId;
    }    
  }
  return accountId;
}

async function makePayment(amount,orderid,paymentUpdateUrl,payment_type){
  if(getWalletProvider()=="metamask"){
    connectMetamaskWC();
  }else if(getWalletProvider()=="wallet_connect"){
    connectWC();
    console.log("WC EMP: ");
  }
  /*let currentChain = window.ethereum.request({ method: 'eth_chainId' });
  console.log("Current Chain: "+currentChain);*/
  /*let currentChain = window.ethereum.request({ method: 'eth_chainId' });
  console.log(currentChain);
  if(currentChain != 0x61){
    return alert("Please Select BNB Mainnet network before payment !!");
  }*/
  isLoader(true);
  return new Promise((resolve, reject) => {     
    if (getWalletProvider()) {
        makeFinalPayment(amount,orderid,payment_type,paymentUpdateUrl).then((res) => {
          if(res){
            if(amount){
              isLoader(false);
              resolve(res)
            }
          }
        }).catch((err) => {
          isLoader(false);
          console.log(err);
          alert("Something went wrong ! If your amount is deducted then  please contact to admin !!");
      })
    }else {
      alert("Non-Ethereum browser detected. You should consider trying MetaMask!");
    }
  });
}

async function makeFinalPayment(amount,orderid,payment_type,paymentUpdateUrl){
  try {
    /*console.log("this.web3.utils.toWei(amount.toString())",  window.web3.utils.toWei((amount).toString()));*/
    var userAddress="";
    const walletProviderName=getWalletProvider();
    if(walletProviderName){
      if(walletProviderName=="metamask"){
        userAddress = await getAccount("metamask");
      }else if(walletProviderName=="wallet_connect"){
        userAddress = await getAccount("wallet_connect");
      }
    } 
    return new Promise((resolve, reject) => {
      //window.web3.eth.sendTransaction({from: userAddress, to: contract, value: amount})
      console.log(userAddress);
      var senderAddress = userAddress.toString();
      var receiverAddress=getReceiverAddress(payment_type);
      const coinPayments=["ETH","BNB"];
      const contarctPayments=["MAZI_BEP_20","USDT_BEP_20","USDT_ERC_20","MAZI_ERC_20","SAITAMA_ERC_20","HUOBITOKEN_TRC_20"];
      if(coinPayments.indexOf(payment_type) != -1) {
        if(walletProviderName=="metamask"){
          const ethAmount=window.web3.utils.toWei(getUsdToConvertAmount(amount,payment_type).toString());
          console.log("ethAmount: "+ethAmount);
          window.web3.eth.sendTransaction({to:receiverAddress,from:senderAddress,value:ethAmount})
          .then((res) => {
            alert("Payment done successfully");
            console.log(res);
            console.log(ethAmount);
            var payStatus=(res.status==true)?"completed":"failed";
            const paymentResp = { transactionid : res.blockHash,blockHash : res.blockHash, blockNumber: res.blockNumber, from: res.from, to: res.to, amount: ethAmount/1000000000000000000, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin:payment_type+" Coin",transt:payStatus,orderid:orderid,transactionHash:res.transactionHash};
            updatePaymentResponse(paymentResp,orderid,payment_type,paymentUpdateUrl);
            console.log(paymentResp);
            resolve(res);
          })
          .catch((err) => {
            // this.toastr.error("Something went wrong");
            reject(err);
          });
        }else if(walletProviderName=="wallet_connect"){
          const web3WC = new Web3(provider);
          window.w3 = web3WC;
          const ethAmount=web3WC.utils.toWei(getUsdToConvertAmount(amount,payment_type).toString());
          console.log("ethAmount: "+ethAmount);
          web3WC.eth.sendTransaction({to:receiverAddress,from:senderAddress,value:1})
          .then((res) => {
            alert("Payment done successfully");
            console.log(res);
            console.log(ethAmount);
            var payStatus=(res.status==true)?"completed":"failed";
            const paymentResp = { transactionid : res.blockHash,blockHash : res.blockHash, blockNumber: res.blockNumber, from: res.from, to: res.to, amount: ethAmount/1000000000000000000, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin:payment_type+" Coin",transt:payStatus,orderid:orderid,transactionHash:res.transactionHash};
            updatePaymentResponse(paymentResp,orderid,payment_type,paymentUpdateUrl);
            console.log(paymentResp);
            resolve(res);
          })
          .catch((err) => {
            // this.toastr.error("Something went wrong");
            reject(err);
          });
          
        }
      }else if(contarctPayments.indexOf(payment_type) != -1) {
        const CONTRACT_ABI=getContractAbi(payment_type);
        const CONTRACT_ADDRESS=getContractAddress(payment_type);
        var finalAmount=amount;
        if(payment_type=="SAITAMA_ERC_20"){
          var perAmount=((amount*4)/100);
          finalAmount=(parseFloat(finalAmount)+parseFloat(perAmount));
          finalAmount=finalAmount.toFixed(4);
        }
        if(walletProviderName=="metamask"){
          const contract = new window.web3.eth.Contract(
            CONTRACT_ABI,
            CONTRACT_ADDRESS
          );
          contract.methods
            .transfer(receiverAddress, window.web3.utils.toWei((finalAmount).toString()))
            .send({
              from:senderAddress
            })
            .then((res) => {
              alert("Payment done successfully");
              console.log(res);
              var payStatus=(res.status==true)?"completed":"failed";
              const paymentResp = { transactionid : res.blockHash,blockHash : res.blockHash, blockNumber: res.blockNumber, from: res.from, to: res.to, amount: res.events.Transfer.returnValues.value/1000000000000000000, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin:payment_type+" Coin",transt:payStatus,orderid:orderid,transactionHash:res.transactionHash};
              updatePaymentResponse(paymentResp,orderid,payment_type,paymentUpdateUrl);
              console.log(paymentResp);
              resolve(res);
            })
            .catch((err) => {
              // this.toastr.error("Something went wrong");
              reject(err);
            });
        }else if(walletProviderName=="wallet_connect"){
          const web3WC = new Web3(provider);
          window.w3 = web3WC;
          const contract = new web3WC.eth.Contract(
            CONTRACT_ABI,
            CONTRACT_ADDRESS
          );
          contract.methods
            .transfer(receiverAddress, web3WC.utils.toWei((finalAmount).toString()))
            .send({
              from:senderAddress
            })
            .then((res) => {
              alert("Payment done successfully");
              console.log(res);
              var payStatus=(res.status==true)?"completed":"failed";
              const paymentResp = { transactionid : res.blockHash,blockHash : res.blockHash, blockNumber: res.blockNumber, from: res.from, to: res.to, amount: res.events.Transfer.returnValues.value/1000000000000000000, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin:payment_type,transt:payStatus,orderid:orderid,transactionHash:res.transactionHash};
              updatePaymentResponse(paymentResp,orderid,payment_type,paymentUpdateUrl);
              console.log(paymentResp);
              resolve(res);
            })
            .catch((err) => {
              // this.toastr.error("Something went wrong");
              reject(err);
            });
        }
      }
    });
  } catch (error) {
    console.log(error);
  }
}

function updatePaymentResponse(paymentResp,orderid="",payment_type="USDT",paymentUpdateUrl){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'post',
    url: paymentUpdateUrl,
    data: {status:"ok", response:paymentResp,id:orderid,payment_gateway:"Crypto",payment_type:payment_type},
    cache: false,
    dataType:'JSON',
    success: function (res) {
        if((res.status=="ok")){
            //console.log(res)
            $(".payment-successful b.successOrderNumber").html(res.response.orderid);
            location.href=res.redirect_url;
        }else{
            $(".form-footer button#nextBtn").hide();
            $(".form-footer button.clickMeForPay").show();
        }
    },
    error: function (res) {
        console.log(res)
    }
  });
}
function getContractAbi(paymentType="USDT_BEP_20"){
  if(paymentType=="MAZI_BEP_20"){
    return [{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":false,"internalType":"address","name":"newOwner","type":"address"}],"name":"ProxyOwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"implementation","type":"address"}],"name":"Upgraded","type":"event"},{"stateMutability":"payable","type":"fallback"},{"inputs":[],"name":"implementation","outputs":[{"internalType":"address","name":"impl","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"maintenance","outputs":[{"internalType":"bool","name":"_maintenance","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"proxyOwner","outputs":[{"internalType":"address","name":"owner","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bool","name":"_maintenance","type":"bool"}],"name":"setMaintenance","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferProxyOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newImplementation","type":"address"}],"name":"upgradeTo","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newImplementation","type":"address"},{"internalType":"bytes","name":"data","type":"bytes"}],"name":"upgradeToAndCall","outputs":[],"stateMutability":"payable","type":"function"},{"stateMutability":"payable","type":"receive"}];
  }else if(paymentType=="USDT_BEP_20"){
    return [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];
  }else if(paymentType=="USDT_ERC_20"){
    return [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_upgradedAddress","type":"address"}],"name":"deprecate","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"deprecated","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_evilUser","type":"address"}],"name":"addBlackList","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"upgradedAddress","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"balances","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"maximumFee","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"unpause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_maker","type":"address"}],"name":"getBlackListStatus","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"},{"name":"","type":"address"}],"name":"allowed","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"paused","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"who","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"pause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newBasisPoints","type":"uint256"},{"name":"newMaxFee","type":"uint256"}],"name":"setParams","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amount","type":"uint256"}],"name":"issue","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amount","type":"uint256"}],"name":"redeem","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"basisPointsRate","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"isBlackListed","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_clearedUser","type":"address"}],"name":"removeBlackList","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_blackListedUser","type":"address"}],"name":"destroyBlackFunds","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_initialSupply","type":"uint256"},{"name":"_name","type":"string"},{"name":"_symbol","type":"string"},{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"name":"amount","type":"uint256"}],"name":"Issue","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"amount","type":"uint256"}],"name":"Redeem","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"newAddress","type":"address"}],"name":"Deprecate","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"feeBasisPoints","type":"uint256"},{"indexed":false,"name":"maxFee","type":"uint256"}],"name":"Params","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_blackListedUser","type":"address"},{"indexed":false,"name":"_balance","type":"uint256"}],"name":"DestroyedBlackFunds","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_user","type":"address"}],"name":"AddedBlackList","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_user","type":"address"}],"name":"RemovedBlackList","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[],"name":"Pause","type":"event"},{"anonymous":false,"inputs":[],"name":"Unpause","type":"event"}];
  }else if(paymentType=="HUOBITOKEN_TRC_20"){
    return [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"approve","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isBlacklistAdmin","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"},{"name":"amount","type":"uint256"}],"name":"redeem","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"from","type":"address"},{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"renounceBlacklistAdmin","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceCoinFactoryAdmin","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isBlacklist","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"accounts","type":"address[]"}],"name":"addBlacklist","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"unpause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isPauser","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"paused","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"removeBlacklistAdmin","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"removePauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"renouncePauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"accounts","type":"address[]"}],"name":"removeBlacklist","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addPauser","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"pause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"},{"name":"amount","type":"uint256"}],"name":"issue","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"isOwner","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addCoinFactoryAdmin","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"isCoinFactoryAdmin","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"addBlacklistAdmin","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"account","type":"address"}],"name":"removeCoinFactoryAdmin","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_name","type":"string"},{"name":"_symbol","type":"string"},{"name":"_decimals","type":"uint8"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"BlacklistAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"BlacklistRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"BlacklistAdminAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"BlacklistAdminRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"CoinFactoryAdminRoleAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"CoinFactoryAdminRoleRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"account","type":"address"}],"name":"Paused","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"account","type":"address"}],"name":"Unpaused","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"PauserAdded","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"}],"name":"PauserRemoved","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"},{"indexed":false,"name":"amount","type":"uint256"}],"name":"Issue","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"account","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Redeem","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"previousOwner","type":"address"},{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"}];
  }else if(paymentType=="MAZI_ERC_20"){
    return [{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":false,"internalType":"address","name":"newOwner","type":"address"}],"name":"ProxyOwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"implementation","type":"address"}],"name":"Upgraded","type":"event"},{"stateMutability":"payable","type":"fallback"},{"inputs":[],"name":"implementation","outputs":[{"internalType":"address","name":"impl","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"maintenance","outputs":[{"internalType":"bool","name":"_maintenance","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"proxyOwner","outputs":[{"internalType":"address","name":"owner","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bool","name":"_maintenance","type":"bool"}],"name":"setMaintenance","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferProxyOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newImplementation","type":"address"}],"name":"upgradeTo","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newImplementation","type":"address"},{"internalType":"bytes","name":"data","type":"bytes"}],"name":"upgradeToAndCall","outputs":[],"stateMutability":"payable","type":"function"},{"stateMutability":"payable","type":"receive"}];
  }else if(paymentType=="SAITAMA_ERC_20"){
    return [{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[],"name":"_maxTxAmount","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"excludeAccount","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"includeAccount","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"isExcluded","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tAmount","type":"uint256"}],"name":"reflect","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"tAmount","type":"uint256"},{"internalType":"bool","name":"deductTransferFee","type":"bool"}],"name":"reflectionFromToken","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"renounceOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"maxTxPercent","type":"uint256"}],"name":"setMaxTxPercent","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"rAmount","type":"uint256"}],"name":"tokenFromReflection","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalFees","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"}];
  }
}
/*var amountConvt=getUsdToConvertAmount(1,"ETH");
console.log(amountConvt);*/
function getUsdToConvertAmount(amount, paymentType="ETH"){
  if(paymentType=="ETH"){
    var covertUrl="https://api.coingecko.com/api/v3/simple/price?ids=Ethereum&vs_currencies=usd";
  }else if(paymentType=="BNB"){
    var covertUrl="https://api.coingecko.com/api/v3/simple/price?ids=binancecoin&vs_currencies=usd";
  }
  var afterConvertAmount="";
  $.ajax({
    type: 'get',
    url: covertUrl,
    async: false, 
    success: function (res) {
      convertRate="";
      if(paymentType=="ETH"){
        convertRate=res.ethereum.usd;
      }else if(paymentType=="BNB"){
        convertRate=res.binancecoin.usd;
      }
      if(convertRate){
        afterConvertAmount=(amount/convertRate);
      }
    },
    error: function (res) {
      console.log(res)
      afterConvertAmount=amount;
    }
  });
  return afterConvertAmount;
}

function getReceiverAddress(paymentType="USDT_BEP_20"){
  if(paymentType=="ETH"){
    return "0x69ad061A21677de4CC15585B5f4ac50131B8cCC7";
  }else if(paymentType=="BNB"){
    return "0x69ad061A21677de4CC15585B5f4ac50131B8cCC7";
  }else if(paymentType=="USDT_BEP_20"){
    return "0x69ad061A21677de4CC15585B5f4ac50131B8cCC7";
  }else if(paymentType=="MAZI_BEP_20"){
    return "0x69ad061A21677de4CC15585B5f4ac50131B8cCC7";
  }else if(paymentType=="USDT_ERC_20"){
    return "0x69ad061A21677de4CC15585B5f4ac50131B8cCC7";
  }else if(paymentType=="HUOBITOKEN_TRC_20"){
    return "0x69ad061A21677de4CC15585B5f4ac50131B8cCC7";
  }else if(paymentType=="MAZI_ERC_20"){
    return "0x69ad061A21677de4CC15585B5f4ac50131B8cCC7";
  }else if(paymentType=="SAITAMA_ERC_20"){
    return "0x69ad061A21677de4CC15585B5f4ac50131B8cCC7";
  }
}
function getContractAddress(paymentType="USDT_BEP_20"){
  if(paymentType=="USDT_BEP_20"){
    return "0x55d398326f99059fF775485246999027B3197955";
  }else if(paymentType=="MAZI_BEP_20"){
    return "0x5b8650cd999b23cf39ab12e3213fbc8709c7f5cb";
  }else if(paymentType=="USDT_ERC_20"){
    return "0xdAC17F958D2ee523a2206206994597C13D831ec7";
  }else if(paymentType=="MAZI_ERC_20"){
    return "0x5B8650Cd999B23cF39Ab12e3213fbC8709c7f5CB";
  }else if(paymentType=="SAITAMA_ERC_20"){
    return "0x8B3192f5eEBD8579568A2Ed41E6FEB402f93f73F";
  }else if(paymentType=="HUOBITOKEN_TRC_20"){
    return "TDyvndWuvX5xTBwHPYJi7J3Yq8pq8yh62h";
  }
}

function isLoader(actionType=true){
  if(actionType===true){
    $("#preloader").show();
  }else{
    $("#preloader").hide();
  }
}