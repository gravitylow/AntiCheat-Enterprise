<?php
session_start();
require_once("config.php");
include("partials/header.php");

if($_SESSION['online'] && Privilege::hasSuperAdmin($_SESSION['privileges'])){
    ?>
    <div class="grid-100">
        <div class="well top-margin-20">
            <input type="submit" id="adduser" class="btn btn-danger" value="Add User">
        </div>
    </div>
    <div class="grid-100 grid-parent text-center top-margin-20">
        <div class="grid-20">
            <h2>Users</h2>
        </div>
        <div class="grid-20"></div>
    </div>
    <div id="userform">
        <?php

        $stmt = $db->prepare("SELECT id, username, privileges FROM ac_users");
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($id, $username, $superadmin);
        while($stmt->fetch()){
            ?>
            <form class="grid-100 text-center grid-parent top-margin-20" id="<?php echo $id; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div class="grid-20">
                    <?php echo $username; ?>
                </div>
                <div class="grid-20 text-center">
                    <a href="#edituser" data-id="<?php echo $id; ?>" class="btn btn-danger">Edit</a>
                    <a href="#removeuser" data-id="<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                </div>
            </form>
        <?php } ?>
    </div>
    <br />
    <form id="edituser-form" class="grid-20 text-center grid-parent top-margin-20">
        <div class="stepper-group">
            <div class="input-group">
                Username: <input type="text" id="username" name="username" /><br />
                Privileges:
                <select id ="privilege" name="privilege">
                    <option value="" disabled="disabled" selected="selected">Select a value</option>
                    <option value="superadmin" disabled="disabled">Superadmin</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                Password (blank to not edit): <input type="password" id="password1" name="password1" /><br />
                Confirm: <input type="password" id="password2" name="password2" /><br />
                <input type="hidden" id="userid" name="userid" />
                <span class="input-group-btn"><button class="btn btn-danger" type="submit">Save</button></span>
            </div>
        </div>
    </form>
    <form id="newuser-form" class="grid-20 text-center grid-parent top-margin-20">
        <div class="stepper-group">
            <div class="input-group">
                Username: <input type="text" id="newusername" name="newusername" /><br />
                Privileges:
                <select id ="newprivilege" name="newprivilege">
                    <option value="" disabled="disabled" selected="selected">Select a value</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                Password: <input type="password" id="newpassword1" name="newpassword1" /><br />
                Confirm: <input type="password" id="newpassword2" name="newpassword2" /><br />
                <span class="input-group-btn"><button class="btn btn-danger" type="submit">Save</button></span>
            </div>
        </div>
    </form>
<?php
}
include("partials/footer.php");
?>