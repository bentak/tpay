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
$sql="SELECT id,payer_number,seat_number,amount,time FROM payment WHERE driver_id='".$driver_id."' ";
$result=$conn->query($sql);
$data=array();
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
            
             
             $data[]=$row;
             
        
    }
    
    echo (json_encode($data));
}

else{
     $response["success"]="0";
			$response["message"]="No payment yet";
			
			
			echo (json_encode($response));
}





?>