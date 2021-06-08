<?php
		$server="localhost";
		$user="root";
		$pw="";
		$db="project";
		$connect=mysqli_connect($server, $user, $pw, $db);
		if(!$connect){
			die("Connection failed: ". mysqli_connect_error());
		}
?>