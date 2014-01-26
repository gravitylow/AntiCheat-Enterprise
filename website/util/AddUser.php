<?php

session_start();
require_once("../config.php");
require_once("Privilege.php");
require("PassAuth.php");

if($_SESSION['online'] && Privilege::hasSuperAdmin($_SESSION['privileges'])){

    $username = $_POST['newusername'];
    $privileges = $_POST['newprivilege'];
    $pass1 = $_POST['newpassword1'];
    $pass2 = $_POST['newpassword2'];

    if($privileges == "") {
        echo "You must select a privilege";
    } else if($pass1 != $pass2 || empty($pass2) || empty($pass1)){
        echo "Your passwords do not match";
    } else {
        $stmt = $db->prepare("SELECT id FROM ac_users WHERE username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            echo "A user with that name already exists";
        } else {
            $stmt->close();

            $password = PassAuth::encryptPassword($pass1);
            $stmt = $db->prepare("INSERT INTO ac_users (username, password, privileges) VALUES (?, ?, ?)");
            $stmt->bind_param("sss",$username, $password, $privileges);
            $stmt->execute();
            $stmt->close();
            echo "User added successfully";
        }
    }
}
