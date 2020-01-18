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
$password=$_POST["pass"];


$sql="SELECT * FROM drivers WHERE phone='".$phone."' AND driver_id='".$password."' " ;

$result=$conn->query($sql);

if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	    $driver_id=$row["driver_id"];
	    
		if ($row["phone"]==$phone AND $row["status"]==1 ) {
		    $response["success"]="1";
			$response["message"]="Login success";
			$response["driver_id"]=$password;
			
			echo (json_encode($response));
		}
		
		elseif($row["phone"]==$pphone AND $row["status"]!=1  ){
		    $response["success"]="0";
			$response["message"]="User not activated";
			
			echo (json_encode($response));
		}
		
		else{
			$response["success"]="0";
			$response["message"]="User does not exist";
			
			echo (json_encode($response));
		}
	}
}

		

else{
	$response["success"]="0";
			$response["message"]="User does not exist";
			
			echo (json_encode($response));
}

?>