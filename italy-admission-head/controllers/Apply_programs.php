<?php 

// Update program Note
if(isset($_POST['updateProgramNote'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$updateNote = mysqli_real_escape_string($con, $_POST['updateNote']);
	$run = "UPDATE italy_program_report_note".$_SESSION['dbNo']." SET italy_pro_report_note='".$updateNote."' WHERE italy_pro_report_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Noted!',
				text: 'Your Note is Saved.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}
}

// Updated Pre Einrollment Assign to Team
if(isset($_POST['updProPre'])) {
	$updateID = $_POST['updateID'];
	$directPre = $_POST['directPre'];
	$assignProgramPre = $_POST['assignProgramPre'];
	$assignProgramName = $_POST['assignProgramName'];
	$current_date =  date('Y-m-d');

	if($directPre=='2'){
		$preAssign = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_assign_to='".$assignProgramPre."', italy_pre_assign_date='".$current_date."', italy_pre_program_name='".$assignProgramName."' WHERE italy_client_pro_id='".$updateID."' ";
	}else{
		$preAssign = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_program_assign='".$assignProgramPre."', italy_program_assign_date='".$current_date."', italy_assign_status='1', italy_pre_program_name='".$assignProgramName."' WHERE italy_client_pro_id='".$updateID."' ";
	}
	$preAssign_ex = mysqli_query($con, $preAssign);
	if ($preAssign_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Pre Enrollment Assigned!',
				text: 'Pre Enrollment Application assign to Team.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}
}

?>