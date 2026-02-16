<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Due After Visa inform to client 
if(isset($_POST['dueVisaInfo'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$dueAdInfoNote = mysqli_real_escape_string($con, $_POST['dueAdInfoNote']);
	$current_date =  date('Y-m-d');

	if (!empty($_FILES['dueAdInfoFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['dueAdInfoFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['dueAdInfoFile']['tmp_name'][$key];
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
	$updAddmission = "UPDATE clients".$_SESSION['dbNo']." SET due_after_visa_info_file='".$filesString."', due_after_visa_info_note='".$dueAdInfoNote."', due_after_visa_info_date='".$current_date."' WHERE client_id='".$upClientID."'";
	$updAddmission_ex = mysqli_query($con, $updAddmission);
	if ($updAddmission_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Informed!",
			"text" => "Inform to Client to Pay Visa Dues Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}
// Visa Due After Acceptance Received By client 
if(isset($_POST['dueVisaPaid'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$duesReceived = mysqli_real_escape_string($con, $_POST['duesReceived']);
	$duesPaymentMethod = mysqli_real_escape_string($con, $_POST['duesPaymentMethod']);
	$dueAdPaidNote = mysqli_real_escape_string($con, $_POST['dueAdPaidNote']);
	$current_date =  date('Y-m-d');

	if (!empty($_FILES['dueAdPaidFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['dueAdPaidFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['dueAdPaidFile']['tmp_name'][$key];
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
	$updAddmission = "UPDATE clients".$_SESSION['dbNo']." SET due_after_visa_received='".$duesReceived."', due_after_visa_pay_method='".$duesPaymentMethod."', due_after_visa_paid_file='".$filesString."', due_after_visa_paid_note='".$dueAdPaidNote."', due_after_visa_paid_date='".$current_date."' WHERE client_id='".$upClientID."'";
	$updAddmission_ex = mysqli_query($con, $updAddmission);
	if ($updAddmission_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Paid!",
			"text" => "Client Paid Visa Dues Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}


if(isset($_POST['updafterVisa'])) {
	$upClientID = mysqli_real_escape_string($con, $_POST['upClientID']);
	$afterVisaNote = mysqli_real_escape_string($con, $_POST['afterVisaNote']);

	if (!empty($_FILES['afterVisaFile']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['afterVisaFile']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['afterVisaFile']['tmp_name'][$key];
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

	$visaQuery = "INSERT INTO `italy_clients_visa_after_process".$_SESSION['dbNo']."` (`after_visa_client_id`, `after_visa_status`, `after_visa_screenshot`, `after_visa_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', 'After Visa Steps', '".$filesString."', '".$afterVisaNote."', '1', '1', '".$_SESSION['uname']."' )";
	$visaQuery_ex = mysqli_query($con,$visaQuery);
	if ($visaQuery_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Uploaded!",
			"text" => "After Visa Steps uploaded Successfully"
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