<?php
include "../../connection.php";
$account_id = $_POST['account_id'];
$status = $_POST['status'];
$cut = $_POST['cut'];

$query="UPDATE `power_switch` SET `Cut`='$cut' WHERE `account_id`=$account_id;";

$result=$conn->query($query);
?>
