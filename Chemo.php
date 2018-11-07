<?php 
	session_start();
	$id = $_SESSION['id'];
	//echo $_SESSION['id'];
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Getting values
		$precaution2 = $_POST['precaution2'];
		//echo $_POST['precaution2'];
		//Creating an sql query
		$sql = "UPDATE user_schedule SET precaution2 = '$precaution2' WHERE id = '$id'";
		
		//Importing our db connection script
		require_once('dbConnect.php');
		
		//Executing query to database
		if(mysqli_query($con,$sql)){
			echo 'Precaution Added Successfully';
		}else{
			echo 'Could Not Add Precaution';
		}
		echo '<br><form name="patient_info" method=get action="https://a9103100.000webhostapp.com/patient_info.php">
		姓名：<input id="patient_name" type="text" name="name" /><br>
		生日：<input id="patient_bd" type="date" name="birthday" />
        <input type="submit" value="確認"/>    
</form>';

		//Closing the database 
		mysqli_close($con);
	}
?>


