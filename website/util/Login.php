<?php
include("../config.php");
require("PassAuth.php");

$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username) || empty($password)){
    echo 'You have left something blank';
}else{
    $stmt = $db->prepare('SELECT * FROM ac_users WHERE username = ? LIMIT 1');
    $stmt->bind_param('s',$username);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows() == 0){
        echo 'Your username or password was incorrect [0x001]';
    }else{
        $stmt->bind_result($nid, $nusername, $npassword, $nprivileges);
        while($stmt->fetch()){
            if(PassAuth::checkPassword($password, $npassword)){

                session_start();
                $_SESSION['online'] = true;
                $_SESSION['username'] = $nusername;
                $_SESSION['privileges'] = $nprivileges;
                $page = $_SERVER['PHP_SELF'];

                echo 'Logging you in...<meta http-equiv="refresh" content="0">';
            }else
                echo 'Your username or password was incorrect [0x002]';
        }
    }

    $stmt->free_result();
    $stmt->close();
}