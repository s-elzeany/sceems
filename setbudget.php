
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
	<title>S C E E M S - Set Budget</title>

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
	<!-- Warning Modal -->
	<div class="modal fade modal-mini modal-danger" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style=" background: rgba(0, 0, 0, 0.5);" aria-hidden="true">
		<div class="modal-dialog" style = "padding-top:350px;">
			<div class="modal-content" id ="alertModalContent" >

				<div class="modal-body">
					<p id ="warning_message"></p>

				</div>
				<div class="modal-footer">

					<button type="button" class="btn btn-link btn-neutral" data-dismiss="modal" id="a">Okay</button>
				</div>
			</div>
		</div>
	</div>
	<!--  End Warning Modal -->

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
			<center><img style = "color:#fff;  margin-bottom:15px; margin-top:30px;" src = "assets/img/icon-peso.png" height = "80px" width = "160px"/>
				<h3 style = "color:#fff; margin-bottom:15px; margin-top:30px;">SET BUDGET</h3></center>

				<form id = "budget_set_form" enctype="multipart/form-data">
					<center>
							 <span style= "color:#fff;"><?php echo $firstday, " - ", $lastday ?> </span><br><br>
							<input type = "number" class = "form-control btn-block input-lg" min = 0  style="color:#fff; text-align:center; font-size:30;" name="set_budget" placeholder= "SET BUDGET" required/><br>
							<?php
							include "connection.php";
							$sqlpricetotal = "SELECT SUM(rate) AS 'Rate_TOTAL' FROM price_rates WHERE account_type_id = $account_type_id AND rate_status = 'new';";
				      $resultpricetotal = $conn ->query($sqlpricetotal);
				      while($row = $resultpricetotal->fetch_assoc()){
				      $tblPricePerKw = $row['Rate_TOTAL'];
				      }

							$sqlbudgetset = "SELECT * FROM budget_set WHERE account_id = $account_id AND month = '$month' AND year = '$year' ;";
							$resultbudgetset = $conn ->query($sqlbudgetset);
							$num_rows = mysqli_num_rows($resultbudgetset);
							if($num_rows == 0 ){

							}
							elseif($resultbudgetset -> num_rows > 0){
								while($row = $resultbudgetset->fetch_assoc()){
									$tblBudgetSet = $row['budget_set'];
									$tblBudgetConsumed = $row['budget_consumed'];
									$tblKillowatsConsumed = $row['kilowatts_consumed'];
									$totalKilowatts =$tblBudgetSet/$tblPricePerKw;
									$KilowattsLeft =$totalKilowatts -$tblKillowatsConsumed;
								?>
								<p style = "color:#fff"><b> BUDGET SET</b></P>
									<input type = "text" class = "form-control btn-block input-lg"  style="color:#000; text-align:center; font-size:30;" name="budget_set" placeholder= "BUDGET SET"  value = "<?php echo "₱ ", round($tblBudgetSet)?>" disabled/><br>
									<p style = "color:#fff"><b> BUDGET LEFT </b></P>
										<input type="text" class = "form-control btn-block input-lg"  style="color:#000; text-align:center; font-size:30;" name = "budget_consumed" value = "<?php echo "₱ ", round($tblBudgetConsumed,2)?>" disabled/><br>
										<p style = "color:#fff"><b> KW/H LEFT </b></P>
											<input type="text" class = "form-control btn-block input-lg" style="color:#000; text-align:center; font-size:30;" name = "kilowatts_consumed" value = "<?php echo  round($KilowattsLeft,2), " kW/h"?>" disabled/><br>
									<?php }
								}?>
										<input type = "text" class = "form-control btn-block input-lg"  name="month" value= "<?php echo $month ?>" hidden/><br>
										<input type = "text" class = "form-control btn-block input-lg"  name="year" value= "<?php echo $year ?>" hidden/><br>
										<button type="submit" class="btn btn-primary btn-round ">SET</button>
										<button type="button" class="btn btn-primary btn-round " onclick="location.href = 'budget&powersettings.php';">BACK</button></center>
									</form>
										<a id ="warning_click" data-toggle="modal"  data-target="#alertModal" hidden>Trigger Warning</a>
								</section>

							</div>
							<!-- ****************************** Features Section ************************** -->

							<script>
							$(document).ready(function(){
	$.ajaxSetup({ cache: false }); // or iPhones don't get fresh data
});
							/**	var Limit = new Date();
							var dd = Limit.getDate();
							var mm = Limit.getMonth()+1; //January is 0!
							var yyyy = Limit.getFullYear();
							if(dd<10){
							dd='0'+dd
						}
						if(mm<10){
						mm='0'+mm
					}

					Limit = yyyy+'-'+mm+'-'+dd;
					document.getElementById("year").setAttribute("value", yyyy);
					document.getElementById("year").setAttribute("min", yyyy);
					//	document.getElementById("maxdate").setAttribute("min", Limit);**/

					$(document).ready(function(){
						$('#budget_set_form').on('submit',(function(e) {
							e.preventDefault();
							var formData = new FormData(this);

							$.ajax({
								type:'POST',
								url: "api/set_budget.php",
								data:formData,
								cache:false,
								contentType: false,
								processData: false,
								success:function(data){
									$("#warning_message").html("You have successfully Updated!");
									document.getElementById("warning_click").click();
									$("#alertModalContent").css('background-color','#00bb39');
									document.getElementById("a").onclick = function () {
									 location.href = "setbudget.php";
							 };
								}
							});
						}));
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
				</body>
				</html>
