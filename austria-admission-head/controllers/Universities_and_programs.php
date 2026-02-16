<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

if(isset($_POST['subAddUni'])) {
	$uniName = $_POST['uniName'] ?? '';
	$uniDegree = $_POST['uniDegree'] ?? '';
	$uniStatus = $_POST['uniStatus'] ?? '';
	$uniDirectApply = $_POST['uniDirectApply'] ?? '';
	$uniCourierApply = $_POST['uniCourierApply'] ?? '';
	$uniRegisterlink = $_POST['uniRegisterlink'] ?? '';
	$uniApplylink = $_POST['uniApplylink'] ?? '';
	$uniDeadline = $_POST['uniDeadline'] ?? '';
	$uniReqNote = $_POST['uniReqNote'] ?? '';
	$programSelect = $_POST['programSelect'] ?? '';
	$programApply = $_POST['programApply'] ?? '';

	$table = 'austria_add_universities' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (aus_uni_name, aus_uni_degree, aus_uni_status, aus_uni_direct_apply, aus_uni_courier_apply, aus_uni_register_link, aus_uni_apply_link, aus_uni_deadline_link, aus_uni_req_note, aus_uni_program_select, aus_uni_program_apply, close, status, entry_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = (int)($_SESSION['user_id'] ?? 0);
		mysqli_stmt_bind_param($stmt, 'sssssssssssi', $uniName, $uniDegree, $uniStatus, $uniDirectApply, $uniCourierApply, $uniRegisterlink, $uniApplylink, $uniDeadline, $uniReqNote, $programSelect, $programApply, $entryBy);
		$insert_query_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$insert_query_ex = false;
	}

	if ($insert_query_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Added!', text: 'New University Added.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
	else{
		echo "<div class='alert alert-secondary'><strong>There is an error in the query2!</strong></div>";
	}
}

// Update query2
if(isset($_POST['updAddUni'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$uniName = $_POST['uniName'] ?? '';
	$uniDegree = $_POST['uniDegree'] ?? '';
	$uniStatus = $_POST['uniStatus'] ?? '';
	$uniDirectApply = $_POST['uniDirectApply'] ?? '';
	$uniCourierApply = $_POST['uniCourierApply'] ?? '';
	$uniRegisterlink = $_POST['uniRegisterlink'] ?? '';
	$uniApplylink = $_POST['uniApplylink'] ?? '';
	$uniDeadline = $_POST['uniDeadline'] ?? '';
	$uniReqNote = $_POST['uniReqNote'] ?? '';
	$programSelect = $_POST['programSelect'] ?? '';
	$programApply = $_POST['programApply'] ?? '';

	$table = 'austria_add_universities' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET aus_uni_name = ?, aus_uni_degree = ?, aus_uni_status = ?, aus_uni_direct_apply = ?, aus_uni_courier_apply = ?, aus_uni_apply_link = ?, aus_uni_register_link = ?, aus_uni_deadline_link = ?, aus_uni_req_note = ?, aus_uni_program_select = ?, aus_uni_program_apply = ? WHERE aus_add_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'sssssssssssi', $uniName, $uniDegree, $uniStatus, $uniDirectApply, $uniCourierApply, $uniApplylink, $uniRegisterlink, $uniDeadline, $uniReqNote, $programSelect, $programApply, $updateID);
		$insert_query_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$insert_query_ex = false;
	}

	if ($insert_query_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Updated!', text: 'New University Updated.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
	else{
		echo "<div class='alert alert-secondary'><strong>There is an error in the query2!</strong></div>";
	}
}

if(isset($_POST['updDelUni'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$uniDelNote = $_POST['uniDelNote'] ?? '';

	$table = 'austria_add_universities' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET aus_uni_del_note = ?, close = '0' WHERE aus_add_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'si', $uniDelNote, $updateID);
		$insert_query_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$insert_query_ex = false;
	}

	if ($insert_query_ex) {
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Deleted!', text: 'University Deleted Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
	else{
		echo "<div class='alert alert-secondary'><strong>There is an error in the query2!</strong></div>";
	}
	}

?>

<?php 

if(isset($_POST['subAddProgram'])) {
	$uniName = $_POST['uniName'] ?? '';
	$uniDegree = $_POST['uniDegree'] ?? '';
	$programNote = $_POST['programNote'] ?? '';

	$table = 'austria_add_programs' . $_SESSION['dbNo'];
	$sql = "INSERT INTO `" . $table . "` (aus_ap_uni_name, aus_ap_degree, aus_ap_note, aus_active_status, close, status, entry_by) VALUES (?, ?, ?, '1', '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = (int)($_SESSION['user_id'] ?? 0);
		mysqli_stmt_bind_param($stmt, 'sssi', $uniName, $uniDegree, $programNote, $entryBy);
		$insertPro_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$insertPro_ex = false;
	}

	if ($insertPro_ex) {
		$lastID = mysqli_insert_id($con);
		$programArray = isset($_POST['clientPreviousDegree']) ? array_values($_POST['clientPreviousDegree']) : [];

		// DEBUG: dump POST for diagnosis (temporary)
		$__dbg_path = __DIR__ . '/../../tools/debug_posts.json';
		@mkdir(dirname($__dbg_path), 0777, true);
		file_put_contents($__dbg_path, json_encode(['ts'=>time(), 'type'=>'updAddProgram', 'post'=>$_POST], JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);

		// DEBUG: dump POST for diagnosis (temporary)
		$__dbg_path = __DIR__ . '/../../tools/debug_posts.json';
		@mkdir(dirname($__dbg_path), 0777, true);
		file_put_contents($__dbg_path, json_encode(['ts'=>time(), 'type'=>'subAddProgram', 'post'=>$_POST], JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);

		// prepare detail insert once
		$detailTable = 'austria_add_programs_details' . $_SESSION['dbNo'];
		$placeholders = implode(',', array_fill(0, 35, '?'));
		$detailSql = "INSERT INTO `" . $detailTable . "` (aus_add_pro_id, aus_ad_uni_name, aus_ad_degree, aus_ad_program_name, aus_ad_cgpa, aus_ad_instruction, aus_ad_application_fee, aus_ad_tuition_fee, aus_ad_english_pro, aus_ad_ielts_pte, aus_ad_sop_required, aus_ad_sop_note, aus_ad_degree_required, aus_ad_recommendation, aus_ad_normal_cv, aus_ad_europass_cv, aus_ad_gmat_gre_test, aus_ad_entry_test, aus_ad_test_interview, aus_ad_leg_document, aus_ad_previous_relevant, aus_ad_application_process, aus_ad_intake, aus_ad_round, aus_ad_current_round, aus_ad_1st_opening_date, aus_ad_1st_actual_date, aus_ad_2nd_opening_date, aus_ad_2nd_actual_date, aus_ad_next_open_date, aus_ad_degree_acceptable, aus_ad_client_pre_degree, aus_ad_note_head, aus_ad_admission_valid, aus_ad_status, close, status, entry_by) VALUES (" . $placeholders . ")";
		$detailStmt = mysqli_prepare($con, $detailSql);

		foreach ($_POST['programName'] as $i => $programName) {
			$programName = $programName ?? '';
			$proCGPAPer = $_POST['proCGPAPer'][$i] ?? '';
			$prolanguageInstruction = $_POST['prolanguageInstruction'][$i] ?? '';
			$proAppFee = $_POST['proAppFee'][$i] ?? '';
			$proTuitionFee = $_POST['proTuitionFee'][$i] ?? '';
			$proEngProfAccept = $_POST['proEngProfAccept'][$i] ?? '';
			$proIELTSPTE = $_POST['proIELTSPTE'][$i] ?? '';
			$proSOPRequired = $_POST['proSOPRequired'][$i] ?? '';
			$proSOPNote = $_POST['proSOPNote'][$i] ?? '';
			$proDegreeRequired = $_POST['proDegreeRequired'][$i] ?? '';
			$proRecommendation = $_POST['proRecommendation'][$i] ?? '';
			$proNormalCV = $_POST['proNormalCV'][$i] ?? '';
			$proEuropassCV = $_POST['proEuropassCV'][$i] ?? '';
			$progmatGreTest = $_POST['progmatGreTest'][$i] ?? '';
			$proentryTest = $_POST['proentryTest'][$i] ?? '';
			$protextInterview = $_POST['protextInterview'][$i] ?? '';
			$prolegDocument = $_POST['prolegDocument'][$i] ?? '';
			$propreRelevantDegree = $_POST['propreRelevantDegree'][$i] ?? '';
			$applicationProcess = $_POST['applicationProcess'][$i] ?? '';
			$proIntake = $_POST['proIntake'][$i] ?? '';
			$proRound = $_POST['proRound'][$i] ?? '';
			$proCurrentRound = $_POST['proCurrentRound'][$i] ?? '';
			$openingDate = $_POST['openingDate'][$i] ?? '';
			$actualDeadline = $_POST['actualDeadline'][$i] ?? '';
			$nextOpenDate = $_POST['nextOpenDate'][$i] ?? '';

			if($proCurrentRound=='1'){
				$opening1stCallDate = $openingDate;
				$actual1stCallDeadline = $actualDeadline;
				$opening2ndCallDate = '0000-00-00';
				$actual2ndCallDeadline = '0000-00-00';
			} elseif($proCurrentRound=='2'){
				$opening1stCallDate = '0000-00-00';
				$actual1stCallDeadline = '0000-00-00';
				$opening2ndCallDate = $openingDate;
				$actual2ndCallDeadline = $actualDeadline;
			}
			$degreeAcceptable = $_POST['degreeAcceptable'][$i] ?? '';
			$programArrayValues = isset($programArray[$i]) ? $programArray[$i] : [];
			$progStore = [];
			foreach ($programArrayValues as $value) {
				$progStore[] = $value;
			}
			$clientPreDegJSON = json_encode($progStore);
			$proNoteHead = $_POST['proNoteHead'][$i] ?? '';
			$admissionValid = $_POST['admissionValid'][$i] ?? ''; 

			if ($detailStmt) {
				$entryByName = $_SESSION['uname'] ?? '';
				mysqli_stmt_bind_param($detailStmt, 'isssssssssssssssssssssssssssssss', $lastID, $uniName, $uniDegree, $programName, $proCGPAPer, $prolanguageInstruction, $proAppFee, $proTuitionFee, $proEngProfAccept, $proIELTSPTE, $proSOPRequired, $proSOPNote, $proDegreeRequired, $proRecommendation, $proNormalCV, $proEuropassCV, $progmatGreTest, $proentryTest, $protextInterview, $prolegDocument, $propreRelevantDegree, $applicationProcess, $proIntake, $proRound, $proCurrentRound, $opening1stCallDate, $actual1stCallDeadline, $opening2ndCallDate, $actual2ndCallDeadline, $nextOpenDate, $degreeAcceptable, $clientPreDegJSON, $proNoteHead, $admissionValid, $entryByName);
				$addProDetail_ex = mysqli_stmt_execute($detailStmt);
			} else {
				$addProDetail_ex = false;
			}
		}
		if ($detailStmt) mysqli_stmt_close($detailStmt);
	}
	if($insertPro_ex){
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Added!', text: 'Programs Added Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
	else{
		echo "<div class='alert alert-secondary'><strong>There is an error in the query2!</strong></div>";
	}
}

// Update query 

if(isset($_POST['updAddProgram'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$uniName = $_POST['uniName'] ?? '';
	$uniDegree = $_POST['uniDegree'] ?? '';
	$programNote = $_POST['programNote'] ?? '';
    $current_date =  date('Y-m-d');

	$table = 'austria_add_programs' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET aus_ap_uni_name = ?, aus_ap_degree = ?, aus_ap_note = ?, aus_active_date = ? WHERE aus_ap_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'ssssi', $uniName, $uniDegree, $programNote, $current_date, $updateID);
		$insertPro_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$insertPro_ex = false;
	}

	if ($insertPro_ex) {

		$delTable = 'austria_add_programs_details' . $_SESSION['dbNo'];
		$delSql = "DELETE FROM `" . $delTable . "` WHERE aus_ad_status = '1' AND aus_add_pro_id = ?";
		$delStmt = mysqli_prepare($con, $delSql);
		if ($delStmt) {
			mysqli_stmt_bind_param($delStmt, 'i', $updateID);
			$updSaleDel_ex = mysqli_stmt_execute($delStmt);
			mysqli_stmt_close($delStmt);
		} else {
			$updSaleDel_ex = false;
		}

		$programArray = isset($_POST['clientPreviousDegree']) ? array_values($_POST['clientPreviousDegree']) : [];

		// prepare detail insert once
		$detailTable = 'austria_add_programs_details' . $_SESSION['dbNo'];
		$placeholders = implode(',', array_fill(0, 35, '?'));
		$detailSql = "INSERT INTO `" . $detailTable . "` (aus_add_pro_id, aus_ad_uni_name, aus_ad_degree, aus_ad_program_name, aus_ad_cgpa, aus_ad_instruction, aus_ad_application_fee, aus_ad_tuition_fee, aus_ad_english_pro, aus_ad_ielts_pte, aus_ad_sop_required, aus_ad_sop_note, aus_ad_degree_required, aus_ad_recommendation, aus_ad_normal_cv, aus_ad_europass_cv, aus_ad_gmat_gre_test, aus_ad_entry_test, aus_ad_test_interview, aus_ad_leg_document, aus_ad_previous_relevant, aus_ad_application_process, aus_ad_intake, aus_ad_round, aus_ad_current_round, aus_ad_1st_opening_date, aus_ad_1st_actual_date, aus_ad_2nd_opening_date, aus_ad_2nd_actual_date, aus_ad_next_open_date, aus_ad_degree_acceptable, aus_ad_client_pre_degree, aus_ad_note_head, aus_ad_admission_valid, aus_ad_status, close, status, entry_by) VALUES (" . $placeholders . ")";
		$detailStmt = mysqli_prepare($con, $detailSql);

		foreach ($_POST['programName'] as $i => $programName) {
			$programName = $programName ?? '';
			$proCGPAPer = $_POST['proCGPAPer'][$i] ?? '';
			$prolanguageInstruction = $_POST['prolanguageInstruction'][$i] ?? '';
			$proAppFee = $_POST['proAppFee'][$i] ?? '';
			$proTuitionFee = $_POST['proTuitionFee'][$i] ?? '';
			$proEngProfAccept = $_POST['proEngProfAccept'][$i] ?? '';
			$proIELTSPTE = $_POST['proIELTSPTE'][$i] ?? '';
			$proSOPRequired = $_POST['proSOPRequired'][$i] ?? '';
			$proSOPNote = $_POST['proSOPNote'][$i] ?? '';
			$proDegreeRequired = $_POST['proDegreeRequired'][$i] ?? '';
			$proRecommendation = $_POST['proRecommendation'][$i] ?? '';
			$proNormalCV = $_POST['proNormalCV'][$i] ?? '';
			$proEuropassCV = $_POST['proEuropassCV'][$i] ?? '';
			$progmatGreTest = $_POST['progmatGreTest'][$i] ?? '';
			$proentryTest = $_POST['proentryTest'][$i] ?? '';
			$protextInterview = $_POST['protextInterview'][$i] ?? '';
			$prolegDocument = $_POST['prolegDocument'][$i] ?? '';
			$propreRelevantDegree = $_POST['propreRelevantDegree'][$i] ?? '';
			$applicationProcess = $_POST['applicationProcess'][$i] ?? '';
			$proIntake = $_POST['proIntake'][$i] ?? '';
			$proRound = $_POST['proRound'][$i] ?? '';
			$proCurrentRound = $_POST['proCurrentRound'][$i] ?? '';
			$openingDate = $_POST['openingDate'][$i] ?? '';
			$actualDeadline = $_POST['actualDeadline'][$i] ?? '';
			$nextOpenDate = $_POST['nextOpenDate'][$i] ?? '';

			if($proCurrentRound=='1'){
				$opening1stCallDate = $openingDate;
				$actual1stCallDeadline = $actualDeadline;

				$opening2ndCallDate = '0000-00-00';
				$actual2ndCallDeadline = '0000-00-00';
			} elseif($proCurrentRound=='2'){
				$opening1stCallDate = '0000-00-00';
				$actual1stCallDeadline = '0000-00-00';

				$opening2ndCallDate = $openingDate;
				$actual2ndCallDeadline = $actualDeadline;
			}
			$degreeAcceptable = $_POST['degreeAcceptable'][$i] ?? '';
			$programArrayValues = isset($programArray[$i]) ? $programArray[$i] : [];
			$progStore = [];
			foreach ($programArrayValues as $value) {
				$progStore[] = $value;
			}
			$clientPreDegJSON = json_encode($progStore);
			$proNoteHead = $_POST['proNoteHead'][$i] ?? '';
			$admissionValid = $_POST['admissionValid'][$i] ?? ''; 

			if ($detailStmt) {
				$entryByName = $_SESSION['uname'] ?? '';
				mysqli_stmt_bind_param($detailStmt, 'isssssssssssssssssssssssssssssss', $updateID, $uniName, $uniDegree, $programName, $proCGPAPer, $prolanguageInstruction, $proAppFee, $proTuitionFee, $proEngProfAccept, $proIELTSPTE, $proSOPRequired, $proSOPNote, $proDegreeRequired, $proRecommendation, $proNormalCV, $proEuropassCV, $progmatGreTest, $proentryTest, $protextInterview, $prolegDocument, $propreRelevantDegree, $applicationProcess, $proIntake, $proRound, $proCurrentRound, $opening1stCallDate, $actual1stCallDeadline, $opening2ndCallDate, $actual2ndCallDeadline, $nextOpenDate, $degreeAcceptable, $clientPreDegJSON, $proNoteHead, $admissionValid, $entryByName);
				$addProDetail_ex = mysqli_stmt_execute($detailStmt);
			} else {
				$addProDetail_ex = false;
			}
		}
		if ($detailStmt) mysqli_stmt_close($detailStmt);
	}
	if($insertPro_ex){
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Updated!', text: 'Programs Updated Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
	else{
		echo "<div class='alert alert-secondary'><strong>There is an error in the query2!</strong></div>";
	}
}

?>