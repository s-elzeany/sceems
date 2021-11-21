<?php
include "../../connection.php";
$budget_set_id = $_POST['budget_set_id'];
$account_id = $_POST['account_id'];
$budget_set = $_POST['budget_set'];
$budget_consumed = $_POST['budget_consumed'];
$kilowatts_consumed = $_POST['kilowatts_consumed'];
$month = $_POST['month'];
$year = $_POST['year'];
$budget_set_status = $_POST['budget_set_status'];

$query="UPDATE `budget_set` SET `budget_set_id`=$budget_set_id,`account_id`=$account_id,`budget_set`=$budget_set,`budget_consumed`=$budget_consumed,`kilowatts_consumed`=$kilowatts_consumed,`month`='$month',`year`='$year',`budget_set_status`='$budget_set_status' WHERE budget_set_id= $budget_set_id;";

$result=$conn->query($query);
?>
