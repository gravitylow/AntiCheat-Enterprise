<?php
session_start();
require_once("config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/grid.css" />
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
                <!--<input type="submit" value="Change Settings" />-->
                <!--<input type="submit" value="Manage Users" />-->
                <input type="submit" id="logout" value="Logout" />
            </div>
        <?php } ?>
    </div>
    <div class="grid-container">
        <div class="grid-100">
            <div class="well text-center">
                <img src="img/logo.png" class="logo center" />
            </div>
        </div>
        <div class="grid-100">
            <div class="well">
                AntiCheat helps server admins easily identify and block malicious users by monitoring and analyzing the behavior of your players. AntiCheat will look for tell-tale signs of hacked clients, as well as implement limits into the game so that players cannot gain an advantage by hacking.
            </div>
        </div>
        <?php if($_SESSION['online']){
            $username = $_GET['user'];
            if(!empty($username)){ ?>
                <div class="grid-100 text-center top-margin-20">
                    <h2>You are viewing <?php echo $username; ?> <small>(Level <?php
                            $stmt = $db->prepare("SELECT level FROM ac_levels WHERE user = ?");
                            $stmt->bind_param('s',$username);
                            $stmt->execute();
                            $stmt->store_result();

                            $stmt->bind_result($level);
                            if($stmt->num_rows > 0){
                                while($stmt->fetch()){
                                    echo $level;
                                }
                            }else{
                                echo '0';
                            }
                            ?>)</small></h2>
                    <p><a href="index.php">Go back</a></p>
                </div>
            <?php } ?>
            <div class="grid-100 grid-parent top-margin-20">
                <div class="grid-80 center">
                    <table class="table" id="main-table">
                        <thead class="table-head">
                        <tr>
                            <th width="5%">ID</th>
                            <th>Username</th>
                            <th>Type</th>
                            <th>Server</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody class="table-body" id="main-body">
                        <tr>
                            <td colspan="5" class="text-center">Loading..</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
