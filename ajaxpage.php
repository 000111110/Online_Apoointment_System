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

if(isset($_GET["frompage"]))
{
	if($_GET["frompage"]=="appoint_doctor")
	{
		$get_ajaxdoctor_special=$_GET["ajax_doctor_special"];
		$sqldoctor_id="SELECT * FROM doctor_details WHERE Specialization='$ge t_ajaxdoctor_special'";
		$resultloadleg_id=mysqli_query($connect,$sqldoctor_id) or die("sql error in sql load".mysqli_error($connect));
			echo'<option value="select"><b>Select the doctor</b></option>';
		while($rowloadleg_id=mysqli_fetch_assoc($resultloadleg_id))
		{
			echo'<option value="'.$rowloadleg_id["Doctor_ID"].'">'.$rowloadleg_id["First_Name"]." ".$rowloadleg_id["Last_Name"].' </option>';
		}
		
	}
	if($_GET["frompage"]=="appoint_doctor_dates")
	{
		$get_ajaxdoctor_id=$_GET["ajax_doctor_ID"];
		$sqldoctor_visitday="SELECT * FROM doctor_visit_details WHERE Doctor_ID='$get_ajaxdoctor_id'";
		$resultload=mysqli_query($connect,$sqldoctor_visitday) or die("sql error in sql load".mysqli_error($connect));											
		
		$Days_array = array();
		while($rowload=mysqli_fetch_assoc($resultload))
		{
			$Days_array[] = $rowload["Day"];
		}
		/* $date = date("Y/m/d");
		$today_day = date('l', strtotime($date));
		echo $today_day; */
		
		
		$date = date("Y-m-d");
		$start = date('Y-m-d', strtotime($date. ' + 1 days'));
		$end =  date('Y-m-d', strtotime($start. ' + 30 days'));
		
		$startTime = strtotime( $start );
		$endTime = strtotime( $end );
		
		// Loop between timestamps, 24 hours at a time
		echo'<option value="select"><b>Select the Date</b></option>';
		for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) 
		{
		  $thisDate = date( 'Y-m-d', $i ); // 2010-05-01, 2010-05-02, etc
		  
		  $Name_of_day = date('l', strtotime($thisDate));
		  //echo $Name_of_day;
		  foreach($Days_array as $doctor_days)
		  {
				if($Name_of_day == $doctor_days)
				{
					//echo $Name_of_day;
					echo'<option value="'.$thisDate.'">'.$Name_of_day." ".$thisDate.' </option>';
				}
		  }
		  
		}
	}
	if($_GET["frompage"]=="appoint_doctor_time")
	{
		$get_ajaxdoctor_Id=$_GET["ajax_doctor_ID"];
		$get_ajaxdoctor_date=$_GET["ajax_doctor_date"];
		$Name_of_doctor_day = date('l', strtotime($get_ajaxdoctor_date));
		
		$sqldoctor_time="SELECT * FROM doctor_visit_details WHERE Doctor_ID='$get_ajaxdoctor_Id' AND Day='$Name_of_doctor_day'";
		$resultload_time=mysqli_query($connect,$sqldoctor_time) or die("sql error in sql load".mysqli_error($connect));											
		echo'<option value="select"><b>Select the time</b></option>';
		while($rowload_time=mysqli_fetch_assoc($resultload_time))
		{
			echo'<option value="'.$rowload_time["Doctor_in"].'">'.date("g:i a", strtotime($rowload_time["Doctor_in"])).
			" to ".date("g:i a", strtotime($rowload_time["Doctor_out"])).' </option>';
		}	
	}
	if($_GET["frompage"]=="show_appoint_by_doctor")
	{
		$get_ajaxdoctor_Id=$_GET["ajax_doctor_ID"];
		
		echo '<table class="table table-striped">';
					echo'<thead>
						<tr>
							<td>appointment ID</td>
							<td>Doctor Name</td>
							<td>patient Name</td>
							<td>Date</td>
							<td>Time</td>
						</tr>
						</thead>';
					echo'<tbody>';
						$sqlview="SELECT * FROM appontment_details WHERE Doctor_ID ='$get_ajaxdoctor_Id'";
						$resultview=mysqli_query($connect,$sqlview) or die("sql error in sql view".mysqli_error($connect));
						while($rowview=mysqli_fetch_assoc($resultview))
						{
							echo'<tr>';
							echo'<td>'.$rowview["Appointment_ID"].'</td>';
							echo'<td>'.$rowview["Doctor_ID"].'</td>';
							echo'<td>'.$rowview["Patient_ID"].'</td>';
							echo'<td>'.$rowview["Appointment_Date"].'</td>';
							echo'<td>'.$rowview["Appointment_Time"].'</td>';
							echo'<td>';
							echo'</td>';
							echo'</tr>';
						}
					echo'</tbody>';				
		echo'</table>';
	}
	if($_GET["frompage"]=="show_appoint_by_date")
	{
		$get_ajaxdoctor_date=$_GET["ajax_doctor_date"];
		
		echo '<table class="table table-striped">';
					echo'<thead>
						<tr>
							<td>appointment ID</td>
							<td>Doctor Name</td>
							<td>patient Name</td>
							<td>Date</td>
							<td>Time</td>
						</tr>
						</thead>';
					echo'<tbody>';
						$sqlview="SELECT * FROM appontment_details WHERE Appointment_Date ='$get_ajaxdoctor_date'";
						$resultview=mysqli_query($connect,$sqlview) or die("sql error in sql view".mysqli_error($connect));
						while($rowview=mysqli_fetch_assoc($resultview))
						{
							echo'<tr>';
							echo'<td>'.$rowview["Appointment_ID"].'</td>';
							echo'<td>'.$rowview["Doctor_ID"].'</td>';
							echo'<td>'.$rowview["Patient_ID"].'</td>';
							echo'<td>'.$rowview["Appointment_Date"].'</td>';
							echo'<td>'.$rowview["Appointment_Time"].'</td>';
							echo'<td>';
							echo'</td>';
							echo'</tr>';
						}
					echo'</tbody>';				
		echo'</table>';	
	}
	if($_GET["frompage"]=="show_appoint_by_days")
	{
		$get_ajax_days=$_GET["ajax_days"];
		
		echo '<table class="table table-striped">';
					echo'<thead>
						<tr>
							<td>appointment ID</td>
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
							$Name_of_day = date('l', strtotime($rowview["Appointment_Date"]));
							if($Name_of_day == $get_ajax_days)
							{
								echo'<tr>';
								echo'<td>'.$rowview["Appointment_ID"].'</td>';
								echo'<td>'.$rowview["Doctor_ID"].'</td>';
								echo'<td>'.$rowview["Patient_ID"].'</td>';
								echo'<td>'.$rowview["Appointment_Date"].'</td>';
								echo'<td>'.$rowview["Appointment_Time"].'</td>';
								echo'<td>';
								echo'</td>';
								echo'</tr>';
							}
						}
					echo'</tbody>';				
		echo'</table>';	
	}
}
?>