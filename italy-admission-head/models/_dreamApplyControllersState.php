<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');


if(isset($_POST['subAccDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$accountUsername = mysqli_real_escape_string($con, $_POST['accountUsername']);
	$accountPassword = mysqli_real_escape_string($con, $_POST['accountPassword']);
	$accountLink = mysqli_real_escape_string($con, $_POST['accountLink']);

	$firstrun = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_account_username='".$accountUsername."', italy_account_password='".$accountPassword."', italy_account_link='".$accountLink."' WHERE italy_client_pro_id='".$updateProgramID."' ";
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

// Insert Additional Activities
if(isset($_POST['subAdditionalAct'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$addActivitiesNote = mysqli_real_escape_string($con, $_POST['addActivitiesNote']);

	$addActivitiesDocument='';
	if (!empty($_FILES['addActivitiesDocument']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['addActivitiesDocument']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['addActivitiesDocument']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$addActivitiesDocument = implode(',', $uploadedFiles);
		}
	}

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_additional_activities_status='1' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);

	$progAdditional = "INSERT INTO `italy_clients_additional_activities".$_SESSION['dbNo']."` (`italy_add_activity_programs_id`, `italy_add_activity_status`, `italy_add_activity_note`, `italy_add_activity_documents`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', 'Admission Head', '".$addActivitiesNote."', '".$addActivitiesDocument."', '1', '1', '".$_SESSION['uname']."' )";
	$progAdditional_ex = mysqli_query($con,$progAdditional);
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
if(isset($_POST['updateHeadNote'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$personalHeadNote = mysqli_real_escape_string($con, $_POST['personalHeadNote']);

	$personalHeadDocument='';
	if (!empty($_FILES['personalHeadDocument']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['personalHeadDocument']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['personalHeadDocument']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$personalHeadDocument = implode(',', $uploadedFiles);
		}
	}

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_head_personal_note='".$personalHeadNote."', italy_head_personal_documents='".$personalHeadDocument."' WHERE italy_client_pro_id='".$updateProgramID."' ";
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

// Update inform to client 
if(isset($_POST['subAdditional'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$addStep1 = isset($_POST['addStep1']) ? $_POST['addStep1'] : '0';
	$addStep2 = isset($_POST['addStep2']) ? $_POST['addStep2'] : '0';
	$addStep3 = isset($_POST['addStep3']) ? $_POST['addStep3'] : '0';
	$addStep4 = isset($_POST['addStep4']) ? $_POST['addStep4'] : '0';

	if ($addStep1=='1' && $addStep2=='1' && $addStep3=='1' && ($addStep4=='1' || $addStep4=='0')) {
		$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_dream_final_step='1', italy_info_client_status='5', italy_applied_status='6'  WHERE italy_client_pro_id='".$updateProgramID."'";
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
if(isset($_POST['subinfoClient'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$infoClientNote = mysqli_real_escape_string($con, $_POST['infoClientNote']);
	
	if (!empty($_FILES['clientInformScreenshot1']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['clientInformScreenshot1']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['clientInformScreenshot1']['tmp_name'][$key];
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
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_client_info_screenshot1='".$filesString."', italy_client_info_note='".$infoClientNote."', italy_info_client_status='1' WHERE italy_client_pro_id='".$updateProgramID."'";
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
if(isset($_POST['subChangeDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$changingNote = mysqli_real_escape_string($con, $_POST['changingNote']);
	$tolcDate =  "";
	
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_client_status='2', italy_applied_status='5' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	$changingScreenshot1='';
	if (!empty($_FILES['changingScreenshot1']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['changingScreenshot1']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['changingScreenshot1']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$changingScreenshot1 = implode(',', $uploadedFiles);
		}
	}

	$changingAudio='';
	if (!empty($_FILES['changingAudio']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['changingAudio']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['changingAudio']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$changingAudio = implode(',', $uploadedFiles);
		}
	}

	$programItaly = "INSERT INTO `italy_clients_programs_checking".$_SESSION['dbNo']."` (`programs_id`, `type_apply`, `changing_status`, `changing_screenshot`, `changing_audio`, `changing_note`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', 'dream', 'head', '".$changingScreenshot1."', '".$changingAudio."', '".$changingNote."', '1', '1', '".$_SESSION['user_id']."' )";
	$programItaly_ex = mysqli_query($con,$programItaly);
	
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
if(isset($_POST['subOk'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$okNote = mysqli_real_escape_string($con, $_POST['okNote']);

	if (!empty($_FILES['okScreenshot1']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['okScreenshot1']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['okScreenshot1']['tmp_name'][$key];
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
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_ok_screenshot1='".$filesString."', italy_ok_note='".$okNote."' WHERE italy_client_pro_id='".$updateProgramID."'";
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
if(isset($_POST['subGuidFee'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$payFeeNote = mysqli_real_escape_string($con, $_POST['payFeeNote']);

	if (!empty($_FILES['infoPayFee']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['infoPayFee']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['infoPayFee']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$fileInfoPay = implode(',', $uploadedFiles);
		}
	}

	if (!empty($_FILES['feePayClient']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['feePayClient']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['feePayClient']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$fileFeePaid = implode(',', $uploadedFiles);
		}
	}
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_pay_fee='".$fileInfoPay."', italy_fee_paid_client='".$fileFeePaid."', italy_fee_note='".$payFeeNote."' WHERE italy_client_pro_id='".$updateProgramID."'";
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
if(isset($_POST['subProof'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$proofNote = mysqli_real_escape_string($con, $_POST['proofNote']);
	$updUniName = mysqli_real_escape_string($con, $_POST['updUniName']);

	if (!empty($_FILES['proofScreenshot1']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['proofScreenshot1']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['proofScreenshot1']['tmp_name'][$key];
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

	if ($updUniName=='University of Bergamo (BR)') {
		$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_proof_screenshot1='".$filesString."', italy_proof_note='".$proofNote."', italy_info_client_status='7' WHERE italy_client_pro_id='".$updateProgramID."'";
	}else{
		$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_proof_screenshot1='".$filesString."', italy_proof_note='".$proofNote."', italy_info_client_status='6' WHERE italy_client_pro_id='".$updateProgramID."'";
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
if(isset($_POST['submitProgram1'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$programNo1Status = mysqli_real_escape_string($con, $_POST['programNo1Status']);
	$programNo1Date = mysqli_real_escape_string($con, $_POST['programNo1Date']);
	$programNo1Note = mysqli_real_escape_string($con, $_POST['programNo1Note']);
	$current_date = date('Y-m-d');

	if ($programNo1Status=='Acceptance') {
		$val1 = 8;
	}else{
		$val1 = 9;
	}
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_client_status='".$val1."', italy_applied_status='".$val1."', italy_dream_program1_status='".$programNo1Status."', italy_dream_program1_note='".$programNo1Note."', italy_dream_program1_date='".$programNo1Date."' ";

	if (!empty($_FILES['programNo1Screenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['programNo1Screenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['programNo1Screenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_dream_program1_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
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
if(isset($_POST['submitProgram2'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$programNo2Status = mysqli_real_escape_string($con, $_POST['programNo2Status']);
	$programNo2Date = mysqli_real_escape_string($con, $_POST['programNo2Date']);
	$programNo2Note = mysqli_real_escape_string($con, $_POST['programNo2Note']);
	$current_date = date('Y-m-d');
		
	if ($programNo2Status=='Acceptance') {
		$val2 = 8;
	}else{
		$val2 = 9;
	}

	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_client_status='".$val2."', italy_applied_status='".$val2."', italy_dream_program2_status='".$programNo2Status."', italy_dream_program2_note='".$programNo2Note."', italy_dream_program2_date='".$programNo2Date."' ";

	if (!empty($_FILES['programNo2Screenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['programNo2Screenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['programNo2Screenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_dream_program2_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
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

// Update inform to processing team enrollment fee form
if(isset($_POST['subInformEnrollForm'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$informEnrollFormNote = mysqli_real_escape_string($con, $_POST['informEnrollFormNote']);

	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_client_status='10', italy_applied_status='10', italy_enrollment_inform_note='".$informEnrollFormNote."' ";

	if (!empty($_FILES['informEnrollFormScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['informEnrollFormScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['informEnrollFormScreenShot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_enrollment_inform_screenshot='".$filesString."'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Informed!",
			"text" => "Enrollment fee form informed."
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update informed to clients enrollment fee
if(isset($_POST['subEnrollInfoFee'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$payEnrollFeeNote = mysqli_real_escape_string($con, $_POST['payEnrollFeeNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_enroll_fee_note='".$payEnrollFeeNote."', italy_info_client_status='12', italy_applied_status='12' ";

	if (!empty($_FILES['infoEnrollPayFee']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['infoEnrollPayFee']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['infoEnrollPayFee']['tmp_name'][$key];
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
			$updateApplication .= ", italy_enroll_info_pay_fee='".$filesString."'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Informed!",
			"text" => "Informed to Client to Pay Fee."
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update fee paid by client
if(isset($_POST['subEnrollFeePaid'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$payEnrollFeePaidNote = mysqli_real_escape_string($con, $_POST['payEnrollFeePaidNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_enroll_fee_paid_note='".$payEnrollFeePaidNote."' ";

	if (!empty($_FILES['feeEnrollPayClient']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['feeEnrollPayClient']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['feeEnrollPayClient']['tmp_name'][$key];
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
			$updateApplication .= ",italy_info_client_status='6', italy_applied_status='7', italy_enroll_fee_paid_client='".$filesString."'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Fee Paid!",
			"text" => "Application Fee Paid By Client."
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