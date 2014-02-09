<?php
session_start();
require_once("config.php");
include("partials/header.php");

if($_SESSION['online'] && Privilege::hasAdmin($_SESSION['privileges'])){
    if(!exists("groups")) {
        echo '<br><center>You need to enable the groups syncing option in AntiCheat to use this page. Please see your enterprise.yml</center>';
        include("partials/footer.php");
        die();
    }
    ?>
    <div class="grid-100">
        <div class="well top-margin-20">
            <input type="submit" id="addgroup" class="btn btn-danger" value="Add Group">
        </div>
        <a href="http://dev.bukkit.org/bukkit-plugins/anticheat/pages/configuration/groups-yml/" target="_blank" class="pull-right top-margin-20">What are groups?</a>
    </div>
    <div class="grid-100 grid-parent text-center">
        <div class="grid-20">
            <h2>Name</h2>
        </div>
        <div class="grid-10">
            <h2>Level</h2>
        </div>
        <div class="grid-15">
            <h2>Color</h2>
        </div>
        <div class="grid-30">
            <h2>Action</h2>
        </div>
        <div class="grid-20"></div>
    </div>
    <div id="groupform">
        <?php

        $stmt = $db->prepare("SELECT * FROM ".$prefix."groups");
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($id, $name, $level, $color, $actions);
        while($stmt->fetch()){
            ?>
            <form class="grid-100 grid-parent top-margin-20" id="<?php echo $id; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div class="grid-20">
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" />
                </div>
                <div class="grid-10">
                    <input type="number" name="level" class="form-control" value="<?php echo $level; ?>" />
                </div>
                <div class="grid-20">
                    <input type="text" name="color" class="form-control" value="<?php echo $color; ?>" />
                </div>
                <div class="grid-30">
                    <input type="text" name="actions" class="form-control" value="<?php echo $actions; ?>" />
                </div>
                <div class="grid-20 text-center">
                    <a href="#savegroup" data-id="<?php echo $id; ?>" class="btn btn-danger">Save</a>
                    <a href="#removegroup" data-id="<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                </div>
            </form>
        <?php } ?>
    </div>
<?php
}
include("partials/footer.php");
?>
