<?php
include "../../connection.php";
$bill_cycle_id = $_POST['bill_cycle_id'];
$account_id = $_POST['account_id'];
$previous_meter_reading = $_POST['previous_meter_reading'];
$present_meter_reading = $_POST['present_meter_reading'];
$month = $_POST['month'];
$year = $_POST['year'];
$total_bill = $_POST['total_bill'];
$payment_status = $_POST['payment_status'];

$query="UPDATE `bill_cycle` SET `bill_cycle_id`=$bill_cycle_id,`account_id`=$account_id,`previous_meter_reading`=$previous_meter_reading,`present_meter_reading`=$present_meter_reading,`month`='$month',`year`='$year',`total_bill`=$total_bill,`payment_status`='$payment_status' WHERE bill_cycle_id= $bill_cycle_id;";

$result=$conn->query($query);
?>
