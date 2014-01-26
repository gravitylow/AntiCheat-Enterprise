<?php
session_start();
require_once("config.php");
include("partials/header.php");

if($_SESSION['online'] && Privilege::hasAdmin($_SESSION['privileges'])){
    ?>
    <div class="grid-100">
        <div class="well top-margin-20">
            <input type="submit" id="addrule" class="btn btn-danger" value="Add Rule">
        </div>
    </div>
    <div id="ruleform">
        <?php

        $stmt = $db->prepare("SELECT * FROM ac_rules");
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($id, $rule);
        while($stmt->fetch()){
            ?>
            <form class="grid-100 grid-parent top-margin-20" id="<?php echo $id; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div class="grid-80">
                    <input type="text" name="rule" class="form-control" value="<?php echo $rule; ?>" />
                </div>
                <div class="grid-20 text-center">
                    <a href="#saverule" data-id="<?php echo $id; ?>" class="btn btn-danger">Save</a>
                    <a href="#removerule" data-id="<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                </div>
            </form>
        <?php } ?>
    </div>
<?php
}
include("partials/footer.php");
?>
