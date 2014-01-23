<?php

session_start();
if($_SESSION['online']){
    require_once("../config.php");

    $id = $_POST['id'];
    $name = $_POST['name'];
    $level = $_POST['level'];
    $color = $_POST['color'];
    $actions = $_POST['actions'];

    if($id == "new"){
        $stmt = $db->prepare("INSERT INTO ac_groups(name,level,color,actions) VALUES(?,?,?,?)");
        $stmt->bind_param("siss",$name,$level,$color,$actions);
    }else{
        $stmt = $db->prepare("UPDATE ac_groups SET name=?,level=?,color=?,actions=? WHERE id = ?");
        $stmt->bind_param("sissi",$name,$level,$color,$actions,$id);
    }

    if($stmt->execute()){
        echo "$name has been saved.";
    }else{
        echo "Could not save $name.";
    }
}
