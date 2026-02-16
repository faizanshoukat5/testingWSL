<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if(isset($_POST['subCimeaDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$cimeaUsername = mysqli_real_escape_string($con, $_POST['cimeaUsername']);
	$cimeaPassword = mysqli_real_escape_string($con, $_POST['cimeaPassword']);
	$cimeaLink = mysqli_real_escape_string($con, $_POST['cimeaLink']);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_username='".$cimeaUsername."', italy_cimea_password='".$cimeaPassword."', italy_cimea_link='".$cimeaLink."', italy_cimea_step2='3', italy_cimea_applied_status='2' ";

	if (!empty($_FILES['cimeaScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeaScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeaScreenShot']['tmp_name'][$key];
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
			$run .= ", italy_cimea_screenshot='" . $filesString . "'";
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
if(isset($_POST['subUpCimeaDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$cimeaUpUsername = mysqli_real_escape_string($con, $_POST['cimeaUpUsername']);
	$cimeaUpPassword = mysqli_real_escape_string($con, $_POST['cimeaUpPassword']);
	$cimeaUpLink = mysqli_real_escape_string($con, $_POST['cimeaUpLink']);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimeaup_username='".$cimeaUpUsername."', italy_cimeaup_password='".$cimeaUpPassword."', italy_cimeaup_link='".$cimeaUpLink."', italy_cimea_step3='3', italy_cimea_applied_status='3' ";

	if (!empty($_FILES['cimeaUpScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeaUpScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeaUpScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$cimeaUpScreenShot = implode(',', $uploadedFiles);
			$run .= ", italy_cimeaup_screenshot='" . $cimeaUpScreenShot . "'";
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
if(isset($_POST['subCimeainfoHead'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$cimeainformNote = mysqli_real_escape_string($con, $_POST['cimeainformNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_info_note='".$cimeainformNote."', italy_cimea_applied_status='5' ";

	if (!empty($_FILES['cimeainformScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeainformScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeainformScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_cimea_info_screenshot='" . $filesString . "'";
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
if(isset($_POST['subCimeaChangeDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$changingNote = mysqli_real_escape_string($con, $_POST['changingNote']);
	
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_applied_status='6' WHERE italy_client_pro_id='".$updateProgramID."' ";
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

	$programItaly = "INSERT INTO `italy_clients_programs_checking".$_SESSION['dbNo']."` (`programs_id`, `type_apply`, `changing_status`,`changing_screenshot`, `changing_note`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', 'cimea', 'team', '".$changingScreenshot."', '".$changingNote."', '1', '1', '".$_SESSION['user_id']."' )";
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
if(isset($_POST['subCimeaApplied'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$cimeaappliedNote = mysqli_real_escape_string($con, $_POST['cimeaappliedNote']);
	$current_date =  date('Y-m-d');
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_applied_status='7', italy_cimea_applied_note='".$cimeaappliedNote."', italy_cimea_applied_date='".$current_date."' ";

	// Check and update Applied Screenshot
	if (!empty($_FILES['cimeaappliedScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeaappliedScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeaappliedScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$cimeaappliedScreenshot = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_cimea_applied_screenshot='" . $cimeaappliedScreenshot . "'";
		}
	}

	// Check and update detailsScreenshot
	if (!empty($_FILES['cimeadetailsScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeadetailsScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeadetailsScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$cimeadetailsScreenshot = implode(',', $uploadedFiles);
			$updateApplication .= ", italy_cimea_details_screenshot='" . $cimeadetailsScreenshot . "'";
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

// Update accepted application
if(isset($_POST['subAccepted'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_info_client_status='8', italy_cimea_applied_status='8' ";

	if (!empty($_FILES['cimeaacceptedScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeaacceptedScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeaacceptedScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_cimea_accepted_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Accepted!",
			"text" => "Application is Accepted."
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update rejected application
if(isset($_POST['subRejected'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_info_client_status='9', italy_cimea_applied_status='9' ";

	if (!empty($_FILES['cimearejectedScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimearejectedScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimearejectedScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_cimea_rejected_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Rejected!",
			"text" => "Application is Rejected."
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