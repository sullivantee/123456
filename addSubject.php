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
            <label class="addSubject-label">Add Subject</label>
            <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyfields") {
                        echo "<label class='addSubject-error'>Fill in all Fields !</label>";
                    }
                    else if ($_GET['error'] == "invalid") {
                        echo "<label class='addSubject-error'>Invalid Format</label>";
                    }
                    else if ($_GET['error'] == "invaildID") {
                        echo "<label class='addSubject-error'>Invalid ID</label>";
                    }
                    else if ($_GET['error'] == "invaildName") {
                        echo "<label class='addSubject-error'>Invalid Name</label>";
                    }
                    else if ($_GET['error'] == "invaildYear") {
                        echo "<label class='addSubject-error'>Invalid Year</label>";
                    }
                    else if ($_GET['error'] == "invaildMonth") {
                        echo "<label class='addSubject-error'>Invalid Month</label>";
                    }
                    else if ($_GET['error'] == "taken") {
                        echo "<label class='addSubject-error'>Subject Has Already Been Taken</label>";
                    }
                    else if ($_GET['error'] == "mysqlerror") {
                        echo "<label class='addSubject-error'>Error</label>";
                    }
                }
                else if (isset($_GET['addSubject'])) {
                    if ($_GET['addSubject'] == "success") {
                        echo "<label class='addSubject-success'>Add Subject Success</label>";
                    }
                }
            ?>
            <div class="addSubject-main">
                <form action="backendphp/addSubject-back.php" method="post">
                    <label>Course</label>
                    <select name="add_subject_course">
                        <option value="">-SELECT-COURSE-</option>
                        <?php
                            $sql = mysqli_query($conn, "SELECT courseID, courseYear, courseMonth From course ORDER BY courseYear ASC, courseMonth ASC");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                $selectedCourse = $row['courseID'] . " " . $row['courseYear'] . " " . $row['courseMonth'];
                                echo "<option value='". $selectedCourse ."'>" . $selectedCourse ."</option>" ;
                            }
                        ?>
                    </select>
                    <br>
                    <label>Subject ID</label>
                    <input type="text" name="add_subject_id" maxlength="3"><br>
                    <label>Subject Name</label>
                    <input type="text" name="add_subject_name"><br>
                    <label>Total Score</label>
                    <input type="number" name="add_subject_total_score" min="40" max="100"><br>
                    <div class="btn">
                        <button type="submit" name="add_subject_submit">Add</button><br>
                        <a class="cxlAddSubject-btn" href="javascript:history.go(-1)"><span>Cancel</span></a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
<?php
    require "footer.php";
?>