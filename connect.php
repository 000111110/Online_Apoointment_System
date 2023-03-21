<?php
	$connect = mysqli_connect("localhost","root","");
	if(!$connect)
	{
		die("Server Error");
	}
	$db = mysqli_select_db($connect,"winton_management_system");
	if(!$db)
	{
		die("Database Error".mysqli_error($connect));
	}

?>