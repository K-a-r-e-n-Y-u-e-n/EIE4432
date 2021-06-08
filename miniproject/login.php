<?php
	include "connect.php";

	echo "<form method='post'>";
	if (isset($_COOKIE["id"]))
	{
	 echo "<h3>Your ".$_COOKIE['role']." ID is ".$_COOKIE['id']."</h3>"	;
		
	}
	else
	{
		$id = $_POST["id"];
		$pw = $_POST["pw"];
		$role = $_POST["role"];
		
		
		
		setcookie("id" , $id ,time()+(60*60*24));			
		setcookie("pw" , $pw ,time()+(60*60*24));			
		setcookie("role" , $role ,time()+(60*60*24));
			
			
			echo "<h3>Welcome ".$role.". Your ID is ".$id.".</h3>";
		

	}
	echo "<input type='submit' value='log out' formaction='logout.php'>";
	echo "</form>"
	
?>