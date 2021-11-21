
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
$sqlbudgetset = "SELECT * FROM budget_set WHERE account_id = $account_id AND month = '$month' AND year = '$year' ;";
$resultbudgetset = $conn ->query($sqlbudgetset);
$num_rows = mysqli_num_rows($resultbudgetset);
if($num_rows == 0 ){
echo "";
}
elseif($resultbudgetset -> num_rows > 0){
  while($row = $resultbudgetset->fetch_assoc()){
    $tblBudgetSet = $row['budget_set'];
    $tblBudgetConsumed = $row['budget_consumed'];
    $tblKillowatsConsumed = $row['kilowatts_consumed'];

	echo "<div class='container'>
    <div class='row'>
      <div class='card card-signup' style='background-color:#00649e;''>
           <center><h4 class='title title-up' style = 'color:#fff'>BUDGET LEFT</h4></center>
              <div id = 'card-body' class='card-body'>
                <center>
                <h3 style = 'color:white;'> ₱ ".round($tblBudgetConsumed,2)."</h3>
              </center>
              </div>

          </div>
        </div>

      </div>";
	}

}
?>
