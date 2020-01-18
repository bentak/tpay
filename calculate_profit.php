<?php


$servername = "localhost";
$username = "mkromcom_bkat";
$dbname="mkromcom_tpay";
$password = "Bentak1011";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";

$driver_id=$_POST["driver_id"];
$expense_name=$_POST["expense_name"];
$expense_amount=$_POST["expense_amount"];
date_default_timezone_set('Australia/Melbourne');
$time = date('m/d/Y h:i:s a', time());





?>