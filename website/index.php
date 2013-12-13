<?php
session_start();
require_once("config.php");

$logs = $db->query("SELECT * FROM ac_logs");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/red.css" id="stylesheet" />
    <link type="text/css" rel="stylesheet" href="css/grid.css" />
    <script src="//codeorigin.jquery.com/jquery-2.0.3.min.js" type="text/javascript"></script>
    <script src="js/leanModal.min.js" type="text/javascript"></script>
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
                        <label for="username">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                </div>
                <div id="login"><input type="submit" value="Login" /></div>
            </form>
        <?php

        }else {

            ?>
            <div id="logout"><input type="submit" value="Logout" /></div>
        <?php } ?>
    </div>
    <div class="grid-container">
        <a href="#colorblind" class="colorblind"></a>
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
        <?php if($_SESSION['online']){ ?>
            <div class="grid-100 grid-parent">
                <div class="grid-30 center">
                    <div class="well">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Start typing to search" />
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">Search</button>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-100 grid-parent">
                <div class="grid-80 center">
                    <table class="table">
                        <thead class="table-head">
                        <tr>
                            <th colspan="2">Username</th>
                            <th>Type</th>
                            <th>Server</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody class="table-body">
                        <?php foreach($logs as $log){ ?>
                            <tr>
                                <td class="avatar"><img src="http://minecraft.aggenkeech.com/face.php?u=<?php echo $log['user']; ?>&s=20" /></td>
                                <td><a rel="leanModal" href="#modal-userinfo"><?php echo $log['user']; ?></a></td>
                                <td><?php echo $log['check_type']; ?></td>
                                <td><?php echo $log['server']; ?></td>
                                <td><?php echo $log['time']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div id="modal-userinfo" class="modal">
    <div class="panel">
        <div class="panel-heading">Loading</div>
        <div class="panel-body">Loading, please wait.</div>
    </div>
</div>
</body>
</html>