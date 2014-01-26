<?php

session_start();
require_once("Privilege.php");

if($_SESSION['online'] && Privilege::hasSuperAdmin($_SESSION['privileges'])){
    require_once("../config.php");

    $stmt = $db->prepare("TRUNCATE ac_logs");
    $stmt->execute();
}
