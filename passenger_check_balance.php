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
date_default_timezone_set('Australia/Melbourne');
$time = date('m/d/Y h:i:s a', time());


$sql="SELECT * FROM passenger WHERE phone='".$phone."'";
$result=$conn->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	    $balance=$row["balance"];
	    
	     $response["success"]="1";
         $response["message"]="$balance ";
			
			echo (json_encode($response));
	}
}

else{
   $response["success"]="0";
         $response["message"]="Wrong details";
			
			echo (json_encode($response));   
}
	    







?>