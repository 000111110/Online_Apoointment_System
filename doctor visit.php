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
	
	if(isset($_POST["btnsubmitadd"]))
	{
		$sqlinsert_doctor_visit="INSERT INTO doctor_visit_details(Visit_ID ,Doctor_ID,Day,Doctor_in,Doctor_out)
									VALUES('".mysqli_real_escape_string($connect,$_POST["txtvisitid"])."',
											'".mysqli_real_escape_string($connect,$_POST["txtdoctorid"])."',
											'".mysqli_real_escape_string($connect,$_POST["txtday"])."',
											'".mysqli_real_escape_string($connect,$_POST["txtDoctor_in"])."',
											'".mysqli_real_escape_string($connect,$_POST["txtDoctor_out"])."')";
		$resultinsert_doctor_visit=mysqli_query($connect,$sqlinsert_doctor_visit) or die("sql error in sql insert".mysqli_error($connect));
		
		if($resultinsert_doctor_visit)
		{
			
			echo '<script>alert("Schedule Added Successfully");
			window.location.href="index.php?pg=doctor visit.php&option=view&visit_doctorid='.$_POST["txtdoctorid"].'"; </script>';
		
		}
	}

?>
<html>
	<head>
		<link href="css/style.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	</head>
	<body>
		<?php
			if(isset($_GET["option"]))
			{
				if($_GET["option"]=="add")
				{
					$get_doctorId = $_GET["visit_doctorid"];
 					
		?>
				<div class="container d-flex justify-content-center align-content-center">
				<form class="border shadow p-3 rounded" action="" method="POST">
					
					<h3><center>Doctor Visiting Schedule</center></h3>	
					<table>
						<tr>
							<th>Visit ID</th>
							<td>
								<?php
									$sqlgenerateid="SELECT Visit_ID FROM doctor_visit_details ORDER BY Visit_ID DESC LIMIT 1";
									$resultgenerateid=mysqli_query($connect,$sqlgenerateid) or die("sql error in sql generate id".mysqli_error($connect));
									if(mysqli_num_rows($resultgenerateid)==1)
									{
										$lastgeneratedid=mysqli_fetch_assoc($resultgenerateid);
										$doctor_visitid=++$lastgeneratedid["Visit_ID"];
									}
									else
									{
										$doctor_visitid="V001";
									}
								?>
								
								<input type="text" class="form-control" value="<?php echo $doctor_visitid; ?>" readonly name="txtvisitid" id="txtvisitid" required>
							</td>
						</tr>	
						<tr>
							<th>Doctor ID</th>
							<td>
								<input type="text" class="form-control" value="<?php echo $get_doctorId; ?>" readonly name="txtdoctorid" id="txtdoctorid" required>
							</td>
						</tr>					
						<tr>
							<th>Day</th>
							<td>
								<select  class="form-control" name="txtday" id="txtday" required>
									<option value="select"> Select a day</option>
									<option value="Monday"> Monday</option>
									<option value="Tuesday"> Tuesday</option>
									<option value="Wednesday"> Wednesday</option>
									<option value="Thursday"> Thursday</option>
									<option value="Friday"> Friday</option>
									<option value="Saturday"> Saturday</option>
									<option value="Sunday"> Sunday</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>Time In</th>
							<td>
								<input type="time" class="form-control" name="txtDoctor_in" id="txtDoctor_in" required>
							</td>
						</tr>
						<tr>
							<th>Time Out</th>
							<td>
								<input type="time" class="form-control" name="txtDoctor_out" id="txtDoctor_out" required>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<center>
									<?php echo'<a href="index.php?pg=doctor visit.php&option=view&visit_doctorid='.$get_doctorId.'"><input type="button" class="btn btn-light" name="btngoback" id="btngoback" value="Go Back"></a>' ?>
									<input type="reset" class="btn btn-danger" name="btnreset" id="btnreset" value="Clear">
									<input type="submit" class="btn btn-success" name="btnsubmitadd" id="btnsubmitadd" value="Save">
								</center>
							</td>
						</tr>
					</table>
				</form>
			</div>

			<?php
					}
					else if($_GET["option"]=="view")
					{
						$get_doctorId = $_GET["visit_doctorid"];
						echo'<div class="box-content">
									<h3><center>Doctor visiting Schedule List<center></h3>
									<table class="table table-striped">';
										echo'<a href="index.php?pg=doctor visit.php&option=add&visit_doctorid='.$get_doctorId.'"><button class="btn btn-primary"> Add New Schedule </button></a>';
										echo'<thead>
											<tr>
												<td>Days</td>
												<td>Time In</td>
												<td>Time Out</td>
												<td>Action</td>
											</tr>
											</thead>';
										echo'<tbody>';
											$sqlview="SELECT * FROM doctor_visit_details WHERE Doctor_ID ='$get_doctorId'";
											$resultview=mysqli_query($connect,$sqlview) or die("sql error in sql view".mysqli_error($connect));
											while($rowview=mysqli_fetch_assoc($resultview))
											{
												echo'<tr>';
												echo'<td>'.$rowview["Day"].'</td>';
												echo'<td>'.date("g:i a", strtotime($rowview["Doctor_in"])).'</td>';
												echo'<td>'.date("g:i a", strtotime($rowview["Doctor_out"])).'</td>';
												echo'<td>';
													echo'<a href="index.php?pg=doctor visit.php&option=delete&delete_visitid='.$rowview["Visit_ID"].'&delete_doctorid='.$rowview["Doctor_ID"].'"><button class="btn btn-danger"> Delete </button></a>';
												echo'</td>';
												echo'</tr>';
											}
										echo'</tbody>';	
									echo'</table>';
										if($this_system_usertype == 'admin')
										{
											echo'<a href="index.php?pg=doctor.php&option=view"><center><button class="btn btn-light"> Go Back </button></center></a>';
										}
										
						echo'</div>';
					}
					else if($_GET["option"]=="delete")
					{
						$get_doctorid=$_GET["delete_doctorid"];
						$get_visitid=$_GET["delete_visitid"];
						
						$sqldelete="DELETE FROM doctor_visit_details WHERE Visit_ID ='$get_visitid'";
						$resultdelete=mysqli_query($connect,$sqldelete) or die("sql error in sql delete".mysqli_error($connect));
						if($resultdelete)
						{
							echo'<script>alert("SCHEDULE DELETED");
								window.location.href="index.php?pg=doctor visit.php&option=view&visit_doctorid='.$get_doctorid.'"; </script>';
						}
					}
				}
			?>
		
	</body>
</html>	