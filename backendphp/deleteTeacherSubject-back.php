<?php
    require "condb_back.php";
    
    $tchID = $_GET['tchID'];
    $subjectID = $_GET['subjectID'];

	$sql = "DELETE FROM teacher_subject WHERE teacherID = '$tchID' AND teacherSubject = '$subjectID'";
   
	if (mysqli_query($conn, $sql)) {
		header("Location: ../teacherSubject.php?delete=success&tchID=".$tchID);
	} 
	else {
		header("Location: ../teacherSubject.php?error=". mysqli_error() ."&tchID=".$tchID);
		exit();
	}
	mysqli_close($conn);
?>
