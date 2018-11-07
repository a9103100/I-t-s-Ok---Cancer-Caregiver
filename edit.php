<?php 
    if(isset($_POST['edit'])){
		edit();
    }
    if(isset($_POST['delete'])){
		delete();
    }
	
	function edit() {
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			//Getting values
			$name = $_POST['name'];
			$birthday = $_POST['birthday'];
			$date = $_POST['date'];
			$time = $_POST['time'];
			$schedule = $_POST['schedule'];
			
			//Creating an sql query
			$sql = "UPDATE user_schedule SET date = '$date', time = '$time', schedule = '$schedule' WHERE name = '$name'";
			//Importing our db connection script
			require_once('dbConnect.php');
			
			//Executing query to database
			if(mysqli_query($con,$sql)){
				echo 'Schedule Edited Successfully';
			}else{
				echo 'Could Not Edit Schedule';
			}
			echo '<form name="patient_info" method=get action="https://a9103100.000webhostapp.com/patient_info.php">
			姓名：<input id="patient_name" type="text" name="name" /><br>
			生日：<input id="patient_bd" type="date" name="birthday" />
			<input type="submit" value="確認"/>    
			</form>';

			//Closing the database 
			mysqli_close($con);
		}
		exit;
	}
	
	function delete() {
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			//Getting values
			$name = $_POST['name'];
			$birthday = $_POST['birthday'];
			$date = $_POST['date'];
			$time = $_POST['time'];
			$schedule = $_POST['schedule'];
			
			//Creating an sql query
			$sql = "DELETE FROM user_schedule WHERE name = '$name' AND birthday = '$birthday' AND date = '$date' AND time = '$time' AND schedule = '$schedule'";
			//Importing our db connection script
			require_once('dbConnect.php');
			
			//Executing query to database
			if(mysqli_query($con,$sql)){
				echo 'Schedule Deleted Successfully';
			}else{
				echo 'Could Not Delete Schedule';
			}
			echo '<form name="patient_info" method=get action="https://a9103100.000webhostapp.com/patient_info.php">
			姓名：<input id="patient_name" type="text" name="name" /><br>
			生日：<input id="patient_bd" type="date" name="birthday" />
			<input type="submit" value="確認"/>    
			</form>';

			//Closing the database 
			mysqli_close($con);
		}
		exit;
	}
	
?>


