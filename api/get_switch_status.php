<?php
$accnum=$_POST['account_id'];
$accstatus=$_POST['status'];
include "../connection.php";
$sql = "SELECT * FROM user_account WHERE account_id = $accnum AND status = '$accstatus' ";
$result = $conn -> query($sql);
while($row = $result->fetch_assoc()) {
  $tblStatus = $row['status'];
  $tblAccountNumber = $row['account_id'];
  if(($tblAccountNumber == $accnum) && ($tblStatus == $accstatus)){
    $sqlswitch = "SELECT * FROM power_switch WHERE account_id = $accnum;";
    $resultswitch = $conn -> query($sqlswitch);
    while($row =$resultswitch -> fetch_assoc() ){
      $tblSwitchStatus = $row['status'];
      echo "*POWER:$tblSwitchStatus";
  }
}
}
?>
