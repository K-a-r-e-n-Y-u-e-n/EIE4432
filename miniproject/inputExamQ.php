<!DOCTYPE html>
<html>
<head><title>Add Questions</title></head>
<body>
	<?php
		include "login.php";
		$num=$_POST["numOfQ"];
	?>
	<form action="post">
		<?php
			echo "<p>Please input the question, type, choices and answer: </p>
			<p style='color:red'>If the question type is MC, please just input choice and correct answer for MC.</p>
			<p style='color:red'>If the question type is T/F, please just input choice and correct answer for T/F.</p>";
			
			for($i=1;$i<=$num;$i++)
			{
				echo "<table>
				<tr><td>$i</td><td>Question: </td><td><input type = 'text' name='question' id='question' style='height:70px'></td></tr>
				
				<tr><td></td><td>Score: </td><td><input type='number' id='score' name='score'>

				<tr><td></td><td>Type: </td><td><select id='type' name='type'>
				<option></option>
				<option>MC</option>
				<option>T/F</option></td></tr>
				</select></td></tr>
				
				<tr><td></td><td>Choice for MC: </td><td>A<input type = 'text' name='a' id='a'></td><td>Choice for T/F: </td><td>T<input type = 'text' name='t' id='t'></td></tr>
				<tr><td></td><td></td><td>B<input type = 'text' name='b' id='b'></td><td></td><td>F<input type = 'text' name='f' id='f'></td></tr>
				<tr><td></td><td></td><td>C<input type = 'text' name='c' id='c'></td></tr>
				<tr><td></td><td></td><td>D<input type = 'text' name='d' id='d'></td></tr>
				
				<tr>
				<td></td><td>Correct Answer (for MC)</td><td><select id='mcAns' name='mcAns'>
				<option></option>
				<option>A</option>
				<option>B</option>
				<option>C</option>
				<option>D</option>
				</select></td>
				
				<td>Correct Answer (for T/F)</td><td><select id='tfAns' name='tfAns'>
				<option></option>
				<option>T</option>
				<option>F</option>
				</select></td></tr>		
				
				</table><br><br>";
			}
		?>
		
		<input type='submit' value='Submit to insert questions' formaction='insertQ.php'>
		<br><br><a href="addExam.php">Back to previous page to modify</a>
	</form>
</body>
</html>