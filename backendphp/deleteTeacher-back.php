<?php
    require "condb_back.php";
    
    $tchID = $_GET['tchID'];

    $sql = "DELETE FROM teacher WHERE teacherID = '$tchID'";
    if (mysqli_query($conn, $sql)) {
        
        $sql2 = "DELETE FROM users WHERE userID = '$tchID'";
        if (mysqli_query($conn, $sql2)) {

            $sql3 = "DELETE FROM teacher_subject WHERE teacherID = '$tchID'";
            if (mysqli_query($conn, $sql3)) {
                header("Location: ../teacher.php?delete=success");
            } 
            else {
                header("Location: ../teacher.php?error=failed");
                exit();
            }
        } 
        else {
            header("Location: ../teacher.php?error=failed");
            exit();
        }
    }
    else {
        header("Location: ../teacher.php?error=failed");
        exit();
    }
	mysqli_close($conn);
?>
