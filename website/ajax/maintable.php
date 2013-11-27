<?php

include_once("config.php");

$logs = $db->query("SELECT * FROM ac_logs");

?>

<?php foreach($logs as $log){ ?>
<tr>
    <td class="avatar"><img src="http://minecraft.aggenkeech.com/face.php?u=<?php echo $log['user']; ?>&s=20" /></td>
    <td><a rel="leanModal" href="#modal-userinfo"><?php echo $log['user']; ?></a></td>
    <td><?php echo $log['check_type']; ?></td>
    <td><?php echo $log['server']; ?></td>
    <td><?php echo $log['time']; ?></td>
</tr>

<?php } ?>