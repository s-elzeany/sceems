<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<title>S C E E M S</title>

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
	<!-- Mini Modal -->
	<div class="modal fade modal-mini modal-primary" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style = "padding-top:350px;">
			<div class="modal-content" >
				<div class="alert alert-danger collapse" role="alert" id="alert_red"  >
					<div class="container">
						<center>
							<p id="alert_message"></p></center>

						</div>
					</div>
					<form id = "acc_reg_form" enctype="multipart/form-data">
						<div class="modal-body">
							<p>Please enter your Account number</p>
							<input type="number" style = "text-align:center; color:#fff" class="form-control input-lg" placeholder="Account Number" style = "color:#fff" name = "account_number" required><br>
						</div>
						<div class="modal-footer">

							<button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Close</button>

							<button type="submit" class="btn btn-link btn-neutral" >Register</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--  End Modal -->

		<!-- Warning Modal -->
		<div class="modal fade modal-mini modal-danger" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style=" background: rgba(0, 0, 0, 0.5);" aria-hidden="true">
			<div class="modal-dialog" style = "padding-top:350px;">
				<div class="modal-content">

					<div class="modal-body">
						<p id ="warning_message"></p>

					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Okay</button>
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
					<section class="col-xs-12"><center><a class="logo" href=""> S C E E M S</a></center></section>

				</section>
			</section>
		</header>

		<!-- ****************************** Banner ************************** -->


		<div class="wrappper">

			<section class="container" style =  "padding-top: 150px; padding-bottom:150px">
				<i class="ion-ios-download-outline"></i>

				<center><img src = "assets/img/logo.png" height = "120px" width = "100px"/>
					<h3 style = "color:#fff">LOGIN</h3>
					<form id = "login_form" enctype="multipart/form-data">
						<input type="text" class="form-control input-lg btn-block " placeholder="Username" name = "username" style = "color:#fff" required><br>
						<input type="password" class="form-control input-lg btn-block" placeholder="Password" name = "password" style = "color:#fff" required><br>
					</center>
					<center><button type="submit" class="btn btn-primary btn-round" >Login</button><br><br>
						<h6 style = "color:#fff">Not registered? <a style="color:#f96332" data-toggle="modal"  data-target="#myModal1">Create an account</a></h6></center>
						<a id ="warning_click" data-toggle="modal"  data-target="#alertModal" hidden>Trigger Warning</a>

					</form>
				</section>
			</section>

		</div>
		<!-- ****************************** Features Section ************************** -->




		<!-- All the scripts -->
		<script>
		$(document).ready(function(){
	$.ajaxSetup({ cache: false }); // or iPhones don't get fresh data
});

		function hideAlert() {
			$('#alert_red').hide();
		}
		$(document).ready(function(){

			$('#acc_reg_form').on('submit',(function(e) {
				e.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					type:'POST',
					url: "api/account_num_authentication.php",
					data:formData,
					cache:false,
					contentType: false,
					processData: false,
					success:function(data){
						if(data == 1){
							alert("You may Register!");
							window.location.href = "registration.php";
						} else if(data == 2){
							$("#alert_message").html("<strong>Oh no!</strong> You have already Registered. Thank you!");
							$("#alert_red").show();
						}else if(data == 3){
							$("#alert_message").html("<strong>Oh no!</strong> You have been blocked, please contact the service. Thank you!");
							$("#alert_red").show();
						}else if(data == 0){
							$("#alert_message").html("<strong>Oh snap!</strong> Invalid Registration number input.");
							$("#alert_red").show();
						}


					}
				});

				setInterval(hideAlert, 3000);
			}));


			$('#login_form').on('submit',(function(e) {
				e.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					type:'POST',
					url: "api/check_login.php",
					data:formData,
					cache:false,
					contentType: false,
					processData: false,
					success:function(data){
						if(data == 1){
							window.location.href = "homepage.php";
						} else if(data == 2){
							$("#warning_message").html("<strong>Oh no!</strong> You have been blocked, please contact the service. Thank you!");
							document.getElementById("warning_click").click();

						}else if(data == 0){
							$("#warning_message").html("<strong>Oh snap!</strong> Invalid Username/Password input.");
							document.getElementById("warning_click").click();

						}
					}
				});

				setInterval(hideAlert, 3000);
			}));

		});
		</script>

	</body>
	</html>
