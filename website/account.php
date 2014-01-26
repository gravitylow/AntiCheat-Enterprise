<?php
session_start();
require_once("config.php");
include("partials/header.php");

if($_SESSION['online']){
    ?>
    <div class="grid-100 grid-parent">
        <form id="changepassword">
            <div class="well">
                <input type="password" class="form-control" name="currentpassword" placeholder="Current Password" />
            </div>
            <div class="well">
                <input type="password" class="form-control" name="newpassword1" placeholder="New Password" />
                <div class="top-margin-20">
                    <input type="password" class="form-control" name="newpassword2" placeholder="New Password Again" />
                </div>
            </div>
            <input type="submit" class="btn btn-danger pull-right top-margin-20" value="Change" />
        </form>
    </div>
<?php
}

include("partials/footer.php"); ?>
