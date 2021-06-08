<?php
      session_start(); //start the session
?>

<!DOCTYPE html>
<html>
<head><title>Exam</title></head>
<body>	
	
<?php
	include"login.php";
	include "connect.php";
	if(!isset($_SESSION['totScore'])||!isset($_SESSION['no']))
	{
     $_SESSION['totScore'] = 0; // Get/Set session variables
	 $_SESSION['stdScore'] = 0;
	 $_SESSION['no'] = 1; // Question no of the exam
	 $_SESSION['stdTotScore']=0;
	 //please change it afterwards 
	 $_SESSION['id'] = $_COOKIE['id'];
	 $_SESSION['course'] = $_POST['course'];
	 
	 //test case have course or not, need testing======================================
	 echo" <h2>This is ".$_SESSION['course']." Exam</h2>";
	}
	
	$id = $_SESSION['id'];
	$course = $_SESSION['course'];
	
	if(isset($_POST['userAnswer']))
	{
		// flow : get the ans and correct ans , check the answer to get the point of the question
		
		$userAnswer = $_POST['userAnswer'];
		
		$correctAnswer = $_SESSION["answer"];//mustbe amend for project
		
		$_SESSION['totScore'] = $_SESSION['totScore'] + $_SESSION["score"];
		
		$stdScore=0;
		if($correctAnswer == $userAnswer) //if user answer correctly
		{
			/*$_SESSION['stdScore'] = $_SESSION['stdScore'] + $_SESSION["score"]; // original score add points of prev question
			echo"<h2 style='color:red'>That is correct!</h2>";*/
			$stdScore=$_SESSION["score"];
			$_SESSION['stdTotScore'] = $_SESSION['stdTotScore'] + $_SESSION["score"];
		}
		else
		{
			//echo "<h2 style='color:red'>Sorry! the correct answer is $correctAnswer</h2>";
			$stdScore=0;
		}
		
		$no = $_SESSION["no"];
		$type = $_SESSION["type"];
		$question = $_SESSION["question"];
		$score = $_SESSION["score"];
		$time = gmdate("Y-m-d H:i:s", time()+ 3600*8);
		$insert="INSERT INTO stdans VALUES('$id', '$course','$no','$type','$question','$correctAnswer', '$userAnswer','$score','$stdScore','$time')";
		$result = mysqli_query($connect, $insert);
		// add question no after the insert
		$_SESSION['no'] = $_SESSION['no'] + 1;
	}
	
	//echo"<p>The question you are answering: ".$_SESSION['no'].", Total score:".$_SESSION['totScore']."</p>";
	echo"<form action ='exam.php' method='post'>";
	
	//question part
	
	
	//test case have course or not, need testing======================================
	//$getSdata = "SELECT * FROM exam WHERE course = ".$course." AND no = ". $_SESSION['no']."; // may be need to change to  '".$course."'
	//$getSdata = "SELECT * FROM exam WHERE course = 3456"AND no = ". $_SESSION['no'].;
	
	$getSdata = "SELECT * FROM exam WHERE course = '".$course."' AND no = '". $_SESSION['no']."'";
			
			$result = mysqli_query($connect, $getSdata);
			if (!$result) {
				die("Could not successfully run query.");
			}
			
			//if (mysqli_num_rows($result) == 0)
			if (mysqli_num_rows($result) > 0) 
			{
				$row = mysqli_fetch_assoc($result);
				/*echo "<table border='1px'>
					<tr>
					<th>Question " . $row["no"]. " </th>
					<th>".$row["question"]."</th>
					
				</tr>";*/
				if ($row["no"] != $_SESSION['no'])
				{
					echo "This is the end of the exam";
				}
                else if($row["type"] == 'MC')
				 {
					echo "<table border='1px'>
					<tr>
					<th>Question " . $row["no"]. " </th>
					<th>".$row["question"]."</th>
					</tr>";
					
					echo "<tr>
						<td> </td>
						<td>
						<input type ='radio' name = 'userAnswer' value='A'>A<br>
						<input type ='radio' name = 'userAnswer' value='B'>B<br>
						<input type ='radio' name = 'userAnswer' value='C'>C<br>
						<input type ='radio' name = 'userAnswer' value='D'>D<br>
						</td>
						
					</tr></table>";
				 }
				 else if($row["type"] == 'T/F')
				 {
					echo "<table border='1px'>
					<tr>
					<th>Question " . $row["no"]. " </th>
					<th>".$row["question"]."</th>
					</tr>";
					
					 echo "<tr>
						<td> </td>
						<td>
						<input type ='radio' name = 'userAnswer' value='True'>T<br>
						<input type ='radio' name = 'userAnswer' value='False'>F<br>
						</td>
						
					</tr></table>";
				 
				 }
				 
				//store the points and answer of question into the session
				$_SESSION["no"] = $row["no"];
				$_SESSION["type"] = $row["type"];
				$_SESSION["question"] = $row["question"];
				$_SESSION["answer"] = $row["answer"];
				$_SESSION["score"] = $row["score"];
				echo "<p><input type ='submit' value='Submit'></p></form>";
				echo "<p><a href ='exam-quit.php'>finish exam?</a></p>";
			}
			else
			{
				$_SESSION['no'] = $_SESSION['no'] - 1;
				echo "<p><a href ='exam-quit.php'>Exam finished, press link to exit</a></p>";
			}
		
?>
</body>
</html>