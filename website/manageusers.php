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
    <?php if(!$_SESSION['online'] || !$_SESSION['super_user']){ ?>
        <div class="alert" data-show="true"><span id="alert-text">You must be logged in to access this. Redirecting...</span></div>
        <meta http-equiv="refresh" content="1">
    <?php }else{ ?>
        Coming soon
    <?php } ?>
</div>
</body>
</html>
