<?php
    require "condb_back.php";
    
    $courseID = $_GET['courseID'];
    $subjectID = $_GET['subjectID'];
    $year = $_GET['year'];
    $month = $_GET['month'];

    $date = $year . " " . $month;

    $sql = "DELETE FROM student_score WHERE subjectID = '$subjectID' AND courseYear = '$year' AND courseMonth = '$month'";
    if (mysqli_query($conn, $sql)) {
        
        $sql2 = "DELETE FROM subject WHERE subjectID = '$subjectID' AND subjectYear = '$year' AND subjectMonth = '$month'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "DELETE FROM teacher_subject WHERE teacherSubject LIKE '$subjectID%$date'";
            if (mysqli_query($conn, $sql3)) {
                header("Location: ../courseSubjects.php?delete=success&courseID=" . $courseID . "&year=" . $year . "&month=" . $month);
            } 
            else {
                header("Location: ../courseSubjects.php?error=failed&courseID=" . $courseID . "&year=" . $year . "&month=" . $month);
                exit();
            }
        } 
        else {
            header("Location: ../courseSubjects.php?error=failed&courseID=" . $courseID . "&year=" . $year . "&month=" . $month);
            exit();
        }
    }
    else {
        header("Location: ../courseSubjects.php?error=failed&courseID=" . $courseID . "&year=" . $year . "&month=" . $month);
        exit();
    }
	mysqli_close($conn);
?>
