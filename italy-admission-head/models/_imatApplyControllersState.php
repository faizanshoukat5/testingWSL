<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// update IMAT inform
if(isset($_POST['updimatInfo'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$imatInfoNote = mysqli_real_escape_string($con, $_POST['imatInfoNote']);

	if (!empty($_FILES['imatInfoFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['imatInfoFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['imatInfoFile']['tmp_name'][$key];
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

	$imatQuery = "INSERT INTO `italy_clients_imat".$_SESSION['dbNo']."` (`imat_client_id`, `imat_status`, `imat_screenshot`, `imat_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'Inform About IMAT Registration', '".$filesString."', '".$imatInfoNote."', '1', '1', '".$_SESSION['uname']."' )";
	$imatQuery_ex = mysqli_query($con,$imatQuery);
	if ($imatQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Inform About IMAT Registration!",
			"text" => "Inform About IMAT Registration is save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// update IMAT Registration
if(isset($_POST['updimatReg'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$imatRegStatus = mysqli_real_escape_string($con, $_POST['imatRegStatus']);
	$imatTestDate = mysqli_real_escape_string($con, $_POST['imatTestDate']);
	$imatTestUsername = mysqli_real_escape_string($con, $_POST['imatTestUsername']);
	$imatTestPassword = mysqli_real_escape_string($con, $_POST['imatTestPassword']);
	$imatRegNote = mysqli_real_escape_string($con, $_POST['imatRegNote']);

	if (!empty($_FILES['imatRegFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['imatRegFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['imatRegFile']['tmp_name'][$key];
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

	$imatQuery = "INSERT INTO `italy_clients_imat".$_SESSION['dbNo']."` (`imat_client_id`, `imat_status`, `imat_register_by`, `imat_test_date`, `imat_username`, `imat_password`, `imat_screenshot`, `imat_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'IMAT Registration', '".$imatRegStatus."', '".$imatTestDate."', '".$imatTestUsername."', '".$imatTestPassword."', '".$filesString."', '".$imatRegNote."', '1', '1', '".$_SESSION['uname']."' )";
	$imatQuery_ex = mysqli_query($con,$imatQuery);
	if ($imatQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "IMAT Registration!",
			"text" => "IMAT Registration is save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// update IMAT Registration
if(isset($_POST['updimatStatus'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$imatStatus = mysqli_real_escape_string($con, $_POST['imatStatus']);
	$imatStatusNote = mysqli_real_escape_string($con, $_POST['imatStatusNote']);

	if (!empty($_FILES['imatStatusFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['imatStatusFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['imatStatusFile']['tmp_name'][$key];
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

	$imatQuery = "INSERT INTO `italy_clients_imat".$_SESSION['dbNo']."` (`imat_client_id`, `imat_status`, `imat_screenshot`, `imat_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', '".$imatStatus."', '".$filesString."', '".$imatStatusNote."', '1', '1', '".$_SESSION['uname']."' )";
	$imatQuery_ex = mysqli_query($con,$imatQuery);
	if ($imatQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "IMAT Registration Status!",
			"text" => "IMAT Registration Status is save Successfully"
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