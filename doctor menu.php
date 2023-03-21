<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	if(isset($_SESSION["system_usertype"]))
	{
		$this_system_usertype=$_SESSION["system_usertype"];
		$this_system_username=$_SESSION["system_username"];
	}
	else
	{
		$this_system_usertype="guest";
	}	
?>

<html>
	<head> </head>
	<body>	
		<td width="41%"> <br> <br>
			<font size="3px"> 
				<a href="index.php?pg=doctor.php&option=profile">PROFILE</a>
				<a href="index.php?pg=appointments.php&option=personal_view">VIEW APPOINTMENTS</a> 
				<a href="index.php?pg=doctor%20visit.php&option=view&visit_doctorid=<?php echo $this_system_username; ?>">MY DUTY TIME</a> 
				<?php
						if($this_system_usertype=="guest")
						{
							echo "<a href='index.php?pg=login.php'>LOGIN</a>";
						}
						else
						{
							echo "<a href='logout.php'>LOGOUT</a><br>";
						}
				?>
			</font>
		</td>
	</body>
</html>

