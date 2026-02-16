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
		echo json_encode([
			"status" => "success",
			"title" => "Informed!",
			"text" => "Inform to Client to Pay Admission Dues Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
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

	$updAddmission = "INSERT INTO `italy_clients_admission_dues".$_SESSION['dbNo']."` (`italy_client_dues_id`, `italy_dues_status`, `italy_dues_payment_method`, `italy_dues_received`, `italy_dues_screenshot`, `italy_dues_remaining`, `italy_dues_date`, `italy_dues_note`, `close`, `status`, `entry_by`) VALUES ('".$upClientID."', '".$duesStatus."', '".$duesPaymentMethod."', '".$duesReceived."', '".$filesString."', '".$duesRemaining."', '".$duesDate."', '".$dueAdPaidNote."', '1', '1', '".$_SESSION['user_id']."')";
	$updAddmission_ex = mysqli_query($con,$updAddmission);

	if ($updAddmission_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Paid!",
			"text" => "Client Paid Admission Dues Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
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
// Self Received Acceptance query
if(isset($_POST['updSelfAccept'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$clientDegree = mysqli_real_escape_string($con, $_POST['clientDegree']);
	$selfUniName = mysqli_real_escape_string($con, $_POST['selfUniName']);
	$selfProName = mysqli_real_escape_string($con, $_POST['selfProName']);
	// $selfIntake = mysqli_real_escape_string($con, $_POST['selfIntake']);
	$selfPreStatus = mysqli_real_escape_string($con, $_POST['selfPreStatus']);
	if($selfPreStatus=='Yes'){
		$directPre=1;
	}else{
		$directPre=0;
	}
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
	
	$insert_query = "INSERT INTO `italy_clients_programs".$_SESSION['dbNo']."` (`italy_clients_id`, `italy_university_name`, `italy_program_name`, `italy_intake`, `italy_client_degree`, `italy_direct_pre`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$selfUniName."', '".$selfProName."', 'Self Acceptance', '".$clientDegree."', '".$directPre."', '1', '1', '".$_SESSION['user_id']."')";
	$insert_query_ex = mysqli_query($con,$insert_query);
	if ($insert_query_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Acceptance!",
			"text" => "Self Received Acceptance upload Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}
// Self Received Acceptance query
if(isset($_POST['updSelfAccept2'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$clientDegree = mysqli_real_escape_string($con, $_POST['clientDegree']);
	$selfUniName = mysqli_real_escape_string($con, $_POST['selfUniName']);
	$selfProName = mysqli_real_escape_string($con, $_POST['selfProName']);
	// $selfIntake = mysqli_real_escape_string($con, $_POST['selfIntake']);
	$selfPreStatus = mysqli_real_escape_string($con, $_POST['selfPreStatus']);
	if($selfPreStatus=='Yes'){
		$directPre=1;
	}else{
		$directPre=0;
	}
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
	$updAddmission = "UPDATE clients".$_SESSION['dbNo']." SET client_self_acceptance_file2='".$filesString."', client_self_acceptance_note2='".$selfNote."' WHERE client_id='".$updateID."'";
	$updAddmission_ex = mysqli_query($con, $updAddmission);
	
	$insert_query = "INSERT INTO `italy_clients_programs".$_SESSION['dbNo']."` (`italy_clients_id`, `italy_university_name`, `italy_program_name`, `italy_intake`, `italy_client_degree`, `italy_direct_pre`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$selfUniName."', '".$selfProName."', 'Self Acceptance2', '".$clientDegree."', '".$directPre."', '1', '1', '".$_SESSION['user_id']."')";
	$insert_query_ex = mysqli_query($con,$insert_query);
	

	if ($insert_query_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Acceptance!",
			"text" => "Self Received Acceptance upload Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
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

?>