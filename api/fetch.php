<?php
session_start(); //starts the session
if($_SESSION['account_number'] && $_SESSION['status']){
}
else{
	header("location:index.php");
}
$account_id = $_SESSION['account_number'];
$username =   $_SESSION['username'];
$password = $_SESSION['password'];
$firstname = $_SESSION['first_name'];
$middlename = $_SESSION['middle_name'];
$lastname = $_SESSION['last_name'];
$Contactnumber = $_SESSION['contact_number'];
$address = $_SESSION['address'];
$account_type_id = $_SESSION['account_type_id'];
//fetch.php;
if(isset($_POST["view"]))
{
	include("../connection.php");
	if($_POST["view"] != '')
	{
		$update_query = "UPDATE notifications SET notification_status=1, notification_seen = 'hasSeen' WHERE notification_status=0";
		mysqli_query($conn, $update_query);
	}
	$query = "SELECT * FROM notifications WHERE account_id =$account_id ORDER BY notification_id DESC LIMIT 5";
	$result = mysqli_query($conn, $query);
	$output = '';

	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$output .= '
			<a href="#">
			<strong>'.$row["notification_subject"].'</strong><br />
			<small><em>'.$row["notification_text"].'</em></small>
			</a>

			';
		}
	}
	else
	{
		$output .= '<a href="#" class="text-bold text-italic">No Notification Found</a>';
	}

	$query_1 = "SELECT * FROM notifications WHERE account_id =$account_id AND notification_status=0";
	$result_1 = mysqli_query($conn, $query_1);
	$count = mysqli_num_rows($result_1);
	//$query_2 = "DELETE FROM notifications WHERE account_id =$account_id AND notification_status=1 AND notification_seen= 'hasSeen'";
	//$result_2 = mysqli_query($conn, $query_2);
	$data = array(
		'notification'   => $output,
		'unseen_notification' => $count
	);
	echo json_encode($data);
}
?>
