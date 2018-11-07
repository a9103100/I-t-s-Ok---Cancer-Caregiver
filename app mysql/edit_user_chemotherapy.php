<?php 
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Getting values 
		$case_num = $_POST['case_num'];
		$height = $_POST['height'];
		$weight = $_POST['weight'];
		$BSA = $_POST['BSA'];
		$CCr = $_POST['CCr'];
		$CCr_date = $_POST['CCr_date'];
		$EF = $_POST['EF'];
		$EF_date = $_POST['EF_date'];
		$beforehand_medicine = $_POST['beforehand_medicine'];
		$medicine = $_POST['medicine'];
		$treatment = $_POST['treatment'];
		//$port_A = $_POST['port_A'];
		$remarks_treatment = $_POST['remarks_treatment'];

		//importing database connection script 
		require_once('dbConnect.php');
		
		//Creating sql query 
		$sql = "UPDATE user_info SET height = '$height' ,weight = '$weight' ,BSA = '$BSA' ,CCr = '$CCr' ,CCr_date = '$CCr_date' ,EF = '$EF' ,EF_date = '$EF_date' ,beforehand_medicine = '$beforehand_medicine' ,medicine = '$medicine' ,treatment = '$treatment' ,remarks_treatment = '$remarks_treatment' WHERE case_num = '$case_num'";

		//Updating database table 
		if(mysqli_query($con,$sql)){
			echo 'chemotherapy Updated Successfully';
		}else{
			echo 'Could Not Update chemotherapy Try Again';
		}
		
		//closing connection 
		mysqli_close($con);
	}
?>