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
        <div class="grid-80">
            <h2>Users</h2>
        </div>
        <div class="grid-20"></div>
    </div>
    <div id="userform" class="top-margin-20 text-center grid-100 grid-parent">
        <?php

        $stmt = $db->prepare("SELECT id, username, privileges FROM ac_users");
        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($id, $username, $superadmin);
        while($stmt->fetch()){
            ?>
            <form id="<?php echo $id; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div class="grid-80">
                    <?php echo $username; ?>
                </div>
                <div class="grid-20 text-center">
                    <a href="#edituser" data-id="<?php echo $id; ?>" class="btn btn-danger">Edit</a>
                    <a href="#removeuser" data-id="<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                </div>
            </form>
        <?php } ?>
    </div>
    <div class="grid-100 grid-parent">
        <form id="edituser-form" class="text-center center top-margin-20">
            <div class="grid-20">
                <label class="control-label" for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" />
            </div>
            <div class="grid-30">
                <label class="control-label" for="privilege">Privileges:</label>
                <select id ="privilege" name="privilege" class="form-control">
                    <option value="" disabled="disabled" selected="selected">Select a value</option>
                    <option value="superadmin" disabled="disabled">Superadmin</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="grid-20">
                <label class="control-label" for="password1">Password (blank to not edit):</label>
                <input type="password" id="password1" name="password1" class="form-control" />
            </div>
            <div class="grid-20">
                <label class="control-label" for="password2">Confirm:</label>
                <input type="password" id="password2" name="password1" class="form-control" />
            </div>
            <input type="hidden" id="userid" name="userid" />
            <div class="grid-10">
                &nbsp;<br />
                <button class="btn btn-danger" type="submit">Save</button>
            </div>
        </form>
    </div>
    <div class="grid-100 grid-parent">
        <form id="newuser-form" class="center text-center top-margin-20">
            <div class="grid-20">
                <label class="control-label">Username:</label>
                <input type="text" id="newusername" name="newusername" class="form-control" />
            </div>
            <div class="grid-30">
                <label class="control-label" for="newprivilege">Privileges:</label>
                <select id ="privilege" name="newprivilege" class="form-control">
                    <option value="" disabled="disabled" selected="selected">Select a value</option>
                    <option value="superadmin" disabled="disabled">Superadmin</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="grid-20">
                <label class="control-label" for="newpassword1">Password:</label>
                <input type="password" id="newpassword1" name="newpassword1" class="form-control" />
            </div>
            <div class="grid-20">
                <label class="control-label" for="newpassword2">Confirm:</label>
                <input type="password" id="newpassword2" name="newpassword1" class="form-control" />
            </div>
            <div class="grid-10">
                &nbsp;<br />
                <button class="btn btn-danger" type="submit">Save</button>
            </div>
        </form>
    </div>
<?php
}
include("partials/footer.php");
?>
