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

$two_days_ago = date('Y-m-d', strtotime('-2 days'));
$today = date('m/d/Y');
$time = date(' h:i:s a', time());


$driver_id=$_POST["driver_id"];




$sql="SELECT amount FROM payment WHERE driver_id='".$driver_id."' AND date='".$today."'  " ;

$result=$conn->query($sql);
$rowcount=mysqli_num_rows($result);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	 
	 
	 
	     	$response["success"]="1";
			$response["message"]="Todays income is $rowcount GHs";
			
        
		}
		echo (json_encode($response));
	
	
}

		

else{
	$response["success"]="0";
			$response["message"]="0 Ghs";
			
			
			echo (json_encode($response));
}

?>