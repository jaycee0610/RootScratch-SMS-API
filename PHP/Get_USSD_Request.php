<?php

include "function.php";


try {
    // Get a USSD request using the ID.
    $ussdRequest = getUssdRequestByID(1);
    print_r($ussdRequest);

    // Get USSD requests with request text "*150#" sent in last 24 hours.
    $ussdRequests = getUssdRequests("*150#", null, null, time() - 86400);
    print_r($ussdRequests);
} catch (Exception $e) {
    echo $e->getMessage();
}