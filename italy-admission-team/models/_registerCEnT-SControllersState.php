<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if(isset($_POST['subTolcAccDetails'])) {
	$updateClientID = mysqli_real_escape_string($con, $_POST['updateClientID']);
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$accountUsername = mysqli_real_escape_string($con, $_POST['accountUsername']);
	$accountPassword = mysqli_real_escape_string($con, $_POST['accountPassword']);
	$accountLink = mysqli_real_escape_string($con, $_POST['accountLink']);

	$firstrun = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_account_username='".$accountUsername."', italy_tolc_account_password='".$accountPassword."', italy_tolc_account_link='".$accountLink."', italy_tolc_step2='3' WHERE italy_clients_id='".$updateClientID."' ";
	$firstrun_ex = mysqli_query($con, $firstrun);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_account_username='".$accountUsername."', italy_tolc_account_password='".$accountPassword."', italy_tolc_account_link='".$accountLink."', italy_tolc_step2='3', italy_tolc_applied_status='2' ";

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
			$run .= ", italy_tolc_account_screenshot='" . $filesString . "'";
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
if(isset($_POST['subUpTolcDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$updateClientID = mysqli_real_escape_string($con, $_POST['updateClientID']);
	$accountUpUsername = mysqli_real_escape_string($con, $_POST['accountUpUsername']);
	$accountUpPassword = mysqli_real_escape_string($con, $_POST['accountUpPassword']);
	$accountUpLink = mysqli_real_escape_string($con, $_POST['accountUpLink']);

	$firstrun = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_accountup_username='".$accountUpUsername."', italy_tolc_accountup_password='".$accountUpPassword."', italy_tolc_accountup_link='".$accountUpLink."', italy_tolc_step3='3' WHERE italy_clients_id='".$updateClientID."' ";
	$firstrun_ex = mysqli_query($con, $firstrun);

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_accountup_username='".$accountUpUsername."', italy_tolc_accountup_password='".$accountUpPassword."', italy_tolc_accountup_link='".$accountUpLink."', italy_tolc_step3='3', italy_tolc_applied_status='3' ";

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
			$run .= ", italy_tolc_accountup_screenshot='" . $accountUpScreenShot . "'";
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

?>