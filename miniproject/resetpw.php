<!DOCTYPE html>
<html>
	<head>
		<title>Reset Password</title>	
	</head>
	<body>
		<?php
			include "connect.php";
			$role=$_POST["role"];
			$id=$_POST["id"];
			$email=$_POST["email"];
			$pw=$_POST["pw"];
			
			if($role=="Student") {
				$findS="SELECT * FROM student WHERE id='".$id."' AND email='".$email."';";
				$result=mysqli_query($connect, $findS);
				if (!$result) {
					die("Could not successfully run query1.");
				}
				else 
				{
					if (mysqli_num_rows($result)==0)
					{
						echo "Please enter valid ID and email.<br>";
						echo "<a href= 'resetpw.html'>Back to forget password</a>";
					}
					else {
						$reset=mysqli_query($connect, "UPDATE student SET password='".$pw."' WHERE id='".$id."';");
						if (!$reset) {
							die("Could not successfully run query2.");
						}
						else {
							echo "Your password is reset.<br>";
							echo "<a href='login.html'>Go to login</a>";
						}
					}
				}
			}
			else {
				$findT="SELECT * FROM teacher WHERE id='".$id."' AND email='".$email."';";
				$result=mysqli_query($connect, $findT);
				if (!$result) {
					die("Could not successfully run query1.");
				}
				else 
				{
					if (mysqli_num_rows($result)==0)
					{
						echo "Please enter valid ID and email.<br>";
						echo "<a href= 'resetpw.html'>Back to forget password</a>";
					}
					else {
						$reset=mysqli_query($connect, "UPDATE teacher SET password='".$pw."' WHERE id='".$id."';");
						if (!$reset) {
							die("Could not successfully run query2.");
						}
						else {
							echo "Your password is reset.<br>";
							echo "<a href='login.html'>Go to login</a>";
						}
					}
				}
			}
		?>
	</body>
</html>