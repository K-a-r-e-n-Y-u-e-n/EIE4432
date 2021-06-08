<?php
      session_start(); //start the session
?>

<!DOCTYPE html>
<html>
<head><title>Exam-RESULT</title></head>
<body>

<?php
	include "connect.php";
	include "login.php";
	
	$time = gmdate("Y-m-d H:i:s", time()+ 3600*8);
	
	echo"<h1>This is your reusut: </h1>";
	echo "The time you finsih the exam is $time";
	echo $_SESSION['stdTotScore'];
	echo"<h2>YOU SCORED ".$_SESSION['stdTotScore']." OUT OF ".$_SESSION['totScore']."</h2>";
	
	$getData="SELECT * FROM stdans WHERE id='".$_COOKIE['id']."' AND course='".$_SESSION['course']."'";
	$result = mysqli_query($connect, $getData);
	if(!$result)
	{
		die("Could not successfully run query.");
	}
	if (mysqli_num_rows($result) == 0) 
	{
		echo "No result is found.";
	}
	else
	{
		echo "<table border='1px'>
		<tr>
		<th>Question no</th>
		<th>Question</th>
		<th>Submitted Answer</th>
		<th>Correct Answer</th>
		<th>Score</th>
		<th>Your Score</th>
		<th>Submit Time</th>
		</tr>";
		
		while($row = mysqli_fetch_assoc($result))
		{
			echo "<tr>
			<td>".$row["no"]." </td>
			<td>".$row["question"]."</td>
			<td>".$row["submittedAns"]."</td>
			<td>".$row["correctAns"]."</td>
			<td>".$row["score"]."</td>
			<td>".$row["stdScore"]."</td>
			<td>".$row["time"]."</td>
			</tr>";
		}
		echo "</table>";
	}
	
	$insertData="INSERT INTO total VALUES ('".$_COOKIE['id']."', '".$_SESSION['course']."', '".$_SESSION['stdTotScore']."')";
	$insert = mysqli_query($connect, $insertData);
	if(!$insert)
	{
		die("Could not successfully run query2.");
	}			 
				 
	
	session_unset();
	session_destroy();
	
	echo "<p><a href ='stdMain.php'>Back to main page</a></p>";
?>
</body>
</html>