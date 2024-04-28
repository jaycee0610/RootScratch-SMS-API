<?php

include_once "function.php";

try {
    // Get all enabled devices for sending messages.
    $devices = getDevices()
    print_r($devices);
} catch (Exception $e) {
    echo $e->getMessage();
}