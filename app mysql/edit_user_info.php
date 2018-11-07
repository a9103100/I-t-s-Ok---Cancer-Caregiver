<?php 
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Getting values 
		$case_num = $_POST['case_num'];
		$first_visit = $_POST['first_visit'];
		$VS = $_POST['VS'];
		$other_history = $_POST['other_history'];
		$drug_allergy = $_POST['drug_allergy'];
		$remark = $_POST['remark'];

		//importing database connection script 
		require_once('dbConnect.php');
		
		//Creating sql query 
		$sql = "UPDATE user_info SET first_visit = '$first_visit', VS = '$VS', other_history = '$other_history', drug_allergy = '$drug_allergy', remarks = '$remark' WHERE case_num = '$case_num'";

		//Updating database table 
		if(mysqli_query($con,$sql)){
			echo 'info Updated Successfully';
		}else{
			echo 'Could Not Update info Try Again';
		}
		
		//closing connection 
		mysqli_close($con);
	}
?>