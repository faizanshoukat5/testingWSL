<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');
// Admission Due After Acceptance inform to client 
if(isset($_POST['dueAdInfo'])) {
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
	$updAddmission = "UPDATE clients".$_SESSION['dbNo']." SET due_after_ad_info_file='".$filesString."', due_after_ad_info_note='".$dueAdInfoNote."', due_after_ad_info_date='".$current_date."' WHERE client_id='".$upClientID."'";
	$updAddmission_ex = mysqli_query($con, $updAddmission);
	if ($updAddmission_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

if(isset($_POST['dueAdPaid'])) {
	$upClientID = $_POST['upClientID'];
	$duesStatus = mysqli_real_escape_string($con, $_POST['duesStatus']);
	$duesPaymentMethod = mysqli_real_escape_string($con, $_POST['duesPaymentMethod']);
	$duesReceived = mysqli_real_escape_string($con, $_POST['duesReceived']);
	$duesRemaining = mysqli_real_escape_string($con, $_POST['duesRemaining']);
	$duesDate = mysqli_real_escape_string($con, $_POST['duesDate']);
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
	if($duesStatus=='Client Pays the Full Payment'){
		$dueMeth=1;
	}
	elseif($duesStatus=='Client Pays Half Payment'){
		$dueMeth=2;
	}
	elseif($duesStatus=='Client Pays Remaining Payment'){
		$dueMeth=3;
	}
	$updAdd = "UPDATE clients".$_SESSION['dbNo']." SET due_after_ad_status='".$dueMeth."' WHERE client_id='".$upClientID."'";
	$updAdd_ex = mysqli_query($con, $updAdd);

	$updAddmission = "INSERT INTO austria_clients_admission_dues".$_SESSION['dbNo']." (aus_client_dues_id, aus_dues_status, aus_dues_payment_method, aus_dues_received, aus_dues_screenshot, aus_dues_remaining, aus_dues_date, aus_dues_note, close, status, entry_by) VALUES ('".$upClientID."', '".$duesStatus."', '".$duesPaymentMethod."', '".$duesReceived."', '".$filesString."', '".$duesRemaining."', '".$duesDate."', '".$dueAdPaidNote."', '1', '1', '".$_SESSION['user_id']."')";
	$updAddmission_ex = mysqli_query($con,$updAddmission);

	if ($updAddmission_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

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
		echo "success";
	}else{
		echo "error";
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
		echo "success";
	}else{
		echo "error";
	}
}

// Self Received Acceptance query
if(isset($_POST['updSelfAccept'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$clientDegree = mysqli_real_escape_string($con, $_POST['clientDegree']);
	$selfUniName = mysqli_real_escape_string($con, $_POST['selfUniName']);
	$selfProName = mysqli_real_escape_string($con, $_POST['selfProName']);
	// $selfIntake = mysqli_real_escape_string($con, $_POST['selfIntake'])

	$selfNote = mysqli_real_escape_string($con, $_POST['selfNote']);

	if (!empty($_FILES['selfFiles']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['selfFiles']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['selfFiles']['tmp_name'][$key];
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
	$updAddmission = "UPDATE clients".$_SESSION['dbNo']." SET client_self_acceptance_file='".$filesString."', client_self_acceptance_note='".$selfNote."' WHERE client_id='".$updateID."'";
	$updAddmission_ex = mysqli_query($con, $updAddmission);

	$insert_query = "INSERT INTO austria_clients_programs".$_SESSION['dbNo']." (`aus_clients_id`, `aus_university_name`, `aus_program_name`, `aus_intake`, `aus_client_degree`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$selfUniName."', '".$selfProName."', 'Self Acceptance', '".$clientDegree."', '1', '1', '".$_SESSION['user_id']."')";
	$insert_query_ex = mysqli_query($con,$insert_query);

	if ($insert_query_ex) {
		echo "success";
	}else{
		echo "error";
	}
}

?>