<?php 
// Update Change intake year
if(isset($_POST['updIntake'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$intakeYear = mysqli_real_escape_string($con, $_POST['intakeYear']);
	$run = "UPDATE clients".$_SESSION['dbNo']." SET client_intake_year='".$intakeYear."' WHERE client_id='".$updateID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Intake!',
				text: 'Client Intake Year change Successfully.',
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

// Assign WhatsApp Agent 
if(isset($_POST['updAgent'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$current_date = date('Y-m-d');
	$assignAdmissionAgent = mysqli_real_escape_string($con, $_POST['assignAdmissionAgent']);
	$run = "UPDATE clients".$_SESSION['dbNo']." SET country_agent_assign_to='".$assignAdmissionAgent."', country_agent_assign_date='".$current_date."' WHERE client_id='".$updateID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Assign!',
				text: 'Client Assign to Agent Successfully.',
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
// Delete WhatsApp Agent 
if(isset($_POST['delAgent'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$run = "UPDATE clients".$_SESSION['dbNo']." SET country_agent_assign_to='', country_agent_assign_date='0000-00-00' WHERE client_id='".$updateID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Deleted!',
				text: 'Client Assign Deleted Successfully.',
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

// Update program Note
if(isset($_POST['updPersonalNote'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$personalNote = mysqli_real_escape_string($con, $_POST['personalNote']);
	$run = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET head_personal_note='".$personalNote."' WHERE admission_client_id='".$updateID."' ";
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

?>