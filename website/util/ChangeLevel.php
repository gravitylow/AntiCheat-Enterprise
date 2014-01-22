<?php

session_start();

require_once("../config.php");

if($_SESSION['online']){

    $level = $_POST['level'];
    $username = $_POST['username'];

    $stmt = $db->prepare("REPLACE INTO ac_levels(user,level,last_update_server) VALUES(?,?,'MANUAL')");
    $stmt->bind_param('si',$username,$level);
    if($stmt->execute()){
        echo "$username's level was changed to $level";
    }else{
        echo "Changing $username's level was not successful.";
    }

    $stmt->close();
}
