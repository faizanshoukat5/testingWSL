<?php
$emp_date = "SELECT * from wt_users WHERE close='1' AND status='1' AND type!='admin' ORDER BY FIELD(type, 'italy visa team', 'italy university sop', 'italy admission team', 'italy admission head', 'austria visa team', 'austria university sop', 'austria admission team', 'austria admission head', 'documents collections', 'accountant', 'team manager',  'sale department') ";
$emp_date_ex = mysqli_query($con,$emp_date);
$sr = mysqli_num_rows($emp_date_ex);

if(isset($_POST['subEmp'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phoneno = $_POST['phoneno'];
	$gender = $_POST['gender'];
	$userType = $_POST['userType'];
	$designation = $_POST['designation'];
	$userName = $_POST['userName'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$final_pass = md5($password );

	$add_emp = "INSERT INTO `wt_users` (`fname`, `lname`, `phone`, `gender`, `type`, `designation`, `user_name`, `email`, `password`, `user_image`, `active_status`, `status`, `close`) VALUES ('".$fname."', '".$lname."', '".$phoneno."', '".$gender."', '".$userType."', '".$designation."', '".$userName."', '".$email."', '".$final_pass."', 'user-avatar.png', '1', '1', '1')";
	$add_emp_ex = mysqli_query($con,$add_emp);
	if($add_emp_ex){
		$lastID = $con->insert_id;
 		$addEmp = "INSERT INTO `wt_users_personal_info` (`wt_personal_users_id`, `close`, `status`, `entry_by` ) VALUES ('".$lastID."', '1', '1', '".$_SESSION['user_id']."')";
		$addEmp_ex = mysqli_query($con,$addEmp);

		$addsessionId = "INSERT INTO session_active (active_session_id, active_user_id, s_date, e_date, close, status ) VALUES ('2', '".$lastID."', '".$_SESSION['s_date']."', '".$_SESSION['e_date']."', '1', '1')";
		$addSession_id = mysqli_query($con,$addsessionId);
	}
	if($add_emp_ex){
		echo "<script>
		document.addEventListener('DOMContentLoaded', function () {
			Swal.fire({
				title: 'Added!',
				text: 'Employee Added Successfully',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

// Update query
if(isset($_POST['updEmp'])) {

	$updateID =  $_POST['updateID'];
	$fname =  $_POST['fname'];
	$lname =  $_POST['lname'];
	$phoneno =  $_POST['phoneno'];
	$gender =  $_POST['gender'];
	$userType =  $_POST['userType'];
	$designation =  $_POST['designation'];

	$update_emp = "UPDATE wt_users SET fname='".$fname."', lname='".$lname."', phone='".$phoneno."', gender='".$gender."', type='".$userType."', designation='".$designation."' WHERE wt_id='".$updateID."'";
	$update_emp_ex = mysqli_query($con,$update_emp);
	if ($update_emp_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function () {
			Swal.fire({
				title: 'Updated!',
				text: 'Employee Updated Successfully',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}
?>