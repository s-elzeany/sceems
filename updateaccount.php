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
	<title>S C E E M S - Update Account</title>

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
			<center><img src = "assets/img/logo.png" height = "120px" width = "100px"/>
				<h3 style = "color:#fff">UPDATE ACCOUNT</h3></center>

				<form id = "update_account_form" name ="update_account_form" enctype="multipart/form-data">
					<center>

						<p style = "color:#fff"><b> USERNAME </b></P>
							<input type = "text" class = "form-control btn-block input-lg"  style="text-align:center; font-size:30; color:#fff;" value="<?php echo $username ?>"  placeholder= "NEW USERNAME" id ="username" name ="username"/><br>
							<span id="prev_pass_error_message" style="color:#d62121; display:none;" >Incorrect Previous Password</span>
							<p style = "color:#fff"><b> PREVIOUS PASSWORD </b></P>
								<input type = "password" class = "form-control btn-block input-lg"  id ="prev_pass_orig" name="prev_pass_orig" value = "<?php echo $password ?>"hidden/><br>
								<input type = "password" class = "form-control btn-block input-lg"  style="text-align:center; font-size:30; color:#fff;" placeholder= "PREVIOUS PASSWORD" id ="prev_pass" name="prev_pass" required/><br>
								<p style = "color:#fff"><b> NEW PASSWORD </b></P>
									<input type = "password" class = "form-control btn-block input-lg"  style="text-align:center; font-size:30; color:#fff;"  placeholder= "NEW PASSWORD" id = "new_pass" name= "new_pass" required/><br>
									<span id="confirmpassword_error_message" style="color:#d62121; display:none;" >Passwords doesn't match</span>
									<p style = "color:#fff"><b> RE-ENTER NEW PASSWORD </b></P>
										<input type = "password" class = "form-control btn-block input-lg"  style="text-align:center; font-size:30; color:#fff;"  placeholder= "RE-ENTER NEW PASSWORD" id ="re_enter_pass" name="re_enter_pass" required/><br>


										<button type="button" class="btn btn-primary btn-round " id="btn_update">CONFIRM</button>
										<button type="button" class="btn btn-primary btn-round " onclick="location.href = 'account.php';">BACK</button></center>
									</form>
									<a id ="warning_click" data-toggle="modal"  data-target="#alertModal" hidden>Trigger Warning</a>
								</section>

							</div>

							<script>
							$(document).ready(function(){
								$.ajaxSetup({ cache: false }); // or iPhones don't get fresh data
							});
							$(document).ready(function(){
								$("#re_enter_pass").blur(function(){
									if($(this).val()!=$("#new_pass").val()){
										$("#confirmpassword_error_message").show();
										$("#new_pass").css('box-shadow','0px 0 px 10px #67c3e5');
										$("#re_enter_pass").css('box-shadow','0px 0px 10px 1px #67c3e5');
									}else{
										$("#re_enter_pass").css('box-shadow', '');
										$("#confirmpassword_error_message").hide();
									}

								});

								$("#prev_pass").blur(function(){
									if($(this).val()!=$("#prev_pass_orig").val()){
										$("#prev_pass_error_message").show();
										$("#prev_pass").css('box-shadow','0px 0 px 10px #67c3e5');
									}else{
										$("#prev_pass").css('box-shadow', '');
										$("#prev_pass_error_message").hide();
									}

								});

								$("#btn_update").click(function(){
									if($("#confirmpassword_error_message").is(":visible") || $("#prev_pass_error_message").is(":visible") ){
										$("#warning_message").html("Please fill up the forms correctly!");
										document.getElementById("warning_click").click();
									}
									else{
										updateData();
									}

								});
							});

							function updateData(){
									var username=$('#username').val();
									var prev_pass =$('#prev_pass').val();
									var new_pass =$('#new_pass').val();
									var re_enter_pass =$('#re_enter_pass').val();
									$.ajax({
										type:"POST",
										url:"api/update_account_details.php",
										data:"username="+username +"&prev_pass="+ prev_pass+"&new_pass="+ new_pass+"&re_enter_pass="+ re_enter_pass,
										success: function(data){
											$("#warning_message").html("You have successfully Updated!");
											document.getElementById("warning_click").click();
											$("#alertModalContent").css('background-color','#00bb39');
											document.getElementById("a").onclick = function () {
											 location.href = "homepage.php";
									 };
										}

									});

							}

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
