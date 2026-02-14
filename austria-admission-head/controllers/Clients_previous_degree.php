<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

if(isset($_POST['subPreDegree'])) {
	$preDegreeName = $_POST['preDegreeName'] ?? '';

	$sql = "INSERT INTO previous_client_degrees (pre_degree_name, status, close, entry_by) VALUES (?, '1', '1', ?)";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		$entryBy = (int)($_SESSION['user_id'] ?? 0);
		mysqli_stmt_bind_param($stmt, 'si', $preDegreeName, $entryBy);
		$addPreDeg_ex = mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$addPreDeg_ex = false;
	}

	if($addPreDeg_ex){
		echo "<script>document.addEventListener('DOMContentLoaded', function () { Swal.fire({ title: 'Added!', text: 'Degree Added Successfully', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
} 

// Update query
if(isset($_POST['updPreDegree'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$preDegreeName = $_POST['preDegreeName'] ?? '';

	$sqlUpd = "UPDATE previous_client_degrees SET pre_degree_name = ? WHERE pre_degree_id = ?";
	$stmtUpd = mysqli_prepare($con, $sqlUpd);
	if ($stmtUpd) {
		mysqli_stmt_bind_param($stmtUpd, 'si', $preDegreeName, $updateID);
		$updPreDeg_ex = mysqli_stmt_execute($stmtUpd);
		mysqli_stmt_close($stmtUpd);
	} else {
		$updPreDeg_ex = false;
	}
	if($updPreDeg_ex){
		echo "<script>document.addEventListener('DOMContentLoaded', function () { Swal.fire({ title: 'Updated!', text: 'Degree Updated Successfully', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

?>