<!DOCTYPE html>
<html>
	<head>
		<title>Admin Main</title>	
	</head>
	<body>
		<?php
			include "login.php";
		?>
	
		<p>Here are the Information of Student: </p>
		<?php
			include "connect.php";		
			
			$getSdata = "SELECT * FROM student";
			$result = mysqli_query($connect, $getSdata);
			
			if (!$result) {
				die("Could not successfully run query.");
			}
			
			if (mysqli_num_rows($result) > 0) 
			{
				echo "<table border='1px'>
					<tr>
					<th>ID</th>
					<th>nickname</th>
					<th>email</th>
					<th>gender</th>
					<th>birthday</th>
					<th>image</th>
				</tr>";
				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "<tr>
						<td>" . $row["id"]. "</td>
						<td>" . $row["nick"]. "</td>
						<td>" . $row["email"]. "</td>
						<td>" . $row["gender"]. "</td>
						<td>" . $row["birthday"]. "</td>
						<td><img src='data:image;base64," . base64_encode($row["image"]). "' width='100' height='100'/></td>	
					</tr>";
				}
				echo "</table>";
			}
		?>
		<form method="post">
		<a href ="insertS.html">Insert a student account</a><br><br>
		Input a student ID to delete: <input type="text" name="delStd"><input type="submit" value="Delete" formaction="delS.php"><br><br>
		<a href ="modifyS.html">Modify a student account</a><br><br>
		</form>
		<p>Here are the Information of Teachers:</p>
		<?php	
			$getTdata = "SELECT * FROM teacher";
			$result = mysqli_query($connect, $getTdata);
			if (!$result) {
				die("Could not successfully run query.");
			}
			
			if (mysqli_num_rows($result) > 0) 
			{
				echo "<table border='1px'>
				<tr>
					<th>ID</th>
					<th>nickname</th>
					<th>email</th>
					<th>course</th>
					<th>image</th>
				</tr>";
				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "<tr>
						<td>" . $row["id"]. "</td>
						<td>" . $row["nick"]. "</td>
						<td>" . $row["email"]. "</td>
						<td>" . $row["course"]. "</td>
						<td><img src='data:image;base64," . base64_encode($row["image"]). "' width='100' height='100'/></td>	
					</tr>";
				}
				echo "</table>";
			}
		?>
		<form method="post">
		<a href ="insertT.html">Insert a teacher account</a><br><br>
		Input a teacher ID to delete: <input type="text" name="delTeach"><input type="submit" value="Delete" formaction="delT.php"><br><br>
		<a href ="modifyT.html">Modify a teacher account</a><br><br>
	</form>
</html>