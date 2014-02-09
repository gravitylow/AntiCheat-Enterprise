<?php

session_start();
require_once("Privilege.php");

if($_SESSION['online'] && Privilege::hasAdmin($_SESSION['privileges'])){
    require_once("../config.php");

    $stmt = $db->prepare("TRUNCATE ".$prefix."logs");
    $stmt->execute();
}
