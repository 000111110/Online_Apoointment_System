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
	$sqlinsert_appoitment="INSERT INTO appontment_details(Appointment_ID ,Doctor_ID,Patient_ID ,Appointment_Date,Appointment_Time)
								VALUES('".mysqli_real_escape_string($connect,$_POST["txtappointmentid"])."',
										'".mysqli_real_escape_string($connect,$_POST["show_doctors"])."',
										'".mysqli_real_escape_string($connect,$_POST["txtPatientid"])."',
										'".mysqli_real_escape_string($connect,$_POST["txtAppointment_Date"])."',
										'".mysqli_real_escape_string($connect,$_POST["txtAppointment_Time"])."')";
	$resultinsert_appoitment=mysqli_query($connect,$sqlinsert_appoitment) or die("sql error in sql insert".mysqli_error($connect));	
	if($resultinsert_appoitment)
	{
		echo '<script>alert("Appointment Date fixed successfully.");
		window.location.href="index.php?pg=appointments.php&option=personal_view"; </script>';
	
	}
}

?>

<script>
function load_doctors()
{
	var doctor_special = document.getElementById("txtdoctorspecial").value;
	if(doctor_special != "select")
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("show_doctors").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "ajaxpage.php?frompage=appoint_doctor&ajax_doctor_special="+doctor_special, true);
		xhttp.send();
	}
	else
	{
		document.getElementById("show_doctors").innerHTML = "<option value='select'><b>doctors list</b></option>";
	}
}
</script>

<script>
function load_dates()
{
	var doctor_ID = document.getElementById("show_doctors").value;
	
	if(doctor_ID != "select")
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("txtAppointment_Date").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "ajaxpage.php?frompage=appoint_doctor_dates&ajax_doctor_ID="+doctor_ID, true);
		xhttp.send();
	}
	else
	{
		document.getElementById("txtAppointment_Date").innerHTML = "<option value='select'><b>appointment date list</b></option>";
	}
}
</script>

<script>
function load_time()
{
	var doctor_ID = document.getElementById("show_doctors").value;
	var doctor_visit_date = document.getElementById("txtAppointment_Date").value;
	
	if(doctor_ID != "select")
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("txtAppointment_Time").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "ajaxpage.php?frompage=appoint_doctor_time&ajax_doctor_ID="+doctor_ID+"&ajax_doctor_date="+doctor_visit_date, true);
		xhttp.send();
	}
	else
	{
		document.getElementById("txtAppointment_Time").innerHTML = "<option value='select'><b>appointment time</b></option>";
	}
}
</script>

<script>
function load_appointments_by_doctors()
{
	var doctor_ID = document.getElementById("show_doctors").value;
	
	if(doctor_ID != "select")
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("show_appointments_filtered").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "ajaxpage.php?frompage=show_appoint_by_doctor&ajax_doctor_ID="+doctor_ID, true);
		xhttp.send();
	}
}
</script>

<script>
function load_appointments_by_date()
{
	var doctor_visit_date = document.getElementById("viewdate").value;
	
	if(doctor_visit_date != "select")
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("show_appointments_filtered").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "ajaxpage.php?frompage=show_appoint_by_date&ajax_doctor_date="+doctor_visit_date, true);
		xhttp.send();
	}
}
</script>

<script>
function load_appointments_by_days()
{
	var days = document.getElementById("viewdays").value;
	
	if(days != "select")
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				document.getElementById("show_appointments_filtered").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "ajaxpage.php?frompage=show_appoint_by_days&ajax_days="+days, true);
		xhttp.send();
	}
}
</script>

<html>
	<head>
		<link href="css/style.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	</head>
	<body style="background-color: lightblue;>
	<?php
			if(isset($_GET["option"]))
			{
				if($_GET["option"]=="add")
				{
		?>
				<div class="container d-flex justify-content-center align-content-center">
				<form class="border shadow p-3 rounded" action="" method="POST">
					
					<h3>
						<center>Make an Appointment</center>
					</h3>
					<table>
						<tr>
							<th>Patient ID</th>
							<td>
								<input type="text" class="form-control" value="<?php echo $this_system_username; ?>" readonly name="txtPatientid" id="txtPatientid"required>
							</td>
						</tr>
						<tr>
							<th>Appointment ID</th>
							<td>
								<?php
									$sqlgenerateid="SELECT Appointment_ID FROM appontment_details ORDER BY Appointment_ID DESC LIMIT 1";
									$resultgenerateid=mysqli_query($connect,$sqlgenerateid) or die("sql error in sql generate id".mysqli_error($connect));
									if(mysqli_num_rows($resultgenerateid)==1)
									{
										$lastgeneratedid=mysqli_fetch_assoc($resultgenerateid);
										$appointmentid=++$lastgeneratedid["Appointment_ID"];
									}
									else
									{
										$appointmentid="AP000001";
									}
								?>
								
								<input type="text" class="form-control" value="<?php echo $appointmentid; ?>" readonly name="txtappointmentid" id="txtappointmentid" required>
							</td>
						</tr>	
						<tr>
							<th>Specialization</th>
							<td>
								<select name="txtdoctorspecial" id="txtdoctorspecial" required>
									<option value="select"><b> Select the category</b></option>
									<option value="General physician"> General physician</option>
									<option value="Neurologists"> Neurologists</option>
									<option value="Radiologists"> Radiologists</option>
									<option value="Pediatricians"> Pediatricians</option>
									<option value="Cardiologists"> Cardiologists</option>
								</select>
							</td>
						</tr>
						
						
						<tr>
							<th>Doctor ID</th>
							<td>
							<select name="show_doctors" id="show_doctors" required>
								<option value="select">doctors list</option>
								<option value="General physician"> s.kukaraj</option>
									<option value="Pediatricians"> s.kathiresan</option>
									<option value="Cardiologists"> M.Nirija</option>
									<option value="General physician"> M.Nishan</option>
							</select>
							</td>
						</tr>
						<tr>
							<th>Appointment_Date</th>
							<td>
								<input type="Appointmentdate" class="form-control" name="txtAppointmentdate" id="Appointmentdate" required>
							</td>
						</tr>
						<tr>
							<th>Appointment_Time</th>
							<td>
								<input type="time" name="time" id="txtAppointment_Time" required>
							</td>
						</tr>				
						<tr>
							<td colspan="5">
								<center>
									<a href="index.php"><input type="button" class="btn btn-light" name="btngoback" id="btngoback" value="Go Back"></a>
									<input type="reset" class="btn btn-danger" name="btnreset" id="btnreset" value="Clear">
									<input type="submit" class="btn btn-success" name="btnsubmitadd" id="btnsubmitadd" value="Submit">
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
								<h3><center> All Appointments <center></h3>
								<table>
								<tr><th>Doctor</th><th>Date</th><th>Days</th></tr>
								<tr>
									<td>
										<select class="form-control" onchange="load_appointments_by_doctors()" name="show_doctors" id="show_doctors">
											<option value="select">Select a Doctor</option>';
											$sqldoctor_id="SELECT * FROM doctor_details";
											$resultloadleg_id=mysqli_query($connect,$sqldoctor_id) or die("sql error in sql load".mysqli_error($connect));											
											while($rowloadleg_id=mysqli_fetch_assoc($resultloadleg_id))
											{
												echo'<option value="'.$rowloadleg_id["Doctor_ID"].'">'.$rowloadleg_id["First_Name"]." ".$rowloadleg_id["Last_Name"].' </option>';
											}
									echo'</select>
									</td>
									<td><input type="date" class="form-control" onchange="load_appointments_by_date()" name="viewdate" id="viewdate"></td>
									
									<td>
										<select class="form-control" onchange="load_appointments_by_days()" name="viewdays" id="viewdays">
											<option value="select">Select a Day</option>
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
								</table>
								</br>
								</br>
								<div name="show_appointments_filtered" id="show_appointments_filtered">';
									echo '<table class="table table-striped">';
											echo'<thead>
												<tr>
													<td>Doctor Name</td>
													<td>patient Name</td>
													<td>Date</td>
													<td>Time</td>
												</tr>
												</thead>';
											echo'<tbody>';
												$sqlview="SELECT * FROM appontment_details";
												$resultview=mysqli_query($connect,$sqlview) or die("sql error in sql view".mysqli_error($connect));
												while($rowview=mysqli_fetch_assoc($resultview))
												{
													echo'<tr>';
													echo'<td>'.$rowview["Doctor_ID"].'</td>';
													echo'<td>'.$rowview["Patient_ID"].'</td>';
													echo'<td>'.$rowview["Appointment_Date"].'</td>';
													echo'<td>'.$rowview["Appointment_Time"].'</td>';
													echo'</tr>';
												}
											echo'</tbody>';				
									echo'</table>
								</div>
							</div>';
					}
					else if($_GET["option"]=="personal_view")
					{
						if($this_system_usertype == "doctor")
						{
							$condition = "SELECT * FROM appontment_details WHERE Doctor_ID ='$this_system_username'";
						}
						else if($this_system_usertype == "patient")
						{
							$condition = "SELECT * FROM appontment_details WHERE Patient_ID ='$this_system_username'";
						}
						
						echo '<table class="table table-striped">';
								echo'<thead>
									<tr>
										<td>Doctor Name</td>
										<td>patient Name</td>
										<td>Date</td>
										<td>Time</td>
										<td>Action</td>
									</tr>
									</thead>';
								echo'<tbody>';
									$sqlview=$condition;
									$resultview=mysqli_query($connect,$sqlview) or die("sql error in sql view".mysqli_error($connect));
									while($rowview=mysqli_fetch_assoc($resultview))
									{
										echo'<tr>';
										echo'<td>'.$rowview["Doctor_ID"].'</td>';
										echo'<td>'.$rowview["Patient_ID"].'</td>';
										echo'<td>'.$rowview["Appointment_Date"].'</td>';
										echo'<td>'.$rowview["Appointment_Time"].'</td>';
										echo'<td>';
										echo'<a onclick="return cancel_apointment()" href="index.php?pg=appointments.php&option=delete&delete_appointid='.$rowview["Appointment_ID"].'"><button class="btn btn-danger"> Cancel Appointment</button></a>';
										echo'</td>';
										echo'</tr>';
									}
								echo'</tbody>';				
						echo'</table>';	
					}
					else if($_GET["option"]=="delete")
					{
						$get_appointid=$_GET["delete_appointid"];
						$sqldelete="DELETE FROM appontment_details WHERE Appointment_ID ='$get_appointid'";
						$resultdelete=mysqli_query($connect,$sqldelete) or die("sql error in sql delete".mysqli_error($connect));
						if($resultdelete)
						{
							echo'<script>alert("Appointment Cancelled");
								window.location.href="index.php?pg=appointments.php&option=personal_view"; </script>';
						}
					}
				}
			?>
		
	</body>
</html>	