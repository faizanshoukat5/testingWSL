<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');
// Upload SOPs
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
		$run = "UPDATE austria_clients_programs ".$_SESSION['dbNo']."SET aus_sops_status='3' WHERE aus_client_pro_id='".$updateID."' ";
		$run_ex = mysqli_query($con, $run);
	}elseif ($sopsFileStatus=='SOP Approved') {
		$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_sops_status='4' WHERE aus_client_pro_id='".$updateID."' ";
		$run_ex = mysqli_query($con, $run);
	}

	$addSops = "INSERT INTO austria_program_sops".$_SESSION['dbNo']." (`aus_sops_program_id`, `aus_sops_file_status`, `aus_sops_date`, `aus_sops_anynote`, `aus_sops_file`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$sopsFileStatus."', '".$sopDate."', '".$sopAnyNote."', '".$sopFile."', '1', '1', '".$_SESSION['user_id']."' )";
	$addSops_ex = mysqli_query($con,$addSops);
	
	if ($addSops_ex) {
		echo "success";
	}else{
		echo "error";
	}

}
// Delete University
if(isset($_POST['delUniBtn'])) {
	$updateID = $_POST['updateID'];
	// One
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

	$delUniPro = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_close_file='".$delUniFile."', aus_close_note='".$delUniNote."', close='0' WHERE aus_client_pro_id ='".$updateID."'";
	$delUniPro_ex = mysqli_query($con, $delUniPro);
	if ($delUniPro_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

// Updated program Note details
if(isset($_POST['updappNote'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$radioStep = mysqli_real_escape_string($con, $_POST['radioStep']);
	$appNoteNote = mysqli_real_escape_string($con, $_POST['appNoteNote']);
	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_program_status='".$radioStep."' WHERE aus_client_pro_id='".$updateProgramID."' ";
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

	$programNote = "INSERT INTO austria_program_report_note".$_SESSION['dbNo']." (`aus_program_id`, `aus_pro_report_name`, `aus_pro_report_screenshot`, `aus_pro_report_audio`, `aus_pro_report_note`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', '".$noteName."', '".$appNoteScreenshot."', '".$appNoteAudio."', '".$appNoteNote."', '1', '1', '".$_SESSION['uname']."' )";
	$programNote_ex = mysqli_query($con,$programNote);
	if ($programNote_ex) {
		echo "success";
	}else{
		echo "error";
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

	$run = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_change_program_name='".$changeProgramName."', aus_change_program_note='".$changeProgramNote."', aus_change_program_screenshot='".$changeProgramScreenshot."' WHERE aus_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo "success";
	}else{
		echo "error";
	}
}
// Hold application
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
	
	$programRefund = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_deadline_hold_status='".$holdVal."', aus_program_assign='0' WHERE aus_client_pro_id='".$updateProgramID."' ";
	$programRefund_ex = mysqli_query($con, $programRefund);

	$programHold = "INSERT INTO austria_client_deadline_hold".$_SESSION['dbNo']." (`programs_hold_id`, `hold_status`, `hold_date`, `hold_files`, `hold_note`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', '".$holdStatus."', '".$holdDate."', '".$holdFiles."', '".$holdNote."', '1', '1', '".$_SESSION['uname']."' )";
	$programHold_ex = mysqli_query($con,$programHold);

	if ($programHold_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

?>