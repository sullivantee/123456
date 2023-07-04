<?php
if (isset($_POST['add_teacher_submit'])) {

    require 'condb_back.php';

    $id = $_POST['add_teacher_id'];
    $name = $_POST['add_teacher_name'];
    $username = $_POST['add_teacher_uid'];
    $email = $_POST['add_teacher_email'];
    $password = $_POST['add_teacher_pwd'];

    if (empty($id) || empty($name) || empty($username) || empty($email) || empty($password)) {
        header("Location: ../manageUser.php?errorTeacher=emptyfields&id=".$id."&name=".$name."&uid=".$username."&mail=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $id) 
            && !preg_match("/^[a-zA-Z0-9]*$/", $name) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../manageUser.php?errorTeacher=invalid");
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $id)) {
        header("Location: ../manageUser.php?errorTeacher=invaildID&&name=".$name."&uid=".$username."&mail=".$email);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9_ -]*$/", $name)) {
        header("Location: ../manageUser.php?errorTeacher=invaildName&id=".$id."&uid=".$username."&mail=".$email);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../manageUser.php?errorTeacher=invaildUid&id=".$id."&name=".$name."&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../manageUser.php?errorTeacher=invaildMail&id=".$id."&name=".$name."&uid=".$username);
        exit();
    }
    else {
        $sql = "SELECT userID, userUid FROM users WHERE userID=? OR userUid=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../manageUser.php?errorTeacher=mysqlerror");
            exit();
        }
        else {
            $id = "TEAC" . $id;
            mysqli_stmt_bind_param($stmt, "ss", $id, $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../manageUser.php?errorTeacher=taken&name=".$name."&mail=".$email);
                exit();
            }
            else {
                $sql = "INSERT INTO users (userID, userUid, userName, userEmail, userPassword, userType) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../manageUser.php?errorTeacher=mysqlerror");
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    $userType = "teacher";
                    mysqli_stmt_bind_param($stmt, "ssssss", $id, $username, $name, $email, $hashedPwd, $userType);
                    mysqli_stmt_execute($stmt);

                    $sql2 = "INSERT INTO teacher (teacherID, teacherName, teacherUid, teacherEmail) VALUES (?, ?, ?, ?)";
                    $stmt2 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                        header("Location: ../manageUser.php?errorTeacher=mysqlerror");
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($stmt2, "ssss", $id, $name, $username, $email);
                        mysqli_stmt_execute($stmt2);
                        header("Location: ../manageUser.php?addSuccess=teacher");
                        exit();
                    }
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../manageUser.php");
    exit();
}

