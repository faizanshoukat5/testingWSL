<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

// Update Change intake year
if(isset($_POST['updIntake'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$intakeYear = $_POST['intakeYear'] ?? '';
	$table = 'clients' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET client_intake_year = ? WHERE client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'si', $intakeYear, $updateID);
		$run_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$run_ex = false;
	}
	if ($run_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Intake!', text: 'Client Intake Year change Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

// Update program Note
if(isset($_POST['updPersonalNote'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$personalNote = $_POST['personalNote'] ?? '';
	$table = 'client_addmission_doc' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET head_personal_note = ? WHERE admission_client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'si', $personalNote, $updateID);
		$run_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$run_ex = false;
	}
	if ($run_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Noted!', text: 'Your Note is Saved.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

?>