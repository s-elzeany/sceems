<?php
include "../../connection.php";
$sql = "SELECT PR.price_rates_id, PR.rate_name, PR.rate, PR.rate_date, PR.rate_status, AcT.name AS 'account_type_name' FROM price_rates PR JOIN account_type AcT ON PR.account_type_id = AcT.account_type_id;";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  echo '<tr>
    <td>'.$row['price_rates_id'].'</td>
    <td>'.$row['account_type_name'].'</td>
    <td>'.$row['rate_name'].'</td>
    <td>'.$row['rate'].'</td>
    <td>'.$row['rate_date'].'</td>
    <td>'.$row['rate_status'].'</td>
    <td><ul class="action-nav" style="list-style-type: none;">

      <li><a href="#" onclick= "deletePriceRatesData('.$row['price_rates_id'].')"><span class="fa fa-remove" style="font-size:20px; list-style-type: none;"></span></a></li>
    </ul></td>
  </tr>';
}
?>
