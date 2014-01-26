<!-- Created by lDucks and Gravity, tested by drtshock -->
<?php

if(file_exists("install.php")){
    header("Location: install.php");
}

include('util/Privilege.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/grid.css" />
    <link type="text/css" rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
    <script src="//codeorigin.jquery.com/jquery-2.0.3.min.js" type="text/javascript"></script>
    <script src="js/jquery.dynatable.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <link rel="icon" type="image/png" href="img/favicon.png" />
    <title>AntiCheat Administration Backend</title>
</head>
<body>
<div class="wrapper">
    <div class="alert"><span id="alert-text"></span><button type="button" class="close" id="close-alert">x</button></div>
    <div id="topcontent">
        <?php if(!$_SESSION['online']){ ?>
            <form id="loginform">
                <div id="login-content">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                </div>
                <div id="login"><input type="submit" value="Login" /></div>
            </form>
        <?php

        }else {

            ?>
            <div id="usercp">
                <a href="index.php">Home</a>
                <?php if(Privilege::hasAdmin($_SESSION['privileges'])){ ?>
                    <a href="editgroups.php">Groups</a>
                    <a href="editrules.php">Rules</a>
                <?php } ?>
                <a href="account.php">Account</a>
                <?php if(Privilege::hasSuperAdmin($_SESSION['privileges'])){ ?>
                    <a href="admin.php">Admin</a>
                <?php } ?>
                <input type="submit" id="logout" value="Logout" />
            </div>
        <?php } ?>
    </div>
    <div class="grid-container">
        <div class="grid-100">
            <div class="well text-center">
                <a href="index.php"><img src="img/logo.png" class="logo center" /></a>
            </div>
        </div>
        <?php if(!$_SESSION['online']){ ?>
            <div class="grid-100">
                <div class="well">
                    AntiCheat helps server admins easily identify and block malicious users by monitoring and analyzing the behavior of your players. AntiCheat will look for tell-tale signs of hacked clients, as well as implement limits into the game so that players cannot gain an advantage by hacking.
                </div>
            </div>
        <?php } ?>
