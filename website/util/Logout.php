<?php

session_start();
include("../config.php");

if(session_destroy())
    echo 'Logging you out...<meta http-equiv="refresh" content="0">';
else
    echo 'There was an error signing you out';