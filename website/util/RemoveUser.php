<?php

require_once("../config.php");
session_start();

if($_SESSION['online'] && $_SESSION['privileges'] == "superadmin"){

    $stmt = $db->prepare("DELETE FROM ac_users WHERE id = ?");
    $id = $_POST['id'];
    $stmt->bind_param("i",$id);

    if($stmt->execute()){
        echo "User has been deleted";
    }else{
        echo "Could not delete user";
    }

    $stmt->close();
}
