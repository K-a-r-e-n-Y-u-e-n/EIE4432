<!DOCTYPE html>
<html>
	<head>
		<title>Statics</title>
	</head>
	<body>
		<?php
			include "login.php";
			
			$getCourse="SELECT course FROM teacher WHERE id='".$_COOKIE['id']."';";
			$course = mysqli_query($connect, $getCourse);
			
			$score="SELECT MAX(totalScore), MIN(totalScore), AVG(totalScore) FROM total;";
			$find = mysqli_query($connect, $score);
			
			$median="SELECT AVG(x.totalScore) as medianVal FROM(
			SELECT y.totalScore, @rownum:=@rownum+1 as 'rowNumber', @totalRows:=@rownum FROM total y, (SELECT @rownum:=0) r
			WHERE y.totalScore is not NULL ORDER BY y.totalScore) as x 
			WHERE x.rowNumber IN (FLOOR((@totalRows+1)/2), FLOOR((@totalRows+2)/2))";
			$med = mysqli_query($connect, $median);
			
			if((!$find)||(!$med))
			{
				die("Could not successfully run query2.");
			}
			if((mysqli_num_rows($find) == 0)||(mysqli_num_rows($med)==0))
			{
				echo "No result is found.";
			}
			else
			{
				$row = mysqli_fetch_assoc($find);
				$c = mysqli_fetch_assoc($course);
				$m = mysqli_fetch_assoc($med);
				echo "<h2>Exam statistics of course ".$c["course"]."</h2>";
				echo "<h4>Exam score</h4>";
				echo "<table>
					<tr><td>Maximum Score: </td><td>".$row["MAX(totalScore)"]."</td></tr>
					<tr><td>Minimum Score: </td><td>".$row["MIN(totalScore)"]."</td></tr>
					<tr><td>Median Score: </td><td>".$m["medianVal"]."</td></tr>
					<tr><td>Average Score: </td><td>".$row["AVG(totalScore)"]."</td></tr>
				</table>";
			}
			
			
			$attempt="SELECT no, COUNT(no), AVG(stdScore) FROM stdans WHERE course='".$c["course"]."' GROUP BY no;";
			$attemptResult = mysqli_query($connect, $attempt);
			
			$correctAns="SELECT no, COUNT(no) FROM stdans WHERE course='".$c["course"]."' AND stdScore!=0 GROUP BY no;";
			$correct = mysqli_query($connect, $correctAns);
			echo "<h4>Exam attempts</h4>";
			if((!$attemptResult)||(!$correct))
			{
				die("Could not successfully run query3.");
			}
			if((mysqli_num_rows($attemptResult) == 0)||(mysqli_num_rows($correct)==0))
			{
				echo "No result is found.";
			}
			else
			{
				echo "<table border='1px'>
				<th>Question number</th>
				<th>Percentage of correct answer: </th>
				<th>Average score</th>";
				
				while (($a = mysqli_fetch_assoc($attemptResult))&&($correctData = mysqli_fetch_assoc($correct)))
				{
					$per=$correctData["COUNT(no)"]/$a["COUNT(no)"]*100;
					echo "
						<tr><td>".$correctData["no"]."</td><td>".$per."</td><td>".$a["AVG(stdScore)"]."</td></tr>";
				}
				echo "</table>";
			}
			
		?>	
		<br><a href = "teachMain.php">Back to main</a>
	</body>
</html>