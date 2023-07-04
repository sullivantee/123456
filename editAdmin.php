<?php
    require "header.php";
    require "backendphp/condb_back.php";
    if ($_SESSION['userType'] != "admin") {
        header("Location: javascript:history.go(-1)");
        die();
    }

    $adminID = $_GET['adminID'];

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE userID = '$adminID'");
    $row = mysqli_num_rows($sql);
    $row = mysqli_fetch_array($sql);

    $adminID = $row['userID'];
    $adminUid = $row['userUid'];
    $adminName = $row['userName'];
    $adminEmail = $row['userEmail'];
?>

    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyfields") {
                        echo "<label class='editAdmin-error'>Fill in all fields</label>";
                    }
                    else if ($_GET['error'] == "invalid") {
                        echo "<label class='editAdmin-error'>Invalid</label>";
                    }
                    else if ($_GET['error'] == "invaildName") {
                        echo "<label class='editAdmin-error'>Invalid Name</label>";
                    }
                    else if ($_GET['error'] == "invaildUid") {
                        echo "<label class='editAdmin-error'>Invalid Username</label>";
                    }
                    else if ($_GET['error'] == "invaildMail") {
                        echo "<label class='editAdmin-error'>Invalid Email</label>";
                    }
                    else if ($_GET['error'] == "mysqlerror") {
                        echo "<label class='editAdmin-error'>Error</label>";
                    }
                    else if ($_GET['error'] == "taken") {
                        echo "<label class='editAdmin-error'>Username Taken</label>";
                    }
                }else if (isset($_GET['editAdmin'])) {
                    if ($_GET['editAdmin'] == "success") {
                        echo "<label class='editAdmin-success'>Edit Admin Success</label>";
                    }
                }
            ?>
            <div class="editAdmin-main">
                <label class="editAdmin-label">Edit Admin</label>
                <label class="editAdmin-ID-NAME-label" >ID :</label>
                <label class="editAdmin-ID-NAME-label-bold"> <?= $adminID ?> &emsp;</label>
                <form action="backendphp/editAdmin-back.php?adminID=<?= $adminID?>" method="post">
                    <label>Name:</label>
                    <input type="text" name="edit_admin_name" value="<?= $adminName?>"><br>
                    <label>Username:</label>
                    <input type="text" name="edit_admin_uid" value="<?= $adminUid?>"><br>
                    <label>Email:</label>
                    <input type="text" name="edit_admin_email" value="<?= $adminEmail?>"><br>
                    <label>Password:</label>
                    <input type="password" name="edit_admin_pwd" id="edit_admin_pwd"><br>
                    <div class="div-edit-pwd">
                            <input class="checkbox" type="checkbox" onclick="showEditAdminPwd()">
                            <label class="show-pwd-admin">Show Password</label>
                    </div>
                    <br>
                    <div class="btn">
                        <button type="submit" name="edit_admin_submit">Edit</button><br>
                        <a class="cxlEditAdmin-btn" href="javascript:history.go(-1)"><span>Cancel</span></a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
<?php
    require "footer.php";
?>