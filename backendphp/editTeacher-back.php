<?php
if (isset($_POST['edit_tch_submit'])) {

    require 'condb_back.php';

    $tchID = $_GET['tchID'];
    $uid = $_POST['edit_tch_uid'];
    $name = $_POST['edit_tch_name'];
    $email = $_POST['edit_tch_email'];
    $password = $_POST['edit_tch_pwd'];

    if (empty($name) || empty($uid) || empty($email)) {
        header("Location: ../editTeacher.php?error=emptyfields&tchID=".$tchID."&name=".$name."&uid=".$uid."&mail=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) 
            && !preg_match("/^[a-zA-Z0-9_ -]*$/", $name) 
            && !preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        header("Location: ../editTeacher.php?error=invalid&tchID=".$tchID);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9_ -]*$/", $name)) {
        header("Location: ../editTeacher.php?error=invaildName&tchID=".$tchID."&uid=".$uid."&mail=".$email);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        header("Location: ../editTeacher.php?error=invailduid&tchID=".$tchID."&name=".$name."&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../editTeacher.php?error=invaildmail&tchID=".$tchID."&name=".$name."&uid=".$uid);
        exit();
    }
    if (!empty($password)) {
        $sql = "UPDATE users SET userName=?, userUid=?, userEmail=?, userPassword=? WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../editTeacher.php?error=mysqlerror&tchID=".$tchID);
            exit();
        }
        else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sssss", $name, $uid, $email, $hashedPwd, $tchID);
            mysqli_stmt_execute($stmt);

            $sql2 = "UPDATE teacher SET teacherName=?, teacherUid=?, teacherEmail=? WHERE teacherID=?";
            $stmt2 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                header("Location: ../editTeacher.php?error=mysqlerror&tchID=".$tchID);
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt2, "ssss", $name, $uid, $email, $tchID);
                mysqli_stmt_execute($stmt2);
                header("Location: ../editTeacher.php?editTeacher=success&tchID=".$tchID);
                exit();
            }
        }
    }
    else if (empty($password)){
        $sql3 = "UPDATE users SET userName=?, userUid=?, userEmail=? WHERE userID = ?";
        $stmt3 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt3, $sql3)) {
            header("Location: ../editTeacher.php?error=mysqlerror&tchID=".$tchID);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt3, "ssss", $name, $uid, $email, $tchID);
            mysqli_stmt_execute($stmt3);

            $sql4 = "UPDATE teacher SET teacherName=?, teacherUid=?, teacherEmail=? WHERE teacherID = ?";
            $stmt4 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt4, $sql4)) {
                header("Location: ../editTeacher.php?error=mysqlerror&tchID=".$tchID);
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt4, "ssss", $name, $uid, $email, $tchID);
                mysqli_stmt_execute($stmt4);
                header("Location: ../editTeacher.php?editTeacher=success&tchID=".$tchID);
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../editTeacher.php");
    exit();
}