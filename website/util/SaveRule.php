<?php

session_start();
if($_SESSION['online']){
    require_once("../config.php");

    $id = $_POST['id'];
    $rule = $_POST['rule'];

    if(empty($rule)){
        echo "You can't make a blank rule!";
    }else{
        if($id == "new"){
            $stmt = $db->prepare("INSERT INTO ac_rules(rule) VALUES(?)");
            $stmt->bind_param("s",$rule);
        }else{
            $stmt = $db->prepare("UPDATE ac_rules SET rule=? WHERE id = ?");
            $stmt->bind_param("si",$rule,$id);
        }

        if($stmt->execute()){
            echo "Rule has been saved.";
        }else{
            echo "Could not save rule.";
        }

        $stmt->close();
    }
}
