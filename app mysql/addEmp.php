<?php 
	if($_SERVER['REQUEST_METHOD']=='POST'){

		//Getting values
		$case = $_POST['case'];
		$name = $_POST['name'];
		$birthday = $_POST['birthday'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$schedule = $_POST['schedule'];
		//$doctor = $_POST['doctor'];
		
		//Creating an sql query
		$sql = "INSERT INTO user_schedule (case_num,name,birthday,date,time,schedule) VALUES ('$case','$name','$birthday','$date','$time','$schedule')";
		
		//Importing our db connection script
		require_once('dbConnect.php');
		
		//Executing query to database
		if(mysqli_query($con,$sql)){
			echo 'Schedule Added Successfully';
		}else{
			echo 'Could Not Add Schedule';
		}
		
		//Closing the database 
		mysqli_close($con);
	}
?>