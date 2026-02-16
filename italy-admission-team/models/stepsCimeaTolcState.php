<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');
// step 1 form action
if (isset($_POST['step1TolcType'])) {
	$step1TolcType = $_POST['step1TolcType'];
	$uniTolcID = $_POST['uniTolcID'];

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_step1='".$step1TolcType."', italy_tolc_applied_status='1' WHERE italy_client_pro_id='".$uniTolcID."' ";
	$run_ex = mysqli_query($con, $run);
}
// step 2 form action
if (isset($_POST['step2TolcType'])) {
	$step2TolcType = $_POST['step2TolcType'];
	$uniTolcID = $_POST['uniTolcID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_step2='".$step2TolcType."', italy_tolc_applied_status='2' WHERE italy_client_pro_id='".$uniTolcID."' ";
	$run_ex = mysqli_query($con, $run);
}
// step 3 form action
if (isset($_POST['step3TolcType'])) {
	$step3TolcType = $_POST['step3TolcType'];
	$uniTolcID = $_POST['uniTolcID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_tolc_step3='".$step3TolcType."', italy_tolc_applied_status='3' WHERE italy_client_pro_id='".$uniTolcID."' ";
	$run_ex = mysqli_query($con, $run);
}


// Cimea steps query
// step 1 form action
if (isset($_POST['step1CimeaType'])) {
	$step1CimeaType = $_POST['step1CimeaType'];
	$uniCimeaID = $_POST['uniCimeaID'];

	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_step1='".$step1CimeaType."', italy_cimea_applied_status='1' WHERE italy_client_pro_id='".$uniCimeaID."' ";
	$run_ex = mysqli_query($con, $run);

}
// step 2 form action
if (isset($_POST['step2CimeaType'])) {
	$step2CimeaType = $_POST['step2CimeaType'];
	$uniCimeaID = $_POST['uniCimeaID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_step2='".$step2CimeaType."', italy_cimea_applied_status='2' WHERE italy_client_pro_id='".$uniCimeaID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 3 form action
if (isset($_POST['step3CimeaType'])) {
	$step3CimeaType = $_POST['step3CimeaType'];
	$uniCimeaID = $_POST['uniCimeaID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_step3='".$step3CimeaType."', italy_cimea_applied_status='3' WHERE italy_client_pro_id='".$uniCimeaID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 4 form action
if (isset($_POST['step4CimeaType'])) {
	$step4CimeaType = $_POST['step4CimeaType'];
	$uniCimeaID = $_POST['uniCimeaID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_step4='".$step4CimeaType."', italy_cimea_applied_status='4' WHERE italy_client_pro_id='".$uniCimeaID."' ";
	$run_ex = mysqli_query($con, $run);
}

// step 6 form action
if (isset($_POST['step6CimeaType'])) {
	$step6CimeaType = $_POST['step6CimeaType'];
	$uniCimeaID = $_POST['uniCimeaID'];
	$run = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_cimea_step6='".$step6CimeaType."', italy_cimea_applied_status='7' WHERE italy_client_pro_id='".$uniCimeaID."' ";
	$run_ex = mysqli_query($con, $run);
}


?>