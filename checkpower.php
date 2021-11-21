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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<title>S C E E M S - Check Power</title>

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
	<link rel="stylesheet" href="assets/css/ownstyle.css">


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

		<section class="container" style =  "padding-top: 150px; padding-bottom:100px">
			<i class="ion-ios-download-outline"></i>
			<center><img src = "assets/img/logo.png" height = "120px" width = "100px" />
				<?php
				include "connection.php";
				$day = date("j");
				$month = date("F");
				$year = date("Y");
				$sql = "SELECT * FROM bill_cycle WHERE account_id = $account_id AND month = '$month' AND year = '$year' ;";
				$result = $conn ->query($sql);
				while($row = $result->fetch_assoc()){
					$tblPreviousMeter = $row['previous_meter_reading'];
					$tblPresentMeter = $row['present_meter_reading'];
					$totalConsumption = $tblPresentMeter - $tblPreviousMeter;
				 ?>
				<h3 style = "color:#fff;  margin-bottom:15px; margin-top:30px;" >CHECK POWER</h3></center>
				<center>
					  <span style= "color:#fff;"><?php echo $month, " ", $day, ", ", $year ?> </span><br><br>
					<p style = "color:#fff"><b> PREVIOUS READING </b></P>
						<input type = "text" class = "form-control btn-block input-lg" value= "<?php echo round($tblPreviousMeter, 2), " "?>kW/h" style="text-align:center; font-size:20; font-weight: bold;" disabled/><br>
						<p style = "color:#fff"><b> PRESENT READING </b></P>
							<input type = "text" class = "form-control btn-block input-lg" value= "<?php echo round($tblPresentMeter, 2), " "?>kW/h" style="text-align:center; font-size:20; font-weight: bold;" disabled/><br>
							<p style = "color:#fff"><b> CONSUMPTION IN kW/h </b></P>
								<input type = "text" class = "form-control btn-block input-lg" value= "<?php echo round($totalConsumption, 2), " "?>kW/h" style="text-align:center; font-size:20; font-weight: bold;" disabled/><br>
							<?php }?>
								<button type="submit" class="btn btn-primary btn-round btn-block " onclick="location.href = 'homepage.php';">BACK</button></center>
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
