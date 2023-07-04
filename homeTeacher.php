<?php
    require "header.php";
    require "backendphp/condb_back.php";

    $tchID = $_SESSION['idUser'];

    $sql = mysqli_query($conn, "SELECT * FROM teacher WHERE teacherID = '$tchID'");
    $row = mysqli_num_rows($sql);
    $row = mysqli_fetch_array($sql);

    $tchName = $row['teacherName'];
    $tchUid = $row['teacherUid'];
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="homeTeacher-main">
                <label class="homeTeacher-label">Home</label>
                <div class="homeTeacher-span">
                    <div class="homeTeacher-labels-secondary">
                        <label class="homeTeacher-ID-NAME-label" >ID :</label>
                        <label class="homeTeacher-ID-NAME-label-bold"> <?= $tchID ?>&emsp;</label>
                    </div>
                    <div class="homeTeacher-labels-secondary">
                        <label class="homeTeacher-ID-NAME-label" >Name :</label>
                        <label class="homeTeacher-ID-NAME-label-bold"> <?= $tchName ?>&emsp;</label>
                    </div>
                    <div class="homeTeacher-labels-secondary">
                        <label class="homeTeacher-ID-NAME-label" >Uid :</label>
                        <label class="homeTeacher-ID-NAME-label-bold"> <?= $tchUid ?>&emsp;</label>
                    </div>
                </div>
                <table class="table table-striped table-bordered homeTeacherDatatable">
                    <thead>
                        <tr>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM teacher_subject WHERE teacherID = '$tchID'");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['teacherSubject'] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.homeTeacherDatatable').DataTable({
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