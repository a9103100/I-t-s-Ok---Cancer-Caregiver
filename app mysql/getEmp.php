<?php 
 
	 //Getting the requested id
	 $p=$_GET['p'];
	 $r=explode(";",$p);
	 $name = $r[0];
	 $date = $r[1];
	 $s=explode("-",$date);
	 $temp=(int)$s[1];
	 if($temp<10)
		 $s[1]="0".$s[1];
	 $temp=(int)$s[2];
	 if($temp<10)
		 $s[2]="0".$s[2];
	$date2=$s[0]."-".$s[1]."-".$s[2];

	 //Importing database
	 require_once('dbConnect.php');
	 
	 //Creating sql query with where clause to get an specific employee
	 $sql = "SELECT * FROM user_schedule WHERE (name='$name' and date='$date') or (name='$name' and date='$date2') ORDER BY time ASC";
	 
	 //getting result 
	 $ra = mysqli_query($con,$sql);
	 
	 //pushing result to an array 
	 $result = array();
	 while($row = mysqli_fetch_array($ra)){
	 //$row = mysqli_fetch_array($ra);
		 array_push($result,array(
		 "name"=>$row['name'],
		 "time"=>$row['time'],
		 "schedule"=>$row['schedule'],
		 ));
	 }
	 
	 //displaying in json format 

	 echo json_encode(array('result'=>$result));
	 
	 mysqli_close($con);
 ?>