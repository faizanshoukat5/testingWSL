<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Update Client Info to Client Intro
if(isset($_POST['subitalyInfoIntro'])) {
	$updateID = $_POST['updateID'];
	$italyInfoIntroNote = mysqli_real_escape_string($con, $_POST['italyInfoIntroNote']);

	$italyInfoIntroScreenShot='';
	if (!empty($_FILES['italyInfoIntroScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['italyInfoIntroScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['italyInfoIntroScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$italyInfoIntroScreenShot = implode(',', $uploadedFiles);
		}
	}

	$updCheck = "UPDATE clients".$_SESSION['dbNo']." SET country_checklist_intro_file='".$italyInfoIntroScreenShot."', country_checklist_intro_note='".$italyInfoIntroNote."' WHERE client_id='".$updateID."'";
	$updCheck_ex = mysqli_query($con, $updCheck);

	if ($updCheck_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Info to Client Updated Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update Client Info to Client Checklist
if(isset($_POST['subitalyInfoChecklist'])) {
	$updateID = $_POST['updateID'];
	$italyInfoChecklistNote = mysqli_real_escape_string($con, $_POST['italyInfoChecklistNote']);

	$italyInfoChecklistScreenShot='';
	if (!empty($_FILES['italyInfoChecklistScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['italyInfoChecklistScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['italyInfoChecklistScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$italyInfoChecklistScreenShot = implode(',', $uploadedFiles);
		}
	}

	$updCheck = "UPDATE clients".$_SESSION['dbNo']." SET country_checklist_info_file='".$italyInfoChecklistScreenShot."', country_checklist_info_note='".$italyInfoChecklistNote."' WHERE client_id='".$updateID."'";
	$updCheck_ex = mysqli_query($con, $updCheck);

	if ($updCheck_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "Info to Client Updated Successfully"
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