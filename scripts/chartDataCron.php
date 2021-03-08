<?php
include('config.php');
$today =  time();
$date = date('Y-m-d', $today);
//$maxday = $today + 	86400;
//note edit this date to get older data otherwise use new date as today
$maxday = 1571467061;
	$stmt = $conn->prepare("SELECT * from trades where timestamp>".$maxday." AND timestamp<".$today." order by timestamp ASC"); 
	$stmt->execute();
	$tradesDataArray = $stmt->fetchAll();
	foreach($tradesDataArray as $trades){
		$c_date = date('Y-m-d', $trades['timestamp']);
    	$price = $trades['tokenVsTokenPrice'];
    	$tokenGet = $trades['tokenGet'];
    	$tokenGive = $trades['tokenGive'];
    	$data = $conn->query("SELECT * FROM chart_data where tokenGet='".$tokenGet."' AND tokenGive='".$tokenGive."' AND time='".$c_date."'")->fetchAll();

    	 if(count($data)==0){
    		$sql = "INSERT INTO chart_data (tokenGet,tokenGive,time,open,high,low,close) values ('".$tokenGet."','".$tokenGive."','".$c_date ."',".$price.",".$price.",".$price.",".$price.")";
    		$conn->exec($sql);
    	 }else{
    	 	if($price>$data[0]['high']){
    	 		$sql =  "UPDATE chart_data SET high=".$price.",close=".$price." WHERE id=".$data[0]['id'];
    	 		$conn->exec($sql);
    	 	}
    	 	if($price<$data[0]['low']){
    	 		$sql =  "UPDATE chart_data SET low=".$price." WHERE id=".$data[0]['id'];
    	 		$conn->exec($sql);
    	 	}
    	 }
    }

?>
