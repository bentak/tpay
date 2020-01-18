
<?php




$externalid='uniqid ([ string $prefix = "" [, bool $more_entropy = FALSE ]] ) : string';

$xreference='uniqid ([ string $prefix = "" [, bool $more_entropy = FALSE ]] ) : string';


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay/",
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
  CURLOPT_POSTFIELDS => ' ',
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSMjU2In0.eyJjbGllbnRJZCI6IjgyZjI1ZGQ2LTNlMmMtNDdkNy1hMzFhLTgxOGQ2MzdiODcyNiIsImV4cGlyZXMiOiIyMDE5LTEyLTE3VDIwOjUxOjMyLjU1MSIsInNlc3Npb25JZCI6ImM0MWQxODMwLTQ0NzQtNDYwNi04YTBiLTBkNmRmZTIxNmIxMyJ9.biXP1u8dX2prS68ZZb8IxhdcTNzUc1iAbHjXiSNInVpgCT88siqLtZNWMlkK9smKSmzzl3eqQE4CBm52E6BW2n2Il1ayhmGUwonj1rYardafyimzmlmFPHpwV9afq5HA4T1UrB7mMw2tfBY-uUILGRzWZlM55BhjuDWwo0MM3c07f3Hu3INcKD49eRTeyXhCRFbzdFRsYAy39jTrxo6p88dZFITZTAI3TW3wknPhhmXa-oiKgmoqRlUEWHYYR_Ytolb9Cs56ij3bZC6U64Yu6mKKVNeTfIyk3LqgJIA0mBtwDMNNNIYj89HXgbrd8udd4QdQoSOuTKETyJudD4-pSw",
    "Ocp-Apim-Subscription-Key : 6b1783f3ebce460990f4e2c239d28b81", 
    "X-Reference-Id:6f3a4b32-0c2f-4e30-af03-4de12f76f2ff",
    "X-Target-Environment:sandbox",
    "X-Callback-Url :mkrom.com/callback.php",
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
}var_dump($response);





?>