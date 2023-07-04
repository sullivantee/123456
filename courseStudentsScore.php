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
?>

    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="courseStudentsScore-main">
                <label class="courseStudentsScore-label">Student's Subject</label>
                <label class="courseStudentsScore-ID-NAME-label" >ID :</label>
                <label class="courseStudentsScore-ID-NAME-label-bold"> <?= $stdID ?> &emsp;</label>
                <label class="courseStudentsScore-ID-NAME-label" >Name :</label>
                <label class="courseStudentsScore-ID-NAME-label-bold"> <?= $stdName ?> &emsp;</label>
                <label class="courseStudentsScore-ID-NAME-label" >Year :</label>
                <label class="courseStudentsScore-ID-NAME-label-bold"> <?= $year ?> &emsp;</label>
                <label class="courseStudentsScore-ID-NAME-label" >Month :</label>
                <label class="courseStudentsScore-ID-NAME-label-bold"> <?= $month ?> </label>
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
                    echo "</form>";
                }
                ?>
                <table class="table table-striped table-bordered courseStudentsScoreDatatable">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Total Score</th>
                            <th>Your Score</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM student_score WHERE studentID = '$stdID'");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['subjectID'] . " " . $row['subjectName'] . "</td>";
                                echo "<td>" . $row['subjectTotalScore'] . "</td>";
                                echo "<td>" . $row['studentScore'] . "</td>";
                                echo "<td>" . $row['studentGrade'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.courseStudentsScoreDatatable').DataTable({
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