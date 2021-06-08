<!DOCTYPE html>
<html>
	<head>
		<title>Teacher login</title>	
	</head>
	<body>
		<?php
			include "connect.php";
			$teachId=$_POST["id"];
			$teachPw=$_POST["pw"];
			$findS="SELECT * FROM teacher WHERE id='".$teachId."' AND password='".$teachPw."';";
			$result=mysqli_query($connect, $findS);
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
					include "teachMain.php";
				}
			}
			
		?>
	</body>
</html>