<?php
session_start();
include "../connection.php";
$account_number = $_POST['account_number'];
$status = "New";

$sql = "SELECT * FROM user_account WHERE account_id = '$account_number';";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  while($row =$result -> fetch_assoc() ){
    $tblAccountNumber = $row['account_id'];
    $tblStatus = $row['status'];

    if(($tblAccountNumber !== $account_number) && ($tblStatus == "")){
      echo "0";
      break;
    }
    elseif(($tblAccountNumber == $account_number) && ($tblStatus == "New")){
      $_SESSION['account_number']=$account_number;
      $_SESSION['status']=$status;
      echo "1";
      break;
    } elseif(($tblAccountNumber == $account_number) && ($tblStatus == "Active")){
      echo "2";
      break;
    }elseif(($tblAccountNumber == $account_number) && ($tblStatus == "Deactive")){
      echo "3";
      break;
    }
  }
}


?>
