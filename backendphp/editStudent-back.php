<?php
if (isset($_POST['edit_std_submit'])) {

    require 'condb_back.php';

    $stdID = $_GET['stdID'];
    $uid = $_POST['edit_std_uid'];
    $name = $_POST['edit_std_name'];
    $email = $_POST['edit_std_email'];
    $password = $_POST['edit_std_pwd'];

    if (empty($name) || empty($uid) || empty($email)) {
        header("Location: ../editStudent.php?error=emptyfields&stdID=".$stdID."&name=".$name."&uid=".$uid."&mail=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) 
            && !preg_match("/^[a-zA-Z0-9_ -]*$/", $name) 
            && !preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        header("Location: ../editStudent.php?error=invalid&stdID=".$stdID);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9_ -]*$/", $name)) {
        header("Location: ../editStudent.php?error=invaildName&stdID=".$stdID."&uid=".$uid."&mail=".$email);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        header("Location: ../editStudent.php?error=invaildUid&stdID=".$stdID."&name=".$name."&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../editStudent.php?error=invaildMail&stdID=".$stdID."&name=".$name."&uid=".$uid);
        exit();
    }
    if (!empty($password)) {
        $sql = "UPDATE users SET userName=?, userUid=?, userEmail=?, userPassword=? WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../editStudent.php?error=mysqlerror&stdID=".$stdID);
            exit();
        }
        else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sssss", $name, $uid, $email, $hashedPwd, $stdID);
            mysqli_stmt_execute($stmt);

            $sql2 = "UPDATE student SET studentName=?, studentUid=?, studentEmail=? WHERE studentID=?";
            $stmt2 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                header("Location: ../editStudent.php?error=mysqlerror&stdID=".$stdID);
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt2, "ssss", $name, $uid, $email, $stdID);
                mysqli_stmt_execute($stmt2);

                $sql3 = "UPDATE student_score SET studentName=? WHERE studentID = ?";
                $stmt3 = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt3, $sql3)) {
                    header("Location: ../editStudent.php?error=mysqlerror&stdID=".$stdID);
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt3, "ss", $name, $stdID);
                    mysqli_stmt_execute($stmt3);
                    header("Location: ../editStudent.php?editStudent=success&stdID=".$stdID);
                    exit();
                }
            }
        }
    }
    else if (empty($password)){
        $sql4 = "UPDATE users SET userName=?, userUid=?, userEmail=? WHERE userID = ?";
        $stmt4 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt4, $sql4)) {
            header("Location: ../editStudent.php?error=mysqlerror&stdID=".$stdID);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt4, "ssss", $name, $uid, $email, $stdID);
            mysqli_stmt_execute($stmt4);

            $sql5 = "UPDATE student SET studentName=?, studentUid=?, studentEmail=? WHERE studentID = ?";
            $stmt5 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt5, $sql5)) {
                header("Location: ../editStudent.php?error=mysqlerror&stdID=".$stdID);
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt5, "ssss", $name, $uid, $email, $stdID);
                mysqli_stmt_execute($stmt5);
                
                $sql5 = "UPDATE student_score SET studentName=? WHERE studentID = ?";
                $stmt5 = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt5, $sql5)) {
                    header("Location: ../editStudent.php?error=mysqlerror&stdID=".$stdID);
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt5, "ss", $name, $stdID);
                    mysqli_stmt_execute($stmt5);
                    header("Location: ../editStudent.php?editStudent=success&stdID=".$stdID);
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../editStudent.php");
    exit();
}