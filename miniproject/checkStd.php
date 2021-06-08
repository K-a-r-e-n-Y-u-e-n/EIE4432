<!DOCTYPE html>
<html>
	<head>
		<title>Student login</title>	
	</head>
	<body>
		<?php
			include "connect.php";
			$stdId=$_POST["id"];
			$stdPw=$_POST["pw"];
			$findT="SELECT * FROM student WHERE id='".$stdId."' AND password='".$stdPw."';";
			$result=mysqli_query($connect, $findT);
			if (!$result) {
				die("Could not successfully run query1.");
			}
			else 
			{
				if (mysqli_num_rows($result)==0)
				{
					echo "Please enter valid ID and Password.<br>";
					echo "<a href= 'login.html'>Back to login</a>";
				}
				else {	
					include "stdMain.php";
				}
			}
			
		?>
	</body>
</html>