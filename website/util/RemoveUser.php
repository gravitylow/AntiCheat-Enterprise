<?php

session_start();
require_once("../config.php");
require_once("Privilege.php");

if($_SESSION['online'] && Privilege::hasSuperAdmin($_SESSION['privileges'])){

    $id = $_POST['id'];
    $stmt = $db->prepare("SELECT privileges FROM ac_users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($priv);
    if($stmt->num_rows > 0){
        while($stmt->fetch()){
            if($priv == "superadmin") {
                echo "You cannot delete the superadmin";
                die();
            }
        }
        $stmt->close();
    }

    $stmt = $db->prepare("DELETE FROM ac_users WHERE id = ?");
    $stmt->bind_param("i",$id);

    if($stmt->execute()){
        echo "User deleted successfully";
    }else{
        echo "Could not delete user";
    }

    $stmt->close();
}
