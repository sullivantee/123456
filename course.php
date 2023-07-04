<?php
    require "header.php";
    require "backendphp/condb_back.php";
?>
    <main>
        <div class="content">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="course-main">
                <label class="course-label">Courses</label>
                <?php
                    if ($_SESSION['userType'] == "admin") {
                        echo "<a class='addCourse-btn' href='addCourse.php'><span>Add Course</span></a>";
                    }

                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == "success") {
                            echo "<label class='course-delete'>Delete Success</label>";
                        }
                    }
                ?>
                <table class="table table-striped table-bordered courseDatatable">
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Course Year</th>
                            <th>Course Month</th>
                            <?php
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<th>Subjects</th>";
                                    echo "<th>Students</th>";
                                    echo "<th>Delete</th>";
                                }
                                else if ($_SESSION['userType'] == "teacher") {
                                    echo "<th>Subjects</th>";
                                    echo "<th>Students</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($conn, "SELECT * FROM course ORDER BY 'No' ASC");
                            $row = mysqli_num_rows($sql);
                            while ($row = mysqli_fetch_array($sql)){
                                echo "<tr>";
                                echo "<td>" . $row['courseID'] . "</td>";
                                echo "<td>" . $row['courseName'] . "</td>";
                                echo "<td>" . $row['courseYear'] . "</td>";
                                echo "<td>" . $row['courseMonth'] . "</td>";
                                if ($_SESSION['userType'] == "admin") {
                                    echo "<td><a href='courseSubjects.php?courseID=".$row['courseID']."&year=".$row['courseYear']."&month=".$row['courseMonth']."'>View</a></td>";
                                    echo "<td><a href='courseStudents.php?courseID=".$row['courseID']."&year=".$row['courseYear']."&month=".$row['courseMonth']."'>View</a></td>";
                                    echo "<td><a href='backendphp/deleteCourse-back.php?courseID=" . $row['courseID']."&year=".$row['courseYear']."&month=".$row['courseMonth']."' onclick='return confirm(\"Confirm Delete ?\");'>Delete</a></td>";
                                }
                                else if ($_SESSION['userType'] == "teacher") {
                                    echo "<td><a href='courseSubjects.php?courseID=".$row['courseID']."&year=".$row['courseYear']."&month=".$row['courseMonth']."'>View</a></td>";
                                    echo "<td><a href='courseStudents.php?courseID=".$row['courseID']."&year=".$row['courseYear']."&month=".$row['courseMonth']."'>View</a></td>";
                                }
                                
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            $('.courseDatatable').DataTable({
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