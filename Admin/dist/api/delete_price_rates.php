<?php
include "../../connection.php";
$price_rates_id = $_GET['ID'];
$sql = "DELETE FROM price_rates WHERE  price_rates_id=$price_rates_id";
$result = $conn->query($sql);
?>
