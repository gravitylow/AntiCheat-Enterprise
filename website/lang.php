<?php
session_start();
require_once("config.php");
include("partials/header.php");

if($_SESSION['online'] && Privilege::hasAdmin($_SESSION['privileges'])){
    if(!exists("lang")) {
        echo '<br><center>You need to enable the language syncing option in AntiCheat to use this page. Please see your enterprise.yml</center>';
        include("partials/footer.php");
        die();
    }
    ?>
    <a href="http://dev.bukkit.org/bukkit-plugins/anticheat/pages/configuration/lang-yml/" target="_blank" class="pull-right top-margin-20">Language documentation</a>
    <div class="top-margin-20 text-center grid-100 grid-parent">
        <div class="grid-30">
            <h2>Key</h2>
        </div>
        <div class="grid-50">
            <h2>Value</h2>
        </div>
        <div class="grid-20"></div>
    </div>
    <div id="magicform">
        <?php

        $stmt = $db->prepare("SELECT * FROM ac_lang");
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($id, $key, $value);
        while($stmt->fetch()){
            ?>
            <form class="grid-100 grid-parent top-margin-20 text-center" id="<?php echo $id; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div class="grid-30">
                    <?php echo $key; ?>
                </div>
                <div class="grid-50">
                    <input type="text" name="value" class="form-control" value="<?php echo $value; ?>" />
                </div>
                <div class="grid-20 text-center">
                    <a href="#savelang" data-id="<?php echo $id; ?>" class="btn btn-danger">Save</a>
                </div>
            </form>
        <?php } ?>
    </div>
<?php
}
include("partials/footer.php");
?>
