<?php 
	session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>123</title>
<style>
td {
	border:1.5px gray solid;
	height: 30px;
	vertical-align: top;
	text-align: left;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
</head>

<body>

<?php
	//header("Content-Type:text/html; charset=utf-8");
	date_default_timezone_set('Asia/Taipei');
	$n = $_GET['name'];
	$b = $_GET['birthday'];
	$count=0;
	$check=0; //確認今日有無行程
	$output='<table style="width:100%; border:3px green dashed;" align="center">';
	$array = array();
	$precaution1=NULL;
	$precaution2=NULL;
	$precaution3=NULL;
	
	if($n == NULL)
	{
		echo 'Please enter your name!<br>';
	}
	else
	{
		echo '<div id="dn">'.$n.'</div>'.'<div id="bn">'.$b.'</div>';
			
		require_once('dbConnect.php');
		$sql = "SELECT * FROM user_schedule WHERE name='$n' and birthday='$b' and doctor='1' ORDER BY date ASC";
		//getting result 
		 $ra = mysqli_query($con,$sql);
		 
		 //pushing result to an array 
		 $result = array();
		 while($row = mysqli_fetch_array($ra)){
		 //$row = mysqli_fetch_array($ra);
			//echo $row['time'];
			$count=$count+1;
			$output=$output.'<tr><th>'.$count.'</th><td width="95%" id="'.$count.'" onclick="schedule_click('.$count.')">'.$row['date'].'&nbsp&nbsp&nbsp'.$row['time'].'&nbsp&nbsp&nbsp'.$row['schedule'].'</td></tr>';
			array_push($result,array(
				"date"=>$row['date'],
				"time"=>$row['time'],
				"schedule"=>$row['schedule'],
				"id"=>$row['id'],
			));
		 }
		 //displaying in json format 

		 //echo json_encode(array($array));
		 
		 //mysqli_close($con);
		 $output=$output.'</table><br><br>';
		 $output=$output.'今日行程&nbsp&nbsp&nbsp'.date("Y-m-d").'<br><br>';
		 $d=date("Y-m-d");
		 $sql = "SELECT * FROM user_schedule WHERE name='$n' and birthday='$b' and date='$d'";
		 //getting result 
		 $ra = mysqli_query($con,$sql);
		 $precaution = array();
		 while($row = mysqli_fetch_array($ra)){
			$_SESSION['id']=$row['id'];
			$output=$output.'&emsp;'.$row['schedule'].'<br>'; 
			$count=1;
			if($row['precaution1']!='')
				$precaution1=$row['precaution1'];
			if($row['precaution2']!='')
				$precaution2=$row['precaution2'];
			if($row['precaution3']!='')
				$precaution3=$row['precaution3'];
		 }
		 mysqli_close($con);
		 
		 $output=$output.'<br>'.'<p><font size="3" color="red">';
		 if($precaution1!=NULL)
			 $output=$output.'※門診：'.$precaution1;
		 if($precaution2!=NULL)
			 $output=$output.'<br>※化學治療：'.$precaution2;
		 if($precaution3!=NULL)
			 $output=$output.'<br>※放射線治療：'.$precaution3;
		 $output=$output.'</font></p>';
		 
		 $output=$output.'<br><table style="width:100%; border:3px green dashed;" align="center">'; 
		 if($count==1)
		 {
			 $output=$output.'<tr><th>門診</th><td><br>
			 <form name="OC" method=post action="https://a9103100.000webhostapp.com/OC.php">
				<input list="precautions1" name="precaution1">
				<datalist id="precautions1">
					<option value="不能進行化學治療">
					<option value="必須進行化學治療">
					<option value="不能進行放射線治療">
					<option value="必須進行放射線治療">
					<option value="">
				</datalist>
				<input type="submit">
			 </form>
			 </td>
			 </tr>';
			 $output=$output.'<tr><th>化學治療</th><td><br>
			 <form name="Chemo" method=post action="https://a9103100.000webhostapp.com/Chemo.php">
				<input list="precautions2" name="precaution2">
				<datalist id="precautions2">
					<option value="不能進行放射線治療">
					<option value="必須進行放射線治療">
					<option value="">
					<option value="">
					<option value="">
				</datalist>
				<input type="submit">
			 </form>
			 </td>
			 </tr>';
			 $output=$output.'<tr><th>放射線治療</th><td><br>
			 <form name="RRT" method=post action="https://a9103100.000webhostapp.com/RRT.php">
				<input list="precautions3" name="precaution3">
				<datalist id="precautions3">
					<option value="不能進行化學治療">
					<option value="必須進行化學治療">
					<option value="">
					<option value="">
					<option value="">
				</datalist>
				<input type="submit">
			 </form>
			 </td>
			 </tr>';
			 $output=$output.'</table><br>';
		 }
		 else if($count==0)
		 {
			 $output=$output.'<tr><th>門診</th><td><br>
			 <form name="OC" method=post action="https://a9103100.000webhostapp.com/OC.php">
				<input list="precautions1" name="precaution1">
				<datalist id="precautions1">
					<option value="不能進行化學治療">
					<option value="必須進行化學治療">
					<option value="不能進行放射線治療">
					<option value="必須進行放射線治療">
					<option value="">
				</datalist>
				<input type="submit" disabled="disabled">
			 </form>
			 </td>
			 </tr>';
			 $output=$output.'<tr><th>化學治療</th><td><br>
			 <form name="Chemo" method=post action="https://a9103100.000webhostapp.com/Chemo.php">
				<input list="precautions2" name="precaution2">
				<datalist id="precautions2">
					<option value="不能進行放射線治療">
					<option value="必須進行放射線治療">
					<option value="">
					<option value="">
					<option value="">
				</datalist>
				<input type="submit" disabled="disabled">
			 </form>
			 </td>
			 </tr>';
			 $output=$output.'<tr><th>放射線治療</th><td><br>
			 <form name="RRT" method=post action="https://a9103100.000webhostapp.com/RRT.php">
				<input list="precautions3" name="precaution3">
				<datalist id="precautions3">
					<option value="不能進行化學治療">
					<option value="必須進行化學治療">
					<option value="">
					<option value="">
					<option value="">
				</datalist>
				<input type="submit" disabled="disabled">
			 </form>
			 </td>
			 </tr>';
			 $output=$output.'</table><br>';
		 }
		 
	}
?>
<br>
<form name="patient_info" method=get action="https://a9103100.000webhostapp.com/patient_info.php">
		姓名：<input id="patient_name" type="text" name="name" /><br>
		生日：<input id="patient_bd" type="date" name="birthday" />
        <input type="submit" value="確認"/>    
</form>
<?PHP echo $output?>


 <!-- Modal content -->

<div id="myModal" class="modal">

  <div class="modal-content">
    <span class="close">&times;</span>
	<div>
		<form name="form" method=post action="https://a9103100.000webhostapp.com/edit.php">
			<fieldset>
				姓名： <input id="nameD" type="text" name="name"/><br>
				生日： <input id="birthdayD" type="date" name="birthday"/><br>
				行程： <input id="scheduleD" type="text" name="schedule"/><br>
				預約日期：<input id="dateD" type="date" name="date" /><br>
				預約時間：<input id="timeD" type="time" name="time"/><br>   
				<input type="submit" name="delete" value="刪除"/>
			</fieldset>
		</form>
	</div>
  </div>
</div>


<script type='text/javascript'>
function name_default()
{
	var data = document.getElementById('dn').innerHTML;
	var data_b = document.getElementById('bn').innerHTML;
	document.querySelector("#patient_name").value=data;
	document.getElementById("nameD").defaultValue=data;
	document.querySelector("#patient_bd").value=data_b;
	document.getElementById("birthdayD").defaultValue=data_b;
}
name_default();

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

function schedule_click(c){
	var data=document.getElementById(c).innerHTML;
	var d='';
	var t='';
	var s='';
	for(i=0;i<10;i++)
	{
		d=d+data[i];
	}
	for(i=28;i<33;i++)
	{
		t=t+data[i]
	}
	for(i=51;i<data.length;i++)
	{
		s=s+data[i]
	}
	document.querySelector("#dateD").value=d;
	document.querySelector("#timeD").value=t;
	document.querySelector("#scheduleD").value=s;
	modal.style.display = "block";
}


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>


