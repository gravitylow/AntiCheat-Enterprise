<?php

session_start();
require_once("../config.php");

if($_SESSION['online']){
    $db->query("DELETE FROM Logs");
}
