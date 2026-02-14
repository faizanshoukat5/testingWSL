<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

// doc14
if(isset($_POST['subDoc14'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$doc14 = $_POST['admission_Doc14'] ?? '';
	$table = 'client_addmission_doc' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET admission_doc14 = ? WHERE admission_client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'si', $doc14, $updateID);
		$ok = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$ok = false;
	}
	if ($ok) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Uploaded!', text: 'Document upload Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}
// doc15
if(isset($_POST['subDocText15'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$doc15 = $_POST['admission_Doc15'] ?? '';
	$table = 'client_addmission_doc' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET admission_doc15 = ? WHERE admission_client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'si', $doc15, $updateID);
		$ok = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$ok = false;
	}
	if ($ok) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Uploaded!', text: 'Document upload Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

// docText20
if(isset($_POST['subDocText20'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$doc20 = $_POST['admission_Doc20'] ?? '';
	$table = 'client_addmission_doc' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET admission_doc20 = ? WHERE admission_client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'si', $doc20, $updateID);
		$ok = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$ok = false;
	}
	if ($ok) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Uploaded!', text: 'Document upload Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}
// doc34
if(isset($_POST['subDoc34'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$admissionDoc34 = $_POST['admission_Doc34'] ?? '';

	$table = 'client_addmission_doc' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET admission_doc34 = ? WHERE admission_client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'si', $admissionDoc34, $updateID);
		$ok = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$ok = false;
	}
	if ($ok) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Uploaded!', text: 'Document upload Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

// doc35
if(isset($_POST['subDoc35'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$admissionDoc35 = '';
	$uploadedFiles = [];
	if (!empty($_FILES['admission_Doc35']['name'][0])) {
		foreach ($_FILES['admission_Doc35']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['admission_Doc35']['name'][$key],
				'type' => $_FILES['admission_Doc35']['type'][$key],
				'tmp_name' => $_FILES['admission_Doc35']['tmp_name'][$key],
				'error' => $_FILES['admission_Doc35']['error'][$key],
				'size' => $_FILES['admission_Doc35']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
		if (!empty($uploadedFiles)) {
			$admissionDoc35 = implode(',', $uploadedFiles);
		}
	}

	$table = 'client_addmission_doc' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET admission_doc35 = ? WHERE admission_client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'si', $admissionDoc35, $updateID);
		$ok = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$ok = false;
	}
	if ($ok) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Uploaded!', text: 'Document upload Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

?>