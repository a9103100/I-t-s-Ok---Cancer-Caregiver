<?php 
 
	 //Getting the requested id
	 $case_num=$_GET['c'];
	 $date=$_GET['d'];
	 //Importing database
	 require_once('dbConnect.php');
	 
	 //Creating sql query with where clause to get an specific employee
	 $sql = "SELECT * FROM user_schedule WHERE case_num='$case_num' and date='$date' ORDER BY time ASC";
	 
	 //getting result 
	 $ra = mysqli_query($con,$sql);
	 
	 //pushing result to an array 
	 $result = array();
	 while($row = mysqli_fetch_array($ra)){
	 //$row = mysqli_fetch_array($ra);
		 array_push($result,array(
		 "time"=>$row['time'],
		 "schedule"=>$row['schedule'],
		 ));
	 }
	 
	 //displaying in json format 

	 echo json_encode(array('result'=>$result));
	 
	 mysqli_close($con);
 ?>