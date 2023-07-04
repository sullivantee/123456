<?php
if (isset($_POST['add_teacher_subject_submit'])) {

    require 'condb_back.php';

    $tchID = $_GET['tchID'];
    $tchUid = $_GET['tchUid'];
    $tchName = $_GET['tchName'];

    $selected = $_POST['add_teacher_subject'];

    if (empty($selected)) {
        header("Location: ../teacherSubject.php?&error=emptyfields&tchID=".$tchID);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9_ -]*$/", $selected)) {
        header("Location: ../teacherSubject.php?error=invalid&tchID=".$tchID);
        exit();
    }
    else {
        $sql = "SELECT teacherSubject FROM teacher_subject WHERE teacherSubject=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../teacherSubject.php?error=mysqlerror&tchID=".$tchID);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $selected);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../teacherSubject.php?error=taken&tchID=".$tchID);
                exit();
            }
            else {
                $sql = "INSERT INTO teacher_subject (teacherID, teacherUid, teacherName, teacherSubject) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../teacherSubject.php?error=mysqlerror&tchID=".$tchID);
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "ssss", $tchID, $tchUid, $tchName, $selected);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../teacherSubject.php?addTeacherSubject=success&tchID=".$tchID);
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../teacherSubject.php");
    exit();
}