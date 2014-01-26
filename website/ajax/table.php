<?php

session_start();

if($_SESSION['online']){
    require_once("../config.php");
    $username = $_GET['user'];
    if(empty($username))
        $stmt = $db->prepare("SELECT * FROM ac_logs ORDER BY id DESC");
    else{
        $stmt = $db->prepare("SELECT * FROM ac_logs WHERE user = ? ORDER BY id DESC");
        $stmt->bind_param('s',$username);
    }

    $stmt->execute();
    $stmt->store_result();
    $json = array();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $server, $time, $username, $checktype);
        while($stmt->fetch()){
            $json[] = array("id" => $id, "username" => $username, "type" => $checktype, "server" => $server,"time" => $time);
        }
    }

    $stmt->close();

    print json_encode($json);
}
?>
