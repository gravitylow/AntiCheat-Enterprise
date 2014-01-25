<h1>Install</h1>
<p>Make sure you edit config.php with the correct database information before using this form.</p>
<?php
require("util/PassAuth.php");
require_once('config.php');

$query = $db->query("SHOW TABLES LIKE 'ac_users'");
$bool = false;

if($query->num_rows > 0){
    $users = $db->query("SELECT * FROM ac_users WHERE privileges = 'superadmin'");
    if($users->num_rows > 0){
        $bool = true;
    }
}

if($bool){
    ?>
    <h2>Installation Completed</h2>
    Please delete the install.php file for security reasons. Then, return to your index page and sign in with your new account. If you do not delete your install.php file you will not be able to access your AntiCheat panel.
<?php
}else{
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
                    $privilege = "superadmin"
                    $db->query("CREATE TABLE ac_users(id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,username VARCHAR(16),password VARCHAR(256),privileges VARCHAR(45) DEFAULT 'admin')");
                    $stmt = $db->prepare("INSERT INTO ac_users(`username`,`password`,`privileges`) VALUES(?,?,?)");
                    $stmt->bind_param('sss',$username,$password,$privilege);
                    $stmt->execute();
                    ?>
                    <h2>Installation Completed</h2>
                    Please delete the install.php file for security reasons. Then, return to your index page and sign in with your new account. If you do not delete your install.php file you will not be able to access your AntiCheat panel.
                    <?php
                    $stmt->close();
                    return;
                }
            }else{
                echo'Your passwords do not match, please try again.';
            }
        }
    }
    ?>
    <form method="post" action="install.php">
        Enter Superadmin Username:
        <input type="text" name="username" required /><br />
        Enter Superadmin Password:
        <input type="password" name="pass1" required /><br />
        Enter Superadmin Password (Again):
        <input type="password" name="pass2" required /><br />
        <input type="submit" value="Install" name="submit" />
    </form>
<?php } ?>
