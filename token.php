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





// Api key select from db
$sql1="SELECT * FROM apikey  ";
$result=$conn->query($sql1);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
	    
	    $apikey=$row["apikey"];
	    $uuid=$row["uuid"];
	    $dapikey=$row["dapikey"];
	    $duuid=$row["duuid"];
	    
	    $auth="$uuid:$apikey";
	    $base64=base64_encode($auth);
	     $dauth="$duuid:$dapikey";
	    $dbase64=base64_encode($dauth);
	    
	}
}

else{
    echo "failed";
}





$phone=$_POST["phone"];
$amount=$_POST["amount"];
$driver_id=$_POST["driver_id"];
$seat=$_POST["seat"];
date_default_timezone_set('Australia/Melbourne');
$time = date('h:i:s a', time());
$date = date('m/d/Y');




// Driver phone number seect from db
$sqld="SELECT * FROM drivers WHERE driver_id='".$driver_id."' ";
$resultd=$conn->query($sqld);
if($resultd->num_rows>0){
	while($rowd=$result->fetch_assoc()){
	    
	    $dphone=$rowd["phone"];
	    
	    
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

var_dump(http_response_code($response));
//var_dump($response);

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
var_dump($httpcode);
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
var_dump($response);
$result=json_decode($response);
$token=($result->access_token);

//var_dump($response);
$result=json_decode($response);
$res=($result->status);
//var_dump($res);

if($res==="SUCCESSFUL"){
    $re[]["success"]="1";
  $re[]["message"]="Cograts, Payment is successful";
			
			echo (json_encode($re));
			
			$sql2 = " INSERT INTO payment (payer_number,driver_id,seat_number,amount,time,date,status) VALUES ('".$phone."','".$driver_id."','".$seat."','".$amount."','".$time."','".$date."',1)";
     
     
     if ($conn->query($sql2)===TRUE) {
	
   $response["success"]="1";
			$response["message"]="Successfully loaded your account ";
		//	echo (json_encode($response));
}

else{
  $response["success"]="0";
  $response["message"]="Opps, Please try again new";
			
		//	echo (json_encode($response));
}


//disbursement token
//disbursement token
//disbursement token

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sandbox.momodeveloper.mtn.com/disbursement/token/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 50,
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
    "Authorization: Basic $dbase64",
    "Ocp-Apim-Subscription-Key : 57323f678e7c4de1a5b976335e112358", 
    "Cache-Control: no-cache",
    "X-Target-Environment:sandbox",
    "Content-Type: application/json"  ),
));

$tresponse = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
}
//var_dump($response);
$tresult=json_decode($tresponse);
$ttoken=($tresult->access_token);

//var_dump($tresult);




//Disbursement transfer for driver
//Disbursement transfer for driver//Disbursement transfer for driver//Disbursement transfer for driver//Disbursement transfer for driver//Disbursement transfer for driver
if($ttoken){
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sandbox.momodeveloper.mtn.com/disbursement/v1_0/transfer",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 50,
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
  'externalId': '412583bc-5459-4589-b1cf-c23d5ea197ef',
  'payer': {
    'partyIdType': 'MSISDN',
    'partyId': '$dphone'
  },
  'payerMessage': 'Passenger On Seat  has paid ',
  'payeeNote': 'Passenger On Seat No  has paid'
}",

  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $ttoken",
    "X-Reference-Id: 43ce2405-b6e5-42a0-94ec-e9f06ebc0cae",
    "Ocp-Apim-Subscription-Key : 57323f678e7c4de1a5b976335e112358", 
    "Cache-Control: no-cache",
    "X-Target-Environment:sandbox",
    "Content-Type: application/json"  ),
));

$dresponse = curl_exec($curl);
$err = curl_error($curl);

$dresult=json_decode($dresponse);

var_dump($dresponse);


curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
}
//var_dump($dresponse);


}



//Checking status of disbursement     //Checking status of disbursement//Checking status of disbursement         //Checking status of disbursement
if($dresponse==""){
    
    
    
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sandbox.momodeveloper.mtn.com/disbursement/v1_0/transfer/$ref
",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 50,
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
    "Authorization: Bearer $ttoken",
    "Ocp-Apim-Subscription-Key : 57323f678e7c4de1a5b976335e112358", 
    "Cache-Control: no-cache",
    "referenceId:$ref",
    "X-Target-Environment:sandbox",
    "Content-Type: application/json"  ),
));

$dtresponse = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
//   echo $response;
}
//var_dump($response);
$dtresult=json_decode($dtresponse);
$dtres=($dtresult->status);
var_dump($dtresponse);

if($dtres="Payment successful"){
    	$response[]["success"]="1";
			$response[]["message"]="Payment successful";
			
			echo (json_encode($response));
}
}


}


else{
    "Payment wasnt successful";
}



}

var_dump($dbase64);

//var_dump($ref);

?>