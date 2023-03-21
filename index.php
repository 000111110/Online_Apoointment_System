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
	include("connect.php");
?>

<script>
	function confirm_delete()
	{
		var x=confirm("All the records related to this record will be deleted. Do you really want to delete this record");
		if(x)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>
<script>
	function cancel_apointment()
	{
		var x=confirm("Do you really want to Cancel the appointment");
		if(x)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>

<html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewpoint" content="width=device-width, initial-scale=1.0">
		<title> Wintan Hospital </title>
		<link href="css/style.css" rel="stylesheet">
		<script src="https://kit.fontawesome.com/20cee36f21.js" crossorigin="anonymous"> </script>
	</head>
	<body>
		<div class="top">
			<div>
				<font color="Black"> Contact Us +94 21222 2222 |  wintan@hospital.com </font>
			</div>
		</div>
		<div class="logo">
			<div>
				<?php	
					if($this_system_usertype != "guest")
					{
						if($this_system_usertype=="doctor")
						{
							$sqlusername="SELECT First_Name,Last_Name FROM doctor_details WHERE Doctor_ID ='$this_system_username'";
							$resultusername=mysqli_query($connect,$sqlusername) or die("sql error in sql username".mysqli_error($connect));
							$rowusername=mysqli_fetch_assoc($resultusername);
							$userName=$rowusername['First_Name'];
						}
						else if($this_system_usertype=="patient")
						{
							$sqlusername="SELECT First_Name,Last_Name FROM patient_details WHERE Patient_ID ='$this_system_username'";
							$resultusername=mysqli_query($connect,$sqlusername) or die("sql error in sql username".mysqli_error($connect));
							$rowusername=mysqli_fetch_assoc($resultusername);
							$userName=$rowusername['First_Name'];
						}
						else if($this_system_usertype=="admin")
						{
							$userName=" ";
						}
						
						//	pending
						echo "<img style='border-radius:50%; height:30px; width:30px; float:right;' src='image/user.jpg'>
								<h4 style='float:right; text-decoration:none; color:black;'>".$this_system_usertype.": ".$userName."</h4>";
								
					}
					else
					{
						echo "<img style='border-radius:50%; height:30px; width:30px; float:right;' src='image/user.jpg'>";
					}
				?>
			</div>	
			<div>	
				<table>
					<tr>
						<td width="40%" style="font-size:50px;font-family:forte"> <font color="#428bca"> Wintan  </font><font color="#000"> Hospital</font> </td>
							
						<div class="menus">
							<?php
								if($this_system_usertype=="guest")
								{
									include("guest menu.php");
								}
								else if($this_system_usertype=="admin")
								{
									include("admin menu.php");
								}
								else if($this_system_usertype=="doctor")
								{
									include("doctor menu.php");
								}
								else if($this_system_usertype=="patient")
								{
									include("patient menu.php");
								}
												//menu included here
							?>
						</div>
					</tr>
				</table>
			</div>
		</div>
			
				
		<div class="motto"> "A Healthy body holds a Healthy Soul"</div>
		<br> <br>
	<div class="view_page">
		<?php
				if(isset($_GET["pg"]))
				{
					include($_GET["pg"]);
				}
				else
				{
					include("guest home.php");
				}
		?>		
	</div>
		<div class="nav_down">
			<div>
				&copy; Wintan Hospital site Developed & designed By MiRaSy
			</div>
		</div>
	</div>
</body>
	</html>
