<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>123</title>
<style>
td {
	border:1.5px gray solid;
	height: 100px;
	width: 500px;
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
	$n = $_GET['date'];
	$name1="";$name2="";$name3="";$name4="";$name5="";$name6="";
	$name7="";$name8="";$name9="";$name10="";$name11="";$name12="";
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
			//echo $row['time'];
			if(($row['time']=='09:00'))
			{
				$name1=$name1.$row['name'].'<br>';
			}
			else if($row['time']=='09:30')
			{
				$name2=$name2.$row['name'].'<br>';
			}
			else if($row['time']=='10:00')
			{
				$name3=$name3.$row['name'].'<br>';
			}
			else if($row['time']=='10:30')
			{
				$name4=$name4.$row['name'].'<br>';
			}
			else if($row['time']=='11:00')
			{
				$name5=$name5.$row['name'].'<br>';
			}
			else if($row['time']=='11:30')
			{
				$name6=$name6.$row['name'].'<br>';
			}
			else if($row['time']=='13:30')
			{
				$name7=$name7.$row['name'].'<br>';
			}
			else if($row['time']=='14:00')
			{
				$name8=$name8.$row['name'].'<br>';
			}
			else if($row['time']=='14:30')
			{
				$name9=$name9.$row['name'].'<br>';
			}
			else if($row['time']=='15:00')
			{
				$name10=$name10.$row['name'].'<br>';
			}
			else if($row['time']=='15:30')
			{
				$name11=$name11.$row['name'].'<br>';
			}
			else if($row['time']=='16:00')
			{
				$name12=$name12.$row['name'].'<br>';
			}
			array_push($result,array(
				"name"=>$row['name'],
				"time"=>$row['time'],
			));
		 }
		 //displaying in json format 

		 //echo json_encode(array('result'=>$result));
		 
		 mysqli_close($con);
	}
?>

<form name="datepick" method=get action="https://a9103100.000webhostapp.com/reserve.php">
		預約日期：<input id="dateDefault" type="date" name="date" />
        <input type="submit" value="確認"/>    
</form>
<table style="border:3px green dashed;" align="center">
	<tr>
		<th>9:00</th>
		<td id="time1" onclick="time_click(1)"><?PHP echo $name1 ?></td>
	</tr>
	<tr>
		<th>9:30</th>
		<td id="time2" onclick="time_click(2)"><?PHP echo $name2 ?></td>
	</tr>
	<tr>
		<th>10:00</th>
		<td id="time3" onclick="time_click(3)"><?PHP echo $name3 ?></td>
	</tr>
	<tr>
		<th>10:30</th>
		<td id="time4" onclick="time_click(4)"><?PHP echo $name4 ?></td>
	</tr>
	<tr>
		<th>11:00</th>
		<td id="time5" onclick="time_click(5)"><?PHP echo $name5 ?></td>
	</tr>
	<tr>
		<th>11:30</th>
		<td id="time6" onclick="time_click(6)"><?PHP echo $name6 ?></td>
	</tr>
	<tr>
		<th>13:30</th>
		<td id="time7" onclick="time_click(7)"><?PHP echo $name7 ?></td>
	</tr>
	<tr>
		<th>14:00</th>
		<td id="time8" onclick="time_click(8)"><?PHP echo $name8 ?></td>
	</tr>
	<tr>
		<th>14:30</th>
		<td id="time9" onclick="time_click(9)"><?PHP echo $name9 ?></td>
	</tr>
	<tr>
		<th>15:00</th>
		<td id="time10" onclick="time_click(10)"><?PHP echo $name10 ?></td>
	</tr>
	<tr>
		<th>15:30</th>
		<td id="time11" onclick="time_click(11)"><?PHP echo $name11 ?></td>
	</tr>
	<tr>
		<th>16:00</th>
	    <td id="time12" onclick="time_click(12)"><?PHP echo $name12 ?></td>
	</tr>
  <tr>

  </tr>
</table>
<!--
<table style="border:3px green dashed;" align="center">
  <tr>
    <th>9:00</th>
    <th>9:30</th>
    <th>10:00</th>
  </tr>
  <tr>
    <td id="time1" onclick="time_click(1)"><?PHP echo $name1 ?></td>
    <td id="time2" onclick="time_click(2)"><?PHP echo $name2 ?></td>
    <td id="time3" onclick="time_click(3)"><?PHP echo $name3 ?></td>
  </tr>
  <tr>
    <th>10:30</th>
    <th>11:00</th>
    <th>11:30</th>
  </tr>
  <tr>
    <td id="time4" onclick="time_click(4)"><?PHP echo $name4 ?></td>
    <td id="time5" onclick="time_click(5)"><?PHP echo $name5 ?></td>
    <td id="time6" onclick="time_click(6)"><?PHP echo $name6 ?></td>
  </tr>
  <tr>
    <th>13:30</th>
    <th>14:00</th>
    <th>14:30</th>
  </tr>
  <tr>
    <td id="time7" onclick="time_click(7)"><?PHP echo $name7 ?></td>
    <td id="time8" onclick="time_click(8)"><?PHP echo $name8 ?></td>
    <td id="time9" onclick="time_click(9)"><?PHP echo $name9 ?></td>
  </tr>
  <tr>
    <th>15:00</th>
    <th>15:30</th>
    <th>16:00</th>
  </tr>
  <tr>
    <td id="time10" onclick="time_click(10)"><?PHP echo $name10 ?></td>
    <td id="time11" onclick="time_click(11)"><?PHP echo $name11 ?></td>
    <td id="time12" onclick="time_click(12)"><?PHP echo $name12 ?></td>
  </tr>
</table>
-->

 <!-- Modal content -->

<div id="myModal" class="modal">

  <div class="modal-content">
    <span class="close">&times;</span>
	<div>
		<form name="form" method=post action="https://a9103100.000webhostapp.com/add.php">
			<fieldset>
				姓名： <input type="text" name="name"/><br>
				生日： <input type="date" name="birthday"/><br>
				行程： <input type="text" name="schedule"/><br>
				預約日期：<input id="dateD" type="date" name="date" /><br>
				預約時間：<input id="timeDefault" type="time" name="time"/><br>
				<input type="submit" value="確認"/>    
			</fieldset>
		</form>
	</div>
  </div>
</div>


<script type='text/javascript'>
function date_default()
{
	var data = document.getElementById('dt').innerHTML;
	document.querySelector("#dateDefault").value=data;
	document.getElementById("dateD").defaultValue=data;
}
date_default();

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

function time_click(time){
	if(time==1){document.getElementById("timeDefault").defaultValue = "09:00";}
	else if(time==2){document.getElementById("timeDefault").defaultValue = "09:30";}
	else if(time==3){document.getElementById("timeDefault").defaultValue = "10:00";}
	else if(time==4){document.getElementById("timeDefault").defaultValue = "10:30";}
	else if(time==5){document.getElementById("timeDefault").defaultValue = "11:00";}
	else if(time==6){document.getElementById("timeDefault").defaultValue = "11:30";}
	else if(time==7){document.getElementById("timeDefault").defaultValue = "13:30";}
	else if(time==8){document.getElementById("timeDefault").defaultValue = "14:00";}
	else if(time==9){document.getElementById("timeDefault").defaultValue = "14:30";}
	else if(time==10){document.getElementById("timeDefault").defaultValue = "15:00";}
	else if(time==11){document.getElementById("timeDefault").defaultValue = "15:30";}
	else if(time==12){document.getElementById("timeDefault").defaultValue = "16:00";}
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

