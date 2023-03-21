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
		$sqlinsert_doctor="INSERT INTO doctor_details(Doctor_ID,First_Name,Last_Name,Tp_no,Email_id,Specialization)
									VALUES('".mysqli_real_escape_string($connect,$_POST["txtdoctorid"])."',
											'".mysqli_real_escape_string($connect,$_POST["txtdoctorFirstName"])."',
											'".mysqli_real_escape_string($connect,$_POST["txtdoctorLastName"])."',
											'".mysqli_real_escape_string($connect,$_POST["txtmobile"])."',
											'".mysqli_real_escape_string($connect,$_POST["txtemail"])."',
											'".mysqli_real_escape_string($connect,$_POST["txtSpecializationtype"])."')";
		$resultinsert_doctor=mysqli_query($connect,$sqlinsert_doctor) or die("sql error in sql insert".mysqli_error($connect));
		
		if($resultinsert_doctor)
		{
			$sqlinsert_login="INSERT INTO login_details(User_ID ,Password,User_type)
										VALUES('".mysqli_real_escape_string($connect,$_POST["txtdoctorid"])."',
												'".mysqli_real_escape_string($connect,$_POST["txtpassword"])."',
												'".mysqli_real_escape_string($connect,"doctor")."')";
			$resultinsert_login=mysqli_query($connect,$sqlinsert_login) or die("sql error in sql insert".mysqli_error($connect));	
			if($resultinsert_login)
			{
				echo '<script>alert("ACCOUNT CREATED SUCCESSFULLY");</script>';
				echo'<script> window.location.href="index.php?pg=doctor visit.php&option=add&visit_doctorid='.$_POST["txtdoctorid"].'"; </script>';
			}
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
					
		?>
				<div class="container d-flex justify-content-center align-content-center">
				<form class="border shadow p-3 rounded" action="" method="POST">
					
					<h3><center>DOCTOR &nbsp; REGISTRATION</center></h3>	
					<table>
						<tr>
							<th>Doctor ID</th>
							<td>
								<?php
									$sqlgenerateid="SELECT Doctor_ID FROM doctor_details ORDER BY Doctor_ID DESC LIMIT 1";
									$resultgenerateid=mysqli_query($connect,$sqlgenerateid) or die("sql error in sql generate id".mysqli_error($connect));
									if(mysqli_num_rows($resultgenerateid)==1)
									{
										$lastgeneratedid=mysqli_fetch_assoc($resultgenerateid);
										$doctorid=++$lastgeneratedid["Doctor_ID"];
									}
									else
									{
										$doctorid="DR001";
									}
								?>
								
								<input type="text" class="form-control" value="<?php echo $doctorid; ?>" readonly name="txtdoctorid" id="txtdoctorid" required>
							</td>
						</tr>					
						<tr>
							<th>First Name</th>
							<td>
								<input type="text" class="form-control" name="txtdoctorFirstName" id="txtdoctorFirstName"required>
							</td>
						</tr>
						<tr>
							<th>Last Name</th>
							<td>
								<input type="text" class="form-control" name="txtdoctorLastName" id="txtdoctorLastName"required>
							</td>
						</tr>
						<tr>
							<th>Mobile No</th>
							<td>
								<input type="text" class="form-control" name="txtmobile" id="txtmobile" required>
							</td>
						</tr>
						<tr>
							<th>Email id</th>
							<td>
								<input type="text" class="form-control" name="txtemail" id="txtemail" required>
							</td>
						</tr>
						<tr>
							<th>Specialization</th>
							<td>
								<select  class="form-control" name="txtSpecializationtype" id="txtSpecializationtype" required>
									<option value="select"> Select a type</option>
									<option value="general"> General physician</option>
									<option value="Neurologists"> Neurologists</option>
									<option value="Radiologists"> Radiologists</option>
									<option value="Pediatricians"> Pediatricians</option>
									<option value="Cardiologists"> Cardiologists</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>Set Password</th>
							<td>
								<input type="text" class="form-control" name="txtpassword" id="txtpassword" required>
							</td>
						</tr>
											
											
						<tr>
							<td colspan="2">
								<center>
									<a href="index.php?pg=doctor.php&option=view"><input type="button" class="btn btn-light" name="btngoback" id="btngoback" value="Go Back"></a>
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
						echo'<div class="box-content">
									<h3><center>Doctors List<center></h3>
									<table class="table table-striped">';
										echo'<a href="index.php?pg=doctor.php&option=add"><button class="btn btn-primary"> Register New Doctor </button></a>';
										echo'<thead>
											<tr>
												<td>ID</td>
												<td>Name</td>
												<td>Contact No</td>
												<td>Email</td>
												<td>Specialization</td>
												<td>Visit details</td>
												<td>Action</td>
											</tr>
											</thead>';
										echo'<tbody>';
											$sqlview="SELECT * FROM doctor_details";
											$resultview=mysqli_query($connect,$sqlview) or die("sql error in sql view".mysqli_error($connect));
											while($rowview=mysqli_fetch_assoc($resultview))
											{
												$initial_name = str_split($rowview["Last_Name"],1);
												echo'<tr>';
												echo'<td>'.$rowview["Doctor_ID"].'</td>';
												echo'<td>'.$initial_name[0].".".$rowview["First_Name"].'</td>';
												echo'<td>'.$rowview["Tp_no"].'</td>';
												echo'<td>'.$rowview["Email_id"].'</td>';
												echo'<td>'.$rowview["Specialization"].'</td>';
												echo'<td><a href="index.php?pg=doctor visit.php&option=view&visit_doctorid='.$rowview["Doctor_ID"].'"><button class="btn btn-info"> Visiting Details </button></a></td>';
												echo'<td>';
											//	echo'<a href="index.php?pg=doctor.php&option=fullview&fullview_doctorid='.$rowview["Doctor_ID"].'"><button class="btn btn-success"> View </button></a> ';
													//echo'<a href="index.php?pg=doctor.php&option=edit&edit_doctorid='.$rowview["Doctor_ID"].'"><button class="btn btn-Warning"> Edit </button></a> ';
													echo'<a onclick="return confirm_delete()" href="index.php?pg=doctor.php&option=delete&delete_doctorid='.$rowview["Doctor_ID"].'"><button class="btn btn-danger"> Delete Account</button></a>';
												echo'</td>';
												echo'</tr>';
											}
										echo'</tbody>';				
							echo'</table>
							</div>';
					}
					else if($_GET["option"]=="profile")
					{
						$sqlprofile="SELECT * FROM doctor_details WHERE Doctor_ID ='$this_system_username'";
						$resultprofile=mysqli_query($connect,$sqlprofile) or die("sql error in sql fullview".mysqli_error($connect));
						$rowprofile=mysqli_fetch_assoc($resultprofile);
						
						echo'<table class="table table-striped table-bordered">';
							echo'<tr><th>ID</th><td>'.$rowprofile["Doctor_ID"].'</td></tr>';
							echo'<tr><th>Full Name</th><td>'.$rowprofile["First_Name"]." ".$rowprofile["Last_Name"].'</td></tr>';
							echo'<tr><th>Contact No</th><td>'.$rowprofile["Tp_no"].'</td></tr>';
							echo'<tr><th>E-Mail</th><td>'.$rowprofile["Email_id"].'</td></tr>';
							echo'<tr><th>Specialization</th><td>'.$rowprofile["Specialization"].'</td></tr>';
						echo'</table>';
					}
					else if($_GET["option"]=="delete")
					{
						$get_doctorid=$_GET["delete_doctorid"];
						
						// delete doctor details....
							$sqldelete_main="DELETE FROM doctor_details WHERE Doctor_ID ='$get_doctorid'";
							$resultdelete_main=mysqli_query($connect,$sqldelete_main) or die("sql error in sql delete".mysqli_error($connect));
						// delete doctor visiting details....
							$sqldelete_visit="DELETE FROM doctor_visit_details WHERE Doctor_ID ='$get_doctorid'";
							$resultdelete_visit=mysqli_query($connect,$sqldelete_visit) or die("sql error in sql delete".mysqli_error($connect));
						// delete doctor login details....
							$sqldelete_login="DELETE FROM login_details WHERE User_ID ='$get_doctorid'";
							$resultdelete_login=mysqli_query($connect,$sqldelete_login) or die("sql error in sql delete".mysqli_error($connect));
						// delete doctor appointments details....
							$sqldelete_appointment="DELETE FROM appontment_details WHERE Doctor_ID ='$get_doctorid'";
							$resultdelete_appointment=mysqli_query($connect,$sqldelete_appointment) or die("sql error in sql delete".mysqli_error($connect));
						
						if($resultdelete_main && $resultdelete_visit && $resultdelete_login && $resultdelete_appointment)
						{
							echo'<script>alert("SUCCESSFULLY DELETED");
								window.location.href="index.php?pg=doctor.php&option=view"; </script>';
							
						}
					}
				}
			?>
		
	</body>
</html>	