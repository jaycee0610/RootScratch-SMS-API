<?php 

include_once "function.php";

try {
    // Send a USSD request using default SIM of Device ID 1.
    $ussdRequest = sendUssdRequest("*150#", 1);
    print_r($ussdRequest);
    
    // Send a USSD request using SIM in slot 1 of Device ID 1.
    $ussdRequest = sendUssdRequest("*150#", 1, 0);
    print_r($ussdRequest);
    
    // Send a USSD request using SIM in slot 2 of Device ID 1.
    $ussdRequest = sendUssdRequest("*150#", 1, 1);
    print_r($ussdRequest);
} catch (Exception $e) {
    echo $e->getMessage();
}