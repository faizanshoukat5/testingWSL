<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');
// Dream Apply Step delete
// delete inform to client
if (isset($_POST['informToClientDel'])) {
	$programID = $_POST['informToClientDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_client_info_screenshot1='', italy_client_info_note='', italy_info_client_status='0', italy_applied_status='5' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete changes by Head
if (isset($_POST['changesHeadDel'])) {
	$programCheckingID = $_POST['changesHeadDel'];
	$programAppliedID = $_POST['programAppliedID'];

	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_client_status='1', italy_applied_status='5' WHERE italy_client_pro_id='".$programAppliedID."'";
	$del_query_ex = mysqli_query($con,$del_query);

	$del_query="UPDATE italy_clients_programs_checking".$_SESSION['dbNo']." SET close='0' WHERE program_italy_id='".$programCheckingID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete approved dream applied
if (isset($_POST['approvedHeadDel'])) {
	$programID = $_POST['approvedHeadDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_ok_screenshot1='', italy_ok_note='' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete approved dream applied
if (isset($_POST['feePaidHeadDel'])) {
	$programID = $_POST['feePaidHeadDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_pay_fee='', italy_fee_paid_client='', italy_fee_note='' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete proof dream applied
if (isset($_POST['proofHeadDel'])) {
	$programID = $_POST['proofHeadDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_proof_screenshot1='', italy_proof_note='', italy_info_client_status='5', italy_applied_status='7' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete proof dream applied
if (isset($_POST['informEnrollHeadDel'])) {
	$programID = $_POST['informEnrollHeadDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_enrollment_inform_note='', italy_enrollment_inform_screenshot='', italy_info_client_status='7', italy_applied_status='7' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete pay enroll form by head
if (isset($_POST['payEnrollFormHeadDel'])) {
	$programID = $_POST['payEnrollFormHeadDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_enroll_info_pay_fee='', italy_enroll_fee_paid_client='', italy_enroll_fee_note='', italy_info_client_status='11', italy_applied_status='11' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// Direct Apply Step delete
// delete inform to client
if (isset($_POST['informToClientDirectDel'])) {
	$programID = $_POST['informToClientDirectDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_client_info_screenshot='', italy_direct_client_info_note='', italy_direct_info_client_status='0', italy_direct_applied_status='5' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete changes by Head
if (isset($_POST['changesHeadDirectDel'])) {
	$programCheckingDirectID = $_POST['changesHeadDirectDel'];
	$programAppliedDirectID = $_POST['programAppliedDirectID'];

	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_info_client_status='1', italy_direct_applied_status='5' WHERE italy_client_pro_id='".$programAppliedDirectID."'";
	$del_query_ex = mysqli_query($con,$del_query);

	$del_query = "UPDATE italy_clients_programs_checking".$_SESSION['dbNo']." SET close='0' WHERE program_italy_id='".$programCheckingDirectID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete approved dream applied
if (isset($_POST['approvedHeadDirectDel'])) {
	$programID = $_POST['approvedHeadDirectDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_ok_screenshot1='', italy_ok_note='' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete approved dream applied
if (isset($_POST['feePaidHeadDirectDel'])) {
	$programID = $_POST['feePaidHeadDirectDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_info_pay_fee='', italy_fee_paid_client='', italy_fee_note='' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete proof dream applied
if (isset($_POST['proofHeadDirectDel'])) {
	$programID = $_POST['proofHeadDirectDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_proof_screenshot1='', italy_proof_note='', italy_direct_info_client_status='5', italy_direct_applied_status='7' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}


?>