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
$Contactnumber2 = $_SESSION['contact_number2'];
$address = $_SESSION['address'];
$account_type_id = $_SESSION['account_type_id'];

include "connection.php";
$day = date("j");
$month = date("F");
$year = date("Y");
$firstday = date('01 F, Y');
$lastday = date('t F, Y');
$sql = "SELECT * FROM bill_cycle WHERE account_id = $account_id AND month = '$month' AND year = '$year' ;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
	$tblTotalBill = $row['total_bill'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<title>S C E E M S - My Account</title>

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


	<style>
	.btn-block{
		display:block;
		width:100%
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

		<section class="container" style =  "padding-top: 150px; padding-bottom:150px">
			<i class="ion-ios-download-outline"></i>
			<center><span class="ion-android-person" style ="font-size:120px; color:white;"/></span>
				<h3 style = "color:#fff">USER ACCOUNT</h3>
 <span style= "color:#fff;"><?php echo $firstday, " - ", $lastday ?> </span><br><br>
				<a href = "billingbreakdown.php"><span class="label label-pill label-primary" style="border-radius:10px;font-size:20px; ">BILL: ₱ <?php echo " ", number_format(round($tblTotalBill,2),2)?></span><br><br>
				</a>
				<div class = "container">
					<div class = "row">
						<div class = "col-sm-2" style = "margin-left: -30px"></div>
						<div class = "col-sm-4">
							<center>

								<p style = "color:#fff"><b> ACCOUNT NAME:</b> <?php echo $lastname, ", ", $firstname, " ", $middlename?> </P>

									<p style = "color:#fff"><b> USERNAME:</b> <?php echo $username?></p> </P>

										<p style = "color:#fff"><b> ADDRESS:</b> <?php echo $address?> </P>

										</center>

									</div>

									<!--<div class = "col-sm-1"></div>-->
									<div class = "col-sm-4">
										<center>
											<p style = "color:#fff"><b> ACCOUNT NUMBER: </b> <?php echo $account_id?></p>

												<p style = "color:#fff"><b> CONTACT NUMBER:</b> <?php 	function phn_numb($numb) {
												  if (!is_numeric(substr($numb, 0, 1))  && !is_numeric(substr($numb, 1, 1))) { return $numb; }

												  $chars = array(' ', '(', ')', '-', '.');
												  $numb = str_replace($chars, "", $numb);

												  if (strlen($numb) > 10) {
												    // a 10 digit number, format as 1-800-555-5555
												    $numb = substr($numb, 0, 1) . '-' . substr($numb, 1, 3) . '-' . substr($numb, 4, 3) . '-' . substr($numb, 7, 4);
												  }
												  else {
												    $numb = substr($numb, 0, 3) . ') ' . substr($numb, 3, 3) . '-' . substr($numb, 5, 4);
												  }

												  return $numb;
												}

												echo  "(0", phn_numb($Contactnumber)?></P>

													<p style = "color:#fff"><b> CONTACT NUMBER 2: </b><?php echo  "(0", phn_numb($Contactnumber2)?></P>

												</div>
												<div class = "col-sm-1"></div>

											</div>
										</div>

											<button type="submit" class="btn btn-primary btn-round btn-block" onclick="location.href = 'updateaccount.php';">Change Username/Password</button><br>
											<button type="submit" class="btn btn-primary btn-round btn-block" onclick="location.href = 'homepage.php';">BACK</button></center>
										<center>
										</center>
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
