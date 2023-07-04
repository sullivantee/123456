<?php
    require "condb_back.php";
    
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
                header("Location: ../subject.php?delete=success");
            } 
            else {
                header("Location: ../subject.php?error=failed");
                exit();
            }
        } 
        else {
            header("Location: ../subject.php?error=failed");
            exit();
        }
    }
    else {
        header("Location: ../subject.php?error=failed");
        exit();
    }
	mysqli_close($conn);
?>
