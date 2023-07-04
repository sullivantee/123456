<?php
    require "condb_back.php";
    
    $stdID = $_GET['stdID'];
    $courseID = $_GET['courseID'];
    $year = $_GET['year'];
    $month = $_GET['month'];

    $sql = "DELETE FROM student WHERE studentID = '$stdID'";
    if (mysqli_query($conn, $sql)) {
        
        $sql2 = "DELETE FROM users WHERE userID = '$stdID'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "DELETE FROM student_score WHERE studentID = '$stdID'";
            if (mysqli_query($conn, $sql3)) {
                header("Location: ../courseStudents.php?delete=success&courseID=".$courseID."&year=".$year."&month=".$month);
            } 
            else {
                header("Location: ../courseStudents.php?error=failed&courseID=".$courseID."&year=".$year."&month=".$month);
                exit();
            }
        } 
        else {
            header("Location: ../courseStudents.php?error=failed&courseID=".$courseID."&year=".$year."&month=".$month);
            exit();
        }
    }
    else {
        header("Location: ../courseStudents.php?error=failed&courseID=".$courseID."&year=".$year."&month=".$month);
        exit();
    }
	mysqli_close($conn);
?>
