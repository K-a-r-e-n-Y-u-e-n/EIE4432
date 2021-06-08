<?php
	include "connect.php";
		
		$id = $_POST['loginId'];
		$pw = $_POST['pw'];
		$nick = $_POST['nick'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$birthday = $_POST['birthday'];
		$file =addslashes(file_get_contents($_FILES["myimage"]["tmp_name"]));
	$findSdata = "SELECT * FROM student WHERE id='".$id."';";
	$result = mysqli_query($connect, $findSdata);
	
	if (!$result) {
		die("Could not successfully run query1.");
	}
	
	else {
		if (mysqli_num_rows($result)==0)
		{
			echo "Please enter a valid ID.<br>";
		}
		else {
			$mod = mysqli_query($connect, "UPDATE student SET password='".$pw."', nick='".$nick."', email='".$email."', gender='".$gender."', birthday='".$birthday."', image='".$file."' WHERE id='".$id."';");
			
			if (!$mod) {
				die("Could not successfully run query2.");
			}
			else {
				echo "Student record with id = '".$id."' is modified.<br>";
			}
		}
	}
	echo "<a href= 'admin.php'>Back to Admine Main</a>";
?>