<?php
include_once 'config.php';
//to check selected token currency in dropdown, so it can be used by all the files
//checking whether it is main net or testnet
//first getting data from the admin settings table
$stmt = $conn->prepare("SELECT * from admin_settings"); 
$stmt->execute();
$adminSettings = $stmt->fetchAll();

//checking whether it is main net or testnet
if($adminSettings[0]['isTestNet'] === 'Yes'){
	define('API_KEY' ,$adminSettings[0]['etherscanAPIKey']);
	define('CONTRACT_ADDRESS',$adminSettings[0]['extokeExchangeContractAddress']);
	define('Trade',"0x35cc15ad16b95a9d45fadedd6ecbbd89858ec4bfedf144506f3f531d3eb63509");
	define('Deposit', "0xeb65d0f36862bbd8763c5e2c983c9d753267d223eee35a224d8d0a9d7ef433a2");
	define('Withdraw', "0xfe7813e2866053d5c3938554e517b554fce6666a6561bed9eaa7419b29fa9b68");

	define('ETHERSCAN_EVENT_URL',"https://api-rinkeby.etherscan.io/api?module=logs&action=getLogs");
	define('ETHERSCANT_TX_URL',"https://api-rinkeby.etherscan.io/api?module=proxy&action=eth_getTransactionByHash");

}else{
	define('API_KEY' ,$adminSettings[0]['etherscanAPIKey']);
	define('CONTRACT_ADDRESS',$adminSettings[0]['extokeExchangeContractAddress']);
	define('Trade',"0x35cc15ad16b95a9d45fadedd6ecbbd89858ec4bfedf144506f3f531d3eb63509");
	define('Deposit', "0xeb65d0f36862bbd8763c5e2c983c9d753267d223eee35a224d8d0a9d7ef433a2");
	define('Withdraw', "0xfe7813e2866053d5c3938554e517b554fce6666a6561bed9eaa7419b29fa9b68");
	define('ETHERSCAN_EVENT_URL',"https://api.etherscan.io/api?module=logs&action=getLogs");
	define('ETHERSCANT_TX_URL',"https://api.etherscan.io/api?module=proxy&action=eth_getTransactionByHash");
}
?>