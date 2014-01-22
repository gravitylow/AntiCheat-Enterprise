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
                <!--<input type="submit" value="Change Settings" />-->
                <!--<input type="submit" value="Manage Users" />-->
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
        <div class="grid-100">
            <div class="well">
                AntiCheat helps server admins easily identify and block malicious users by monitoring and analyzing the behavior of your players. AntiCheat will look for tell-tale signs of hacked clients, as well as implement limits into the game so that players cannot gain an advantage by hacking.
            </div>
        </div>
        <?php if($_SESSION['online']){
            $username = $_GET['user'];
            if(!empty($username)){ ?>
                <div class="grid-100 text-center top-margin-20">
                    <h2><?php
                        $stmt = $db->prepare("SELECT level, last_update, last_update_server FROM ac_levels WHERE user = ?");
                        $stmt->bind_param('s',$username);
                        $stmt->execute();
                        $stmt->store_result();

                        $stmt->bind_result($remLevel, $remUpdate, $remServer);
                        if($stmt->num_rows > 0){
                            while($stmt->fetch()){
                                $level = $remLevel;
                                $update = date('F jS Y g:i A', strtotime($remUpdate));
                                $server = $remServer;
                            }
                        }else{
                            $level = 0;
                        }
                        $stmt->free_result();
                        $stmt = $db->prepare("SELECT name, level, color FROM ac_groups");
                        $stmt->execute();
                        $stmt->store_result();

                        $stmt->bind_result($groupName, $groupLevel, $groupColor);

                        $group = "Low";
                        $color = "GREEN";
                        if($stmt->num_rows > 0){
                            while($stmt->fetch()) {
                                if($level >= $groupLevel) {
                                    $group = $groupName;
                                    $color = $groupColor;
                                }
                            }
                        }
                        require_once('util/Group.php');
                        echo '<font color="'.Group::getWebColor($color).'">';
                        echo $username;
                        echo ' <small>('.$group.')</small>';
                        echo '</font></h2>';
                        echo '<small>Last seen: ';

                        if(empty($update)){
                            echo 'Never';
                        }else{
                            echo ''.$update.' on '.$server;
                        }
                        echo '</small>';
                        ?>
                        <p>
                            <small id="editlevel-link" class="pointer"><i class="fa fa-pencil"></i> Edit Level</small>
                        </p>
                        </font></h2>
                </div>
                <form id="editlevel-form">
                    <div class="stepper-group">
                        <div class="input-group">
                            <input type="hidden" id="username" name="username" value="<?php echo $username; ?>" />
                            <input type="number" id="level" name="level" class="form-control" min="0" value="<?php echo $level; ?>" />
                            <span class="input-group-btn"><button class="btn btn-danger" type="submit">Save</button></span>
                        </div>
                    </div>
                </form>
                <?php
                $stmt->close();
            } ?>
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
                    <div class="pull-right top-margin-20">
                        <button class="btn btn-default" id="clearlogs">Clear Logs</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
