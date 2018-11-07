<?php 
	//Getting Id 
	 $p=$_POST['p'];
	 $r=explode(";",$p);
	 $case_num = $r[0];
	 $name = $r[1];
	 $birthday = $r[2];
	 $time = $r[3];
	 $schedule = $r[4];	
	 $date = $r[5];
	 
	 echo $name;
	 echo $birthday;
	 echo $schedule;
	 echo $time;
	 echo $date;
	 
	//Importing database
	require_once('dbConnect.php');
	
	//Creating sql query
	$sql = "DELETE FROM user_schedule WHERE case_num='$case_num' and name='$name' and birthday='$birthday' and schedule='$schedule' and time='$time' and date='$date';";
	
	//Deleting record in database 
	if(mysqli_query($con,$sql)){
		echo 'schedule Deleted Successfully';
	}else{
		echo 'Could Not Delete schedule  Try Again';
	}
	$result = array();
	echo json_encode(array('result'=>$result));
	 
	//closing connection 
	mysqli_close($con);
?>