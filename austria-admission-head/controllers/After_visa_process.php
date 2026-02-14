<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

// update Intro Message 
if(isset($_POST['updafterVisa'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$afterVisaNote = $_POST['afterVisaNote'] ?? '';

	$uploadedFiles = [];
	if (!empty($_FILES['afterVisaFile']['name'][0])) {
		foreach ($_FILES['afterVisaFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['afterVisaFile']['name'][$key],
				'type' => $_FILES['afterVisaFile']['type'][$key],
				'tmp_name' => $_FILES['afterVisaFile']['tmp_name'][$key],
				'error' => $_FILES['afterVisaFile']['error'][$key],
				'size' => $_FILES['afterVisaFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'czech_clients_visa_after_process' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (after_visa_client_id, after_visa_status, after_visa_screenshot, after_visa_note, close, status, entry_by) VALUES (?, 'After Visa Steps', ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = $_SESSION['uname'] ?? '';
		mysqli_stmt_bind_param($stmt, 'isss', $upClientID, $filesString, $afterVisaNote, $entryBy);
		$ok = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$ok = false;
	}
	if ($ok) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'After Visa Steps!', text: 'After Visa Steps are save Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}


// Visa Due After Visa inform to client 
if(isset($_POST['dueVisaInfo'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$dueAdInfoNote = $_POST['dueAdInfoNote'] ?? '';
	$current_date =  date('Y-m-d');

	$uploadedFiles = [];
	if (!empty($_FILES['dueAdInfoFile']['name'][0])) {
		foreach ($_FILES['dueAdInfoFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['dueAdInfoFile']['name'][$key],
				'type' => $_FILES['dueAdInfoFile']['type'][$key],
				'tmp_name' => $_FILES['dueAdInfoFile']['tmp_name'][$key],
				'error' => $_FILES['dueAdInfoFile']['error'][$key],
				'size' => $_FILES['dueAdInfoFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'clients' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET due_after_visa_info_file = ?, due_after_visa_info_note = ?, due_after_visa_info_date = ? WHERE client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'sssi', $filesString, $dueAdInfoNote, $current_date, $upClientID);
		$ok = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$ok = false;
	}
	if ($ok) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Informed!', text: 'Inform to Client to Pay Visa Due.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}
// After Visa Paid 
if(isset($_POST['dueVisaPaid'])) {
	$upClientID = (int)($_POST['upClientID'] ?? 0);
	$dueAdPaidNote = $_POST['dueAdPaidNote'] ?? '';
	$current_date =  date('Y-m-d');

	$uploadedFiles = [];
	if (!empty($_FILES['dueAdPaidFile']['name'][0])) {
		foreach ($_FILES['dueAdPaidFile']['name'] as $key => $fileName) {
			$fileArr = [
				'name' => $_FILES['dueAdPaidFile']['name'][$key],
				'type' => $_FILES['dueAdPaidFile']['type'][$key],
				'tmp_name' => $_FILES['dueAdPaidFile']['tmp_name'][$key],
				'error' => $_FILES['dueAdPaidFile']['error'][$key],
				'size' => $_FILES['dueAdPaidFile']['size'][$key],
			];
			$up = upload_single_file($fileArr, __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
			if (!empty($up['success']) && $up['success']) {
				$uploadedFiles[] = $up['file'];
			}
		}
	}
	$filesString = !empty($uploadedFiles) ? implode(',', $uploadedFiles) : '';

	$table = 'clients' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET due_after_visa_paid_file = ?, due_after_visa_paid_note = ?, due_after_visa_paid_date = ? WHERE client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'sssi', $filesString, $dueAdPaidNote, $current_date, $upClientID);
		$ok = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$ok = false;
	}
	if ($ok) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Paid!', text: 'Client Paid Visa Due.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
}

?>