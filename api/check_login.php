<?php
session_start();
include "../connection.php";
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user_account WHERE username = '$username';";

$result = $conn -> query($sql);

if($result -> num_rows > 0){
  while($row =$result -> fetch_assoc() ){
    $tblUsername = $row['username'];
    $tblPassword = $row['password'];
    $tblStatus = $row['status'];
    $tblFirstname = $row['first_name'];
    $tblMiddlename = $row['middle_name'];
    $tblLastname = $row['last_name'];
    $tblAccountNumber = $row['account_id'];
    $tblContactnumber = $row['contact_number'];
    $tblContactnumber2 = $row['contact_number2'];
    $tblAddress = $row['address'];
    $tblAccountTypeID = $row['account_type_id'];

    if(($tblUsername !== $username) && ($tblPassword !== $password) && ($tblStatus == "")){

      echo "0";
      break;
    }
    elseif(($tblUsername == $username) && ($tblPassword == $password) && ($tblStatus == "Active")){
      $_SESSION['account_number']=$tblAccountNumber;
      $_SESSION['username']=$tblUsername;
      $_SESSION['status']=$tblStatus;
      $_SESSION['first_name']=$tblFirstname;
      $_SESSION['middle_name']=$tblMiddlename;
      $_SESSION['last_name']=$tblLastname;
      $_SESSION['contact_number']=$tblContactnumber;
      $_SESSION['contact_number2']=$tblContactnumber2;
      $_SESSION['address']=$tblAddress;
      $_SESSION['password'] = $tblPassword;
      $_SESSION['account_type_id'] = $tblAccountTypeID;
      echo "1";
      break;
    }
    elseif(($tblUsername == $username) && ($tblPassword == $password) && ($tblStatus == "Inactive")){
      echo "2";
      break;
    }



  }
}


?>
