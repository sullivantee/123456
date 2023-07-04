<?php
    require "header.php";
    require "backendphp/condb_back.php";

    $tchID = $_GET['tchID'];
    
    $sql = mysqli_query($conn, "SELECT * FROM teacher WHERE teacherID = '$tchID'");
    $row = mysqli_num_rows($sql);
    $row = mysqli_fetch_array($sql);

    $tchUid = $row['teacherUid'];
    $tchName = $row['teacherName'];
?>

    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="teacherSubject-main">
                <label class="teacherSubject-label">Teacher's Subject</label>
                <label class="teacherSubject-ID-NAME-label" >Teacher ID :</label>
                <label class="teacherSubject-ID-NAME-label-bold"> <?= $tchID ?> &emsp;</label>
                <label class="teacherSubject-ID-NAME-label" >Teacher Name :</label>
                <label class="teacherSubject-ID-NAME-label-bold"> <?= $tchName ?> </label>
                <a class="back-btn" href="javascript:history.go(-1)"><span>Back</span></a>
                <br>
                <?php
                    if ($_SESSION['userType'] == "admin") {
                        echo    "<form action='backendphp/addTeacherSubject-back.php?tchID=".$tchID."&tchUid=".$tchUid."&tchName=".$tchName."' method='post'>";
                        echo    "<label>Available Subjects :</label>";
                        echo    "<select name='add_teacher_subject'>";
                        echo    "<option value=''>-SELECT-SUBJECT-</option>";
                                $sql = mysqli_query($conn, "SELECT * From subject");
                                $row = mysqli_num_rows($sql);
                                while ($row = mysqli_fetch_array($sql)){
                                    $subjectFull = $row['subjectID'] . " " . $row['subjectName'] . " " . $row['subjectYear'] . " " . $row['subjectMonth'];
                                    echo "<option value='" . $subjectFull . "'>" . $subjectFull . "</option>" ;
                                }
                        echo    "</select>";
                        echo    "<div class='btn'>";
                        echo    "<button type='submit' name='add_teacher_subject_submit'>Add</button><br>";
                        echo    "</div>";
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
                        }else if (isset($_GET['addTeacherSubject'])) {
                            if ($_GET['addTeacherSubject'] == "success") {
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
                <table class="table table-striped table-bordered teacherSubjectDatatable">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <?php
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<th>Delete</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM teacher_subject WHERE teacherID = '$tchID'");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['teacherSubject'] . "</td>";
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<td><a href='backendphp/deleteTeacherSubject-back.php?tchID=" . $row['teacherID'] . "&subjectID=" . $row['teacherSubject'] . "' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.teacherSubjectDatatable').DataTable({
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