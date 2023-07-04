<?php
    require "condb_back.php";
    
    $adminID = $_GET['adminID'];

    $sql = "DELETE FROM admin WHERE adminID = '$adminID'";
    if (mysqli_query($conn, $sql)) {
        
        $sql2 = "DELETE FROM users WHERE userID = '$adminID'";
        if (mysqli_query($conn, $sql2)) {
            header("Location: ../admin.php?delete=success");
        } 
        else {
            header("Location: ../admin.php?error=". mysqli_error());
            exit();
        }
    }
    else {
        header("Location: ../admin.php?error=". mysqli_error());
        exit();
    }
	mysqli_close($conn);
?>
