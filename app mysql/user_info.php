<?php 
 
	 //Getting the requested id
	 $n=$_GET['n'];
	 $b=$_GET['b'];
	 
	 //Importing database
	 require_once('dbConnect.php');
	 
	 //Creating sql query with where clause to get an specific employee
	 $sql = "SELECT * FROM user_info WHERE name='$n' and birthday='$b'";
	 
	 //getting result 
	 $ra = mysqli_query($con,$sql);
	 
	 //pushing result to an array 
	 $result = array();
	 while($row = mysqli_fetch_array($ra)){
		 array_push($result,array(
		 "case_num"=> $row['case_num'],
		 ));
	 }
	 
	 if (empty($result)) {
		//Creating an sql query
		$sql = "INSERT INTO user_info (name,birthday) VALUES ('$n','$b')";
		
		//Executing query to database
		if(mysqli_query($con,$sql)){
			$sql = "SELECT * FROM user_info WHERE name='$n' and birthday='$b'";
			 //getting result 
			 $ra = mysqli_query($con,$sql);
			 
			 //pushing result to an array 
			 while($row = mysqli_fetch_array($ra)){
				 array_push($result,array(
				 "case_num"=> $row['case_num'],
				 ));
			 }
			//echo 'info Added Successfully';
			echo json_encode(array('result'=>$result));
		}else{
			//echo 'Could Not Add info';
		}
	 }
	 //displaying in json format 
	else{
		echo json_encode(array('result'=>$result));
	}
	 
	 
	 mysqli_close($con);
 ?>