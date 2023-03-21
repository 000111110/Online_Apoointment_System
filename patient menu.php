
<html>
	<head> </head>
	<body>
		<td width="60%"> <br> <br>
			<font size="3px"> 
				<a href="index.php?pg=guest home.php">HOME</a>
				<a href="index.php?pg=about.php">ABOUT US</a> 
				<a href="index.php?pg=appointments.php&option=add">MAKE APPOINTMENT</a>
				<a href="index.php?pg=service.php">SERVICE</a>
				<a href="index.php?pg=appointments.php&option=personal_view">MY APPOINTMENTS</a>
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

