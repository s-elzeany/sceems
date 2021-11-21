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

$query="INSERT INTO bill_cycle VALUES ($bill_cycle_id,$account_id,$previous_meter_reading,$present_meter_reading,'','$month','$year', $total_bill,'$payment_status')";
$result=$conn->query($query);
?>
