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
$username=$_POST["name"];
$phone=$_POST["phone"];
$var = ltrim($phone, '0');
$driver_id = rand(100000, 999999);
date_default_timezone_set('Australia/Melbourne');
$time = date('m/d/Y h:i:s a', time());


$sql="SELECT phone FROM drivers WHERE phone='".$phone."' ";

$result=$conn->query($sql);

if($result->num_rows>0){
	
   $response["success"]="0";
			$response["message"]="User already exist";
			echo (json_encode($response));
	}


else{
    
  $sql = "INSERT INTO drivers (username,phone,driver_id,time,status) VALUES ('".$username."','".$phone."','".$driver_id."','".$time."',1)";
	 
	 

if ($conn->query($sql)===TRUE) {
		    // Let us test the SDK
require 'vendor/autoload.php';


$auth = new BasicAuth("xfcslrqq", "jyqtkbry");

// instance of ApiHost
$apiHost = new ApiHost($auth);

// instance of AccountApi
$accountApi = new AccountApi($apiHost);

// set web console logging to false
$disableConsoleLogging = false;

// Let us try to send some message
$messagingApi = new MessagingApi($apiHost, $disableConsoleLogging);
try {
    // Send a quick message
    $messageResponse = $messagingApi->sendQuickMessage("Tpay", "+233$var", "Thank you for reistering, Your Tpay driver Id is $driver_id Passenegers will pay for fares with this Id and also thats your password. ");

    if ($messageResponse instanceof MessageResponse) {
        echo $messageResponse->getStatus();  
    } elseif ($messageResponse instanceof HttpResponse) {
        echo "\nServer Response Status : " . $messageResponse->getStatus();
    }
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}
		    
            $response["success"]=True;
			$response["message"]="User created";
			$response["driver_id"]=$driver_id;
			echo (json_encode($response));
			echo $var;
			
			
}

else{
  $response["success"]="0";
			$response["message"]="User not created";
			
			echo (json_encode($response));
}


}

mysqli_close($conn);
?>