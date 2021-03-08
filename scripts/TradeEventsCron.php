<?php error_reporting(E_ALL);
include 'cron_config.php';
//this function will fetch and process data of ALL events
$sql = "SELECT MAX(blockNumber) as block FROM `trades`";
$result = $conn->prepare($sql); 
$result->execute(); 
$block = $result->fetchColumn(); 


if(!$block){
	$block = 0;
}

function fetchData($conn, $fromBlock){
    if ($fromBlock !== null)
    {
		$fromBlock = $fromBlock;
    }else{
    	$fromBlock = 0;
    }
	echo $url = ETHERSCAN_EVENT_URL."&fromBlock=".$fromBlock."&toBlock=latest&address=".CONTRACT_ADDRESS."&topic0=".Trade."&apikey=".API_KEY;
  
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
        $addressArray = $conn->query("SELECT address from market where is_status=0")->fetchAll(); 
            
     	foreach ($result as $key => $value) {
    // 		if($key>20){exit;}
     		//print_r($value);
     		$data = $value->data;
     		$blockNumber = substr($value->blockNumber,2);
     		$blockNumber = hexdec($blockNumber);
     		$timeStamp = substr($value->timeStamp,2);
     		$timeStamp = hexdec($timeStamp);
     		$transactionHash = $value->transactionHash;
           
     		$curTime = substr($data,0,66);
            $curTime = hexdec($curTime);
            
            $tokenGet = substr($data,66,64);
     		$tokenGet = '0x'.substr($tokenGet,24);
            
            $amountGet = substr($data,130,64);
            $amountGet = hexdec('0x'.$amountGet);
            $amountGet = $amountGet/1000000000000000000;
            
            
            $tokenGive = substr($data,194,64);
            $tokenGive = '0x'.substr($tokenGive,24);
            
            $amountGive = substr($data,258,64);
            $amountGive = hexdec('0x'.$amountGive);
            $amountGive = $amountGive/1000000000000000000;
            

     		$user = substr($data,322,64);
     		$user = '0x'.substr($user,24);

            $orderBookID = substr($data,450,64);
            $orderBookID = hexdec('0x'.$orderBookID);
            //$orderBookID = $orderBookID/1000000000000000000;
           // echo '<br>';
     		//echo $orderBookID;
          
           
            
            //get token amount and buy or sell 
            $SQLdata = $conn->query("SELECT tokenGetAmount,giveTokenAmount,buyOrSell FROM exchangeorderbook where id=$orderBookID")->fetchAll();
            
            if(empty($SQLdata)) continue;
                $currenctAmountGetInDB=$SQLdata[0]['tokenGetAmount'];
                $currenctAmountGiveInDB=$SQLdata[0]['giveTokenAmount'];
                $action = $SQLdata[0]['buyOrSell'];
                $newAmountofTokenGet=$currenctAmountGetInDB-$amountGet;
                $newAmountofTokenGive=$currenctAmountGiveInDB-$amountGive;
            $count = $conn->query("SELECT count(*) FROM trades where transactionHash='".$transactionHash."' AND blockNumber=".$blockNumber." AND userAddress='".$user."' AND timestamp=".$timeStamp)->fetchColumn();
             if($action=="BUY"){
                $tokenVsTokenPrice = $amountGive/$amountGet;
             }
             if($action=="SELL"){
                $tokenVsTokenPrice = $amountGet/$amountGive;
             }
             if($count==0){
                $sqlInsert = "INSERT INTO  trades(transactionHash,blockNumber,userAddress,action,tokenGet,amountGet,tokenGive,amountGive,tokenVsTokenPrice,timestamp) values('".$transactionHash."',".$blockNumber.",'".$user."','".$action."','".$tokenGet."',".$amountGet.",'".$tokenGive."',".$amountGive.",".$tokenVsTokenPrice.",".$timeStamp.")";
                $conn->exec($sqlInsert);
         		     //echo '<br>';

                
                if($newAmountofTokenGet == 0){
                    //updating exchange order book table
                    $sql = "UPDATE exchangeorderbook SET tokenGetAmount=$newAmountofTokenGet ,giveTokenAmount=$newAmountofTokenGive, Status='Completed' WHERE id=$orderBookID and Status='Active'";
                    $conn->query($sql);
                }else if($newAmountofTokenGive==0){
                    $sql = "UPDATE exchangeorderbook SET tokenGetAmount=$newAmountofTokenGet ,giveTokenAmount=$newAmountofTokenGive, Status='Completed' WHERE id=$orderBookID and Status='Active'";
                    $conn->query($sql);
                }else{
                  
                    $sql = "UPDATE exchangeorderbook SET tokenGetAmount=$newAmountofTokenGet ,giveTokenAmount=$newAmountofTokenGive WHERE id=$orderBookID and Status='Active'";
                    $conn->query($sql);
                }
             } 
    	   }
        }
}

for($i=0; $i<14; $i++){
    fetchData($conn, $block);
    echo "Fetched 200 up to block : ".$block."<br/>";
    usleep(250*1000);
    fetchData($conn, $block);
    echo "Fetched 200 more up to block ".$block."<br/>";
    flush();
    sleep(4);
}

$conn = null;

?>