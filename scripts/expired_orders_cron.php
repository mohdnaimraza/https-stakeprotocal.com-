<?php //all the server side processing will happen here
exit;
include('site_config.php'); //including database files
$apiKey = $adminSettings[0]['etherscanAPIKey'];
if($tmode=='yes'){
	$url = "https://api-rinkeby.etherscan.io/api?module=proxy&action=eth_blockNumber&apikey=".$apiKey;
}else{
	$url = "https://api.etherscan.io/api?module=proxy&action=eth_blockNumber&apikey=".$apiKey;
}

 $result  = file_get_contents($url);
 $result = json_decode($result, true);
 $block = hexdec($result['result']);
 
if($block>0){
	//updating exchange order book table
 $sql = "UPDATE exchangeorderbook SET Status='Expired' WHERE expiryInBlock<".$block." AND Status='Active'";
 //$conn->query($sql);
echo "Successfully Updated Expired record into Trade";

}