<?php

$url = 'localhost'; // URL to your MySQL server. If your MySQL server is on the same server as this webpage, leave this
$user = 'anticheat'; // Database username
$password = 'password'; // Database password
$database = 'anticheat'; // Database name
$port = 3306; // Database port
$prefix = "ac_"; // Table prefix


/* ------------ Do not edit below this line ------------ */

$db = mysqli_connect($url, $user, $password, $database, $port);

function exists($table) {
    global $db, $prefix;
    return $db->query("SHOW TABLES LIKE '".$prefix.$table."'")->num_rows > 0;
}
