<?php
include "../../connection.php";
$sql = "SELECT * FROM bill_cycle;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  echo '<tr>
    <td>'.$row['bill_cycle_id'].'</td>
    <td>'.$row['account_id'].'</td>
    <td>'.$row['previous_meter_reading'].'</td>
    <td>'.$row['present_meter_reading'].'</td>
    <td>'.$row['month'].'</td>
    <td>'.$row['year'].'</td>
    <td>'.$row['total_bill'].'</td>
    <td>'.$row['payment_status'].'</td>
    <td><ul class="action-nav" style="list-style-type: none;">

      <li><a href="#" data-toggle="modal" data-target="#update_Bill_Cycle_Modal'.$row['bill_cycle_id'].'"><span class="fa fa-pencil" style="font-size:20px; list-style-type: none;" ></span></a></li>
      <li><a href="#" onclick= "deleteBillCycleData('.$row['bill_cycle_id'].')"><span class="fa fa-remove" style="font-size:20px; list-style-type: none;"></span></a></li>
    </ul></td>
  </tr>';
}
?>
