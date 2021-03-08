<?php

//mail("padsalajignesh@gmail.com","xxx","yyy");
include('databaseconfig.php');
//this condition is to display Individul (Personal) FundTransfer token start------------------------------------->>>
 if(isset($_GET['Action']) && $_GET['Action'] == "PersonalFundTransferToken")
 {
    $userAddress=$_GET['UserAddress'];
    $tokenname=$_GET['tokenName'];
    $status = "OK";
    $msg = "";   
    //to check if there is any soecial characters in token Name
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $userAddress))
    {
      $status = "NOTOK";
      $msg = "Special Characters are not allowed in User Address";
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tokenname))
    {
      $status = "NOTOK";
      $msg = "Special Characters are not allowed in Token Name";
    }
    if($status == "OK")
    {
        $sql = "SELECT * from fundtransaction where UserAddress='".$userAddress."'  order by Date DESC LIMIT 25";
        // use exec() because no results are returned
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        echo $result = json_encode($result);   
    }
 }   
 //this condition is to display Individul (Personal) FundTransfer token start------------------------------------->>>
//this condition is to display Individul (Personal) Orders start------------------------------------->>> 
 if(isset($_GET['Action']) && $_GET['Action'] == "PersonalOrdersDisplay"){
$tokenName = $_GET['tokenName'];
$userAddress=$_GET['UserAddress'];
//validation start before querying database to mitigate SQL Injections
$status = "OK";
$msg = "";
    //to check if there is any soecial characters in token Name
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tokenName))
    {
      $status = "NOTOK";
      $msg = "Special Characters are not allowed in Token Name";
    }
    //to check if there is any soecial characters in token Name
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $userAddress))
    {
      $status = "NOTOK";
      $msg = "Special Characters are not allowed in User Address";
    }
    if($status = "OK")
    {
        $sql = "SELECT * from exchangeorderbook where tokenName='".$tokenName."' and tradeMaker='".$userAddress."' order by timestamp DESC LIMIT 25";
        // use exec() because no results are returned
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        echo $result = json_encode($result);
    }
}   
//this condition is to display Individul (Personal) Orders End------------------------------------->>>
//this condition is to display Individul (Personal) Trade start------------------------------------->>> 
 if(isset($_GET['Action']) && $_GET['Action'] == "PersonalTradeDisplay"){
$tokenName = $_GET['tokenName'];
$userAddress=$_GET['UserAddress'];
//validation start before querying database to mitigate SQL Injections
$status = "OK";
$msg = "";
    //to check if there is any soecial characters in token Name
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tokenName))
    {
      $status = "NOTOK";
      $msg = "Special Characters are not allowed in Token Name";
    }
    //to check if there is any soecial characters in token Name
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $userAddress))
    {
      $status = "NOTOK";
      $msg = "Special Characters are not allowed in User Address";
    }
    if($status = "OK")
    {
        $sql = "SELECT * from trades where TokenName='".$tokenName."' and UserAddress='".$userAddress."' order by Date DESC LIMIT 25";
        // use exec() because no results are returned
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        echo $result = json_encode($result);
    }
}   
//this condition is to display Individul (Personal) Trade End------------------------------------->>> 
//this condition is to display Trade start------------------------------------->>> 
if(isset($_GET['Action']) && $_GET['Action'] == "TradeDisplay"){
$tokenName = $_GET['tokenName'];
//validation start before querying database to mitigate SQL Injections
$status = "OK";
$msg = "";
    //to check if there is any soecial characters in token Name
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tokenName))
    {
      $status = "NOTOK";
      $msg = "Special Characters are not allowed in Token Name";
    }
    if($status = "OK")
    {
        $sql = "SELECT * from trades where TokenName='".$tokenName."' order by Date DESC LIMIT 25";
        // use exec() because no results are returned
        $stmt = $conn->prepare($sql); 
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        echo $result = json_encode($result);
    }
}

// condition to display Trade END------------------------------------->>> 

//this condition is to display BUY Orders start------------------------------------->>>   
if(isset($_GET['OrderBookDisplay'])){
$tokenName = $_GET['tokenName'];
$tradeType = $_GET['type'];
//validation start before querying database to mitigate SQL Injections
$status = "OK";
$msg = "";
//to check if there is any soecial characters in token Name
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tokenName))
{
    $status = "NOTOK";
	$msg = "Special Characters are not allowed in Token Name";
}
elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tradeType))
{
    $status = "NOTOK";
	$msg = "Special Characters are not allowed in Token Name";
}
else{
	//this is to sort the order book according to buy or sell
	if($tradeType=='BUY'){
		$ascDesc = "ASC";
	}else{
		$ascDesc = "DESC";
	}
	 $sql = "SELECT * from exchangeorderbook where tokenName='".$tokenName."' and buyOrSell='".$tradeType."' and Status='Active' order by tokenPriceInEther ".$ascDesc;
	    // use exec() because no results are returned
	 $stmt = $conn->prepare($sql); 
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

echo $result = json_encode($result);
}
}
// condition to display BUY Orders END------------------------------------->>>   








?>