<?php
session_start();

$account_id = $_SESSION['account_number'];
include "../connection.php";
$switch_status = $_POST['switch_status'];

$sql = "SELECT * FROM power_switch WHERE account_id = $account_id;";

$result = $conn -> query($sql);
$num_rows = mysqli_num_rows($result);
 if($num_rows == 0){
  $query="INSERT INTO power_switch(`account_id`, `status`)
  VALUES ($account_id,'$switch_status');";
    $result=$conn->query($query);

}
elseif($result -> num_rows > 0){
  while($row =$result -> fetch_assoc() ){
    $tblAccountNumber = $row['account_id'];
    $tblCut = $row['Cut'];

    if($tblAccountNumber == $account_id && $tblCut == "Inactive"){
      $query="UPDATE power_switch SET status='$switch_status'
      WHERE account_id=$account_id;";

      $result=$conn->query($query);

    }elseif($tblAccountNumber == $account_id && $tblCut == "Active"){
    }

  }
}



?>
