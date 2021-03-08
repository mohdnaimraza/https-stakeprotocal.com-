<?php error_reporting(E_ALL);
include 'cron_config.php';
//this function will fetch and process data of ALL events
$sql = "SELECT MAX(blockNumber) as block FROM `fundtransaction`";
$result = $conn->prepare($sql); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 

if($number_of_rows==1){
	$row = mysqli_fetch_array($res);
	$block = $row['block'];
}else{
	$block = 0;
}

function fetchData($conn, $fromBlock){
    if ($fromBlock !== null)
    {
		$fromBlock = $fromBlock;
    }else{
    	$fromBlock = 0;
    }
	echo $url = ETHERSCAN_EVENT_URL."&fromBlock=".$fromBlock."&toBlock=latest&address=".CONTRACT_ADDRESS."&topic0=".Deposit."&apikey=".API_KEY;
   
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $output = curl_exec($ch);
    $output = json_decode($output);
    curl_close ($ch);
   
    
    $last = null;
      if($output->message=='OK'){
      	$result = $output->result;
        //print_r($result);
      		//echo 'Getting Records : '.count($result);
      		//echo '<br>';
     	foreach ($result as $key => $value) {
    // 		if($key>20){exit;}
    // 		//print_r($value);
     		$data = $value->data;
     		$blockNumber = substr($value->blockNumber,2);
     		$blockNumber = hexdec($blockNumber);
     		$timeStamp = substr($value->timeStamp,2);
     		$timeStamp = hexdec($timeStamp);
     		$transactionHash = $value->transactionHash;
           
     		$curTime = substr($data,0,66);
            $curTime = hexdec($curTime);
            
            $token = substr($data,66,64);
     		$token = '0x'.substr($token,24);
            
            $user = substr($data,130,64);
            $user = '0x'.substr($user,24);
            
     		$amount = substr($data,194,64);
     		$amount = hexdec('0x'.$amount);
     		$amount = $amount/1000000000000000000;
            
            $slCheck = "SELECT tokenSymbol FROM tokendetails where tokenContractAddress='".$token."' UNION select name as tokenSymbol from market where address='".$token."'";
             $result = $conn->prepare($slCheck); 
             $result->execute(); 
             $number_of_rows = $result->fetchColumn(); 
            
            if($number_of_rows){
                $type = "Deposit-".$number_of_rows;
                if($number_of_rows=='ETH'){
                    $etherAmount = $amount;
                }else{
                    $etherAmount = 0;    
                }
               
               $count = $conn->query("SELECT count(*) FROM fundtransaction where transactionHash='".$transactionHash."' AND tokenAddress='".$token."' AND userAddress='".$user."' AND timestamp=".$timeStamp)->fetchColumn();
               
                if($count==0){
         		     $sqlInsert = "INSERT INTO  fundtransaction(tokenAddress,tokenAmount,type,etherAmount,userAddress,transactionHash,blockNumber,timestamp) values('".$token."',".$amount.",'".$type."',".$etherAmount.",'".$user."','".$transactionHash."',".$blockNumber.",".$timeStamp.")";
         		 //echo '<br>';
         		     $conn->exec($sqlInsert);
                 }
            }
    	}
    }
}
fetchData($conn, $block);
$conn = null;

?>