<?php
session_start();

if($_SESSION['online']){
    require_once("../config.php");

    $stmt = $db->prepare("TRUNCATE Logs");
    $stmt->execute();
}
