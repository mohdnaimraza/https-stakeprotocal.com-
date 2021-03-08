<?php
include('config.php');
$tokenName = $_GET['tokenName'];
$tokenAmount = $_GET['tokenAmount'];
$tokenPriceInEther = $_GET['tokenPriceInEther'];
$etherAmount = $_GET['etherAmount'];
$expiryInBlock = $_GET['expiryInBlock'];
$buyOrSell = $_GET['buyOrSell'];
$tradeMaker = $_GET['tradeMaker'];
$nonce = $_GET['nonce'];
$v = $_GET['v'];
$r = $_GET['r'];
$s = $_GET['s'];
$FeeTake=$_GET['FeeTake'];
//validation start ---------------------------------------------------------------------------------------------------->>>>
$status = "OK";
$msg = "";
//to check if there is any soecial characters in token Name
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tokenName))
{
    $status = "NOTOK";
	$msg = "Special Characters are not allowed in Token Name";
}
//to check if token amount is numeric
if(!is_numeric($tokenAmount)){
	$status = "NOTOK";
	$msg = "Token amount must be numeric";
}
//to check if token amount is numeric
if(!is_numeric($nonce)){
	$status = "NOTOK";
	$msg = "nonce must be numeric";
}
//to check if token price in ether  is numeric
if(!is_numeric($tokenPriceInEther)){
	$status = "NOTOK";
	$msg = "Token price in Ether must be numeric";
}
//to check if ether amount  is numeric
if(!is_numeric($etherAmount)){
	$status = "NOTOK";
	$msg = "Ether amount must be numeric";
}
//to check if expiry  is numeric
if(!is_numeric($expiryInBlock)){
	$status = "NOTOK";
	$msg = "Expiry must be numeric";
}
//buy or sell must be either buy or sell
if($buyOrSell!='BUY' and $buyOrSell!='SELL'){
	$status = "NOTOK";
	$msg = "Trade type is not BUY or SELL";
}
//to check if there is any soecial characters in ether address
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tradeMaker))
{
    $status = "NOTOK";
	$msg = "Special Characters are not allowed in Ether Address";
}
//to check if there is any soecial characters in v
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $v))
{
    $status = "NOTOK";
	$msg = "Special Characters are not allowed in v";
}
if(!is_numeric($FeeTake))
{
	$status="NOTOK";
	$msg="FeeTake must be numeric";
}
//to check if there is any soecial characters in r
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $r))
{
    $status = "NOTOK";
	$msg = "Special Characters are not allowed in r";
}
//to check if there is any soecial characters in s
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $s))
{
    $status = "NOTOK";
	$msg = "Special Characters are not allowed in s";
}
//validation end ---------------------------------------------------------------------------------------------------->>>>

//inserting data into order book if validation pass
if($status=='OK'){

 $sql = "INSERT INTO exchangeorderbook (tokenName, tokenAmount,totalTokenAmount, tokenPriceInEther, etherAmount, expiryInBlock, buyOrSell, tradeMaker, v, r, s, nonce ,FeeTake )
    VALUES ('$tokenName', '$tokenAmount','$tokenAmount', '$tokenPriceInEther', '$etherAmount','$expiryInBlock','$buyOrSell','$tradeMaker','$v','$r','$s', '$nonce','$FeeTake')";
    // use exec() because no results are returned
    $conn->exec($sql);

echo "1|Successfully added the record into Order Book";
}else{
echo "0|".$msg;
}

?>