<?php
    require "condb_back.php";
    
    $stdID = $_GET['stdID'];

    $sql = "DELETE FROM student WHERE studentID = '$stdID'";
    if (mysqli_query($conn, $sql)) {
        
        $sql2 = "DELETE FROM users WHERE userID = '$stdID'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "DELETE FROM student_score WHERE studentID = '$stdID'";
            if (mysqli_query($conn, $sql3)) {
                header("Location: ../student.php?delete=success");
            } 
            else {
                header("Location: ../student.php?error=failed");
                exit();
            }
        } 
        else {
            header("Location: ../student.php?error=failed");
            exit();
        }
    }
    else {
        header("Location: ../student.php?error=failed");
        exit();
    }
	mysqli_close($conn);
?>
