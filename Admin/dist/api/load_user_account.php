<?php
include "../../connection.php";
$sql = "SELECT UserAcc.account_id, UserAcc.username, UserAcc.password, UserAcc.first_name, UserAcc.middle_name, UserAcc.last_name, accType.name AS 'account_type_name', UserAcc.address, UserAcc.contact_number, UserAcc.contact_number2, UserAcc.status FROM user_account UserAcc
JOIN account_type accType ON UserAcc.account_type_id = accType.account_type_id;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  echo '<tr>
    <td>'.$row['account_id'].'</td>
    <td>'.$row['username'].'</td>
    <td>'.$row['password'].'</td>
    <td>'.$row['first_name'].'</td>
    <td>'.$row['middle_name'].'</td>
    <td>'.$row['last_name'].'</td>
    <td>'.$row['account_type_name'].'</td>
    <td>'.$row['address'].'</td>
    <td>'.$row['contact_number'].'</td>
    <td>'.$row['contact_number2'].'</td>
    <td>'.$row['status'].'</td>
    <td><ul class="action-nav" style="list-style-type: none;">

      <li><a href="#" data-toggle="modal" data-target="#update_User_Account_Modal'.$row['account_id'].'"><span class="fa fa-pencil" style="font-size:20px; list-style-type: none;" ></span></a></li>
      <li><a href="#" onclick= "deleteUserAccountData('.$row['account_id'].')"><span class="fa fa-remove" style="font-size:20px; list-style-type: none;"></span></a></li>
    </ul></td>
  </tr>';
}
?>
