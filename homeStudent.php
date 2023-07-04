<?php
    require "header.php";
    require "backendphp/condb_back.php";

    $stdID = $_SESSION['idUser'];

    $sql = mysqli_query($conn, "SELECT * FROM student WHERE studentID = '$stdID'");
    $row = mysqli_num_rows($sql);
    $row = mysqli_fetch_array($sql);

    $stdName = $row['studentName'];
    $stdUid = $row['studentUid'];
    $stdEmail = $row['studentEmail'];
    $course = $row['studentCourse'] . " " . $row['studentYear'] . " " . $row['studentMonth'];
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="homeStudent-main">
                <label class="homeStudent-label">Home</label>
                <div class="homeStudent-span">
                    <div class="homeStudent-labels-secondary">
                        <label class="homeStudent-ID-NAME-label" >ID :</label>
                        <label class="homeStudent-ID-NAME-label-bold"> <?= $stdID ?> &emsp;</label>
                    </div>
                    <div class="homeStudent-labels-secondary">
                        <label class="homeStudent-ID-NAME-label" >Name :</label>
                        <label class="homeStudent-ID-NAME-label-bold"> <?= $stdName ?> &emsp;</label>
                    </div>
                    <div class="homeStudent-labels-secondary">
                        <label class="homeStudent-ID-NAME-label" >Uid :</label>
                        <label class="homeStudent-ID-NAME-label-bold"> <?= $stdUid ?> &emsp;</label>
                    </div>
                    <div class="homeStudent-labels-secondary">
                        <label class="homeStudent-ID-NAME-label" >Course :</label>
                        <label class="homeStudent-ID-NAME-label-bold"> <?= $course ?> &emsp;</label>
                    </div>
                </div>
                
                <table class="table table-striped table-bordered homeStudentDatatable">
                    <thead>
                        <tr>
                            <th>Subject ID</th>
                            <th>Subject Name</th>
                            <th>Total Score</th>
                            <th>Your Score</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM student_score WHERE studentID = $stdID");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['subjectID'] . "</td>";
                                echo "<td>" . $row['subjectName'] . "</td>";
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
            $('.homeStudentDatatable').DataTable({
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