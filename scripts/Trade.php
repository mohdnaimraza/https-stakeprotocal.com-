<?php
include('config.php');
    $amountGet=$_GET['amountGet'];
    $amountGive=$_GET['amountGive'];
    $id=$_GET['id'];

$data = $conn->query("SELECT tokenGetAmount,giveTokenAmount FROM exchangeorderbook where id=$id")->fetchAll();
$currenctAmountGetInDB=$data[0]['tokenGetAmount'];
$currenctAmountGiveInDB=$data[0]['giveTokenAmount'];
$newAmountofTokenGet=$currenctAmountGetInDB-$amountGet;
$newAmountofTokenGive=$currenctAmountGiveInDB-$amountGive;
if($newAmountofTokenGet <= 0){
    //updating exchange order book table
    $sql = "UPDATE exchangeorderbook SET tokenGetAmount=$newAmountofTokenGet ,giveTokenAmount=$newAmountofTokenGive, Status='Completed' WHERE id=$id";
    $conn->query($sql);
    echo "1|Successfully added the record into Trade";
}else if($newAmountofTokenGive<=0){
    $sql = "UPDATE exchangeorderbook SET tokenGetAmount=$newAmountofTokenGet ,giveTokenAmount=$newAmountofTokenGive, Status='Completed' WHERE id=$id";
    $conn->query($sql);
    echo "1|Successfully added the record into Trade";
}else{
    //updating exchange order book table
    $sql = "UPDATE exchangeorderbook SET tokenGetAmount=$newAmountofTokenGet ,giveTokenAmount=$newAmountofTokenGive WHERE id=$id";
    $conn->query($sql);
    echo "1|Successfully added the record into Trade";
}
    
?>
