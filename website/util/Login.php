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
    if($stmt->num_rows() == 0){
        echo 'Your username or password was incorrect';
    }else{
        while($row = $stmt->fetch()){
            if(PassAuth::checkPassword($password, $row['password'])){
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['rank'] = $row['rank'];
                $page = $_SERVER['PHP_SELF'];
                header("Refresh: 0; $page");
            }else
                echo 'Your username or password was incorrect';
        }
    }
}