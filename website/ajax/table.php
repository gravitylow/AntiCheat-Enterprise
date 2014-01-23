<?php

session_start();

if($_SESSION['online']){
    require_once("../config.php");
    $username = $_GET['user'];
    if(empty($username))
        $stmt = $db->prepare("SELECT * FROM ac_logs ORDER BY id DESC");
    else{
        $stmt = $db->prepare("SELECT * FROM ac_logs WHERE user = ? ORDER BY id DESC");
        $stmt->bind_param('s',$username);
    }

    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $server, $time, $username, $checktype);
        while($stmt->fetch()){
            ?>
            <tr>
                <td><?php echo $id; ?></td>
                <td><img src="http://minecraft.aggenkeech.com/face.php?u=<?php echo $username; ?>&s=20" /> <a href="?user=<?php echo $username; ?>"><?php echo $username; ?></a></td>
                <td><?php echo $checktype; ?></td>
                <td><?php echo $server; ?></td>
                <td><?php echo $time; ?></td>
            </tr>
        <?php }
    }
}
?>
