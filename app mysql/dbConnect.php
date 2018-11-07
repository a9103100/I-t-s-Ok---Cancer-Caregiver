<?php

	//Defining Constants
	define('HOST','140.116.247.183');
	define('USER','iir_college');
	define('PASS','iir_5757');
	define('DB','cosme');

	//Connecting to Database
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
	mysqli_set_charset($con,"UTF8");
?>