<!DOCTYPE html>
<html>
<head><title>Check Student Result</title></head>
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
		
		$stdId=$_POST['stdId'];
		$totScore=0;
		
		$getStdResult="SELECT * FROM stdans WHERE course='".$course."' AND id='".$stdId."';";
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
				$totScore=$totScore+$row["stdScore"];
			}
			echo "</table>";
			echo"The total score of the student is ".$totScore.".";
		}
	?>
</form>	
		<br><a href='checkExam.php'>Back to read all student exam record</a>
</body>
</html>