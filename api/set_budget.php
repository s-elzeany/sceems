<?php
session_start();

$account_id = $_SESSION['account_number'];
$account_type_id = $_SESSION['account_type_id'];
include "../connection.php";
$set_budget = $_POST['set_budget'];
$month = $_POST['month'];
$year = $_POST['year'];

$sql = "SELECT * FROM budget_set WHERE account_id = $account_id AND month = '$month' AND year = '$year';";

$result = $conn -> query($sql);
$num_rows = mysqli_num_rows($result);
 if($num_rows == 0){
   $query="INSERT INTO budget_set(`account_id`, `budget_set`,  `budget_consumed`,`month`, `year`, `budget_set_status`)
   VALUES ($account_id,$set_budget,$set_budget,'$month','$year', 'Active');";
   $result=$conn->query($query);
 }
elseif($result -> num_rows > 0){
  while($row =$result -> fetch_assoc() ){
    $tblAccountNumber = $row['account_id'];
    $tblMonthSet = $row['month'];
    $tblYearSet = $row['year'];

    if(($tblAccountNumber == $account_id) && ($tblMonthSet == $month) && ($tblYearSet == $year)){
      $query="UPDATE budget_set SET budget_set=$set_budget, budget_consumed =$set_budget, kilowatts_consumed = 0, budget_set_status = 'Active' WHERE account_id=$account_id;";

      $result=$conn->query($query);
    }
  }
}




?>
