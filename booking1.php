<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style type='text/css'>
table {
    width: 100%;
    border-collapse: collapse;
}

.cal     {border-collapse:collapse}
.cal TH  {background:lightblue;
          border:solid 1px green;
          text-align:center
         }
.cal TD  {border:solid 1px green;
          text-align:right
         }
.cal COL {background:pink}

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
<script>
function getID(){
   var date = document.getElementById("uid").value;
   parent.frames["info"].location= "info.php?date="+date; 
}
</script>
</head>

<body>
<?php
	$year=date("Y");
	$mon=date("m");
?>

<table class=cal><col>
	<tr width="50px" height="50px">
	<th onclick="showReserveNum(-1)"><<
	<th colspan=5 id="date"><?php echo $year; ?>年<?php echo $mon; ?>月
	<th onclick="showReserveNum(1)">>>
</table>
<div id=calendar></div>

 <!-- Modal content -->

<div id="myModal" class="modal">

  <div class="modal-content">
    <span class="close">&times;</span>
    <div id="t">123</div>
	<div>
		<form name="form" method=get action="https://a9103100.000webhostapp.com/reserve.php" target="right">
		<fieldset>
				<input type="date" id="dateDefault" name="date"/>&nbsp &nbsp &nbsp &nbsp
				<input type="submit" value="確認" onclick="sure_close()"/>  
		</fieldset>
		</form>
	</div>
	<!--
	<div>
    <form name="form" method=get action="https://a9103100.000webhostapp.com/info.php" target="right">
    <fieldset>
    	姓名： <input type="text" name="name"/><br>
        生日： <input type="date" name="birthday"/><br>
        行程： <input type="text" name="schedule"/><br>
        預約時間：<h id="date">2017/6/6 </h><input id="time" type="time" name="time"/><br>
        <input type="submit" value="Get ID"/>    
    </fieldset>
    </form>
    </div>
	-->
  </div>
</div>

<script type='text/javascript'>
function drawCal(inc)
{
  month+=inc;
  if(month == 0 )
  {
    month=12;
    year--;
  }
  else if( month == 13 )
       {
         month=1;
         year++;
       }
  calendar(year, month);
}
function calendar(yr, mth)
{
  var td=new Date();
  var today=new Date( td.getFullYear(), td.getMonth(), td.getDate());
  var s='<table class=cal><col>';
  //s+='<tr width="50px" height="50px"><th onclick="drawCal(-1)"><<<th colspan=5>'
  //    +yr +'年'+ mth +'月<th onclick="drawCal(1)">>>';
  mth--;
  s+='<tr><th>日<th>一<th>二<th>三<th>四<th>五<th>六';
  var dt=new Date(yr, mth, 1);
  var wd=dt.getDay(); //week day
  var i;
  s+='<tr>';
  for( ; wd > 0 ; wd--)   s+='<td>';
  for( i=1; i<32; )
  {
    dt=new Date(yr, mth, i);
	var people_num_date = every_date(dt.toString());  //當天日期,ex:2017-03-11
	
    if( dt.toString() == today.toString() )
      s+='<td onclick="date_click(\''+dt+'\')" style="color:blue; font-weight:bolder">'+i;
    else
      s+='<td onclick="date_click(\''+dt+'\')" width="100px" height="100px">'+i;
    dt=new Date(yr, mth, ++i);
    if( dt.getMonth() != mth ) break;
    wd=dt.getDay();
    if( wd == 0 )
      s+='<tr>';
  }
  for( ; wd < 6; wd++)  s+='<td>';
  s+='</table>';
  document.getElementById('calendar').innerHTML=s;
}
var td=new Date();
var year=td.getFullYear();
var month=td.getMonth()+1;
calendar(year, month);


// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

function date_click(x) {
	document.getElementById('t').innerHTML=x;
	var data,y='',m='',d='';
	for(i=11;i<15;i++)
    {
    	y+=x[i];
    }
	for(i=8;i<10;i++)
    {
    	d+=x[i];
    }
	for(i=4;i<7;i++)
    {
    	m+=x[i];
    }
	switch(m)
	{
		case "Jan":
			m="01";
			break;
		case "Feb":
			m="02";
			break;
		case "Mar":
			m="03";
			break;
		case "Apr":
			m="04";
			break;
		case "May":
			m="05";
			break;
		case "Jun":
			m="06";
			break;
		case "Jul":
			m="07";
			break;
		case "Aug":
			m="08";
			break;
		case "Sep":
			m="09";
			break;
		case "Oct":
			m="10";
			break;
		case "Nov":
			m="11";
			break;
		case "Dec":
			m="12";
			break;
		default:
			m="01";
	}
	data = y+"-"+m+"-"+d;
	console.log(data);
	document.querySelector("#dateDefault").value=data;
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

function sure_close(){
	modal.style.display = "none";
}

function every_date(x) {
	var data,y='',m='',d='';
	for(i=11;i<15;i++)
    {
    	y+=x[i];
    }
	for(i=8;i<10;i++)
    {
    	d+=x[i];
    }
	for(i=4;i<7;i++)
    {
    	m+=x[i];
    }
	switch(m)
	{
		case "Jan":
			m="01";
			break;
		case "Feb":
			m="02";
			break;
		case "Mar":
			m="03";
			break;
		case "Apr":
			m="04";
			break;
		case "May":
			m="05";
			break;
		case "Jun":
			m="06";
			break;
		case "Jul":
			m="07";
			break;
		case "Aug":
			m="08";
			break;
		case "Sep":
			m="09";
			break;
		case "Oct":
			m="10";
			break;
		case "Nov":
			m="11";
			break;
		case "Dec":
			m="12";
			break;
		default:
			m="01";
	}
	data = y+"-"+m+"-"+d;
	return data;
}

function showReserveNum(str) {
	var d=document.getElementById("date").innerHTML;
	var year="";
	var month="";
	for(i=0;i<4;i++)
		year=year+d[i];
	month=d[5]+d[6];
	
	var m=parseInt(month)+str;
	if(m>12)
	{
		year=parseInt(year)+1;
		m=01;
	}
	if(m<1)
	{
		year=parseInt(year)-1;
		m=12;
	}
	if(m==11||m==12||m==10)
		document.getElementById("date").innerHTML=year+"年"+m+"月";
	else
		document.getElementById("date").innerHTML=year+"年0"+m+"月";
  if (str=="") {
    document.getElementById("calendar").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("calendar").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","https://a9103100.000webhostapp.com/getreserve.php?q="+m+"&p="+year,true);
  xmlhttp.send();
}
</script>

</body>
</html>

