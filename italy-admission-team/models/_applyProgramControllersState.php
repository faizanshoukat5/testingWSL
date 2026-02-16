<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Updated program note details
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

if(isset($_POST['updSOPS'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	// $sopsFileStatus = mysqli_real_escape_string($con, $_POST['sopsFileStatus']);
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

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_sops_status='4' WHERE italy_client_pro_id='".$updateID."' ";
	$run_ex = mysqli_query($con, $run);

	$addSops = "INSERT INTO `italy_program_sops".$_SESSION['dbNo']."` (`italy_sops_program_id`, `italy_sops_file_status`, `italy_sops_date`, `italy_sops_anynote`, `italy_sops_file`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', 'SOP Approved', '".$sopDate."', '".$sopAnyNote."', '".$sopFile."', '1', '1', '".$_SESSION['user_id']."' )";
	$addSops_ex = mysqli_query($con,$addSops);
	
	if ($addSops_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Your SOP is Uploaded Successfully"
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