<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');
// step 1 form action
if (isset($_POST['step1Type'])) {
	$step1Type = $_POST['step1Type'];
	$uniProID = $_POST['uniProID'];

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pro_step1='".$step1Type."', italy_applied_status='1' WHERE italy_client_pro_id='".$uniProID."' ";
	$run_ex = mysqli_query($con, $run);

}
// step 2 form action
if (isset($_POST['step2Type'])) {
	$step2Type = $_POST['step2Type'];
	$uniProID = $_POST['uniProID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pro_step2='".$step2Type."', italy_applied_status='2' WHERE italy_client_pro_id='".$uniProID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 3 form action
if (isset($_POST['step3Type'])) {
	$step3Type = $_POST['step3Type'];
	$uniProID = $_POST['uniProID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pro_step3='".$step3Type."', italy_applied_status='3' WHERE italy_client_pro_id='".$uniProID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 4 form action
if (isset($_POST['step4Type'])) {
	$step4Type = $_POST['step4Type'];
	$uniProID = $_POST['uniProID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pro_step4='".$step4Type."', italy_applied_status='4' WHERE italy_client_pro_id='".$uniProID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 6 form action
if (isset($_POST['step6Type'])) {
	$step6Type = $_POST['step6Type'];
	$uniProID = $_POST['uniProID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pro_step6='".$step6Type."', italy_applied_status='7' WHERE italy_client_pro_id='".$uniProID."' ";
	$run_ex = mysqli_query($con, $run);
}

/////////////////// Pre Enrollment Step ///////////////////////////////////

// step 1 form action
if (isset($_POST['step1PreType'])) {
	$step1PreType = $_POST['step1PreType'];
	$uniPreID = $_POST['uniPreID'];

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_step1='".$step1PreType."', italy_pre_applied_status='1' WHERE italy_client_pro_id='".$uniPreID."' ";
	$run_ex = mysqli_query($con, $run);

}
// step 2 form action
if (isset($_POST['step2PreType'])) {
	$step2PreType = $_POST['step2PreType'];
	$uniPreID = $_POST['uniPreID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_step2='".$step2PreType."', italy_pre_applied_status='2' WHERE italy_client_pro_id='".$uniPreID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 3 form action
if (isset($_POST['step3PreType'])) {
	$step3PreType = $_POST['step3PreType'];
	$uniPreID = $_POST['uniPreID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_step3='".$step3PreType."', italy_pre_applied_status='3' WHERE italy_client_pro_id='".$uniPreID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 4 form action
if (isset($_POST['step4PreType'])) {
	$step4PreType = $_POST['step4PreType'];
	$uniPreID = $_POST['uniPreID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_step4='".$step4PreType."', italy_pre_applied_status='4' WHERE italy_client_pro_id='".$uniPreID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 6 form action
if (isset($_POST['step6PreType'])) {
	$step6PreType = $_POST['step6PreType'];
	$uniPreID = $_POST['uniPreID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_step6='".$step6PreType."', italy_pre_applied_status='7' WHERE italy_client_pro_id='".$uniPreID."' ";
	$run_ex = mysqli_query($con, $run);
}


/////////////////// Direct Univerities apply Step ///////////////////////////////////

// step 1 form action
if (isset($_POST['step1DirectType'])) {
	$step1DirectType = $_POST['step1DirectType'];
	$uniDirectID = $_POST['uniDirectID'];

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_step1='".$step1DirectType."', italy_direct_applied_status='1' WHERE italy_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);

}
// step 2 form action
if (isset($_POST['step2DirectType'])) {
	$step2DirectType = $_POST['step2DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_step2='".$step2DirectType."', italy_direct_applied_status='2' WHERE italy_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 3 form action
if (isset($_POST['step3DirectType'])) {
	$step3DirectType = $_POST['step3DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_step3='".$step3DirectType."', italy_direct_applied_status='3' WHERE italy_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 4 form action
if (isset($_POST['step4DirectType'])) {
	$step4DirectType = $_POST['step4DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_step4='".$step4DirectType."', italy_direct_applied_status='4' WHERE italy_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 6 form action
if (isset($_POST['step6DirectType'])) {
	$step6DirectType = $_POST['step6DirectType'];
	$uniDirectID = $_POST['uniDirectID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_step6='".$step6DirectType."', italy_direct_applied_status='7' WHERE italy_client_pro_id='".$uniDirectID."' ";
	$run_ex = mysqli_query($con, $run);
}

?>