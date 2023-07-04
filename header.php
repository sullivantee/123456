<?php
    session_start();
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
    if(empty($_SESSION['idUser']) || $_SESSION['idUser'] == ''
    || empty($_SESSION['uidUser']) || $_SESSION['uidUser'] == ''
    || empty($_SESSION['userType']) || $_SESSION['userType'] == '')
    {
        header("Location: login.php?error=forced");
        die();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<!-- MADE BY TEE FU ZHEN -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        if ($activePage == "homeTeacher" || $activePage == "homeStudent") {
            echo "<title>Home</title>";
        }
        else if ($activePage == "admin") {
            echo "<title>Admin</title>";
        }
        else if ($activePage == "teacher") {
            echo "<title>Teacher</title>";
        }
        else if ($activePage == "student") {
            echo "<title>Student</title>";
        }
        else if ($activePage == "course") {
            echo "<title>Course</title>";
        }
        else if ($activePage == "subject") {
            echo "<title>Subject</title>";
        }
        else if ($activePage == "manageUser") {
            echo "<title>Manage Users</title>";
        }
        else if ($activePage == "teacherSubject") {
            echo "<title>Teacher Subjects</title>";
        }
        else if ($activePage == "courseStudent") {
            echo "<title>Course Students</title>";
        }
        else if ($activePage == "courseSubject") {
            echo "<title>Course Subjects</title>";
        }
        else if ($activePage == "studentScore") {
            echo "<title>Student Scores</title>";
        }
        else if ($activePage == "courseStudentScore") {
            echo "<title>Course Student Scores</title>";
        }
        else if ($activePage == "addCourse") {
            echo "<title>Add Course</title>";
        }
        else if ($activePage == "addSubject") {
            echo "<title>Add Subject</title>";
        }
        else if ($activePage == "editAdmin") {
            echo "<title>Edit Admin</title>";
        }
        else if ($activePage == "editTeacher") {
            echo "<title>Edit Teacher</title>";
        }
        else if ($activePage == "editStudent") {
            echo "<title>Edit Student</title>";
        }
        else if ($activePage == "editStudentScore") {
            echo "<title>Edit Student Score</title>";
        }
    ?>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="css/header.css">

    <link rel="stylesheet" type="text/css" href="css/homeTeacher.css">
    <link rel="stylesheet" type="text/css" href="css/homeStudent.css">

    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" type="text/css" href="css/teacher.css">
    <link rel="stylesheet" type="text/css" href="css/student.css">
    <link rel="stylesheet" type="text/css" href="css/course.css">
    <link rel="stylesheet" type="text/css" href="css/subject.css">
    <link rel="stylesheet" type="text/css" href="css/manageUser.css">

    <link rel="stylesheet" type="text/css" href="css/teacherSubject.css">
    <link rel="stylesheet" type="text/css" href="css/courseStudent.css">
    <link rel="stylesheet" type="text/css" href="css/courseSubject.css">

    <link rel="stylesheet" type="text/css" href="css/subjectStudents.css">

    <link rel="stylesheet" type="text/css" href="css/studentScore.css">
    <link rel="stylesheet" type="text/css" href="css/courseStudentsScore.css">

    <link rel="stylesheet" type="text/css" href="css/addCourse.css">
    <link rel="stylesheet" type="text/css" href="css/addSubject.css">

    <link rel="stylesheet" type="text/css" href="css/editAdmin.css">
    <link rel="stylesheet" type="text/css" href="css/editTeacher.css">
    <link rel="stylesheet" type="text/css" href="css/editStudent.css">
    <link rel="stylesheet" type="text/css" href="css/editStudentScore.css">
            
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <script src="js/showPassword.js"></script>
</head>
<body>
        <div class="sidebar">
            <img class="logo" src="img/logo-goldd.svg" alt="logo">
            <hr>
            <?php
                if ($_SESSION['userType'] != "admin") {
                    echo "<a class= '";
                    echo ($activePage == 'homeTeacher' || $activePage == 'homeStudent') ? 'active':'';
                    if ($_SESSION['userType'] == "teacher") {
                        echo "' href='homeTeacher.php'>";
                    }
                    else if ($_SESSION['userType'] == "student") {
                        echo "' href='homeStudent.php'>";
                    }
                    echo "<img src='img/home.svg' alt='Home'>";
                    echo "<span>HOME</span>";
                    echo "</a>";
                }
            ?>

            <?php
                if ($_SESSION['userType'] == "admin") {
                    echo "<a class= '";
                    echo ($activePage == 'admin' || $activePage == 'editAdmin') ? 'active':'';
                    echo "' href='admin.php'>";
                    echo "<img src='img/admin.svg' alt='Admin'>";
                    echo "<span>ADMIN</span>";
                    echo "</a>";
                }
            ?>

            <?php
                echo "<a class= '";
                echo ($activePage == 'teacher'  || $activePage == 'teacherSubject' || $activePage == 'editTeacher') ? 'active':'';
                echo "' href='teacher.php'>";
                echo "<img src='img/teacher.svg' alt='Teacher'>";
                echo "<span>TEACHER</span>";
                echo "</a>";
            ?>

            <?php
                if ($_SESSION['userType'] != "student") {
                    echo "<a class= '";
                    echo ($activePage == 'student' || $activePage == 'studentScore' || $activePage == 'editStudent' || $activePage == 'editStudentScore') ? 'active':'';
                    echo "' href='student.php'>";
                    echo "<img src='img/student.svg' alt='Student'>";
                    echo "<span>STUDENT</span>";
                    echo "</a>";
                }
            ?>

            <?php
                echo "<a class= '";
                echo ($activePage == 'course' || $activePage == 'addCourse' || $activePage == 'courseSubjects' || $activePage == 'courseStudents' || $activePage == 'courseStudentsScore') ? 'active':'';
                echo "' href='course.php'>";
                echo "<img src='img/course.svg' alt='Course'>";
                echo "<span>COURSE</span>";
                echo "</a>";
            ?>

            <?php
                echo "<a class= '";
                echo ($activePage == 'subject' || $activePage == 'addSubject' || $activePage == 'subjectStudents') ? 'active':'';
                echo "' href='subject.php'>";
                echo "<img src='img/subject.svg' alt='Subject'>";
                echo "<span>SUBJECT</span>";
                echo "</a>";
            ?>

            <?php
                if ($_SESSION['userType'] == "admin") {
                    echo "<a class= '";
                    echo ($activePage == 'manageUser') ? 'active':'';
                    echo "' href='manageUser.php'>";
                    echo "<img src='img/manage.svg' alt='Manage User'>";
                    echo "<span>MANAGE USERS</span>";
                    echo "</a>";
                }
            ?>

            <?php
                echo "<a class= '' href='backendphp/logout-back.php'>";
                echo "<img src='img/logout.svg' alt='Log out'>";
                echo "<span>LOG OUT</span>";
                echo "</a>";
            ?>
        </div>
    
