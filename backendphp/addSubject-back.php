<?php
if (isset($_POST['add_subject_submit'])) {

    require 'condb_back.php';

    $id = $_POST['add_subject_id'];
    $name = $_POST['add_subject_name'];
    $selectedCourse = $_POST['add_subject_course'];
    $ttlScore = $_POST['add_subject_total_score'];

    $idCourse = substr($selectedCourse, 0, 4);
    $year = substr($selectedCourse, 5, 4);
    $month = substr($selectedCourse, 10);

    $idSubject = $idCourse . $id;

    if (empty($id) || empty($name) || empty($selectedCourse) || empty($ttlScore)) {
        header("Location: ../addSubject.php?error=emptyfields&id=".$id."&name=".$name."&course=".$selectedCourse."&score=".$ttlScore);
        exit();
    }
    elseif (!preg_match("/^[0-9]*$/", $id) && !preg_match("/^[a-zA-Z0-9_ -]*$/", $name) 
            && !preg_match("/^[a-zA-Z0-9_ -]*$/", $selectedCourse) && !preg_match("/^[0-9]*$/", $ttlScore)) {
        header("Location: ../addSubject.php?error=invalid&id=".$id."&name=".$name."&course=".$selectedCourse."&score=".$ttlScore);
        exit();
    }
    else if (!preg_match("/^[0-9]*$/", $id)) {
        header("Location: ../addSubject.php?error=invaildID&name=".$name."&course=".$selectedCourse."&score=".$ttlScore);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9_ -]*$/", $name)) {
        header("Location: ../addSubject.php?error=invaildName&id=".$id."&course=".$selectedCourse."&score=".$ttlScore);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9_ -]*$/", $selectedCourse)) {
        header("Location: ../addSubject.php?error=invaildYear&id=".$id."&name=".$name."&score=".$ttlScore);
        exit();
    }
    else if (!preg_match("/^[0-9]*$/", $ttlScore)) {
        header("Location: ../addSubject.php?error=invaildMonth&id=".$id."&name=".$name."&course=".$selectedCourse);
        exit();
    }
    else {
        $sql = "SELECT subjectID FROM subject WHERE subjectID=? AND subjectYear=? AND subjectMonth=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../addSubject.php?error=mysqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "sis", $idSubject, $year, $month);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../addSubject.php?error=taken&id=".$id."&course=".$selectedCourse);
                exit();
            }
            else {
                $sql = "INSERT INTO subject (courseID, subjectID, subjectName, subjectYear, subjectMonth, subjectTotalScore) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../addSubject.php?error=mysqlerror");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "sssisi", $idCourse, $idSubject, $name, $year, $month, $ttlScore);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../addSubject.php?addSubject=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../addSubject.php");
    exit();
}

