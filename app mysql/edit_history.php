<?php 
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Getting values 
		$case_num = $_POST['case_num'];
		$diagnosis = $_POST['diagnosis'];
		$surgery_date = $_POST['surgery_date'];
		$surgery_name = $_POST['surgery_name'];
		$surgeon = $_POST['surgeon'];
		$pathologic_report = $_POST['pathologic_report'];
		$other_surgery_date = $_POST['other_surgery_date'];
		$other_surgery_name = $_POST['other_surgery_name'];
		$other_surgeon = $_POST['other_surgeon'];
		$LN = $_POST['LN'];
		$ER = $_POST['ER'];
		$PR = $_POST['PR'];
		$T = $_POST['T'];
		$N = $_POST['N'];
		$M = $_POST['M'];
		$FLSH = $_POST['FLSH'];
		$Starg = $_POST['Starg'];

		//importing database connection script 
		require_once('dbConnect.php');
		
		//Creating sql query 
		$sql = "UPDATE user_info SET diagnosis = '$diagnosis', surgery_date = '$surgery_date', surgery_name = '$surgery_name', surgeon = '$surgeon', pathologic_report = '$pathologic_report', other_surgery_date = '$other_surgery_date', other_surgery_name = '$other_surgery_name', other_surgeon = '$other_surgeon', LN = '$LN', ER = '$ER', PR = '$PR', T = '$T', N = '$N', M = '$M', FLSH = '$FLSH', Starg = '$Starg' WHERE case_num = '$case_num'";

		//Updating database table 
		if(mysqli_query($con,$sql)){
			echo 'history Updated Successfully';
		}else{
			echo 'Could Not Update history Try Again';
		}
		
		//closing connection 
		mysqli_close($con);
	}
?>