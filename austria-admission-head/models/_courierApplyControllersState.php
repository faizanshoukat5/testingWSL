<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

/////////////////// Courier Univerities apply Step ///////////////////////////////////

// step 4 form action
if (isset($_POST['step4DirectType'])) {
	$step4DirectType = $_POST['step4DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_courier_step4='".$step4DirectType."', aus_courier_applied_status='4' WHERE aus_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 6 form action
if (isset($_POST['step6DirectType'])) {
	$step6DirectType = $_POST['step6DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_courier_step5='".$step6DirectType."', aus_courier_applied_status='5' WHERE aus_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}

// Submit Applied
if (isset($_POST['subcourierApplied'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$courierappliedNote = $_POST['courierappliedNote'];
	$currentDate =  date('Y-m-d');
	$courierappliedScreenshot='';
	if (!empty($_FILES['courierappliedScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['courierappliedScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['courierappliedScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$courierappliedScreenshot = implode(',', $uploadedFiles);
		}
	}
	$courierprogramScreenshot='';
	if (!empty($_FILES['courierprogramScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['courierprogramScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['courierprogramScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$courierprogramScreenshot = implode(',', $uploadedFiles);
		}
	}
	$courierdetailsScreenshot='';
	if (!empty($_FILES['courierdetailsScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['courierdetailsScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['courierdetailsScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$courierdetailsScreenshot = implode(',', $uploadedFiles);
		}
	}
	
	$logQuery = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_courier_applied_screenshot='".$courierappliedScreenshot."', aus_courier_program_screenshot='".$courierprogramScreenshot."', aus_courier_details_screenshot='".$courierdetailsScreenshot."', aus_courier_applied_note='".$courierappliedNote."', aus_courier_applied_date='".$currentDate."', aus_courier_applied_status='5' WHERE aus_client_pro_id='".$updateProgramID."' ";
	$logQuery_ex = mysqli_query($con, $logQuery);
	if ($logQuery_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

// Update applied application
if (isset($_POST['subcourierProof'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$courierproofNote = mysqli_real_escape_string($con, $_POST['courierproofNote']);

	if (!empty($_FILES['courierproofScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['courierproofScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['courierproofScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y') . '_' . date('H-i-s') . $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
		}
	}
	$current_date =  date('Y-m-d');
	$updateApplication = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_direct_proof_screenshot='".$filesString."', aus_direct_proof_note='".$courierproofNote."', aus_direct_info_client_status='6' WHERE aus_client_pro_id='" . $updateProgramID . "'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
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

	$updateApplication = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_courier_applied_status='".$val1."', aus_courier_program1_status='".$programNo1Status."', aus_courier_program1_note='".$programNo1Note."', aus_courier_program1_date='".$programNo1Date."', aus_courier_program1_screenshot='".$filesString."' WHERE aus_client_pro_id='".$updateProgramID."'";
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

	$updateApplication = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_courier_applied_status='".$val2."', aus_courier_program2_status='".$programNo2Status."', aus_courier_program2_note='".$programNo2Note."', aus_courier_program2_date='".$programNo2Date."', aus_courier_program2_screenshot='".$filesString."' WHERE aus_client_pro_id='".$updateProgramID."'";
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

?>