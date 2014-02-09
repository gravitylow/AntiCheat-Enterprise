<?php
session_start();
require_once("config.php");
include("partials/header.php");
?>
    <?php if($_SESSION['online']){
        $username = $_GET['user'];
        if(!empty($username)){ ?>
            <div class="grid-100 text-center top-margin-20">
                <?php
                    $stmt = $db->prepare("SELECT level, last_update, last_update_server FROM ".$prefix."levels WHERE user = ?");
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
                    $stmt = $db->prepare("SELECT name, level, color FROM ".$prefix."groups");
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
                    $webColor = Group::getWebColor($color);
                    echo '<img style="border:1px solid #'.$webColor.';" src="util/Face.php?u='.$username.'&s=100" /><br><br>';
                    echo '<h2><font color="'.$webColor.'">';
                    echo $username;
                    echo ' <small>('.$group.')</small>';
                    echo '</font></h2>';
                    echo '<small>Last updated: ';

                    if(empty($update)){
                        echo 'Never';
                    }else{
                        echo ''.$update.' from '.($server == "MANUAL" ? "the web" : $server).'.';
                    }
                    echo '</small>';
                    if(Privilege::hasAdmin($_SESSION['privileges'])) {
                    ?>
                    <p>
                        <small id="editlevel-link" class="pointer"><i class="fa fa-pencil"></i> Edit Level</small>
                    </p>
                    <?php } ?>
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
                <div class="clear"></div>
                <?php if(Privilege::hasAdmin($_SESSION['privileges'])) { ?>
                    <div class="pull-right top-margin-20">
                        <button class="btn btn-default" id="clearlogs">Clear Logs</button>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
<?php include("partials/footer.php"); ?>
