<?php
$accnum=$_POST['account_id'];
$accstatus=$_POST['status'];
include "../connection.php";
$sql = "SELECT * FROM user_account WHERE account_id = $accnum AND status = '$accstatus' ";
$result = $conn -> query($sql);
while($row = $result->fetch_assoc()) {
  $tblUsername = $row['username'];
echo "$tblUsername";
}
?>
