<?php session_start(); //starts the session
if($_SESSION['account_number'] && $_SESSION['status']){
}
else{
	header("location:index.php");
}
$account_id = $_SESSION['account_number'];
$username =   $_SESSION['username'];
$password = $_SESSION['password'];
$firstname = $_SESSION['first_name'];
$middlename = $_SESSION['middle_name'];
$lastname = $_SESSION['last_name'];
$Contactnumber = $_SESSION['contact_number'];
$address = $_SESSION['address'];
$account_type_id = $_SESSION['account_type_id'];
$month = date("F");
$year = date("Y");
$firstday = date('01 F, Y');
$lastday = date('t F, Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<title>S C E E M S - Break Down</title>

	<!-- meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- css -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/ionicons.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/owl.theme.css">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="uiassets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="uiassets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
	<!-- scripts -->
	<script src="assets/js/jquery-2.1.3.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/wow.min.js"></script>
	<script src="assets/js/owl.carousel.js"></script>
	<script src="assets/js/script.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<!-- fonts -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic|Roboto+Condensed:300italic,400italic,700italic,400,300,700|Oxygen:400,300,700' rel='stylesheet'>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<link rel="canonical" href="https://www.creative-tim.com/product/now-ui-kit" />
	<script src="uiassets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="uiassets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="uiassets/js/core/bootstrap.min.js" type="text/javascript"></script>
	<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
	<script src="uiassets/js/plugins/bootstrap-switch.js"></script>
	<script src="uiassets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>
	<script src="uiassets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
	<link rel="stylesheet" href="assets/css/ownstyle.css">
	<style>
	.btn-block{
		display:block;
		width:80%
	}
	/* Style The Dropdown Button */
	.dropbtn {
		background-color: transparent;
		color: white;
		padding: 2px;
		font-size: 16px;
		border: none;
		cursor: pointer;
	}

	/* The container <div> - needed to position the dropdown content */
	.dropdown {
		position: relative;
		display: inline-block;
	}

	/* Dropdown Content (Hidden by Default) */
	.dropdown-content {
		display: none;
		position: absolute;
		background-color: #f9f9f9;
		min-width: 160px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		z-index: 1;
		left:-130px;
	}

	/* Links inside the dropdown */
	.dropdown-content a {
		color: black;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
	}

	/* Change color of dropdown links on hover */
	.dropdown-content a:hover {background-color: transparent; color:#4fc3f7; }

	/* Show the dropdown menu on hover */
	.dropdown:hover .dropdown-content {
		display: block;
	}

	/* Change the background color of the dropdown button when the dropdown content is shown */
	.dropdown:hover .dropbtn {
		background-color: transparent;
		color:#4fc3f7;
	}

	.scrollable-menu {
		height: auto;
		max-height: 100px;
		overflow-x: hidden;
	}
	@media screen and (max-device-width : 320px)
	{
		.icons
		{
			font-size: 30px;

		}
		.logo {
			font-family: 'caviar_dreams';
			color: #fff;
			font-size: 27px;
			line-height: 1.6;
		}
		.btn-font{
			font-size: 16px;
		}
		.btn-font2{
			font-size: 18px;
		}


		.button-icon{
			font-size: 22px;
		}
		.btn-img{
			width:20px;
			height:10px;
		}
		.card-signup {

			padding-right: -10px;
			padding-left: -10px;
			border-width: 1px;
			border-radius: 10px !important;
			max-width: 275px;
			margin: 0 auto;
		}

	}
	@media screen and (max-device-width : 1920px)
	{
		.icons
		{
			font-size: 40px;

		}
		.logo {
			font-family: 'caviar_dreams';
			color: #fff;
			font-size: 2em;
			line-height: 1.6;
		}
		.button-icon{
			font-size: 25px;
		}

		.btn-img{
			width:26px;
			height:26px;
		}

		.card-signup {

			padding-right: -10px;
			padding-left: -10px;
			border-width: 1px;
			border-radius: 10px !important;
			max-width: 550px;
			margin: 0 auto;
		}
	}

	@media(max-width: 1580px) {
		.icons
		{
			font-size: 30px;
		}
		.logo {
			font-family: 'caviar_dreams';
			color: #fff;
			font-size: 1.5em;
			line-height: 1.6;
		}
		.button-icon{
			font-size: 22px;
		}
		.btn-img{
			width:26px;
			height:26px;
		}
	}
	@media(max-width: 980px) {
		.icons
		{
			font-size: 30px;
		}

		.logo {
			font-family: 'caviar_dreams';
			color: #fff;
			font-size: 27px;
			line-height: 1.6;
		}
		.button-icon{
			font-size: 22px;
		}

		.btn-img{
			width:26px;
			height:26px;
		}
		.card-signup {

			padding-right: -10px;
			padding-left: -10px;
			border-width: 1px;
			border-radius: 10px !important;
			max-width: 275px;
			margin: 0 auto;
		}
	}
	</style>
</head>
<body id="banner">

	<!-- ****************************** Preloader ************************** -->

	<div id="preloader"></div>
	<!-- ****************************** Header ************************** -->

	<header class="sticky" id="header">
		<section class="container">
			<section class="row" id="logo_menu">
				<section style =" -ms-flex: 0 0 16.666667%;  flex: 0 0 16.666667%; max-width: 16.666667%;"><center>
					<button class="btn btn-link ion-ios-list icons"  onclick="location.href = 'billcyclelog.php';" style="	color:white; margin-top:0px; text-align:center;"></button>
				</center></section>

				<section  style ="  flex: 0 0 65.666667%; max-width: 66.666667%; "><center><a class="logo" href=""> S C E E M S</a></center></section>



				<section  style ="-ms-flex: 0 0 16.666667%;  flex: 0 0 16.666667%;  max-width: 16.666667%;"><center>
					<div class="dropdown " >
						<button class="dropbtn ion-android-notifications icons" style="	color:white;"></button><span class="label label-pill label-danger count " style="border-radius:10px;"></span>
						<div class="dropdown-content scrollable-menu">

						</div>
					</div>
				</center></section>
				<!--<section class="col-xs-12"><center><a href ="#"><span class = "label label-pill label-danger count"></span><i style = "font-size:35px; color:white;"class="ion-android-notifications"></i></a></center></section>-->
			</section>
		</section>
	</header>

	<!-- ****************************** Banner ************************** -->


	<div class="wrappper">

		<section class="container" style =  "padding-top: 50px; padding-bottom:150px">
			<i class="ion-ios-download-outline"></i>
			<center><h4 style = "color:#fff">BILLING BREAK DOWN</h4>
			<span style= "color:#fff;"><?php echo $firstday, " - ", $lastday ?> </span></center><br><br>

        <table class = "table animated fadeInDown delay-1s">
        <thead style = "background-color:#195b71;" >
        <tr>

        <td style = "color:#fff"><center>Rate Components</center></td>
        <td style = "color:#fff">Rate</td>
        <td style = "color:#fff">Amount, PHP</td>

        </tr>
        </thead>
        <?php
include "connection.php";
$day = date("j");
$month = date("F");
$year = date("Y");
$sql = "SELECT * FROM bill_cycle WHERE account_id = $account_id AND month = '$month' AND year = '$year' ;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  $tblPrevious = $row['previous_meter_reading'];
  $tblPresent  = $row['present_meter_reading'];
  $tblConsume =$tblPresent  - $tblPrevious;
}
$sqlprice = "SELECT * FROM price_rate WHERE account_type_id = $account_type_id AND month = '$month' AND year = '$year' ;";
$resultprice = $conn ->query($sqlprice);
while($row = $resultprice->fetch_assoc()){
	$tblPricePerKw = $row['price_per_kw'];
	$tblgeneration_charge = $row['generation_charge'];
	$tblpower_act_reduction = $row['power_act_reduction'];
	$tbltransmission_delivery_charge = $row['transmission_delivery_charge'];
	$tblsystem_loss = $row['system_loss'];
	$tbldistribution_network_charge = $row['distribution_network_charge'];
	$tblretail_electric_service_charge = $row['retail_electric_service_charge'];
	$tblmetering_charge_Php_kWh = $row['metering_charge_Php/kWh'];
	$tbldistribution_connection_charge = $row['distribution_connection_charge'];
	$tblmissionary_electrification = $row['missionary_electrification'];
	$tblenvironment_charges = $row['environment_charges'];
	$tblNPC_stranded_costs = $row['NPC_stranded_costs'];
	$tblNPC_stranded_debts = $row['NPC_stranded_debts'];
	$tblFIT_All = $row['FIT-All'];
}
?>
<tbody id='tbodie'>

	<tr>
    <th style = "color:#fff">Generation Charge:</th>
    <td style = "color:#fff; font-size:12px;"><?php echo round($tblgeneration_charge,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblgeneration_charge*$tblConsume,2)?></td>
  </tr>
	<tr>
		<th style = "color:#fff">Power Act Reduction:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblpower_act_reduction,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblpower_act_reduction*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">Transmission Delivery Charge:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tbltransmission_delivery_charge,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tbltransmission_delivery_charge*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">System Loss:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblsystem_loss,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblsystem_loss*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">Distribution Network Charge:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tbldistribution_network_charge,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tbldistribution_network_charge*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">Retail Electric Service Charge:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblretail_electric_service_charge,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblretail_electric_service_charge*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">Metering Charge:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblmetering_charge_Php_kWh,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblmetering_charge_Php_kWh*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">Distribution Connection Charge:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tbldistribution_connection_charge,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tbldistribution_connection_charge*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">Missionary Electrification:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblmissionary_electrification,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblmissionary_electrification*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">Environment Charges:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblenvironment_charges,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblenvironment_charges*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">NPC Stranded Costs:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblNPC_stranded_costs,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblNPC_stranded_costs*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">NPC Stranded Debts:</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblNPC_stranded_debts,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblNPC_stranded_debts*$tblConsume,2)?></td>
	</tr>
	<tr>
		<th style = "color:#fff">FIT-All (Renewable):</th>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblFIT_All,2)?></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblFIT_All*$tblConsume,2)?></td>
	</tr>

	<tr>
		<th style = "color:#fff"><center>GRAND TOTAL:</center></th>
		<td style = "color:#fff; font-size:12px;"></td>
		<td style = "color:#fff; font-size:12px;"><?php echo round($tblPricePerKw*$tblConsume,2)?></td>
	</tr>

</tbody>

        <table>
					<center><button type="button" class="btn btn-primary btn-round k" onclick="location.href = 'account.php';">BACK</button></center>
				</section>
			</section>

		</div>
		<!-- ****************************** Features Section ************************** -->

	</body>
	</html>
	<script>
	$(document).ready(function(){
	$.ajaxSetup({ cache: false }); // or iPhones don't get fresh data
});
	function goBack() {
				window.history.back();
			}
	$('#onoff').on('change', function(){
		var switch_status = $(this).val();
		if ( $(this).is(':checked') ) {
			$(this).val("ON");
			$.ajax({
				type: "POST",
				url: "api/set_switch.php",
				data: "switch_status="+switch_status,
				success: function(data){

				}
			});
		}
		else{$(this).val("OFF");
		$.ajax({
			type: "POST",
			url: "api/set_switch.php",
			data: "switch_status="+switch_status,
			success: function(data){

			}
		});
	}
});

$(document).ready(function(){

	function load_unseen_notification(view = '')
	{
		$.ajax({
			url:"api/fetch.php",
			method:"POST",
			data:{view:view},
			dataType:"json",
			success:function(data)
			{
				$('.dropdown-content').html(data.notification);
				if(data.unseen_notification > 0)
				{
					$('.count').html(data.unseen_notification);
				}
			}
		});
	}

	load_unseen_notification();

	$(document).on('click', '.dropbtn', function(){
		$('.count').html('');
		load_unseen_notification('yes');
	});

	setInterval(function(){
		load_unseen_notification();;
	}, 5000);

});
</script>
