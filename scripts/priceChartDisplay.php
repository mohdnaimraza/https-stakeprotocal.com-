<?php error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include_once ('config.php');
  //this condition is to display Trade Price Chart start---------------------------------->>>
 if(isset($_GET['Action']) && $_GET['Action'] == "priceChartDisplay"){
    $tokenAddress=$_GET['tokenAddress'];
    $marketAddress= $_GET['marketAddress'];
    $status = "OK";
    $msg = "";   
    //to check if there is any soecial characters in token Name
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tokenAddress)){
      $status = "NOTOK";
      $msg = "Special Characters are not allowed in Token Name";
    }
    if($status == "OK")
    {
      $sql = "SELECT COUNT(timestamp) as total,FROM_UNIXTIME(timestamp,'%Y-%m-%d') as mydate FROM `trades` where tokenGet='".$tokenAddress."' AND tokenGive='".$marketAddress."' AND timestamp >= UNIX_TIMESTAMP(NOW() - INTERVAL 7 DAY) OR tokenGive='".$tokenAddress."' AND tokenGet='".$marketAddress."' AND timestamp >= UNIX_TIMESTAMP(NOW() - INTERVAL 7 DAY) Group by timestamp order by timestamp ASC";
        // use exec() because no results are returned
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $arr = getLastNDays(7, 'Y-m-d');
        
        $finalArray = [];
         for($i=0;$i<7;$i++){
          $finalArray[$i]['mydate'] = $arr[$i];
          $finalArray[$i]['total'] = 0;
         }
        for($i=0;$i<7;$i++){
            for($j=0;$j<count($result);$j++){
              if($result[$j]['mydate']==$arr[$i]){
                $finalArray[$i]['total'] = $finalArray[$i]['total'] + $result[$j]['total'];
              }
            }
        }
        $finalArray = array_reverse($finalArray);
        echo $result = json_encode($finalArray);   
        
    }
 }
 //this condition is to display Trade Price Chart END---------------------------------->>>

function getLastNDays($days, $format = 'd/m'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        //$dateArray[] = '"' . date($format, mktime(0,0,0,$m,($de-$i),$y)) . '"'; 
      $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
    }
    return array_reverse($dateArray);
}
?>