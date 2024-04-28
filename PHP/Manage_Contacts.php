<?php

include_once "function.php";

try {
    // Add a new contact to contacts list 1 or resubscribe the contact if it already exists.
    $contact = addContact(1, "+11234567890", "Test", true);
    print_r($contact);
 
    // Unsubscribe a contact using the mobile number.
    $contact = unsubscribeContact(1, "+11234567890");
    print_r($contact);
} catch (Exception $e) {
    echo $e->getMessage();
}