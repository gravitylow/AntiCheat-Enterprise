<?php

session_start();
require_once("Privilege.php");

if($_SESSION['online'] && Privilege::hasAdmin($_SESSION['privileges'])){
    require_once("../config.php");

    $stmt = $db->prepare("DELETE FROM ac_groups WHERE id = ?");
    $id = $_POST['id'];
    $stmt->bind_param("i",$id);

    if($stmt->execute()){
        echo "Group deleted.";
    }else{
        echo "Could not delete group";
    }

    $stmt->close();
}
