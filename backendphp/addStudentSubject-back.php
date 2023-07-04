<?php
if (isset($_POST['add_student_subject_submit'])) {

    require 'condb_back.php';

    $stdID = $_GET['stdID'];
    $stdName = $_GET['stdName'];
    $year = $_GET['year'];
    $month = $_GET['month'];

    $selected = $_POST['add_student_subject'];

    $courseID = substr($selected, 0, 4);
    $subjectID = substr($selected, 0, 7);
    $subjectName = substr($selected, 8, -9);

    if (empty($selected)) {
        header("Location: ../studentScore.php?error=emptyfields&stdID=".$stdID);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9_ -]*$/", $selected)) {
        header("Location: ../studentScore.php?error=invalid&stdID=".$stdID);
        exit();
    }
    else {
        $sql = "SELECT subjectID FROM student_score WHERE studentID=? AND subjectID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../studentScore.php?error=mysqlerror&stdID=".$stdID);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $stdID, $subjectID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../studentScore.php?error=taken&stdID=".$stdID);
                exit();
            }
            else {
                $sql = mysqli_query($conn, "SELECT subjectTotalScore From subject WHERE subjectID = '$subjectID' AND subjectYear = '$year' AND subjectMonth = '$month'");
                $row = mysqli_num_rows($sql);

                $subjectTotalScore = 0;

                while($row = mysqli_fetch_array($sql)){
                    $subjectTotalScore = $row['subjectTotalScore'];
                }
                
                $score = 0;
                $grade = "N/A";

                $sql = "INSERT INTO student_score (courseID, courseYear, courseMonth, studentID, studentName, subjectID, subjectName, 
                        subjectTotalScore, studentScore, studentGrade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../studentScore.php?error=mysqlerror&stdID=".$stdID);
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "sisssssiis", $courseID, $year, $month, $stdID, $stdName, $subjectID, $subjectName, $subjectTotalScore, $score, $grade);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../studentScore.php?addStudentSubject=success&stdID=".$stdID);
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../studentScore.php");
    exit();
}