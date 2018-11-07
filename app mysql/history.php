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
		 "diagnosis"=>$row['diagnosis'],
		 "surgery_date"=>$row['surgery_date'],
		 "surgery_name"=>$row['surgery_name'],
		 "surgeon"=>$row['surgeon'],
		 "pathologic_report"=>$row['pathologic_report'],
		 "other_surgery_date"=>$row['other_surgery_date'],
		 "other_surgery_name"=>$row['other_surgery_name'],
		 "other_surgeon"=>$row['other_surgeon'],
		 "LN"=>$row['LN'],
		 "ER"=>$row['ER'],
		 "PR"=>$row['PR'],
		 "T"=>$row['T'],
		 "N"=>$row['N'],
		 "M"=>$row['M'],
		 "FLSH"=>$row['FLSH'],
		 "Starg"=>$row['Starg'],
		 ));
	 }
	 
	 //displaying in json format 

	 echo json_encode(array('result'=>$result));
	 
	 mysqli_close($con);
 ?>