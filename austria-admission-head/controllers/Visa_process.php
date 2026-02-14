<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

// update Intro Message 
if(isset($_POST['updIntroMessage'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$introMessageNote = $_POST['introMessageNote'] ?? '';

	$uploadedFiles = [];
	if (!empty($_FILES['introMessageFile']['name'][0])) {
		foreach ($_FILES['introMessageFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['introMessageFile']['name'][$key],
				'type' => $_FILES['introMessageFile']['type'][$key],
				'tmp_name' => $_FILES['introMessageFile']['tmp_name'][$key],
				'error' => $_FILES['introMessageFile']['error'][$key],
				'size' => $_FILES['introMessageFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'czech_clients_visa_intro_checklist' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (visa_intro_checklist_client_id, visa_intro_checklist_steps_name, visa_intro_checklist_screenshot, visa_intro_checklist_note, close, status, entry_by) VALUES (?, 'Intro Message', ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = $_SESSION['uname'] ?? '';
		mysqli_stmt_bind_param($stmt, 'isss', $upClientID, $filesString, $introMessageNote, $entryBy);
		$visaQuery_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$visaQuery_ex = false;
	}
	if ($visaQuery_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Intro Message!', text: 'Intro Message sent to Client.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}
// update Dov Cimea Checklist
if(isset($_POST['updDovCimea'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$dovCimeaNote = $_POST['dovCimeaNote'] ?? '';

	$uploadedFiles = [];
	if (!empty($_FILES['dovCimeaFile']['name'][0])) {
		foreach ($_FILES['dovCimeaFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['dovCimeaFile']['name'][$key],
				'type' => $_FILES['dovCimeaFile']['type'][$key],
				'tmp_name' => $_FILES['dovCimeaFile']['tmp_name'][$key],
				'error' => $_FILES['dovCimeaFile']['error'][$key],
				'size' => $_FILES['dovCimeaFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'czech_clients_visa_intro_checklist' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (visa_intro_checklist_client_id, visa_intro_checklist_steps_name, visa_intro_checklist_screenshot, visa_intro_checklist_note, close, status, entry_by) VALUES (?, 'DOV Cimea Checklist', ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = $_SESSION['uname'] ?? '';
		mysqli_stmt_bind_param($stmt, 'isss', $upClientID, $filesString, $dovCimeaNote, $entryBy);
		$visaQuery_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$visaQuery_ex = false;
	}
	if ($visaQuery_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Checklist!', text: 'Checklist sent to Client.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

// update Visa Checklist
if(isset($_POST['updVisa'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$visaNote = $_POST['visaNote'] ?? '';

	$uploadedFiles = [];
	if (!empty($_FILES['visaFile']['name'][0])) {
		foreach ($_FILES['visaFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['visaFile']['name'][$key],
				'type' => $_FILES['visaFile']['type'][$key],
				'tmp_name' => $_FILES['visaFile']['tmp_name'][$key],
				'error' => $_FILES['visaFile']['error'][$key],
				'size' => $_FILES['visaFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'czech_clients_visa_intro_checklist' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (visa_intro_checklist_client_id, visa_intro_checklist_steps_name, visa_intro_checklist_screenshot, visa_intro_checklist_note, close, status, entry_by) VALUES (?, 'Visa Checklist', ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = $_SESSION['uname'] ?? '';
		mysqli_stmt_bind_param($stmt, 'isss', $upClientID, $filesString, $visaNote, $entryBy);
		$visaQuery_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$visaQuery_ex = false;
	}
	if ($visaQuery_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Visa Checklist!', text: 'Visa Checklist sent to Client.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

// update case history
if(isset($_POST['updCaseHistory'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$caseHistoryStatus = $_POST['caseHistoryStatus'] ?? '';
	$caseHistoryNote = $_POST['caseHistoryNote'] ?? '';

	if($caseHistoryStatus=='Case History sent to Clients'){
		$caseStatus = 1;
	} else {
		$runTable = 'czech_clients_visa_case_history' . $_SESSION['dbNo'];
		$runSql = "UPDATE `" . $runTable . "` SET visa_case_status = '0' WHERE visa_case_history_client_id = ?";
		$runStmt = mysqli_prepare($con, $runSql);
		if ($runStmt) {
			mysqli_stmt_bind_param($runStmt, 'i', $upClientID);
			mysqli_stmt_execute($runStmt);
			mysqli_stmt_close($runStmt);
		}
		$caseStatus = 0;
	}

	$uploadedFiles = [];
	if (!empty($_FILES['caseHistoryFile']['name'][0])) {
		foreach ($_FILES['caseHistoryFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['caseHistoryFile']['name'][$key],
				'type' => $_FILES['caseHistoryFile']['type'][$key],
				'tmp_name' => $_FILES['caseHistoryFile']['tmp_name'][$key],
				'error' => $_FILES['caseHistoryFile']['error'][$key],
				'size' => $_FILES['caseHistoryFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'czech_clients_visa_case_history' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (visa_case_history_client_id, visa_case_history_status, visa_case_history_screenshot, visa_case_history_note, visa_case_status, close, status, entry_by) VALUES (?, ?, ?, ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = $_SESSION['uname'] ?? '';
		mysqli_stmt_bind_param($stmt, 'isssis', $upClientID, $caseHistoryStatus, $filesString, $caseHistoryNote, $caseStatus, $entryBy);
		$visaQuery_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$visaQuery_ex = false;
	}
	if ($visaQuery_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Case History!', text: 'Case History sent to Client.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

// update Educational Documents Attestation
if(isset($_POST['updDocAttestation'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$docAttestationStatus = $_POST['docAttestationStatus'] ?? '';
	$docAttestationNote = $_POST['docAttestationNote'] ?? '';

	$uploadedFiles = [];
	if (!empty($_FILES['docAttestationFile']['name'][0])) {
		foreach ($_FILES['docAttestationFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['docAttestationFile']['name'][$key],
				'type' => $_FILES['docAttestationFile']['type'][$key],
				'tmp_name' => $_FILES['docAttestationFile']['tmp_name'][$key],
				'error' => $_FILES['docAttestationFile']['error'][$key],
				'size' => $_FILES['docAttestationFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'czech_clients_visa_attest_trans' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (visa_attest_trans_client_id, visa_attest_trans_step_name, visa_attest_trans_status, visa_attest_trans_screenshot, visa_attest_trans_note, close, status, entry_by) VALUES (?, 'Documents Attestation', ?, ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = $_SESSION['uname'] ?? '';
		mysqli_stmt_bind_param($stmt, 'issss', $upClientID, $docAttestationStatus, $filesString, $docAttestationNote, $entryBy);
		$visaQuery_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$visaQuery_ex = false;
	}
	if ($visaQuery_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Documents Attestation!', text: 'Documents Attestation is Saved.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

// update Intro Message 
if(isset($_POST['updscholarship'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$scholarshipNote = $_POST['scholarshipNote'] ?? '';

	$uploadedFiles = [];
	if (!empty($_FILES['scholarshipFile']['name'][0])) {
		foreach ($_FILES['scholarshipFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['scholarshipFile']['name'][$key],
				'type' => $_FILES['scholarshipFile']['type'][$key],
				'tmp_name' => $_FILES['scholarshipFile']['tmp_name'][$key],
				'error' => $_FILES['scholarshipFile']['error'][$key],
				'size' => $_FILES['scholarshipFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'czech_clients_visa_intro_checklist' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (visa_intro_checklist_client_id, visa_intro_checklist_steps_name, visa_intro_checklist_screenshot, visa_intro_checklist_note, close, status, entry_by) VALUES (?, 'Scholarship Details', ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = $_SESSION['uname'] ?? '';
		mysqli_stmt_bind_param($stmt, 'isss', $upClientID, $filesString, $scholarshipNote, $entryBy);
		$visaQuery_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$visaQuery_ex = false;
	}
	if ($visaQuery_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Scholarship!', text: 'Scholarship sent to Client.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

// update Educational Documents Translate
if(isset($_POST['updDocTranslate'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$docTranslateStatus = $_POST['docTranslateStatus'] ?? '';
	$docTranslateNote = $_POST['docTranslateNote'] ?? '';

	$uploadedFiles = [];
	if (!empty($_FILES['docTranslateFile']['name'][0])) {
		foreach ($_FILES['docTranslateFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['docTranslateFile']['name'][$key],
				'type' => $_FILES['docTranslateFile']['type'][$key],
				'tmp_name' => $_FILES['docTranslateFile']['tmp_name'][$key],
				'error' => $_FILES['docTranslateFile']['error'][$key],
				'size' => $_FILES['docTranslateFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'czech_clients_visa_attest_trans' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (visa_attest_trans_client_id, visa_attest_trans_step_name, visa_attest_trans_status, visa_attest_trans_screenshot, visa_attest_trans_note, close, status, entry_by) VALUES (?, 'Documents Translate', ?, ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = $_SESSION['uname'] ?? '';
		mysqli_stmt_bind_param($stmt, 'issss', $upClientID, $docTranslateStatus, $filesString, $docTranslateNote, $entryBy);
		$visaQuery_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$visaQuery_ex = false;
	}
	if ($visaQuery_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Documents Translate!', text: 'Documents Translate is Saved.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}


// update Book Visa Appointment
if(isset($_POST['updVisaBook'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$visaBookStatus = $_POST['visaBookStatus'] ?? '';
	$visaBookDate = $_POST['visaBookDate'] ?? '';
	$visaBookUsername = $_POST['visaBookUsername'] ?? '';
	$visaBookPassword = $_POST['visaBookPassword'] ?? '';
	$visaBookNote = $_POST['visaBookNote'] ?? '';

	$uploadedFiles = [];
	if (!empty($_FILES['visaBookFile']['name'][0])) {
		foreach ($_FILES['visaBookFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['visaBookFile']['name'][$key],
				'type' => $_FILES['visaBookFile']['type'][$key],
				'tmp_name' => $_FILES['visaBookFile']['tmp_name'][$key],
				'error' => $_FILES['visaBookFile']['error'][$key],
				'size' => $_FILES['visaBookFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'czech_clients_visa_book_appoint' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (visa_book_appoint_client_id, visa_book_appoint_status, visa_book_appoint_date, visa_book_appoint_username, visa_book_appoint_password, visa_book_appoint_screenshot, visa_book_appoint_note, close, status, entry_by) VALUES (?, ?, ?, ?, ?, ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = $_SESSION['uname'] ?? '';
		mysqli_stmt_bind_param($stmt, 'isssssss', $upClientID, $visaBookStatus, $visaBookDate, $visaBookUsername, $visaBookPassword, $filesString, $visaBookNote, $entryBy);
		$visaQuery_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$visaQuery_ex = false;
	}
	if ($visaQuery_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Book Visa Appointment!', text: 'Book Visa Appointment is Saved.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}
?>