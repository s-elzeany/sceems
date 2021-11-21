<?php
include "../../connection.php";
$bill_cycle_id = $_GET['ID'];
$sql = "DELETE FROM bill_cycle WHERE  bill_cycle_id=$bill_cycle_id";
$result = $conn->query($sql);
?>
