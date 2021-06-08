<?php
	$stdId=$_POST['delStd'];
	include "connect.php";		
	$findSdata = "SELECT * FROM student WHERE id='".$stdId."';";
	$finddata = "SELECT * FROM stdans WHERE id='".$stdId."';";
	
	$result = mysqli_query($connect, $findSdata);
	$result2= mysqli_query($connect, $finddata);
	
	if (!$result) {
		die("Could not successfully run query1.");
	}
	else 
	{
		if (mysqli_num_rows($result)==0)
		{
			echo "Please enter a valid ID.<br>";
		}
		else {
			$del = mysqli_query($connect, "DELETE FROM student WHERE id='".$stdId."';");
			$del2 = mysqli_query($connect, "DELETE FROM stdans WHERE id='".$stdId."';");
			
			if ((!$del)||(!$del2)) {
				die("Could not successfully run query2.");
			}
			else {
				echo "Student record with id = $stdId is deleted.<br>";
			}
		}
	}
	echo "<a href= 'admin.php'>Back to Admine Main</a>";
?>