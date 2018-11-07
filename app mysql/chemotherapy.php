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
		 "height"=>$row['height'],
		 "weight"=>$row['weight'],
		 "BSA"=>$row['BSA'],
		 "CCr"=>$row['CCr'],
		 "CCr_date"=>$row['CCr_date'],
		 "EF"=>$row['EF'],
		 "EF_date"=>$row['EF_date'],
		 "beforehand_medicine"=>$row['beforehand_medicine'],
		 "medicine"=>$row['medicine'],
		 "treatment"=>$row['treatment'],
		 "port_A"=>$row['port-A'],
		 "remarks_treatment"=>$row['remarks_treatment'],
		 ));
	 }
	 
	 //displaying in json format 

	 echo json_encode(array('result'=>$result));
	 
	 mysqli_close($con);
 ?>