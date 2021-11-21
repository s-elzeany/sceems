<?php
include "../../connection.php";
$sql = "SELECT * FROM power_switch;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  echo '<tr>
    <td>'.$row['account_id'].'</td>
    <td>'.$row['status'].'</td>
    <td>'.$row['Cut'].'</td>
    <td><ul class="action-nav" style="list-style-type: none;">
      <li><a href="#" data-toggle="modal" data-target="#update_Power_Switch_Modal'.$row['account_id'].'"><span class="fa fa-pencil" style="font-size:20px; list-style-type: none;" ></span></a></li>
      <li><a href="#" onclick= "deletePowerSwitchData('.$row['account_id'].')"><span class="fa fa-remove" style="font-size:20px; list-style-type: none;"></span></a></li>
    </ul></td>
  </tr>';
}
?>
