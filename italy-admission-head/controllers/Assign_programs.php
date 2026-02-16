<?php 
$current_date =  date('Y-m-d');

if(isset($_POST['updPro'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$assignProgram = mysqli_real_escape_string($con, $_POST['assignProgram']);

	$updatePro = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_program_assign='".$assignProgram."', italy_program_assign_date='".$current_date."', italy_assign_status='1' WHERE italy_client_pro_id ='".$updateID."'";
	$updatePro_ex = mysqli_query($con, $updatePro);
	if ($updatePro_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Assigned!',
				text: 'Program is Assign.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

// Add Update Opening Closing date
if(isset($_POST['updUniDate'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$radioStep = mysqli_real_escape_string($con, $_POST['radioStep']);
	$uniOpeningDate = mysqli_real_escape_string($con, $_POST['uniOpeningDate']);
	$uniAnyNote = mysqli_real_escape_string($con, $_POST['uniAnyNote']);

	$updatePro = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_dead_status='".$radioStep."', italy_dead_date='".$uniOpeningDate."', italy_dead_note='".$uniAnyNote."' WHERE italy_client_pro_id ='".$updateID."'";
	$updatePro_ex = mysqli_query($con, $updatePro);
	if ($updatePro_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Updated!',
				text: 'Deadline Date is Updated.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}


if(isset($_POST['updAssignSOP'])) {
	$current_date =  date('Y-m-d');
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$assignSOP = mysqli_real_escape_string($con, $_POST['assignSOP']);
	$programNameSOP = mysqli_real_escape_string($con, $_POST['programNameSOP']);
	$pageNoSOP = mysqli_real_escape_string($con, $_POST['pageNoSOP']);
	$totalWordsSOP = mysqli_real_escape_string($con, $_POST['totalWordsSOP']);
	$noteSOP = mysqli_real_escape_string($con, $_POST['noteSOP']);

	$updatePro = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_sops_assign_to='".$assignSOP."', italy_sops_assign_date='".$current_date."', italy_sops_program_name='".$programNameSOP."', italy_sops_page_no='".$pageNoSOP."', italy_sops_total_words='".$totalWordsSOP."', italy_sops_note='".$noteSOP."' WHERE italy_client_pro_id ='".$updateID."'";
	$updatePro_ex = mysqli_query($con, $updatePro);
	if ($updatePro_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Assigned!',
				text: 'SOPs are Assigned.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

?>