<?php

session_start();
include('../util/Privilege.php');
if($_SESSION['online'] && Privilege::hasSuperAdmin($_SESSION['privileges'])){
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        require_once("../config.php");
        $stmt = $db->prepare("SELECT username, privileges FROM ac_users WHERE id = ?");
        $stmt->bind_param('i', $id);

        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            $stmt->bind_result($username, $privileges);
            while($stmt->fetch()){
                $json = array(array('field' => 'userid',
                                    'value' => $id),
                              array('field' => 'username',
                                    'value' => $username),
                              array('field' => 'privilege',
                                    'value' => $privileges));
                echo json_encode($json);
            }
        }
    }
}
?>
