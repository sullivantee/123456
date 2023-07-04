<?php
    require "header.php";
    require "backendphp/condb_back.php";
    if ($_SESSION['userType'] != "admin") {
        header("Location: javascript:history.go(-1)");
        die();
    }
?>

    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <label class="manageUser-label">Manage Users</label>
            <?php
            if (isset($_GET['errorAdmin'])) {
                if ($_GET['errorAdmin'] == "emptyfields") {
                    echo "<label class='manageUser-error'>Admin: Fill in all Fields !</label>";
                }
                else if ($_GET['errorAdmin'] == "invalid") {
                    echo "<label class='manageUser-error'>Admin: Invalid Format</label>";
                }
                else if ($_GET['errorAdmin'] == "invaildID") {
                    echo "<label class='manageUser-error'>Admin: Invalid ID</label>";
                }
                else if ($_GET['errorAdmin'] == "invaildName") {
                    echo "<label class='manageUser-error'>Admin: Invalid Name</label>";
                }
                else if ($_GET['errorAdmin'] == "invaildUid") {
                    echo "<label class='manageUser-error'>Admin: Invalid Username</label>";
                }
                else if ($_GET['errorAdmin'] == "invaildMail") {
                    echo "<label class='manageUser-error'>Admin: Invalid Email</label>";
                }
                else if ($_GET['errorAdmin'] == "taken") {
                    echo "<label class='manageUser-error'>Admin: ID or Username Has Already Been Taken</label>";
                }
                else if ($_GET['errorAdmin'] == "mysqlerror") {
                    echo "<label class='manageUser-error'>Admin: Error</label>";
                }
            }
            else if (isset($_GET['errorTeacher'])) {
                if ($_GET['errorTeacher'] == "emptyfields") {
                    echo "<label class='manageUser-error'>Teacher: Fill in all Fields !</label>";
                }
                else if ($_GET['errorTeacher'] == "invalid") {
                    echo "<label class='manageUser-error'>Teacher: Invalid Format</label>";
                }
                else if ($_GET['errorTeacher'] == "invaildID") {
                    echo "<label class='manageUser-error'>Teacher: Invalid ID</label>";
                }
                else if ($_GET['errorTeacher'] == "invaildName") {
                    echo "<label class='manageUser-error'>Teacher: Invalid Name</label>";
                }
                else if ($_GET['errorTeacher'] == "invaildUid") {
                    echo "<label class='manageUser-error'>Teacher: Invalid Username</label>";
                }
                else if ($_GET['errorTeacher'] == "invaildMail") {
                    echo "<label class='manageUser-error'>Teacher: Invalid Email</label>";
                }
                else if ($_GET['errorTeacher'] == "taken") {
                    echo "<label class='manageUser-error'>Teacher: ID or Username Has Already Been Taken</label>";
                }
                else if ($_GET['errorTeacher'] == "mysqlerror") {
                    echo "<label class='manageUser-error'>Teacher: Error</label>";
                }
            }
            else if (isset($_GET['errorStudent'])) {
                if ($_GET['errorStudent'] == "emptyfields") {
                    echo "<label class='manageUser-error'>Student: Fill in all Fields !</label>";
                }
                else if ($_GET['errorStudent'] == "invalid") {
                    echo "<label class='manageUser-error'>Student: Invalid Format</label>";
                }
                else if ($_GET['errorStudent'] == "invaildID") {
                    echo "<label class='manageUser-error'>Student: Invalid ID</label>";
                }
                else if ($_GET['errorStudent'] == "invaildName") {
                    echo "<label class='manageUser-error'>Student: Invalid Name</label>";
                }
                else if ($_GET['errorStudent'] == "invaildUid") {
                    echo "<label class='manageUser-error'>Student: Invalid Username</label>";
                }
                else if ($_GET['errorStudent'] == "invaildMail") {
                    echo "<label class='manageUser-error'>Student: Invalid Email</label>";
                }
                else if ($_GET['errorStudent'] == "invaildDDL") {
                    echo "<label class='manageUser-error'>Student: Invalid Course</label>";
                }
                else if ($_GET['errorStudent'] == "taken") {
                    echo "<label class='manageUser-error'>Student: ID or Username Has Already Been Taken</label>";
                }
                else if ($_GET['errorStudent'] == "mysqlerror") {
                    echo "<label class='manageUser-error'>Student: Error</label>";
                }
            }
            else if (isset($_GET['addSuccess'])) {
                if ($_GET['addSuccess'] == "admin") {
                    echo "<label class='manageUser-success'>Admin: Add Success!</label>";
                }
                else if ($_GET['addSuccess'] == "teacher") {
                    echo "<label class='manageUser-success'>Teacher: Add Success!</label>";
                }
                else if ($_GET['addSuccess'] == "student") {
                    echo "<label class='manageUser-success'>Student: Add Success!</label>";
                }
            }
            ?>
            <div class="manageUser-main">
                <div class="forms">
                    <form action="backendphp/add-admin-back.php" method="post">
                        <label class="title">Add Admin</label><br>
                        <hr>
                        <input type="text" name="add_admin_id" placeholder="ID">
                        <input type="text" name="add_admin_name" placeholder="Name">
                        <input type="text" name="add_admin_uid" placeholder="Username">
                        <input type="text" name="add_admin_email" placeholder="Email">
                        <input type="password" name="add_admin_pwd" id="add_admin_pwd" placeholder="Password"><br>
                        <div class="div-pwd">
                            <input class="checkbox" type="checkbox" onclick="showAdminPwd()"><label>Show Password</label>
                        </div>
                        <div class="btn">
                            <button type="submit" id="add_admin_submit" name="add_admin_submit">Add</button>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="forms">
                    <form action="backendphp/add-teacher-back.php" method="post">
                        <label class="title">Add Teacher</label><br>
                        <hr>
                        <input type="text" name="add_teacher_id" placeholder="ID" maxlength="4">
                        <input type="text" name="add_teacher_name" placeholder="Name">
                        <input type="text" name="add_teacher_uid" placeholder="Username">
                        <input type="text" name="add_teacher_email" placeholder="Email">
                        <input type="password" name="add_teacher_pwd" id="add_teacher_pwd" placeholder="Password"><br>
                        <div class="div-pwd">
                            <input class="checkbox" type="checkbox" onclick="showTeacherPwd()"><label>Show Password</label>
                        </div>
                        <div class="btn">
                            <button type="submit" name="add_teacher_submit" name="add_teacher_submit">Add</button>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="forms">
                    <form action="backendphp/add-student-back.php" method="post">
                        <label class="title">Add Student</label><br>
                        <hr>
                        <input type="text" name="add_student_id" placeholder="ID" maxlength="4">
                        <input type="text" name="add_student_name" placeholder="Name">
                        <input type="text" name="add_student_uid" placeholder="Username">
                        <input type="text" name="add_student_email" placeholder="Email"><br>
                        <select name="add_student_course">
                            <option value="">-SELECT COURSE-</option>
                            <?php
                                $sql = mysqli_query($conn, "SELECT courseID, courseYear, courseMonth FROM course ORDER BY courseYear ASC, courseMonth ASC");
                                $row = mysqli_num_rows($sql);
                                while ($row = mysqli_fetch_array($sql)){
                                    $selectedCourse = $row['courseID'] . " " . $row['courseYear'] . " " . $row['courseMonth'];
                                    echo "<option value='". $selectedCourse ."'>" . $selectedCourse ."</option>" ;
                                }
                            ?>
                        </select>
                        <input type="password" name="add_student_pwd" id="add_student_pwd" placeholder="Password"><br>
                        <div class="div-pwd">
                            <input class="checkbox" type="checkbox" onclick="showStudentPwd()">
                            <label>Show Password</label>
                        </div>
                        
                        <div class="btn">
                            <button type="submit" id="add_student_submit" name="add_student_submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php
    require "footer.php";
?>