<?php error_reporting(E_ALL); ini_set('display_errors', 1); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Decentralised Exchange - DEX Admin panel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    
	<link rel="stylesheet" type="text/css" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/aos.css"> -->

</head>
<body>
    
    <?php 
    include '../scripts/site_config.php';
    
    if(isset($_GET['Edit']))
    {
        $Id=secureInput($_GET['Edit']);
        if(isset($_POST['Update']))
        {
    
            $token_name             =secureInput($_POST['token_name']);
            $token_symbol           =secureInput($_POST['token_symbol']);
            $token_contract_address =secureInput($_POST['token_contract_address']);
            $token_decimal          =secureInput($_POST['token_decimal']);
            $Token_website_full_URL =secureInput($_POST['Token_website_full_URL']);
            $Token_twitter_full_URL =secureInput($_POST['Token_twitter_full_URL']);
            $Token_Telegram_full_URL=secureInput($_POST['Token_Telegram_full_URL']);
            $Token_isTestNet 		=secureInput($_POST['Token_isTestNet']);

    
            $Query1 = $conn->prepare("UPDATE tokendetails SET tokenName='$token_name',tokenSymbol='$token_symbol',tokenContractAddress='$token_contract_address',tokenDecimal='$token_decimal',tokenWebsite='$Token_website_full_URL',tokenTwitterFullURL='$Token_twitter_full_URL',tokenTelegramFullURL='$Token_Telegram_full_URL',istestnet='$Token_isTestNet' WHERE id='$Id'");
            $result=$Query1->execute();
    
            if($result)
            {   
                echo "<script> window.location='index.php'; alert('Update Successfull.'); </script>";
            }
            else
            {
                echo "<script> window.location='index.php'; alert('Fail. Try again.'); </script>";
            }

        }

        $Id=$_GET['Edit'];
        
        $Query2 = $conn->prepare("SELECT * FROM tokendetails WHERE id='$Id' "); 
        $Query2->execute();
        $Tokendata = $Query2->fetch(PDO::FETCH_OBJ);
    ?>    
     <section>
		<div class="container">
			 <!--<div class="row">-->
			 <!--	<div class="col-sm-12 pt-5">-->
			 <!--		<h1 class="text-uppercase text-center">Admin Panel</h1>-->
			 <!--	</div>-->
			 <!--</div>-->
			 <div class="row">
			 	<div class="col-sm-12 my-5">
			 		<h3 class="text-uppercase">Edit Token</h3>
			 	</div>


			 	<div class="col-sm-12">
			 		<form action="" method="post">
					  <div class="form-group row">
					    <label for="staticEmail" class="col-sm-2 col-form-label">Token Name</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="token_name" value="<?php echo $Tokendata->tokenName; ?>" placeholder="Enter Token Name">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Toekn Symbol</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="token_symbol" value="<?php echo $Tokendata->tokenSymbol; ?>" name="token_symbol" placeholder="Enter Token Symbol">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token contract address</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control"  id="token_contract_address" value="<?php echo $Tokendata->tokenContractAddress; ?>" name="token_contract_address" placeholder="Enter Token contract address">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token Decimal</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="token_decimal" value="<?php echo $Tokendata->tokenDecimal; ?>" name="token_decimal" placeholder="Enter Token Decimal">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token website full URL</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="Token_website_full_URL" value="<?php echo $Tokendata->tokenWebsite; ?>" name="Token_website_full_URL" placeholder="Token website full URL">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token twitter full URL</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" value="<?php echo $Tokendata->tokenTwitterFullURL; ?>" name="Token_twitter_full_URL" placeholder="Enter Token twitter full URL">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token Telegram full URL</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="Token_Telegram_full_URL" value="<?php echo $Tokendata->tokenTelegramFullURL; ?>" name="Token_Telegram_full_URL" placeholder="Enter Token Telegram full URL">
					    </div>
					    <label for="inputPassword" class="col-sm-2 col-form-label">TestNet(0=no,1=yes)</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="Token_isTestNet" value="<?php echo $Tokendata->istestnet; ?>" name="Token_isTestNet" placeholder="0 or 1">
					      <br>
					    </div>
					    <div class="col-sm-10">
					    	<input type="submit" name="Update" class="btn btn-primary btn-sm" value="Update" style="    margin-left: 21%; padding: 6px 42px;font-size: 16px;"></button>
					    </div>
					  </div>
					</form>
			 	</div>
			 </div>
		</div>
	</section>
       
     
    <?php    
    }
    elseif(isset($_GET['Delete']))
    {
            $Id=secureInput($_GET['Delete']);
            $Query3 = $conn->prepare("DELETE FROM tokendetails WHERE id='$Id'");
            $result=$Query3->execute();
    
            if($result)
            {   
                echo "<script> window.location='index.php'; alert('Delete Successfull'); </script>";
            }
            else
            {
                echo "<script> window.location='index.php'; alert('Fail. Try again.'); </script>";
            }
    }
    else{
    ?>
    
    
    <section>
		<div class="container">
			 <div class="row">
			 	<div class="col-sm-12 pt-5">
			 		<h1 class="text-uppercase text-center">Admin Panel</h1>
			 	</div>
			 </div>
			 <div class="row">
			 	<div class="col-sm-12 my-4">
			 	    <div class="row">
			 	        <div class="col-sm-4">
    			 		    <h3 class="text-uppercase">Token List</h3>
    			 	    </div>
    			 	    <div class="col-sm-8 text-right">
    			 	         <button type="button" id="add_token_button" class="btn btn-primary btn-lg text-uppercase">Add Token</button>
    			 	         <button type="button" id="admin_setting_button" class="btn btn-primary btn-lg text-uppercase">Admin Setting</button>
    			 	    </div>
    			 	    <div class="alert alert-success col-md-12" id="alert_com" style="display: none">
						  <strong>Success!</strong> Company logo Updated.
						</div>
						<div class="alert alert-success col-md-12" id="alert_fav" style="display: none">
						  <strong>Success!</strong> Favicon logo Updated.
						</div>
			 	    </div>
			 	    
<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>			 	    
			 	</div>
			 	<div class="col-sm-12">
			 		<table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Token Name</th>
                          <th scope="col">Symbol</th>
                          <th scope="col">Contract Address</th>
                          <th scope="col">Decimal</th>
                          <th scope="col">Token Website</th>
                          <th scope="col">Twitter Full URL</th>
                          <th scope="col">Telegram Full URL</th>
                          <th scope="col">Testnet</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                            $Query2 = $conn->prepare("SELECT * FROM tokendetails"); 
                            $Query2->execute();
                            while($Tokendata = $Query2->fetch(PDO::FETCH_OBJ))
                            {
                          ?>
                        <tr>
                          <th scope="row"><?php echo $Tokendata->id;  ?></th>
                          <td><?php echo $Tokendata->tokenName;  ?></td>
                          <td><?php echo $Tokendata->tokenSymbol;  ?></td>
                          <td><?php echo $Tokendata->tokenContractAddress;  ?></td>
                          <td><?php echo $Tokendata->tokenDecimal;  ?></td>
                          <td><?php echo $Tokendata->tokenWebsite;  ?></td>
                          <td><?php echo $Tokendata->tokenTwitterFullURL;  ?></td>
                          <td><?php echo $Tokendata->tokenTelegramFullURL;  ?></td>
                          <td><?php if($Tokendata->istestnet==1){echo 'Yes';}else{echo 'No';}  ?></td>
                          <td>
                              <div class="btn-group" role="group" aria-label="Basic example">
                                <a type="button" class="btn btn-primary" href="?Edit=<?php echo $Tokendata->id; ?>">Edit</a>
                                <a type="button" onclick="return confirm('Are you sure, you want to delete token?');" href="?Delete=<?php echo $Tokendata->id; ?>" class="btn btn-danger">Delete</a>
                              </div>
                            <?php }?>  
                          </td>
                        </tr>
                      </tbody>
                    </table>
			 	</div>
			 </div>
		</div>
	</section>

<div id="add_token">	
	<section>
		<div class="container">
			 <!--<div class="row">-->
			 <!--	<div class="col-sm-12 pt-5">-->
			 <!--		<h1 class="text-uppercase text-center">Admin Panel</h1>-->
			 <!--	</div>-->
			 <!--</div>-->
			 <div class="row">
			 	<div class="col-sm-12 my-5">
			 		<h3 class="text-uppercase">Add Token</h3>
			 	</div>

<?php

if(isset($_POST['submit']))
{
    
    $token_name             =secureInput($_POST['token_name']);
    $token_symbol           =secureInput($_POST['token_symbol']);
    $token_contract_address =secureInput($_POST['token_contract_address']);
    $token_decimal          =secureInput($_POST['token_decimal']);
    $Token_website_full_URL =secureInput($_POST['Token_website_full_URL']);
    $Token_twitter_full_URL =secureInput($_POST['Token_twitter_full_URL']);
    $Token_Telegram_full_URL=secureInput($_POST['Token_Telegram_full_URL']);
    $Token_isTestNet		=secureInput($_POST['Token_isTestNet']);

    
    $Query1 = $conn->prepare("INSERT INTO tokendetails(tokenName,tokenSymbol,tokenContractAddress,tokenDecimal,tokenWebsite,tokenTwitterFullURL,tokenTelegramFullURL,istestnet)VALUES('$token_name','$token_symbol','$token_contract_address','$token_decimal','$Token_website_full_URL','$Token_twitter_full_URL','$Token_Telegram_full_URL','$Token_isTestNet')");
    $result=$Query1->execute();
    
    if($result)
    {   
        //echo "<h4 style='background-color: #23ff00a3;padding: 7px;margin-left: 205px;margin-bottom: 18px;width: 918px;border-radius: 4px;'>Token Enter Successfully.</h4>";
        echo "<script> window.location='index.php'; alert('Token Enter Successfully.'); </script>";        
    }
    else
    {
        //echo "<h4 style='background-color:#ff0000a3;padding: 7px;margin-left: 205px;margin-bottom: 18px;width: 918px;border-radius: 4px;'>Fail. Try again.</h4>";
         echo "<script> window.location='index.php'; alert('Fail. Try again.'); </script>";           
        
    }

}
?>    

			 	<div class="col-sm-12">
			 		<form action="" method="post">
					  <div class="form-group row">
					    <label for="staticEmail" class="col-sm-2 col-form-label">Token Name</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="token_name" placeholder="Enter Token Name">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Toekn Symbol</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="token_symbol" name="token_symbol" placeholder="Enter Token Symbol">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token contract address</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control"  id="token_contract_address" name="token_contract_address" placeholder="Enter Token contract address">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token Decimal</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="token_decimal" name="token_decimal" placeholder="Enter Token Decimal">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token website full URL</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="Token_website_full_URL" name="Token_website_full_URL" placeholder="Token website full URL">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token twitter full URL</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="Token_twitter_full_URL" placeholder="Enter Token twitter full URL">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-2 col-form-label">Token Telegram full URL</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="Token_Telegram_full_URL" name="Token_Telegram_full_URL" placeholder="Enter Token Telegram full URL">
					    </div>
					    <label for="inputPassword" class="col-sm-2 col-form-label">TestNet (0=No,1=Yes)</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="Token_isTestNet" name="Token_isTestNet" placeholder="0 or 1">
					      <br>
					    </div>
					    <div class="col-sm-10">
					    	<input type="submit" name="submit" class="btn btn-primary btn-sm" value="Submit" style="    margin-left: 21%; padding: 6px 42px;font-size: 16px;"></button>
					    </div>
					  </div>
					</form>
			 	</div>
			 </div>
		</div>
	</section>
	</div>
	
	<div id="admin_setting">
    <section>
		<div class="container">
			 <div class="row">
			 	<div class="col-sm-12 py-4">
			 		<h1 class="text-uppercase text-center">Admin Setting</h1>
			 	</div>
			 </div>
			 <div class="row">
			 	<!--<div class="col-sm-12 my-5">-->
			 	<!--	<h3 class="text-uppercase">Add Token</h3>-->
			 	<!--</div>-->
			 	<?php
			 	
			 	if(isset($_POST['Set_Admin_Setting']))
			 	{
			 	    $ethProvider=secureInput($_POST['ethProvider']);
			 	    //$mainNetChainID=secureInput($_POST['mainNetChainID']);
			 	    $isTestNet=secureInput($_POST['isTestNet']);
			 	   // $testNetChainID=secureInput($_POST['testNetChainID']);
			 	    $defaultGasPrice=secureInput($_POST['defaultGasPrice']);
			 	    $defauktGasCost=secureInput($_POST['defauktGasCost']);
			 	    $minOrderSize=secureInput($_POST['minOrderSize']);
			 	    $mainNetEtherscanTxURL=secureInput($_POST['mainNetEtherscanTxURL']);
			 	    $mainNetEtherscanAddressURL=secureInput($_POST['mainNetEtherscanAddressURL']);
			 	    $testNetEtherscanTxURL=secureInput($_POST['testNetEtherscanTxURL']);
			 	    $testNetEtherscanAddressURL=secureInput($_POST['testNetEtherscanAddressURL']);
			 	    $etherscanAPIKey=secureInput($_POST['etherscanAPIKey']);
			 	    $defaultSelectedCurrency=secureInput($_POST['defaultSelectedCurrency']);
			 	    $extokeExchangeContractAddress=secureInput($_POST['extokeExchangeContractAddress']);
			 	    //$ethAddr=secureInput($_POST['ethAddr']);
			 	    
			 	    $Query6 = $conn->prepare("UPDATE  admin_settings SET ethProvider = '$ethProvider',isTestNet = '$isTestNet',defaultGasPrice = '$defaultGasPrice',defauktGasCost = '$defauktGasCost',minOrderSize = '$minOrderSize',mainNetEtherscanTxURL = '$mainNetEtherscanTxURL',mainNetEtherscanAddressURL = '$mainNetEtherscanAddressURL',testNetEtherscanTxURL = '$testNetEtherscanTxURL',testNetEtherscanAddressURL = '$testNetEtherscanAddressURL',
				etherscanAPIKey = '$etherscanAPIKey',defaultSelectedCurrency = '$defaultSelectedCurrency',extokeExchangeContractAddress = '$extokeExchangeContractAddress' WHERE id='1'");
                    $result=$Query6->execute();
    
                    if($result)
                    {   
                         //echo "<h4 style='background-color: #23ff00a3;padding: 7px;margin-left: 300px;margin-bottom: 18px;width: 820px;border-radius: 4px;'>Update Successfull.</h4>";
                         echo "<script> window.location='index.php'; alert('Update Successfull.'); </script>";
                    }
                    else
                    {
                       //echo "<h4 style='background-color:#ff0000a3;padding: 7px;margin-left: 300px;margin-bottom: 18px;width: 820px;border-radius: 4px;'>Fail. Try again.</h4>";
                       echo "<script> window.location='index.php'; alert('Fail. Try again.'); </script>";
                    }
			 	}
		            $Query2 = $conn->prepare("SELECT * FROM admin_settings WHERE id=1"); 
                    $Query2->execute();
                    $Tokendata = $Query2->fetch(PDO::FETCH_OBJ);
			 	?>
			 	<div class="col-sm-12">
			 		<form action="" method="post">
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">ETH Provider</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="token_symbol_eth" name="ethProvider" value="<?php echo $Tokendata->ethProvider; ?>" placeholder="Set ETH Provider">
					    </div>
					  </div>
					  <!--<div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Main Net Chain Id</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control"  id="token_contract_address" name="mainNetChainID" value="<?php echo $Tokendata->mainNetChainID; ?>" placeholder="Set Main Net Chain Id">
					    </div>
					  </div>-->
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Is TestNet?</label>
					    <div class="col-sm-9">
					    <!--  <input type="text" class="form-control" id="token_decimal" name="isTestNet" value="<?php echo $Tokendata->isTestNet; ?>" placeholder="Set Is TestNet?">-->
					    
                        <select name="isTestNet" id="testNet" class="form-control">
                          <?php
      						if($Tokendata->isTestNet == 'Yes') {
                            echo '<option value="Yes" selected>Yes</option>';
                          echo '<option value="No">No</option>';
                            }	
      						else {
                            echo '<option value="Yes" >Yes</option>';
                          echo '<option value="No" selected>No</option>';
                            }
                          
                          ?>
                      
                        </select>
                          </div>
					  </div>
					<!--  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Test Net Chain Id</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_website_full_URL" name="testNetChainID" value="<?php echo $Tokendata->testNetChainID; ?>" placeholder="Set Test Net Chain Id">
					    </div>
					  </div>-->
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Default Gas Price</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="defaultGasPrice" value="<?php echo $Tokendata->defaultGasPrice; ?>" placeholder="Set Default Gas Price">
					    </div>
					  </div>
					   <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Default Gas Cost</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="defauktGasCost" value="<?php echo $Tokendata->defauktGasCost; ?>" placeholder="Set Default Gas Cost">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Min Order Size</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="minOrderSize" value="<?php echo $Tokendata->minOrderSize; ?>" placeholder="Set Min. Order Size">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Main NetEtherscan Tx URL</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="mainNetEtherscanTxURL" value="<?php echo $Tokendata->mainNetEtherscanTxURL; ?>" placeholder="Set Main NetEtherscan Tx URL">
					    </div>
					  </div>
					   <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Main Net Etherscan Address URL</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="mainNetEtherscanAddressURL" value="<?php echo $Tokendata->mainNetEtherscanAddressURL; ?>" placeholder="Set Main Net Etherscan Address URL">
					    </div>
					  </div>
					   <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Test Net Etherscan Tx URL</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="testNetEtherscanTxURL" value="<?php echo $Tokendata->testNetEtherscanTxURL; ?>" placeholder="Set Test Net Etherscan Tx URL">
					    </div>
					  </div>
					   <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Test Net Etherscan Address URL</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="testNetEtherscanAddressURL" value="<?php echo $Tokendata->testNetEtherscanAddressURL; ?>" placeholder="Set Test Net Etherscan Address URL">
					    </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Etherscan API Key</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="etherscanAPIKey" value="<?php echo $Tokendata->etherscanAPIKey; ?>" placeholder="Set Etherscan API Key">
					    </div>
					  </div>
					   <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">Default Selected Currency</label>
					    <div class="col-sm-9">
					      <!-- <input type="text" class="form-control" id="Token_twitter_full_URL" name="defaultSelectedCurrency" value="<?php echo $Tokendata->defaultSelectedCurrency; ?>" placeholder="Set Default Selected Currency">-->
					    <?php
                          $Query3 = $conn->prepare("SELECT tokenSymbol FROM tokendetails"); 
        					$Query3->execute();
       						$Currencies = $Query3->fetchAll(PDO::FETCH_OBJ);
      
     			 		//finding details of selected currency token from tokenDetails table START------------------------------------>>
						$stmt = $conn->prepare("SELECT * from tokendetails where tokenSymbol='".$selectedCurrency."'"); 
						$stmt->execute();
						$selectedCurrencyData = $stmt->fetchAll();
						if(count($selectedCurrencyData) != 1){
    						//this is rare situation where the token symbol from cookie and DB has no detail. In that rare case, we will use default token's details
    						$stmt = $conn->prepare("SELECT * from tokendetails where tokenSymbol='".$adminSettings[0]['defaultSelectedCurrency']."'"); 
   					 		$stmt->execute();
    						$selectedCurrencyData = $stmt->fetchAll();
						}
      						//var_dump($selectedCurrencyData[0]['tokenSymbol']);die();
                          ?>
                          <select name="defaultSelectedCurrency" class="form-control">
                          <?php
      						foreach($Currencies as $c) {
                              if($c->tokenSymbol == $selectedCurrencyData[0]['tokenSymbol']) {
                              	echo '<option value="'.$c->tokenSymbol.'" selected>'.$c->tokenSymbol.'</option>';
                              }
                              else {
                              	echo '<option value="'.$c->tokenSymbol.'">'.$c->tokenSymbol.'</option>'; 
                              }  
                            }                      
                          ?>
                      
                        </select>
                         </div>
					  </div>
					  <div class="form-group row">
					    <label for="inputPassword" class="col-sm-3 col-form-label">DEX Contract Address</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_twitter_full_URL" name="extokeExchangeContractAddress" value="<?php echo $Tokendata->extokeExchangeContractAddress; ?>" placeholder="Set DEX Exchange Contract Address">
					    </div>
					  </div>
					  <div class="form-group row">
					    <!-- <label for="inputPassword" class="col-sm-3 col-form-label">Eth Addr</label>
					    <div class="col-sm-9">
					      <input type="text" class="form-control" id="Token_Telegram_full_URL" name="ethAddr" value="<?php echo $Tokendata->ethAddr; ?>" placeholder="Set Eth Addr">
					    </div> -->
					    <div class="col-sm-10 mt-3">
					    	<input type="submit" name="Set_Admin_Setting" class="btn btn-primary btn-sm" value="Update" style="margin-left: 106%; padding: 6px 42px;font-size: 16px;"></button>
					    </div>
					  </div>
					</form>
			 	</div>
			 </div>
		</div>
	</section>
	<section>
		<div class="container">
			 <div class="row">
			 	<div class="col-sm-12 py-4">
			 		<h1 class="text-uppercase text-center">Manage Logo</h1>
			 	</div>
			 </div>
			 <div class="row">
			 	<div class="col-sm-12">
			 		<form id="frm_com" name="frm_com" enctype="multipart/form-data">
			 		<div class="form-group row">
			 			
						    <label for="inputPassword" class="col-sm-3 col-form-label">Upload Company Logo</label>
						    <div class="col-sm-3">
						      <input type="file" class="form-control" id="upload_com_logo" name="upload_com_logo">
						    </div>
					   
					  </div>
					  </form>
			 	</div>
			 	<div class="col-sm-12">
			 		<form id="frm_fav" name="frm_fav" enctype="multipart/form-data">
			 		<div class="form-group row">
			 			
						    <label for="inputPassword" class="col-sm-3 col-form-label">Upload Favicon</label>
						    <div class="col-sm-3">
						      <input type="file" class="form-control" id="upload_fav_logo" name="upload_fav_logo">
						    </div>
					    
					  </div>
					  </form>
			 	</div>
			 </div>
			
		</div>
	</section>
	
	<?php } ?>
</div>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script>
	$("#add_token_button").click(function() {
    $('html, body').animate({
        scrollTop: $("#add_token").offset().top
    }, 1000);
});

$("#admin_setting_button").click(function() {
    $('html, body').animate({
        scrollTop: $("#admin_setting").offset().top
    }, 1000);
});
</script>
<script>
$(document).ready(function(){
    $("#testNet").on("change", function(){
      
    	var ethProvider = $('input[name=ethProvider]').val();
  
  if ($("#testNet option:selected").val() !== 'Yes') {
    ethProvider = ethProvider.replace('rinkeby.', '');
    
    $("#token_symbol_eth").val(ethProvider);
  }
  if($("#testNet option:selected").val() !== 'No') {
    
    $("#token_symbol_eth").val('https://rinkeby.infura.io/R4ZOS5AoF9gJMfGMuqJm');
  }
    });
});
</script>
</body>
</html>

<script type="text/javascript">

	$(document).ready(function(){
		$("#upload_com_logo").change(function(){
			var data=new FormData(document.getElementById("frm_com"));
			data.append('flag',"com");
			$.ajax({
				url:'upload_logo.php',
				type:'POST',
			    data:data,
				processData: false,
	    		contentType: false,
	    		success:function(response)
	    		{
	    			$("#alert_com").css("display","");
	    			setTimeout(function(){ 
	    				$("#alert_com").fadeOut('slow');
	    			}, 3000);
	    			$('html, body').animate({scrollTop:0}, 'slow');
	    		}
			})
		});

		$("#upload_fav_logo").change(function(){
			var data=new FormData(document.getElementById("frm_fav"));
			data.append('flag',"fav");
			$.ajax({
				url:'upload_logo.php',
				type:'POST',
			    data:data,
				processData: false,
	    		contentType: false,
	    		success:function(response)
	    		{
	    			$("#alert_fav").css("display","");
	    			setTimeout(function(){ 
	    				$("#alert_fav").fadeOut('slow');
	    			}, 3000);
	    			$('html, body').animate({scrollTop:0}, 'slow');
	    		}
			})
		});
	})
		

</script>
