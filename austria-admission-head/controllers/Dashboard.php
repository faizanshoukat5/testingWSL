<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

$user_email = 
	session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;
$user_designation = $_SESSION['user_designation'];
$user_id = $_SESSION['user_id'];
$current_date =  date('Y-m-d');
$current_time =  date('H:i:s');
$current_month =  date('m-Y');

$sql = "SELECT * FROM wt_users WHERE email = ?";
$stmt = mysqli_prepare($con, $sql);
if ($stmt) {
	mysqli_stmt_bind_param($stmt, 's', $user_email);
	mysqli_stmt_execute($stmt);
	$execuit = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
} else {
	$execuit = false;
}

?>