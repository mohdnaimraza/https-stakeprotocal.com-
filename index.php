<?php
if(isset($_GET['clear'])){
    echo '
    <script>
        localStorage.clear();
        document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
        window.location="/";
    </script>
    ';
}
?>
<?php
include_once ('scripts/site_config.php'); //this file does all the initial processing in PHP
include_once ('scripts/index_processing.php');
?>
<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="<?php echo $favicon;?>" rel="icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet" />
    <link href="css/alertify.min.css" rel="stylesheet" />
    <link href="css/alertify-bootstrap.min.css" rel="stylesheet" />
    <link href="css/black.css" rel="stylesheet" id="stylesheet" />
    <link href="css/small.css" rel="stylesheet" media="only screen and (max-device-width: 480px)" />
<!--     <link rel="shortcut icon" href="img/favicon.png"> -->
  <link rel="icon" type="images/png" sizes="32x32" href="images/favicon.png">
    <!-- <link href="css/main-custom.css" rel="stylesheet" /> -->
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title><?php echo $siteTitle; ?></title>
    <meta name="description" content="<?php echo $siteDescription; ?>" />
    <meta property="og:url" content="/" />
    <meta property="og:title" content="<?php echo $siteTitle; ?>" />
    <meta property="og:description" content="<?php echo $siteDescription; ?>" />
    <meta property="og:image" content="images/og-image.png" />
	  <!-- Select Dropdown with search -->
	<style>

/*Dyanamic theme color change css*/

	html, body {
/* 	    background: rgb(14, 21, 25); */
	    background: #001935;
    }

    a {
	    color: #ccc;
	}

	a:hover {
	    color: #666;
	    text-decoration: none;
	}

	.text-color{
		color: #ffffff!important;
	}

    .table-bg{
    	background: #000!important;
    }
	.nave-header-border-bottom{
	    background: #001935;
	    border: 0;
	    border-radius: 0;
	    border-bottom: 1px solid #333333;
	}

    #tradeChart .tv-lightweight-charts{
/*   	width: 100%!important; */
    /*   	height: 291px!important; */
    }
	#tradeChart .tv-lightweight-charts table{
/*   		width: 100%!important; */
    }
    
    .row-box.height4 {
/*     	min-height: 365px; */
	}
    
	.row-header {
	    background: #337ab7!important;
	    color: #fff!important;
	}

	.table-header {
	    height: 25px;
	    border-bottom: 1px solid #333333;
	    vertical-align: bottom;
	}

	.table-header-ask{
		background-color: #000;
	    padding: 8px 0 10px 0;
	    border-bottom: 1px solid #333333;
	}

	.footer{
		padding: 30px 0 30px 0;
	    background-color: #000;
	    margin-top: 20px;
	    border-top: 1px solid #333333;
	}

	.form-control{
		border: 1px solid #333333!important;
		background-color: transparent!important;
		color: #fff;
	}

	.dropdown a:hover {
		background-color: #337ab7 !important; 
	}

	.modelbutton:hover {
	    background-color: #337ab7 !important;
	    outline: 0px solid #333333 !important;
	}

	.basePairText {
	    flex: 1;
	    margin-bottom: 0;
	    padding: 0.5rem;
	    border-right: 1px solid #333333!important;
	    text-align: center;
	    text-decoration: none;
		color:#fff;
		cursor:pointer;
	}
	.basePairText:hover
	{
		background-color:#337ab7;
	}
	.basePairDiv {
	    display: flex;
	    flex-direction: row;
	    justify-content: center;
	    align-items: center;
	    border: 1px solid #333333!important;
	    box-sizing: border-box;
	    background: none;
	    border-radius: 4px;
	    color: #898989;
	    margin-left: 0.7rem;
	    margin-right: 0.7rem;
	    margin-top: 0.7rem;
	    margin-bottom: 0.7rem;
	}

	.basePairText:focus 
	{
		background-color:#FFCC33;
	}

	.nav-tabs.columns > li.active > a {
	    color: #fff;
	    background: #15232c;
	    border: 0;
	}


	.nav-tabs.columns > li > a:hover {
	    color: #FFF;
	    background: #33424a;
	    border: 0;
	}

	.nav-tabs.columns > li > a {
	    transition: background-color .25s ease-in-out;
	    border-radius: 0;
	    height: 35px;
	    line-height: 17px;
	    width: 100%;
	    text-align: center;
	    background: #2f3d45;
	    color: #fff;
	    border: 0;
	}

	.nav-tabs.columns > li.active > a:hover {
	    background: #15232c;
	    color: #fff;
	}

	.nav-tabs.columns > li > a:hover {
	    color: #FFF;
	    background: #33424a;
	    border: 0;
	}

	.selectedCurrencyLabel {
	    color: hsla(0,0%,100%,.8);
	}
/*Dyanamic theme color change css*/


	#connection ,.modal-body,.modal-content
	{
		color:#fff !important;
	}
	
		#connection ,.modal-body,.modal-header
	{
		color:#fff !important;
	}
	
	
	.modal-backdrop
	{
		z-index:999 !important;
	}
	.modal-open
	{
		padding-right:0px !important;		
	}
	.modelbutton
	{
		background-color:transparent !important;
		font-size:14px !important;
		font-weight:normal !important;
		margin-top: 0px;
		height:51px !important;
	}
	
		.modelbutton:focus
	{
		outline:0px !important;
		
	}

	.basePairTextLast {
	    border-right: none;
	}

	.dropbtn {
	  background-color: #337ab7 ;
	  color: white;
	  padding: 16px;
	  font-size: 14px;
	  border: none;
	  cursor: pointer;
      margin-left: 20px;
	}
	#myDropdown
	{
		background-color:#000;
		border:1px solid #333333!important;
		overflow-x: hidden;
	}
	.dropbtn:hover, .dropbtn:focus {
	  background-color: #000;
	  color:#fff;
	}

	#myInput {
	  box-sizing: border-box;
	  background:none;
	  background-position: 14px 12px;
	  background-repeat: no-repeat;
	  font-size: 14px;
	  padding: 10px 10px 10px 10px;
	  border: none;
	  border: 1px solid #333333!important;
	  width:93%;
	      border-radius: 4px;
	    color: #898989;
	    margin-left: 0.7rem;
	    margin-right: 0.7rem;
	    margin-top: 0.7rem;
	    margin-bottom: 0.7rem;
	}

	#myInput:focus {outline: 0px solid #ddd;}

	.dropdown {
	  position: relative;
	  display: inline-block;
	}

	.dropdown-content {
	  display: none;
	  position: absolute;
	  background-color: #f6f6f6;
	  min-width: 230px;
	  overflow: auto;
	  border: 1px solid #ddd;
	  z-index: 1;
	}

	.dropdown-content a {
	  color: #fff;
	  padding: 12px 16px;
	  text-decoration: none;
	  display: block;
	}

	.dropdown-content a:hover {
	  color: #000 !important;

	}

	.hovercolor a:hover {background-color: #FFCC33 !important; color:#000 !!important;}

	.show {display: block;}

	  .invitebutton
	  {
		  margin-top:-7px !important;
		  margin-left:-72px;
	  }
	  .fontresize
		{
			font-size:16px !important;
		}

    @media (min-width: 1200px){
		.col-lg-4 {
    		width: 32.7%;
		}
    	.col-lg-5 {
    		width: 45.3%;
		}
		.col-lg-3 {
    		width: 22%;
		}
    
    	#tradeChart .tv-lightweight-charts{
  	width: 100%!important;
    }
	#tradeChart .tv-lightweight-charts table{
  		width: 100%!important;
    }
    #tradeChart .tv-lightweight-charts table canvas{
  		width: 100%!important;
    }
    #tradeChart .tv-lightweight-charts table tr:nth-child(1) td:nth-child(2){
    	width: 100%!important;
    }
    
    }
    @media (min-width: 1400px){
    	#tradeChart .tv-lightweight-charts{
  	width: 100%!important;
    }
	#tradeChart .tv-lightweight-charts table{
  		width: 100%!important;
    }
    #tradeChart .tv-lightweight-charts table canvas{
  		width: 100%!important;
    }
    #tradeChart .tv-lightweight-charts table tr:nth-child(1) td:nth-child(2){
    	width: 100%!important;
    }
    }
    @media (max-width: 1024px) {
    
    	#tradeChart .tv-lightweight-charts{
  			width: 100%!important;
    	}
		#tradeChart .tv-lightweight-charts table{
  			width: 100%!important;
    	}
    	#tradeChart .tv-lightweight-charts table canvas{
  			width: 100%!important;
    	}
    	#tradeChart .tv-lightweight-charts table tr:nth-child(1) td:nth-child(2){
    		width: 100%!important;
    	}
    
    }
   	 @media (max-width: 992px) {
    
    	#tradeChart .tv-lightweight-charts{
  			width: 100%!important;
    	}
		#tradeChart .tv-lightweight-charts table{
  			width: 100%!important;
    	}
    	#tradeChart .tv-lightweight-charts table canvas{
  			width: 100%!important;
    	}
    	#tradeChart .tv-lightweight-charts table tr:nth-child(1) td:nth-child(2){
    		width: 100%!important;
    	}
    
    }
    
    @media (max-width: 768px) {
    
    	#tradeChart .tv-lightweight-charts{
  			width: 100%!important;
    	}
		#tradeChart .tv-lightweight-charts table{
  			width: 100%!important;
    	}
    	#tradeChart .tv-lightweight-charts table canvas{
  			width: 100%!important;
    	}
    	#tradeChart .tv-lightweight-charts table tr:nth-child(1) td:nth-child(2){
    		width: 100%!important;
    	}
    
    }
	@media (min-width: 320px) and (max-width: 480px) {
		.fontresize
		{
			font-size:13px !important;
		}
	  .invitebutton
	  {
		  margin-top:7px !important;
		   margin-left:0px;
	  }
	  #myDropdown
	  {
		  margin-left:-50px;
		  height:160px;

	  }
	  #myInput {outline: 0px solid #ddd; }

	}

	</style>
	  </head>

  <body>
  <div id="tokenDepositLoaderDiv">
     <center>
       <img src="images/loader.gif" >
       <h3>Please wait for the Step 2 to complete</h3>
    </center>
  </div>

  <div id="tradeWaitingDiv">
    <center>
      <img src="images/loader.gif" >
      <h3>Please wait while trade is being completed</h3>
      </center>
  </div>
    <nav class="navbar navbar-default navbar-fixed-top nave-header-border-bottom">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only trn" id="toggleNavigation" >toggle_navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
            <img class="logo" src="<?php echo $siteLogo;?>" alt="<?php echo $siteName;?>" />
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
         <!--<div id="tokensDropdown" style="display: none;"></div>-->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <!-- <ul class="nav navbar-nav">
            <li class="dropdown" id="tokensDropdownCustom"></li>
          </ul> -->
          <div class="nav navbar-nav">
          
              <!-- <select class="dropdown" id="tokensDropdownCustom" onchange="tokensinMenu(this.value)"> -->
              	 <span data-toggle="tooltip" data-placement="bottom" title="<?php echo $marketInfo; ?>"> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo "<a target='_blank' href='https://etherscan.io/token/".$selectedTradingTokenContract."'>". $selectedCurrency."</a> / <a target='_blank' href='https://etherscan.io/token/".$marketsAddress."'> ".$selectedMarket. "</a>";?> <i class="fa fa-info-circle "> </i>  </span>
                    <?php /*foreach($tokensDataALL as $tok){
                              if($tok['tokenSymbol'] == $selectedCurrency){
                                   echo "<option selected value='".$tok['tokenSymbol']."'>".$tok['tokenName']."</option>";
                              }else{
                                    echo "<option value='".$tok['tokenSymbol']."'>".$tok['tokenName']."</option>";
                              }
                          } */ ?>
            <!-- </select>  -->
		  
	    <div class="dropdown">
		  <button onclick="selectmarket()" class="dropbtn">Select Market <span class="caret" style="margin-left: 5px;"></span></button> 
		  <div id="myDropdown" class="dropdown-content">
		   <div class="basePairDiv">
		   	<?php if($markets){ 
		   		foreach($markets as $market){
		   			if($selectedMarket==$market['name']){
		   				$selected="selected";
		   			}else{
		   				$selected = "";
		   			}
		   			?>
		   		<div class="basePairText" <?php echo $selected;?> tabindex="<?php echo $market['id'];?>" ><?php echo $market['name']; ?></div>
		   	<?php } }?>
		   </div>
		  <input type="text" placeholder="Search Pair" id="myInput" onkeyup="filterFunction()">
		  <?php foreach($tokensDataALL as $tok){
                      if($tok['tokenSymbol'] == $selectedCurrency){
                           //echo "<option selected value='".$tok['tokenSymbol']."'>".$tok['tokenName']."</option>";
                      }else{
                      	    //echo "<option value='".$tok['tokenSymbol']."'>".$tok['tokenName']."</option>";
                      	//echo '<a onchange="tokensinMenu('.$tok['tokenSymbol'].')" >'.$tok['tokenSymbol'].'/'.$selectedMarket.'</a>';
                      	?>
                      	<a onclick="tokensinMenu('<?php echo $tok['tokenSymbol'];?>')" ><?php echo $selectedMarket.'/'.$tok['tokenSymbol'];?> </a>	
                        
                      <?php }
          		}
          ?>
		   
		  </div>
	    </div>
          </div>
        	<ul class="nav navbar-nav navbar-right">
              <li class="dropdown" id="connection">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-info-circle"></i>&nbsp;<span class="trn" data-trn-key="Smart_Contract">Trading Help</span> 
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="faq.php" target="_blank">
                    <span class="trn" data-trn-key="etherscan_contract">FAQs
                    </span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <!--<a href="<?php echo $telegram_support;?>" target="_blank">-->
                  <a href="https://t.me/joinchat/Stake_Protocal_Official" target="_blank">
                    <span class="trn" data-trn-key="etherscan_contract">Telegram Support
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="dropdown" id="connection">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-list"></i>&nbsp;<span class="trn" data-trn-key="Smart_Contract">List Token</span> 
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="<?php echo $listing_guideline;?>" target="_blank">
                    <span class="trn" data-trn-key="etherscan_contract">Listing Guidelines
                    </span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a href="<?php echo $list_token_url; ?>" target="_blank">
                    <span class="trn" data-trn-key="etherscan_contract">Apply Here
                    </span>
                  </a>
                </li>
              </ul>
            </li>
			
				<!-- invite friends Modal -->
			     <li class="dropdown" id="connection">
            
            <button type="button" class="modelbutton btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-users" aria-hidden="true"></i>
Invite Friends</button>
			<!--  Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Get rewarded just by referring your friends!</h4>
      </div>
      <div class="modal-body">
	  
      <div class="col-md-12 col-sm-12 col-xs-12 ">
	  <strong style="color:#3d84d6">Copy your unique referral link below, and share!</strong>
	<div class="form-group">
	    <label class="col-xs-12 " style="padding:0px;">YOUR PERSONAL REFERRAL LINK</label>
						<div class="col-md-10 col-sm-10 col-xs-9 " style="padding:0px;">
	    <input type="text" id="refLink" readonly="" name="" value="<?php echo $site_url;?>?ref=<?php if(isset($_GET['userPublicAddress']) && $_GET['userPublicAddress']!=''){echo $_GET['userPublicAddress']; } ?>" class="form-control">
						</div>
	    <div class="col-md-2 col-sm-2 col-xs-3 " style="padding:10px;"  onclick="copyLink()"><a href="#">Copy</a></div>
	</div>
    </div>
	<p style="text-align:center;line-height:25px;">  We offer a lifetime referral rewards program. Just simply refer your friends and family, you will receive up to <span id="referralPercentage">0.10%</span> of all their wagers! 
	<br/>
	<span>You will receive the referral rewards automatically, and it will be withdrawable instantly.</span> <br/>
	</p>    
<div class="row">                
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="col-md-7 col-sm-8 col-xs-12" style="padding:0px;">
	 <strong style="color:#ffcc33 ;" class="fontresize" >Available Bonus to withdraw : <span id="refBonusAvailable" style="padding:5px 10px 5px 10px ; border:1px solid #ffcc33; ">0.00</span></strong>  
	 </div>
	 <div class="col-md-3 col-sm-3 col-xs-12" style="text-align:center;">
	<button id="refBonusWithdraw" type="button" class="invitebutton btn btn-primary btn-xs trn"  style="width: 80px;">Withdraw
          </button></div>						 
	</div>         
  </div>
	 </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
 </li>
<!-- invite friends Modal -->
           


             <li class="dropdown" id="connection">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-file-text"></i>&nbsp;<span class="trn" data-trn-key="Smart_Contract">Smart Contract</span> 
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $etherScanAddressURL.$mainContractAddress;?>" target="_blank">
                      <span class="trn" data-trn-key="etherscan_contract">Etherscan contract</span>
                    </a>
                </li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
            <li class="dropdown" id="languages"></li>
            <li class="dropdown" id="accounts"></li>
            <li class="button-dropdown" id="accounts-custom"><i class="fa fa-user-circle-o" aria-hidden="true"></i></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

<!-- custom -->
<div class="container-fluid padding-mobile-view" style="padding-top: 20px;">
      <div class="row row-container" style="margin-bottom: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 padding-mobile-view">
          <div class="row-header trn">MARKETS BY 24 HR VOLUME</div>
          <div class="row-box scroll height01 table-bg" id="">
            <table class="table table-borderless" style="color: #fff; margin: 0;">
              <thead>
                <tr class="table-header">
                  <th>No</th>
                  <th>Token</th>
                  <th>Price</th>
                  <th>Volume</th>
                </tr>
              </thead>
              <tbody>
               <?php
         	 		if(count($marketTradeData) > 0){
                    $xcount =1;
          			foreach($marketTradeData as $row){
          				$tSymbolSQL = $conn->query("SELECT tokenSymbol FROM tokendetails where tokenContractAddress='".$row['tokenGet']."' UNION select name as tokenSymbol from market where address='".$row['tokenGet']."'")->fetchColumn();
          				
          			echo'
           				<tr><div role="row" class="data_table__row">';
              			//<td><div role="gridcell" class="data_table__cell ">'.date('m/d h:i', strtotime($row['Date'])).'</div> 
              			echo '<td><div role="gridcell" class="data_table__cell ">'.$xcount.'</div> 
                        <td><div role="gridcell" class="data_table__cell ">'.$tSymbolSQL.'</div> ';
               			//<td><div role="gridcell" class="data_table__cell ">'.$row['TokenPriceInEth'].'</div>
                        echo '<td><div role="gridcell" class="data_table__cell ">'.number_format($row['tokenPrice'],8).'</div> 
              			<td><div role="gridcell" class="data_table__cell ">'.number_format($row['tokenTradeVolume'],2).'</div> 
            			</div>
            			';
            			$xcount++;
                    	}
            			}else{
                		echo'<tr><td colspan="4"><div role="row" class="data_table__row data_table__row-no_data">
                      	<div role="gridcell" class="data_table__cell" style="color: #fff;">
                        There is no data yet</div></div></td></tr>';
            	   	}?> 
              </tbody>
            </table>
          </div>

          <div id="orders" style="display: none;"></div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 price_chart padding-mobile-view">
         <div class="row-header trn">LIVE CHART</div>
            <!-- <div class="row-box nav-header" style="position: relative; background-color: black;display: none;">
              <ul class="nav nav-tabs two columns" role="tablist" style="display: none;">
                <li role="presentation" class="active"><a href="#chartPrice" aria-controls="chartPrice" role="tab" data-toggle="tab" class="trn">price</a></li>
                <li role="presentation"><a href="#chartDepth" aria-controls="chartDepth" role="tab" data-toggle="tab" class="trn">depth</a></li>
              </ul>
            </div> -->
             <!-- <div id="chartPrice"><div style="color: rgb(255, 255, 255); padding: 12px; width: 100%; text-align: center;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div></div> -->
            <div class="row-box height02 table-bg" style="">
             <!--  <div class="tab-content" style="height: 100%;display: none;"> -->
                <!-- <div role="tabpanel" class="tab-pane active" id="chartPrice" style="height: 100%; width: 100%; background: #000;"></div>
                <div role="tabpanel" class="tab-pane" id="chartDepth" style="height: 100%; width: 100%; background: #000;"></div> -->
                
              <!-- </div> -->
              <div id="tradeChart"></div>
             <!--  <canvas style="color:white" id="tradeChartCanvas"></canvas> -->
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 balance-t padding-mobile-view">
          <div class="row-header trn">MY BALANCE</div>
          <div id="balance" style="display: none;"></div>
          <div id="">
            <div class="row-box nav-header">
              <ul class="nav nav-tabs three columns" role="tablist">
                <li role="presentation" class="active">
                  <a href="#deposit1" aria-controls="deposit" role="tab" data-toggle="tab" class="trn" data-trn-key="deposit" data-original-title="" title="" aria-expanded="true">Deposit
                  </a>
                </li>
                <li role="presentation" class="">
                  <a href="#withdraw1" aria-controls="withdraw" role="tab" data-toggle="tab" class="trn" data-trn-key="withdraw" data-original-title="" title="" aria-expanded="false">Withdraw
                  </a>
                </li>
                <li role="presentation" class="">
                  <a href="#transfer1" aria-controls="transfer" role="tab" data-toggle="tab" class="trn" data-trn-key="transfer" data-original-title="" title="" aria-expanded="false">Transfer
                  </a>
                </li>
              </ul>
            </div>
            <div class="row-box height4 table-bg">
              <div>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="deposit1">
                    <table class="table table-borderless table-balances table-bg">
                      <tbody>
                        <tr class="table-header">
                          <td class="trn1" data-trn-key="token">Token</td>
                          <td class="trn1" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="balance_wallet_tooltip" data-trn-key="balance_in_your_wallet" data-original-title="This is the balance in your personal Ethereum wallet, which you have connected to DEX in the account dropdown (upper right).">Wallet
                          </td>
                          <td class="trn1" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="balance_etherdelta_tooltip" data-trn-key="balance_etherdelta" data-original-title="This is the balance you have deposited from your personal Ethereum wallet to the current smart contract.">DEX
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table table-borderless table-balances table-bg">
                      <tbody>
                        <tr>
                          <td>
                            <a class="selectedCurrencyLabel" href="javascript:;" style="font-size: 15px; font-weight: 100;"><?=$selectedCurrencyData[0]['tokenSymbol'];?></a>
                          </td>
                          <td>
                            <span class="contractwalletbalance">0</span>
                          </td>
                          <td><span class="balanceDisplayLabel">0</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="padding-sides">
                      <table class="table table-borderless table-balances table-bg ">
                        <tbody>
                          <tr>
                            <td colspan="2">
                              <input type="text" class="form-control input-xs trn" placeholder="Amount" data-trn-key-placeholder="amount" id="amountoftokendeposit" data-trn-key="" style="width: 195px;">
                            </td>
                            <td>
                              <button type="button" class="btn btn-primary btn-xs trn" data-toggle="tooltip" data-placement="bottom" title="" id="tokendeposit" data-trn-key-title="deposit_tab" data-trn-key="deposit" style="width: 80px;" >Deposit
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <table class="table table-borderless table-balances table-bg">
                      <tbody>
                        <tr>
                          <td>
                            <a href="javascript:;"><span class="marketToken"></span></a>
                          </td>
                          <td>
                          	<?php if($selectedMarket=='ETH'){?>
                            	<span class="EtherbalanceDisplayLabel">0</span>
                            <?php } else { ?>
                            	<span class="contractwalletbalance2">0</span>
                            <?php } ?>
                          </td>
                          <td>
                          	<?php if($selectedMarket=='ETH'){?>
                            		<span class="Etherbalanceinsmartcontract">0</span>
                            	<?php }else{ ?>
                            		<span class="balanceDisplayLabel2">0</span>
                            	<?php } ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="padding-sides">
                      <table class="table table-borderless table-balances table-bg">
                        <tbody>
                        	<?php if($selectedMarket=='ETH'){?>
                          <tr>
                            <td colspan="2">
                              <input type="text" class="form-control input-xs trn" placeholder="Amount" id="etherdepositvalue" data-trn-key-placeholder="amount" data-trn-key="" style="width: 195px;">
                            </td>
                            <td>
                              <button type="button" class="btn btn-primary btn-xs trn" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="deposit_tab" data-trn-key="deposit" style="width: 80px;" id="ethdepositbutton" >Deposit
                              </button>
                            </td>
                          </tr>
                      <?php }else { ?>
                      		<tr>
                            <td colspan="2">
                              <input type="text" class="form-control input-xs trn" placeholder="Amount" id="amountoftokendeposit2" data-trn-key-placeholder="amount" data-trn-key="" style="width: 195px;">
                            </td>
                            <td>
                              <button type="button" class="btn btn-primary btn-xs trn" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="deposit_tab" data-trn-key="deposit" style="width: 80px;" id="tokendepositbutton2" >Deposit
                              </button>
                            </td>
                          </tr>
                      <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="withdraw1">
                    <table class="table table-borderless table-balances">
                      <tbody>
                        <tr class="table-header">
                          <td class="trn1" data-trn-key="token">Token</td>
                          <td class="trn1" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="balance_wallet_tooltip" data-trn-key="balance_in_your_wallet" data-original-title="This is the balance in your personal Ethereum wallet, which you have connected to DEX in the account dropdown (upper right).">Wallet
                          </td>
                          <td class="trn1" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="balance_etherdelta_tooltip" data-trn-key="balance_etherdelta" data-original-title="This is the balance you have deposited from your personal Ethereum wallet to the current smart contract.">DEX
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table table-borderless table-balances">
                      <tbody>
                        <tr>
                          <td>
                            <a class="selectedCurrencyLabel" href="javascript:;" style="font-size: 15px; font-weight: 100;"><?=$selectedCurrencyData[0]['tokenSymbol'];?></a>
                          </td>
                          <td>
                            <span class="contractwalletbalance">0</span>
                          </td>
                          <td>
                            <span class="balanceDisplayLabel">0</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="padding-sides">
                      <table class="table table-borderless table-balances">
                        <tbody>
                          <tr>
                            <td colspan="2">
                              <input type="text" class="form-control input-xs trn" placeholder="Amount" data-trn-key-placeholder="amount" id="withdrawtoken" data-trn-key="" style="width: 195px;">
                            </td>
                            <td>
                              <button type="button" class="btn btn-primary btn-xs trn" data-toggle="tooltip" data-placement="bottom" id="withdrawtokenbutton" title="" data-trn-key-title="withdraw_tab" data-trn-key="withdraw" style="width: 80px;" data-original-title="Use this to withdraw from the current smart contract (&quot;DEX&quot; column) to your personal Ethereum wallet (&quot;Wallet&quot; column).">Withdraw</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <table class="table table-borderless table-balances">
                      <tbody>
                        <tr>
                          <td>
                            <a href="javascript:;"><span class="marketToken"></span></a>
                          </td>
                          <td>
                          	<?php if($selectedMarket=='ETH'){?>
                            	<span class="EtherbalanceDisplayLabel">0</span>
                            <?php }else{ ?>
                            	<span class="contractwalletbalance2">0</span>
                            <?php } ?>
                          </td>
                          <td>
                          	<?php if($selectedMarket=='ETH'){?>
                            	<span class="Etherbalanceinsmartcontract">0</span>
                            <?php }else{ ?>
                            	<span class="balanceDisplayLabel2">0</span>
                            <?php } ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="padding-sides">
                      <table class="table table-borderless table-balances">
                        <tbody>
                          <tr>
                            <td colspan="2">
                            	<?php if($selectedMarket=='ETH'){?>
                              		<input type="text" class="form-control input-xs trn" placeholder="Amount" id="ethwithdrawamount" data-trn-key-placeholder="amount" data-trn-key="" style="width: 195px;">
                              		<?php } else { ?>
                              			<input type="text" class="form-control input-xs trn" placeholder="Amount" id="withdrawtoken2" data-trn-key-placeholder="amount" data-trn-key="" style="width: 195px;">
                              		<?php }?>
                            </td>
                            <td>
                            	<?php if($selectedMarket=='ETH'){?>
                              <button type="button" class="btn btn-primary btn-xs trn" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="withdraw_tab" data-trn-key="withdraw" style="width: 80px;" id="ethwithdrawbutton" data-original-title="Use this to withdraw from the current smart contract (&quot; DEX &quot; column) to your personal Ethereum wallet (&quot;Wallet&quot; column).">Withdraw</button>
                              <?php }else{ ?>
                              	<button type="button" class="btn btn-primary btn-xs trn" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="withdraw_tab" data-trn-key="withdraw" style="width: 80px;" id="withdrawtokenbutton2" data-original-title="Use this to withdraw from the current smart contract (&quot; DEX &quot; column) to your personal Ethereum wallet (&quot;Wallet&quot; column).">Withdraw</button>
                              <?php } ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="transfer1">
                    <table class="table table-borderless table-balances">
                      <tbody>
                        <tr class="table-header">
                          <td class="trn1" data-trn-key="token">Token</td>
                          <td class="trn1" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="balance_wallet_tooltip" data-trn-key="balance_in_your_wallet" data-original-title="This is the balance in your personal Ethereum wallet, which you have connected to DEX in the account dropdown (upper right).">Wallet
                          </td>
                          <td class="trn1" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="balance_etherdelta_tooltip" data-trn-key="balance_etherdelta" data-original-title="This is the balance you have deposited from your personal Ethereum wallet to the current smart contract.">DEX</td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table table-borderless table-balances">
                      <tbody>
                        <tr>
                          <td>
                            <a href="javascript:;" class="selectedCurrencyLabel" style="font-size: 15px; font-weight: 100;"><?=$selectedCurrencyData[0]['tokenSymbol'];?></a>
                          </td>
                          <td>
                            <span class="contractwalletbalance">0</span>
                          </td>
                          <td>
                            <span class="balanceDisplayLabel">0</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="padding-sides">
                      <table class="table table-borderless table-balances">
                        <tbody>
                          <tr>
                            <td>
                              <input type="text" class="form-control input-xs trn" placeholder="Amount" data-trn-key-placeholder="amount" id="tokentransferamount"data-trn-key="" style="width: 65px;">
                            </td>
                            <td>
                              <input type="text" id="tokentransferdestinationaddress"class="form-control input-xs trn" placeholder="Address" value="" data-trn-key-placeholder="address" data-trn-key="" style="width: 130px;">
                            </td>
                            <td>
                              <button type="button" id="tokentransferbutton" class="btn btn-primary btn-xs trn" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="transfer_tab" data-trn-key="transfer" style="width: 80px;" data-original-title="Use this to transfer from your personal Ethereum wallet (&quot;Wallet&quot; column) to any other wallet.">Transfer</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <table class="table table-borderless table-balances">
                      <tbody>
                        <tr>
                          <td>
                            <a href="javascript:;"><span class="marketToken"></span></a>
                          </td>
                          <td>
                          	<?php if($selectedMarket=='ETH'){?>
                            	<span class="EtherbalanceDisplayLabel">0</span> 
                            <?php }else{ ?>
                            	<span class="contractwalletbalance2">0</span> 
                            <?php } ?>
                          </td>
                          <td>
                          	<?php if($selectedMarket=='ETH'){?>
                            	<span class="Etherbalanceinsmartcontract">0</span>
                            <?php }else{ ?>
                            	<span class="balanceDisplayLabel2">0</span>
                            <?php } ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="padding-sides">
                      <table class="table table-borderless table-balances">
                        <tbody>
                          <tr>
                            <td>
                            	<?php if($selectedMarket=='ETH'){?>
                              <input type="text" class="form-control input-xs trn" placeholder="Amount" id="etheramount" data-trn-key-placeholder="amount" data-trn-key="" style="width: 65px;">
                              <?php } else{?>
                              	<input type="text" class="form-control input-xs trn" placeholder="Amount" id="tokentransferamount2" data-trn-key-placeholder="amount" data-trn-key="" style="width: 65px;">
                              <?php }?>
                            </td>
                            <td>
                            	<?php if($selectedMarket=='ETH'){?>
                              <input type="text" class="form-control input-xs trn" placeholder="Address" value="" id="addresstotransfer" data-trn-key-placeholder="address" data-trn-key="" style="width: 130px;">
                              <?php } else{ ?>
                              	<input type="text" class="form-control input-xs trn" placeholder="Address" value="" id="tokentransferdestinationaddress2" data-trn-key-placeholder="address" data-trn-key="" style="width: 130px;">
                              <?php  }?>
                            </td>
                            <td>
                            	<?php if($selectedMarket=='ETH'){?>
                              <button type="button" class="btn btn-primary btn-xs trn" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="transfer_tab" data-trn-key="transfer" style="width: 80px;" id="ethtransfer" data-original-title="Use this to transfer from your personal Ethereum wallet (&quot;Wallet&quot; column) to any other wallet.">Transfer</button>
                              <?php }else { ?>
                              	<button type="button" class="btn btn-primary btn-xs trn" data-toggle="tooltip" data-placement="bottom" title="" data-trn-key-title="transfer_tab" data-trn-key="transfer" style="width: 80px;" id="tokentransferbutton2" data-original-title="Use this to transfer from your personal Ethereum wallet (&quot;Wallet&quot; column) to any other wallet.">Transfer</button>
                              <?php } ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
<!--                 <div style="margin: 12px;">
                  <p>Make sure <a href="javascript:;" class="selectedCurrencyLabel"></a> is the token you actually want to trade. Multiple tokens can share the same name.
                  </p>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row row-container">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 trades padding-mobile-view">
          <div class="row-header">
              <span class="trn">TRADE HISTORY</span>
            </div>
            <div class="row-box height7 scroll table-bg">
              <div id="trades" style="display: none;"></div>
              <div id="">
                <table class="table table-borderless table-bg" style="color: #fff; margin: 0;">
                  <thead>
                    <tr class="table-header">
                      <th style="color: white; font-size: 14px; font-weight: 600; text-align: center;">Date</th>
                      <th style="color: white; font-size: 14px; font-weight: 600; text-align: center;"><span class="marketToken"></span>/<?=$selectedCurrencyData[0]['tokenSymbol'];?></th>
                      <th style="font-size: 14px; font-weight: 600; text-align: center;"><?=$selectedCurrencyData[0]['tokenSymbol'];?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
			           if(count($tradeHistoryArray) > 0){
			           foreach($tradeHistoryArray as $row){
			               $style= '';
                         if($row['action']=='BUY'){
                           $style='style="color:#4da53c;"';
                         }
                         if($row['action']=='SELL'){
                           $style='style="color:#ff0000;"';
                         }
			           echo '
			             <tr><div role="row" class="data_table__row">
			                 <div role="gridcell" class="data_table__cell data_table__cell-date">
			                     <td><a href="'.$etherScanTxURL.$row['transactionHash'].'" target="_blank" class="trade_history__href">'.date('m/d h:i', $row['timestamp']).'</a></td>
			                     <td><div role="gridcell" class="data_table__cell data_table__cell-amount"><span class="price_shift price_shift-increasing"'.$style.'>'.mb_substr(number_format($row['tokenVsTokenPrice'], 8), 0, 10).'</span></div> </td>
			                     <td><div role="gridcell" class="data_table__cell data_table__cell-amount">'.mb_substr(number_format($row['amountGet'], 8), 0, 10).'</div></td>
			             </div></tr>
			             ';
			             }
			             }
			             else{
			                 echo '<tr><td colspan="3"><div style="text-align: center; padding: 15px;">No Trades Found</div></td></tr>';
			             }
                        ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 buy_sell padding-mobile-view">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pad-left-0" style="padding-left: 0;">
            <div class="row-header trn">BUY</div>
              <div class="row-box height3 padding table-bg">
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="buy" style="display: none;"></div>

                  <div role="tabpanel" class="tab-pane active" id="buy" style="">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-4 text-left selectedCurrencyLabel"><?=$selectedCurrencyData[0]['tokenSymbol'];?></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control trn" placeholder="Amount to buy" id="buyTokenAmount" data-trn-key-placeholder="amount_to_buy" data-trn-key="" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 selectedCurrencyLabel ttip"><span class="marketToken"></span>/<?=$selectedCurrencyData[0]['tokenSymbol'];?>
                          <span class="text selectedCurrencyLabel"> = ? <span class="marketToken"></span></span>
                        </label>
                        <div class="col-sm-8">
                          <input type="text" id="buyAmountPerEther" class="form-control trn buyAmountPerEther" placeholder="Price" data-trn-key-placeholder="price" data-trn-key="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="marketToken"></span></label>
                        <div class="col-sm-8">
                          <input id="buyETHAmount" type="text" class="form-control trn" value="" placeholder="Total" readonly="" data-trn-key-placeholder="total" data-trn-key="">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-4 control-label ttip">
                          <span class="trn" data-trn-key="expires">Expires</span>
                          <span class="text trn" data-trn-key="expires_explanation">The number of Ethereum blocks until the order automatically expires. (14 seconds per block.)
                          </span>
                        </label>
                        <div class="col-sm-8">
                          <input id="byExpiryInBlock" type="text" class="form-control trn" placeholder="numberOfBlocks" value="10000000" data-trn-key-placeholder="numberOfBlocks" data-trn-key="">
                        </div>
                      </div>
                      <center><span class="warning"></span></center>
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                      
                          <button type="button" class="btn btn-success trn" data-trn-key="buy" id="buyPutTradeButton" style="width: 100%;">Buy
                          </button>
                      
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-l-r" style="padding-right: 0">
            <div class="row-header trn">SELL</div>
              <div class="row-box height3 padding table-bg">
                <div class="tab-content">
                  <div role="tabpanel" class="" id="sell" style="display: none;"></div>
                  <div role="tabpanel" class="" id="sell">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-4 selectedCurrencyLabel"><?=$selectedCurrencyData[0]['tokenSymbol'];?></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control trn" placeholder="Amount to sell" id="sellTokenAmount" data-trn-key-placeholder="amount_to_sell" data-trn-key="">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-4 selectedCurrencyLabel ttip"><span class="marketToken"></span>/<?=$selectedCurrencyData[0]['tokenSymbol'];?>
                          <span class="text selectedCurrencyLabel"> = ? <span class="marketToken"></span></span>
                        </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control trn sellAmountPerEtherClass" placeholder="Price" data-trn-key-placeholder="price" id="sellAmountPerEther" data-trn-key="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label"><span class="marketToken"></span></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control trn" value="" placeholder="Total" readonly="" id="sellETHAmount" data-trn-key-placeholder="total" data-trn-key="">
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <label class="col-sm-4 control-label ttip">
                          <span class="trn" data-trn-key="expires">Expires</span>
                          <span class="text trn" data-trn-key="expires_explanation">The number of Ethereum blocks until the order automatically expires. (14 seconds per block.)</span>
                        </label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control trn" placeholder="numberOfBlocks" id="sellbyExpiryInBlock" value="10000000" data-trn-key-placeholder="numberOfBlocks" data-trn-key="">
                        </div>
                      </div>
                      <span class="warning"></span>
                      <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                          <button type="button" class="btn btn-danger trn" data-trn-key="sell" id="sellPutTradeButton" style="width: 100%;">Sell
                          </button>
                         
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-l-r bids" style="">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 bids-t " style="padding-left: 0;">
            <div class="row-header">BIDS <span style="float: right;" id="totalBuyTokens"></span></div>
            
            <div>
                <ul class="nav nav-tabs three columns table-header-ask">
                    <li style="color: white; font-size: 14px; text-align: center; padding-top: 0;" class="selectedCurrencyLabel text-color"><span class="marketToken"></span>/<?=$selectedCurrencyData[0]['tokenSymbol'];?></li>
                    <li style="color: white; font-size: 14px; text-align: center; padding-top: 0;" class="selectedCurrencyLabel text-color"><?=$selectedCurrencyData[0]['tokenSymbol'];?></li>
                    <li style="color: white; font-size: 14px; text-align: center;"><span class="marketToken text-color"></span></li>
                </ul>
          </div>
            
            <div class="row-box scroll padding height07 table-bg" id="" style="padding: 0;">
              <table class="table table-borderless" style="color: #fff; margin: 0;">
<!--               <thead>
                <tr style="border-bottom: 1px solid #ffcc33;">
                  <th style="color: white; font-size: 16px; text-align: center;" class="selectedCurrencyLabel">/ETH</th>
                  <th style="color: white; font-size: 16px; text-align: center;" class="selectedCurrencyLabel"></th>
                  <th style="text-align: center;">ETH</th>
                </tr>
              </thead> -->
              <tbody>
              <?php
        	        if(count($orderBookBuyArray) > 0){
        	        	    $counter = 1;
		        	        foreach($orderBookBuyArray as $row){
		        	        echo'
		        	        <tr role="row" data-toggle="tooltip" class="data_table__row  buyOrderBookTakeModal"  id="buyOrderBookTakeModal'.$counter.'"  
		                                data-id="'.$row['id'].'" 
		                                data-tradeType="'.$row['buyOrSell'].'" 
		                                data-getAmount="'.$row['totalTokenGetAmount'].'" 
		                                data-tokenGet="'.$row['tokenGetName'].'" 
		                                data-tokenGive="'.$row['giveTokenName'].'" 
		                                data-giveAmount="'.$row['totalGiveTokenAmount'].'" 
		                                data-getAmountLeft="'.$row['tokenGetAmount'].'"
		                                data-giveAmountLeft="'.$row['giveTokenAmount'].'" 
		                                data-tokenPriceInEther="'.$row['tokenPriceInEther'].'" 
		                                data-expiryInBlock="'.$row['expiryInBlock'].'" 
		                                data-selectedCurrencyContract="'.$selectedCurrencyData[0]['tokenContractAddress'].'" 
		                                data-v="'.$row['v'].'" 
		                                data-r="'.$row['r'].'" 
		                                data-s="'.$row['s'].'" 
		                                data-nonceOrderBook="'.$row['nonce'].'" 
		                                data-tradeMaker="'.$row['tradeMaker'].'" 
		                                data-feeTakeInContract="'.$row['FeeTake'].'" 
		                                data-etherAmount="'.$row['etherAmount'].'" 
		                                
		                                >
		        	            <td><div role="gridcell" class="data_table__cell data_table__cell-amount"><span class="price_shift price_shift-increasing" style="color:#4da53c;"> '.mb_substr(number_format($row['tokenPriceInEther'], 8), 0, 10).'</span></div></td> 
		        	            <td><div role="gridcell" class="data_table__cell data_table__cell-amount">'.mb_substr(number_format($row['tokenGetAmount'], 8), 0, 10).'</div> </td>
		        	            <td><div role="gridcell" class="data_table__cell data_table__cell-amount">'.mb_substr(number_format($row['giveTokenAmount'], 8), 0, 10).'</div></td>
		        	       </tr>
		        	        ';
		        	        //we want to put script at certain rows only and that is also depend if total row is more than 5
			        	        if(count($orderBookBuyArray) > 4 && $counter == 4){
			        	                echo '
			        	                    <script>
			                    			    var orderBookDeiverVariable = document.getElementById("orderBookDeviderID");
			                    			    
			                    			</script>    
			        	                ';
			        	        }elseif(count($orderBookBuyArray) <= 4 && $counter == 1){
			        	                echo '
			        	                    <script>
			                    			    var orderBookDeiverVariable = document.getElementById("orderBookDeviderID");
			                    			   
			                    			</script>    
			        	                ';
			        	        }
		        	        	$counter++;
        	        	}
        	        
        	        }else{
        	            echo '<div style="text-align: center; padding: 15px;">No Bids Order Found</div>';
        	            echo '
        	                    <script>
                    			    var orderBookDeiverVariable = document.getElementById("orderBookDeviderID");
                    			   /* orderBookDeiverVariable.scrollIntoView(); */
                    			</script>    
        	                ';
        	        }
        	        ?>
              </tbody>
            </table>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 asks-t" style="padding-right: 0;padding-left: 0;">
            <div class="row-header ">ASKS <span style="float: right;" id="totalSellTokens"></span></div>
          
          <div>
            <ul class="nav nav-tabs three columns table-header-ask">
                <li style="color: white; font-size: 14px; text-align: center; padding-top: 0;" class="selectedCurrencyLabel"><span class="marketToken"></span>/<?=$selectedCurrencyData[0]['tokenSymbol'];?></li>
                <li style="color: white; font-size: 14px; text-align: center; padding-top: 0;" class="selectedCurrencyLabel"><?=$selectedCurrencyData[0]['tokenSymbol'];?></li>
                <li style="color: white; font-size: 14px; text-align: center;"><span class="marketToken"></span></li>
            </ul>
          </div>
            
            <div class="row-box scroll padding height07 table-bg" id="" style="padding: 0;">
            
              <table class="table table-borderless" style="color: #fff;margin: 0;">
<!--                 <thead>
                  <tr style="border-bottom: 1px solid #726e6e;">
                  <th style="color: white; font-size: 16px; text-align: center;" class="selectedCurrencyLabel">/ETH</th>
                  <th style="color: white; font-size: 16px; text-align: center;" class="selectedCurrencyLabel"></th>
                  <th style="text-align: center;">ETH</th>
                </tr>
                </thead> -->
                <tbody>
                <?php
        	        if(count($orderBookSellArray) > 0){
        	        		$counter = 1;
        	        		foreach($orderBookSellArray as $row){
			        	        echo'
			        	        <tr role="row" class="data_table__row  sellOrderBookTakeModal"  id="sellOrderBookTakeModal'.$counter.'"  
			        	        			data-id="'.$row['id'].'" 
			                                data-tradeType="'.$row['buyOrSell'].'" 
			                                data-getAmount="'.$row['totalTokenGetAmount'].'" 
			                                data-tokenGet="'.$row['tokenGetName'].'" 
			                                data-tokenGive="'.$row['giveTokenName'].'" 
			                                data-giveAmount="'.$row['totalGiveTokenAmount'].'" 
			                                data-getAmountLeft="'.$row['tokenGetAmount'].'" 
			                                data-giveAmountLeft="'.$row['giveTokenAmount'].'" 
			                                data-tokenPriceInEther="'.$row['tokenPriceInEther'].'" 
			                                data-expiryInBlock="'.$row['expiryInBlock'].'" 
			                                data-selectedCurrencyContract="'.$selectedCurrencyData[0]['tokenContractAddress'].'" 
			                                data-v="'.$row['v'].'" 
			                                data-r="'.$row['r'].'" 
			                                data-s="'.$row['s'].'" 
			                                data-nonceOrderBook="'.$row['nonce'].'" 
			                                data-tradeMaker="'.$row['tradeMaker'].'" 
			                                data-feeTakeInContract="'.$row['FeeTake'].'" 
			                                data-etherAmount="'.$row['etherAmount'].'" 
			                                
			                                >
			        	            <td><div role="gridcell" class="data_table__cell data_table__cell-amount"><span class="price_shift price_shift-increasing" style="color:#ff0000 ;"> '.mb_substr(number_format($row['tokenPriceInEther'], 8), 0, 10).'</span></div> 
			        	            <td><div role="gridcell" class="data_table__cell data_table__cell-amount">'.mb_substr(number_format($row['giveTokenAmount'], 8), 0, 10).'</div> 
			        	            <td><div role="gridcell" class="data_table__cell data_table__cell-amount">'.mb_substr(number_format($row['tokenGetAmount'], 8), 0, 10).'</div>
			        	        </tr>
			        	        ';
		        	        //we want to put script at certain rows only and that is also depend if total row is more than 5
		        	        if(count($orderBookBuyArray) > 4 && $counter == 4){
		        	                echo '
		        	                    <script>
		                    			    var orderBookDeiverVariable = document.getElementById("orderBookDeviderID");
		                    			    
		                    			</script>    
		        	                ';
		        	        }elseif(count($orderBookBuyArray) <= 4 && $counter == 1){
		        	                echo '
		        	                    <script>
		                    			    var orderBookDeiverVariable = document.getElementById("orderBookDeviderID");
		                    			  
		                    			</script>    
		        	                ';
		        	        }
		        	        $counter++;
        	        	}
        	        
        	        }else{
        	            echo '<div style="text-align: center; padding: 15px;">No ASKS Order Found</div>';
        	            echo '
        	                    <script>
                    			    var orderBookDeiverVariable = document.getElementById("orderBookDeviderID");
                    			  /*  orderBookDeiverVariable.scrollIntoView();*/
                    			</script>    
        	                ';
        	        }
        	        ?>
                </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 my_transactions padding-mobile-view">
          <div class="row-header trn">MY TRADES</div>
            <div class="row-box nav-header">
              <ul class="nav nav-tabs four columns" role="tablist">
                <li role="presentation" class="active"><a href="#important1" aria-controls="important1" role="tab" data-toggle="tab" class="trn">Important</a></li>
                <li role="presentation"><a href="#trades1" aria-controls="trades1" role="tab" data-toggle="tab" class="trn">Trades</a></li>
                <li role="presentation"><a href="#orders1" aria-controls="orders1" role="tab" data-toggle="tab" class="trn">Orders</a></li>
                <li role="presentation"><a href="#funds1" aria-controls="funds1" role="tab" data-toggle="tab" class="trn">Funds</a></li>
              </ul>
            </div>
            <div class="row-box">
                <div class="row-box height21123">
                  <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="important1">
                    <div class="row-box height2 scroll table-bg" style="">
                    <?php echo $site_important_text;?>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="myTrades" style="display: none;"></div>
                  <div role="tabpanel" class="tab-pane" id="trades1">
                    <div class="row-box height2 scroll table-bg" style="">
                      <table class="table table-condensed table-borderless">
                        <thead>
                          <tr class="table-header">
                            <th class="trn" data-trn-key="transaction">Transaction</th>
                           <th class="trn" data-trn-key="transaction">Token Name</th>
                            <th class="trn" data-trn-key="type">Type</th>
                          <th><span class="marketToken"></span></th>
                          
                            
                            <th><span class="marketToken"></span>/<?=$selectedCurrencyData[0]['tokenSymbol'];?></th>
                          </tr>
                        </thead>
                        <tbody >
                           <?php
         	 				if(count($usersTradeDataArray) > 0){
          					foreach($usersTradeDataArray as $row){
          							$tSymbolSQL = $conn->query("SELECT tokenSymbol FROM tokendetails where tokenContractAddress='".$row['tokenGet']."' UNION select name as tokenSymbol from market where address='".$row['tokenGet']."'")->fetchColumn();
          						echo'
           					 <tr><div role="row" class="data_table__row">
              				 <td><div role="gridcell" class="data_table__cell ">'.date('m/d h:i', $row['timestamp']).'</div> 
              				 <td><div role="gridcell" class="data_table__cell ">'.$tSymbolSQL.'</div> 
               				 <td><div role="gridcell" class="data_table__cell ">'.$row['action'].'</div> 
              				 <td><div role="gridcell" class="data_table__cell ">'.$row['tokenVsTokenPrice'].'</div>
              				<td><div role="gridcell" class="data_table__cell ">'.$row['amountGet'].'</div> 
            				</div>
            				';
            				}
            				}else{
                			echo'
                    		<tr><td colspan="5"><div role="row" class="data_table__row data_table__row-no_data">
                      		<div role="gridcell" class="data_table__cell" style="color: #fff;">
                        	There is no data yet
                      		</div>
                    		</div></td></tr>
                    		';
            			}
            			?> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="myOrders" style="display: none;"></div>
                  <div role="tabpanel" class="tab-pane" id="orders1">
                    <div class="row-box height2 scroll table-bg" style="">
                      <table class="table table-condensed table-borderless">
                        <thead>
                          <tr class="table-header">
                          	<th class="trn">Date</th>
                            <th class="selectedCurrencyLabel" style="color: white; font-size: 15px;"><span class="marketToken"></span>/<?=$selectedCurrencyData[0]['tokenSymbol'];?></th>
                            <th class="trn" data-trn-key="available_volume">Type</th>
                            <th class="trn" data-trn-key="expires_in"><span class="marketToken"></span></th>
                            <th class="trn" data-trn-key="expires_in"><?=$selectedCurrencyData[0]['tokenSymbol'];?></th>
                            <th class="trn" data-trn-key="action">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php
          					if(count($usersOrderDataArray) > 0){
          					foreach($usersOrderDataArray as $row){

         					 echo'
            					<tr id="orderID-'.$row['id'].'"><div role="row" class="data_table__row">
             					<td><div role="gridcell" class="data_table__cell ">'.date('m/d h:i', strtotime($row['timestamp'])).'</div> 
              					<td><div role="gridcell" class="data_table__cell ">'.$row['totalTokenGetAmount']/$row['totalGiveTokenAmount'].'</div> 
              					<td><div role="gridcell" class="data_table__cell ">'.$row['buyOrSell'].'</div> 
              					<td><div role="gridcell" class="data_table__cell ">'.$row['totalTokenGetAmount'].'</div> 
              					<td><div role="gridcell" class="data_table__cell ">'.$row['totalGiveTokenAmount'].'</div> 
            					<td><div role="gridcell" class="data_table__cell "><button class="cancelOrder btn btn-danger" data-id="'.$row['id'].'">Cancel</button></div> 
            					</div></tr>
            					';
            					}
            					}else{
                				echo'
                   				 <tr><td colspan="3"><div role="row" class="data_table__row data_table__row-no_data">
                    			  <div role="gridcell" class="data_table__cell" style="color: #fff;">
                    			    There is no data yet
                    			  </div>
                   			 </div></td></tr>
                   		 ';
           				 }
           				 ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="myFunds" style="display: none;"></div>
                  <div role="tabpanel" class="tab-pane" id="funds1">
                    <div class="row-box height2 scroll table-bg" style="">
                      <table class="table table-condensed table-borderless">
                        <thead>
                          <tr class="table-header">
                            <th class="trn" data-trn-key="transaction"> Date</th>
                            <th class="trn" data-trn-key="type">Type</th>
                            <th class="trn" data-trn-key="trhax">Txn Hash</th>
                          <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                   
          					if(count($usersTransactionsArray) > 0){
                    foreach($usersTransactionsArray as $row){
                              $txHash = $row['transactionHash'];
                                $txHash = substr($txHash,0,5).'...'.substr($txHash,-5);
                                $txHash = '<a href="'.$etherScanTxURL.$row['transactionHash'].'" target="_blank">'.$txHash.'</a>';
                                $amount = '';
                              if($row['tokenAmount']!=0){
                               // $amount = $row['TokenAmount']/pow(10,$selectedCurrencyData[0]['tokenDecimal']);
                               $amount = $row['tokenAmount'];
                              }
                              if($row['etherAmount']!=0){
                                $amount = $row['etherAmount'];
                              }
                   echo'
                      <tr><div role="row" class="data_table__row">
                      <td><div role="gridcell" class="data_table__cell ">'.date('m/d h:i', $row['timestamp']).'</div> 
                                <td><div role="gridcell" class="data_table__cell ">'.$row['type'].'</div> 
                        <td><div role="gridcell" class="data_table__cell ">'.$txHash.'</div> 
                        <td><div role="gridcell" class="data_table__cell ">'.$amount.'</div>
                      </div>
                      ';
                      }
                      }else{
                        echo'
                           <tr><td colspan="3"> <div role="row" class="data_table__row data_table__row-no_data">
                            <div role="gridcell" class="data_table__cell" style="color: #fff;">
                              There is no data yet
                            </div>
                         </div></td></tr>
                       ';
                   }
           				 ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div id="volume" style="display: none;"></div>
      </div>
    </div>

  <footer class="footer">
    <div class="container-fluid">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <!--<p style="margin-bottom: 0;font-size: 16px; font-weight: 300;">&copy; <?php echo date ('Y'); ?> <?php echo $siteName;?></p>-->
            <p style="margin-bottom: 0;font-size: 16px; font-weight: 300;">&copy; 2021 StakeProtocal  Private Limited</p>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
                <nav>
                    <?php if($telegram_status==1){?>
                        <a href="<?php echo $telegram_url;?>" target="_blank"><i class="fa fa-telegram"></i></a>
                    <?php } if($twitter_status==1){ ?>
                        <a href="<?php echo $twitter_url;?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    <?php } if($youtube_status==1){ ?>
                        <a href="<?php echo $youtube_url;?>" target="_blank"><i class="fa fa-youtube"></i></a>
                    <?php } if($facebook_status==1){ ?>
                        <a href="<?php echo $facebook_url;?>" target="_blank"><i class="fa fa-facebook"></i></a>
                    <?php } ?>
                    <a href="about.php" target="_blank">About</a>
                    <a href="support.php" target="_blank">Support</a>
                    <a href="privacy.php" target="_blank">Privacy</a>
                </nav>
        </div>
    </div>
  </footer>

<!-- custom -->
   

    <div id="buyTrade"></div>
    <div id="sellTrade"></div>
    <div id="importAccount"></div>
    <div id="otherToken"></div>
    <div id="gasPrice"></div>
    <div id="tokenGuide"></div>
    <div id="screencast"></div>
    <div id="ledger"></div>

    

    <script src="js/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script src="js/jquery.translate.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/alertify.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://unpkg.com/lightweight-charts@3.2.0/dist/lightweight-charts.standalone.production.js"></script>
    <!-- <script src="js/ejs_production.js" type="text/javascript"></script>
    <script src="js/chrome-u2f-api.js" type="text/javascript"></script>
    <script src="js/ledger.min.js" type="text/javascript"></script> -->
  
<!--   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.34/dist/web3.js"></script>
    <script src="https://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
  


    <!--<script src="/js/main-unminified.js" type="text/javascript"></script>
    <script src="/js/main-custom.js" type="text/javascript"></script>-->
    
    
    <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
    
    <script type="text/javascript">
      function getCookie(cname) {
  		var name = cname + "=";
  		var ca = document.cookie.split(';');
  		for(var i = 0; i < ca.length; i++) {
    		var c = ca[i];
    		while (c.charAt(0) == ' ') {
      			c = c.substring(1);
    		}
    		if (c.indexOf(name) == 0) {
      			return c.substring(name.length, c.length);
    		}
  		}
  		return "";
	}
      
     var showpopup = getCookie("showpopup");
   if (showpopup != "no") {
     swal("", "*VERY IMPORTANT, any digital representation of a pre-delivered sale (token) within DEX platform MUST BE BACKED BY A LEGAL GOVERMENT INVOICE and clear ICC incoterm agreement. This tokens purpose is to facilitate agroproducts trading and empower agriculture. Tokens are not meant for saving, investing, speculating or any other financial instrument and HAVE NO VALUE other than the legal sale they represent. Please verify your personal legal capability before interacting with this platform or contact us for more information.", "info");  
       var d = new Date();
       d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
       var expires = "expires="+d.toUTCString();
       document.cookie = "showpopup=no;" + expires + ";path=/";
       
     }else{           
    
     }

    
    </script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-112001937-1', 'auto');
      ga('send', 'pageview');
    </script>

   
    <script type="text/javascript">
      document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'interactive') {
             document.getElementById('contents').style.visibility="hidden";
        } else if (state == 'complete') {
            setTimeout(function(){
               document.getElementById('interactive');
               /*document.getElementById('load').style.visibility="hidden";*/
               //document.getElementById('chartPrice').style.visibility="visible";
            },40000);
        }
      }
    </script>
    
  <script>
  $(window).on('load', function() {
 // code here

        var url = window.location.href;
    var usersdata = localStorage.getItem('EtherDelta');
  usersdata=JSON.parse(usersdata);
    var selectedaccountnumber=usersdata['selectedAccount'];
   var pubaddress = usersdata['accounts'][selectedaccountnumber]['addr']
  
    if(!url.includes("userPublicAddress")){
if (url.indexOf('?') > -1){
   url += '&userPublicAddress='+pubaddress;
}else{
   url += '?userPublicAddress='+pubaddress;
}
window.location.href = url;
    }
     });
  </script>
  
  
  <div id="contents" style="display: none"></div>
  <script>
  
  function tokensinMenu(string){
  // create a cookie
  document.cookie = "selectedCurrency="+string;
  localStorage.setItem("selectedCurrency", string);
  window.location="";
}
  </script>
<?php 
  //setcookie('userPublicAddress', '0x2364868A08E470Ab991e368469cB780733186CAd', time() + (86400 * 30), "/");
 if(isset($_GET['ref']) && $_GET['ref']!=''){ $referrer = $_GET['ref']; } else { $referrer = "0x0000000000000000000000000000000000000000"; }
 
//preparing variables for the Javascript
echo'
<script>
var web3Infura = new Web3(Web3.givenProvider || "'.$adminSettings[0]['ethProvider'].'");
var ethProvider = "'.$adminSettings[0]['ethProvider'].'";
//to find selected currency in menu 
var defaultCurrencyMenu = "'.$adminSettings[0]['defaultSelectedCurrency'].'";
var mainContractAddress = "'.$mainContractAddress.'";
var userEtherBalance=0; //in this variable we store ether balance of user wallet
var userTokenBalance=0; //in this variable we store the balance of token in user wallet address
var userEtherBalanceOfSmartcontract=0; //in this variable we store the ether balance of user which are in smart contract
var userTokenbalanceOfSmartcontract=0; //in this variable we store the particular token balance of user from smart contaract
var feeTakeInContract=0;
var EtherAddress = "'.$adminSettings[0]['ethAddr'].'";
var etherscanTxURL = "'.$etherScanTxURL.'";
var etherscanAddressURL = "'.$etherScanAddressURL.'";
var CurrentBlockNumber=0;
var myAccountAddress="";
var gasApprove = "'.$adminSettings[0]['defauktGasCost'].'";
var gasDeposit = "'.$adminSettings[0]['defauktGasCost'].'";
var gasWithdraw = "'.$adminSettings[0]['defauktGasCost'].'";
var gasTrade = "'.$adminSettings[0]['defauktGasCost'].'";
var ethAddr = "'.$adminSettings[0]['ethAddr'].'";
var ethGasPrice = "'.$adminSettings[0]['defaultGasPrice'].'";
var domainname = window.location.hostname;
var selectedCurrencyMenu = "'.$selectedCurrencyData[0]['tokenSymbol'].'";
var selectedCurrencyContract = "'.$selectedCurrencyData[0]['tokenContractAddress'].'";
var selectedTokenDecimal = "'.$selectedCurrencyData[0]['tokenDecimal'].'";
var arrayABI = '.$arrayABI.';
var arrayEATABI = '.$arrayEATABI.';
var isTestNetNo = "'.$adminSettings[0]['isTestNet'].'";
var selectedMarket = "'.$selectedMarket.'";
var marketsAddress ="'.$marketsAddress.'";
var marketDecimals = "'.$marketDecimals.'";
var marketsABI = '.$marketsABI.';		
var chainID = "'.$chainID.'";
var siteName = "'.$siteName.'";
var tradingHelpDoc = "'.$tradingHelpDoc.'";
var referrer = "'.$referrer.'";
var etherscanAPIKey = "'.$adminSettings[0]['etherscanAPIKey'].'";
</script>';
?>
  <script src="js/script.js?v=<?php echo time();?>" type="text/javascript"></script>	
 <script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function selectmarket() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
</script>

<script>
	$('.row-container').click(function(event){
		
      if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
	

  }
      });	
</script>
<script>
	$('.dropdown-toggle').click(function(event){
		
      if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
	

  }
      });
</script>
<script>

	function copyLink() {
		var Url = document.getElementById("refLink");
		Url.innerHTML = window.location.href;
		console.log(Url.innerHTML)
		Url.select();
		document.execCommand("copy");
		alertify.success('Referral Link Copied');
	}

if(localStorage.getItem('market') === null ){
	localStorage.setItem("market", '<?php echo $selectedMarket;?>');
	document.cookie = "market=<?php echo $selectedMarket;?>";
	$('.marketToken').html('<?php echo $selectedMarket;?>');
}else{
	var thisMarket = localStorage.getItem('market');
	$('.marketToken').html(thisMarket);
}

if(localStorage.getItem('selectedCurrency') === null ){
	localStorage.setItem("selectedCurrency", '<?php echo $adminSettings[0]['defaultSelectedCurrency'];?>');
	document.cookie = "selectedCurrency=<?php echo $adminSettings[0]['defaultSelectedCurrency'];?>";
	$('.selectedCurrencyLabel').html('<?php echo $adminSettings[0]['defaultSelectedCurrency'];?>');
}else{
	var thisMarketCurrency = localStorage.getItem('selectedCurrency');
	$('.selectedCurrencyLabel').html(thisMarketCurrency);
}

$('.basePairText').click(function(){
	var thisMarket = $(this).text();
	localStorage.setItem("market", thisMarket);
	document.cookie = "market="+thisMarket;
	location.reload();
});
</script>

	</body>
</html>
