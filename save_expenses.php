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
echo "Connected successfully";

$driver_id=$_POST["driver_id"];
$expense_name=$_POST["expense_name"];
$expense_amount=$_POST["expense_amount"];
date_default_timezone_set('Australia/Melbourne');
$time = date('m/d/Y h:i:s a', time());

 $sql = "INSERT INTO expenses (driver_id,expense_name,expense_amount,time) VALUES ('".$driver_id."','".$expense_name."','".$expense_amount."','".$time."')";
 
if ($conn->query($sql)===TRUE) {
	
   $response["success"]="1";
			$response["message"]="Expense saved";
			echo (json_encode($response));
}

else{
  $response["success"]="0";
  $response["message"]="Expense not saved, Please try again";
			
			echo (json_encode($response));
}


// future addon: Allow users to book in advance by providing bus stop they are at  and pay also. 

?>