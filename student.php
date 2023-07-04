<?php
    require "header.php";
    require "backendphp/condb_back.php";
    if ($_SESSION['userType'] == "teacher") {
        $tchID = $_SESSION['idUser'];

        $sql = mysqli_query($conn, "SELECT teacherSubject FROM teacher_subject WHERE teacherID = '$tchID'");
        $row = mysqli_num_rows($sql);
        $courseID = "";
        $subjectID = "";
        $year = "";
        $month = "";

        while($row = mysqli_fetch_array($sql)){
            $courseID .= "'" . substr($row['teacherSubject'], 0, 4) . "',";
            $subjectID .= "'" . substr($row['teacherSubject'], 0, 7) . "',";
            $year .= "'" . substr($row['teacherSubject'], -8, 4) . "',";
            $month .= "'" . substr($row['teacherSubject'], -3) . "',";
        }

        $courseID = substr($courseID, 0, -1);
        $subjectID = substr($subjectID, 0, -1);
        $year = substr($year, 0, -1);
        $month = substr($month, 0, -1);
    }
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="student-main">
                <label class="student-label">Students</label>
                <?php
                    if ($_SESSION['userType'] == "admin") {
                        echo "<a class='addStudent-btn' href='manageUser.php'><span>Add Student</span></a>";
                    }

                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "success") {
                            echo "<label class='student-delete'>Delete Success</label>";
                        }
                    }
                ?>
                <table class="table table-striped table-bordered studentDatatable">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Student Username</th>
                            <th>Student Email</th>
                            <th>Student Course</th>
                            <th>Student Year</th>
                            <th>Student Month</th>
                            <th>Subjects</th>
                            <?php
                            if ($_SESSION['userType'] == "admin") {
                                echo "<th>Edit</th>";
                                echo "<th>Delete</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($_SESSION['userType'] == "admin" || $_SESSION['userType'] == "student") {
                                $sql = mysqli_query($conn, "SELECT * FROM student");
                            }
                            else if ($_SESSION['userType'] == "teacher") {
                                if ($courseID != "" || $year != "" || $month != "") {
                                    $sql = mysqli_query($conn, "SELECT * FROM student WHERE studentCourse IN ($courseID) AND studentYear IN ($year) AND studentMonth IN ($month)");
                                }
                                else{
                                    $sql = mysqli_query($conn, "SELECT * FROM student");
                                }
                            }

                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['studentID'] . "</td>";
                                echo "<td>" . $row['studentName'] . "</td>";
                                echo "<td>" . $row['studentUid'] . "</td>";
                                echo "<td>" . $row['studentEmail'] . "</td>";
                                echo "<td>" . $row['studentCourse'] . "</td>";
                                echo "<td>" . $row['studentYear'] . "</td>";
                                echo "<td>" . $row['studentMonth'] . "</td>";
                                echo "<td><a href='studentScore.php?stdID=" . $row['studentID'] . "'>View</a></td>";
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<td><a href='editStudent.php?stdID=" . $row['studentID'] . "'>Edit</a></td>";
                                    echo "<td><a href='backendphp/deleteStudent-back.php?stdID=" . $row['studentID'] . "' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.studentDatatable').DataTable({
                "bLengthChange" : false,
                "pageLength": 6,
                "scrollY": 350,
                "paging": false,
                "info": false
            });
        </script>
    </main>
<?php
    require "footer.php";
?>