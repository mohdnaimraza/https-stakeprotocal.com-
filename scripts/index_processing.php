<?php //all the server side processing will happen here
//admin settings code and the code to check testnet or main net is transfered to databaseconfig file. So that those info can be available to other files as well.
 $selectedMarket = 'ETH';  
$stmt = $conn->prepare("SELECT * from tokendetails where tokenSymbol='".secureInput($selectedCurrency)."'");
$stmt->execute();
$selectedCurrencyData = $stmt->fetchAll();
 $selectedTradingTokenContract = $selectedCurrencyData[0]['tokenContractAddress'];
if(isset($_COOKIE["market"])){ 
    $selectedMarket = $_COOKIE["market"]; 
} else{ 
   $selectedMarket = 'ETH';  
}
//fetching admin setting
$stmt = $conn->prepare("SELECT * from admin_settings"); 
$stmt->execute();
$adminSetting = $stmt->fetchAll();


//finding details of selected currency token from tokenDetails table START------------------------------------>>
 $stmt = $conn->prepare("SELECT * from market where is_status=0"); 
 $stmt->execute();
 $markets = $stmt->fetchAll();
// if(count($markets) != 1){
//     //this is rare situation where the token symbol from cookie and DB has no detail. In that rare case, we will use default token's details
//     $stmt = $conn->prepare("SELECT * from tokendetails where tokenSymbol='".$adminSettings[0]['defaultSelectedCurrency']."'"); 
//     $stmt->execute();
//     $selectedCurrencyData = $stmt->fetchAll();
//     $selectedTradingTokenContract = $selectedCurrencyData[0]['tokenContractAddress'];
// }

// if(isset($_COOKIE["market"])){ 
//     $selectedMarket = $_COOKIE["market"]; 
// } else{ 
//    //$selectedMarket = $adminSettings[0]['defaultMarket'];  
// $selectedMarket = 'ETH';  
// }
// if($selectedMarket!=='ETH'){
//     $marketsABI = @file_get_contents('json_abi/'.$selectedMarket.'ABI.json');    
// }else{
//     //$marketsABI = @file_get_contents('json_abi/mainABI.json');    
//     $marketsABI = json_encode(array());
// }

if(isset($_COOKIE["market"])){ 
    $selectedMarket = $_COOKIE["market"]; 
} else{ 
   $selectedMarket = $adminSettings[0]['defaultMarket'];  
}
if($selectedMarket!=='ETH'){
    $marketsABI = @file_get_contents('json_abi/'.$selectedMarket.'ABI.json');    
}else{
    //$marketsABI = @file_get_contents('json_abi/mainABI.json');    
    $marketsABI = json_encode(array());
}
//get market token address and abi

$stmt = $conn->prepare("SELECT * from market where name='".secureInput($selectedMarket)."'"); 
$stmt->execute();
$marketsData = $stmt->fetchAll();
$marketsAddress = $marketsData[0]['address'];
$marketDecimals = $marketsData[0]['decimals'];
$marketInfo = $marketsData[0]['marketInfo'];

if($selectedMarket=='ETH'){
$marketsABI =  @file_get_contents('json_abi/OtherTokenAbi.json');
}else{
$marketsABI =  @file_get_contents('json_abi/'.$selectedMarket.'ABI.json');  
}





// $selectedCurrencyData is an array which holds data of selected currency
//finding details of selected currency token from tokenDetails table END ------------------------------------>>

//fetching Currency Menu dropdown START ----------------------------------------------------------------------->
if($tmode=='yes'){ 
$stmt = $conn->prepare("SELECT * from tokendetails where istestnet=1 order by tokenSymbol asc"); 
}else{
  $stmt = $conn->prepare("SELECT * from tokendetails where istestnet=0 order by tokenSymbol asc"); 
}
$stmt->execute();
$tokensDataALL = $stmt->fetchAll();
//print_r($tokensDataALL);
//fetching Currency Menu dropdown END ------------------------------------------------------------------------->

//finding trading data START ---------------------------------------------------------------------------------->>
//finding 24hour trade volume

$stmt = $conn->prepare("SELECT SUM( amountGet) as tokenTradeVolume from trades WHERE tokenGet = '".$selectedCurrencyData[0]['tokenContractAddress']."' AND (timestamp >= UNIX_TIMESTAMP(now() - INTERVAL 1 DAY))  "); 
$stmt->execute();
$tradingVolume = $stmt->fetchAll();
if(isset($tradingVolume[0]['tokenTradeVolume']) && $tradingVolume[0]['tokenTradeVolume'] > 0){ $tradingVolume24hrs = $tradingVolume[0]['tokenTradeVolume'];} else{ $tradingVolume24hrs = 0; }

//finding 24 hour MAX 
$stmt = $conn->prepare("SELECT MAX( amountGet) as tokenTradeVolumeMax from trades WHERE tokenGet = '".$selectedCurrencyData[0]['tokenContractAddress']."' AND (timestamp >= UNIX_TIMESTAMP(now() - INTERVAL 1 DAY))  "); 
$stmt->execute();
$tradingVolumeMax = $stmt->fetchAll();
if(isset($tradingVolumeMax[0]['tokenTradeVolumeMax']) && $tradingVolumeMax[0]['tokenTradeVolumeMax'] > 0){ $tradingVolume24hrsMax = $tradingVolumeMax[0]['tokenTradeVolumeMax'];} else{ $tradingVolume24hrsMax = 0; }

//finding 24 hour MIN 
$stmt = $conn->prepare("SELECT MIN( amountGet) as tokenTradeVolumeMin from trades WHERE tokenGet = '".$selectedCurrencyData[0]['tokenContractAddress']."' AND (timestamp >= UNIX_TIMESTAMP(now() - INTERVAL 1 DAY))  "); 
$stmt->execute();
$tradingVolumeMin = $stmt->fetchAll();
if(isset($tradingVolumeMin[0]['tokenTradeVolumeMin']) && $tradingVolumeMin[0]['tokenTradeVolumeMin'] > 0){ $tradingVolume24hrsMin = $tradingVolumeMin[0]['tokenTradeVolumeMin'];} else{ $tradingVolume24hrsMin = 0; }

//finding last trade price 
$stmt = $conn->prepare("SELECT * from trades WHERE tokenGet = '".$selectedCurrencyData[0]['tokenContractAddress']."' AND (timestamp >= UNIX_TIMESTAMP(now() - INTERVAL 1 DAY)) ORDER BY timestamp DESC LIMIT 1 "); 
$stmt->execute();
$tradingLastPriceRow = $stmt->fetchAll();
if(isset($tradingLastPriceRow[0]['AmountOfToken']) && $tradingLastPriceRow[0]['AmountOfToken'] > 0){ $tradingLastPrice = $tradingLastPriceRow[0]['AmountOfToken'];} else{ $tradingLastPrice = 0; }

//finding trading data END ----------------------------------------------------------------------------------->>

//fetching orderbook data  start ----------------------------------------------------------------------->>


if($selectedMarket=='ETH'){
    //RED - sell order
    $stmt = $conn->prepare("SELECT * from exchangeorderbook where giveTokenName='".$selectedCurrencyData[0]['tokenSymbol']."'  and tokenGetName='".$selectedMarket."' and buyOrSell='SELL' and Status='Active' order by tokenPriceInEther ASC"); 
    $stmt->execute();
    $orderBookSellArray = $stmt->fetchAll();
    //Green - Buy order
    $stmt = $conn->prepare("SELECT * from exchangeorderbook where tokenGetName='".$selectedCurrencyData[0]['tokenSymbol']."' and giveTokenName='".$selectedMarket."' and buyOrSell='BUY' and Status='Active' order by tokenPriceInEther DESC"); 
    $stmt->execute();
    $orderBookBuyArray = $stmt->fetchAll();
}else{
    //RED - sell order
    $stmt = $conn->prepare("SELECT * from exchangeorderbook where giveTokenName='".$selectedCurrencyData[0]['tokenSymbol']."' and tokenGetName='".$selectedMarket."' and  buyOrSell='SELL' and Status='Active' order by tokenPriceInEther ASC"); 
    $stmt->execute();
    $orderBookSellArray = $stmt->fetchAll();

    //Green - Buy order
    $stmt = $conn->prepare("SELECT * from exchangeorderbook where tokenGetName='".$selectedCurrencyData[0]['tokenSymbol']."' and giveTokenName='".$selectedMarket."' and buyOrSell='BUY' and Status='Active' order by tokenPriceInEther DESC"); 
    $stmt->execute();
    $orderBookBuyArray = $stmt->fetchAll();
}

//fetching orderbook data  END ----------------------------------------------------------------------->>

//fetching trade table data start ---------------------------------------------------------------------------------->>
if($selectedMarket=='ETH'){
    //$stmt = $conn->prepare("SELECT * from trades where tokenGet='".$selectedCurrencyData[0]['tokenContractAddress']."' order by timestamp DESC"); 
$stmt = $conn->prepare("SELECT * from trades where tokenGet='".$selectedCurrencyData[0]['tokenContractAddress']."' and tokenGive='".$marketsAddress."' UNION ALL SELECT * from trades where tokenGive='".$selectedCurrencyData[0]['tokenContractAddress']."' and tokenGet='".$marketsAddress."' order by timestamp DESC");
}else{
    $stmt = $conn->prepare("SELECT * from trades where tokenGet='".$selectedCurrencyData[0]['tokenContractAddress']."' and tokenGive='".$marketsAddress."' UNION ALL SELECT * from trades where tokenGive='".$selectedCurrencyData[0]['tokenContractAddress']."' and tokenGet='".$marketsAddress."' order by timestamp DESC");
}
$stmt->execute();

$tradeHistoryArray = $stmt->fetchAll();
//fetching trade table data END   ---------------------------------------------------------------------------------->>
//getting user's public address from the cookies. User's Private keys are stored in their browser's local storage. 
//And we are NEVER accessing localstorage. That means user's private key is secure.  
/*if(isset($_COOKIE['userPublicAddress']) && $_COOKIE['userPublicAddress']!=''){
    $userPublicAddress = $_COOKIE['userPublicAddress'];
}else{
    //there is no users public address in cookie, that means we can not show them user specific data.
    $userPublicAddress = "";
}*/
if(isset($_GET['userPublicAddress']) && $_GET['userPublicAddress']!=''){
    $userPublicAddress = $_GET['userPublicAddress'];
}else{
    //there is no users public address in cookie, that means we can not show them user specific data.
    $userPublicAddress = "";
}

//fetching user's order data
$stmt = $conn->prepare("SELECT * from exchangeorderbook where tradeMaker='".$userPublicAddress."' AND Status='Active' order by timestamp DESC"); 
$stmt->execute();
$usersOrderDataArray = $stmt->fetchAll();

//fetching user's trade data
$stmt = $conn->prepare("SELECT * from trades where userAddress='".$userPublicAddress."' order by timestamp DESC LIMIT 25"); 
$stmt->execute();
$usersTradeDataArray = $stmt->fetchAll();

//fetching user's transactions data
$stmt = $conn->prepare("SELECT * from fundtransaction where userAddress='".$userPublicAddress."' order by timestamp DESC LIMIT 25"); 
$stmt->execute();
$usersTransactionsArray = $stmt->fetchAll();

//fetching 24 hours volume data
//$stmt = $conn->prepare("SELECT tokenGet, AVG(tokenVsTokenPrice) as tokenPrice, SUM( amountGet) as tokenTradeVolume from trades WHERE (timestamp >= UNIX_TIMESTAMP(now() - INTERVAL 1 DAY)) group by tokenGet order by tokenTradeVolume desc "); 
$stmt = $conn->prepare("SELECT tokenGet, AVG(tokenVsTokenPrice) as tokenPrice, SUM( amountGet) as tokenTradeVolume from trades WHERE tokenGet='".$selectedCurrencyData[0]['tokenContractAddress']."' and tokenGive='".$marketsAddress."' AND (timestamp >= UNIX_TIMESTAMP(now() - INTERVAL 1 DAY)) OR tokenGive='".$selectedCurrencyData[0]['tokenContractAddress']."' and tokenGet='".$marketsAddress."' AND (timestamp >= UNIX_TIMESTAMP(now() - INTERVAL 1 DAY)) group by tokenGet order by tokenTradeVolume desc ");
$stmt->execute();
$marketTradeData = $stmt->fetchAll();


?>