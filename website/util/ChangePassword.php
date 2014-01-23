<?php

session_start();

require_once("../config.php");

if($_SESSION['online']){

    $password = $_POST['currentpassword'];
    $pass1 = $_POST['newpassword1'];
    $pass2 = $_POST['newpassword2'];

    $stmt = $db->prepare("SELECT password FROM ac_users WHERE username=?");
    $stmt->bind_param("s",$_SESSION['username']);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($remPassword);
    if($stmt->num_rows > 0){
        while($stmt->fetch()){
            $oldpassword = $remPassword;
        }
        $stmt->close();

        if(!PassAuth::checkPassword($oldpassword, $password)){
            echo "Your current password is incorrect.";
        }else{
            if($pass1 != $pass2 || empty($pass2) || empty($pass1)){
                echo "Your new passwords do not match";
            }else{
                if(PassAuth::checkPassword($oldpassword, $pass1)){
                    echo "You can't change your password to that!";
                }else{
                    $password = PassAuth::encryptPassword($pass1);
                    $stmt = $db->prepare("UPDATE ac_users SET password=? WHERE username=?");
                    $stmt->bind_param("ss",$password,$_SESSION['username']);
                    $stmt->execute();
                    $stmt->close();
                    echo "Your password has been changed. You will must login again before proceeding to another page.";
                    session_destroy();
                }
            }
        }
    }else{
        $stmt->close();
        echo "There was an error processing your request. Please try again later.";
    }
}
