<?php
session_start();
$account_id = $_SESSION['account_number'];
include "../connection.php";
$username = $_POST['username'];
$prev_pass = $_POST['prev_pass'];
$new_pass = $_POST['new_pass'];

$query="UPDATE user_account SET  username='$username', password='$new_pass'
WHERE account_id=$account_id;";

$result=$conn->query($query);





?>
