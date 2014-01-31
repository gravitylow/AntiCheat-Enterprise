<?php

session_start();
require_once("Privilege.php");

if($_SESSION['online'] && Privilege::hasAdmin($_SESSION['privileges'])){
    require_once("../config.php");

    $id = $_POST['id'];
    $value = $_POST['value'];

    $stmt = $db->prepare("UPDATE ac_lang SET value = ? WHERE id = ?");
    $stmt->bind_param("si",$value,$id);

    if($stmt->execute()){
        echo "Value saved.";
    }else{
        echo "Could not save value.";
    }

    $stmt->close();
}
