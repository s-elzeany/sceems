<?php
$accnum=$_POST['account_id'];
$day = date("j");
$month = date("F");
$year = date("Y");
$prevmonth = date('F', strtotime('-1 month'));
$prevyear = date("Y",strtotime("-1 year"));
include "../connection.php";


$sql = "SELECT * FROM notifications_sms WHERE account_id = $accnum AND notification_sms_status ='0';";
$result = $conn -> query($sql);
$num_rows = mysqli_num_rows($result);
if($num_rows == 0){

}elseif($num_rows >= 1){
while($row =$result -> fetch_assoc()){
  $tblText = $row['notification_sms_text'];
  $tblStatus = $row['notification_sms_status'];

}
  $sqlacc = "SELECT * FROM user_account WHERE account_id = $accnum;";
  $resultacc = $conn -> query($sqlacc);
  while($row =$resultacc -> fetch_assoc()){
    $tblContactnumber = $row['contact_number'];
    $tblContactnumber2 = $row['contact_number2'];
  }

  echo "*NUMBER:+63$tblContactnumber;NUMBER2:+63$tblContactnumber2;TEXT:$tblText";
}


$sqlupdate = "UPDATE notifications_sms SET notification_sms_status ='1' WHERE account_id = $accnum AND notification_sms_status ='0' ;";
$resultupdate = $conn -> query($sqlupdate);



?>
