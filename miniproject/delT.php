<?php
	$teachId=$_POST['delTeach'];
	include "connect.php";		
	$findTdata = "SELECT * FROM teacher WHERE id='".$teachId."';";
	$result = mysqli_query($connect, $findTdata);
	
	if (!$result) {
		die("Could not successfully run query.");
	}
	
	else {
		if (mysqli_num_rows($result)==0)
		{
			echo "Please enter a valid ID.<br>";
		}
		else {
			$del = mysqli_query($connect, "DELETE FROM teacher WHERE id='".$teachId."';");
			
			if (!$del) {
				die("Could not successfully run query.");
			}
			else {
				echo "Teacher record with id = $teachId is deleted.<br>";
			}
		}
	}
	echo "<a href= 'admin.php'>Back to Admine Main</a>";
?>