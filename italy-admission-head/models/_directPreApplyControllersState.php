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
			"text" => "Apostille Document upload Successfully"
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

// Update applied application
if(isset($_POST['subpreProof'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$preproofNote = mysqli_real_escape_string($con, $_POST['preproofNote']);
	$current_date =  date('Y-m-d');

	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_proof_note='".$preproofNote."', italy_pre_info_client_status='1', italy_pre_applied_date='".$current_date."' ";

	if (!empty($_FILES['preproofScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['preproofScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['preproofScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_pre_proof_screenshot='".$filesString."' ";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Proof Completed!",
			"text" => "Proof is save Successfully"
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
			"text" => "Program No 1 is Updated."
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
if(isset($_POST['submitSummary'])) {
	$updateProgramID = $_POST['updateProgramID'];
	$summaryStatus = $_POST['summaryStatus'];
	$summaryDate = $_POST['summaryDate'];
	$summaryNote = mysqli_real_escape_string($con, $_POST['summaryNote']);
	$current_date = date('Y-m-d');
	if ($summaryStatus=='Received') {
		$val2 = 10;
	}else{
		$val2 = 11;
	}

	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_info_client_status='".$val2."', italy_pre_applied_status='".$val2."', italy_pre_summary_status='".$summaryStatus."', italy_pre_summary_note='".$summaryNote."', italy_pre_summary_date='".$summaryDate."' ";

	if (!empty($_FILES['summaryScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['summaryScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['summaryScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_pre_summary_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Summary!",
			"text" => "Summary is Updated."
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