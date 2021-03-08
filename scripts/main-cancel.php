<?php
include('config.php');
$resultarr = array();
if(isset($_POST)){
	if($_POST['thisid']!=0 && $_POST['userAddress']!=""){
		$tradeMaker = $_POST['userAddress'];
		$thisid = $_POST['thisid'];
    	$stmt = $conn->prepare("SELECT * from exchangeorderbook where tradeMaker='".$tradeMaker."' AND id=".$thisid, [PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL]);
		$stmt->execute();
		$rows = $stmt->rowCount();
		if($rows==1){
			$stmt = $conn->prepare("DELETE from exchangeorderbook where tradeMaker='".$tradeMaker."' AND id=".$thisid);
			$stmt->execute();
			$resultarr['result']= true;
	    	$resultarr['msg'] = 'Order Cancelled.';
	    	echo json_encode($resultarr);
	    	exit;
		}

    // use exec() because no results are returned
    //
	}else{
	    $resultarr['result']= false;
	    $resultarr['msg'] = 'No Order Found.';
	    echo json_encode($resultarr);
	    exit;
	}
}else{
	$resultarr['result']= false;
	$resultarr['msg'] = 'No Order Found.';
	echo json_encode($resultarr);
	exit;
}
?>