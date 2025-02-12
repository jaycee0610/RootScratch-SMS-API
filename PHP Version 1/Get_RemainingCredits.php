<?php

include_once "function.php";
 
try {
    $credits = getBalance();
    echo "Message Credits Remaining: {$credits}";
} catch (Exception $e) {
    echo $e->getMessage();
}
