<?php
    require "header.php";
    require "backendphp/condb_back.php";

    $stdID = $_GET['stdID'];
    
    $sql = mysqli_query($conn, "SELECT * FROM student WHERE studentID = '$stdID'");
    $row = mysqli_num_rows($sql);
    $row = mysqli_fetch_array($sql);

    $stdUid = $row['studentUid'];
    $stdName = $row['studentName'];
    $courseID = $row['studentCourse'];
    $year = $row['studentYear'];
    $month = $row['studentMonth'];

    if ($_SESSION['userType'] == "teacher") {
        $tchID = $_SESSION['idUser'];

        $sql = mysqli_query($conn, "SELECT teacherSubject FROM teacher_subject WHERE teacherID = '$tchID'");
        $row = mysqli_num_rows($sql);
        $tchCourseID = "";
        $tchSubjectID = "";
        $tchYear = "";
        $tchMonth = "";

        while($row = mysqli_fetch_array($sql)){
            $tchCourseID .= "'" . substr($row['teacherSubject'], 0, 4) . "',";
            $tchSubjectID .= "'" . substr($row['teacherSubject'], 0, 7) . "',";
            $tchYear .= "'" . substr($row['teacherSubject'], -8, 4) . "',";
            $tchMonth .= "'" . substr($row['teacherSubject'], -3) . "',";
        }

        $tchCourseID = substr($tchCourseID, 0, -1);
        $tchSubjectID = substr($tchSubjectID, 0, -1);
        $tchYear = substr($tchYear, 0, -1);
        $tchMonth = substr($tchMonth, 0, -1);
    }
?>

    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="studentScore-main">
                <label class="studentScore-label">Student's Subject</label>
                <label class="studentScore-ID-NAME-label" >ID :</label>
                <label class="studentScore-ID-NAME-label-bold"> <?= $stdID ?> &emsp;</label>
                <label class="studentScore-ID-NAME-label" >Name :</label>
                <label class="studentScore-ID-NAME-label-bold"> <?= $stdName ?> &emsp;</label>
                <label class="studentScore-ID-NAME-label" >Year :</label>
                <label class="studentScore-ID-NAME-label-bold"> <?= $year ?> &emsp;</label>
                <label class="studentScore-ID-NAME-label" >Month :</label>
                <label class="studentScore-ID-NAME-label-bold"> <?= $month ?> </label>
                <a class="back-btn" href="javascript:history.go(-1)"><span>Back</span></a>
                <br>
                <?php
                if ($_SESSION['userType'] == "admin") {
                    echo "<form action='backendphp/addStudentSubject-back.php?stdID=$stdID&stdName=$stdName&year=$year&month=$month' method='post'>";
                    echo "<label>Available Subjects :</label>";
                    echo "<select name='add_student_subject'>";
                    echo "<option value=''>-SELECT-SUBJECT-</option>";
                    $sql = mysqli_query($conn, "SELECT * From subject WHERE courseID = '$courseID' AND subjectYear = '$year' AND subjectMonth = '$month'");
                    $row = mysqli_num_rows($sql);
                    while ($row = mysqli_fetch_array($sql)){
                        $subjectFull = $row['subjectID'] . " " . $row['subjectName'] . " " . $row['subjectYear'] . " " . $row['subjectMonth'];
                        echo "<option value='" . $subjectFull . "'>" . $subjectFull . "</option>" ;
                    }
                    echo "</select>";
                    echo "<div class='btn'>";
                    echo "<button type='submit' name='add_student_subject_submit'>Add</button><br>";
                    echo "</div>";
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyfields") {
                            echo "<label class='teacherSubject-error'>No Subject Selected</label>";
                        }
                        else if ($_GET['error'] == "invalid") {
                            echo "<label class='teacherSubject-error'>Invalid</label>";
                        }
                        else if ($_GET['error'] == "taken") {
                            echo "<label class='teacherSubject-error'>Subject Taken</label>";
                        }
                        else if ($_GET['error'] == "mysqlerror") {
                            echo "<label class='teacherSubject-error'>Error</label>";
                        }
                    }else if (isset($_GET['addStudentSubject'])) {
                        if ($_GET['addStudentSubject'] == "success") {
                            echo "<label class='teacherSubject-success'>Subject Added</label>";
                        }
                    }else if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "success") {
                            echo "<label class='teacherSubject-success'>Delete Subject Success</label>";
                        }
                    }
                    echo "</form>";
                }
                ?>
                <table class="table table-striped table-bordered studentScoreDatatable">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Total Score</th>
                            <th>Your Score</th>
                            <th>Grade</th>
                            <?php
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<th>Edit</th>";
                                    echo "<th>Delete</th>";
                                }
                                else if ($_SESSION['userType'] == "teacher" && ($tchSubjectID != "" || $tchYear != "" || $tchMonth != "")) {
                                    echo "<th>Edit</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($_SESSION['userType'] == "admin" || $_SESSION['userType'] == "student") {
                                $sql = mysqli_query($conn, "SELECT * FROM student_score WHERE studentID = '$stdID'");
                            }
                            else if ($_SESSION['userType'] == "teacher") {
                                if ($tchSubjectID != "" || $tchYear != "" || $tchMonth != "") {
                                    $sql = mysqli_query($conn, "SELECT * FROM student_score WHERE studentID = '$stdID' AND subjectID IN ($tchSubjectID) AND courseYear IN ($tchYear) AND courseMonth IN ($tchMonth)");
                                }
                                else {
                                    $sql = mysqli_query($conn, "SELECT * FROM student_score WHERE studentID = '$stdID'");
                                }
                            }
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['subjectID'] . " " . $row['subjectName'] . "</td>";
                                echo "<td>" . $row['subjectTotalScore'] . "</td>";
                                echo "<td>" . $row['studentScore'] . "</td>";
                                echo "<td>" . $row['studentGrade'] . "</td>";
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<td><a href='editStudentScore.php?stdID=" . $row['studentID'] . "&subjectID=" . $row['subjectID'] . "&year=" . $year . "&month=" . $month . "'>Edit</a></td>";
                                    echo "<td><a href='backendphp/deleteStudentScore-back.php?stdID=" . $row['studentID'] . "&subjectID=" . $row['subjectID']. "&year=" . $year . "&month=" . $month . "' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                                }
                                else if ($_SESSION['userType'] == "teacher" && ($tchSubjectID != "" || $tchYear != "" || $tchMonth != "")) {
                                    echo "<td><a href='editStudentScore.php?stdID=" . $row['studentID'] . "&subjectID=" . $row['subjectID'] . "&year=" . $year . "&month=" . $month . "'>Edit</a></td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.studentScoreDatatable').DataTable({
                "bLengthChange" : false,
                "pageLength": 6,
                "scrollY": 350,
                "paging": false,
                "info": false,
                "searching": false
            });
        </script>
    </main>

<?php
    require "footer.php";
?>