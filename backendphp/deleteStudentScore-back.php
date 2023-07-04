<?php
    require "condb_back.php";
    
    $stdID = $_GET['stdID'];
    $subjectID = $_GET['subjectID'];
    $year = $_GET['year'];
    $month = $_GET['month'];

    $sql = "DELETE FROM student_score WHERE studentID = '$stdID' AND subjectID = '$subjectID' 
            AND courseYear = '$year' AND courseMonth = '$month'";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../studentScore.php?delete=success&stdID=".$stdID);
    }
    else {
        header("Location: ../studentScore.php?error=failed&stdID=".$stdID);
        exit();
    }
	mysqli_close($conn);
?>
