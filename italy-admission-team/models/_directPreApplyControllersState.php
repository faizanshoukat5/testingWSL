<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// apostille document
if(isset($_POST['updApostille'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);

	$apostilleDocument='';
	if (!empty($_FILES['apostilleDocument']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['apostilleDocument']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['apostilleDocument']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$apostilleDocument = implode(',', $uploadedFiles);
		}
	}

	$clientApos = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET apostille_document='".$apostilleDocument."' WHERE admission_client_id='".$updateID."' ";
	$clientApos_ex = mysqli_query($con, $clientApos);
	if ($clientApos_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Apostille Document!",
			"text" => "Apostille Document upload Successfully."
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

if(isset($_POST['subpreDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$preUsername = mysqli_real_escape_string($con, $_POST['preUsername']);
	$prePassword = mysqli_real_escape_string($con, $_POST['prePassword']);
	$preLink = mysqli_real_escape_string($con, $_POST['preLink']);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_username='".$preUsername."', italy_pre_password='".$prePassword."', italy_pre_link='".$preLink."', italy_pre_step2='3', italy_pre_applied_status='2' ";

	if (!empty($_FILES['preScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['preScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['preScreenShot']['tmp_name'][$key];
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
			$run .= ", italy_pre_screenshot='".$filesString."'";
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

// Updated account details
if(isset($_POST['subUppreDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$preUpUsername = mysqli_real_escape_string($con, $_POST['preUpUsername']);
	$preUpPassword = mysqli_real_escape_string($con, $_POST['preUpPassword']);
	$preUpLink = mysqli_real_escape_string($con, $_POST['preUpLink']);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_preup_username='".$preUpUsername."', italy_preup_password='".$preUpPassword."', italy_preup_link='".$preUpLink."', italy_pre_step3='3', italy_pre_applied_status='3' ";

	if (!empty($_FILES['preUpScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['preUpScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['preUpScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$preUpScreenShot = implode(',', $uploadedFiles);
			$run .= ", italy_preup_screenshot='" . $preUpScreenShot . "'";
		}
	}

	$run .= " WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
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

// Update inform to head to client 
if(isset($_POST['subpreinfoHead'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$preinformNote = mysqli_real_escape_string($con, $_POST['preinformNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_info_note='".$preinformNote."', italy_pre_applied_status='5' ";

	if (!empty($_FILES['preinformScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['preinformScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['preinformScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_pre_info_screenshot='" . $filesString . "'";
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


// Update applied application
if(isset($_POST['subpreApplied'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$preappliedNote = mysqli_real_escape_string($con, $_POST['preappliedNote']);
	$current_date =  date('Y-m-d');
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_applied_status='6', italy_pre_applied_note='".$preappliedNote."', italy_pre_applied_date='".$current_date."' ";

	// Check and update Applied Screenshot
	if (!empty($_FILES['preappliedScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['preappliedScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['preappliedScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$preappliedScreenshot = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_pre_applied_screenshot='".$preappliedScreenshot."'";
		}
	}
	// Check and update Program Screenshot
	if (!empty($_FILES['preprogramScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['preprogramScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['preprogramScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$preprogramScreenshot = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_pre_program_screenshot='".$preprogramScreenshot."'";
		}
	}
	// Check and update detailsScreenshot
	if (!empty($_FILES['predetailsScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['predetailsScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['predetailsScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$predetailsScreenshot = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_pre_details_screenshot='".$predetailsScreenshot."'";
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
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_info_client_status='".$val1."', italy_pre_applied_status='".$val1."', italy_pre_program1_status='".$programNo1Status."', italy_pre_program1_note='".$programNo1Note."', italy_pre_program1_date='".$programNo1Date."' ";

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
			$updateApplication .= ", italy_pre_program1_screenshot='" . $filesString . "'";
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

?>