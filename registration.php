<?php session_start(); //starts the session
if($_SESSION['account_number'] && $_SESSION['status']){ //checks if user is logged in
}
else{
	header("location:index.php"); // redirects if user is not logged in
}
$account_id = $_SESSION['account_number']; //assigns user value
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<title>S C E E M S - Registration</title>

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

					<button type="button" class="btn btn-link btn-neutral" data-dismiss="modal" id="a" >Okay</button>
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
				<h3 style = "color:#fff">REGISTRATION</h3>
				<form id = "register_form" enctype="multipart/form-data">
					<input type="text" class="form-control input-lg btn-block" placeholder="Username" name = "username"  id ="username" style = "color:#fff" required><br>
					<input type="password" class="form-control input-lg btn-block" placeholder="Password" name = "password" id = "password" style = "color:#fff" required><br>
					<span id="confirmpassword_error_message" style="color:#d62121; display:none;" >Passwords doesn't match</span>
					<input type="password" class="form-control input-lg btn-block" placeholder="Confirm Password" name = "confirm_password"  id = "confirm_password" style = "color:#fff" required><br>
					<input type="number" class="form-control input-lg btn-block" placeholder="Contact Number" name = "contact_number"  id = "contact_number" style = "color:#fff" required><br>
					<input type="number" class="form-control input-lg btn-block" placeholder="Contact Number 2" name = "contact_number2"  id = "contact_number2" style = "color:#fff" required>
					<input type="text" class="form-control input-lg" name = "status" id="status"  value = "Active" hidden>
					<input type="text" class="form-control input-lg" name = "account_number" id="account_number" value = "<?php echo $account_id?>" hidden><br><br>
					<button type = "button" class="btn btn-primary btn-round" id = "btn_register">Register</button>
					<button type="button" class="btn btn-primary btn-round " onclick="location.href = 'index.php';">BACK</button></center>
					<a id ="warning_click" data-toggle="modal"  data-target="#alertModal" hidden>Trigger Warning</a>

				</form>
			</section>
		</section>

	</div>
	<!-- ****************************** Features Section ************************** -->

	<script>
	$(document).ready(function(){
	$.ajaxSetup({ cache: false }); // or iPhones don't get fresh data
});
	$(document).ready(function(){
		$("#confirm_password").blur(function(){
			if($(this).val()!=$("#password").val()){
				$("#confirmpassword_error_message").show();
				$("#password").css('box-shadow','0px 0 px 10px #67c3e5');
				$("#confirm_password").css('box-shadow','0px 0px 10px 1px #67c3e5');
			}else{
				$("#confirm_password").css('box-shadow', '');
				$("#confirmpassword_error_message").hide();
			}

		});
		$("#btn_register").click(function(){
			if($("#confirmpassword_error_message").is(":visible") ){
				$("#warning_message").html("Please fill up the forms correctly!");
				document.getElementById("warning_click").click();
			}
			else{
				registerData();
			}

		});
	});
	function registerData(){

		var username=$('#username').val();
		var password =$('#password').val();
		var confirm_password =$('#confirm_password').val();
		var contact_number =$('#contact_number').val();
		var contact_number2 =$('#contact_number2').val();
		var status =$('#status').val();
		var account_number =$('#account_number').val();
		$.ajax({
			type:"POST",
			url:"api/register_account.php",
			data:"username="+username +"&password="+ password+"&confirm_password="+ confirm_password+"&contact_number="+ contact_number+"&contact_number2="+ contact_number2+"&status="+ status+"&account_number="+ account_number,
			success: function(data){
				$("#warning_message").html("You have successfully Registered!");
				document.getElementById("a").onclick = function () {
					location.href = "index.php";
				};
				document.getElementById("warning_click").click();
				$("#alertModalContent").css('background-color','#00bb39');
			}

		});
	}

	</script>

</body>
</html>
