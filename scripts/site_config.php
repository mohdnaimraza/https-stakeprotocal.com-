<?php
include_once 'config.php';
//to check selected token currency in dropdown, so it can be used by all the files
//checking whether it is main net or testnet
//first getting data from the admin settings table
$stmt = $conn->prepare("SELECT * from admin_settings"); 
$stmt->execute();
$adminSettings = $stmt->fetchAll();

//checking whether it is main net or testnet
$tmode='';
if($adminSettings[0]['isTestNet'] === 'Yes'){
    $chainID = $adminSettings[0]['testNetChainID'];
    $etherScanTxURL = $adminSettings[0]['testNetEtherscanTxURL'];
    $etherScanAddressURL = $adminSettings[0]['testNetEtherscanAddressURL'];
    //$selectedCurrency = "TEST18";
    if(isset($_GET['token']) && $_GET['token']!=''){
        $selectedCurrency = secureInput($_GET['token']);
    }
    elseif(isset($_COOKIE['selectedCurrency'])) {
        $selectedCurrency = secureInput($_COOKIE['selectedCurrency']);
        
    } else {
        $selectedCurrency = $adminSettings[0]['defaultSelectedCurrency'];
    }
    $arrayABI = @file_get_contents('json_abi/testnetABI.json');
    $arrayEATABI = @file_get_contents('json_abi/EAToken.json');
    $mainContractAddress=$adminSettings[0]['extokeExchangeContractAddress'];
    $OtherTokenAbi = @file_get_contents('json_abi/OtherTokenAbi.json');
	  $tmode = 'yes';
}else{
    $chainID = $adminSettings[0]['mainNetChainID'];
    $etherScanTxURL = $adminSettings[0]['mainNetEtherscanTxURL'];
    $etherScanAddressURL = $adminSettings[0]['mainNetEtherscanAddressURL'];
    $mainContractAddress=$adminSettings[0]['extokeExchangeContractAddress'];
    $OtherTokenAbi=[];
	  $tmode = 'no';
    //fetching ABI of Extoke Main Contract 
    $arrayABI = @file_get_contents('json_abi/mainABI.json');
    $marketsABI = @file_get_contents('json_abi/'.$selectedMarket.'ABI.json');
    $arrayEATABI ="'empty'";
    //finding selected token. If there is token value in coockies, then we fetch from coockies, otherwise default token from admin setting
    if(isset($_GET['token']) && $_GET['token']!=''){
        $selectedCurrency = secureInput($_GET['token']);
    }
    elseif(isset($_COOKIE['selectedCurrency'])) {
        $selectedCurrency = secureInput($_COOKIE['selectedCurrency']);
        
    } else {
        $selectedCurrency = $adminSettings[0]['defaultSelectedCurrency'];
    }
  
}

//initialize website data
$stmt_page = $conn->prepare("SELECT * from site_settings"); 
$stmt_page->execute();
$siteSettings = $stmt_page->fetchAll();
$siteArray = [];
if($siteSettings){
    foreach($siteSettings as $siteSetting){
        //$siteArray[] = array($siteSetting['section_name'] => $siteSetting['section_text'],'status' =>$siteSetting['status']);
        $siteArray[$siteSetting['section_name']] = array('value'=>$siteSetting['section_text'],'status'=>$siteSetting['status']);
    }
   // print_r($siteArray);
   $siteName            = $siteArray['site_name']['value'];
   $siteTitle           = $siteArray['site_title']['value'];
   $siteDescription     = $siteArray['site_description']['value'];
   $site_important_text = $siteArray['site_important_text']['value']; 
   $siteLogo            = $siteArray['site_logo']['value'];
   $favicon             = $siteArray['favicon']['value'];
   $listing_guideline   = $siteArray['listing_guideline']['value'];
   $telegram_support    = $siteArray['telegram_support']['value'];
   $facebook_url        = $siteArray['facebook']['value'];
   $facebook_status     = $siteArray['facebook']['status'];
   $twitter_url         = $siteArray['twitter']['value'];
   $twitter_status      = $siteArray['twitter']['status'];
   $youtube_url         = $siteArray['youtube']['value'];
   $youtube_status      = $siteArray['youtube']['status'];
   $telegram_url        = $siteArray['telegram']['value'];
   $telegram_status     = $siteArray['telegram']['status'];
   $tradingHelpDoc      = $siteArray['tradingHelpDoc']['value'];
   $site_url            = $siteArray['site_url']['value'];
   $list_token_url      = $siteArray['list_token_url']['value'];

}
?>