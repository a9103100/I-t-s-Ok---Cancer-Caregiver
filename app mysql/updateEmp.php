<?php 
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//Getting values 
		$id = $_POST['id'];
		$name = $_POST['name'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$schedule = $_POST['schedule'];
		
		//importing database connection script 
		require_once('dbConnect.php');
		
		//Creating sql query 
		$sql = "UPDATE user_schedule SET name = '$name', date = '$date', time= '$time', schedule='$schedule' WHERE id = $id;";
		
		//Updating database table 
		if(mysqli_query($con,$sql)){
			echo 'schedule Updated Successfully';
		}else{
			echo 'Could Not Update schedule Try Again';
		}
		
		//closing connection 
		mysqli_close($con);
	}
?>