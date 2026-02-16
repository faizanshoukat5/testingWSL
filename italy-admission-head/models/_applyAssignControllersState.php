<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Submit program in dbs
if (isset($_POST['subProgram'])) {
	$updateID = $_POST['updateID'];
	$changesProgram = $_POST['changesProgram'];
	if($changesProgram!='New'){
		$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_change_program_status='1' WHERE italy_client_pro_id='".$changesProgram."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}

	$appliedName = $_POST['appliedName'];
	if ($appliedName=='bachelor' || $appliedName=='phd') {
		$progStore = [];
		$programArray = $_POST['programName'];
		foreach ($programArray as $value) {
			$progStore[] = mysqli_real_escape_string($con, $value);
		}
		$programName = json_encode($progStore);
		$uniName = $_POST['uniName'];
		$intakeName = $_POST['intakeName'];
		$directApply = $_POST['uniDirectApply'];
		$directPre = $_POST['unidirectPre'];
		$dreamID = $_POST['unidreamID'];
		$programApproveNote = $_POST['programApproveNote'];

		$programApproveFile='';
		if (!empty($_FILES['programApproveFile']['name'][0])) {
			$uploadedFiles = [];
			foreach ($_FILES['programApproveFile']['name'] as $key => $fileName) {
				$tmpFilePath = $_FILES['programApproveFile']['tmp_name'][$key];
				if (!empty($tmpFilePath)) {
					$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
					$newFileName = date('d-m-Y') . '_' . date('H-i-s'). $cleanFileName;
					if (move_uploaded_file($tmpFilePath, '../../payagreements/'.$newFileName)) {
						$uploadedFiles[] = $newFileName;
					}
				}
			}
			if (!empty($uploadedFiles)) {
				$programApproveFile = implode(',', $uploadedFiles);
			}
		}
		$insert_query = "INSERT INTO `italy_clients_programs".$_SESSION['dbNo']."` (`italy_clients_id`, `italy_university_name`, `italy_program_name`, `italy_intake`, `italy_uni_approve_file`, `italy_uni_approve_note`, `italy_client_degree`, `italy_direct_pre`, `italy_dream_id`, `italy_direct_apply`, `italy_tolc_status`, `italy_cimea_status`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$uniName."', '".$programName."', '".$intakeName."', '".$programApproveFile."', '".$programApproveNote."', '".$appliedName."', '".$directPre."', '".$dreamID."', '".$directApply."', '0', '0', '1', '1', '".$_SESSION['user_id']."')";
		$insert_query_ex = mysqli_query($con,$insert_query);
		if ($insert_query_ex) {
			if($changesProgram=='New'){
				echo json_encode([
					"status" => "success",
					"title" => "Added!",
					"text" => "Your Program is Added Successfully"
				]);
			}else{
				echo json_encode([
					"status" => "success",
					"title" => "Changed!",
					"text" => "Your Program is Changed Successfully"
				]);
			}
		}else{
			echo json_encode([
				"status" => "error",
				"title" => "Error",
				"text" => "Something went wrong"
			]);
		}
	}
	if ($appliedName=='master') {
		$progStore = [];
		$programArray = $_POST['programNameMast'];
		foreach ($programArray as $value) {
			$progStore[] = mysqli_real_escape_string($con, $value);
		}
		$programName = json_encode($progStore);
		$uniName = $_POST['uniNameMast'];
		$intakeName = $_POST['intakeNameMast'];
		$directApply = $_POST['uniDirectApplyMast'];
		$directPre = $_POST['unidirectPreMast'];
		$dreamID = $_POST['unidreamIDMast'];
		$programApproveNote = $_POST['programApproveNoteMast'];

		$programApproveFile='';
		if (!empty($_FILES['MastprogramApproveFile']['name'][0])) {
			$uploadedFiles = [];
			foreach ($_FILES['MastprogramApproveFile']['name'] as $key => $fileName) {
				$tmpFilePath = $_FILES['MastprogramApproveFile']['tmp_name'][$key];
				if (!empty($tmpFilePath)) {
					$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
					$newFileName = date('d-m-Y') . '_' . date('H-i-s'). $cleanFileName;
					if (move_uploaded_file($tmpFilePath, '../../payagreements/'.$newFileName)) {
						$uploadedFiles[] = $newFileName;
					}
				}
			}
			if (!empty($uploadedFiles)) {
				$programApproveFile = implode(',', $uploadedFiles);
			}
		}

		$insert_query = "INSERT INTO `italy_clients_programs".$_SESSION['dbNo']."` (`italy_clients_id`, `italy_university_name`, `italy_program_name`, `italy_intake`, `italy_uni_approve_file`, `italy_uni_approve_note`, `italy_client_degree`, `italy_direct_pre`, `italy_dream_id`, `italy_direct_apply`, `italy_tolc_status`, `italy_cimea_status`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$uniName."', '".$programName."', '".$intakeName."', '".$programApproveFile."', '".$programApproveNote."', '".$appliedName."', '".$directPre."', '".$dreamID."', '".$directApply."', '0', '0', '1', '1', '".$_SESSION['user_id']."')";
		$insert_query_ex = mysqli_query($con,$insert_query);

		if ($insert_query_ex) {
			if($changesProgram=='New'){
				echo json_encode([
					"status" => "success",
					"title" => "Added!",
					"text" => "Your Program is Added Successfully"
				]);
			}else{
				echo json_encode([
					"status" => "success",
					"title" => "Changed!",
					"text" => "Your Program is Changed Successfully"
				]);
			}
		}else{
			echo json_encode([
				"status" => "error",
				"title" => "Error",
				"text" => "Something went wrong"
			]);
		}
	}
	if ($appliedName=='mbbs') {
		$uniNameMBBS = $_POST['uniNameMBBS'];
		$progStore = [];
		$programArray = $_POST['programNameMBBS'];
		foreach ($programArray as $value) {
			$progStore[] = mysqli_real_escape_string($con, $value);
		}
		$programNameMBBS = json_encode($progStore);
		$intakeNameMBBS = $_POST['intakeNameMBBS'];
		$directApplyMBBS = $_POST['uniDirApplyMbbs'];
		$directPreMBBS = $_POST['unidirPreMbbs'];
		$dreamIDMBBS = $_POST['unidreamIDMbbs'];
		$programMBBSApproveNote = $_POST['programMBBSApproveNote'];

		$programMBBSApproveFile = '';
		if (!empty($_FILES['programMBBSApproveFile']['name'][0])) {
			$uploadedFiles = [];
			foreach ($_FILES['programMBBSApproveFile']['name'] as $key => $fileName) {
				$tmpFilePath = $_FILES['programMBBSApproveFile']['tmp_name'][$key];
				if (!empty($tmpFilePath)) {
					$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
					$newFileName = date('d-m-Y') . '_' . date('H-i-s'). $cleanFileName;
					if (move_uploaded_file($tmpFilePath, '../../payagreements/'.$newFileName)) {
						$uploadedFiles[] = $newFileName;
					}
				}
			}
			if (!empty($uploadedFiles)) {
				$programMBBSApproveFile = implode(',', $uploadedFiles);
			}
		}

		$insert_query = "INSERT INTO `italy_clients_programs".$_SESSION['dbNo']."` (`italy_clients_id`, `italy_university_name`, `italy_program_name`, `italy_intake`, `italy_uni_approve_file`, `italy_uni_approve_note`, `italy_client_degree`, `italy_direct_pre`, `italy_dream_id`, `italy_direct_apply`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$uniNameMBBS."', '".$programNameMBBS."', '".$intakeNameMBBS."', '".$programMBBSApproveFile."', '".$programMBBSApproveNote."', '".$appliedName."', '".$directPreMBBS."', '".$dreamIDMBBS."', '".$directApplyMBBS."', '1', '1', '".$_SESSION['user_id']."')";
		$insert_query_ex = mysqli_query($con,$insert_query);

		if ($insert_query_ex) {
			if($changesProgram=='New'){
				echo json_encode([
					"status" => "success",
					"title" => "Added!",
					"text" => "Your Program is Added Successfully"
				]);
			}else{
				echo json_encode([
					"status" => "success",
					"title" => "Changed!",
					"text" => "Your Program is Changed Successfully"
				]);
			}
		}else{
			echo json_encode([
				"status" => "error",
				"title" => "Error",
				"text" => "Something went wrong"
			]);
		}
	}
	

}

// Updated program Note details
if(isset($_POST['updappNote'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$radioStep = mysqli_real_escape_string($con, $_POST['radioStep']);
	$appNoteNote = mysqli_real_escape_string($con, $_POST['appNoteNote']);
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_program_status='".$radioStep."' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);

	if ($radioStep=='1') {
		$noteName='Application Pending';
	}elseif($radioStep=='2'){
		$noteName='Application Resolves';
	}

	$appNoteScreenshot='';
	if (!empty($_FILES['appNoteScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['appNoteScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['appNoteScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$appNoteScreenshot = implode(',', $uploadedFiles);
		}
	}

	$appNoteAudio='';
	if (!empty($_FILES['appNoteAudio']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['appNoteAudio']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['appNoteAudio']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$appNoteAudio = implode(',', $uploadedFiles);
		}
	}

	$programNote = "INSERT INTO `italy_program_report_note".$_SESSION['dbNo']."` (`italy_program_id`, `italy_pro_report_name`, `italy_pro_report_screenshot`, `italy_pro_report_audio`, `italy_pro_report_note`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', '".$noteName."', '".$appNoteScreenshot."', '".$appNoteAudio."', '".$appNoteNote."', '1', '1', '".$_SESSION['uname']."' )";
	$programNote_ex = mysqli_query($con,$programNote);
	if ($programNote_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Noted!",
			"text" => "Your Note uploaded Successfully"
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
if(isset($_POST['updChangeProgram'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$changeProgramName = mysqli_real_escape_string($con, $_POST['changeProgramName']);
	$changeProgramNote = mysqli_real_escape_string($con, $_POST['changeProgramNote']);

	$changeProgramScreenshot='';
	if (!empty($_FILES['changeProgramScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['changeProgramScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['changeProgramScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$changeProgramScreenshot = implode(',', $uploadedFiles);
		}
	}

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_change_program_name='".$changeProgramName."', italy_change_program_note='".$changeProgramNote."', italy_change_program_screenshot='".$changeProgramScreenshot."' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Changed!",
			"text" => "Program Name is Changed"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Hold Application
if(isset($_POST['updatehold'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$holdStatus = mysqli_real_escape_string($con, $_POST['holdStatus']);
	$holdDate = mysqli_real_escape_string($con, $_POST['holdDate']);
	$holdNote = mysqli_real_escape_string($con, $_POST['holdNote']);

	if($holdStatus=='Deadline Hold'){
		$holdVal='1';
	}else{
		$holdVal='2';
	}

	$holdFiles='';
	if (!empty($_FILES['holdFiles']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['holdFiles']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['holdFiles']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$holdFiles = implode(',', $uploadedFiles);
		}
	}
	
	$programRefund = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_deadline_hold_status='".$holdVal."', italy_program_assign='0' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$programRefund_ex = mysqli_query($con, $programRefund);

	$programHold = "INSERT INTO `italy_client_deadline_hold".$_SESSION['dbNo']."` (`programs_hold_id`, `hold_status`, `hold_date`, `hold_files`, `hold_note`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', '".$holdStatus."', '".$holdDate."', '".$holdFiles."', '".$holdNote."', '1', '1', '".$_SESSION['uname']."' )";
	$programHold_ex = mysqli_query($con,$programHold);

	if ($programHold_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Hold!",
			"text" => "Application is Hold Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Updated program Send to pre Enrollment 
if(isset($_POST['sendPreEnroll'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$sendPreNote = mysqli_real_escape_string($con, $_POST['sendPreNote']);
	$current_date =  date('Y-m-d');
	$sendPreProof='';
	if (!empty($_FILES['sendPreProof']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['sendPreProof']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['sendPreProof']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$sendPreProof = implode(',', $uploadedFiles);
		}
	}

	$programRefund = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_send_to_pre_proof='".$sendPreProof."', italy_send_to_pre_note='".$sendPreNote."', italy_send_to_pre_date='".$current_date."', italy_direct_pre='1' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$programRefund_ex = mysqli_query($con, $programRefund);
	if ($programRefund_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Sent!",
			"text" => "Application is send to Pre Enrollment Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Sop Check approve or changes
if(isset($_POST['updSOPS'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$sopsFileStatus = mysqli_real_escape_string($con, $_POST['sopsFileStatus']);
	$sopDate = date('Y-m-d');
	$sopAnyNote = mysqli_real_escape_string($con, $_POST['sopAnyNote']);

	// One
	$sopFile='';
	if (!empty($_FILES['sopFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['sopFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['sopFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$sopFile = implode(',', $uploadedFiles);
		}
	}
	if ($sopsFileStatus=='Changing Required In SOP') {
		$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_sops_status='3' WHERE italy_client_pro_id='".$updateID."' ";
		$run_ex = mysqli_query($con, $run);
	}elseif ($sopsFileStatus=='SOP Approved') {
		$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_sops_status='4' WHERE italy_client_pro_id='".$updateID."' ";
		$run_ex = mysqli_query($con, $run);
	}

	$addSops = "INSERT INTO `italy_program_sops".$_SESSION['dbNo']."` (`italy_sops_program_id`, `italy_sops_file_status`, `italy_sops_date`, `italy_sops_anynote`, `italy_sops_file`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$sopsFileStatus."', '".$sopDate."', '".$sopAnyNote."', '".$sopFile."', '1', '1', '".$_SESSION['user_id']."' )";
	$addSops_ex = mysqli_query($con,$addSops);
	
	if ($addSops_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Data is Uploaded Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Delete University from Assign Program
if(isset($_POST['delUniBtn'])) {
	$updateID = $_POST['updateID'];
	$delUniFile='';
	if (!empty($_FILES['delUniFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['delUniFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['delUniFile']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$delUniFile = implode(',', $uploadedFiles);
		}
	}

	$delUniNote = mysqli_real_escape_string($con, $_POST['delUniNote']);

	$delUniPro = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_close_file='".$delUniFile."', italy_close_note='".$delUniNote."', close='0' WHERE italy_client_pro_id ='".$updateID."'";
	$delUniPro_ex = mysqli_query($con, $delUniPro);
	if ($delUniPro_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Deleted!",
			"text" => "University is Deleted Successfully"
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