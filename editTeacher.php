<?php
    require "header.php";
    require "backendphp/condb_back.php";
    if ($_SESSION['userType'] != "admin") {
        header("Location: javascript:history.go(-1)");
        die();
    }

    $tchID = $_GET['tchID'];

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE userID = '$tchID'");
    $row = mysqli_num_rows($sql);
    $row = mysqli_fetch_array($sql);

    $tchID = $row['userID'];
    $tchUid = $row['userUid'];
    $tchName = $row['userName'];
    $tchEmail = $row['userEmail'];
?>

    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyfields") {
                        echo "<label class='editTeacher-error'>Fill in all fields</label>";
                    }
                    else if ($_GET['error'] == "invalid") {
                        echo "<label class='editTeacher-error'>Invalid</label>";
                    }
                    else if ($_GET['error'] == "invaildName") {
                        echo "<label class='editTeacher-error'>Invalid Name</label>";
                    }
                    else if ($_GET['error'] == "invaildUid") {
                        echo "<label class='editTeacher-error'>Invalid Username</label>";
                    }
                    else if ($_GET['error'] == "invaildMail") {
                        echo "<label class='editTeacher-error'>Invalid Email</label>";
                    }
                    else if ($_GET['error'] == "mysqlerror") {
                        echo "<label class='editTeacher-error'>Error</label>";
                    }
                    else if ($_GET['error'] == "taken") {
                        echo "<label class='editTeacher-error'>Username Taken</label>";
                    }
                }else if (isset($_GET['editTeacher'])) {
                    if ($_GET['editTeacher'] == "success") {
                        echo "<label class='editTeacher-success'>Edit Teacher Success</label>";
                    }
                }
            ?>
            <div class="editTeacher-main">
                <label class="editTeacher-label">Edit Teacher</label>
                <label class="editTeacher-ID-NAME-label" >ID :</label>
                <label class="editTeacher-ID-NAME-label-bold"> <?= $tchID ?> &emsp;</label>
                <form action="backendphp/editTeacher-back.php?tchID=<?= $tchID?>" method="post">
                    <label>Name:</label>
                    <input type="text" name="edit_tch_name" value="<?= $tchName?>"><br>
                    <label>Username:</label>
                    <input type="text" name="edit_tch_uid" value="<?= $tchUid?>"><br>
                    <label>Email:</label>
                    <input type="text" name="edit_tch_email" value="<?= $tchEmail?>"><br>
                    <label>Password:</label>
                    <input type="password" name="edit_tch_pwd" id="edit_tch_pwd"><br>
                    <div class="div-edit-pwd">
                            <input class="checkbox" type="checkbox" onclick="showEditTeacherPwd()">
                            <label class="show-pwd-tch">Show Password</label>
                    </div>
                    <br>
                    <div class="btn">
                        <button type="submit" name="edit_tch_submit">Edit</button><br>
                        <a class="cxlEditTeacher-btn" href="javascript:history.go(-1)"><span>Cancel</span></a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
<?php
    require "footer.php";
?>