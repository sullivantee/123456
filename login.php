<?php
    session_start();
    if(!empty($_SESSION['idUser'])
    || !empty($_SESSION['uidUser'])
    || !empty($_SESSION['userType']))
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: login.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<!-- MADE BY TEE FU ZHEN -->
<img class="logo" src="img/logo-goldd.svg" alt="logo">
    <div class="container">
        <div class="inner">
            <div>
                <lable class="header" title="Login to AGrade">Login to AGrade</lable>
                <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "empty") {
                          echo '<span class="alert">Fill in all fields</span>';
                        }
                        else if ($_GET['error'] == "wrongpwd") {
                          echo '<span class="alert">Invalid Password</span>';
                        }
                        else if ($_GET['error'] == "nouser") {
                          echo '<span class="alert">Invalid User</span>';
                        }
                        else if ($_GET['error'] == "forced") {
                            echo '<span class="alert">Please Login</span>';
                        }
                    }
                ?>
                <br>
            </div>
            <form action="backendphp/login-back.php" method="post">
                <div class="user">
                    <label>Username</label>
                    <input class="input" type="text" id="login_userID" name="userID" title="Username"><br><br>
                    <img src="img/man.svg" alt="user image">
                </div>

                <div class="password">
                    <label>Password</label>
                    <input class="input" type="password" id="login_userPwd" name="userPwd" title="Password"><br><br>
                    <img src="img/password.svg" alt="user image">
                </div>
                <div class="btn">
                    <button type="submit" id="login_submit" name="login_submit">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>