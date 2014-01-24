<?php

session_start();
if($_SESSION['online']){
    require_once("../config.php");

    $stmt = $db->prepare("DELETE FROM ac_groups WHERE id = ?");
    $id = $_POST['id'];
    $stmt->bind_param("i",$id);

    if($stmt->execute()){
        echo "Group has been deleted.";
    }else{
        echo "Could not delete group";
    }

    $stmt->close();
}
