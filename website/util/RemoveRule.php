<?php

session_start();
if($_SESSION['online']){
    require_once("../config.php");

    $stmt = $db->prepare("DELETE FROM ac_rules WHERE id = ?");
    $id = $_POST['id'];
    $stmt->bind_param("i",$id);

    if($stmt->execute()){
        echo "Rule has been deleted.";
    }else{
        echo "Could not delete rule";
    }
}
