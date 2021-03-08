var fees = 0;
var EAT_ABI = '';
var myAccountAddress = "";
//added by Hitesh >Start
  if(window.ethereum){
const oldProvider = web3.currentProvider; // keep a reference to metamask provider
var myweb3 = new Web3(oldProvider);
 ethereum.on('accountsChanged', handleAccountsChanged);
 function handleAccountsChanged (accounts) {

   if (accounts.length === 0) {

     // MetaMask is locked or the user has not connected any accounts
     console.log('Please connect to MetaMask.')

   } else if (accounts[0] !== myAccountAddress) {
    localStorage.setItem('myAccountAddress', accounts[0]);     
     window.location.href = "?userPublicAddress="+accounts[0];
//     // Run any other necessary logic...
   }
}
}else{
    const oldProvider = web3Infura.currentProvider; // keep a reference to metamask provider
    var myweb3 = new Web3(oldProvider);
}

function isLocked() {
   myweb3.eth.getAccounts(async function(err, accounts){
      if (err != null) {
         //console.log(err)
      }else if (accounts.length === 0) {
         localStorage.setItem('islocked', 0);
         localStorage.removeItem('myAccountAddress'); 
         myAccountAddress = null;
      }else {
        let state = localStorage.getItem('islocked'); 
        var my_Account = localStorage.getItem('myAccountAddress');
        var my_Account2 = accounts[0];
        if(my_Account!=null){
            my_Account = my_Account.toUpperCase();
            my_Account2 = my_Account2.toUpperCase();
            if(my_Account!==my_Account2){
                localStorage.setItem('myAccountAddress', accounts[0]);     
                window.location.href = "?userPublicAddress="+accounts[0];
            }else{
                localStorage.setItem('myAccountAddress', accounts[0]);     
            }
        }else{
            localStorage.setItem('myAccountAddress', accounts[0]);     
        }
        if(state==0 || state==null){
            localStorage.setItem('islocked', 1);
            location.reload(true);
        }
      }
   });
}
//added by Hitesh End


//Added by Yogesh - 01/11/19 - To convert logarithm value like 1e23 into 10000000..  Start----->
function logEtoDecimal(amountInLogE, decimal){
    
	amountInLogE = amountInLogE.toString();
	var noDecimalDigits = "";

	if(amountInLogE.includes("e-")){
		
		var splitString = amountInLogE.split("e-");	//split the string from 'e-'

		noDecimalDigits = splitString[0].replace(".", ""); //remove decimal point
		var zerosToAdd = splitString[1] - noDecimalDigits.length;

		for(var i=0; i < zerosToAdd; i++){
			noDecimalDigits += "0";
		}

		if(splitString[1] < decimal){
			return noDecimalDigits;
		}
		else{
			return 0;
		}
	}
	else if(amountInLogE.includes("e+")){

		var splitString = amountInLogE.split("e+");	//split the string from 'e+'

		noDecimalDigits = splitString[0].replace(".", ""); //remove decimal point
		var zerosToAdd = splitString[1]  - noDecimalDigits.length;

		for(var i=0; i <= zerosToAdd; i++){
			noDecimalDigits += "0";
		}
		return noDecimalDigits;
	}
  else if(amountInLogE.includes(".")){
    var splitString = amountInLogE.split("."); //split the string from '.'
    return splitString[0];
  }
	return amountInLogE;
}

//following function returns original value of logarithm value like 1e24
function logEtoLongNumber(amountInLogE){
    
  amountInLogE = amountInLogE.toString();
  var noDecimalDigits = "";

  if(amountInLogE.includes("e-")){
    
    var splitString = amountInLogE.split("e-"); //split the string from 'e-'

    noDecimalDigits = splitString[0].replace(".", ""); //remove decimal point

    //how far decimals to move
    var zeroString = "";
    for(var i=1; i < splitString[1]; i++){
      zeroString += "0";
    }

    return  "0."+zeroString+noDecimalDigits;
    
  }
  else if(amountInLogE.includes("e+")){

    var splitString = amountInLogE.split("e+"); //split the string from 'e+'
    var ePower = parseInt(splitString[1]);

    noDecimalDigits = splitString[0].replace(".", ""); //remove decimal point

    if(ePower >= noDecimalDigits.length-1){
      var zerosToAdd = ePower  - noDecimalDigits.length;

      for(var i=0; i <= zerosToAdd; i++){
        noDecimalDigits += "0";
      }

    }
    else{
      //this condition will run if the e+n is less than numbers
      var stringFirstHalf = noDecimalDigits.slice(0, ePower+1);
      var stringSecondHalf = noDecimalDigits.slice(ePower+1);

      return stringFirstHalf+"."+stringSecondHalf;
    }
    return noDecimalDigits;
  }
  return amountInLogE;  //by default it returns stringify value of original number if its not logarithm number
}

//Added by Yogesh - 01/11/19 - To convert logarithm value like 1e23 into 10000000..  END  ----->

$(document).ready(function(){
//display chart 
function chartData(){
    var postData = "token1="+selectedCurrencyContract + '&token2='+marketsAddress;
    $.ajax({
          url: "scripts/chartData.php",
          type: "post",
          data: postData,
          statusCode: {
              400: function() {
                  console.log( "400 Bad Request" );
                  return false;
              },
              403: function(){
                  console.log('403 Forbidden');
                  return false;
              },
              404: function() {
                console.log( "404 Not Found" );
                return false;
              },
              500: function() {
                  console.log("500 Internal Server Error");
              },
              502: function() {
                console.log( "502 Bad request" );
                return false;
              },
              503: function() {
                console.log( "503 Service Unavailable" );
                return false;
              },
              504: function() {
                console.log( "504 Gateway Timeout" );
                return false;
              }
    
            },
            success: function(data) {
                data = JSON.parse(data);
                if(data.result==true){
                  displayChart(data.orders);
                }
            
          }
      });
  }
setTimeout(chartData, 1000);
//setInterval(chartData,10000);
function displayChart(data){
	//document.getElementById('tradeChart').innerHTML ='';
	
    var chart = LightweightCharts.createChart(document.getElementById('tradeChart'), {
      width: 650,
        height: 300,
      layout: {
                backgroundColor: '#000000',
                textColor: 'rgba(255, 255, 255, 0.9)',
            },
            grid: {
                vertLines: {
                    color: 'rgba(197, 203, 206, 0.5)',
                },
                horzLines: {
                    color: 'rgba(197, 203, 206, 0.5)',
                },
            },
            crosshair: {
                mode: LightweightCharts.CrosshairMode.Normal,
            },
            rightPriceScale: {
                borderColor: 'rgba(197, 203, 206, 0.8)',
            },
            timeScale: {
                borderColor: 'rgba(197, 203, 206, 0.8)',
            },
    });

    var candleSeries = chart.addCandlestickSeries({
      upColor: '#28a745',
		  downColor: '#dc3545',
		  borderDownColor: '#dc3545',
		  borderUpColor: '#28a745',
		  wickDownColor: '#dc3545',
		  wickUpColor: '#28a745',
    });
	//if(data.length>0){
	    candleSeries.setData(data);
	//}
}

	//error messages display
var contractabi;
function Errormsgfunction(errormsg){
  var returnerrormsg;
  if(errormsg.indexOf("insufficient funds for gas * price + value") >= 0){
      returnerrormsg="You don't have suficient balance for gas value and ether";
  }else if(errormsg.indexOf("replacement transaction underpriced") >= 0){
      returnerrormsg="There is problem in token";
  }else if(errormsg.indexOf("Transaction ran out of gas. Please provide more gas:") >= 0){
      returnerrormsg="You don't have suficient Ether to pay for gas";
  }else if(errormsg.indexOf("nonce too low") >= 0){
      returnerrormsg="Your transaction nonce is too low try after some time";
  }else if(errormsg.indexOf("Your transaction is low") >= 0){
      returnerrormsg="Your transaction is low";
  }else if(errormsg.indexOf("invalid sender") >= 0){
      returnerrormsg="It seems you are using Private key with 0x Prefix. Kindly remove that 0x from private key and try again. To clear and refresh your account, you can visit this URL: /?clear";
  }else{
      returnerrormsg=errormsg.slice(0,100);
  }
  return returnerrormsg;
 }

function contractabifrometherscan(selectedCurrencyContract){
   var returnHtml;
   var abifrometherscan = '';
  jQuery.ajax({
    url: "https://api.etherscan.io/api?module=contract&action=getabi&address="+selectedCurrencyContract+"&apikey="+etherscanAPIKey,
    async: false, // <-- this forces the ajax call to be synchronous.
    cache: false,
    dataType: "html",
    success: function(html){ //<<-- This is where you get the ajax response
      returnHtml = html;
    }
  });
  var object = JSON.parse(returnHtml);
  if(object.status==1){
  		return JSON.parse(object.result);
  }else{
  	alert(object.result);
  	return false;
  }
}
  
function contractabifrometherscanTestNet(selectedCurrencyContract){
   var returnHtml;
   var abifrometherscan = '';
  jQuery.ajax({
    url: "https://api-rinkeby.etherscan.io/api?module=contract&action=getabi&address="+selectedCurrencyContract+"&apikey="+etherscanAPIKey,
    async: false, // <-- this forces the ajax call to be synchronous.
    cache: false,
    dataType: "html",
    success: function(html){ //<<-- This is where you get the ajax response
      returnHtml = html;
    }
  });
  var object = JSON.parse(returnHtml);
  if(object.status==1){
  		return JSON.parse(object.result);
  }else{
  	alert("Token selected is not verified in Etherscan. Please select another token");
  	return false;
  }
}
  
if (isTestNetNo === "No"){
    contractabi = contractabifrometherscan(selectedCurrencyContract);
}else{
  var t = getCookie('selectedCurrency');
  if(t=='EAT'){
     contractabi = arrayEATABI;
  }else{
    contractabi = contractabifrometherscanTestNet(selectedCurrencyContract); 
   }
  
}

//setting ethGasPrice in session storage if not exist
if(localStorage.getItem('ethGasPrice') === null ){
localStorage.setItem("ethGasPrice", ethGasPrice);
}
//fetching currenct blocknumber from web3Infura object

web3Infura.eth.getBlockNumber(function(error,result){
  if(!error){
    CurrentBlockNumber=result;
  }
});
//finding user's current address
    var usersdata = localStorage.getItem('EtherDelta');
    //checking if metamask is available
    if (typeof myweb3 !== 'undefined') {
      
          //MetaMask is connected
          //now getting address info of metamask account
          myweb3.eth.getAccounts(function(error, result) {
         if(result.length==0){
              window.ethereum.enable();
            }
          if(!error && typeof(result[0]) !== 'undefined'){
          var metaMaskAddress=""+result[0];
          myweb3.eth.getBalance(metaMaskAddress,function(error,balance){
          if(!error){
            balance = balance/1000000000000000000;
            balance = balance.toFixed(3);
          //now checking if local storage already have metamask record
          var metamaskInLocalStorage = "Unavailable";
          if(usersdata !== null){
            //metamask is there and there are entries in localstorage
            for(i=0;i<usersdata.accounts.length;i++)
            { //here checking that the metamask account already present in localstorage     
              if((usersdata.accounts[i].kind) == "MetaMask")
              {
                metamaskInLocalStorage = "Available";
                //also update the new address in case it was changed
                usersdata.accounts[i].addr = metaMaskAddress;
                usersdata.accounts[i].balance = balance;
                localStorage.setItem("EtherDelta", JSON.stringify(usersdata));
              }
            }
            //now adding new entry if metamask is not there
            if(metamaskInLocalStorage == "Unavailable")
            { 
              usersdata.accounts.push({addr : metaMaskAddress, kind:"MetaMask", balance:balance});
              usersdata.selectedAccount = usersdata.accounts.length - 1;
              localStorage.setItem("EtherDelta", JSON.stringify(usersdata));
            }
            else{ }
          }else{
            //metamask is there and nothing in localstorage
            var dataToPut = {accounts:[{addr:metaMaskAddress,kind:"MetaMask", balance: balance}], selectedAccount : "0"};
            localStorage.setItem("EtherDelta", JSON.stringify(dataToPut));
          }
          } 
      });
      }
      });
  
}
else{
  //metamask is not active or not installed
 //alertify.alert("Welcome To "+siteName+"!", "For easy to follow trading instructions please <a href='"+tradingHelpDoc+"' target='_blank'>CLICK HERE</a> before you get started.", function(){alertify.message('*VERY IMPORTANT, any digital representation of a pre-delivered sale (token) within Planetagro platform MUST BE BACKED BY A LEGAL GOVERMENT INVOICE and clear ICC incoterm agreement. This tokens purpose is to facilitate agroproducts trading and empower agriculture. Tokens are not meant for saving, investing, speculating or any other financial instrument and HAVE NO VALUE other than the legal sale they represent. Please verify your personal legal capability before interacting with this platform or write us to premiumservice@planetagro.org for more information.');});   
}

if(usersdata !== null){
      var tempStorage = "";
        usersdata=JSON.parse(usersdata);
        var selectedaccountnumber=usersdata['selectedAccount'];
        if(selectedaccountnumber >= 0 ){
        myAccountAddress=usersdata.accounts[selectedaccountnumber].addr;
      }
    }else{
        selectedaccountnumber = -2 ;
        myAccountAddress = "0x256e5eeda5A722F12d3594DDaD865BdEb1Fbff06";
    }
//creating Web3 Object for the main Extoke contract
var myContract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
    from: myAccountAddress, // default from address
    });
//get fees from contract
myContract.methods.tradingFee().call({from:myAccountAddress},function(error, result1){
    if(!error){   
        fees = result1/1000; 
        feeTakeInContract = fees;   
      }else{
        console.log(error);
      }
    });
myContract.methods.refPercent().call({from:myAccountAddress},function(error, result1){
    if(!error){   
        document.getElementById("referralPercentage").textContent=result1;   
      }else{
        console.log(error);
      }
    });
    
myContract.methods.referrerBonusBalance(myAccountAddress).call({from:myAccountAddress},function(error, result){
    if(!error){
      var result = result/1000000000000000000;
      result = logEtoLongNumber(result);
      num = result.toString(); //If it's not already a String
      dividend = num.slice(0, (num.indexOf("."))+7); //With 3 exposing the hundredths place
      document.getElementById("refBonusAvailable").textContent=dividend;

  }
  });

//updating Token balance in everywhere
myContract.methods.balanceOf(selectedCurrencyContract, myAccountAddress).call({from:myAccountAddress},function(error, result1){
    if(!error){
      var result = result1/Math.pow(10, selectedTokenDecimal); 
      result = logEtoLongNumber(result);
      userTokenbalanceOfSmartcontract=parseFloat(result);
      num = result.toString(); //If it's not already a String
      dividend = num.substring(0, 15); //With 3 exposing the hundredths place
      var totalItems = document.getElementsByClassName("balanceDisplayLabel");
      var currentValue = "";
      for (var i=0; i < totalItems.length; i++) {
        currentValue = totalItems[i].innerText;
        totalItems[i].innerHTML=dividend;
      }
  }
  });

myContract.methods.balanceOf(EtherAddress, myAccountAddress).call({from:myAccountAddress},function(error, result){
    if(!error){
      var result = result/1000000000000000000;
      result = logEtoLongNumber(result);
      userEtherBalanceOfSmartcontract=parseFloat(result);
      num = result.toString(); //If it's not already a String
    dividend = num.slice(0, (num.indexOf("."))+7); //With 3 exposing the hundredths place
      var totalItems = document.getElementsByClassName("Etherbalanceinsmartcontract");
      var currentValue = "";
      for (var i=0; i < totalItems.length; i++) {
        currentValue = totalItems[i].innerText;
        totalItems[i].innerHTML=dividend;
      }
  }
  });

web3Infura.eth.getBalance(myAccountAddress,function(error,result){
    if(!error)
    {
      var result = result/1000000000000000000;
      result = logEtoLongNumber(result);
      userEtherBalance=parseFloat(result);
      num = result.toString(); //If it's not already a String
      result = num.slice(0, (num.indexOf("."))+7);
      var totalItems = document.getElementsByClassName("EtherbalanceDisplayLabel");
      var currentValue = "";
      for (var i=0; i < totalItems.length; i++) {
        currentValue = totalItems[i].innerText;
        totalItems[i].innerHTML=result;
      }
    }
  });

  var othercontract = new web3Infura.eth.Contract(contractabi, selectedCurrencyContract, {
    from: myAccountAddress, // default from address
    });
    othercontract.methods.balanceOf(myAccountAddress).call({from: myAccountAddress}, function(error, result){
      if(!error)
      {
        var result = result/Math.pow(10, selectedTokenDecimal);
        result = logEtoLongNumber(result);

      	userTokenBalance=parseFloat(result);
      	result = result.substring(0, 15);
        var totalItems = document.getElementsByClassName("contractwalletbalance");
        var currentValue = "";
        for (var i=0; i < totalItems.length; i++) {
          currentValue = totalItems[i].innerText;
          totalItems[i].innerHTML=result;
        }
      }
  });

//get second token balance
if(selectedMarket!='ETH'){
  //updating Token balance in everywhere
myContract.methods.balanceOf(marketsAddress, myAccountAddress).call({from:myAccountAddress},function(error, result1){
    if(!error){
      var result = result1/Math.pow(10, marketDecimals);
      result = logEtoLongNumber(result);
      userTokenbalanceOfSmartcontract2=parseFloat(result);
      dividend = result.substring(0, 15);
      var totalItems = document.getElementsByClassName("balanceDisplayLabel2");
      var currentValue = "";
      for (var i=0; i < totalItems.length; i++) {
        currentValue = totalItems[i].innerText;
        totalItems[i].innerHTML=dividend;
      }
  }
  });

   var othercontract = new web3Infura.eth.Contract(marketsABI, marketsAddress, {
    from: myAccountAddress, // default from address
    });
    othercontract.methods.balanceOf(myAccountAddress).call({from: myAccountAddress}, function(error, result){
      if(!error)
      {
        var result = result/Math.pow(10, marketDecimals);
        result = logEtoLongNumber(result);
        userTokenBalance2=parseFloat(result);
        result = result.substring(0, 15);
        var totalItems = document.getElementsByClassName("contractwalletbalance2");
        var currentValue = "";
        for (var i=0; i < totalItems.length; i++) {
          currentValue = totalItems[i].innerText;
          totalItems[i].innerHTML=result;
        }
      }
  });
}

//drop down for account wallet start ------------------------------------->>>>
var selectedMainAccount = "";
var listOfAllAccounts = "";
//var displayAddress = "Etherscan Address";
if(usersdata !== null && usersdata['selectedAccount'] >= 0){
  if(usersdata.accounts[usersdata['selectedAccount']].kind === undefined){
  selectedMainAccount += '&nbsp;'+usersdata.accounts[usersdata['selectedAccount']].addr.substring(0,10)+'...&nbsp;<span class="badge"><span class="EtherbalanceDisplayLabel"> </span> ETH</span>&nbsp;<span class="label label-success">'+siteName+'  (Private Key)</span><span class="caret"></span>';
  }
  else{
    selectedMainAccount += '&nbsp;'+usersdata.accounts[usersdata['selectedAccount']].addr.substring(0,10)+'...&nbsp;<span class="badge"><span class="Ether`"> </span> ETH</span>&nbsp;<span class="label label-success">MetaMask</span><span class="caret"></span>';
  }
  for(var i = 0; i < usersdata.accounts.length; i++){
    var balance = '0.000';
    if(typeof(usersdata.accounts[i].balance) !== 'undefined'){
      balance = usersdata.accounts[i].balance;
    }

    if(usersdata.accounts[i].kind === undefined){
    listOfAllAccounts += '<li><a href="javascript:;" class="listOfAllAccountsClass " value="'+i+'">'+usersdata.accounts[i].addr+'&nbsp;<span class="badge">'+balance+' ETH</span>&nbsp;<span class="label label-success">'+siteName+'  (Private Key)</span></a></li>';
    }
    else{
      listOfAllAccounts += '<li><a href="javascript:;" class="listOfAllAccountsClass" value="'+i+'">'+usersdata.accounts[i].addr+'&nbsp;<span class="badge">'+balance+' ETH</span>&nbsp;<span class="label label-success">MetaMask</span></a></li>';
      //displayAddress = usersdata.accounts[0].addr;
    }
  }  
}
else{
  selectedMainAccount += ' <span class="fa fa-user" aria-hidden="true" style="margin-right: 6px;"></span>         <span class="select-acc">Select Account</span>         <span class="caret" style="margin-left: 5px;"></span>';
  listOfAllAccounts = "";
}

var accountMenu = '<div id="accounts-custom2" class="switcher switcher-menu_extra dropdown">  <div class="btn-group">'; 
accountMenu += '<button  class="btn btn-default btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 15px 20px;color: #fff;font-size: 14px;font-weight: 300;font-family: Open Sans,sans-serif;background-color: transparent!important;line-height: 20px;"><i class="fa fa-user" aria-hidden="true" style="margin-right: 6px;display:none;"></i> <span class="select-acc" style="text-transform: capitalize;"> '+selectedMainAccount+' </span>  </button>';
accountMenu += '<ul class="dropdown-menu">';
accountMenu += listOfAllAccounts;
accountMenu += '<li role="separator" class="divider"></li><li> <a id="accounts-new_account"> <span class="trn"  data-trn-key="new_account">New account</span> </a> </li> <li> <a href="javascript:;" id="accounts-import-account"> <span class="trn" data-trn-key="import_account">Import account</span> </a> </li> ';
if(selectedaccountnumber >= 0){
//accountMenu += '<li><a href="javascript:;" id="accounts-etherscan"> <span class="trn" data-trn-key="gas_price">'+displayAddress+'</span> </a> </li><li><a href="javascript:;" id="accounts-export-private-key"> <span class="trn" data-trn-key="gas_price">Export Private Key</span> </a> </li><li><a href="javascript:;" id="accounts-forget-account"> <span class="trn" data-trn-key="gas_price">Forget Account</span> </a> </li>';
accountMenu += '<li><a href="javascript:;" id="accounts-export-private-key"> <span class="trn" data-trn-key="gas_price">Export Private Key</span> </a> </li><li><a href="javascript:;" id="accounts-forget-account"> <span class="trn" data-trn-key="gas_price">Forget Account</span> </a> </li>';
}
accountMenu += '<li><a href="javascript:;" id="accounts-gas-price"> <span class="trn" data-trn-key="gas_price">Gas price</span> </a> </li> </ul>';
accountMenu += '</ul></div></div>';
document.getElementById("accounts-custom").innerHTML = accountMenu;

//drop down for account wallet END ------------------------------------->>>>
//select new account from account menu
$(".listOfAllAccountsClass").click(function(){
  //document.getElementsById("accounts-dropdown-menu-list").style.display = "none";
  var index = $(this).attr('value');
  usersdata.selectedAccount = index;
  localStorage.setItem("EtherDelta", JSON.stringify(usersdata));
  //console.log(usersdata);
  window.location.href="/?userPublicAddress="+usersdata.accounts[index].addr;
});
//account dropdown functions
$("#accounts-new_account").click(function(){
    //creating new account
        var new_account = web3Infura.eth.accounts.create();
        var publicKey = new_account.address;
        var privateKey = new_account.privateKey;
        privateKey=privateKey.slice(2);
        var accountData = [];
        accountData.push({addr : publicKey, pk : privateKey, balance: '0.000'});
        //now putting data in local storage. First check it localstorage is available
        if (typeof(Storage) !== "undefined") {
        //we will check if it is first time, then add. If other addresses exist, then add accordingly
        if(usersdata !== null){
          //pushing new account data in existing accounts array
          usersdata.accounts.push({addr : publicKey, pk : privateKey, balance : '0.000'});
          usersdata.selectedAccount = usersdata.accounts.length - 1;
          localStorage.setItem("EtherDelta", JSON.stringify(usersdata));
        }
        else{
          var dataToStore = {accounts : accountData, selectedAccount : 0};
          localStorage.setItem("EtherDelta", JSON.stringify(dataToStore));
        }
        alertify.alert("Success", '<div class="ajs-content">You created a new Ethereum account.<br><b>Account Address:</b> '+publicKey+'<br><br><strong><i class="fa fa-exclamation-triangle" style="color:rgb(230,162,38)" aria-hidden="true"></i> To control your account, you need the Private Key. SAVE it now!</strong><br><b>Private Key:</b> '+privateKey+'<br><br>If you lose your Private Key, you cannot restore it.</div>', function(){
            window.location.href="/?userPublicAddress="+usersdata.accounts[usersdata.selectedAccount].addr;
          });
        }
        else{
          alertify.alert("Error", "This browser does not support Local Storage. Please enable it or use upgraded browser!", function(){
            window.location.reload();
          });
        }

});

$("#accounts-import-account").click(function(){
    alertify.alert('Import Account', '<form autocomplete="off"><div class="form-group"><label class="trn" data-trn-key="address">Public Address</label><input type="text" class="form-control" placeholder="0x..." id="import-public-key"></div><div id="pkDiv"><div class="form-group"><label class="trn" data-trn-key="private_key">Private key</label><input type="text" class="form-control" placeholder="0x..." id="import-private-key"></div></div></form>', function(){
          var publicKey = document.getElementById("import-public-key").value;
          var privateKey = document.getElementById("import-private-key").value;
          //checking whether public address and private key are valid or not
          try {
            //checking private key
            var userWallet = web3Infura.eth.accounts.privateKeyToAccount(privateKey);
            //if private key will not be valid, then it will throw

            //checking if public address is valid
            if(web3Infura.utils.isAddress(publicKey) === true){
              //here fetching the account form metamask
            web3Infura.eth.getBalance(publicKey,function(error,balance){
            if(!error){
              //now lets continue..
              balance = balance/1000000000000000000;
              balance = balance.toFixed(3);
              var accountData = [];
              accountData.push({addr : publicKey, pk : privateKey, balance : balance});
              //now putting data in local storage. First check it localstorage is available
              if (typeof(Storage) !== "undefined") {
              //we will check if it is first time, then add. If other addresses exist, then add accordingly
              if(usersdata !== null){
                //pushing new account data in existing accounts array
                usersdata.accounts.push({addr : publicKey, pk : privateKey, balance:balance});
                usersdata.selectedAccount = usersdata.accounts.length - 1;
                localStorage.setItem("EtherDelta", JSON.stringify(usersdata));
              }
              else{
                var dataToStore = {accounts : accountData, selectedAccount : 0};
                localStorage.setItem("EtherDelta", JSON.stringify(dataToStore));
              }
              alertify.success("Account Imported and enabled");
              window.location.href="/?userPublicAddress="+usersdata.accounts[usersdata.selectedAccount].addr;
              }
              else{
                alertify.alert("Error", "This browser does not support Local Storage. Please enable it or use upgraded browser!", function(){
                  window.location.reload();
                });
              }

              }
            });
            }
            else{
              alert("Public Address is Incorrect!");
              window.location.reload();
            }
            
          }
          catch(err) {
              alert("Private Key is Incorrect!");
              window.location.reload();
          }       
        });
});

$("#accounts-etherscan").click(function(){
  var index = usersdata.selectedAccount;
  var address = usersdata.accounts[index].addr;
  window.open(etherscanAddressURL+address, '_blank');
});

$("#accounts-export-private-key").click(function(){
  var index = usersdata.selectedAccount;
  var publicKey = usersdata.accounts[index].addr;
  var privateKey = usersdata.accounts[index].pk;
  alertify.alert("Success", '<div class="ajs-content">For account '+publicKey+', the private key is '+privateKey+'.</div>', function(){});
});

$("#accounts-forget-account").click(function(){
  var index = usersdata.selectedAccount;
  var publicKey = usersdata.accounts[index].addr;
  var privateKey = usersdata.accounts[index].pk;
  console.log(usersdata.accounts.length);
 if(usersdata.accounts.length == 1){
 
  alertify.confirm("Forget account?",'<div class="ajs-content">You are about to remove an Ethereum account: '+publicKey+'<br><br><strong><i class="fa fa-exclamation-triangle" style="color:rgb(230,162,38)" aria-hidden="true"></i> To withdraw funds from this account in the future, you will need the Private Key. SAVE it now!</strong><br><b>Private Key:</b> '+privateKey+'<br><br>If you lose the Private Key, you cannot restore it.</div>',
  function(){
      /*
    usersdata.accounts.splice( index, 1 );
    usersdata.selectedAccount = usersdata.accounts.length - 1;
    localStorage.setItem("EtherDelta", JSON.stringify(usersdata));
    alertify.success('Account Removed');
  window.localStorage.clear();
  */
   window.location.href="/?clear";
  },
  function(){
    alertify.error('Cancelled');
  });
 
 }else{
   alertify.confirm("Forget account?",'<div class="ajs-content">You are about to remove an Ethereum account: '+publicKey+'<br><br><strong><i class="fa fa-exclamation-triangle" style="color:rgb(230,162,38)" aria-hidden="true"></i> To withdraw funds from this account in the future, you will need the Private Key. SAVE it now!</strong><br><b>Private Key:</b> '+privateKey+'<br><br>If you lose the Private Key, you cannot restore it.</div>',
  function(){
    usersdata.accounts.splice( index, 1 );
    usersdata.selectedAccount = usersdata.accounts.length - 1;
    localStorage.setItem("EtherDelta", JSON.stringify(usersdata));
    alertify.success('Account Removed');
    window.location.href="/?userPublicAddress="+usersdata.accounts[usersdata.selectedAccount].addr;
  },
  function(){
    alertify.error('Cancelled');
  });
 }
});

$("#accounts-gas-price").click(function(){
  var defaultGasPrice = localStorage.getItem('ethGasPrice');
  var trueDefaultGasPrice = defaultGasPrice / 1000000000 ;
  alertify.alert("Set Gas Price", '<form><div class="form-group"><label class="trn" data-trn-key="gas_price_gwei">Gas price (gwei)</label><input type="text" class="form-control" value="'+trueDefaultGasPrice+'" id="setGasPrice"></div></form>', function(){
    var newGasPrice = document.getElementById("setGasPrice").value;
    if(isNaN(newGasPrice)){
      alertify.error('Input must be Numeric!');
     }
     else if(newGasPrice <= 0){
      alertify.error('Gas price must be Positive!');
     }
     else{
      var trueNewGasPrice = newGasPrice * 1000000000 ;
      localStorage.setItem('ethGasPrice', JSON.stringify(trueNewGasPrice));
      alert('Gas Price Updated');
      window.location.reload();
     }          
  });
});
  //this code is for deposit token
  $("#tokendeposit").on('click', async function(){
    const web3GasPrice = await myweb3.eth.getGasPrice();

    var amountoftoken = document.getElementById('amountoftokendeposit').value;
    var status="OK";
    if (isNaN(amountoftoken))
    {
       alertify.error("Please enter valid amount!");
       status="NOTOK";
    }
    if(amountoftoken <= 0)
    {
      alertify.error("Please enter valid amount!");
      status="NOTOK";
    }
    if(amountoftoken > userTokenBalance)
    {
      alertify.error("You don't have sufficient token to deposit!");
      status="NOTOK";
    }
    if(status == "OK")
    {
        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        //finding user's current address
        web3Infura.eth.getAccounts().then(async function(receipt){
        var myAccountAddress = receipt.toString();
        var othercontract = new web3Infura.eth.Contract(contractabi, selectedCurrencyContract, {
        from: myAccountAddress, // default from address
        });
        
          amountoftoken=amountoftoken * Math.pow(10, selectedTokenDecimal);
          amountoftoken = logEtoDecimal(amountoftoken, selectedTokenDecimal);
          amountoftoken=web3Infura.utils.toHex(amountoftoken);

        //check for allowance
        var allowance = await othercontract.methods.allowance(myAccountAddress,mainContractAddress).call();
        

        if(allowance<=1000){
          var totalSupplyofToken = await othercontract.methods.totalSupply().call();
          
        //here calling approve function of other token contract
         

        var data = othercontract.methods.approve(mainContractAddress,totalSupplyofToken).encodeABI();
        web3Infura.eth.sendTransaction({
        from: myAccountAddress,
        to: selectedCurrencyContract,
        //gasPrice: localStorage.getItem('ethGasPrice'),
        gasPrice: web3GasPrice,
        gasLimit: gasApprove,
        data: data, // deploying a contracrt
        }).on('transactionHash', function(hash){
            alertify.alert("Token Deposit Step 1 Processed","The first step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> You will be taken to Step 2 when step 1 process completed!", function(){
            document.getElementById('tokenDepositLoaderDiv').style.display="block";
            });
        })
        .on('receipt', function(receipt){
          if(receipt.status == true){
            //deposit token in smart contract
            web3Infura.eth.getAccounts().then(function(receipt){
            var myAccountAddress = receipt.toString();
            // here checking the particulart token balance in etherdelta smart contract
          var data = myContract.methods.depositToken(selectedCurrencyContract,amountoftoken).encodeABI();
          web3Infura.eth.sendTransaction({
          from: myAccountAddress,
          to: mainContractAddress,
          //gasPrice: localStorage.getItem('ethGasPrice'),
          gasPrice: web3GasPrice,
          gasLimit: gasDeposit,
          data: data, // deploying a contracrt
          }).on('transactionHash', function(hash){
            alertify.alert("Token Deposit Step 1 Processed","The first step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> You will be taken to Step 2 when step 1 process completed!", function(){
            document.getElementById('tokenDepositLoaderDiv').style.display="block";
            });
        }).on('receipt', function(receipt){
            alertify.alert('Transaction Success', 'Token Deposited.', function(){
            	document.getElementById('tokenDepositLoaderDiv').style.display="none";
            	window.location.reload();
            });
        	document.getElementById('tokenDepositLoaderDiv').style.display="none";
        
          }).on('error', function(error){
            var ErrorMsg=error.message;
            ErrorMsg=Errormsgfunction(ErrorMsg);
            //ErrorMsg=ErrorMsg.slice(0,100);
          alertify.alert("Transaction Aborted", ""+ErrorMsg, function(){
              window.location.reload();
          });
          document.getElementById('tokenDepositLoaderDiv').style.display="none";
          });
          });
          }
        });
      }else{
        //if there is enough allowance then dirctly deposit
          //deposit token in smart contract
            web3Infura.eth.getAccounts().then(function(receipt){
            var myAccountAddress = receipt.toString();
            // here checking the particulart token balance in etherdelta smart contract
            var data = myContract.methods.depositToken(selectedCurrencyContract,amountoftoken).encodeABI();
            web3Infura.eth.sendTransaction({
            from: myAccountAddress,
            to: mainContractAddress,
            //gasPrice: localStorage.getItem('ethGasPrice'),
            gasPrice: web3GasPrice,
            gasLimit: gasDeposit,
            data: data, // deploying a contracrt
            }).on('transactionHash', function(hash){
              alertify.alert("Token Deposit Step 1 Processed","The first step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> You will be taken to Step 2 when step 1 process completed!", function(){
              document.getElementById('tokenDepositLoaderDiv').style.display="block";
              });
          }).on('receipt', function(receipt){
              alertify.alert('Transaction Success', 'Token Deposited.', function(){
                document.getElementById('tokenDepositLoaderDiv').style.display="none";
                window.location.reload();
              });
            document.getElementById('tokenDepositLoaderDiv').style.display="none";
          
            }).on('error', function(error){
              var ErrorMsg=error.message;
              ErrorMsg=Errormsgfunction(ErrorMsg);
              //ErrorMsg=ErrorMsg.slice(0,100);
            alertify.alert("Transaction Aborted", ""+ErrorMsg, function(){
                window.location.reload();
            });
            document.getElementById('tokenDepositLoaderDiv').style.display="none";
            });
            });

      }
      });
     }
     else
     {
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x") 
        {             
            privateKey = "0x"+privateKeywithouthex;         
        }
        var othercontract = new web3Infura.eth.Contract(contractabi, selectedCurrencyContract, {
        from: myAccountAddress, // default from address
        });
        var amountoftoken1=Math.pow(10,selectedTokenDecimal);
        amountoftoken1 = logEtoDecimal(amountoftoken1, selectedTokenDecimal);
        amountoftoken1 =  amountoftoken*amountoftoken1;
        amountoftoken1=web3Infura.utils.toHex(amountoftoken1);

         //check for allowance
        var allowance = await othercontract.methods.allowance(myAccountAddress,mainContractAddress).call();
        

        if(allowance<=1000){
          var totalSupplyofToken = await othercontract.methods.totalSupply().call();

        var data = othercontract.methods.approve(mainContractAddress,totalSupplyofToken).encodeABI();
            web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
      
          if(!error){
            var nonce = result.toString();
            var raw = {
            "nonce":web3Infura.utils.toHex(nonce),
            "from": myAccountAddress,
              "to": selectedCurrencyContract,
              //"gasPrice": localStorage.getItem('ethGasPrice'),
              "gasPrice" : web3GasPrice,
              "gasLimit": gasDeposit,
              "data": data, // deploying a contracrt
              "chainId":chainID
            };
            web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
            if(!error){
              var serializedTx=result.rawTransaction;
              web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
              .on('transactionHash', function(hash){
                alertify.alert("Token Deposit Initiated","<a href='"+etherscanTxURL+hash+"' target='_blank'>Click Here to check transaction status at Etherscan</a><br><br>", function(){
                document.getElementById('tokenDepositLoaderDiv').style.display="block";
                });
            }).on('receipt', function(receipt){
             if(receipt.status == true){
    			var data = myContract.methods.depositToken(selectedCurrencyContract,amountoftoken1).encodeABI();
    			web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
    				if(!error){
    				var nonce = result.toString();
    				var raw = {
    				"nonce":web3Infura.utils.toHex(nonce),
    				"from": myAccountAddress,
    				"to": mainContractAddress,
    				//"gasPrice": localStorage.getItem('ethGasPrice'),
            "gasPrice" : web3GasPrice,
    				"gasLimit": gasDeposit,
    				"data": data, // deploying a contracrt
    				"chainId":chainID
    				};

    				web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
    					if(!error)
    					{
    						var serializedTx=result.rawTransaction;
    						web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
    						.on('transactionHash', function(hash){
                alertify.alert("Token Deposit Step 1 Processed","The second step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> ", function(){
                document.getElementById('tokenDepositLoaderDiv').style.display="block";
                });
            }).on('receipt', function(receipt){
    					
    						alertify.alert('Transaction Success', 'Token Deposited.', function(){
    						document.getElementById('tokenDepositLoaderDiv').style.display="none";
    						window.location.reload();
    						});
    						document.getElementById('tokenDepositLoaderDiv').style.display="none";
    					
    					}).on('error', function(error){ 
    					    var ErrorMsg=error.message;
                            ErrorMsg=Errormsgfunction(ErrorMsg);
                            //ErrorMsg=ErrorMsg.slice(0,100);
    					alertify.alert("Transaction Cancelled",""+ErrorMsg, function(){
    					    window.location.reload();
    					});
    					document.getElementById('tokenDepositLoaderDiv').style.display="none";
    					});
    				  }
    				});
    			   }
    			});
    			
    		 }
    		});
    		}
    	  });
    	 }
    	});
      }else{
        // if allowance is great then direct deposit tokens
          web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
        
            if(!error){
              var nonce = result.toString();
              var raw = {
              "nonce":web3Infura.utils.toHex(nonce),
              "from": myAccountAddress,
                "to": selectedCurrencyContract,
                //"gasPrice": localStorage.getItem('ethGasPrice'),
                "gasPrice" : web3GasPrice,
                "gasLimit": gasDeposit,
                "data": data, // deploying a contracrt
                "chainId":chainID
              };
              web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
              if(!error){
                var serializedTx=result.rawTransaction;
                web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
                .on('transactionHash', function(hash){
                  alertify.alert("Token Deposit Initiated","<a href='"+etherscanTxURL+hash+"' target='_blank'>Click Here to check transaction status at Etherscan</a><br><br>", function(){
                  document.getElementById('tokenDepositLoaderDiv').style.display="block";
                  });
              }).on('receipt', function(receipt){
               if(receipt.status == true){
            var data = myContract.methods.depositToken(selectedCurrencyContract,amountoftoken1).encodeABI();
            web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
              if(!error){
              var nonce = result.toString();
              var raw = {
              "nonce":web3Infura.utils.toHex(nonce),
              "from": myAccountAddress,
              "to": mainContractAddress,
              //"gasPrice": localStorage.getItem('ethGasPrice'),
              "gasPrice" : web3GasPrice,
              "gasLimit": gasDeposit,
              "data": data, // deploying a contracrt
              "chainId":chainID
              };

              web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
                if(!error)
                {
                  var serializedTx=result.rawTransaction;
                  web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
                  .on('transactionHash', function(hash){
                  alertify.alert("Token Deposit Step 1 Processed","The second step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> ", function(){
                  document.getElementById('tokenDepositLoaderDiv').style.display="block";
                  });
              }).on('receipt', function(receipt){
                
                  alertify.alert('Transaction Success', 'Token Deposited.', function(){
                  document.getElementById('tokenDepositLoaderDiv').style.display="none";
                  window.location.reload();
                  });
                  document.getElementById('tokenDepositLoaderDiv').style.display="none";
                
                }).on('error', function(error){ 
                    var ErrorMsg=error.message;
                              ErrorMsg=Errormsgfunction(ErrorMsg);
                              //ErrorMsg=ErrorMsg.slice(0,100);
                alertify.alert("Transaction Cancelled",""+ErrorMsg, function(){
                    window.location.reload();
                });
                document.getElementById('tokenDepositLoaderDiv').style.display="none";
                });
                }
              });
               }
            });
            
           }
          });
          }
          });
         }
        });
      }
	
  }
  }
});	  
   //this code is for withdraw second token - This is for market token
  $("#withdrawtokenbutton2").click(async function(){
    const web3GasPrice = await myweb3.eth.getGasPrice();

    var amountoftoken=document.getElementById('withdrawtoken2').value;
    var amount_of_token = amountoftoken;
    var status="OK";
    if(amountoftoken > userTokenbalanceOfSmartcontract2)
    {
      alertify.error("You don't have sufficient token to withdraw!");
      status="NOTOK";
    }
    if(amountoftoken <= 0)
    {
      alertify.error("Please enter more then 0!");
      status="NOTOK";
    }
    if (isNaN(amountoftoken))
    {
       alertify.error("Please enter valid amount !");
       status="NOTOK";
    }
    if(status == "OK")
    {
     var web3Infura = new Web3(Web3.givenProvider || ethProvider);
      var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {  
      //deposit ether in smart contract
        web3Infura.eth.getAccounts().then(function(receipt){
        var myAccountAddress = receipt.toString();

        amountoftoken=amountoftoken * Math.pow(10,marketDecimals);
        amountoftoken = logEtoDecimal(amountoftoken, marketDecimals);
        amountoftoken=web3Infura.utils.toHex(amountoftoken);
        var data = myContract.methods.withdrawToken(marketsAddress,amountoftoken).encodeABI();
        web3Infura.eth.sendTransaction({
        from: myAccountAddress,
        to: mainContractAddress,
        //gasPrice: localStorage.getItem('ethGasPrice'),
        gasPrice :web3GasPrice,
        gasLimit: gasWithdraw,
        data: data, // deploying a contracrt
        }).on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
        
            alertify.alert('Transaction Success', 'Token withdrawn successfully', function(){
              window.location.reload();
            });
          }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
      }); 
      }
      else
      {
         //Token tarnsfer from other account
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        //var privateKey = new Buffer(privateKeywithouthex , 'hex');
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x")
        {             
            privateKey = "0x"+privateKeywithouthex;         
        }

        var othercontract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
        from: myAccountAddress, // default from address
        });
        //here checking the particulart token balance in etherdelta smart contract
        amountoftoken=amountoftoken * Math.pow(10,marketDecimals);
        amountoftoken = logEtoDecimal(amountoftoken, marketDecimals);
        amountoftoken=web3Infura.utils.toHex(amountoftoken);
        var data = myContract.methods.withdrawToken(marketsAddress,amountoftoken).encodeABI();
        web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
      if(!error){
        var nonce = result.toString();
        var raw = {
        "nonce":web3Infura.utils.toHex(nonce),
        "from": myAccountAddress,
          "to": mainContractAddress,
          //"gasPrice": localStorage.getItem('ethGasPrice'),
          "gasPrice" : web3GasPrice,
          "gasLimit": gasDeposit,
          "data": data, // deploying a contracrt
          "chainId":chainID
        };
        web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
        if(!error)
        {
          var serializedTx=result.rawTransaction;
          web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
          .on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
         
            alertify.alert('Transaction Success', 'Token withdrawn successfully.', function(){
              window.location.reload();
            });
         
        }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             //ErrorMsg=ErrorMsg.slice(0,100);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
        }
      });
        }
    }); 
      }
    }
  });  
  //this code is for withdraw token
  $("#withdrawtokenbutton").click(async function(){
    const web3GasPrice = await myweb3.eth.getGasPrice();
    var amountoftoken=document.getElementById('withdrawtoken').value;
    var amount_of_token = amountoftoken;
    var status="OK";
    if(amountoftoken > userTokenbalanceOfSmartcontract)
    {
      alertify.error("You don't have sufficient token to withdraw!");
      status="NOTOK";
    }
    if(amountoftoken <= 0)
    {
      alertify.error("Please enter more then 0 ether!");
      status="NOTOK";
    }
    if (isNaN(amountoftoken))
    {
       alertify.error("Please enter valid amount !");
       status="NOTOK";
    }
    if(status == "OK")
    {
     var web3Infura = new Web3(Web3.givenProvider || ethProvider);
      var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {  
      //deposit ether in smart contract
        web3Infura.eth.getAccounts().then(function(receipt){
          var myAccountAddress = receipt.toString();
         
        amountoftoken=amountoftoken * Math.pow(10,selectedTokenDecimal);
        amountoftoken = logEtoDecimal(amountoftoken, selectedTokenDecimal);
        amountoftoken=web3Infura.utils.toHex(amountoftoken);

        var data = myContract.methods.withdrawToken(selectedCurrencyContract,amountoftoken).encodeABI();
        web3Infura.eth.sendTransaction({
        from: myAccountAddress,
        to: mainContractAddress,
        //gasPrice: localStorage.getItem('ethGasPrice'),
        gasPrice : web3GasPrice,
        gasLimit: gasWithdraw,
        data: data, // deploying a contracrt
        }).on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
        
            alertify.alert('Transaction Success', 'Token withdrawn successfully', function(){
              window.location.reload();
            });
            
        
          }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             //ErrorMsg=ErrorMsg.slice(0,100);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
      }); 
      }
      else
      {
        //Token tarnsfer from other account
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x")
        {             
            privateKey = "0x"+privateKeywithouthex;         
        }

        var othercontract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
        from: myAccountAddress, // default from address
        });
        //here checking the particulart token balance in etherdelta smart contract
        amountoftoken=amountoftoken * Math.pow(10,selectedTokenDecimal);
        amountoftoken = logEtoDecimal(amountoftoken, selectedTokenDecimal);
        amountoftoken=web3Infura.utils.toHex(amountoftoken);
        var data = myContract.methods.withdrawToken(selectedCurrencyContract,amountoftoken).encodeABI();
        web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
      if(!error){
        var nonce = result.toString();
        var raw = {
        "nonce":web3Infura.utils.toHex(nonce),
        "from": myAccountAddress,
          "to": mainContractAddress,
          //"gasPrice": localStorage.getItem('ethGasPrice'),
          "gasPrice" : web3GasPrice,
          "gasLimit": gasDeposit,
          "data": data, // deploying a contracrt
          "chainId":chainID
        };
        web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
        if(!error)
        {
          var serializedTx=result.rawTransaction;
          web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
          .on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
         
            alertify.alert('Transaction Success', 'Token withdrawn successfully.', function(){
              window.location.reload();
            });
         
        }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             //ErrorMsg=ErrorMsg.slice(0,100);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
        }
      });
        }
    }); 
      }
    }
  });
//this code is for transfer second token 
  $("#tokentransferbutton2").click(async function(){
    const web3GasPrice = await myweb3.eth.getGasPrice();
    var web3Infura = new Web3(Web3.givenProvider || ethProvider);
    var amountoftoken=document.getElementById('tokentransferamount2').value;
    var destinationaddress=document.getElementById('tokentransferdestinationaddress2').value;
    var status="OK";
    console.log(userTokenBalance2);
    if(amountoftoken <= 0)
    {
      alertify.error("Please enter more then 0 token!");
      status="NOTOK";
    }
    if (isNaN(amountoftoken))
    {
      alertify.error("Please enter valid amount !");
      status="NOTOK";
    }
    if(amountoftoken > userTokenBalance2)
    {
      alertify.error("You don't have sufficient token to transefer !");
      status="NOTOK";
    }
    //checking owner address is valid or not
    var answerinbool=web3Infura.utils.isAddress(destinationaddress);
    var answerinstring=""+answerinbool;    
    if(answerinstring == "false")
    {
        alertify.error("Please enter true destination Address !");
        status="NOTOK";
    }
    if(status == "OK"){
        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {
        //finding user's current address
        web3Infura.eth.getAccounts().then(function(receipt){
        var myAccountAddress = receipt.toString();
        var othercontract = new web3Infura.eth.Contract(marketsABI, marketsAddress, {
        from: myAccountAddress, // default from address
      });
      //here checking the particulart token balance in etherdelta smart contract
        amountoftoken=amountoftoken * Math.pow(10,marketDecimals);
        amountoftoken = logEtoDecimal(amountoftoken, marketDecimals);
        amountoftoken=web3Infura.utils.toHex(amountoftoken);

        var data = othercontract.methods.transfer(destinationaddress,amountoftoken).encodeABI();
        web3Infura.eth.sendTransaction({
        from: myAccountAddress,
        to: marketsAddress,
        //gasPrice: localStorage.getItem('ethGasPrice'),
        gasPrice : web3GasPrice,
        gasLimit: gasDeposit,
        data: data, // deploying a contracrt
        }, function(error, result){
        alertify.alert("Transaction Hash","Please check the status of Transaction at: <a href='"+etherscanTxURL+result+"' target='_blank'>Etherscan</a>", function(){});
      });
      });
      }
      else
      {
        //wToken tarnsfer from other account
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        //var privateKey = new Buffer(privateKeywithouthex , 'hex');
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x")         
        {             
            privateKey = "0x"+privateKeywithouthex;         
        }
        var othercontract = new web3Infura.eth.Contract(marketsABI, marketsAddress, {
        from: myAccountAddress, // default from address
        });
        //here checking the particulart token balance in etherdelta smart contract
        amountoftoken=amountoftoken * Math.pow(10,marketDecimals);
        amountoftoken = logEtoDecimal(amountoftoken, marketDecimals);
        amountoftoken=web3Infura.utils.toHex(amountoftoken);
        var data = othercontract.methods.transfer(destinationaddress,amountoftoken).encodeABI();
        
        web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
      if(!error){
        var nonce = result.toString();
        var raw = {
        "nonce":web3Infura.utils.toHex(nonce),
        "from": myAccountAddress,
          "to": marketsAddress,
          //"gasPrice": localStorage.getItem('ethGasPrice'),
          gasPrice : web3GasPrice,
          "gasLimit": gasDeposit,
          "data": data, // deploying a contracrt
          "chainId":chainID
        };
        web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
        if(!error)
        {
          var serializedTx=result.rawTransaction;
          web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
          .on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
         
            alertify.alert('Transaction Success', 'Token transfered.', function(){
              window.location.reload();
            });
         
        }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
        }
      });
        }
    });
      }
    }
  });
  //this code is for transfer token 
  $("#tokentransferbutton").click(async function(){
     const web3GasPrice = await myweb3.eth.getGasPrice();
 
    var web3Infura = new Web3(Web3.givenProvider || ethProvider);
    var amountoftoken=document.getElementById('tokentransferamount').value;
    var destinationaddress=document.getElementById('tokentransferdestinationaddress').value;
    var status="OK";
    if(amountoftoken <= 0)
    {
      alertify.error("Please enter more then 0 ether!");
      status="NOTOK";
    }
    if (isNaN(amountoftoken))
    {
      alertify.error("Please enter valid amount !");
      status="NOTOK";
    }
    if(amountoftoken > userTokenBalance)
    {
      alertify.error("You don't have sufficient token to transefer !");
      status="NOTOK";
    }
    //checking owner address is valid or not
    var answerinbool=web3Infura.utils.isAddress(destinationaddress);
    var answerinstring=""+answerinbool;    
    if(answerinstring == "false")
    {
        alertify.error("Please enter true destination Address !");
        status="NOTOK";
    }
    if(status == "OK")
   {
       
        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {
        //finding user's current address
        web3Infura.eth.getAccounts().then(function(receipt){
        var myAccountAddress = receipt.toString();
        var othercontract = new web3Infura.eth.Contract(contractabi, selectedCurrencyContract, {
        from: myAccountAddress, // default from address
      });
      //here checking the particulart token balance in etherdelta smart contract
        amountoftoken=amountoftoken * Math.pow(10,selectedTokenDecimal);
        amountoftoken = logEtoDecimal(amountoftoken, selectedTokenDecimal);
        amountoftoken=web3Infura.utils.toHex(amountoftoken);
        var data = othercontract.methods.transfer(destinationaddress,amountoftoken).encodeABI();
        web3Infura.eth.sendTransaction({
        from: myAccountAddress,
        to: selectedCurrencyContract,
        //gasPrice: localStorage.getItem('ethGasPrice'),
        gasPrice : web3GasPrice,
        gasLimit: gasDeposit,
        data: data, // deploying a contracrt
        }, function(error, result){
        alertify.alert("Transaction Hash","Please check the status of Transaction at: <a href='"+etherscanTxURL+result+"' target='_blank'>Etherscan</a>", function(){});
      });
      });
      }
      else
      {
         //wToken tarnsfer from other account
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        //var privateKey = new Buffer(privateKeywithouthex , 'hex');
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x")         
        {             
            privateKey = "0x"+privateKeywithouthex;         
        }
        var othercontract = new web3Infura.eth.Contract(contractabi, selectedCurrencyContract, {
        from: myAccountAddress, // default from address
        });
        //here checking the particulart token balance in etherdelta smart contract
        amountoftoken=amountoftoken * Math.pow(10,selectedTokenDecimal);
        amountoftoken = logEtoDecimal(amountoftoken, selectedTokenDecimal);
        amountoftoken=web3Infura.utils.toHex(amountoftoken);
        var data = othercontract.methods.transfer(destinationaddress,amountoftoken).encodeABI();
        
        web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
      if(!error){
        var nonce = result.toString();
        var raw = {
        "nonce":web3Infura.utils.toHex(nonce),
        "from": myAccountAddress,
          "to": selectedCurrencyContract,
          //"gasPrice": localStorage.getItem('ethGasPrice'),
          "gasPrice" : web3GasPrice,
          "gasLimit": gasDeposit,
          "data": data, // deploying a contracrt
          "chainId":chainID
        };
        web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
        if(!error)
        {
          var serializedTx=result.rawTransaction;
          web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
          .on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
         
            alertify.alert('Transaction Success', 'Token transfered.', function(){
              window.location.reload();
            });
         
        }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
        }
      });
        }
    });
      }
    }
  });
  //this code is for transefer the ether
  $("#ethtransfer").click(async function(){
     const web3GasPrice = await myweb3.eth.getGasPrice();
    
    var amount=document.getElementById('etheramount').value;
    var addresstotransfer=document.getElementById('addresstotransfer').value;
    var web3Infura = new Web3(Web3.givenProvider || ethProvider);
    var status="OK";
    if(amount <= 0)
    {
      alertify.error("Please enter more then 0 ether!");
      status="NOTOK";
    }
    if (isNaN(amount))
    {
      alertify.error("Please enter valid amount !");
      status="NOTOK";
    }
    if(amount > userEtherBalance)
    {
      alertify.error("You don't have sufficient ether in your wallet to transfer !");
      status="NOTOK";
    }
    //checking owner address is valid or not
    var answerinbool=web3Infura.utils.isAddress(addresstotransfer);
    var answerinstring=""+answerinbool;    
    if(answerinstring == "false")
    {
        alertify.error("Please enter true destination Address !");
        status="NOTOK";
    }
    if(status == "OK")
    {
        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {  
        web3Infura.eth.getAccounts(function(e,r){
         if(!e)
         {
          accounts=r[0];
          amount=web3Infura.utils.toWei(amount, 'ether');
          web3Infura.eth.sendTransaction({from:accounts, to:addresstotransfer, value:amount, gas:65000},function(e,r){
            if(!e)
            {
              alertify.alert("Transaction Hash","Please check the status of Transaction at: <a href='"+etherscanTxURL+r+"' target='_blank'>Etherscan</a>", function(){});
            }
          });
          }
        });        
      }
      else
      {
        //withdraw ether in smart contract
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        //var privateKey = new Buffer(privateKeywithouthex , 'hex');
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x")         
        {             
            privateKey = "0x"+privateKeywithouthex;         
        }
        //here checking the particulart token balance in etherdelta smart contract
        amount=web3Infura.utils.toWei(amount, 'ether');
        web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
      if(!error){
        var nonce = result.toString();
        var raw = {
        "nonce":web3Infura.utils.toHex(nonce),
        "from": myAccountAddress,
          "to": addresstotransfer,
          //"gasPrice": localStorage.getItem('ethGasPrice'),
          "gasPrice" : web3GasPrice,
          "gasLimit": gasDeposit,
          "value":web3Infura.utils.toHex(amount),
          "chainId":chainID
        };
        web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
        if(!error)
        {
          var serializedTx=result.rawTransaction;
          web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
          .on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
            alertify.alert('Transaction Success', 'Ether Transfer.', function(){
              window.location.reload();
            });
         }).on('error',function(error)
            {
            var ErrorMsg=error.message;
            ErrorMsg=Errormsgfunction(ErrorMsg);
            //ErrorMsg=ErrorMsg.slice(0,100);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
        }
      });
        }
    });
      }      
    }
  });
  //this code is for withdraw the ether from smart contract
  $("#ethwithdrawbutton").click(async function(){
    const web3GasPrice = await myweb3.eth.getGasPrice();
    var etherwithdrawamount=document.getElementById('ethwithdrawamount').value;
  	var web3Infura = new Web3(Web3.givenProvider || ethProvider);
    var status="OK";
    if(etherwithdrawamount > userEtherBalanceOfSmartcontract)
    {
      alertify.error("You don't have sufficient ether in smart contract!");
      status="NOTOK";
    }
    if(etherwithdrawamount <= 0)
    {
      alertify.error("Please enter more then 0 ether!");
      status="NOTOK";
    }
    if (isNaN(etherwithdrawamount))
    {
      alertify.error("Please enter valid amount !");
      status="NOTOK";
    }
    if(status=="OK")
    {
        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        { 
        //withdrow ether in smart contract
        web3Infura.eth.getAccounts().then(function(receipt){
        var myAccountAddress = receipt.toString();
        var etherwithdrawamount1=web3Infura.utils.toWei(etherwithdrawamount, 'ether');
        var data = myContract.methods.withdraw(etherwithdrawamount1).encodeABI();
        web3Infura.eth.sendTransaction({
        from: myAccountAddress,
        to: mainContractAddress,
        //gasPrice: localStorage.getItem('ethGasPrice'),
        gasPrice : web3GasPrice,
        gasLimit: gasWithdraw,
        data: data, // deploying a contracrt
        }).on('transactionHash',function(hash){
        alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
      }).on('receipt', function(receipt){
            alertify.alert('Transaction Success', 'Ether withdrawn successfully.', function(){
              window.location.reload();
            });
            
      }).on('error',function(error)
            {
            var ErrorMsg=error.message;
            ErrorMsg=Errormsgfunction(ErrorMsg);
            //ErrorMsg=ErrorMsg.slice(0,100);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
    });
    }
    else
    {
        //withdraw ether in smart contract
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x") 
        {
            privateKey = "0x"+privateKeywithouthex;
        }
        //here checking the particulart token balance in etherdelta smart contract
        var etherwithdrawamount1=web3Infura.utils.toWei(etherwithdrawamount, 'ether');
        var data = myContract.methods.withdraw(etherwithdrawamount1).encodeABI();
        web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
      if(!error){
        var nonce = result.toString();
        var raw = {
        "nonce":web3Infura.utils.toHex(nonce),
        "from": myAccountAddress,
          "to": mainContractAddress,
          //"gasPrice": localStorage.getItem('ethGasPrice'),
          "gasPrice" : web3GasPrice,
          "gasLimit": gasDeposit,
          "data": data, // deploying a contracrt
          "chainId":chainID
        };
        web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
        if(!error)
        {
          var serializedTx=result.rawTransaction;
          web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
          .on('transactionHash',function(hash){
         alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
            alertify.alert('Transaction Success', 'Ether withdrawn successfully.', function(){
              window.location.reload();
            });
        }).on('error',function(error)
            {
            var ErrorMsg=error.message;
            ErrorMsg=Errormsgfunction(ErrorMsg);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
        }
      });
        }
    });
    }
    }
  });
 //this code is for deposit the token in smart contract 
$("#tokendepositbutton2").click(async function(){ 
   const web3GasPrice = await myweb3.eth.getGasPrice();
   var web3Infura = new Web3(Web3.givenProvider || ethProvider);
      var amountoftoken = document.getElementById('amountoftokendeposit2').value;
      var status="OK";
      if (isNaN(amountoftoken))
      {
         alertify.error("Please enter valid amount!");
         status="NOTOK";
      }
      if(amountoftoken <= 0)
      {
        alertify.error("Please enter valid amount!");
        status="NOTOK";
      }
      if(amountoftoken > userTokenBalance2)
      {
        alertify.error("You don't have sufficient token to deposit !");
        status="NOTOK";
      }
      if(status == "OK")
      {

        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {
          //finding user's current address
          web3Infura.eth.getAccounts().then(async function(receipt){
          var myAccountAddress = receipt.toString();
          var othercontract = new web3Infura.eth.Contract(marketsABI, marketsAddress, {
          from: myAccountAddress, // default from address
          });
        //here calling approve function of other token contract
       // var amountoftoken2=web3Infura.utils.toWei(amountoftoken,'ether');
        if(!amountoftoken.split(".")[1]){
            var amountoftoken2= strtodec(marketDecimals);
            amountoftoken1 = amountoftoken+amountoftoken2;
            amountoftoken1=web3Infura.utils.toHex(amountoftoken1);
        }else{
          // var amountoftoken1=web3Infura.utils.toWei(amountoftoken,'ether');
           var amt1= amountoftoken.split(".")[0];
           var amt2= amountoftoken.split(".")[1];
          var  amountoftoken1='';
          var amlen = amt2.length;
           console.log("nodecleng"+ amlen);
          var fdec= marketDecimals-amlen ;
          if (fdec == 0){
          amountoftoken1=amt1+ amt2;
          }else{
           var amountoftoken2= strtodec(fdec);
           amountoftoken1 = amt1+amt2+amountoftoken2;
          }
           amountoftoken1=web3Infura.utils.toHex(amountoftoken1);
        }

          //check for allowance
        var allowance = await othercontract.methods.allowance(myAccountAddress,mainContractAddress).call();
        

        if(allowance<=1000){
          var totalSupplyofToken = await othercontract.methods.totalSupply().call();


        
        var data = othercontract.methods.approve(mainContractAddress,totalSupplyofToken).encodeABI();
                web3Infura.eth.sendTransaction({
                from: myAccountAddress,
                to: marketsAddress,
                //gasPrice: localStorage.getItem('ethGasPrice'),
                gasPrice : web3GasPrice,
                gasLimit: gasApprove,
                data: data, // deploying a contracrt
             }).on('transactionHash', function(hash){
                alertify.alert("Token Deposit Step 1 Processed","The first step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> You will be taken to Step 2 when step 1 process completed!", function(){
                document.getElementById('tokenDepositLoaderDiv').style.display="block";
                });
             })
            .on('receipt', function(receipt){
          if(receipt.status == true)
                  {
                    //deposit token in smart contract
                    web3Infura.eth.getAccounts().then(function(receipt){
                    var myAccountAddress = receipt.toString();
                  var data = myContract.methods.depositToken(marketsAddress,amountoftoken1).encodeABI();
                  web3Infura.eth.sendTransaction({
                  from: myAccountAddress,
                  to: mainContractAddress,
                  //gasPrice: localStorage.getItem('ethGasPrice'),
                  gasPrice : web3GasPrice,
                  gasLimit: gasDeposit,
                  data: data, // deploying a contracrt
                  }).on('transactionHash', function(hash){
                    alertify.alert("Token Deposit Step 1 Processed","The first step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> You will be taken to Step 2 when step 1 process completed!", function(){
                    document.getElementById('tokenDepositLoaderDiv').style.display="block";
                    });
                }).on('receipt', function(receipt){
                
                    alertify.alert('Transaction Success', 'Token Deposited.', function(){
                      document.getElementById('tokenDepositLoaderDiv').style.display="none";
                      window.location.reload();
                    });
                  document.getElementById('tokenDepositLoaderDiv').style.display="none";
                  }).on('error', function(error){
                    var ErrorMsg=error.message;
                    ErrorMsg=Errormsgfunction(ErrorMsg);
                    //ErrorMsg=ErrorMsg.slice(0,100);
                  alertify.alert("Transaction Aborted", ""+ErrorMsg, function(){
                      window.location.reload();
                  });
                  document.getElementById('tokenDepositLoaderDiv').style.display="none";
                  });
                  });
                  }
            });
          }else{
             //if there is enough allowance then dirctly deposit
              //deposit token in smart contract
                    web3Infura.eth.getAccounts().then(function(receipt){
                    var myAccountAddress = receipt.toString();
                  var data = myContract.methods.depositToken(marketsAddress,amountoftoken1).encodeABI();
                  web3Infura.eth.sendTransaction({
                  from: myAccountAddress,
                  to: mainContractAddress,
                  //gasPrice: localStorage.getItem('ethGasPrice'),
                  gasPrice : web3GasPrice,
                  gasLimit: gasDeposit,
                  data: data, // deploying a contracrt
                  }).on('transactionHash', function(hash){
                    alertify.alert("Token Deposit Step 1 Processed","The first step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> You will be taken to Step 2 when step 1 process completed!", function(){
                    document.getElementById('tokenDepositLoaderDiv').style.display="block";
                    });
                }).on('receipt', function(receipt){
                
                    alertify.alert('Transaction Success', 'Token Deposited.', function(){
                      document.getElementById('tokenDepositLoaderDiv').style.display="none";
                      window.location.reload();
                    });
                  document.getElementById('tokenDepositLoaderDiv').style.display="none";
                  }).on('error', function(error){
                    var ErrorMsg=error.message;
                    ErrorMsg=Errormsgfunction(ErrorMsg);
                    //ErrorMsg=ErrorMsg.slice(0,100);
                  alertify.alert("Transaction Aborted", ""+ErrorMsg, function(){
                      window.location.reload();
                  });
                  document.getElementById('tokenDepositLoaderDiv').style.display="none";
                  });
                  });

          }
      });
    }
    else
    {
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        //var privateKey = new Buffer(privateKeywithouthex , 'hex');
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x") 
        {             
            privateKey = "0x"+privateKeywithouthex;         
        }
        var othercontract = new web3Infura.eth.Contract(marketsABI, marketsAddress, {
          from: myAccountAddress, // default from address
        });
        var amountoftoken1=amountoftoken*Math.pow(10,marketDecimals);
        amountoftoken1 = logEtoDecimal(amountoftoken1, marketDecimals);
        
        console.log(amountoftoken1);
        amountoftoken1=web3Infura.utils.toHex(amountoftoken1);
        //here calling approve function of other token contract        


          //check for allowance
        var allowance = await othercontract.methods.allowance(myAccountAddress,mainContractAddress).call();
        

        if(allowance<=1000){
          var totalSupplyofToken = await othercontract.methods.totalSupply().call();
        var data = othercontract.methods.approve(mainContractAddress,totalSupplyofToken).encodeABI();
       
                web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
          
              if(!error){
                var nonce = result.toString();
                var raw = {
                  "nonce":web3Infura.utils.toHex(nonce),
                  "from": myAccountAddress,
                  "to": marketsAddress,
                  //"gasPrice": localStorage.getItem('ethGasPrice'),
                  "gasPrice" : web3GasPrice,
                  "gasLimit": gasDeposit,
                  "data": data, // deploying a contracrt
                  "chainId":chainID
                };

                web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
                if(!error)
                {
                
                  var serializedTx=result.rawTransaction;
                  web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
                  .on('transactionHash', function(hash){
                    alertify.alert("Token Deposit Initiated","<a href='"+etherscanTxURL+hash+"' target='_blank'>Click Here to check transaction status at Etherscan</a><br><br>", function(){
                    document.getElementById('tokenDepositLoaderDiv').style.display="block";
                    });
                }).on('receipt', function(receipt){
                 if(receipt.status == true)
                  {
               var data = myContract.methods.depositToken(marketsAddress,amountoftoken1).encodeABI();
              web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
                if(!error){
                var nonce = result.toString();
                var raw = {
                "nonce":web3Infura.utils.toHex(nonce),
                "from": myAccountAddress,
                "to": mainContractAddress,
                //"gasPrice": localStorage.getItem('ethGasPrice'),
                "gasPrice" : web3GasPrice,
                "gasLimit": gasDeposit,
                "data": data, // deploying a contracrt
                "chainId":chainID
                };

                web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
                  if(!error)
                  {
                    var serializedTx=result.rawTransaction;
                    web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
                    .on('transactionHash', function(hash){
                    alertify.alert("Token Deposit Step 1 Processed","The second step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> ", function(){
                    document.getElementById('tokenDepositLoaderDiv').style.display="block";
                    });
                }).on('receipt', function(receipt){
                  
                    alertify.alert('Transaction Success', 'Token Deposited.', function(){
                    document.getElementById('tokenDepositLoaderDiv').style.display="none";
                    window.location.reload();
                    });
                    document.getElementById('tokenDepositLoaderDiv').style.display="none";
                  
                  }).on('error', function(error){ 
                      var ErrorMsg=error.message;
                                ErrorMsg=Errormsgfunction(ErrorMsg);
                                //ErrorMsg=ErrorMsg.slice(0,100);
                  alertify.alert("Transaction Cancelled",""+ErrorMsg, function(){
                      window.location.reload();
                  });
                  document.getElementById('tokenDepositLoaderDiv').style.display="none";
                  });

                  }
                });
                }

              });
              
             }
            });

           }
         });
              }
            });
      }else{
           web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
          
              if(!error){
                var nonce = result.toString();
                var raw = {
                  "nonce":web3Infura.utils.toHex(nonce),
                  "from": myAccountAddress,
                  "to": marketsAddress,
                  //"gasPrice": localStorage.getItem('ethGasPrice'),
                  "gasPrice" : web3GasPrice,
                  "gasLimit": gasDeposit,
                  "data": data, // deploying a contracrt
                  "chainId":chainID
                };

                web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
                if(!error)
                {
                
                  var serializedTx=result.rawTransaction;
                  web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
                  .on('transactionHash', function(hash){
                    alertify.alert("Token Deposit Initiated","<a href='"+etherscanTxURL+hash+"' target='_blank'>Click Here to check transaction status at Etherscan</a><br><br>", function(){
                    document.getElementById('tokenDepositLoaderDiv').style.display="block";
                    });
                }).on('receipt', function(receipt){
                 if(receipt.status == true)
                  {
               var data = myContract.methods.depositToken(marketsAddress,amountoftoken1).encodeABI();
              web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
                if(!error){
                var nonce = result.toString();
                var raw = {
                "nonce":web3Infura.utils.toHex(nonce),
                "from": myAccountAddress,
                "to": mainContractAddress,
                //"gasPrice": localStorage.getItem('ethGasPrice'),
                "gasPrice" : web3GasPrice,
                "gasLimit": gasDeposit,
                "data": data, // deploying a contracrt
                "chainId":chainID
                };

                web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
                  if(!error)
                  {
                    var serializedTx=result.rawTransaction;
                    web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
                    .on('transactionHash', function(hash){
                    alertify.alert("Token Deposit Step 1 Processed","The second step of Token deposit is initiated. You can check the status at <a href='"+etherscanTxURL+hash+"' target='_blank'>Etherscan</a><br><br> ", function(){
                    document.getElementById('tokenDepositLoaderDiv').style.display="block";
                    });
                }).on('receipt', function(receipt){
                  
                    alertify.alert('Transaction Success', 'Token Deposited.', function(){
                    document.getElementById('tokenDepositLoaderDiv').style.display="none";
                    window.location.reload();
                    });
                    document.getElementById('tokenDepositLoaderDiv').style.display="none";
                  
                  }).on('error', function(error){ 
                      var ErrorMsg=error.message;
                                ErrorMsg=Errormsgfunction(ErrorMsg);
                                //ErrorMsg=ErrorMsg.slice(0,100);
                  alertify.alert("Transaction Cancelled",""+ErrorMsg, function(){
                      window.location.reload();
                  });
                  document.getElementById('tokenDepositLoaderDiv').style.display="none";
                  });

                  }
                });
                }

              });
              
             }
            });

           }
         });
              }
            });
      }
}
}
});

  //this code is for deposit the ether in smart contract 
$("#ethdepositbutton").click(async function(){ 
  const web3GasPrice = await myweb3.eth.getGasPrice();

	 var web3Infura = new Web3(Web3.givenProvider || ethProvider);
      var etheramount=document.getElementById('etherdepositvalue').value;
      var status="OK";
      if(userEtherBalance < etheramount)
      {
        alertify.error("Please deposit ether less than your wallet balance!");
        status="NOTOK";
      }
      if(etheramount <= 0)
      {
        alertify.error("Please enter more then 0 ether!");
        status="NOTOK";
      }
      if(isNaN(etheramount))
      {
         alertify.error("Please enter valid amount !");
         status="NOTOK";
      }
      if(status == "OK")
      {

        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {
        //deposit ether in smart contract
        web3Infura.eth.getAccounts().then(function(receipt){
        var myAccountAddress = receipt.toString();
        /*
        var myContract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
        from: myAccountAddress, // default from address
        });
        */
        //here checking the particulart token balance in etherdelta smart contract
        var etheramount1=web3Infura.utils.toWei(etheramount, 'ether');
        var data = myContract.methods.deposit().encodeABI();
        web3Infura.eth.sendTransaction({
          from: myAccountAddress,
          to: mainContractAddress,
         // gasPrice: localStorage.getItem('ethGasPrice'),
         gasPrice : web3GasPrice,
          gasLimit: gasDeposit,
          data: data, // deploying a contracrt
          value:web3Infura.utils.toHex(etheramount1),
          }).on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
         
            alertify.alert('Transaction Success', 'Ether deposited successfully.', function(){
            	window.location.reload();
            });
         
        }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             //ErrorMsg=ErrorMsg.slice(0,100);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
    });
    }
    else
    {
       // var web3Infura = new Web3(Web3.givenProvider || "https://mainnet.infura.io/R4ZOS5AoF9gJMfGMuqJm");
        //deposit ether in smart contract
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk; 
                  
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x")
        {
            privateKey = "0x"+privateKeywithouthex;
        }
        //here checking the particulart token balance in etherdelta smart contract
        var etheramount1=web3Infura.utils.toWei(etheramount, 'ether');
        var data = myContract.methods.deposit().encodeABI();
        
       
        web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
      if(!error){
        var nonce = result.toString();
        var raw = {
        "nonce":web3Infura.utils.toHex(nonce),
        "from": myAccountAddress,
          "to": mainContractAddress,
          //"gasPrice": localStorage.getItem('ethGasPrice'),
          gasPrice : web3GasPrice,
          "gasLimit": gasDeposit,
          "data": data, // deploying a contracrt
          "value":web3Infura.utils.toHex(etheramount1),
          "chainId":chainID
        };
        web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
           
        if(!error)
        {
            
          var serializedTx=result.rawTransaction;
          web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
          .on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
         
            alertify.alert('Transaction Success', 'Ether deposited successfully.', function(){
              window.location.reload();
            });
         
        }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             //ErrorMsg=ErrorMsg.slice(0,100);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
        }
      });
        }
       });
    }
   }
});
//refer bonus withdraw function
$("#refBonusWithdraw").click(async function(){ 
    const web3GasPrice = await myweb3.eth.getGasPrice();

    var status="OK";
    var referrerBonus = document.getElementById("refBonusAvailable").innerText;
    
    if(referrerBonus == 0){
        alertify.error('Insufficient Amount');
        status="NOTOK";
    }
      if(status == "OK")
      {
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {
        //deposit ether in smart contract
        web3Infura.eth.getAccounts().then(function(receipt){
        var myAccountAddress = receipt.toString();
        
        var data = myContract.methods.claimReferrerBonus().encodeABI();
        web3Infura.eth.sendTransaction({
          from: myAccountAddress,
          to: mainContractAddress,
          //gasPrice: localStorage.getItem('ethGasPrice'),
          gasPrice : web3GasPrice,
          gasLimit: gasDeposit,
          data: data, // deploying a contracrt
          value: 0,
          }).on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){
        

        }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             //ErrorMsg=ErrorMsg.slice(0,100);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
    });
    }
    else
    {
       
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk; 
                  
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x")
        {
            privateKey = "0x"+privateKeywithouthex;
        }

        var data = myContract.methods.claimReferrerBonus().encodeABI();
        web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
      if(!error){
        var nonce = result.toString();
        var raw = {
        "nonce":web3Infura.utils.toHex(nonce),
        "from": myAccountAddress,
          "to": mainContractAddress,
          //"gasPrice": localStorage.getItem('ethGasPrice'),
          "gasPrice" : web3GasPrice,
          "gasLimit": gasDeposit,
          "data": data, // deploying a contracrt
          "value": 0,
          "chainId":chainID
        };
        web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
           
        if(!error)
        {
            
          var serializedTx=result.rawTransaction;
          web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
          .on('transactionHash',function(hash){
          alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
        }).on('receipt', function(receipt){

        }).on('error',function(error)
            {
             var ErrorMsg=error.message;
             ErrorMsg=Errormsgfunction(ErrorMsg);
             //ErrorMsg=ErrorMsg.slice(0,100);
             alertify.alert('Error', ""+ErrorMsg, function(){
            });
        });
        }
      });
        }
       });
    }
   }
});

$("#buyPutTradeButton").click(async function(){
/*
  amountGet = buyTokenAmount
  amountGive = buyETHAmount
*/  
	 const currentBlock = await myweb3.eth.getBlockNumber();
    var buyTokenAmount = document.getElementById('buyTokenAmount').value;
	var buyAmountPerEther = document.getElementById('buyAmountPerEther').value;
	var buyETHAmount = buyTokenAmount * buyAmountPerEther;
	var byExpiryInBlock = document.getElementById('byExpiryInBlock').value;
	var status="OK";
  	//checking the amount come in float or double
	if(buyTokenAmount=='' || buyAmountPerEther=='' || buyETHAmount=='' || byExpiryInBlock=='' ){
		alertify.error("Please fill all the input fields.");
    	status="NOTOK";
	}
    if(buyTokenAmount <= 0)
    {
     	alertify.error("Please enter more then 0 token !");
    	status="NOTOK";
    }
    if (isNaN(buyTokenAmount))
    {
      	alertify.error("Please enter valid amount !");
    	status="NOTOK";
    }
    if (isNaN(buyAmountPerEther))
    {
         alertify.error("Please enter valid for ether amount !");
    	 status="NOTOK";
    }
	if(buyAmountPerEther <= 0)
    {
    	alertify.error("Please enter more then 0 ether amount!");
    	status="NOTOK";
    }
    if(Number.isInteger(byExpiryInBlock))
    {
     	alertify.error("Please enter integer number in block expires !"); 
    	status="NOTOK";
    }
	if(byExpiryInBlock <= 0)
    {
    	alertify.error("Please enter more than 0 number in block expires !"); 
    	status="NOTOK";
    }
    if(status == "OK")
    {

        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        { 
		  //here getting the user address
          web3Infura.eth.getAccounts().then(function(receipt){
          var myAccountAddress = receipt.toString();
          /*
          var myContract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
          from: myAccountAddress, // default from address
          });
          */
          //checking user have suffiecient ether in etherdelta smart contract
            if(selectedMarket=="ETH"){
              if(userEtherBalanceOfSmartcontract < buyETHAmount){
               //here checking the particulart ether balance in etherdelta smart contract
                alertify.error("Insufficient ether balance !");
                return false;
              }
            }else{
              if(userTokenbalanceOfSmartcontract2 < buyETHAmount){
               alertify.error("Insufficient token balance !");
               return false;
              }
            }
              //generate random number to be used as nounce
              var nounce = Math.floor((Math.random() * 1000000) + 1);
              //generating v r s for the sell order
              if(selectedMarket=="ETH"){
                var buyTokenAmountWEI=web3Infura.utils.toWei(buyTokenAmount, 'ether');
                var buyETHAmountWEI=web3Infura.utils.toWei(""+buyETHAmount, 'ether');
              }else{
                var buyTokenAmountWEI=buyTokenAmount*Math.pow(10, selectedTokenDecimal);
                buyTokenAmountWEI = logEtoDecimal(buyTokenAmountWEI, selectedTokenDecimal);
                var buyETHAmountWEI = buyETHAmount*Math.pow(10, marketDecimals);
                buyETHAmountWEI = logEtoDecimal(buyETHAmountWEI, marketDecimals);

              }
              byExpiryInBlock=parseInt(byExpiryInBlock)+currentBlock;
              if(selectedMarket=="ETH"){
                  var msg = web3Infura.utils.soliditySha3(mainContractAddress,selectedCurrencyContract,buyTokenAmountWEI,EtherAddress,buyETHAmountWEI,byExpiryInBlock);
              }else{
                  var msg = web3Infura.utils.soliditySha3(mainContractAddress,selectedCurrencyContract,buyTokenAmountWEI,marketsAddress,buyETHAmountWEI,byExpiryInBlock);
              }
              web3Infura.eth.personal.sign(msg, myAccountAddress,function(err,res){
              var signature=res;
              var r=signature.substr(0,66);
              var s= "0x" + signature.substr(66,64);
              var v="0x" + signature.substr(signature.length-2);
              //send Ajax response to send all data to off-chain Order Book
              jQuery.ajax({
              url: "scripts/main-token.php?tokenGetAddress="+selectedCurrencyContract+"&tokenPriceInEther="+buyAmountPerEther+"&tokenName="+selectedCurrencyMenu+"&tokenAmount="+buyTokenAmount+"&giveTokenAmount="+buyETHAmount+"&giveToken="+selectedMarket+"&giveTokenAddress="+marketsAddress+"&expiryInBlock="+byExpiryInBlock+"&buyOrSell=BUY&tradeMaker="+myAccountAddress+"&v="+v+"&r="+r+"&s="+s+"&FeeTake="+feeTakeInContract+"&nonce="+nounce,
              async: false, // <-- this forces the ajax call to be synchronous.
              cache: false,
              dataType: "html",
              success: function(html){ //<<-- This is where you get the ajax response
                returnHtml = html;
              }
            });
            alertify.alert('Transaction Success', 'Buy Order has been placed to off-chain order book.', function(){
            	window.location.reload();
            });

            });
         
	     });
      }
      else
      {
          //Buy trade order
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        //var privateKey = new Buffer(privateKeywithouthex , 'hex');
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x")
        {            
            privateKey = "0x"+privateKeywithouthex;
        }
        /*
          var myContract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
          from: myAccountAddress, // default from address
          });
          */
          //checking user have suffiecient ether in etherdelta smart contract
            if(selectedMarket=="ETH"){
              if(userEtherBalanceOfSmartcontract < buyETHAmount){
               //here checking the particulart ether balance in etherdelta smart contract
                alertify.error("Insufficient ether balance !");
                return false;
              }
            }else{
              if(userTokenbalanceOfSmartcontract2 < buyETHAmount){
               alertify.error("Insufficient token balance !");
               return false;
              }
            }
              //generate random number to be used as nounce
             var nounce = Math.floor((Math.random() * 1000000) + 1);
              //generating v r s for the sell order
             if(selectedMarket=="ETH"){
                var buyTokenAmountWEI=web3Infura.utils.toWei(buyTokenAmount, 'ether');
                var buyETHAmountWEI=web3Infura.utils.toWei(""+buyETHAmount, 'ether');
              }else{
                var buyTokenAmountWEI=buyTokenAmount*Math.pow(10, selectedTokenDecimal);
                buyTokenAmountWEI = logEtoDecimal(buyTokenAmountWEI, selectedTokenDecimal);
                var buyETHAmountWEI = buyETHAmount*Math.pow(10, marketDecimals);
                buyETHAmountWEI = logEtoDecimal(buyETHAmountWEI, marketDecimals);

              }
              byExpiryInBlock=parseInt(byExpiryInBlock)+currentBlock;
              if(selectedMarket=="ETH"){
                  var msg = web3Infura.utils.soliditySha3(mainContractAddress,selectedCurrencyContract,buyTokenAmountWEI,EtherAddress,buyETHAmountWEI,byExpiryInBlock);
              }else{
                  var msg = web3Infura.utils.soliditySha3(mainContractAddress,selectedCurrencyContract,buyTokenAmountWEI,marketsAddress,buyETHAmountWEI,byExpiryInBlock);
              }
              var signedData=web3Infura.eth.accounts.sign(msg, privateKey);
              var r=signedData.r;
              var s=signedData.s;
              var v=signedData.v;
            //send Ajax response to send all data to off-chain Order Book
              jQuery.ajax({
              url: "scripts/main-token.php?tokenGetAddress="+selectedCurrencyContract+"&tokenPriceInEther="+buyAmountPerEther+"&tokenName="+selectedCurrencyMenu+"&tokenAmount="+buyTokenAmount+"&giveTokenAmount="+buyETHAmount+"&giveToken="+selectedMarket+"&giveTokenAddress="+marketsAddress+"&expiryInBlock="+byExpiryInBlock+"&buyOrSell=BUY&tradeMaker="+myAccountAddress+"&v="+v+"&r="+r+"&s="+s+"&FeeTake="+feeTakeInContract+"&nonce="+nounce,
              async: false, // <-- this forces the ajax call to be synchronous.
              cache: false,
              dataType: "html",
              success: function(html){ //<<-- This is where you get the ajax response
                returnHtml = html;
              }
            });
            alertify.alert('Transaction Success', 'Buy Order has been placed to off-chain order book.', function(){
              window.location.reload();
            });
         
    	}
  	}
});
$("#sellPutTradeButton").click(async function(){
  /*
  tokenGive = sellTokenAmount
  tokenGet = sellETHAmount
  */
const currentBlock = await myweb3.eth.getBlockNumber();
  var sellTokenAmount = document.getElementById('sellTokenAmount').value;
  var sellAmountPerEther = document.getElementById('sellAmountPerEther').value;
  var sellETHAmount = sellTokenAmount * sellAmountPerEther;
  var sellExpiryInBlock = document.getElementById('sellbyExpiryInBlock').value;
  var status = "OK";
    //checking the amount come in float or double
	if(sellTokenAmount=='' || sellAmountPerEther=='' || sellETHAmount=='' || sellExpiryInBlock=='' ){
    	alertify.error("Please fill all the input fields.");
    	status="NOTOK";
    sellETHAmount=sellETHAmount.toString();
	  sellETHAmount=sellETHAmount.slice(0,10);
  	}
    if(sellTokenAmount <= 0)
    {
     	alertify.error("Please ether more then 0 token !");
    	status="NOTOK";
    }
    if (isNaN(sellTokenAmount))
    {
        alertify.error("Please enter valid amount !");
    	status="NOTOK";
    }
    if (isNaN(sellAmountPerEther))
    {
        alertify.error("Please enter valid ether amount !");
    	status="NOTOK";
    }
	if(sellAmountPerEther <= 0)
    {
    	alertify.error("Please ether more then 0 ether for sell amount !");
    	status="NOTOK";
    }
    if(Number.isInteger(sellExpiryInBlock))
    {
     	alertify.error("Please enter integer number in block expires !"); 
    	status="NOTOK";
    }
	 if(sellExpiryInBlock <= 0)
    {
    	alertify.error("Please enter more then 0 number in expiry block!"); 
    	status="NOTOK";
    }
    if(status == "OK")
    {
        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        var MetaMaskAccount=usersdata.accounts[selectedAccount].kind;
        if(MetaMaskAccount == 'MetaMask')
        {
    //here getting the user address
    web3Infura.eth.getAccounts().then(function(receipt){
    var myAccountAddress = receipt.toString();

    //here checking the particulart token balance in etherdelta smart contract
          // if(selectedMarket=="ETH"){
          //     if(userEtherBalanceOfSmartcontract < sellTokenAmount){
          //      //here checking the particulart ether balance in etherdelta smart contract
          //       alertify.error("Insufficient ether balance !");
          //       return false;
          //     }
          //   }else{
          //     if(parseFloat(userTokenbalanceOfSmartcontract) < sellTokenAmount){
          //      alertify.error("Insufficient token balance !");
          //      return false;
          //     }
          // }    
         	myContract.methods.balanceOf(selectedCurrencyContract, myAccountAddress).call({from:myAccountAddress},function(error, result1){
                  if(!error){
                    var result = result1/Math.pow(10, selectedTokenDecimal); 
                    result = logEtoLongNumber(result);
                    userTokenbalanceOfSmartcontract=parseFloat(result);
                    num = result.toString(); //If it's not already a String
                    dividend = num.substring(0, 15); //With 3 exposing the hundredths place
                    var totalItems = document.getElementsByClassName("balanceDisplayLabel");
                    var currentValue = "";
                    for (var i=0; i < totalItems.length; i++) {
                      currentValue = totalItems[i].innerText;
                      totalItems[i].innerHTML=dividend;
                    }
                }
                });
              if(parseFloat(userTokenbalanceOfSmartcontract) < parseFloat(sellTokenAmount)){
               alertify.error("Insufficient token balance !");
               return false;
              }
          //generate random number to be used as nounce
          var nounce = Math.floor((Math.random() * 1000000) + 1);
          //generating v r s for the sell order
              var sellTokenAmountWEI=sellTokenAmount*Math.pow(10, selectedTokenDecimal);
              sellTokenAmountWEI = logEtoDecimal(sellTokenAmountWEI, selectedTokenDecimal);
              var sellETHAmountWEI = sellETHAmount*Math.pow(10, marketDecimals);
              sellETHAmountWEI = logEtoDecimal(sellETHAmountWEI, marketDecimals);

          
          sellExpiryInBlock=parseInt(sellExpiryInBlock)+currentBlock;
         if(selectedMarket=="ETH"){
          var msg = web3Infura.utils.soliditySha3(mainContractAddress,EtherAddress,sellETHAmountWEI,selectedCurrencyContract,sellTokenAmountWEI,sellExpiryInBlock);
        }else{
          var msg = web3Infura.utils.soliditySha3(mainContractAddress,marketsAddress,sellETHAmountWEI,selectedCurrencyContract,sellTokenAmountWEI,sellExpiryInBlock);
        }
          web3Infura.eth.personal.sign(msg, myAccountAddress,function(err,res){
            var signature=res;
            var r=signature.substr(0,66);
            var s= "0x" + signature.substr(66,64);
            var v="0x" + signature.substr(signature.length-2);
            //send Ajax response to send all data to off-chain Order Book
          
              jQuery.ajax({
              url: "scripts/main-token.php?tokenGetAddress="+marketsAddress+"&tokenPriceInEther="+sellAmountPerEther+"&tokenName="+selectedMarket+"&tokenAmount="+sellETHAmount+"&giveTokenAmount="+sellTokenAmount+"&giveToken="+selectedCurrencyMenu+"&giveTokenAddress="+selectedCurrencyContract+"&expiryInBlock="+sellExpiryInBlock+"&buyOrSell=SELL&tradeMaker="+myAccountAddress+"&v="+v+"&r="+r+"&s="+s+"&FeeTake="+feeTakeInContract+"&nonce="+nounce,
              async: false, // <-- this forces the ajax call to be synchronous.
              cache: false,
              dataType: "html",
              success: function(html){ //<<-- This is where you get the ajax response
                returnHtml = html;
              }
            });
            alertify.alert('Transaction Success', 'Sell Order has been placed to off-chain order book.', function(){
            	window.location.reload();
            });
          });
        
      });
    }
    else{ 
     //     if(selectedMarket=="ETH"){
    //           if(userEtherBalanceOfSmartcontract < sellTokenAmount){
    //            //here checking the particulart ether balance in etherdelta smart contract
    //             alertify.error("Insufficient ether balance !");
    //             return false;
    //           }
    //         }else{
    //           if(parseFloat(userTokenbalanceOfSmartcontract) < sellTokenAmount){
    //            alertify.error("Insufficient token balance !");
    //            return false;
    //           }
    //       }
    		myContract.methods.balanceOf(selectedCurrencyContract, myAccountAddress).call({from:myAccountAddress},function(error, result1){
                  if(!error){
                    var result = result1/Math.pow(10, selectedTokenDecimal); 
                    result = logEtoLongNumber(result);
                    userTokenbalanceOfSmartcontract=parseFloat(result);
                    num = result.toString(); //If it's not already a String
                    dividend = num.substring(0, 15); //With 3 exposing the hundredths place
                    var totalItems = document.getElementsByClassName("balanceDisplayLabel");
                    var currentValue = "";
                    for (var i=0; i < totalItems.length; i++) {
                      currentValue = totalItems[i].innerText;
                      totalItems[i].innerHTML=dividend;
                    }
                }
                });
              if(parseFloat(userTokenbalanceOfSmartcontract) < parseFloat(sellTokenAmount)){
               alertify.error("Insufficient token balance !");
               return false;
              }
           //generate random number to be used as nounce
          var nounce = Math.floor((Math.random() * 1000000) + 1);
          //generating v r s for the sell order
              var sellTokenAmountWEI=sellTokenAmount*Math.pow(10, selectedTokenDecimal);
              sellTokenAmountWEI = logEtoDecimal(sellTokenAmountWEI, selectedTokenDecimal);
              var sellETHAmountWEI = sellETHAmount*Math.pow(10, marketDecimals);
              sellETHAmountWEI = logEtoDecimal(sellETHAmountWEI, marketDecimals);
          
          sellETHAmount=sellETHAmount.toFixed(10);
          sellETHAmount=sellETHAmount.toString();
          
          sellExpiryInBlock=parseInt(sellExpiryInBlock)+currentBlock;
          var privateKeywithouthex =usersdata.accounts[selectedAccount].pk; 
          var privateKey=privateKeywithouthex;
          if(privateKeywithouthex.slice(0,2)!=="0x")         
          {             
              privateKey = "0x"+privateKeywithouthex;
          }
          if(selectedMarket=="ETH"){
            var msg = web3Infura.utils.soliditySha3(mainContractAddress,EtherAddress,sellETHAmountWEI,selectedCurrencyContract,sellTokenAmountWEI,sellExpiryInBlock);
          }else{
            var msg = web3Infura.utils.soliditySha3(mainContractAddress,marketsAddress,sellETHAmountWEI,selectedCurrencyContract,sellTokenAmountWEI,sellExpiryInBlock);
          }
          var signedData=web3Infura.eth.accounts.sign(msg, privateKey);
          var r=signedData.r;
          var s=signedData.s;
          var v=signedData.v;
        //send Ajax response to send all data to off-chain Order Book
          jQuery.ajax({
          url: "scripts/main-token.php?tokenGetAddress="+marketsAddress+"&tokenPriceInEther="+sellAmountPerEther+"&tokenName="+selectedMarket+"&tokenAmount="+sellETHAmount+"&giveTokenAmount="+sellTokenAmount+"&giveToken="+selectedCurrencyMenu+"&giveTokenAddress="+selectedCurrencyContract+"&expiryInBlock="+sellExpiryInBlock+"&buyOrSell=SELL&tradeMaker="+myAccountAddress+"&v="+v+"&r="+r+"&s="+s+"&FeeTake="+feeTakeInContract+"&nonce="+nounce,
          async: false, // <-- this forces the ajax call to be synchronous.
          cache: false,
          dataType: "html",
          success: function(html){ //<<-- This is where you get the ajax response
            returnHtml = html;
          }
        });
        alertify.alert('Transaction Success', 'Sell Order has been placed to off-chain order book.', function(){
          window.location.reload();
        });
      
    }
 }
});

/***************************************************/
/********* Buy Order to Sell Token Take ************/
/***************************************************/

$(".sellOrderBookTakeModal").on("click",async function() {
  const web3GasPrice = await myweb3.eth.getGasPrice();
	var tradeType = $("#"+this.id).data("tradetype");
	var tokenGet= $("#"+this.id).data("tokenget");
  var tokenGive = $("#"+this.id).data("tokengive");
  var amountGet= $("#"+this.id).data("getamount");
  var amountGive = $("#"+this.id).data("giveamount");
  var amountGetLeft= $("#"+this.id).data("getamountleft");
  var amountGiveLeft = $("#"+this.id).data("giveamountleft");
	var tokenPriceInEther= $("#"+this.id).data("tokenpriceinether"); 
	var expiryInBlock= $("#"+this.id).data("expiryinblock");
	var selectedCurrencyContract= $("#"+this.id).data("selectedcurrencycontract");
	var v= $("#"+this.id).data("v");
	var r= $("#"+this.id).data("r");
	var s= $("#"+this.id).data("s");
	var nonceOrderBook= $("#"+this.id).data("nonceorderbook");
	var tradeMaker= $("#"+this.id).data("trademaker");
	var feeTakeInContract= $("#"+this.id).data("feetakeincontract");
	var etherAmount= $("#"+this.id).data("etheramount");
  var rowID= $("#"+this.id).data("id");
  alertify.confirm("<span style='padding-left: 17px;'>ASK ORDER</span>","<h4>Order Detail:</h4>"+amountGiveLeft+" "+tokenGive+"  @ "+tokenPriceInEther+ " " + tokenGet + "/"+tokenGive+"<br>Expires in "+expiryInBlock+" blocks<br><br>Token to buy("+tokenGive+")<br><input type='hidden' class='orderType' value='buy'> <input type='hidden' id='tokenexhangeprice' value="+tokenPriceInEther+"><input type=text class='form-control trn ' id='sellorderbookTokenAmount' onkeyup='getEtherPriceOrderBookTakeModal()'><br>"+tokenGet+"<br><input type=text class='form-control trn' readonly='' id='sellorderbookAmountPerEther'><br>Fee ("+tokenGet+")<br><input type=text class='form-control trn' readonly='' id='sellorderbookEthFeeTake' value="+feeTakeInContract+"><br>", function(){
    //var TokenAmount=document.getElementById('sellorderbookTokenAmount').value;
    var TokenAmount = document.getElementById('sellorderbookAmountPerEther').value;
    if(selectedMarket=="ETH"){
      var etherspendamount=document.getElementById('sellorderbookAmountPerEther').value;  
    }else{
      var etherspendamount=0;
    }
    var sellorderbookEthFeeTake=document.getElementById('sellorderbookEthFeeTake').value;
    var fees = sellorderbookEthFeeTake;
    var totaletherspeand=parseFloat(sellorderbookEthFeeTake)+parseFloat(etherspendamount);
    
    var status="OK";
    if(amountGive < TokenAmount)
    {
      //alertify.error("You are not able to sell more then account balance!");
      //status="NOTOK";
    }
    if (isNaN(TokenAmount))
    {
        alertify.error("Please enter valid token amount!");
      status="NOTOK";
    }
    if(TokenAmount <= 0)
    {
      alertify.error("Please enter token amount more then 0 for sell amount!");
      status="NOTOK";
    }
    if(selectedMarket=="ETH"){
        if(etherspendamount <= 0)
        {
          status="NOTOK";
        }
        if(isNaN(etherspendamount))
        {
          status="NOTOK";
        }
    }
    if(status == "OK"){
       
        var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        if(selectedAccount < 0){
            alertify.error("Please select an account using the account dropdown in the upper right");
        }
        else if(usersdata.accounts[selectedAccount].kind == 'MetaMask')
        {
    var web3Infura = new Web3(Web3.givenProvider || "http://localhost:8545");
    web3Infura.eth.getAccounts(function(error,result){
    var myAccountAddress = result.toString();

    var myContract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
      from: myAccountAddress, // default from address
    });
    var userTokenBalanceOfSmartcontract="";
    var status="OK";
    console.log(marketsAddress);
    console.log(myAccountAddress);
    myContract.methods.balanceOf(marketsAddress, myAccountAddress).call({from:myAccountAddress},function(error, result){
    if(!error){
        var result = result/Math.pow(10, marketDecimals);
        userTokenBalanceOfSmartcontract=result;
        console.log(userTokenBalanceOfSmartcontract);
        console.log(TokenAmount);
        
        if(parseFloat(userTokenBalanceOfSmartcontract) < TokenAmount)
      {
          alertify.error("Please deposit token!");
          status="NOTOK";
      }

      if(status == "OK")
      {
            var v1=web3Infura.utils.hexToNumber(v);
            var addressArray;

              addressArray            = [marketsAddress,selectedCurrencyContract,tradeMaker,referrer];
              var tokenGetAmount      = amountGet * Math.pow(10, marketDecimals);
              tokenGetAmount = logEtoDecimal(tokenGetAmount, marketDecimals);
              var tokenGiveAmount     = amountGive *Math.pow(10, selectedTokenDecimal);
              tokenGiveAmount = logEtoDecimal(tokenGiveAmount, selectedTokenDecimal);
              var amount              = TokenAmount* Math.pow(10, marketDecimals);
              amount = logEtoDecimal(amount, marketDecimals);
          
           var data = myContract.methods.trade(addressArray,tokenGetAmount,tokenGiveAmount,expiryInBlock,v1,r,s,amount,rowID).encodeABI();
          //var data = myContract.methods.trade(EtherAddress,etherAmount1,selectedCurrencyContract,tokenAmountTotal1,expiryInBlock,nonceOrderBook,tradeMaker,v1,r,s,weiofether).encodeABI();                   
          web3Infura.eth.sendTransaction({
            from: myAccountAddress,
            to: mainContractAddress,
            //gasPrice: localStorage.getItem('ethGasPrice'),
            gasPrice :web3GasPrice,
            gasLimit: gasTrade,
            data: data, // deploying a contracrt
            }).on('transactionHash',function(hash){
                document.getElementById("tradeWaitingDiv").style.display= "block";
              
              alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
            }).on('receipt', function(receipt){
                  document.getElementById("tradeWaitingDiv").style.display= "none";
                  alertify.alert('Trade Success', 'Trade completed.', function(){
                          window.location.reload();
                        });
              
              }).on('error',function(error)
                {
                    var ErrorMsg=error.message;
                   // ErrorMsg=Errormsgfunction(ErrorMsg);
                    //ErrorMsg=ErrorMsg.slice(0,100);
                    document.getElementById("tradeWaitingDiv").style.display= "none";
                  alertify.alert('Fail', ""+ErrorMsg, function(){
                          window.location.reload();
                        });
                });
            }
        //}
      //});
    }
    });
      
      });
    }
    
    
    else
    {
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        //var privateKey = new Buffer(privateKeywithouthex , 'hex');
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x")  
        {  
            privateKey = "0x"+privateKeywithouthex;
        }
      
      var myContract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
        from: myAccountAddress, // default from address
      }); 
      
      var userEtherBalanceOfSmartcontract="";
      var status="OK";
      
        myContract.methods.balanceOf(selectedCurrencyContract,tradeMaker).call({from:myAccountAddress},function(error, result){
        if(!error){
            var result = result/Math.pow(10, selectedTokenDecimal);
            userTokenBalanceOfSmartcontract=result;
            if(userTokenBalanceOfSmartcontract < TokenAmount)
            {
              alertify.error("The trade maker has not suficient balance deposited!");
              status="NOTOK";
            }
          if(status == "OK")
          {  
              

              var v1=web3Infura.utils.hexToNumber(v);
              var addressArray;

              addressArray            = [marketsAddress,selectedCurrencyContract,tradeMaker,referrer];
              var tokenGetAmount      = amountGet * Math.pow(10, marketDecimals);
              tokenGetAmount = logEtoDecimal(tokenGetAmount, marketDecimals);
              var tokenGiveAmount     = amountGive *Math.pow(10, selectedTokenDecimal);
              tokenGiveAmount = logEtoDecimal(tokenGiveAmount, selectedTokenDecimal);
              var amount              = TokenAmount* Math.pow(10, marketDecimals);
              amount = logEtoDecimal(amount, marketDecimals);
              
              var data = myContract.methods.trade(addressArray,tokenGetAmount,tokenGiveAmount,expiryInBlock,v1,r,s,amount,rowID).encodeABI();
          
              web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
                  
              if(!error){
                var nonce = result.toString();
                var raw = {
                "nonce":web3Infura.utils.toHex(nonce),
                "from": myAccountAddress,
                  "to": mainContractAddress,
                  //"gasPrice": localStorage.getItem('ethGasPrice'),
                  "gasPrice" :web3GasPrice,
                  "gasLimit": gasTrade,
                  "data": data, // deploying a contracrt
                  "chainId":chainID
                };
                web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
                if(!error)
                {
                    var serializedTx=result.rawTransaction;
                    web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
                    .on('transactionHash',function(hash){
                document.getElementById("tradeWaitingDiv").style.display= "block";
          
              alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
            }).on('receipt', function(receipt){
              
                      document.getElementById("tradeWaitingDiv").style.display= "none";
                  alertify.alert('Trade Success', 'Trade completed.', function(){
                          window.location.reload();
                        });
              
              }).on('error',function(error)
                {
                    var ErrorMsg=error.message;
                   // ErrorMsg=Errormsgfunction(ErrorMsg);
                    //ErrorMsg=ErrorMsg.slice(0,100);
                      document.getElementById("tradeWaitingDiv").style.display= "none";
                  alertify.alert('Fail', ""+ErrorMsg, function(){
                              window.location.reload();
                            });
                });
                }
                
              });
            }
          });
        }
      }
        //});
        //}
      });
      
      
    }
      }
  }, function(){ alertify.error('User Cancelled'); });


});

/***************************************************/
/********* Sell Order to Buy Token Take ************/
/****************************************************/


$(".buyOrderBookTakeModal").on("click",async function() {
  const web3GasPrice = await myweb3.eth.getGasPrice();
  var tradeType = $("#"+this.id).data("tradetype");
	var tokenGet= $("#"+this.id).data("tokenget");
  var tokenGive = $("#"+this.id).data("tokengive");
  var amountGet= $("#"+this.id).data("getamount");
  var amountGive = $("#"+this.id).data("giveamount");
  var amountGetLeft= $("#"+this.id).data("getamountleft");
  var amountGiveLeft = $("#"+this.id).data("giveamountleft");
	var tokenPriceInEther= $("#"+this.id).data("tokenpriceinether"); 
	var expiryInBlock= $("#"+this.id).data("expiryinblock");
	var selectedCurrencyContract= $("#"+this.id).data("selectedcurrencycontract");
	var web3Infura = new Web3(Web3.givenProvider || ethProvider);
	var v= $("#"+this.id).data("v");
	var r= $("#"+this.id).data("r");
	var s= $("#"+this.id).data("s");
	var nonceOrderBook= $("#"+this.id).data("nonceorderbook");
	var tradeMaker= $("#"+this.id).data("trademaker");
	var etherAmount= $("#"+this.id).data("etheramount");
  var rowID = $("#"+this.id).data("id");

  alertify.confirm("<span style='padding-left: 17px;'>BID ORDER</span>","<h4>Order Detail:</h4>"+amountGetLeft+" "+tokenGet+"  @ "+tokenPriceInEther + " " + tokenGive + "/"+tokenGet+"<br>Expires in "+expiryInBlock+" blocks<br><br>Token to sell("+tokenGet+") <br><input type='hidden' class='orderType' value='sell'><input type='hidden' id='tokenexhangeprice' value="+tokenPriceInEther+"><input type=text class='form-control trn '  id='sellorderbookTokenAmount' onkeyup='getEtherPriceOrderBookTakeModal()'><br>"+tokenGive+"<br><input type=text class='form-control trn' readonly='' id='sellorderbookAmountPerEther'><br>Fee ("+tokenGive+")<br><input type=text class='form-control trn' readonly='' id='buyorderbookEthFeeTake' value=''><br>", function(){

    var TokenAmount=document.getElementById('sellorderbookTokenAmount').value;

    if(selectedMarket=="ETH"){
      var etherspendamount=document.getElementById('sellorderbookAmountPerEther').value;  
    }else{
      var etherspendamount=0;
    }
    
    var sellorderbookEthFeeTake=document.getElementById('buyorderbookEthFeeTake').value;
    var fees = sellorderbookEthFeeTake;
    var totaletherspeand=parseFloat(sellorderbookEthFeeTake)+parseFloat(etherspendamount);
    
    var status="OK";
    if(amountGet < TokenAmount)
    {
    	alertify.error("You are not able to sell more then required !");
    	status="NOTOK";
    }
    if (isNaN(TokenAmount))
    {
        alertify.error("Please enter valid token amount !");
    	status="NOTOK";
    }
    if(TokenAmount <= 0)
    {
    	alertify.error("Please enter token amount more then 0 for sell amount !");
    	status="NOTOK";
    }
    if(selectedMarket=="ETH"){
        if(etherspendamount <= 0)
        {
        	status="NOTOK";
        }
        if(isNaN(etherspendamount))
        {
        	status="NOTOK";
        }
    }
   
    if(status == "OK")
    {
      var usersdata = localStorage.getItem('EtherDelta');
        usersdata=JSON.parse(usersdata);
        var selectedAccount=usersdata.selectedAccount;
        
        if(selectedAccount < 0){
            alertify.error("Please select an account using the account dropdown in the upper right");
        }
        else if(usersdata.accounts[selectedAccount].kind == 'MetaMask')
        {
    	var web3Infura = new Web3(Web3.givenProvider || "http://localhost:8545");
    	web3Infura.eth.getAccounts(function(error,result){
    	var myAccountAddress = result.toString();

    	var myContract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
    		from: myAccountAddress, // default from address
    	}); 

    	var userEtherBalanceOfSmartcontract="";
    	var status="OK";
    	myContract.methods.balanceOf(selectedCurrencyContract, myAccountAddress).call({from:myAccountAddress},function(error, result){
    	if(!error){
      		var result = result/Math.pow(10, selectedTokenDecimal);
      		userEtherBalanceOfSmartcontract=result;
    			if(userEtherBalanceOfSmartcontract < TokenAmount)
    			{
     				 alertify.error("Please deposit token!");
      				 status="NOTOK";
    			}
                
    			if(status == "OK")
    			{ 
            	var v1=web3Infura.utils.hexToNumber(v);
      			 
              var addressArray;

                addressArray      = [selectedCurrencyContract,marketsAddress,tradeMaker,referrer]; 
                var tokenGetAmount      = amountGet * Math.pow(10, selectedTokenDecimal);
                tokenGetAmount = logEtoDecimal(tokenGetAmount, selectedTokenDecimal);
                var tokenGiveAmount     = amountGive *Math.pow(10, marketDecimals);
                tokenGiveAmount = logEtoDecimal(tokenGiveAmount, marketDecimals);
                var amount              = TokenAmount* Math.pow(10, selectedTokenDecimal);
                amount = logEtoDecimal(amount, selectedTokenDecimal);
              
            
      			//var data = myContract.methods.trade(selectedCurrencyContract,tokenAmountTotal1,EtherAddress,etherAmount1,expiryInBlock,nonceOrderBook,tradeMaker,v1,r,s,weioftoken).encodeABI();
            var data = myContract.methods.trade(addressArray,tokenGetAmount,tokenGiveAmount,expiryInBlock,v1,r,s,amount,rowID).encodeABI();
        		web3Infura.eth.sendTransaction({
        		from: myAccountAddress,
        		to: mainContractAddress,
        		//gasPrice: localStorage.getItem('ethGasPrice'),
            gasPrice : web3GasPrice,
        		gasLimit: gasTrade,
        		data: data, // deploying a contracrt
        		}).on('transactionHash',function(hash){
                document.getElementById("tradeWaitingDiv").style.display= "block";
        			alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
      			}).on('receipt', function(receipt){
        			      	document.getElementById("tradeWaitingDiv").style.display= "none";
            			alertify.alert('Trade Success', 'Trade completed.', function(){
                        	window.location.reload();
                        });
      				}).on('error',function(error)
      					{
                			document.getElementById("tradeWaitingDiv").style.display= "none";
        					alertify.alert('Fail', 'This trade is already completed.', function(){
                            	window.location.reload();
                            });
      					});
  					}
  				//}
  			//});
    	    }
    	});
  		}); 
      }
      else
      { //this when metamask is not there and we need to use local wallet of user, having private key
         
        var web3Infura = new Web3(Web3.givenProvider || ethProvider);
        var myAccountAddress=usersdata.accounts[selectedAccount].addr; 
        var privateKeywithouthex =usersdata.accounts[selectedAccount].pk;  
        //var privateKey = new Buffer(privateKeywithouthex , 'hex');
        var privateKey=privateKeywithouthex;
        if(privateKeywithouthex.slice(0,2)!=="0x") 
        {
            privateKey = "0x"+privateKeywithouthex;
        }

       var myContract = new web3Infura.eth.Contract(arrayABI, mainContractAddress, {
        from: myAccountAddress, // default from address
      }); 
      var userEtherBalanceOfSmartcontract="";
      var status="OK";
      myContract.methods.balanceOf(selectedCurrencyContract, myAccountAddress).call({from:myAccountAddress},function(error, result){
      if(!error){
          var result = result/Math.pow(10, selectedTokenDecimal);
          userEtherBalanceOfSmartcontract=result;
          if(userEtherBalanceOfSmartcontract < TokenAmount)
          {
             alertify.error("Please deposit token!");
               status="NOTOK";
          }
           
          if(status == "OK")
          {  
              var v1=web3Infura.utils.hexToNumber(v);
              
              var addressArray;
              
                addressArray      = [selectedCurrencyContract,marketsAddress,tradeMaker,referrer]; 
                var tokenGetAmount      = amountGet * Math.pow(10, selectedTokenDecimal);
                tokenGetAmount = logEtoDecimal(tokenGetAmount, selectedTokenDecimal);
                var tokenGiveAmount     = amountGive *Math.pow(10, marketDecimals);
                tokenGiveAmount = logEtoDecimal(tokenGiveAmount, marketDecimals);
                var amount              = TokenAmount* Math.pow(10, selectedTokenDecimal);
                amount = logEtoDecimal(amount, selectedTokenDecimal);
            
            var data = myContract.methods.trade(addressArray,tokenGetAmount,tokenGiveAmount,expiryInBlock,v1,r,s,amount,rowID).encodeABI();
            web3Infura.eth.getTransactionCount(myAccountAddress  , function(error, result){
              if(!error){
                var nonce = result.toString();
                var raw = {
                "nonce":web3Infura.utils.toHex(nonce),
                "from": myAccountAddress,
                  "to": mainContractAddress,
                 // "gasPrice": localStorage.getItem('ethGasPrice'),
                 "gasPrice" : web3GasPrice,
                  "gasLimit": gasTrade,
                  "data": data, // deploying a contracrt
                  "chainId":chainID
                };
                web3Infura.eth.accounts.signTransaction(raw, privateKey , function(error,result){
                if(!error)
                {
                    var serializedTx=result.rawTransaction;
                    web3Infura.eth.sendSignedTransaction(serializedTx.toString('hex'))
                    .on('transactionHash',function(hash){
                document.getElementById("tradeWaitingDiv").style.display= "block";
     
              alertify.alert("Transaction Recorded", "Please check the status of transaction at: <a href='"+etherscanTxURL+hash+"' target='_blank'> Etherscan</a>", function(){});
            }).on('receipt', function(receipt){
                  document.getElementById("tradeWaitingDiv").style.display= "none";
                  alertify.alert('Trade Success', 'Trade completed.', function(){
                          window.location.reload();
                        });
              }).on('error',function(error)
                {
                      document.getElementById("tradeWaitingDiv").style.display= "none";
                  alertify.alert('Fail', 'This trade is already completed.', function(){
                              window.location.reload();
                            });
                });
                }
              });
            }
          });
        }
      //}
      
    	//});
      }
      });
    	
	}
}
}, function(){ alertify.error('User Cancelled'); });

});


//this is to show Total Ether at the form to put BUY order in orderbook
$(".buyAmountPerEther").keyup(function(){
  var amount = document.getElementById("buyTokenAmount").value;
  var exchangeRate = document.getElementById("buyAmountPerEther").value;
  //checking the amount come in float or double
    if (isNaN(amount))
    {
      document.getElementById("buyETHAmount").innerHTML=0.000;
    }
    else if (isNaN(exchangeRate))
    {
      document.getElementById("buyETHAmount").innerHTML=0.000;
    }
    else if(amount.length == 0 || exchangeRate.length == 0 ){
      document.getElementById("buyETHAmount").innerHTML=0.000;
    }
    else if(amount <= 0)
    { 
     document.getElementById("buyETHAmount").innerHTML=0.000;
    }
    else if(exchangeRate <= 0)
    {
     document.getElementById("buyETHAmount").innerHTML=0.000; 
    }
    else if(amount > 0)
    {

      var buyETHAmount= amount*exchangeRate;
      buyETHAmount=buyETHAmount.toFixed(10);
      buyETHAmount=buyETHAmount.toString();
      document.getElementById("buyETHAmount").innerHTML=buyETHAmount;
      document.getElementById("buyETHAmount").value=buyETHAmount;
     
    }
    else if(exchangeRate > 0)
    {
     var buyETHAmount= amount*exchangeRate;
      buyETHAmount=buyETHAmount.toFixed(10);
      buyETHAmount=buyETHAmount.toString();
     document.getElementById("buyETHAmount").innerHTML=buyETHAmount;
      document.getElementById("buyETHAmount").value=buyETHAmount;
    }  
});



//this is to show Total Ether at the form to put BUY order in orderbook
$(".sellAmountPerEtherClass").keyup(function(){
	var amount = document.getElementById("sellTokenAmount").value;
  	var exchangeRate = document.getElementById("sellAmountPerEther").value;
  //checking the amount come in float or double
    if (isNaN(amount))
    {
      document.getElementById("sellETHAmount").innerHTML=0.000;
    }
    else if (isNaN(exchangeRate))
    {
      document.getElementById("sellETHAmount").innerHTML=0.000;
    }
    else if(amount.length == 0 || exchangeRate.length == 0 ){
      document.getElementById("sellETHAmount").innerHTML=0.000;
    }
    else if(amount <= 0)
    {
     document.getElementById("sellETHAmount").innerHTML=0.000;
    }
    else if(exchangeRate <= 0)
    {
     document.getElementById("sellETHAmount").innerHTML=0.000; 
    }
    else if(amount > 0)
    {
      var sellETHAmount= amount*exchangeRate;
      sellETHAmount=sellETHAmount.toFixed(10);
      sellETHAmount=sellETHAmount.toString();
      document.getElementById("sellETHAmount").innerHTML=sellETHAmount;
    document.getElementById("sellETHAmount").value=sellETHAmount;
    }
    else if(exchangeRate > 0)
    {
     var sellETHAmount= amount*exchangeRate;
      sellETHAmount=sellETHAmount.toFixed(10);
      sellETHAmount=sellETHAmount.toString();
     document.getElementById("sellETHAmount").innerHTML=sellETHAmount;
    document.getElementById("sellETHAmount").value=sellETHAmount;
    }
});



$('.cancelOrder').click(function(){
  var thisid = $(this).data('id');
  var tradeMaker = myAccountAddress;
  var postData = "userAddress="+myAccountAddress + '&thisid='+thisid;
  $.ajax({
        url: "scripts/main-cancel.php",
        type: "post",
        data: postData,
        statusCode: {
            400: function() {
                console.log( "400 Bad Request" );
                return false;
            },
            403: function(){
                console.log('403 Forbidden');
                return false;
            },
            404: function() {
              console.log( "404 Not Found" );
              return false;
            },
            500: function() {
                console.log("500 Internal Server Error");
            },
            502: function() {
              console.log( "502 Bad request" );
              return false;
            },
            503: function() {
              console.log( "503 Service Unavailable" );
              return false;
            },
            504: function() {
              console.log( "504 Gateway Timeout" );
              return false;
            }
    
          },
        success: function(data) {
            data = JSON.parse(data);
            if(data.result==true){
                $('#orderID-'+thisid).hide();
                alertify.alert('Result', data.msg, function(){
                  window.location.reload();
                });

            }

            if(data.result==false){
              alertify.alert(data.msg);   
            }
            
        }
    }); 
});

}); //JQUERY ends
function getEtherPriceOrderBookTakeModal(){

	var amount = document.getElementById("sellorderbookTokenAmount").value;
  	var exchangeRate = document.getElementById("tokenexhangeprice").value;
    if (isNaN(amount))
    {
      document.getElementById("sellorderbookAmountPerEther").value=0.000;
    }
    else if (isNaN(exchangeRate))
    {
      document.getElementById("sellorderbookAmountPerEther").value=0.000;
    }
    else if(amount.length == 0 || exchangeRate.length == 0 ){
      document.getElementById("sellorderbookAmountPerEther").value=0.000;
    }
    else if(amount <= 0)
    { 
     document.getElementById("sellorderbookAmountPerEther").value=0.000;
    }
    else if(exchangeRate <= 0)
    {
     document.getElementById("sellorderbookAmountPerEther").value=0.000; 
    }
    else if(amount > 0)
    {
      var buyETHAmount= amount*exchangeRate;
      buyETHAmount=buyETHAmount.toFixed(10);
      buyETHAmount=buyETHAmount.toString();
      document.getElementById("sellorderbookAmountPerEther").value=buyETHAmount;
      var feeCalc = buyETHAmount * fees /100;
      feeCalc = logEtoLongNumber(feeCalc);
      var orderType = $('.orderType').val();
      if(orderType=='sell'){
         document.getElementById("buyorderbookEthFeeTake").value=feeCalc;
      }else{
        document.getElementById("sellorderbookEthFeeTake").value=feeCalc;
      }
      
    }
    else if(exchangeRate > 0)
    {
      var buyETHAmount= amount*exchangeRate;
      buyETHAmount=buyETHAmount.toFixed(10);
      buyETHAmount=buyETHAmount.toString();
     document.getElementById("sellorderbookAmountPerEther").value= buyETHAmount;
     var feeCalc = buyETHAmount * fees /100;
     feeCalc = logEtoLongNumber(feeCalc);
     if(orderType=='sell'){
      document.getElementById("buyorderbookEthFeeTake").value=feeCalc;
      }else{
      document.getElementById("sellorderbookEthFeeTake").value=feeCalc;  
      }
   }
}

function getTokenPriceOrderBookTakeModal(){

    var amount = document.getElementById("sellorderbookTokenAmount").value;
    var exchangeRate = document.getElementById("tokenexhangeprice").value;

    if (isNaN(amount))
    {
      document.getElementById("sellorderbookAmountPerEther").value=0.000;
    }
    else if (isNaN(exchangeRate))
    {
      document.getElementById("sellorderbookAmountPerEther").value=0.000;
    }
    else if(amount.length == 0 || exchangeRate.length == 0 ){
      document.getElementById("sellorderbookAmountPerEther").value=0.000;
    }
    else if(amount <= 0)
    { 
     document.getElementById("sellorderbookAmountPerEther").value=0.000;
    }
    else if(exchangeRate <= 0)
    {
     document.getElementById("sellorderbookAmountPerEther").value=0.000; 
    }
    else if(amount > 0)
    {
      var buyETHAmount= amount*exchangeRate;
      buyETHAmount=buyETHAmount.toFixed(10);
      buyETHAmount=buyETHAmount.toString();
      document.getElementById("sellorderbookAmountPerEther").value=buyETHAmount;
      var feeCalc = buyETHAmount * fees /100;
      feeCalc = logEtoLongNumber(feeCalc);
      var orderType = $('.orderType').val();
      if(orderType=='sell'){
         document.getElementById("buyorderbookEthFeeTake").value=feeCalc;
      }else{
        document.getElementById("sellorderbookEthFeeTake").value=feeCalc;
      }
    }
    else if(exchangeRate > 0)
    {
      var buyETHAmount= amount*exchangeRate;
      buyETHAmount=buyETHAmount.toFixed(10);
      buyETHAmount=buyETHAmount.toString();
     document.getElementById("sellorderbookAmountPerEther").value= buyETHAmount;
     var feeCalc = buyETHAmount * fees /100;
     feeCalc = logEtoLongNumber(feeCalc);
     if(orderType=='sell'){
      document.getElementById("buyorderbookEthFeeTake").value=feeCalc;
      }else{
      document.getElementById("sellorderbookEthFeeTake").value=feeCalc;  
      }
     
    }
}

function strtodec(dec){
stringf = "";
for(var i=0;i<dec;i++){
stringf = stringf+"0";
}
return stringf;
}