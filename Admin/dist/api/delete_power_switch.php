<?php
include "../../connection.php";
$account_id = $_GET['ID'];
$sql = "DELETE FROM power_switch WHERE  account_id=$account_id";
$result = $conn->query($sql);
?>
