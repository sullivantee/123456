<?php
    require "header.php";
    require "backendphp/condb_back.php";

    if ($_SESSION['userType'] == "student") {
        $stdID = $_SESSION['idUser'];

        $sql = mysqli_query($conn, "SELECT * FROM student_score WHERE studentID = '$stdID'");
        $row = mysqli_num_rows($sql);
        $course = "";

        while($row = mysqli_fetch_array($sql)){
            $course .= "'" . $row['subjectID'] . " " . $row['subjectName'] . " " . $row['courseYear'] . " " . $row['courseMonth'] . "',";
        }

        $course = substr($course, 0, -1);
    }
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="teacher-main">
                <label class="teacher-label">Teachers</label>
                <?php
                    if ($_SESSION['userType'] == "admin") {
                        echo "<a class='addTeacher-btn' href='manageUser.php'><span>Add Teacher</span></a>";
                    }

                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "success") {
                            echo "<label class='teacher-delete'>Delete Success</label>";
                        }
                    }
                ?>
                <table class="table table-striped table-bordered teacherDatatable">
                    <thead>
                        <tr>
                            <th>Teacher ID</th>
                            <th>Teacher Name</th>
                            <th>Teacher Username</th>
                            <th>Teacher Email</th>
                            <th>Subject</th>
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
                            if ($_SESSION['userType'] == "admin" || $_SESSION['userType'] == "teacher") {
                                $sql = mysqli_query($conn, "SELECT * FROM teacher ORDER BY 'No' ASC");
                            }
                            else if ($_SESSION['userType'] == "student") {
                                if ($course != "") {
                                    $sql = mysqli_query($conn, "SELECT DISTINCT 
                                                                teacher.teacherID, 
                                                                teacher.teacherName, 
                                                                teacher.teacherUid, 
                                                                teacher.teacherEmail
                                                                FROM teacher INNER JOIN teacher_subject
                                                                ON teacher.teacherID = teacher_subject.teacherID
                                                                WHERE teacher_subject.teacherSubject IN ($course)");
                                }
                                else{
                                    $sql = mysqli_query($conn, "SELECT * FROM teacher ORDER BY 'No' ASC");
                                }
                            }

                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['teacherID'] . "</td>";
                                echo "<td>" . $row['teacherName'] . "</td>";
                                echo "<td>" . $row['teacherUid'] . "</td>";
                                echo "<td>" . $row['teacherEmail'] . "</td>";
                                echo "<td><a href='teacherSubject.php?tchID=" . $row['teacherID'] . "'>View</a></td>";
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<td><a href='editTeacher.php?tchID=" . $row['teacherID'] . "'>Edit</a></td>";
                                    echo "<td><a href='backendphp/deleteTeacher-back.php?tchID=" . $row['teacherID'] . "' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.teacherDatatable').DataTable({
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