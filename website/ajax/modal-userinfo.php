<?php

require_once("../config.php");

$usern = htmlspecialchars($_POST['user']);

$query = "SELECT * FROM ac_logs WHERE user = '$usern' ORDER BY ID desc";

$user = $db->query("$query LIMIT 1");
$user = $user->fetch_assoc();

?>
<div class="panel">
    <div class="panel-heading"><img src="http://minecraft.aggenkeech.com/face.php?u=<?php echo $user['user']; ?>&s=20" /> <?php echo $user['user']; ?></div>
    <div class="panel-body">
        <?php echo $user['user']; ?> was last seen on <?php echo $user['time']; ?>.
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Server</th>
            <th>Time</th>
            <th>Type</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $logs = $db->query($query);
        foreach($logs as $log){ ?>
            <tr>
                <td><?php echo $log['server']; ?></td>
                <td><?php echo $log['time']; ?></td>
                <td><?php echo $log['check_type']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>