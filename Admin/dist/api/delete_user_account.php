<?php
include "../../connection.php";
$acc_id = $_GET['ID'];
$sql = "DELETE FROM user_account WHERE  account_id=$acc_id";
$result = $conn->query($sql);
?>
