<?php
if (isset($_POST['add_course_submit'])) {

    require 'condb_back.php';

    $id = $_POST['add_course_id'];
    $name = $_POST['add_course_name'];
    $year = $_POST['add_course_year'];
    $month = $_POST['add_course_month'];

    if (empty($id) || empty($name) || empty($year) || empty($month)) {
        header("Location: ../addCourse.php?error=emptyfields&id=".$id."&name=".$name."&year=".$year."&month=".$month);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $id) && !preg_match("/^[a-zA-Z0-9_ -]*$/", $name) 
            && !preg_match("/^[a-zA-Z0-9]*$/", $year) && !preg_match("/^[a-zA-Z0-9]*$/", $month)) {
        header("Location: ../addCourse.php?error=invalid&name=".$name."&year=".$year."&month=".$month);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $id)) {
        header("Location: ../addCourse.php?error=invaildID&name=".$name."&year=".$year."&month=".$month);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9_ -]*$/", $name)) {
        header("Location: ../addCourse.php?error=invaildName&id=".$id."&year=".$year."&month=".$month);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $year)) {
        header("Location: ../addCourse.php?error=invaildYear&id=".$id."&name=".$name."&month=".$month);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $month)) {
        header("Location: ../addCourse.php?error=invaildMonth&id=".$id."&name=".$name."&year=".$year);
        exit();
    }
    else {
        $sql = "SELECT courseID FROM course WHERE courseID=? AND courseYear=? AND courseMonth=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../addCourse.php?error=mysqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "sis", $id, $year, $month);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../addCourse.php?error=taken&id=".$id."&year=".$year."&month=".$month);
                exit();
            }
            else {
                $sql = "INSERT INTO course (courseID, courseName, courseYear, courseMonth) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../addCourse.php?error=mysqlerror&name=".$name."&year=".$year."&month=".$month);
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "ssis", $id, $name, $year, $month);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../addCourse.php?addCourse=success&name=".$name."&year=".$year."&month=".$month);
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../addCourse.php");
    exit();
}

