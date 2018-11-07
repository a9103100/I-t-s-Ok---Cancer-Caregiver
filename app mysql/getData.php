<?php 
 
	 //Getting the requested id
	 $name = $_GET['n'];
	 //Importing database
	 require_once('dbConnect.php');
	 
	 //Creating sql query with where clause to get an specific employee
	 $sql = "SELECT * FROM user_schedule WHERE name='$name'";
	 
	 //getting result 
	 $ra = mysqli_query($con,$sql);
	 
	 //pushing result to an array 
	 $result = array();
	 while($row = mysqli_fetch_array($ra)){
	 //$row = mysqli_fetch_array($ra);
		 array_push($result,array(
		 "date"=>$row['date'],
		 "doctor"=>$row['doctor'],
		 ));
	 }
	 
	 //displaying in json format 

	 echo json_encode(array('result'=>$result));
	 
	 mysqli_close($con);
 ?>