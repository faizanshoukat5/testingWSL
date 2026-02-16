<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');


// Update inform to client 
if(isset($_POST['subTolcinfoClient'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$clientTolcInfoNote = mysqli_real_escape_string($con, $_POST['clientTolcInfoNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_client_info_note='".$clientTolcInfoNote."', italy_tolc_info_status='1' ";

	if (!empty($_FILES['clientTolcinfoScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['clientTolcinfoScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['clientTolcinfoScreenShot']['tmp_name'][$key];
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
			$updateApplication .= ", italy_tolc_client_info_screenshot='" . $filesString . "'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Informed!",
			"text" => "Client to Check the Application are save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update date Tolc test application
if(isset($_POST['subTolcdate'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$testDateNote = mysqli_real_escape_string($con, $_POST['testDateNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_date_note='".$testDateNote."' ";

	if (!empty($_FILES['testDateScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['testDateScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['testDateScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$testDateScreenShot = implode(',', $uploadedFiles);
			$updateApplication .= ",italy_tolc_info_status='2', italy_tolc_date_screenshot='".$testDateScreenShot."'";
		}
	}
	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Saved!",
			"text" => "Test Date are save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update fee proof Tolc test application
if(isset($_POST['subTolcFee'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$feeProofNote = mysqli_real_escape_string($con, $_POST['feeProofNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_fee_proof_note='".$feeProofNote."' ";

	if (!empty($_FILES['feeProofScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['feeProofScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['feeProofScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$feeProofScreenShot = implode(',', $uploadedFiles);
			$updateApplication .= ",italy_tolc_info_status='3', italy_tolc_fee_proof_screenshot='".$feeProofScreenShot."'";
		}
	}
	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Saved!",
			"text" => "Test Fee Proof are Save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Update Practices Tolc test application
if(isset($_POST['subTolcPractice'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$practiceNote = mysqli_real_escape_string($con, $_POST['practiceNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_practic_note='".$practiceNote."' ";

	if (!empty($_FILES['practiceVideoScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['practiceVideoScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['practiceVideoScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$practiceVideoScreenShot = implode(',', $uploadedFiles);
			$updateApplication .= ",italy_tolc_info_status='4', italy_tolc_practic_video_screenshot='".$practiceVideoScreenShot."'";
		}
	}
	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Saved!",
			"text" => "Test Practices Video are Save Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// pass tolc test screen shot
if(isset($_POST['subTolcPass'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$passTolcNote = mysqli_real_escape_string($con, $_POST['passTolcNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_pass_note='".$passTolcNote."' ";

	if (!empty($_FILES['passTolcScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['passTolcScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['passTolcScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$passTolcScreenShot = implode(',', $uploadedFiles);
			$updateApplication .= ",italy_tolc_info_status='5', italy_tolc_pass_screenshot='".$passTolcScreenShot."'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Pass!",
			"text" => "Test Passed Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// Fails tolc test screen shot
if(isset($_POST['subTolcFail'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$failTolcNote = mysqli_real_escape_string($con, $_POST['failTolcNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_fail_note='".$failTolcNote."' ";

	if (!empty($_FILES['failTolcScreenShot']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['failTolcScreenShot']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['failTolcScreenShot']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$failTolcScreenShot = implode(',', $uploadedFiles);
			$updateApplication .= ",italy_tolc_info_status='6', italy_tolc_fail_screenshot='".$failTolcScreenShot."'";
		}
	}

	$updateApplication .= " WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Fail!",
			"text" => "Test Failed"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// tolc practice date
if(isset($_POST['subTolcPracticeDate'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$tolcPracticeDate = mysqli_real_escape_string($con, $_POST['tolcPracticeDate']);
	$tolcPracticeNote = mysqli_real_escape_string($con, $_POST['tolcPracticeNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_practice_date='".$tolcPracticeDate."', italy_tolc_practice_note='".$tolcPracticeNote."' WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Practice!",
			"text" => "Client Test Date Practice sent Successfully"
		]);
	}else{
		echo json_encode([
			"status" => "error",
			"title" => "Error",
			"text" => "Something went wrong"
		]);
	}
}

// tolc booked Date
if(isset($_POST['subTolcBookedDate'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$tolcBookedDate = mysqli_real_escape_string($con, $_POST['tolcBookedDate']);
	$tolcBookedNote = mysqli_real_escape_string($con, $_POST['tolcBookedNote']);
	
	$updateApplication = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_booked_date='".$tolcBookedDate."', italy_tolc_booked_note='".$tolcBookedNote."' WHERE italy_client_pro_id='".$updateProgramID."'";
	$updateApplication_ex = mysqli_query($con, $updateApplication);
	if ($updateApplication_ex) {
		echo json_encode([
			"status" => "success",
			"title" => "Booked!",
			"text" => "Client Test Date Booked Successfully"
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