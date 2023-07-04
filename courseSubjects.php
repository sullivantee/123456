<?php
    require "header.php";
    require "backendphp/condb_back.php";

    $courseID = $_GET['courseID'];
    $year = $_GET['year'];
    $month = $_GET['month'];

    $sql = mysqli_query($conn, "SELECT * FROM subject WHERE courseID = '$courseID' AND subjectYear = '$year' AND subjectMonth = '$month'");
    $row = mysqli_num_rows($sql);
    while($row = mysqli_fetch_array($sql)){
        $subjectID = $row['subjectID'];
        $subjectTotal = $row['subjectTotalScore'];
    }
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="courseSubject-main">
                <label class="courseSubject-label"><?= $courseID." ".$year." ".$month." "?>'s Subjects</label>
                <a class="back-btn" href="javascript:history.go(-1)"><span>Back</span></a>
                <?php
                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "success") {
                            echo "<label class='subejctStudents-delete'>Delete Success</label>";
                        }
                    }
                ?>
                <table class="table table-striped table-bordered courseSubjectDatatable">
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Subject ID</th>
                            <th>Subject Name</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Total Score</th>
                            <th>Students</th>
                            <?php
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<th>Delete</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM subject WHERE courseID = '$courseID' AND subjectYear = '$year' AND subjectMonth = '$month'  ORDER BY 'No' ASC");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['courseID'] . "</td>";
                                echo "<td>" . $row['subjectID'] . "</td>";
                                echo "<td>" . $row['subjectName'] . "</td>";
                                echo "<td>" . $row['subjectYear'] . "</td>";
                                echo "<td>" . $row['subjectMonth'] . "</td>";
                                echo "<td>" . $row['subjectTotalScore'] . "</td>";
                                echo "<td><a href='subjectStudents.php?subjectID=" . $row['subjectID'] . "&year=".$row['subjectYear']. "&month=" . $row['subjectMonth'] . "'>View</a></td>";
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<td><a href='backendphp/deleteCourseSubjects-back.php?courseID=" . $row['courseID'] . "&subjectID=" . $row['subjectID'] . "&year=".$row['subjectYear']. "&month=" . $row['subjectMonth'] . "' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.courseSubjectDatatable').DataTable({
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