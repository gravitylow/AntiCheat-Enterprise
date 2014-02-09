<?php
session_start();
require_once("config.php");
include("partials/header.php");

if($_SESSION['online'] && Privilege::hasAdmin($_SESSION['privileges'])){
    if(!exists("magic")) {
        echo '<br><center>You need to enable the magic syncing option in AntiCheat to use this page. Please see your enterprise.yml</center>';
        include("partials/footer.php");
        die();
    }
    ?>
    <a href="http://dev.bukkit.org/bukkit-plugins/anticheat/pages/configuration/magic-yml/" target="_blank" class="pull-right top-margin-20">Magic documentation</a>
    <div class="top-margin-20 text-center grid-100 grid-parent">
        <div class="grid-30">
            <h2>Key</h2>
        </div>
        <div class="grid-10">
            <h2>Value</h2>
        </div>
        <div class="grid-20"></div>
    </div>
    <div id="magicform">
        <?php

        $stmt = $db->prepare("SELECT * FROM ".$prefix."magic");
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($id, $key, $value_int, $value_double);
        while($stmt->fetch()){
            ?>
            <form class="grid-100 grid-parent top-margin-20 text-center" id="<?php echo $id; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div class="grid-30">
                    <?php echo $key; ?>
                </div>
                <?php if($value_int != null) { ?>
                    <div class="grid-10">
                        <input type="number" name="value_int" class="form-control" value="<?php echo $value_int; ?>" />
                    </div>
                <?php } else { ?>
                    <div class="grid-10">
                        <input type="number" name="value_double" class="form-control" value="<?php echo $value_double; ?>" />
                    </div>
                <?php } ?>
                <div class="grid-20 text-center">
                    <a href="#savemagic" data-id="<?php echo $id; ?>" class="btn btn-danger">Save</a>
                </div>
            </form>
        <?php } ?>
    </div>
<?php
}
include("partials/footer.php");
?>
