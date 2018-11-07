<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>123</title>
</head>

<body>

<?php
	header("Content-Type:text/html; charset=utf-8");
	$n = $_GET['date'];
	if($n == NULL)
	{
		echo 'Please enter date!';
	}
	else
	{
		echo '<div id="dt">'.$n.'</div>';
			
		require_once('dbConnect.php');
		$sql = "SELECT * FROM user_schedule WHERE date='$n'";
		//getting result 
		 $ra = mysqli_query($con,$sql);
		 
		 //pushing result to an array 
		 $result = array();
		 while($row = mysqli_fetch_array($ra)){
		 //$row = mysqli_fetch_array($ra);
			 array_push($result,array(
			 "name"=>$row['name'],
			 "time"=>$row['time'],
			 ));
		 }
		 
		 //displaying in json format 

		 echo json_encode(array('result'=>$result));
		 
		 mysqli_close($con);
	}
?>

<form name="datepick" method=post action="">
		預約日期：<input id="dateDefault" type="date" name="date" />
        <input type="submit" value="確認"/>    
</form>

<form name="form" method=post action="https://a9103100.000webhostapp.com/add.php">
<fieldset>
    	姓名： <input type="text" name="name"/><br>
        生日： <input type="date" name="birthday"/><br>
        行程： <input type="text" name="schedule"/><br>
		預約日期：<input id="dateDefault" type="date" name="date" /><br>
        預約時間：<input id="time" type="time" name="time"/><br>
        <input type="submit" value="確認"/>    
</fieldset>
</form>

<script type='text/javascript'>
function da()
{
	var data = document.getElementById('dt').innerHTML;
	document.querySelector("#dateDefault").value=data;
}
da();
</script>
</body>
</html>

