<?php
include('config.php');
$tradesArr = [];
if(isset($_POST['token1']) && $_POST['token2']!=''){
    $token1 = secureInput($_POST['token1']);
    $token2 = secureInput($_POST['token2']);
    $arr = [];
	$data = $conn->query("SELECT time,open,high,low,close FROM chart_data where tokenGet='".$token1."' AND tokenGive='".$token2."' OR tokenGive='".$token1."' AND tokenGet='".$token2."'")->fetchAll();
	foreach ($data as $key => $value) {
		
		array_push($arr, array('time'=>$value['time'],'open'=>$value['open'],'high'=>$value['high'],'low'=>$value['low'],'close'=>$value['close']));

	}
	$resultarr['result']= true;
	$resultarr['orders'] = $arr;
	echo json_encode($resultarr);
}