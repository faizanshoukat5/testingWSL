<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if(isset($_POST['subdirectDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$directUsername = mysqli_real_escape_string($con, $_POST['directUsername']);
	$directPassword = mysqli_real_escape_string($con, $_POST['directPassword']);
	$directLink = mysqli_real_escape_string($con, $_POST['directLink']);

	$firstrun = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_username='".$directUsername."', italy_direct_password='".$directPassword."', italy_direct_link='".$directLink."' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$firstrun_ex = mysqli_query($con, $firstrun);
	if ($firstrun_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Saved!",
			"text" => "Login Details are Saved"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Updated account details
if(isset($_POST['subUpdirectDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$updateClientID = mysqli_real_escape_string($con, $_POST['updateClientID']);
	$updUniName = mysqli_real_escape_string($con, $_POST['updUniName']);
	
	$directUpUsername = mysqli_real_escape_string($con, $_POST['directUpUsername']);
	$directUpPassword = mysqli_real_escape_string($con, $_POST['directUpPassword']);
	$directUpLink = mysqli_real_escape_string($con, $_POST['directUpLink']);

	$firstrun = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_directup_username='".$directUpUsername."', italy_directup_password='".$directUpPassword."', italy_directup_link='".$directUpLink."' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$firstrun_ex = mysqli_query($con, $firstrun);
	if ($firstrun_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Saved!",
			"text" => "Updated Login Details are Saved"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Insert Additional Activities
if (isset($_POST['subAdditionalAct'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$addActivitiesNote = mysqli_real_escape_string($con, $_POST['addActivitiesNote']);

	$addActivitiesDocument = '';
	if (!empty($_FILES['addActivitiesDocument']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['addActivitiesDocument']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['addActivitiesDocument']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$addActivitiesDocument = implode(',', $uploadedFiles);
		}
	}

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_additional_activities_status='1' WHERE italy_client_pro_id='" . $updateProgramID . "' ";
	$run_ex = mysqli_query($con, $run);

	$progAdditional = "INSERT INTO `italy_clients_additional_activities".$_SESSION['dbNo']."` (`italy_add_activity_programs_id`, `italy_add_activity_status`, `italy_add_activity_note`, `italy_add_activity_documents`, `close`, `status`, `entry_by`) VALUES ('" . $updateProgramID . "', 'Admission Head', '" . $addActivitiesNote . "', '" . $addActivitiesDocument . "', '1', '1', '" . $_SESSION['uname'] . "' )";
	$progAdditional_ex = mysqli_query($con, $progAdditional);
	if ($progAdditional_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Additional Activities Note!",
			"text" => "Your Additional Activities Note is Saved"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Updated head details
if (isset($_POST['updateHeadNote'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$personalHeadNote = mysqli_real_escape_string($con, $_POST['personalHeadNote']);

	$personalHeadDocument = '';
	if (!empty($_FILES['personalHeadDocument']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['personalHeadDocument']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['personalHeadDocument']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$personalHeadDocument = implode(',', $uploadedFiles);
		}
	}

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_head_personal_note='" . $personalHeadNote . "', italy_head_personal_documents='" . $personalHeadDocument . "' WHERE italy_client_pro_id='" . $updateProgramID . "' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Noted!",
			"text" => "Your Note is save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

if (isset($_POST['subAdditional'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$addStep1 = isset($_POST['addStep1']) ? $_POST['addStep1'] : '0';
	$addStep2 = isset($_POST['addStep2']) ? $_POST['addStep2'] : '0';
	$addStep3 = isset($_POST['addStep3']) ? $_POST['addStep3'] : '0';
	$addStep4 = isset($_POST['addStep4']) ? $_POST['addStep4'] : '0';

	if ($addStep1 == '1' && $addStep2 == '1' && $addStep3 == '1' && ($addStep4 == '1' || $addStep4 == '0')) {
		$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_final_step='1', italy_direct_info_client_status='5', italy_direct_applied_status='6'  WHERE italy_client_pro_id='" . $updateProgramID . "'";
	}
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Final Step!",
			"text" => "Your Final Step is Completed."
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update inform to client 
if (isset($_POST['subdirectinfoClient'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$directclientInformNote = mysqli_real_escape_string($con, $_POST['directclientInformNote']);

	if (!empty($_FILES['directclientInformScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directclientInformScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directclientInformScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_client_info_screenshot='" . $filesString . "', italy_direct_client_info_note='" . $directclientInformNote . "', italy_direct_info_client_status='1' WHERE italy_client_pro_id='" . $updateProgramID . "'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Informed!",
			"text" => "Client to Check the Application are save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Checking file status by client
if (isset($_POST['subChangedirectDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$changingNote = mysqli_real_escape_string($con, $_POST['changingNote']);
	$tolcDate =  "";

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_info_client_status='2', italy_direct_applied_status='5' WHERE italy_client_pro_id='" . $updateProgramID . "' ";
	$run_ex = mysqli_query($con, $run);
	$changingScreenshot = '';
	if (!empty($_FILES['changingScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['changingScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['changingScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$changingScreenshot = implode(',', $uploadedFiles);
		}
	}
	$changingAudio = '';
	if (!empty($_FILES['changingAudio']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['changingAudio']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['changingAudio']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$changingAudio = implode(',', $uploadedFiles);
		}
	}

	$programItaly = "INSERT INTO `italy_clients_programs_checking".$_SESSION['dbNo']."` (`programs_id`, `type_apply`, `changing_status`, `changing_screenshot`, `changing_audio`, `changing_note`, `close`, `status`, `entry_by`) VALUES ('" . $updateProgramID . "', 'direct', 'head', '" . $changingScreenshot . "', '" . $changingAudio . "', '" . $changingNote . "', '1', '1', '" . $_SESSION['user_id'] . "' )";
	$programItaly_ex = mysqli_query($con, $programItaly);

	if ($programItaly_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Changes Sent!",
			"text" => "Changes in Application are Sent Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update applied application
if (isset($_POST['subdirectOk'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$directokNote = mysqli_real_escape_string($con, $_POST['directokNote']);

	if (!empty($_FILES['directokScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directokScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directokScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_ok_screenshot='" . $filesString . "', italy_direct_ok_note='" . $directokNote . "' WHERE italy_client_pro_id='" . $updateProgramID . "'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Approved!",
			"text" => "Client Approved the Application Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update applied application
if (isset($_POST['subdirectGuidFee'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$directpayFeeNote = mysqli_real_escape_string($con, $_POST['directpayFeeNote']);

	if (!empty($_FILES['directinfoPayFee']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directinfoPayFee']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directinfoPayFee']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$fileInfoFee = implode(',', $uploadedFiles);
		}
	}

	if (!empty($_FILES['directfeePayClient']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directfeePayClient']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directfeePayClient']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filePaidFee = implode(',', $uploadedFiles);
		}
	}
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_info_pay_fee='" . $fileInfoFee . "', italy_direct_fee_paid_client='" . $filePaidFee . "', italy_direct_fee_note='" . $directpayFeeNote . "' WHERE italy_client_pro_id='" . $updateProgramID . "'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Fee Guides!",
			"text" => "Application Fee Guides are save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update applied application
if (isset($_POST['subdirectProof'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$updateUniName = mysqli_real_escape_string($con, $_POST['updateUniName']);
	$updateApplied = mysqli_real_escape_string($con, $_POST['updateApplied']);
	$directproofNote = mysqli_real_escape_string($con, $_POST['directproofNote']);

	if (!empty($_FILES['directproofScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directproofScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directproofScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}
	$current_date =  date('Y-m-d');
	if (($updateUniName == 'University of Genevo (UG)' || $updateUniName=='University of Genova (UG)' || $updateUniName == 'University of Parma (PRM)' || $updateUniName == 'University of Tuscia (TS02)' || $updateUniName == 'University of Tuscia (TS)' || $updateUniName == 'University of Bologna (UBN)' || $updateUniName == 'University of Foggia (FG)' || $updateUniName == 'University of Napoli Fedrico II (UNP)' || $updateUniName == 'University of Verona (VN)' || $updateUniName == 'University of Palermo (PLM)') && $updateApplied=='' ) {
		$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_proof_note='" . $directproofNote . "', italy_direct_info_client_status='6', italy_direct_proof_screenshot='" . $filesString . "', italy_direct_ok_screenshot='" . $filesString . "', italy_direct_client_info_screenshot='" . $filesString . "', italy_direct_step6='1', italy_direct_final_step='1', italy_direct_applied_status='7', italy_direct_applied_date='" . $current_date . "' WHERE italy_client_pro_id='" . $updateProgramID . "'";
	} else {
		$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_proof_note='" . $directproofNote . "', italy_direct_info_client_status='6', italy_direct_proof_screenshot='" . $filesString . "' WHERE italy_client_pro_id='" . $updateProgramID . "'";
	}

	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Proof Completed!",
			"text" => "Client Proof upload Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}


// Update program 1 application
if (isset($_POST['submitProgram1'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$programNo1Status = mysqli_real_escape_string($con, $_POST['programNo1Status']);
	$programNo1Date = mysqli_real_escape_string($con, $_POST['programNo1Date']);
	$programNo1Note = mysqli_real_escape_string($con, $_POST['programNo1Note']);
	$current_date = date('Y-m-d');

	if ($programNo1Status == 'Acceptance') {
		$val1 = 8;
	} else {
		$val1 = 9;
	}

	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_info_client_status='" . $val1 . "', italy_direct_applied_status='" . $val1 . "', italy_direct_program1_status='" . $programNo1Status . "', italy_direct_program1_note='" . $programNo1Note . "', italy_direct_program1_date='" . $programNo1Date . "' ";

	if (!empty($_FILES['programNo1Screenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['programNo1Screenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['programNo1Screenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_direct_program1_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='" . $updateProgramID . "'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Program No 1!",
			"text" => "Program No 1 upload Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update program 2 application
if (isset($_POST['submitProgram2'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$programNo2Status = mysqli_real_escape_string($con, $_POST['programNo2Status']);
	$programNo2Date = mysqli_real_escape_string($con, $_POST['programNo2Date']);
	$programNo2Note = mysqli_real_escape_string($con, $_POST['programNo2Note']);
	$current_date = date('Y-m-d');

	if ($programNo2Status == 'Acceptance') {
		$val2 = 8;
	} else {
		$val2 = 9;
	}

	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_info_client_status='" . $val2 . "', italy_direct_applied_status='" . $val2 . "', italy_direct_program2_status='" . $programNo2Status . "', italy_direct_program2_note='" . $programNo2Note . "', italy_direct_program2_date='" . $programNo2Date . "' ";

	if (!empty($_FILES['programNo2Screenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['programNo2Screenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['programNo2Screenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_direct_program2_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='" . $updateProgramID . "'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Program No 2!",
			"text" => "Program No 2 upload Successfully"
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