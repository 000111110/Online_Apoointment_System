
<html>
	<head>	</head>
	<body>
		<td width="35%"> <br> <br>
			<font size="3px"> 
				<a href="index.php?pg=guest home.php">HOME</a> 
				<a href="index.php?pg=about.php">ABOUT US</a>  
				<a href="index.php?pg=service.php">OUR SERVICE</a>
				<a href="index.php?pg=gallery.php">GALLERY</a>
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

