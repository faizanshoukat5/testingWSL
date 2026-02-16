<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

/////////////////// Direct Univerities apply Step ///////////////////////////////////

// step 1 form action
if (isset($_POST['step1DirectType'])) {
	$step1DirectType = $_POST['step1DirectType'];
	$uniDirectID = $_POST['uniDirectID'];

	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_step1='".$step1DirectType."', aus_direct_applied_status='1' WHERE aus_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);

}
// step 2 form action
if (isset($_POST['step2DirectType'])) {
	$step2DirectType = $_POST['step2DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_step2='".$step2DirectType."', aus_direct_applied_status='2' WHERE aus_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 3 form action
if (isset($_POST['step3DirectType'])) {
	$step3DirectType = $_POST['step3DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_step3='".$step3DirectType."', aus_direct_applied_status='3' WHERE aus_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 4 form action
if (isset($_POST['step4DirectType'])) {
	$step4DirectType = $_POST['step4DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_step4='".$step4DirectType."', aus_direct_applied_status='4' WHERE aus_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 6 form action
if (isset($_POST['step6DirectType'])) {
	$step6DirectType = $_POST['step6DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_step5='".$step6DirectType."', aus_direct_applied_status='5' WHERE aus_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}
// Submit login details
if (isset($_POST['subdirectDetails'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$updateClientID = $_POST['updateClientID'];
	$updUniName = $_POST['updUniName'];
	$directUsername = $_POST['directUsername'];
	$directPassword = $_POST['directPassword'];
	$directLink = $_POST['directLink'];
	$filesString='';
	if (!empty($_FILES['directScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directScreenShot']['tmp_name'][$key];
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
	
	$logQuery = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_username='".$directUsername."', aus_direct_password='".$directPassword."', aus_direct_link='".$directLink."', aus_direct_screenshot='".$filesString."', aus_direct_step2='3', aus_direct_applied_status='2' WHERE aus_client_pro_id='".$updateProgramID."' ";
	$logQuery_ex = mysqli_query($con, $logQuery);
	if ($logQuery_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

// Updated login details
if (isset($_POST['subUpdirectDetails'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$updateClientID = $_POST['updateClientID'];
	$updUniName = $_POST['updUniName'];
	$directUpUsername = $_POST['directUpUsername'];
	$directUpPassword = $_POST['directUpPassword'];
	$directUpLink = $_POST['directUpLink'];
	$filesString='';
	if (!empty($_FILES['directUpScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directUpScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directUpScreenShot']['tmp_name'][$key];
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
	
	$updQuery = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_directup_username='".$directUpUsername."', aus_directup_password='".$directUpPassword."', aus_directup_link='".$directUpLink."', aus_directup_screenshot='".$filesString."', aus_direct_step3='3', aus_direct_applied_status='3' WHERE aus_client_pro_id='".$updateProgramID."' ";
	$updQuery_ex = mysqli_query($con, $updQuery);
	if ($updQuery_ex) {
		echo "success";
	}else{
		echo "error";
	}
}


// Submit Applied
if (isset($_POST['subdirectApplied'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$directappliedNote = $_POST['directappliedNote'];
	$currentDate =  date('Y-m-d');
	$directappliedScreenshot='';
	if (!empty($_FILES['directappliedScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directappliedScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directappliedScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$directappliedScreenshot = implode(',', $uploadedFiles);
		}
	}
	$directprogramScreenshot='';
	if (!empty($_FILES['directprogramScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directprogramScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directprogramScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$directprogramScreenshot = implode(',', $uploadedFiles);
		}
	}
	$directdetailsScreenshot='';
	if (!empty($_FILES['directdetailsScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directdetailsScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directdetailsScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$directdetailsScreenshot = implode(',', $uploadedFiles);
		}
	}
	
	$logQuery = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_applied_screenshot='".$directappliedScreenshot."', aus_direct_program_screenshot='".$directprogramScreenshot."', aus_direct_details_screenshot='".$directdetailsScreenshot."', aus_direct_applied_note='".$directappliedNote."', aus_direct_applied_date='".$currentDate."', aus_direct_applied_status='5' WHERE aus_client_pro_id='".$updateProgramID."' ";
	$logQuery_ex = mysqli_query($con, $logQuery);
	if ($logQuery_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

// Send The Request To the AJAX Modal
if (isset($_POST['subFileNoteBtn'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$fileColName = $_POST['fileColName'];
	$noteColName = $_POST['noteColName'];
	$appliedStatus = $_POST['appliedStatus'];
	$noteName = $_POST['noteName'];
	$filesString='';
    if (!empty($_FILES['fileName']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['fileName']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['fileName']['tmp_name'][$key];
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

	$updQuery = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET $fileColName='$filesString', $noteColName='$noteName', aus_direct_applied_status='".$appliedStatus."' WHERE aus_client_pro_id='".$updateProgramID."'";
	$updQuery_ex = mysqli_query($con,$updQuery);
	if ($updQuery_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

// Update program 1 application
if(isset($_POST['submitProgram1'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$programNo1Status = $_POST['programNo1Status'];
	$programNo1Date = $_POST['programNo1Date'];
	$programNo1Note = mysqli_real_escape_string($con, $_POST['programNo1Note']);

	if ($programNo1Status=='Acceptance') {
		$val1 = 10;
	}else{
		$val1 = 11;
	}
	$filesString='';
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
		}
	}

	$updateApplication = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_applied_status='".$val1."', aus_direct_program1_status='".$programNo1Status."', aus_direct_program1_note='".$programNo1Note."', aus_direct_program1_date='".$programNo1Date."', aus_direct_program1_screenshot='".$filesString."' WHERE aus_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

// Update program 2 application
if(isset($_POST['submitProgram2'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$programNo2Status = $_POST['programNo2Status'];
	$programNo2Date = $_POST['programNo2Date'];
	$programNo2Note = mysqli_real_escape_string($con, $_POST['programNo2Note']);
		
	if ($programNo2Status=='Acceptance') {
		$val2 = 10;
	}else{
		$val2 = 11;
	}
	$filesString='';
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
		}
	}

	$updateApplication = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_applied_status='".$val2."', aus_direct_program2_status='".$programNo2Status."', aus_direct_program2_note='".$programNo2Note."', aus_direct_program2_date='".$programNo2Date."', aus_direct_program2_screenshot='".$filesString."' WHERE aus_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo "success";
	}else{
		echo "error";
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

	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_additional_activities_status='1' WHERE aus_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);

	$progAdditional = "INSERT INTO austria_clients_additional_activities".$_SESSION['dbNo']." (`aus_add_activity_programs_id`, `aus_add_activity_status`, `aus_add_activity_note`, `aus_add_activity_documents`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', 'Admission Head', '".$addActivitiesNote."', '".$addActivitiesDocument."', '1', '1', '".$_SESSION['uname']."' )";
	$progAdditional_ex = mysqli_query($con,$progAdditional);
	if ($progAdditional_ex) {
		echo "success";
	}else{
		echo "error";
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

	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_head_personal_note='".$personalHeadNote."', aus_head_personal_documents='".$personalHeadDocument."' WHERE aus_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo "success";
	}else{
		echo "error";
	}
}


// Submit Inform Client Details (Step 5 - Tab 1)
if (isset($_POST['subdirectinfoClient'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$directclientInformNote = mysqli_real_escape_string($con, $_POST['directclientInformNote']);
	$filesString='';
	if (!empty($_FILES['directclientInformScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directclientInformScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directclientInformScreenshot']['tmp_name'][$key];
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
	
	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_recheck_screenshot='".$filesString."', aus_direct_recheck_note='".$directclientInformNote."', aus_direct_applied_status='4' WHERE aus_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo json_encode(["status" => "success", "title" => "Inform to Client", "text" => "Inform details updated successfully!"]);
	}else{
		echo json_encode(["status" => "error", "title" => "Error", "text" => "Something went wrong!"]);
	}
}

// Submit Change Details (Step 5 - Tab 2)
if(isset($_POST['subdirectChangeDetails'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$changingNote = mysqli_real_escape_string($con, $_POST['changingNote']);

	$changingScreenshot1='';
	if (!empty($_FILES['changingScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['changingScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['changingScreenshot']['tmp_name'][$key];
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

	$changingAudio1='';
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
			$changingAudio1 = implode(',', $uploadedFiles);
		}
	}
	
	$sqlColumns = "`programs_id`, `type_apply`, `changing_status`, `changing_screenshot`, `changing_audio`, `changing_note`, `close`, `status`, `entry_by`";
	$sqlValues = "'".$updateProgramID."', 'direct', 'head', '".$changingScreenshot1."', '".$changingAudio1."', '".$changingNote."', '1', '1', '".$_SESSION['user_id']."'";
	
	$programAustria = "INSERT INTO austria_clients_programs_checking".$_SESSION['dbNo']." ($sqlColumns) VALUES ($sqlValues)";
	$programAustria_ex = mysqli_query($con,$programAustria);

	if ($programAustria_ex) {
		echo json_encode(["status" => "success", "title" => "Change Request", "text" => "Change request sent successfully!"]);
	}else{
		echo json_encode(["status" => "error", "title" => "Error", "text" => "Something went wrong!"]);
	}
}

// Submit Approved Details (Step 5 - Tab 3)
if(isset($_POST['subdirectOk'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$directOkNote = mysqli_real_escape_string($con, $_POST['directOkNote']);
	$filesString='';
	if (!empty($_FILES['directOkScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directOkScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directOkScreenshot']['tmp_name'][$key];
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
	
	$updateApplication = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_ok_screenshot='".$filesString."', aus_direct_ok_note='".$directOkNote."' WHERE aus_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode(["status" => "success", "title" => "Application Approved", "text" => "Application marked as approved!"]);
	}else{
		echo json_encode(["status" => "error", "title" => "Error", "text" => "Something went wrong!"]);
	}
}

// Submit Fee Details (Step 5 - Tab 4)
if(isset($_POST['subdirectFee'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$directfeenote = mysqli_real_escape_string($con, $_POST['directfeenote']);
	
	$infoFeeString='';
	if (!empty($_FILES['directinfofee']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directinfofee']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directinfofee']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) { $infoFeeString = implode(',', $uploadedFiles); }
	}

	$feePaidString='';
	if (!empty($_FILES['directfeepaid']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directfeepaid']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directfeepaid']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) { $feePaidString = implode(',', $uploadedFiles); }
	}

	$updateFee = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_info_fee='".$infoFeeString."', aus_direct_fee_paid='".$feePaidString."', aus_direct_fee_note='".$directfeenote."' WHERE aus_client_pro_id='".$updateProgramID."'";
	$updateFee_ex = mysqli_query($con, $updateFee);
	if ($updateFee_ex) {
		echo json_encode(["status" => "success", "title" => "Fee Details", "text" => "Fee details updated successfully!"]);
	}else{
		echo json_encode(["status" => "error", "title" => "Error", "text" => "Something went wrong!"]);
	}
}

// Final Step (Step 5 - Tab 5)
if(isset($_POST['subdirectFinalStep'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$updateFinal = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_step5='1' WHERE aus_client_pro_id='".$updateProgramID."'";
	$updateFinal_ex = mysqli_query($con, $updateFinal);
	if ($updateFinal_ex) {
		echo json_encode(["status" => "success", "title" => "Final Step", "text" => "Step 5 finalized!"]);
	}else{
		echo json_encode(["status" => "error", "title" => "Error", "text" => "Something went wrong!"]);
	}
}


?>