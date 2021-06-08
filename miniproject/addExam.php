<!DOCTYPE html>
<html>
<head><title>Add Exam</title></head>
<body>
	<?php
		include "login.php";
		include "connect.php";
		$getCourse="SELECT id, course from teacher WHERE id='".$_COOKIE['id']."';";
		$teachCourse=mysqli_query($connect, $getCourse);
		if (!$teachCourse) 
		{
			die("Could not successfully run query.");
		}
		if (mysqli_num_rows($teachCourse) != 0)
		{
			while($row=mysqli_fetch_assoc($teachCourse))
			{
				$course = $row['course'];
			}
		}
	?>
	<form method="post">
	<p>Please select the date and time for the start time and end time of the exam: </p>
	<table>
		<tr><td>Start time: </td><td><input type="datetime-local" name="start" id="start"></td></tr>
		<tr><td>End time: </td><td><input type="datetime-local" name="end" id="end"></td></tr>
	</table>
	<p>Please enter the number of MC questions and T/F questions to be inserted: </p>
	<input type="number" name="numOfQ" id="numOfQ"><input type="submit" value="OK" formaction="inputExamQ.php">
	</form>
	<br><br><a href="teachMain.php">Back to main</a>
</body>
</html>