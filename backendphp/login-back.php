<?php
    if (isset($_POST['login_submit'])) {
        require 'condb_back.php';

        $mailuid = $_POST['userID'];
        $password = $_POST['userPwd'];

        if (empty($mailuid) || empty($password)) {
            header("Location: ../login.php?error=empty");
            exit();
        }
        else {
            $sql = "SELECT * FROM users WHERE userUid=? OR userEmail=?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../login.php?error=sqlerror");
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $pwdCheck = password_verify($password, $row['userPassword']);
                    if ($pwdCheck == false) {
                        header("Location: ../login.php?error=wrongpwd");
                        exit();
                    }
                    else if ($pwdCheck = true) {
                        session_start();
                        $_SESSION['idUser'] = $row['userID'];
                        $_SESSION['uidUser'] = $row['userUid'];
                        $_SESSION['userType'] = $row['userType'];
                        
                        if ($_SESSION['userType'] == "admin") {
                            header("Location: ../admin.php?login=succes");
                            exit();
                        }
                        else if ($_SESSION['userType'] == "teacher") {
                            header("Location: ../homeTeacher.php?login=succes");
                            exit();
                        }
                        else if ($_SESSION['userType'] == "student") {
                            header("Location: ../homeStudent.php?login=succes");
                            exit();
                        }
                    }
                    else {
                        header("Location: ../login.php?error=wrongpwd");
                        exit();
                    }
                }
                else {
                    header("Location: ../login.php?error=nouser");
                    exit();
                }
            }
        }
    }
    else {
        header("Location: ../login.php");
        exit();
    }