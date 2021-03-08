<?php
include('config.php');

  //deposit and withdraw action for token
 if(isset($_GET['Action']) && $_GET['Action'] == "Token")
 {
 	$TokenName=$_GET['TokenName'];
	$TokenAmount=$_GET['TokenAmount'];
	$Type=$_GET['Type'];
	$EtherAmount=$_GET['EtherAmount'];
	$UserAddress=$_GET['UserAddress'];
	$TransactionHash=$_GET['TransactionHash'];

	//validation start ---------------------------------------------------------------------------------------------------->>>>
	$status = "OK";
	$msg = "";
if($EtherAmount != 0)
{
	$status = "NOTOK";
	$msg = "Ether amount no need in ether deposit";
}	
if($EtherAmount == 0)
{
	$EtherAmount='';
}
//to check if ether amount is numeric
if(!is_numeric($TokenAmount)){
	$status = "NOTOK";
	$msg = "Token amount must be numeric";
}
//to check if there is any soecial characters in User address
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$UserAddress))
{
	$status = "NOTOK";
	$msg = "Special Characters are not allowed in User Address";
}
//to check if there is any soecial characters in User address
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$TokenName))
{
	$status = "NOTOK";
	$msg = "Special Characters are not allowed in Token Name";
}
//to check if there is any soecial characters in Type
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$Type))
{
	$status = "NOTOK";
	$msg = "Special Characters are not allowed in Type";
}
//to check if there is any soecial characters in Transaction hash
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$TransactionHash))
{
	$status = "NOTOK";
	$msg = "Special Characters are not allowed in Transaction hash";
}

	if($status == "OK")
	{
		$sql = "INSERT INTO fundtransaction (TokenName	,TokenAmount, Type, EtherAmount, UserAddress, TransactionHash)
    VALUES ('$TokenName','$TokenAmount', '$Type-$TokenName', '$EtherAmount', '$UserAddress','$TransactionHash')";
    // use exec() because no results are returned
    $conn->exec($sql);
	echo "1|Successfully added the record into Trade";
	}else{
	echo "0|".$msg;
	}
}



 //deposit and withdraw action for ether
if(isset($_GET['Action']) && $_GET['Action'] == "Ether"){
	$TokenName=$_GET['TokenName'];
	$TokenAmount=$_GET['TokenAmount'];
	$Type=$_GET['Type'];
	$EtherAmount=$_GET['EtherAmount'];
	$UserAddress=$_GET['UserAddress'];
	$TransactionHash=$_GET['TransactionHash'];
//validation start ---------------------------------------------------------------------------------------------------->>>>
$status = "OK";
$msg = "";
if($TokenAmount != 0)
{
	$status = "NOTOK";
	$msg = "Token amount no need in ether deposit";
}	
if($TokenAmount == 0)
{
	$TokenAmount='';
}
//to check if ether amount is numeric
if(!is_numeric($EtherAmount)){
	$status = "NOTOK";
	$msg = "Ether amount must be numeric";
}
//to check if there is any soecial characters in User address
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$UserAddress))
{
	$status = "NOTOK";
	$msg = "Special Characters are not allowed in User Address";
}
//to check if there is any soecial characters in User address
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$TokenName))
{
	$status = "NOTOK";
	$msg = "Special Characters are not allowed in Token Name";
}
//to check if there is any soecial characters in Type
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$Type))
{
	$status = "NOTOK";
	$msg = "Special Characters are not allowed in Type";
}
//to check if there is any soecial characters in Transaction hash
if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$TransactionHash))
{
	$status = "NOTOK";
	$msg = "Special Characters are not allowed in Transaction hash";
}
//validation end
if($status == "OK")
{

 $sql = "INSERT INTO fundtransaction (TokenName	,TokenAmount, Type, EtherAmount, UserAddress, TransactionHash)
    VALUES ('$TokenName','$TokenAmount', '$Type-ETH', '$EtherAmount', '$UserAddress','$TransactionHash')";
    // use exec() because no results are returned
    $conn->exec($sql);




echo "1|Successfully added the record into Trade";
}else{
echo "0|".$msg;
}
} 
?>