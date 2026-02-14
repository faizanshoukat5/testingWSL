<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

$current_date =  date('Y-m-d');
if(isset($_POST['updPro'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$assignProgram = (int)($_POST['assignProgram'] ?? 0);

	$table = 'austria_clients_programs' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET aus_program_assign = ?, aus_program_assign_date = ?, aus_assign_status = '1' WHERE aus_client_pro_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'isi', $assignProgram, $current_date, $updateID);
		$exec = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$exec = false;
	}

	if ($exec) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Assigned!',
				text: 'Program is Assign.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	} else {
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!</strong>
		</div>";
	}
}

//////////////// Clients Program ////////////////////////////////
// Insert program in clients_program
if (isset($_POST['czechSubProgram'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['clientUpdateID']);
	$appliedName = mysqli_real_escape_string($con, $_POST['appliedName']);
	$updateProID = (int)($_POST['updateProID'] ?? 0);

	// mark old program as changed using prepared statement
	$table = 'austria_clients_programs' . $_SESSION['dbNo'];
	$updSql = "UPDATE `" . $table . "` SET aus_change_program_status='1' WHERE aus_client_pro_id = ?";
	$updStmt = mysqli_prepare($con, $updSql);
	if ($updStmt) {
		mysqli_stmt_bind_param($updStmt, 'i', $updateProID);
		mysqli_stmt_execute($updStmt);
		mysqli_stmt_close($updStmt);
	}

	if ($appliedName=='bachelor' || $appliedName=='master') {
		// prepare insert once and execute per-loop
		$insertSql = "INSERT INTO `" . $table . "` (`aus_clients_id`, `aus_university_name`, `aus_program_name`, `aus_intake`, `aus_client_degree`, `close`, `status`, `entry_by`) VALUES (?, ?, ?, ?, ?, '1', '1', ?)";
		$insStmt = mysqli_prepare($con, $insertSql);
		for ($i=0; $i < count($_POST['uniName']); $i++) {
			$uniName = $_POST['uniName'][$i];
			$progStore = [];
            $programArray = $_POST['programName'][$i];
            foreach ($programArray as $value) {
                $progStore[] = $value; // prepared stmt handles escaping
            }
            $programName = json_encode($progStore);
			$intakeName = $_POST['intakeName'][$i];

			$clientIdInt = (int)$updateID;
			$entryByInt = (int)$_SESSION['user_id'];
			// bind & execute prepared insert statement
			if ($insStmt) {
				mysqli_stmt_bind_param($insStmt, 'issssi', $clientIdInt, $uniName, $programName, $intakeName, $appliedName, $entryByInt);
				$insert_query_ex = mysqli_stmt_execute($insStmt);
			} else {
				$insert_query_ex = false;
			}

			if ($insert_query_ex){
				echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Changed!', text: 'Program is Changed.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
			} else {
				echo "<div class='alert alert-secondary'><strong>There is an error in the query2!</strong></div>";
			}
		}
		if ($insStmt) { mysqli_stmt_close($insStmt); }
	}
}

// Assign SOPs
if(isset($_POST['updAssignSOP'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$assignSOP = mysqli_real_escape_string($con, $_POST['assignSOP']);
	$programNameSOP = mysqli_real_escape_string($con, $_POST['programNameSOP']);
	$pageNoSOP = mysqli_real_escape_string($con, $_POST['pageNoSOP']);
	$totalWordsSOP = mysqli_real_escape_string($con, $_POST['totalWordsSOP']);
	$noteSOP = mysqli_real_escape_string($con, $_POST['noteSOP']);

	$table = 'austria_clients_programs' . $_SESSION['dbNo'];
	$sqlSop = "UPDATE `" . $table . "` SET aus_sops_assign_to = ?, aus_sops_program_name = ?, aus_sops_page_no = ?, aus_sops_total_words = ?, aus_sops_note = ? WHERE aus_client_pro_id = ?";
	$stmtSop = mysqli_prepare($con, $sqlSop);
	if ($stmtSop) {
		$assignSOPInt = (int)$assignSOP;
		$pageNoInt = (int)$pageNoSOP;
		$totalWordsInt = (int)$totalWordsSOP;
		$updateIDInt = (int)$updateID;
		mysqli_stmt_bind_param($stmtSop, 'isiisi', $assignSOPInt, $programNameSOP, $pageNoInt, $totalWordsInt, $noteSOP, $updateIDInt);
		// correct types used above; fallback to string binding if needed
		$execSop = mysqli_stmt_execute($stmtSop);
		mysqli_stmt_close($stmtSop);
	} else {
		$execSop = false;
	}
	if ($execSop) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Uploaded!',
				text: 'Data uploaded successfully.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!</strong>
		</div>";
	}
}

if (isset($_POST['czechSubNewProgram'])) {
	$updateID = (int)($_POST['clientUpdateID'] ?? 0);
	$appliedName = $_POST['appliedName'] ?? '';
	
	if ($appliedName === 'bachelor' || $appliedName === 'master') {
		$table = 'austria_clients_programs' . $_SESSION['dbNo'];
		$insertSql2 = "INSERT INTO `" . $table . "` (aus_clients_id, aus_university_name, aus_program_name, aus_intake, aus_client_degree, close, status, entry_by) VALUES (?, ?, ?, ?, ?, '1', '1', ?)";
		$insStmt2 = mysqli_prepare($con, $insertSql2);
		for ($i = 0; $i < count($_POST['uniName']); $i++) {
			$uniName = $_POST['uniName'][$i] ?? '';
			$progStore = [];
			$programArray = $_POST['programName'][$i] ?? [];
			foreach ($programArray as $value) {
				$progStore[] = $value;
			}
			$programName = json_encode($progStore);
			$intakeName = $_POST['intakeName'][$i] ?? '';

			$clientIdInt = (int)$updateID;
			$entryByInt = (int)($_SESSION['user_id'] ?? 0);
			if ($insStmt2) {
				mysqli_stmt_bind_param($insStmt2, 'issssi', $clientIdInt, $uniName, $programName, $intakeName, $appliedName, $entryByInt);
				$insert_query_ex = mysqli_stmt_execute($insStmt2);
			} else {
				$insert_query_ex = false;
			}

			if ($insert_query_ex) {
				echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Added!', text: 'Program is Added.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
			} else {
				echo "<div class='alert alert-secondary'><strong>There is an error in the query2!</strong></div>";
			}
		}

		if ($insStmt2) {
			mysqli_stmt_close($insStmt2);
		}
	}
} 
?>