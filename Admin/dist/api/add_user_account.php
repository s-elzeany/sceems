<?php
include "../../connection.php";
$account_id = $_POST['account_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$contact_number = $_POST['contact_number'];
$contact_number2 = $_POST['contact_number2'];
$status = $_POST['status'];
$account_type_name = $_POST['account_type_name'];

$sql = "SELECT account_type_id FROM account_type WHERE name = '$account_type_name';";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  $account_type_id = $row['account_type_id'];
}

$query="INSERT INTO user_account VALUES ($account_id,'$username','$password','$first_name','$middle_name','$last_name', $account_type_id ,'$address','$contact_number','$contact_number2','$status')";
$result=$conn->query($query);
?>
