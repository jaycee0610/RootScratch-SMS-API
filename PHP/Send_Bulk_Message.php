<?php

include_once "function.php";
 
$messages = array();

for ($i = 1; $i <= 12; $i++) {
    array_push($messages,
        [
            "number" => "+11234567890",
            "message" => "This is a test #{$i} of PHP version. Testing bulk message functionality."
        ]);
}

try {
    // Send messages using the primary device.
    sendMessages($messages);

    // Send messages using default SIM of all available devices. Messages will be split between all devices.
    sendMessages($messages, USE_ALL_DEVICES);
	
    // Send messages using all SIMs of all available devices. Messages will be split between all SIMs.
    sendMessages($messages, USE_ALL_SIMS);

    // Send messages using only specified devices. Messages will be split between devices or SIMs you specified.
    // If you send 12 messages using this code then 4 messages will be sent by Device ID 1, other 4 by SIM in slot 1 of 
    // Device ID 2 (Represendted as "2|0") and remaining 4 by SIM in slot 2 of Device ID 2 (Represendted as "2|1").
    sendMessages($messages, USE_SPECIFIED, [1, "2|0", "2|1"]);
    
    // Send messages on schedule using the primary device.
    sendMessages($messages, null, null, strtotime("+2 minutes"));
    
    // Send a message to contacts in contacts list with ID of 1.
    sendMessageToContactsList(1, "Test", USE_SPECIFIED, 1);
    
    // Send a message on schedule to contacts in contacts list with ID of 1.
    sendMessageToContactsList(1, "Test", null, null, strtotime("+2 minutes"));
    
    // Array of image links to attach to MMS message;
    $attachments = [
        "https://example.com/images/footer-logo.png",
        "https://example.com/downloads/sms-gateway/images/section/create-chat-bot.png"
    ];
    $attachments = implode(',', $attachments);
    
    $mmsMessages = [];
    for ($i = 1; $i <= 12; $i++) {
        array_push($mmsMessages,
            [
                "number" => "+11234567890",
                "message" => "This is a test #{$i} of PHP version. Testing bulk MMS message functionality.",
                "type" => "mms",
                "attachments" => $attachments
            ]);
    }
    // Send MMS messages using all SIMs of all available devices. Messages will be split between all SIMs.
    $msgs = sendMessages($mmsMessages, USE_ALL_SIMS);
    
    print_r($msgs);

    echo "Successfully sent bulk messages.";
} catch (Exception $e) {
    echo $e->getMessage();
}