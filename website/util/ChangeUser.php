<?php
session_start();
require_once("../config.php");
require("PassAuth.php");

if($_SESSION['online'] && $_SESSION['privileges'] == "superadmin"){

    $id = $_POST['userid'];
    $username = $_POST['username'];
    $privileges = $_POST['privilege'];
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];

    if($privileges == "") {
        echo "You must select a privilege";
    } else if($pass1 != $pass2 || empty($pass2) || empty($pass1)){
        echo "Your new passwords do not match";
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
            $stmt = $db->prepare("UPDATE ac_users SET username=?, password=?, privileges=? WHERE id=?");
            $stmt->bind_param("sssi",$username, $password, $privileges, $id);
            $stmt->execute();
            $stmt->close();
            echo "User credentials updated successfully";
        }
    }
}
