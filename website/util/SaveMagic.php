<?php

session_start();
require_once("Privilege.php");

if($_SESSION['online'] && Privilege::hasAdmin($_SESSION['privileges'])){
    require_once("../config.php");

    $id = $_POST['id'];
    $value_int = $_POST['value_int'];
    $value_double = $_POST['value_double'];


    if($value_int != null) {
        if(ctype_digit($value_int)) {
            $stmt = $db->prepare("UPDATE ac_magic SET value_int = ? WHERE id = ?");
            $stmt->bind_param("ii",$value_int,$id);
        } else {
            echo "You must provide an integer value.";
            die();
        }
    } else if($value_double != null) {
        if(is_float($value_double)) {
            $stmt = $db->prepare("UPDATE ac_magic SET value_double = ? WHERE id = ?");
            $stmt->bind_param("di",$value_double,$id);
        } else {
            echo "You must provide a decimal value.";
            die();
        }
    }

    if($stmt->execute()){
        echo "Value saved.";
    } else {
        echo "Could not save value.";
    }

    $stmt->close();
}