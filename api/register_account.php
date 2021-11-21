<?php
session_start();

$account_id = $_SESSION['account_number'];
include "../connection.php";
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$contact_number = $_POST['contact_number'];
$contact_number2 = $_POST['contact_number2'];
$status =  $_POST['status'];


$query="UPDATE user_account SET  username='$username',
password='$password', contact_number=$contact_number,contact_number2=$contact_number2, status='$status'
WHERE account_id=$account_id;";

$result=$conn->query($query);

$query="INSERT INTO `power_switch`(`account_id`, `status`, `Cut`) VALUES ($account_id,'ON','Deactive')";

$result=$conn->query($query);

/**$sql = "SELECT * FROM user_account WHERE account_id = '$account_number';";

$result = $conn -> query($sql);
if($result -> num_rows > 0){
  while($row =$result -> fetch_assoc() ){
    $tblAccountNumber = $row['account_id'];
    $tblStatus = $row['status'];
    $tblUsername = $row['username'];
    $tblFullname= $row['full_name'];
    $tblContactnumber = $row['contact_number'];
    $tblAddress = $row['address'];
}
}
$_SESSION['account_number']=$tblAccountNumber;
$_SESSION['status']=$tblStatus;
$_SESSION['username']=$tblUsername;
$_SESSION['full_name']=$tblFullname;
$_SESSION['contact_number']=$tblContactnumber;
$_SESSION['address']=$tblAddress;**/

?>
