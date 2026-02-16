<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Update inform to client 
if(isset($_POST['subCimeainfoClient'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$cimeaclientInformNote = mysqli_real_escape_string($con, $_POST['cimeaclientInformNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_info_note='".$cimeaclientInformNote."', italy_cimea_info_client_status='1' ";

	if (!empty($_FILES['cimeaclientInformScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeaclientInformScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeaclientInformScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_cimea_client_info_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Informed!",
			"text" => "Client to Check the Application sent Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Checking file status by client
if(isset($_POST['subChangeCimeaDetails'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$changingNote = mysqli_real_escape_string($con, $_POST['changingNote']);
	$tolcDate =  "";
	
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_info_client_status='2' WHERE italy_client_pro_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	$changingScreenshot='';
	if (!empty($_FILES['changingScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['changingScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['changingScreenshot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$changingScreenshot = implode(',', $uploadedFiles);
		}
	}

	$changingAudio='';
	if (!empty($_FILES['changingAudio']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['changingAudio']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['changingAudio']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$changingAudio = implode(',', $uploadedFiles);
		}
	}

	$programItaly = "INSERT INTO `italy_clients_programs_checking".$_SESSION['dbNo']."` (`programs_id`, `type_apply`, `changing_status`, `changing_screenshot`, `changing_audio`, `changing_note`, `close`, `status`, `entry_by`) VALUES ('".$updateProgramID."', 'cimea', 'head', '".$changingScreenshot."', '".$changingAudio."', '".$changingNote."', '1', '1', '".$_SESSION['user_id']."' )";
	$programItaly_ex = mysqli_query($con,$programItaly);
	
	if ($programItaly_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Changes Sent!",
			"text" => "Changes in Application are sent Successfully"
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
if(isset($_POST['subCimeaOk'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$cimeaokNote = mysqli_real_escape_string($con, $_POST['cimeaokNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_ok_note='".$cimeaokNote."', italy_cimea_info_client_status='3'  ";

	if (!empty($_FILES['cimeaokScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeaokScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeaokScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_cimea_ok_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Approved!",
			"text" => "Client Approved the Application Successfully"
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
if(isset($_POST['subCimeaGuidFee'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$cimeapayFeeNote = mysqli_real_escape_string($con, $_POST['cimeapayFeeNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_fee_note='".$cimeapayFeeNote."' ";

	if (!empty($_FILES['cimeainfoPayFee']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeainfoPayFee']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeainfoPayFee']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/'.$newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$filesString = implode(',', $uploadedFiles);
			$updateApplication .= ",italy_cimea_info_client_status='4', italy_cimea_info_pay_fee='".$filesString."'";
		}
	}

	if (!empty($_FILES['cimeafeePayClient']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeafeePayClient']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeafeePayClient']['tmp_name'][$key];
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
			$updateApplication .= ",italy_cimea_info_client_status='5', italy_cimea_fee_paid_client='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Fee Guides!",
			"text" => "Application Fee Guides Successfully"
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
if(isset($_POST['subCimeaProof'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$cimeaproofNote = mysqli_real_escape_string($con, $_POST['cimeaproofNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_proof_note='".$cimeaproofNote."', italy_cimea_info_client_status='6' ";

	if (!empty($_FILES['cimeaproofScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeaproofScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeaproofScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_cimea_proof_screenshot='" . $filesString . "'";
		}
	}
	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Proof Completed!",
			"text" => "Proof are save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}


// Update accepted application
if(isset($_POST['subCimeaAccepted'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_info_client_status='8', italy_cimea_applied_status='8' ";

	if (!empty($_FILES['cimeaacceptedScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimeaacceptedScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimeaacceptedScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_cimea_accepted_screenshot='" . $filesString . "'";
		}
	}
	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Accepted!",
			"text" => "Application is Accepted Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update rejected application
if(isset($_POST['subCimeaRejected'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_info_client_status='9', italy_cimea_applied_status='9' ";
	if (!empty($_FILES['cimearejectedScreenshot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['cimearejectedScreenshot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['cimearejectedScreenshot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_cimea_rejected_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Rejected!",
			"text" => "Application is Rejected."
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