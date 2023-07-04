<?php

$servername = "localhost";
$dbUsername = "root";
$dbpassword = "";
$dbname = "grade";

$conn = mysqli_connect($servername, $dbUsername, $dbpassword, $dbname);
$conn2 = mysqli_connect($servername, $dbUsername, $dbpassword, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (!$conn2) {
  die("Connection failed: " . mysqli_connect_error());
}