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

if(isset($_POST['upPersonalNote'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$personalNote = mysqli_real_escape_string($con, $_POST['personalNote']);

	$run = "UPDATE italy_clients_programs SET italy_program_personal_note='".$personalNote."' WHERE italy_client_pro_id='".$updateProgramID."' ";
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

if(isset($_POST['subdirectDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$updateClientID = mysqli_real_escape_string($con, $_POST['updateClientID']);
	$updUniName = mysqli_real_escape_string($con, $_POST['updUniName']);

	$directUsername = mysqli_real_escape_string($con, $_POST['directUsername']);
	$directPassword = mysqli_real_escape_string($con, $_POST['directPassword']);
	$directLink = mysqli_real_escape_string($con, $_POST['directLink']);

	if($updUniName!='University of Tor Vergata (TVR)'){
		$firstrun = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_username='".$directUsername."', italy_direct_password='".$directPassword."', italy_direct_link='".$directLink."', italy_direct_step2='3' WHERE italy_clients_id='".$updateClientID."' AND italy_university_name='".$updUniName."' AND italy_direct_apply='1' ";
		$firstrun_ex = mysqli_query($con, $firstrun);
	}
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_username='".$directUsername."', italy_direct_password='".$directPassword."', italy_direct_link='".$directLink."', italy_direct_step2='3', italy_direct_applied_status='2' ";

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
			$run .= ", italy_direct_screenshot='".$filesString."'";
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

// Updated Tax code of Genevo
if(isset($_POST['upTaxCode'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$directTaxCode = mysqli_real_escape_string($con, $_POST['directTaxCode']);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_tax_code='".$directTaxCode."' WHERE italy_client_pro_id='".$updateProgramID."' ";
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

// Updated account details
if(isset($_POST['subUpdirectDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$updateClientID = mysqli_real_escape_string($con, $_POST['updateClientID']);
	$updUniName = mysqli_real_escape_string($con, $_POST['updUniName']);
	
	$directUpUsername = mysqli_real_escape_string($con, $_POST['directUpUsername']);
	$directUpPassword = mysqli_real_escape_string($con, $_POST['directUpPassword']);
	$directUpLink = mysqli_real_escape_string($con, $_POST['directUpLink']);

	if($updUniName!='University of Tor Vergata (TVR)'){
		$firstrun = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_directup_username='".$directUpUsername."', italy_directup_password='".$directUpPassword."', italy_directup_link='".$directUpLink."', italy_direct_step3='3' WHERE italy_clients_id='".$updateClientID."' AND italy_university_name='".$updUniName."' AND italy_direct_apply='1' ";
		$firstrun_ex = mysqli_query($con, $firstrun);
	}

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_directup_username='".$directUpUsername."', italy_directup_password='".$directUpPassword."', italy_directup_link='".$directUpLink."', italy_direct_step3='3', italy_direct_applied_status='3' ";

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
			$directUpScreenShot = implode(',', $uploadedFiles);
			$run .= ", italy_directup_screenshot='" . $directUpScreenShot . "'";
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

// Update inform to head to client 
if(isset($_POST['subdirectinfoHead'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$directinformNote = mysqli_real_escape_string($con, $_POST['directinformNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_info_note='".$directinformNote."', italy_direct_applied_status='5', italy_program_status='3' ";

	if (!empty($_FILES['directinformScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['directinformScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['directinformScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_direct_info_screenshot='" . $filesString . "'";
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
if(isset($_POST['subdirectChangeDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$changingNote = mysqli_real_escape_string($con, $_POST['changingNote']);
	
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_applied_status='6', italy_program_status='3' WHERE italy_client_pro_id='".$updateProgramID."' ";
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

	$programItaly = "INSERT INTO `italy_clients_programs_checking".$_SESSION['dbNo']."` (`programs_id`, `type_apply`, `changing_status`,`changing_screenshot`, `changing_note`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', 'direct', 'team', '".$changingScreenshot."', '".$changingNote."', '1', '1', '".$_SESSION['user_id']."' )";
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
if(isset($_POST['subdirectApplied'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$directappliedNote = mysqli_real_escape_string($con, $_POST['directappliedNote']);
	$current_date =  date('Y-m-d');
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_applied_status='7', italy_program_status='3', italy_direct_applied_note='".$directappliedNote."', italy_direct_applied_date='".$current_date."' ";

	// Check and update Applied Screenshot
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
			$updateApplication .= ", italy_direct_applied_screenshot='" . $directappliedScreenshot . "'";
		}
	}
	// Check and update Program Screenshot
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
			$updateApplication .= ", italy_direct_program_screenshot='" . $directprogramScreenshot . "'";
		}
	}
	// Check and update detailsScreenshot
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
			$updateApplication .= ", italy_direct_details_screenshot='" . $directdetailsScreenshot . "'";
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
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_info_client_status='".$val1."', italy_direct_applied_status='".$val1."', italy_direct_program1_status='".$programNo1Status."', italy_program_status='3', italy_direct_program1_note='".$programNo1Note."', italy_direct_program1_date='".$programNo1Date."' ";

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
			$updateApplication .= ", italy_direct_program1_screenshot='" . $filesString . "'";
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

	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_info_client_status='".$val2."', italy_direct_applied_status='".$val2."', italy_direct_program2_status='".$programNo2Status."', italy_program_status='3', italy_direct_program2_note='".$programNo2Note."', italy_direct_program2_date='".$programNo2Date."' ";

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
			$updateApplication .= ", italy_direct_program2_screenshot='" . $filesString . "'";
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

?>