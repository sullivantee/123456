<?php
if (isset($_POST['edit_admin_submit'])) {

    require 'condb_back.php';

    $adminID = $_GET['adminID'];
    $uid = $_POST['edit_admin_uid'];
    $name = $_POST['edit_admin_name'];
    $email = $_POST['edit_admin_email'];
    $password = $_POST['edit_admin_pwd'];

    if (empty($name) || empty($uid) || empty($email)) {
        header("Location: ../editAdmin.php?error=emptyfields&adminID=".$adminID."&name=".$name."&uid=".$uid."&mail=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) 
            && !preg_match("/^[a-zA-Z0-9_ -]*$/", $name) 
            && !preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        header("Location: ../editAdmin.php?error=invalid&adminID=".$adminID);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9_ -]*$/", $name)) {
        header("Location: ../editAdmin.php?error=invaildName&adminID=".$adminID."&uid=".$uid."&mail=".$email);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        header("Location: ../editAdmin.php?error=invaildUid&adminID=".$adminID."&name=".$name."&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../editAdmin.php?error=invaildMail&adminID=".$adminID."&name=".$name."&uid=".$uid);
        exit();
    }
    if (!empty($password)) {
        $sql = "UPDATE users SET userName=?, userUid=?, userEmail=?, userPassword=? WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../editAdmin.php?error=mysqlerror&adminID=".$adminID);
            exit();
        }
        else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sssss", $name, $uid, $email, $hashedPwd, $adminID);
            mysqli_stmt_execute($stmt);

            $sql2 = "UPDATE admin SET adminName=?, adminUid=?, adminEmail=? WHERE adminID=?";
            $stmt2 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                header("Location: ../editAdmin.php?error=mysqlerror&adminID=".$adminID);
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt2, "ssss", $name, $uid, $email, $adminID);
                mysqli_stmt_execute($stmt2);
                header("Location: ../editAdmin.php?editAdmin=success&adminID=".$adminID);
                exit();
            }
        }
    }
    else if (empty($password)){
        $sql3 = "UPDATE users SET userName=?, userUid=?, userEmail=? WHERE userID = ?";
        $stmt3 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt3, $sql3)) {
            header("Location: ../editAdmin.php?error=mysqlerror&adminID=".$adminID);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt3, "ssss", $name, $uid, $email, $adminID);
            mysqli_stmt_execute($stmt3);

            $sql4 = "UPDATE admin SET adminName=?, adminUid=?, adminEmail=? WHERE adminID = ?";
            $stmt4 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt4, $sql4)) {
                header("Location: ../editAdmin.php?error=mysqlerror&adminID=".$adminID);
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt4, "ssss", $name, $uid, $email, $adminID);
                mysqli_stmt_execute($stmt4);
                header("Location: ../editAdmin.php?editAdmin=success&adminID=".$adminID);
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../editAdmin.php");
    exit();
}