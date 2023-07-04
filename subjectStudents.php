<?php
    require "header.php";
    require "backendphp/condb_back.php";

    $subjectID = $_GET['subjectID'];
    $year = $_GET['year'];
    $month = $_GET['month'];
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="subejctStudents-main">
                <label class="subejctStudents-label"><?= $subjectID." ".$year." ".$month ?> Students</label>
                <a class="back-btn" href="javascript:history.go(-1)"><span>Back</span></a>
                <?php
                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "success") {
                            echo "<label class='subejctStudents-delete'>Delete Success</label>";
                        }
                    }
                ?>
                <table class="table table-striped table-bordered subejctStudentsDatatable">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Subject ID</th>
                            <th>Subject Name</th>
                            <th>Subject Total</th>
                            <th>Student Total</th>
                            <th>Grade</th>
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
                        $sql = mysqli_query($conn, "SELECT * FROM student_score WHERE subjectID = '$subjectID' AND courseYear = '$year' AND courseMonth = '$month'");
                        $row = mysqli_num_rows($sql);
                        while ($row = mysqli_fetch_array($sql)){
                            echo "<tr>";
                            echo "<td>" . $row['studentID'] . "</td>";
                            echo "<td>" . $row['studentName'] . "</td>";
                            echo "<td>" . $row['subjectID'] . "</td>";
                            echo "<td>" . $row['subjectName'] . "</td>";
                            echo "<td>" . $row['subjectTotalScore'] . "</td>";
                            echo "<td>" . $row['studentScore'] . "</td>";
                            echo "<td>" . $row['studentGrade'] . "</td>";
                            if ($_SESSION['userType'] == "admin") {
                                echo "<td><a href='studentScore.php?stdID=" . $row['studentID'] . "'>View</a></td>";
                                echo "<td><a href='backendphp/deleteSubjectStudent-back.php?stdID=" . $row['studentID'] . "&subjectID=". $row['subjectID'] . "&year=". $year . "&month=". $month . "' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.subejctStudentsDatatable').DataTable({
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