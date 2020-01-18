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
$pphone=$_POST["phone"];
$amount=$_POST["amount"];
$seat_number=$_POST["seat"];

date_default_timezone_set('Australia/Melbourne');
$time = date('m/d/Y h:i:s a', time());


//first select driver details and if exist proceed

$s="SELECT * FROM drivers WHERE driver_id='".$driver_id."' AND status=1 ";
$r=$conn->query($s);
if($r->num_rows>0){
	while($ro=$r->fetch_assoc()){
	    
	    //phone number for driver, will be used to make payment to driver 
	    $dphone=$ro["phone"];

$sql="SELECT * FROM passenger WHERE phone='".$pphone."' AND status=1 ";
$result=$conn->query($sql);

if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	    
	    $balance=$row["balance"];
	    if($balance >= $amount ){
	        
	        
	        
			$new_balance=$balance-$amount;
			
			$sql2="INSERT INTO payment(payer_number,driver_id,seat_number,amount,time,status) VALUES('".$pphone."', '".$driver_id."','".$seat_number."','".$amount."','".$time."',1)  ";
			if ($conn->query($sql2)===TRUE) {
	
  
}

else{
  $response["success"]="0";
  $response["message"]="";
			
			echo (json_encode($response));
}
			
			
			$sql3 = "UPDATE passenger SET balance='".$new_balance."' WHERE phone='".$pphone."' ";
				if ($conn->query($sql3)===TRUE) {
	
   
}

else{
  $response["success"]="0";
  $response["message"]="";
			
			echo (json_encode($response));
}
			
			$response["success"]="1";
			$response["message"]="Paid";
			echo (json_encode($response));
	    }
	    
	    else{
	        $response["success"]="0";
			$response["message"]="You dont have enough balance";
			echo (json_encode($response));
	    }
	}
}

		

else{
	$response["success"]="0";
			$response["message"]="User does not exist";
			
			echo (json_encode($response));
}




}}

else{
    	$response["success"]="0";
			$response["message"]="driver does not exist, Please enter driver id again";
			
			echo (json_encode($response));
}


?>