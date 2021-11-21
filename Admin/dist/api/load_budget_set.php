<?php
include "../../connection.php";
$sql = "SELECT * FROM budget_set;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  echo '<tr>
    <td>'.$row['budget_set_id'].'</td>
    <td>'.$row['account_id'].'</td>
    <td>'.$row['budget_set'].'</td>
    <td>'.$row['budget_consumed'].'</td>
    <td>'.$row['kilowatts_consumed'].'</td>
    <td>'.$row['month'].'</td>
    <td>'.$row['year'].'</td>
    <td>'.$row['budget_set_status'].'</td>
    <td><ul class="action-nav" style="list-style-type: none;">
      <li><a href="#" data-toggle="modal" data-target="#update_Budget_Set_Modal'.$row['budget_set_id'].'"><span class="fa fa-pencil" style="font-size:20px; list-style-type: none;" ></span></a></li>
      <li><a href="#" onclick= "deleteBudgetSetData('.$row['budget_set_id'].')"><span class="fa fa-remove" style="font-size:20px; list-style-type: none;"></span></a></li>
    </ul></td>
  </tr>';
}
?>
