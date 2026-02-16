<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

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

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_additional_activities_status='2' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);

	$progAdditional = "INSERT INTO `italy_clients_additional_activities".$_SESSION['dbNo']."` (`italy_add_activity_programs_id`, `italy_add_activity_status`, `italy_add_activity_note`, `italy_add_activity_documents`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', 'Processing Team', '".$addActivitiesNote."', '".$addActivitiesDocument."', '1', '1', '".$_SESSION['uname']."' )";
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

// Updated account details
if(isset($_POST['upPersonalNote'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$personalNote = mysqli_real_escape_string($con, $_POST['personalNote']);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_program_personal_note='".$personalNote."' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Noted!",
			"text" => "Your Note is Saved"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

if(isset($_POST['subAccDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$updateClientID = mysqli_real_escape_string($con, $_POST['updateClientID']);
	$accountUsername = mysqli_real_escape_string($con, $_POST['accountUsername']);
	$accountPassword = mysqli_real_escape_string($con, $_POST['accountPassword']);
	$accountLink = mysqli_real_escape_string($con, $_POST['accountLink']);

	$firstrun = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_account_username='".$accountUsername."', italy_account_password='".$accountPassword."', italy_pro_step2='3' WHERE italy_clients_id='".$updateClientID."' AND italy_dream_id='1'";
	$firstrun_ex = mysqli_query($con, $firstrun);

	if ($firstrun_ex) {
		$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_account_username='".$accountUsername."', italy_account_password='".$accountPassword."', italy_account_link='".$accountLink."', italy_pro_step2='3', italy_applied_status='2' ";

		if (!empty($_FILES['accountScreenShot']['name'][0])) {
			$uploadedFiles = [];
			foreach ($_FILES['accountScreenShot']['name'] as $key => $fileName) {
				$tmpFilePath = $_FILES['accountScreenShot']['tmp_name'][$key];
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
				$run .= ", italy_account_screenshot='" . $filesString . "'";
			}
		}
		$run .= " WHERE italy_client_pro_id='".$updateProgramID."' ";
		$run_ex = mysqli_query($con, $run);
		if ($run_ex) {
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
}

// Updated account details
if(isset($_POST['subUpAccDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$accountUpUsername = mysqli_real_escape_string($con, $_POST['accountUpUsername']);
	$accountUpPassword = mysqli_real_escape_string($con, $_POST['accountUpPassword']);
	$accountUpLink = mysqli_real_escape_string($con, $_POST['accountUpLink']);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_accountup_username='".$accountUpUsername."', italy_accountup_password='".$accountUpPassword."', italy_accountup_link='".$accountUpLink."', italy_pro_step3='3', italy_applied_status='3' ";

	if (!empty($_FILES['accountUpScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['accountUpScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['accountUpScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$accountUpScreenShot = implode(',', $uploadedFiles);
			$run .= ", italy_accountup_screenshot='" . $accountUpScreenShot . "'";
		}
	}

	$run .= " WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Saved!",
			"text" => "Updated Login Details are Saved."
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Updated Tax code of Genevo
if(isset($_POST['upTaxCode'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$taxCode = mysqli_real_escape_string($con, $_POST['taxCode']);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tax_code='".$taxCode."' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Saved!",
			"text" => "Code is Saved."
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update inform to head to client 
if(isset($_POST['subinfoHead'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$infoHeadNote = mysqli_real_escape_string($con, $_POST['infoHeadNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_head_note='".$infoHeadNote."', italy_applied_status='5', italy_program_status='3' ";

	if (!empty($_FILES['infoScreenShot1']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['infoScreenShot1']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['infoScreenShot1']['tmp_name'][$key];
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
			$updateApplication .= ", italy_info_screenshot1='".$filesString."'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Inform to Head!",
			"text" => "Client to Check the Application are Saved."
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
	
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_applied_status='6', italy_program_status='3' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	
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
			$changingScreenshot = implode(',', $uploadedFiles);
		}
	}
	$programItaly = "INSERT INTO `italy_clients_programs_checking".$_SESSION['dbNo']."` (`programs_id`, `type_apply`, `changing_status`, `changing_screenshot`, `changing_note`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', 'dream', 'team', '".$changingScreenshot."', '".$changingNote."', '1', '1', '".$_SESSION['user_id']."' )";
	$programItaly_ex = mysqli_query($con,$programItaly);
	
	if ($programItaly_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Changes Completed!",
			"text" => "Changes in Application are Saved."
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
if(isset($_POST['subApplied'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$appliedNote = mysqli_real_escape_string($con, $_POST['appliedNote']);
	$current_date =  date('Y-m-d');
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_applied_status='7', italy_program_status='3', italy_applied_note='".$appliedNote."', italy_applied_date='".$current_date."' ";

	// Check and update Applied Screenshot
	if (!empty($_FILES['appliedScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['appliedScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['appliedScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$appliedScreenshot = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_applied_screenshot='" . $appliedScreenshot . "'";
		}
	}

	// Check and update Program Screenshot
	if (!empty($_FILES['programScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['programScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['programScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$programScreenshot = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_program_screenshot='" . $programScreenshot . "'";
		}
	}

	// Check and update detailsScreenshot
	if (!empty($_FILES['detailsScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['detailsScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['detailsScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$detailsScreenshot = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_details_screenshot='" . $detailsScreenshot . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Applied!",
			"text" => "Client Application applied are Saved."
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
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_client_status='".$val1."', italy_applied_status='".$val1."', italy_program_status='3', italy_dream_program1_status='".$programNo1Status."', italy_dream_program1_note='".$programNo1Note."', italy_dream_program1_date='".$programNo1Date."' ";

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

	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_client_status='".$val2."', italy_applied_status='".$val2."', italy_dream_program2_status='".$programNo2Status."', italy_program_status='3', italy_dream_program2_note='".$programNo2Note."', italy_dream_program2_date='".$programNo2Date."' ";

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

// Enroll fee user name 
if(isset($_POST['subEnrollClient'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$enrollmentUsername = mysqli_real_escape_string($con, $_POST['enrollmentUsername']);
	$enrollmentPassword = mysqli_real_escape_string($con, $_POST['enrollmentPassword']);
	$enrollmentLink = mysqli_real_escape_string($con, $_POST['enrollmentLink']);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_enrollment_username='".$enrollmentUsername."', italy_enrollment_password='".$enrollmentPassword."', italy_enrollment_link='".$enrollmentLink."', italy_info_client_status='11', italy_applied_status='11', italy_program_status='3' ";

	if (!empty($_FILES['enrollmentScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['enrollmentScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['enrollmentScreenShot']['tmp_name'][$key];
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
			$run .= ", italy_enrollment_screenshot='" . $filesString . "'";
		}
	}
	$run .= " WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Informed!",
			"text" => "Inform to Head are Save Successfully"
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