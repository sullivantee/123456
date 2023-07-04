<?php
    require "header.php";
    require "backendphp/condb_back.php";
    if ($_SESSION['userType'] != "admin") {
        header("Location: javascript:history.go(-1)");
        die();
    }

    $stdID = $_GET['stdID'];

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE userID = '$stdID'");
    $row = mysqli_num_rows($sql);
    $row = mysqli_fetch_array($sql);

    $stdID = $row['userID'];
    $stdUid = $row['userUid'];
    $stdName = $row['userName'];
    $stdEmail = $row['userEmail'];
?>

    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyfields") {
                        echo "<label class='editStudent-error'>Fill in all fields</label>";
                    }
                    else if ($_GET['error'] == "invalid") {
                        echo "<label class='editStudent-error'>Invalid</label>";
                    }
                    else if ($_GET['error'] == "invaildName") {
                        echo "<label class='editStudent-error'>Invalid Name</label>";
                    }
                    else if ($_GET['error'] == "invaildUid") {
                        echo "<label class='editStudent-error'>Invalid Username</label>";
                    }
                    else if ($_GET['error'] == "invaildMail") {
                        echo "<label class='editStudent-error'>Invalid Email</label>";
                    }
                    else if ($_GET['error'] == "mysqlerror") {
                        echo "<label class='editStudent-error'>Error</label>";
                    }
                    else if ($_GET['error'] == "taken") {
                        echo "<label class='editStudent-error'>Username Taken</label>";
                    }
                }else if (isset($_GET['editStudent'])) {
                    if ($_GET['editStudent'] == "success") {
                        echo "<label class='editStudent-success'>Edit Student Success</label>";
                    }
                }
            ?>
            <div class="editStudent-main">
                <label class="editStudent-label">Edit Student</label>
                <label class="editStudent-ID-NAME-label" >ID :</label>
                <label class="editStudent-ID-NAME-label-bold"> <?= $stdID ?> &emsp;</label>
                <form action="backendphp/editStudent-back.php?stdID=<?= $stdID?>" method="post">
                    <label>Name:</label>
                    <input type="text" name="edit_std_name" value="<?= $stdName?>"><br>
                    <label>Username:</label>
                    <input type="text" name="edit_std_uid" value="<?= $stdUid?>"><br>
                    <label>Email:</label>
                    <input type="text" name="edit_std_email" value="<?= $stdEmail?>"><br>
                    <label>Password:</label>
                    <input type="password" name="edit_std_pwd" id="edit_std_pwd"><br>
                    <div class="div-edit-pwd">
                            <input class="checkbox" type="checkbox" onclick="showEditStudentPwd()">
                            <label class="show-pwd-std">Show Password</label>
                    </div>
                    <br>
                    <div class="btn">
                        <button type="submit" name="edit_std_submit">Edit</button><br>
                        <a class="cxlEditStudent-btn" href="javascript:history.go(-1)"><span>Cancel</span></a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
<?php
    require "footer.php";
?>