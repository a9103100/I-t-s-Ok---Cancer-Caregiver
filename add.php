<?php 
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Getting values
		$name = $_POST['name'];
		$birthday = $_POST['birthday'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$schedule = $_POST['schedule'];
		
		//Importing our db connection script
		require_once('dbConnect.php');
		
		
		$sql = "SELECT * FROM user_info WHERE name='".$name."' and birthday='".$birthday."'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		$case_num = '0';
		$case_num = $row['case_num'];
		
		
		//Creating an sql query
		$sql = "INSERT INTO user_schedule (case_num,name,birthday,date,time,schedule,doctor) VALUES ('$case_num','$name','$birthday','$date','$time','$schedule',1)";
		
	
		//Executing query to database
		if(mysqli_query($con,$sql)){
			echo 'Schedule Added Successfully';
		}else{
			echo 'Could Not Add Schedule';
		}
		echo '<form name="datepick" method=get action="https://a9103100.000webhostapp.com/reserve.php">
		預約日期：<input id="dateDefault" type="date" name="date" />
        <input type="submit" value="確認"/>    
</form>';

		//Closing the database 
		mysqli_close($con);
	}
?>


