<?php 
 
	 //Getting the requested id
	 $c=$_GET['c'];

	 //Importing database
	 require_once('dbConnect.php');
	 
	 //Creating sql query with where clause to get an specific employee
	 $sql = "SELECT * FROM user_info WHERE case_num='$c'";
	 
	 //getting result 
	 $ra = mysqli_query($con,$sql);
	 
	 //pushing result to an array 
	 $result = array();
	 while($row = mysqli_fetch_array($ra)){
	 //$row = mysqli_fetch_array($ra);
		 array_push($result,array(
		 "first_visit"=>$row['first_visit'],
		 "VS"=>$row['VS'],
		 "other_history"=>$row['other_history'],
		 "drug_allergy"=>$row['drug_allergy'],
		 "remarks"=>$row['remarks'],
		 ));
	 }
	 
	 //displaying in json format 

	 echo json_encode(array('result'=>$result));
	 
	 mysqli_close($con);
 ?>