<?php
	include "connect.php"; // connect to the database
	$find="SELECT * FROM stdans WHERE id='".$_COOKIE['id']."' AND course='".$_POST['course']."';";
	$findResult = mysqli_query($connect, $find);
	if (!$findResult) 
	{
		die("Could not successfully run query.");
	}
	if (mysqli_num_rows($findResult) != 0) 
	{		
		echo "You have finished this exam already.";
		echo "<p><a href ='stdMain.php'>Back to main</a></p>";
	}
	else
	{
		include "exam.php";
	}
?>