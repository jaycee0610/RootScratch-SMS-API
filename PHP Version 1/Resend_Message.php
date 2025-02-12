<?php

include_once "function.php";

try {
    // Resend a message using the ID.
    $msg = resendMessageByID(1);
    print_r($msg);
 
    // Get messages using the Group ID and Status.
    $msgs = resendMessagesByGroupID('LV5LxqyBMEbQrl9*J$5bb4c03e8a07b7.62193871', 'Failed');
    print_r($msgs);

    // Resend pending messages in last 24 hours.
    $msgs = resendMessagesByStatus("Pending", null, null, time() - 86400);

    // Resend pending messages sent using SIM 1 of device ID 8 in last 24 hours.
    $msgs = resendMessagesByStatus("Received", 8, 0, time() - 86400);
    print_r($msgs);
} catch (Exception $e) {
    echo $e->getMessage();
}

?>