<?php
include "../../connection.php";
$rate_name = $_POST['rate_name'];
$rate = $_POST['rate'];
$account_type_name = $_POST['account_type_name'];
$rate_status = "new";
$rate_date = date('Y-m-d');

$sql = "SELECT account_type_id FROM account_type WHERE name = '$account_type_name';";
$result = $conn ->query($sql);
while($row = $result->fetch_assoc()){
  $account_type_id = $row['account_type_id'];
}

$sqlchecker = "SELECT * FROM price_rates WHERE rate_name = '$rate_name' AND rate_date < '$rate_date' AND account_type_id=$account_type_id;";
$resultchecker = $conn ->query($sqlchecker);
if($resultchecker -> num_rows > 0){
  while($row = $resultchecker->fetch_assoc()){
  $queryUpdate="UPDATE `price_rates` SET `rate_status`= 'old' WHERE rate_name = '$rate_name' AND rate_date < '$rate_date' AND account_type_id=$account_type_id;";
  $resultUpdate=$conn->query($queryUpdate);
}

$query="INSERT INTO price_rates VALUES ('',$account_type_id,'$rate_name','$rate','$rate_date', 'new')";
$result=$conn->query($query);

}else {
  $query="INSERT INTO price_rates VALUES ('',$account_type_id,'$rate_name','$rate','$rate_date', 'new')";
  $result=$conn->query($query);
}

?>
