<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

if(isset($_POST['updUniDate'])) {
	$uniName = $_POST['uniName'] ?? '';
	$degreeName = $_POST['degreeName'] ?? '';
	$radioStep = $_POST['radioStep'] ?? '';
	$uniOpeningDate = $_POST['uniOpeningDate'] ?? '';
	$uniClosingDate = $_POST['uniClosingDate'] ?? '';
	$proapplyDates = $_POST['proapplyDates'] ?? '';
	$uniAnyNote = $_POST['uniAnyNote'] ?? '';

	if($proapplyDates=='1'){
		$current_date =  date('Y-m-d');
		$table = 'austria_add_programs' . $_SESSION['dbNo'];
		$sql = "UPDATE `" . $table . "` SET aus_active_date = ? WHERE aus_ap_uni_name = ? AND aus_ap_degree = ?";
		$stmt = mysqli_prepare($con, $sql);
		if ($stmt) {
			mysqli_stmt_bind_param($stmt, 'sss', $current_date, $uniName, $degreeName);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		$detailTable = 'austria_add_programs_details' . $_SESSION['dbNo'];
		$sql1 = "UPDATE `" . $detailTable . "` SET aus_ad_1st_opening_date = ?, aus_ad_1st_actual_date = ? WHERE aus_ad_uni_name = ? AND aus_ad_degree = ? AND aus_ad_current_round = '1' AND aus_ad_intake = '2026'";
		$stmt1 = mysqli_prepare($con, $sql1);
		if ($stmt1) {
			mysqli_stmt_bind_param($stmt1, 'ssss', $uniOpeningDate, $uniClosingDate, $uniName, $degreeName);
			mysqli_stmt_execute($stmt1);
			mysqli_stmt_close($stmt1);
		}

		$sql2 = "UPDATE `" . $detailTable . "` SET aus_ad_2nd_opening_date = ?, aus_ad_2nd_actual_date = ? WHERE aus_ad_uni_name = ? AND aus_ad_degree = ? AND aus_ad_current_round = '2' AND aus_ad_intake = '2026'";
		$stmt2 = mysqli_prepare($con, $sql2);
		if ($stmt2) {
			mysqli_stmt_bind_param($stmt2, 'ssss', $uniOpeningDate, $uniClosingDate, $uniName, $degreeName);
			mysqli_stmt_execute($stmt2);
			mysqli_stmt_close($stmt2);
		}
	}

	$tableDates = 'austria_university_dates';
	$sqlIns = "INSERT INTO `" . $tableDates . "` (aus_university_name, aus_degree_name, aus_opening_date, aus_closing_date, aus_note, aus_date_status, close, status, entry_by) VALUES (?, ?, ?, ?, ?, ?, '1', '1', ?)";
	$stmtIns = mysqli_prepare($con, $sqlIns);
	if ($stmtIns) {
		$entryBy = (int)($_SESSION['user_id'] ?? 0);
		mysqli_stmt_bind_param($stmtIns, 'ssssssi', $uniName, $degreeName, $uniOpeningDate, $uniClosingDate, $uniAnyNote, $radioStep, $entryBy);
		$addUniName_ex = mysqli_stmt_execute($stmtIns);
		mysqli_stmt_close($stmtIns);
	} else {
		$addUniName_ex = false;
	} 

	if ($addUniName_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Added!', text: 'University Opening & Closing date are Added.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } window.location.reload(); }); });</script>";
	}
}

// Add CGPA
if(isset($_POST['updUniCGPA'])) {
	$uniCGPAName = $_POST['uniCGPAName'] ?? '';
	$degreeCGPAName = $_POST['degreeCGPAName'] ?? '';
	$uniCGPA = $_POST['uniCGPA'] ?? '';
	$uniCGPANote = $_POST['uniCGPANote'] ?? '';

	$sqlCgpa = "INSERT INTO austria_university_cgpa (aus_cgpa_uni_name, aus_cgpa_uni_degree, aus_uni_cgpa, aus_cgpa_uni_note, close, status, entry_by) VALUES (?, ?, ?, ?, '1', '1', ?)";
	$stmtCgpa = mysqli_prepare($con, $sqlCgpa);
	if ($stmtCgpa) {
		$entryBy = (int)($_SESSION['user_id'] ?? 0);
		mysqli_stmt_bind_param($stmtCgpa, 'ssssi', $uniCGPAName, $degreeCGPAName, $uniCGPA, $uniCGPANote, $entryBy);
		$addUniName_ex = mysqli_stmt_execute($stmtCgpa);
		mysqli_stmt_close($stmtCgpa);
	} else {
		$addUniName_ex = false;
	}

	if ($addUniName_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Added!', text: 'University CGPA is Added.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } window.location.reload(); }); });</script>";
	}
}

?>