const cryptoPayments=["ETH","BNB","MAZI_BEP_20","USDT_BEP_20","USDT_ERC_20","HUOBITOKEN_TRC_20","MAZI_ERC_20","SAITAMA_ERC_20"];
var account;
// https://docs.walletconnect.com/quick-start/dapps/web3-provider
var provider = new WalletConnectProvider.default({
  rpc: {
    1: "https://cloudflare-eth.com/", // https://ethereumnodes.com/
    137: "https://polygon-rpc.com/", // https://docs.polygon.technology/docs/develop/network-details/network/
    56: "https://bsc-dataseed.binance.org/"
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
    //location.reload();
    return true;
  }
}
//disconnectWC();
async function disconnectWC(){
  // Close provider session
  sessionStorage.removeItem("walletProvider");
  sessionStorage.removeItem("walletToken");
  await provider.disconnect();
  location.reload();
}
function isWalletConnectConnected(){
  if((sessionStorage.getItem("walletProvider")=='wallet_connect') && (sessionStorage.getItem("walletToken")!=='')){
    return true;
  }
  return false;
}

async function connectMetamaskWC(){
  if (typeof window.ethereum !== 'undefined') {
    window.web3 = new Web3(window.ethereum);
  } else if (window.web3) {
    window.web3 = new Web3(window.web3.currentProvider);
  } else {
    alert("Non-Ethereum browser detected. You should consider trying MetaMask!");
  }
  var currentAddress=getAccount("metamask");
  console.log(currentAddress);
  checkWalletConnection();
  $('#paymentUpdateForm').modal('hide');
  if(currentAddress==null){
    return false;
  }else{
    return true;
  }
}
function isMetamaskConnected(){
  if((sessionStorage.getItem("walletProvider")=='metamask') && (sessionStorage.getItem("walletToken")!=='')){
    return true;
  }
  //return window.ethereum.isConnected();
  return false;
}
async function disconnectMetamaskWC(){
  // Close provider session
  sessionStorage.removeItem("walletProvider");
  sessionStorage.removeItem("walletToken");
  location.reload();
}

function getWalletProvider(){
  const getWalletProviderName=sessionStorage.getItem("walletProvider");
  if(getWalletProviderName==null){
    return false;
  }
  return getWalletProviderName;
}
function checkWalletConnection(){
  if(isMetamaskConnected()){
    $('.walletConnected').html('<img src="https://staging.saitalogistics.com/assets/images/wallet-metamask.png" alt="Metamask"> (Metamask) wallet connected <button type="button" onclick="disconnectMetamaskWC()"> Disconnect</button>');
  }
  if(isWalletConnectConnected()){
    $('.walletConnected').html('<img src="https://staging.saitalogistics.com/assets/images/wallet-connect.png" alt="Wallet Connect"> (Wallet Connect) wallet connected <button type="button" onclick="disconnectWC()">Disconnect</button>');
  }
}

async function getAccount(walletType=""){
  var accountId=sessionStorage.getItem("walletToken");
  if (accountId == null) {
    if(walletType=="metamask"){
      const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' }).catch((err) => {
        if (err.code === 4001) {
          // EIP-1193 userRejectedRequest error
          // If this happens, the user rejected the connection request.
          alert("Please connect to MetaMask.");
        } else {
          console.error(err);
          alert(err);
        }
      });
      if (accounts.length > 0) {
        accountId = accounts[0];
        sessionStorage.setItem("walletToken", accountId);
        sessionStorage.setItem("walletProvider","metamask");
        return accountId;
      } else {
        alert('No accounts found. Please make sure your wallet connected with your metamask');
        return "";
      }
    }else if(walletType=="wallet_connect"){
      const web3 = new Web3(provider);
      window.w3 = web3;
      var accounts  = await web3.eth.getAccounts(); // get all connected accounts
      accountId = accounts[0];// get the primary account
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
    let currentChain = await window.ethereum.request({ method: 'eth_chainId' });
    if((payment_type=="ETH") && (currentChain!="0x1")){
      await window.ethereum.request({
        method: 'wallet_switchEthereumChain',
        params: [{ chainId: '0x1' }],
      });
    }else if((payment_type=="BNB") && (currentChain!="0x38")){
      await window.ethereum.request({
        method: 'wallet_switchEthereumChain',
        params: [{ chainId: '0x38' }],
      });
    }
  }else if(getWalletProvider()=="wallet_connect"){
    connectWC();
    const web3WC = new Web3(provider);
    let currentChain = await web3WC.eth.getChainId();
    alert(currentChain);
    if((payment_type=="ETH") && (currentChain!=1)){
      var defaultChainId=1;
      provider.on("chainChanged", (defaultChainId) => {
        console.log(defaultChainId);
      });
      /*await provider.request({
        method: 'chainChanged',
        params: [{ chainId:1 }],
      });*/
    }else if((payment_type=="BNB") && (currentChain!=56)){
      var defaultChainId=56;
      provider.on("chainChanged", (defaultChainId) => {
        console.log(defaultChainId);
      });
    }
    console.log("WC EMP: ");
  }
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
      isLoader(false);
      alert("Sorry! we did't find any wallet, so please try again");
    }
    //
  });
}


async function makeFinalPayment(amount,orderid,payment_type,paymentUpdateUrl){
  try {
    var userAddress="";
    const walletProviderName=getWalletProvider();
    if(walletProviderName){
      if(walletProviderName=="metamask"){
        userAddress = await getAccount("metamask");
      }else if(walletProviderName=="wallet_connect"){
        userAddress = await getAccount("wallet_connect");
      }
    } 
    console.log(userAddress);
    isLoader(true);
    var senderAddress = userAddress.toString();
    var receiverAddress=getReceiverAddress(payment_type);
    const coinPayments=["ETH","BNB"];
    const contarctPayments=["MAZI_BEP_20","USDT_BEP_20","USDT_ERC_20","MAZI_ERC_20","SAITAMA_ERC_20","HUOBITOKEN_TRC_20"];
    if(coinPayments.indexOf(payment_type) != -1) {
      if(walletProviderName=="metamask"){
        const ethAmount=window.web3.utils.toWei(getUsdToConvertAmount(amount,payment_type).toString(),'ether');
        console.log("ethAmount: "+ethAmount);
        window.web3.eth.sendTransaction({to:receiverAddress,from:senderAddress,value:ethAmount,gas:21000})
        .then((res) => {
          //alert("Payment done successfully");
          console.log(res);
          console.log(ethAmount);
          var payStatus=(res.status==true)?"completed":"failed";
          const paymentResp = { transactionid : res.blockHash,blockHash : res.blockHash, blockNumber: res.blockNumber, from: res.from, to: res.to, amount: ethAmount/1000000000000000000, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin:payment_type+" Coin",transt:payStatus,orderid:orderid,transactionHash:res.transactionHash};
          updatePaymentResponse(paymentResp,orderid,payment_type,paymentUpdateUrl);
          console.log(paymentResp);
          isLoader(false);
        })
        .catch((err) => {
          isLoader(false);
        });
      }else if(walletProviderName=="wallet_connect"){
        const web3WC = new Web3(provider);
        const ethAmount=web3WC.utils.toWei(getUsdToConvertAmount(amount,payment_type),'ether');
        console.log("ethAmount: "+ethAmount);
        /*web3WC.eth.sendTransaction({to:receiverAddress,from:senderAddress,value:ethAmount}).on('transactionHash', (hash) => {
          console.log('Received txHash: ', hash);
        })
        .then((res) => {
          //alert("Payment done successfully");
          console.log(res);
          console.log(ethAmount);
          var payStatus=(res.status==true)?"completed":"failed";
          const paymentResp = { transactionid : res.blockHash,blockHash : res.blockHash, blockNumber: res.blockNumber, from: res.from, to: res.to, amount: ethAmount/1000000000000000000, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin:payment_type+" Coin",transt:payStatus,orderid:orderid,transactionHash:res.transactionHash};
          updatePaymentResponse(paymentResp,orderid,payment_type,paymentUpdateUrl);
          console.log(paymentResp);
          isLoader(false);
          resolve(res);
        })
        .catch((err) => {
          isLoader(false);
          reject(err);
        });*/
        var res=await web3WC.eth.sendTransaction({to:receiverAddress,from:senderAddress,value:ethAmount,gas:21000});
        console.log(res);
        console.log(ethAmount);
        if(res){
          var payStatus=(res.status==true)?"completed":"failed";
          const paymentResp = { transactionid : res.blockHash,blockHash : res.blockHash, blockNumber: res.blockNumber, from: res.from, to: res.to, amount: ethAmount/1000000000000000000, paymentType: "Deposit", paymentMethod: "Crypto", paymentCoin:payment_type+" Coin",transt:payStatus,orderid:orderid,transactionHash:res.transactionHash};
          updatePaymentResponse(paymentResp,orderid,payment_type,paymentUpdateUrl);
          console.log(paymentResp);
        }
        isLoader(false);
      }
      //isLoader(false);
    }else if(contarctPayments.indexOf(payment_type) != -1) {
      const CONTRACT_ABI=getContractAbi(payment_type);
      const CONTRACT_ADDRESS=getContractAddress(payment_type);
      var finalAmount=amount;
      if(payment_type=="SAITAMA_ERC_20"){
        var perAmount=((amount*4)/100);
        finalAmount=(parseFloat(finalAmount)+parseFloat(perAmount));
        finalAmount=finalAmount.toFixed(4);
      }
      console.log(finalAmount);
      finalAmount=getUsdToConvertAmount(finalAmount,payment_type);
      console.log(payment_type);
      console.log(finalAmount);
      if(walletProviderName=="metamask"){
        const contract = new window.web3.eth.Contract(
          CONTRACT_ABI,
          CONTRACT_ADDRESS
        );
        var conUnit='ether';
        /*if(payment_type=='SAITAMA_ERC_20'){
          conUnit='gwei';
        }else if(payment_type=='USDT_ERC_20'){
          conUnit='mwei';
        }else if(payment_type=='USDT_BEP_20'){
          conUnit='ether';
        }else if(payment_type=='MAZI_ERC_20'){
          conUnit='wei';
        }*/
        finalAmount=window.web3.utils.toWei(finalAmount.toString(),conUnit);
        //console.log("UTLS finalAmount: "+finalAmount);
        contract.methods
          .transfer(receiverAddress,finalAmount)
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
            isLoader(false);
            resolve(res);
          })
          .catch((err) => {
            isLoader(false);
            reject(err);
          });
      }else if(walletProviderName=="wallet_connect"){
        const web3WC = new Web3(provider);
        const contract = new web3WC.eth.Contract(
          CONTRACT_ABI,
          CONTRACT_ADDRESS
        );
        finalAmount=web3WC.utils.toBN(finalAmount*Math.pow(10,18));
        contract.methods
          .transfer(receiverAddress,finalAmount)
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
            isLoader(false);
            resolve(res);
          })
          .catch((err) => {
            isLoader(false);
            reject(err);
          });
      }
    }
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
    return [{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"uint256","name":"minTokensBeforeSwap","type":"uint256"}],"name":"MinTokensBeforeSwapUpdated","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[],"name":"_burnFee","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"_marketingConverttoETH","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"_marketingETHFee","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"_marketingTokenFee","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"_maxTxAmount","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"_reflectionFee","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"_tradingEnabled","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"disableAllFees","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"enableAllFees","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"enableTrading","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"excludeFromFee","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"excludeFromReward","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"includeInFee","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"isExcludedFromFee","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"isExcludedFromReward","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"marketingETHFeeWallet","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"marketingTokenFeeWallet","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"numTokensSwapToETHForMarketing","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"_tokenAddr","type":"address"},{"internalType":"address","name":"_to","type":"address"},{"internalType":"uint256","name":"_amount","type":"uint256"}],"name":"recoverAnyERC20TokensFromContract","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"weiAmount","type":"uint256"}],"name":"recoverETHFromContract","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"tAmount","type":"uint256"},{"internalType":"bool","name":"deductTransferFee","type":"bool"}],"name":"reflectionFromToken","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"renounceOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newWallet","type":"address"}],"name":"setMarketingETHWallet","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newWallet","type":"address"}],"name":"setMarketingTokenWallet","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"maxAmountInTokensWithDecimals","type":"uint256"}],"name":"setMaxTxAmount","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bool","name":"_enabled","type":"bool"}],"name":"setmarketingConverttoETH","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenAmount","type":"uint256"}],"name":"setnumTokensSwapToETHForMarketing","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"rAmount","type":"uint256"}],"name":"tokenFromReflection","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalBurnFees","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalReflectionFees","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"uniswapV2Pair","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"uniswapV2Router","outputs":[{"internalType":"contract IUniswapV2Router02","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"stateMutability":"payable","type":"receive"}];
  }
}
/*var amountConvt=getUsdToConvertAmount(1,"SAITAMA_ERC_20");
console.log(amountConvt);*/
function getUsdToConvertAmount(amount, paymentType="ETH"){
  var covertUrl="";
  var amountKey="";
  if(paymentType=="ETH"){
    covertUrl="https://api.coingecko.com/api/v3/simple/price?ids=Ethereum&vs_currencies=usd";
    amountKey="ethereum";
  }else if(paymentType=="BNB"){
    covertUrl="https://api.coingecko.com/api/v3/simple/price?ids=binancecoin&vs_currencies=usd";
    amountKey="binancecoin";
  }else if(paymentType=="SAITAMA_ERC_20"){
    covertUrl="https://api.coingecko.com/api/v3/simple/price?ids=saitama-inu&vs_currencies=usd";
    amountKey="saitama-inu";
  }else if(paymentType=="MAZI_BEP_20"){
    covertUrl="https://api.coingecko.com/api/v3/simple/price?ids=mazimatic&vs_currencies=usd";
    amountKey="mazimatic";
  }
  const originalPayments=["USDT_BEP_20","USDT_ERC_20"];
  afterConvertAmount=amount;
  if(originalPayments.indexOf(paymentType) == -1) {
    var afterConvertAmount=0;
    $.ajax({
      type: 'get',
      url: covertUrl,
      async: false, 
      success: function (res) {
        convertRate=0;
        var dataString = JSON.stringify(res);
        var dataJSON = JSON.parse(dataString);
        convertRate=dataJSON[amountKey].usd;
        if(convertRate){
          convertRate=getFormartedValue(convertRate);
          console.log(convertRate);
          afterConvertAmount=(amount/convertRate);
        }
      },
      error: function (res) {
        console.log(res)
        afterConvertAmount=amount;
      }
    });
    console.log(afterConvertAmount);
    return afterConvertAmount.toFixed(4);
  }
  return afterConvertAmount;
}
function getFormartedValue(amount){
  return amount;
}

function noExponents(n){
  var data = String(n).split(/[eE]/);
  if (data.length == 1) return data[0];

  var z = '',
    sign = n < 0 ? '-' : '',
    str = data[0].replace('.', ''),
    mag = Number(data[1]) + 1;

  if (mag < 0) {
    z = sign + '0.';
    while (mag++) z += '0';
    return z + str.replace(/^\-/, '');
  }
  mag -= str.length;
  while (mag--) z += '0';
  return str + z;
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
    return "0xCE3f08e664693ca792caCE4af1364D5e220827B2";
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