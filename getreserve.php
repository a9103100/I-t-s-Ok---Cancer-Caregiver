<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
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
    if( dt.toString() == today.toString() )
      s+='<td onclick="date_click(\''+dt+'\')" style="color:blue; font-weight:bolder">'+i+every_date(dt.toString());
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
  //document.getElementById('calendar').innerHTML=s;
  return s;
}



</script>

<?php
$q = intval($_GET['q']); //month
$p = intval($_GET['p']); //year
$i = cal_days_in_month(CAL_GREGORIAN,$q,$p);  //那個月有幾天
$count = 0;
$people_num = []; //每天多少人


require_once('dbConnect.php');

while($i>0)
{
	if($q<10&&$i<10)
		$sql="SELECT * FROM user_schedule WHERE date='".$p."-0".$q."-0".$i."'"."and doctor=1";
	else if($q<10&&$i>=10)
		$sql="SELECT * FROM user_schedule WHERE date='".$p."-0".$q."-".$i."'"."and doctor=1";
	else if($q>=10&&$i<10)
		$sql="SELECT * FROM user_schedule WHERE date='".$p."-".$q."-0".$i."'"."and doctor=1";
	else
		$sql="SELECT * FROM user_schedule WHERE date='".$p."-".$q."-".$i."'"."and doctor=1";
	
	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)) {
		$count=$count+1;
	}
	
	$people_num[$i]=$count;
	$count=0;
	$i=$i-1;
	
}

function c($year,$mon,$people_num){
	$s='<table class=cal><col>';
	$s=$s.'<tr><th>日<th>一<th>二<th>三<th>四<th>五<th>六';
	$dateSrc = $year.'-'.$mon.'-1'; 
	$d=new DateTime($dateSrc); 
	$dt=date_format($d,"Y-m-d");
	$wd=date('w', strtotime($dt)); //week day
	$s=$s.'<tr>';
	for( ; $wd > 0 ; $wd--) 
		$s=$s.'<td>';
	for( $i=1; $i<32; )
	{
		$dateSrc = $year.'-'.$mon.'-'.$i; 
		$d=new DateTime($dateSrc);
		$dt=date_format($d,"Y-m-d");
		$s=$s.'<td width="100px" height="100px">'.$i.'&emsp;'.$people_num[$i].'人';
		$i=$i+1;
		$check=date("t", strtotime($dt));
		if($i > $check)
			break;
		$dateSrc = $year.'-'.$mon.'-'.$i;
		$d=new DateTime($dateSrc);
		$dt=date_format($d,"Y-m-d");
		
		$wd=date('w', strtotime($dt));
		if( $wd == 0 )
		  $s=$s.'<tr>';
	}
	for( ; $wd < 6; $wd++)  $s=$s.'<td>';
	$s=$s.'</table>'; 
    return $s;
}

//$output="<script type='text/javascript>calendar(2017,8);</script>";
//echo $output;
echo c($p,$q,$people_num);
mysqli_close($con);

?>

</body>
</html>