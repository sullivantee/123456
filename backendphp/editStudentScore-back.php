<?php
if (isset($_POST['edit_std_score_submit'])) {

    require 'condb_back.php';

    $stdID = $_GET['stdID'];
    $subjectID = $_GET['subjectID'];
    $year = $_GET['year'];
    $month = $_GET['month'];
    $total = $_GET['total'];

    $studentScore = $_POST['edit_std_score_total'];
    $calStudentScore = ($studentScore / $total) * 100;

    if (empty($studentScore) && $studentScore < 0) {
        header("Location: ../editStudentScore.php?error=emptyfields&stdID=".$stdID."&subjectID=".$subjectID."&year=".$year."&month=".$month);
        exit();
    }
    elseif (!preg_match("/^[0-9]*$/", $studentScore)) {
        header("Location: ../editStudentScore.php?error=invalid&stdID=".$stdID."&subjectID=".$subjectID."&year=".$year."&month=".$month);
        exit();
    }
    else {
        $sql = "UPDATE student_score SET studentScore=?, studentGrade=? WHERE studentID = ? AND subjectID = ? AND courseYear = ? AND courseMonth = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../editStudentScore.php?error=mysqlerror&stdID=".$stdID."&subjectID=".$subjectID."&year=".$yaer."&month=".$month);
                exit();
            }
            else {
                $grade = "";
                if ($calStudentScore < 40) {
                    $grade = "Failed";
                }
                else if ($calStudentScore >= 40 && $calStudentScore < 50) {
                    $grade = "E";
                }
                else if ($calStudentScore >= 50 && $calStudentScore < 60) {
                    $grade = "D";
                }
                else if ($calStudentScore >= 60 && $calStudentScore < 70) {
                    $grade = "C";
                }
                else if ($calStudentScore >= 70 && $calStudentScore < 80) {
                    $grade = "B";
                }
                else if ($calStudentScore >= 80 && $calStudentScore < 90) {
                    $grade = "A";
                }
                else if ($calStudentScore >= 90) {
                    $grade = "A+";
                }
                mysqli_stmt_bind_param($stmt, "isssis", $studentScore, $grade, $stdID, $subjectID, $year, $month);
                mysqli_stmt_execute($stmt);
                header("Location: ../editStudentScore.php?editStudentScore=success&stdID=".$stdID."&subjectID=".$subjectID."&year=".$year."&month=".$month);
                exit();
            }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../teacherSubject.php");
    exit();
}