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
$amount=$_POST["amount"];
date_default_timezone_set('Australia/Melbourne');
$time = date('m/d/Y h:i:s a', time());




// Api key select from db
$sql1="SELECT * FROM apikey  ";
$result=$conn->query($sql1);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	    
	    $apikey=$row["apikey"];
	    $uuid=$row["uuid"];
	    
	    $auth="$uuid:$apikey";
	    $base64=base64_encode($auth);
	    
	}
}

else{
    echo "failed";
}




function uuid()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function ref()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function trans()
{
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}


$ref=ref();

$trans=trans();

$xreference = uuid(); 
     

//Create Token


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sandbox.momodeveloper.mtn.com/collection/token/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
	CURLOPT_VERBOSE => true,
	CURLOPT_FRESH_CONNECT => true,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_SSL_VERIFYHOST => 0,
	CURLOPT_SSL_VERIFYPEER=> 0,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic $base64",
    "Ocp-Apim-Subscription-Key : 6b1783f3ebce460990f4e2c239d28b81", 
    "Cache-Control: no-cache",
    "X-Target-Environment:sandbox",
    "Content-Type: application/json"  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
}
//var_dump($response);
$result=json_decode($response);
$token=($result->access_token);

//var_dump($token);
//var_dump(http_response_code());









//Request to Pay 
//Request to Pay
//Request to Pay
//Request to Pay
//Request to Pay

if($token){
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
	CURLOPT_VERBOSE => true,
	CURLOPT_FRESH_CONNECT => true,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_SSL_VERIFYHOST => 0,
	CURLOPT_SSL_VERIFYPEER=> 0,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{
  'amount': '$amount',
  'currency': 'EUR',
  'externalId': '92019829389',
  'payer': {
    'partyIdType': 'MSISDN',
    'partyId': '$phone'
  },
  'payerMessage': 'Please enter your pin to confrim payment',
  'payeeNote': 'Thank you'
}",

  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $token",
    "X-Reference-Id: $ref",
    "Ocp-Apim-Subscription-Key : 6b1783f3ebce460990f4e2c239d28b81", 
    "Cache-Control: no-cache",
    "X-Target-Environment:sandbox",
    "Content-Type: application/json"  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

$result=json_decode($response);

//var_dump($response);

//var_dump(http_response_code($response));
//var_dump($response);

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//var_dump($httpcode);
curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
}
//var_dump($response);


}















    



//Check status of transaction


if($result==""){
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay/$ref",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
	CURLOPT_VERBOSE => true,
	CURLOPT_FRESH_CONNECT => true,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_SSL_VERIFYHOST => 0,
	CURLOPT_SSL_VERIFYPEER=> 0,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{
  'referenceId': '$ref'
      
  } ",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $token",
    "Ocp-Apim-Subscription-Key : 6b1783f3ebce460990f4e2c239d28b81", 
    "Cache-Control: no-cache",
    "referenceId:$ref",
    "X-Target-Environment:sandbox",
    "Content-Type: application/json"  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
}
//var_dump($response);
$result=json_decode($response);
$token=($result->access_token);

//var_dump($response);
$result=json_decode($response);
$res=($result->status);
//var_dump($res);

if($res==="SUCCESSFUL"){
    
   $sql1="SELECT * FROM passenger WHERE phone='".$phone."' ";
$result=$conn->query($sql1);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	    
	    $balance=$row["balance"];
	    $new_balance=$balance+$amount;
	    
	     $sql = "UPDATE passenger SET balance='".$new_balance."' WHERE phone='".$phone."' ";
 
if ($conn->query($sql)===TRUE) {
	
   $responsem["success"]="1";
			$responsem["message"]="Successfully loaded your account ";
			echo (json_encode($responsem));
}

else{
  $responsem["success"]="0";
  $responsem["message"]="Opps, Please try again";
			
			echo (json_encode($responsem));
}
	    
	}
}

else{
     $sql2 = " INSERT INTO passenger (phone,balance,time,status) VALUES ('".$phone."','".$amount."','".$time."',1)";
     
     
     if ($conn->query($sql2)===TRUE) {
	
   $responsem["success"]="1";
			$responsem["message"]="Successfully loaded your account ";
			echo (json_encode($responsem));
}

else{
  $responsem["success"]="0";
  $responsem["message"]="Opps, Please try again new";
			
			echo (json_encode($responsem));
}
}
}

else{
    
}
}





?>