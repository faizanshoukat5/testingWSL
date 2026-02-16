<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// update Intro Message 
if(isset($_POST['updIntroMessage'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$introMessageNote = mysqli_real_escape_string($con, $_POST['introMessageNote']);

	if (!empty($_FILES['introMessageFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['introMessageFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['introMessageFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}

	$visaQuery = "INSERT INTO `italy_clients_visa_intro_checklist".$_SESSION['dbNo']."` (`visa_intro_checklist_client_id`, `visa_intro_checklist_steps_name`, `visa_intro_checklist_screenshot`, `visa_intro_checklist_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'Intro Message', '".$filesString."', '".$introMessageNote."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Intro Message sent to Client Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}
// update Dov Cimea Checklist
if(isset($_POST['updDovCimea'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$dovCimeaNote = mysqli_real_escape_string($con, $_POST['dovCimeaNote']);

	if (!empty($_FILES['dovCimeaFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['dovCimeaFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['dovCimeaFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}

	$visaQuery = "INSERT INTO `italy_clients_visa_intro_checklist".$_SESSION['dbNo']."` (`visa_intro_checklist_client_id`, `visa_intro_checklist_steps_name`, `visa_intro_checklist_screenshot`, `visa_intro_checklist_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'DOV Cimea Checklist', '".$filesString."', '".$dovCimeaNote."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Checklist uploaded Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// update Visa Checklist
if(isset($_POST['updVisa'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$visaNote = mysqli_real_escape_string($con, $_POST['visaNote']);

	if (!empty($_FILES['visaFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['visaFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['visaFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}

	$visaQuery = "INSERT INTO `italy_clients_visa_intro_checklist".$_SESSION['dbNo']."` (`visa_intro_checklist_client_id`, `visa_intro_checklist_steps_name`, `visa_intro_checklist_screenshot`, `visa_intro_checklist_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'Visa Checklist', '".$filesString."', '".$visaNote."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Visa Checklist uploaded Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// update case history
if(isset($_POST['updCaseHistory'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$caseHistoryStatus = mysqli_real_escape_string($con, $_POST['caseHistoryStatus']);
	$caseHistoryNote = mysqli_real_escape_string($con, $_POST['caseHistoryNote']);

	if($caseHistoryStatus=='Case History sent to Clients'){
		$caseStatus=1;
	}else{
		$run = "UPDATE italy_clients_visa_case_history".$_SESSION['dbNo']." SET visa_case_status='0' WHERE visa_case_history_client_id='".$upClientID."' ";
		$run_ex = mysqli_query($con, $run);
		$caseStatus=0;
	}

	if (!empty($_FILES['caseHistoryFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['caseHistoryFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['caseHistoryFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}

	$visaQuery = "INSERT INTO `italy_clients_visa_case_history".$_SESSION['dbNo']."` (`visa_case_history_client_id`, `visa_case_history_status`, `visa_case_history_screenshot`, `visa_case_history_note`, `visa_case_status`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', '".$caseHistoryStatus."', '".$filesString."', '".$caseHistoryNote."', '".$caseStatus."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Case History uploaded Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// update Educational Documents Attestation
if(isset($_POST['updDocAttestation'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$docAttestationStatus = mysqli_real_escape_string($con, $_POST['docAttestationStatus']);
	$docAttestationNote = mysqli_real_escape_string($con, $_POST['docAttestationNote']);

	if (!empty($_FILES['docAttestationFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['docAttestationFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['docAttestationFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}

	$visaQuery = "INSERT INTO `italy_clients_visa_attest_trans".$_SESSION['dbNo']."` (`visa_attest_trans_client_id`, `visa_attest_trans_step_name`, `visa_attest_trans_status`, `visa_attest_trans_screenshot`, `visa_attest_trans_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'Documents Attestation', '".$docAttestationStatus."', '".$filesString."', '".$docAttestationNote."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Documents Attestation uploaded Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// update Intro Message 
if(isset($_POST['updscholarship'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$scholarshipNote = mysqli_real_escape_string($con, $_POST['scholarshipNote']);

	if (!empty($_FILES['scholarshipFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['scholarshipFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['scholarshipFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}

	$visaQuery = "INSERT INTO `italy_clients_visa_intro_checklist".$_SESSION['dbNo']."` (`visa_intro_checklist_client_id`, `visa_intro_checklist_steps_name`, `visa_intro_checklist_screenshot`, `visa_intro_checklist_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'Scholarship Details', '".$filesString."', '".$scholarshipNote."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Scholarship uploaded Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// update Educational Documents Translate
if(isset($_POST['updDocTranslate'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$docTranslateStatus = mysqli_real_escape_string($con, $_POST['docTranslateStatus']);
	$docTranslateNote = mysqli_real_escape_string($con, $_POST['docTranslateNote']);

	if (!empty($_FILES['docTranslateFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['docTranslateFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['docTranslateFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}

	$visaQuery = "INSERT INTO `italy_clients_visa_attest_trans".$_SESSION['dbNo']."` (`visa_attest_trans_client_id`, `visa_attest_trans_step_name`, `visa_attest_trans_status`, `visa_attest_trans_screenshot`, `visa_attest_trans_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'Documents Translate', '".$docTranslateStatus."', '".$filesString."', '".$docTranslateNote."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Documents Translate uploaded Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// update Educational Documents Translate
if(isset($_POST['updbookinghotel'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$bookingHotelNote = mysqli_real_escape_string($con, $_POST['bookingHotelNote']);

	if (!empty($_FILES['bookingHotelFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['bookingHotelFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['bookingHotelFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}

	$visaQuery = "INSERT INTO `italy_clients_visa_attest_trans".$_SESSION['dbNo']."` (`visa_attest_trans_client_id`, `visa_attest_trans_step_name`, `visa_attest_trans_status`, `visa_attest_trans_screenshot`, `visa_attest_trans_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'Hotel Booking & Ticket Reservation', 'Hotel Booking & Ticket Reservation', '".$filesString."', '".$bookingHotelNote."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Hotel Booking & Ticket Reservation uploaded Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// update Book Visa Appointment
if(isset($_POST['updVisaBook'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$visaBookStatus = mysqli_real_escape_string($con, $_POST['visaBookStatus']);
	$visaBookDate = mysqli_real_escape_string($con, $_POST['visaBookDate']);
	$visaBookUsername = mysqli_real_escape_string($con, $_POST['visaBookUsername']);
	$visaBookPassword = mysqli_real_escape_string($con, $_POST['visaBookPassword']);
	$visaBookNote = mysqli_real_escape_string($con, $_POST['visaBookNote']);

	if (!empty($_FILES['visaBookFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['visaBookFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['visaBookFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}

	$visaQuery = "INSERT INTO `italy_clients_visa_book_appoint".$_SESSION['dbNo']."` (`visa_book_appoint_client_id`, `visa_book_appoint_status`, `visa_book_appoint_date`, `visa_book_appoint_username`, `visa_book_appoint_password`, `visa_book_appoint_screenshot`, `visa_book_appoint_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', '".$visaBookStatus."', '".$visaBookDate."', '".$visaBookUsername."', '".$visaBookPassword."', '".$filesString."', '".$visaBookNote."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Book Visa Appointment uploaded Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

?>