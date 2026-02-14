<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

// Update program Note
if(isset($_POST['updateProgramNote'])) {
	$updateProgramID = (int)($_POST['updateProgramID'] ?? 0);
	$updateNote = $_POST['updateNote'] ?? '';
	$table = 'austria_program_report_note' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET aus_pro_report_note = ? WHERE aus_pro_report_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'si', $updateNote, $updateProgramID);
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