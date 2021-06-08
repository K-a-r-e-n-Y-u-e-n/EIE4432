<!DOCTYPE html>
<html>
<head><title>Check Exam Result</title></head>
<body>
	<?php	
		include "login.php";
	?>
	<form method="POST">
	<?php
		include "connect.php";
		$getCourse="SELECT course FROM teacher WHERE id='".$_COOKIE['id']."';";
		$teachCourse=mysqli_query($connect, $getCourse);
		if (!$teachCourse) 
		{
			die("Could not successfully run query1.");
		}
		if (mysqli_num_rows($teachCourse) != 0)
		{
			while($row=mysqli_fetch_assoc($teachCourse))
			{
				$course=$row["course"];
			}
		}

		$getStdResult="SELECT * FROM stdans WHERE course='".$course."';";
		$stdResult=mysqli_query($connect, $getStdResult);
		if (!$stdResult) 
		{
			die("Could not successfully run query2.");
		}
		
		if (mysqli_num_rows($stdResult) != 0)
		{
			echo "<table border='1px'>
			<tr>
			<th>Student ID</th>
			<th>Question no</th>
			<th>Question</th>
			<th>Submitted Answer</th>
			<th>Correct Answer</th>
			<th>Score</th>
			<th>Student Score</th>
			</tr>";
			while($row=mysqli_fetch_assoc($stdResult))
			{
				echo "<tr>
				<td>".$row["id"]." </td>
				<td>".$row["no"]." </td>
				<td>".$row["question"]."</td>
				<td>".$row["submittedAns"]."</td>
				<td>".$row["correctAns"]."</td>
				<td>".$row["score"]."</td>
				<td>".$row["stdScore"]."</td>
				</tr>";
			}
			echo "</table>";
		}
	?>
		<p>Please select a student ID to view student result: 
		<select id="stdId" name="stdId">	</p>
		<?php
			include "connect.php";
			$get="SELECT DISTINCT id FROM stdans";
			$getid=mysqli_query($connect, $get);
			echo "<option></option>";
			while($row = mysqli_fetch_assoc($getid)) {
				echo "<option>".$row["id"]."</option>";
			}
			echo "</select>";
		?>
		<br><input type="submit" name="ok" value="OK" formaction="showStd.php">
		
		
</form>	
		<a href='teachMain.php'>Back to main</a>
</body>
</html>