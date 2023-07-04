<?php
if (isset($_POST['add_student_submit'])) {

    require 'condb_back.php';

    $id = $_POST['add_student_id'];
    $name = $_POST['add_student_name'];
    $username = $_POST['add_student_uid'];
    $email = $_POST['add_student_email'];
    $ddlSelected = $_POST['add_student_course'];
    $password = $_POST['add_student_pwd'];

    $course = substr($ddlSelected, 0, 4);
    $year = substr($ddlSelected, 5, 4);
    $month = substr($ddlSelected, 10);

    if (empty($id) || empty($name) || empty($username) || empty($email) || empty($ddlSelected) || empty($password)) {
        header("Location: ../manageUser.php?errorStudent=emptyfields&id=".$id."&name=".$name."&uid=".$username."&mail=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $id) 
            && !preg_match("/^[a-zA-Z0-9]*$/", $name) && !preg_match("/^[a-zA-Z0-9]*$/", $username)
            && !preg_match("/^[a-zA-Z0-9_ -]*$/", $ddlSelected)) {
        header("Location: ../manageUser.php?errorStudent=invalid");
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $id)) {
        header("Location: ../manageUser.php?errorStudent=invaildID&&name=".$name."&uid=".$username."&mail=".$email."&ddl=".$ddlSelected);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9_ -]*$/", $name)) {
        header("Location: ../manageUser.php?errorStudent=invaildName&id=".$id."&uid=".$username."&mail=".$email."&ddl=".$ddlSelected);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../manageUser.php?errorStudent=invaildUid&id=".$id."&name=".$name."&mail=".$email."&ddl=".$ddlSelected);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9_ -]*$/", $ddlSelected)) {
        header("Location: ../manageUser.php?errorStudent=invaildDDL&id=".$id."&name=".$name."&uid=".$username."&mail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../manageUser.php?errorStudent=invaildMail&id=".$id."&name=".$name."&uid=".$username."&ddl=".$ddlSelected);
        exit();
    }
    else {
        $sql = "SELECT userID, userUid FROM users WHERE userID=? OR userUid=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../manageUser.php?errorStudent=mysqlerror");
            exit();
        }
        else {
            switch ($month) {
                case "January":
                    $intMonth = 1;
                    break;
                case "February":
                    $intMonth = 2;
                    break;
                case "March":
                    $intMonth = 3;
                    break;
                case "April":
                    $intMonth = 4;
                    break;
                case "May":
                    $intMonth = 5;
                    break;
                case "June":
                    $intMonth = 6;
                    break;
                case "July":
                    $intMonth = 7;
                    break;
                case "August":
                    $intMonth = 8;
                    break;
                case "September":
                    $intMonth = 9;
                    break;
                case "October":
                    $intMonth = 10;
                    break;
                case "November":
                    $intMonth = 11;
                    break;
                case "December":
                    $intMonth = 12;
                    break;
                default:
                    header("Location: ../manageUser.php?errorStudent=mysqlerror");
                    exit();
            }
            $id = substr($year, 2, 2).$intMonth.$id;
            mysqli_stmt_bind_param($stmt, "ss", $id, $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../manageUser.php?errorStudent=taken&name=".$name."&mail=".$email);
                exit();
            }
            else {
                $sql = "INSERT INTO users (userID, userUid, userName, userEmail, userPassword, userType) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../manageUser.php?errorStudent=mysqlerror");
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    $userType = "student";
                    mysqli_stmt_bind_param($stmt, "ssssss", $id, $username, $name, $email, $hashedPwd, $userType);
                    mysqli_stmt_execute($stmt);

                    $sql2 = "INSERT INTO student (studentID, studentName, studentUid, studentEmail, studentCourse, studentYear, studentMonth) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt2 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                        header("Location: ../manageUser.php?errorStudent=mysqlerror");
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($stmt2, "sssssis", $id, $name, $username, $email, $course, $year, $month);
                        mysqli_stmt_execute($stmt2);

                        $sql3 = mysqli_query($conn, "SELECT * From subject WHERE courseID = '$course' AND subjectYear ='$year' AND subjectMonth = '$month'");
                        $row = mysqli_num_rows($sql3);

                        $subjID = array();
                        $subjName = array();
                        $subjTotalScore = array();

                        while ($row = mysqli_fetch_array($sql3)){
                            array_push($subjID, $row['subjectID']);
                            array_push($subjName, $row['subjectName']);
                            array_push($subjTotalScore, $row['subjectTotalScore']);
                        }
                        
                        $length = count($subjID);

                        $stdScore = 0;
                        $stdGrade = "N/A";

                        if ($subjID > 0) {
                            for ($i = 0; $i < $length; $i++){
                                $sql4 = "INSERT INTO student_score (courseID, courseYear, courseMonth, studentID, studentName, subjectID, subjectName, subjectTotalScore, studentScore, studentGrade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                                $stmt4 = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmt4, $sql4)) {
                                    header("Location: ../manageUser.php?errorStudent=mysqlerror");
                                    exit();
                                }
                                else {
                                    mysqli_stmt_bind_param($stmt4, "sisssssiis", $course, $year, $month, $id, $name, $subjID[$i], $subjName[$i], $subjTotalScore[$i], $stdScore, $stdGrade);
                                    mysqli_stmt_execute($stmt4);
                                }
                            }
                            header("Location: ../manageUser.php?addSuccess=student");
                            exit();
                        }
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

