<?php
		include "connect.php";
		
		$id = $_POST['loginId'];
		$pw = $_POST['pw'];
		$nick = $_POST['nick'];
		$email = $_POST['email'];
		$course = $_POST['course'];
		$file =addslashes(file_get_contents($_FILES["myimage"]["tmp_name"]));
		
		$checkId="SELECT * FROM teacher WHERE id='".$id."';";
		$checkTid = mysqli_query($connect, $checkId);
		
		if(($id=="")||($pw=="")||($nick=="")||($email=="")||($course=="")||($file=="")) {
			echo "Please input all the information!</br>";
			echo "<a href='http://localhost/web/miniproject/insertT.html'>back to teacher registration</a>";
		}
		else if(mysqli_num_rows($checkTid)>0){
			echo "This ID has been used by other. Please use another ID.<br>";
			echo "<a href='http://localhost/web/miniproject/insertT.html'>back to teacher registration</a>";
		}
		else if(preg_match_all("/@/i", $email)!=1) {
			echo "Please input a valid email.<br>";
			echo "<a href='http://localhost/web/miniproject/insertT.html'>back to teacher registration</a>";
		}
		else {
			//insert query for teacher
			$insert="INSERT INTO teacher VALUES('$id', '$pw','$nick','$email','$course','$file')";
			$insert_t = mysqli_query($connect, $insert);
			
			if($insert_t) {
				if (isset($_COOKIE["id"])) {
					if("admin"==$_COOKIE["id"]) {
						echo "<p><b>A new teacher is added.</b></p>";
						echo "<a href='http://localhost/web/miniproject/admin.php'>back to main page</a>";
					}
					else {
						setcookie("id", $_COOKIE["id"],time()-3600);
						setcookie("pw", $_COOKIE["pw"],time()-3600);
						echo "<p><b>Your registration is successful! Please login.</b></p>";
						echo "<a href='http://localhost/web/miniproject/login.html'>back to login</a>";
					}
				}
				else {
					echo "<p><b>Your registration is successful! Please login.</b></p>";
					echo "<a href='http://localhost/web/miniproject/login.html'>back to login</a>";
				}
			}
			else {
				die("Could not successfully run query.");
			}
		}
?>