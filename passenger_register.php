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
$phone=$_POST["phone"];
$password=$_POST["password"];
date_default_timezone_set('Australia/Melbourne');
$time = date('m/d/Y h:i:s a', time());


$sql="SELECT phone FROM passenger WHERE phone='".$phone."' ";

$result=$conn->query($sql);

if($result->num_rows>0){
	
   $response["success"]="0";
			$response["message"]="User already exist";
			echo (json_encode($response));
	}


else{
    
  $sql = "INSERT INTO passenger (phone,pin,time,status) VALUES ('".$phone."','".$password."','".$time."',1)";
	 
	 

if ($conn->query($sql)===TRUE) {
		    
		    $response=array();
            $response["success"]=True;
			$response["message"]="User created";
			echo (json_encode($response));
}

else{
  $response["success"]="0";
			$response["message"]="User not created";
			
			echo (json_encode($response));
}


}

mysqli_close($conn);
?>