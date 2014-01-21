<?php
require("util/PassAuth.php");

if(isset($_POST['submit'])){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    if(empty($pass1) || empty($pass2)){
        echo 'You must enter a password.';
    }else{
        if($pass1 == $pass2){
            $password = PassAuth::encryptPassword($_POST['pass1']);
            $username = $_POST['username'];
            if(empty($username)){
                echo 'You must enter a username.';
            }else{
                include('config.php');
                $db->query("CREATE TABLE ac_users(id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,username VARCHAR(16),password VARCHAR(256),privileges VARCHAR(45))");
                $stmt = $db->prepare("INSERT INTO ac_users(`username`,`password`) VALUES(?,?)");
                $stmt->bind_param('ss',$username,$password);
                $stmt->execute();
                ?>
                <h1>Installation Completed</h1>
                Please delete the install.php file for security reasons. Then, return to your index page and sign in with your new account.
                <?php
                return;
            }
        }else{
            echo'Your passwords do not match, please try again.';
        }
    }
}
?>
<h1>Install</h1>
<form method="post" action="install.php">
    Enter Superadmin Username:
    <input type="text" name="username" required /><br />
    Enter Superadmin Password:
    <input type="password" name="pass1" required /><br />
    Enter Superadmin Password (Again):
    <input type="password" name="pass2" required /><br />
    <input type="submit" value="Install" name="submit" />
</form>
