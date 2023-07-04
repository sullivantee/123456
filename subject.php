<?php
    require "header.php";
    require "backendphp/condb_back.php";
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="subject-main">
                <label class="subject-label">Subjects</label>
                <?php
                    if ($_SESSION['userType'] == "admin") {
                        echo "<a class='addSubject-btn' href='addSubject.php'><span>Add Subject</span></a>";
                    }

                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "success") {
                            echo "<label class='subject-delete'>Delete Success</label>";
                        }
                    }
                ?>
                <table class="table table-striped table-bordered subjectDatatable">
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Subject ID</th>
                            <th>Subject Name</th>
                            <th>Subject Year</th>
                            <th>Subject Month</th>
                            <th>Total Score</th>
                            <?php
                                if ($_SESSION['userType'] != "student") {
                                    echo "<th>Students</th>";
                                }

                                if ($_SESSION['userType'] == "admin") {
                                    echo "<th>Delete</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM subject ORDER BY 'No' ASC");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['courseID'] . "</td>";
                                echo "<td>" . $row['subjectID'] . "</td>";
                                echo "<td>" . $row['subjectName'] . "</td>";
                                echo "<td>" . $row['subjectYear'] . "</td>";
                                echo "<td>" . $row['subjectMonth'] . "</td>";
                                echo "<td>" . $row['subjectTotalScore'] . "</td>";
                                if ($_SESSION['userType'] != "student") {
                                    echo "<td><a href='subjectStudents.php?subjectID=" . $row['subjectID'] . "&year=".$row['subjectYear']. "&month=" . $row['subjectMonth'] . "'>View</a></td>";
                                }
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<td><a href='backendphp/deleteSubject-back.php?subjectID=" . $row['subjectID'] . "&year=".$row['subjectYear']. "&month=" . $row['subjectMonth'] . "' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.subjectDatatable').DataTable({
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