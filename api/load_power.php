
<?php
session_start(); //starts the session
if($_SESSION['account_number'] && $_SESSION['status']){
}
else{
	header("location:index.php");
}
$day = date("j");
$month = date("F");
$year = date("Y");
$account_id = $_SESSION['account_number'];
$username =   $_SESSION['username'];
$password = $_SESSION['password'];
$firstname = $_SESSION['first_name'];
$middlename = $_SESSION['middle_name'];
$lastname = $_SESSION['last_name'];
$Contactnumber = $_SESSION['contact_number'];
$address = $_SESSION['address'];
$account_type_id = $_SESSION['account_type_id'];
include '../connection.php';
$sql = "SELECT * FROM bill_cycle WHERE account_id = $account_id AND month = '$month' AND year = '$year' ;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  $tblPreviousMeter = $row['previous_meter_reading'];
  $tblPresentMeter = $row['present_meter_reading'];
  $totalConsumption = $tblPresentMeter - $tblPreviousMeter;

	echo "
	<section class='container' style =  'padding-top: 150px; padding-bottom:100px'>
		<i class='ion-ios-download-outline'></i>
		<center><img src = 'assets/img/logo.png' height = '120px' width = '100px' />

			<h3 style = 'color:#fff;  margin-bottom:15px; margin-top:30px;' >CHECK POWER</h3></center>
			<center>
					<span style= 'color:#fff;'> ".$month. " ". $day.", ". $year." </span><br><br>
				<p style = 'color:#fff'><b> PREVIOUS READING </b></P>
					<input type = 'text' class = 'form-control btn-block input-lg' value= '".round($tblPreviousMeter, 2)." kW/h' style='text-align:center; font-size:20; font-weight: bold;' disabled/><br>
					<p style = 'color:#fff'><b> PRESENT READING </b></P>
						<input type = 'text' class = 'form-control btn-block input-lg' value= '". round($tblPresentMeter, 2)." kW/h' style='text-align:center; font-size:20; font-weight: bold;'' disabled/><br>
						<p style = 'color:#fff'><b> CONSUMPTION IN kW/h </b></P>
							<input type = 'text' class = 'form-control btn-block input-lg' value= '".round($totalConsumption, 2), " kW/h' style='text-align:center; font-size:20; font-weight: bold;'' disabled/><br>

							<button type='submit' class='btn btn-primary btn-round btn-block' onclick='location.href = 'homepage.php';'>BACK</button></center>
						</section>
					</section>
			";
	}


?>
