<?php
    require "header.php";
    require "backendphp/condb_back.php";

    $courseID = $_GET['courseID'];
    $year = $_GET['year'];
    $month = $_GET['month'];
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="courseStudent-main">
                <label class="courseStudent-label"><?= $courseID." ".$year." ".$month ?> Students</label>
                <a class="back-btn" href="javascript:history.go(-1)"><span>Back</span></a>
                <?php
                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "success") {
                            echo "<label class='courseStudent-delete'>Delete Success</label>";
                        }
                    }
                ?>
                <table class="table table-striped table-bordered courseStudentDatatable">
                    <thead>
                        <tr>
                            <th>Student Course</th>
                            <th>Student Year</th>
                            <th>Student Month</th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Student Username</th>
                            <th>Student Email</th>
                            <?php
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<th>Subjects</th>";
                                    echo "<th>Edit</th>";
                                    echo "<th>Delete</th>";
                                }
                                else{
                                    echo "<th>Subjects</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($conn, "SELECT * FROM student WHERE studentCourse = '$courseID' AND studentYear = '$year' AND studentMonth = '$month'");
                        $row = mysqli_num_rows($sql);
                        while ($row = mysqli_fetch_array($sql)){
                            echo "<tr>";
                            echo "<td>" . $row['studentCourse'] . "</td>";
                            echo "<td>" . $row['studentYear'] . "</td>";
                            echo "<td>" . $row['studentMonth'] . "</td>";
                            echo "<td>" . $row['studentID'] . "</td>";
                            echo "<td>" . $row['studentName'] . "</td>";
                            echo "<td>" . $row['studentUid'] . "</td>";
                            echo "<td>" . $row['studentEmail'] . "</td>";
                            if ($_SESSION['userType'] == "admin") {
                                echo "<td><a href='studentScore.php?stdID=" . $row['studentID'] . "'>View</a></td>";
                                echo "<td><a href='editStudent.php?stdID=" . $row['studentID'] . "'>Edit</a></td>";
                                echo "<td><a href='backendphp/deleteCourseStudent-back.php?stdID=" . $row['studentID'] . "&courseID=".$row['studentCourse']."&year=".$row['studentYear']."&month=".$row['studentMonth']."' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                            }
                            else{
                                echo "<td><a href='courseStudentsScore.php?stdID=" . $row['studentID'] . "'>View</a></td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.courseStudentDatatable').DataTable({
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