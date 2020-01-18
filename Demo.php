<?php

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
    $messageResponse = $messagingApi->sendQuickMessage("Tpay", "+233554836546", "Thank you for reistering, Your Tpay driver Id is 101928. Passenegers will pay for fares with ths Id and also thats your password. ");

    if ($messageResponse instanceof MessageResponse) {
        echo $messageResponse->getStatus();  
    } elseif ($messageResponse instanceof HttpResponse) {
        echo "\nServer Response Status : " . $messageResponse->getStatus();
    }
} catch (Exception $ex) {
    echo $ex->getTraceAsString();
}
