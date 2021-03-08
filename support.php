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
  <link rel="icon" type="img/png" sizes="32x32" href="img/favicon.png">
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
<div class="container-fluid padding-mobile-view" style="padding-top: 20px;min-height: 700px;width: 1170px;">
      
      <div class="row">
      <div class="col-sm-12 mb-5">
      <h1>Support</h1>
      </div>
      	<div class="col-sm-12">
        	<form>
            <div class="form-group">
			    <label for="exampleInputName">Name</label>
			    <input type="text" class="form-control" id="exampleInputName" aria-describedby="NameHelp">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputq">Enter your Question</label>
			    <input type="text" class="form-control" placeholder="Enter your Question">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlTextarea1">Enter Your Comment</label>
			    <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
			  </div>
  			  <div class="form-group">
    			<label for="exampleFormControlFile1">Attche you docs</label>
    			<input type="file" class="form-control-file" id="exampleFormControlFile1">
  			  </div>
			  <div class="form-group form-check">
			    <input type="checkbox" class="form-check-input" id="exampleCheck1">
			    <label class="form-check-label" for="exampleCheck1">Check me out</label>
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
      	</div>
      </div>
    </div>

  <footer class="footer">
    <div class="container-fluid">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
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
