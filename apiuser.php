<?php

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



$xreference = uuid(); 
     

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sandbox.momodeveloper.mtn.com/v1_0/apiuser",
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
  CURLOPT_POSTFIELDS => '{
  "providerCallbackHost": "mkrom.com/tpay/callback.php"
}',
  CURLOPT_HTTPHEADER => array(
    "X-Reference-Id:$xreference ",
    "Ocp-Apim-Subscription-Key : 6b1783f3ebce460990f4e2c239d28b81", 
    "Cache-Control: no-cache",
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



$result=json_decode($response);
//var_dump($data=json_encode(['data']['ResponseCode']));
$data=($result->Code);
var_dump($response);







echo $xreference;

?>