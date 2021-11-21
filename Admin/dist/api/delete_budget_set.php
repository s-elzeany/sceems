<?php
include "../../connection.php";
$budget_set_id = $_GET['ID'];
$sql = "DELETE FROM budget_set WHERE  budget_set_id=$budget_set_id";
$result = $conn->query($sql);
?>
