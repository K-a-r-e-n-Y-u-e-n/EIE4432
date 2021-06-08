<?php
	//$id=$_COOKIE["id"];
	//$pw=$_COOKIE["pw"];
	setcookie("id", "" ,time()-3600);
	setcookie("pw", "" ,time()-3600);
	
	
?>

<html>
<head>
	<title>Log out</title>
</head>

<body>
<?php
	echo "You log out successfully!<br>";
?>

<a href="http://localhost/web/miniproject/login.html">back to login</a>

</body>
</html>