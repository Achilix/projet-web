<?php
$db = new SQLite3('database.db');

// Check connection
if (!$db) {
    die("Connection failed: " . $db->lastErrorMsg());
}else{
    echo"connected";
}
?>
