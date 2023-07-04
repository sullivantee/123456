<?php
    require "condb_back.php";

    $courseID = $_GET['courseID'];
    $year = $_GET['year'];
    $month = $_GET['month'];

    $date = $year . " " . $month;

    $sql = "DELETE FROM teacher_subject WHERE teacherSubject LIKE '$courseID%$date'";
    if (mysqli_query($conn, $sql)) {
        
        $sql2 = "DELETE FROM subject WHERE courseID = '$courseID' AND subjectYear = '$year' AND subjectMonth = '$month'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "DELETE FROM student_score WHERE courseID = '$courseID' AND courseYear = '$year' AND courseMonth = '$month'";
            if (mysqli_query($conn, $sql3)) {

                $sql4 = "DELETE FROM student WHERE studentCourse = '$courseID' AND studentYear = '$year' AND studentMonth = '$month'";
                if (mysqli_query($conn, $sql4)) {

                    $sql5 = "DELETE FROM course WHERE courseID = '$courseID' AND courseYear = '$year' AND courseMonth = '$month'";
                    if (mysqli_query($conn, $sql5)) {
                        header("Location: ../course.php?delete=success");
                    } 
                    else {
                        header("Location: ../course.php?error=failed");
                        exit();
                    }
                } 
                else {
                    header("Location: ../course.php?error=failed");
                    exit();
                }
            } 
            else {
                header("Location: ../course.php?error=failed");
                exit();
            }
        } 
        else {
            header("Location: ../course.php?error=failed");
            exit();
        }
    }
    else {
        header("Location: ../course.php?error=failed");
        exit();
    }
	mysqli_close($conn);
?>
