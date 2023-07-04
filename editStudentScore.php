<?php
    require "header.php";
    require "backendphp/condb_back.php";
    if ($_SESSION['userType'] != "admin" && $_SESSION['userType'] != "teacher") {
        header("Location: javascript:history.go(-1)");
        die();
    }

    $stdID = $_GET['stdID'];
    $subjectID = $_GET['subjectID'];
    $year = $_GET['year'];
    $month = $_GET['month'];

    $sql = mysqli_query($conn, "SELECT * FROM student_score WHERE studentID = '$stdID' AND subjectID = '$subjectID' 
                                AND courseYear = '$year' AND courseMonth = '$month'");
    $row = mysqli_num_rows($sql);
    $row = mysqli_fetch_array($sql);

    $stdName = $row['studentName'];
    $subjectName = $row['subjectName'];
    $subjectTotal = $row['subjectTotalScore'];
    $studentTotal = $row['studentScore'];
?>

    <main ng-app>
        <div class="content"  ng-controller="Test">
        <!-- MADE BY TEE FU ZHEN -->
            <div class="editStudentScore-main">
                <label class="editStudentScore-label"><?= $subjectID?></label>
                <label class="editStudentScore-ID-NAME-label" >Student ID :</label>
                <label class="editStudentScore-ID-NAME-label-bold"> <?= $stdID ?> &emsp;</label>
                <label class="editStudentScore-ID-NAME-label" >Name :</label>
                <label class="editStudentScore-ID-NAME-label-bold"> <?= $stdName ?> &emsp;</label>
                <label class="editStudentScore-ID-NAME-label" >Year :</label>
                <label class="editStudentScore-ID-NAME-label-bold"> <?= $year ?> &emsp;</label>
                <label class="editStudentScore-ID-NAME-label" >Month :</label>
                <label class="editStudentScore-ID-NAME-label-bold"> <?= $month ?> </label>
                <a class="back-btn" href="javascript:history.go(-1)"><span>Back</span></a>

                <form action="backendphp/editStudentScore-back.php?stdID=<?= $stdID?>&subjectID=<?= $subjectID?>&year=<?= $year?>&month=<?= $month?>&total=<?= $subjectTotal?>" method="post">
                    <label class="Score-label">Total Score:</label>
                    <label><?= $subjectTotal?></label><br>
                    <label class="Score-label">Student Score:</label>
                    <input type="number" name="edit_std_score_total" min="0" max="<?=$subjectTotal?>" value="<?= $studentTotal?>">
                    <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == "emptyfields") {
                                echo "<label class='editStudentScore-error'>Fill in Score</label>";
                            }
                            else if ($_GET['error'] == "invalid") {
                                echo "<label class='editStudentScore-error'>Invalid</label>";
                            }
                            else if ($_GET['error'] == "mysqlerror") {
                                echo "<label class='editStudentScore-error'>Error</label>";
                            }
                        }else if (isset($_GET['editStudentScore'])) {
                            if ($_GET['editStudentScore'] == "success") {
                                echo "<label class='editStudentScore-success'>Edit Score Success</label>";
                            }
                        }
                    ?>
                    <br>
                    <br>
                    <div class="btn">
                        <button type="submit" name="edit_std_score_submit">Edit</button><br>
                        <a class="cxlEditStudentScore-btn" href="javascript:history.go(-1)"><span>Cancel</span></a>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php
    require "footer.php";
?>