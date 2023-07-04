<?php
    require "condb_back.php";
    
    $stdID = $_GET['stdID'];
    $subjectID = $_GET['subjectID'];
    $year = $_GET['year'];
    $month = $_GET['month'];

    $sql = "DELETE FROM student WHERE studentID = '$stdID'";
    if (mysqli_query($conn, $sql)) {
        
        $sql2 = "DELETE FROM users WHERE userID = '$stdID'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "DELETE FROM student_score WHERE studentID = '$stdID'";
            if (mysqli_query($conn, $sql3)) {
                header("Location: ../subjectStudents.php?delete=success&subjectID=" . $subjectID . "&year=" . $year . "&month=" . $month);
            } 
            else {
                header("Location: ../subjectStudents.php?error=failed&subjectID=" . $subjectID . "&year=" . $year . "&month=" . $month);
                exit();
            }
        } 
        else {
            header("Location: ../subjectStudents.php?error=failed&subjectID=" . $subjectID . "&year=" . $year . "&month=" . $month);
            exit();
        }
    }
    else {
        header("Location: ../subjectStudents.php?error=failed&subjectID=" . $subjectID . "&year=" . $year . "&month=" . $month);
        exit();
    }
	mysqli_close($conn);
?>
