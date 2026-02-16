<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

$select1 = "SELECT 
	COUNT(DISTINCT cl.client_id) AS countTotalItaly,
	COUNT(DISTINCT CASE WHEN cl.client_countryfrom = 'Pakistan' THEN cl.client_id END) AS countTotalPakItaly,
	COUNT(DISTINCT CASE WHEN cl.client_countryfrom = 'UAE' THEN cl.client_id END) AS countTotalUAEItaly,
	COUNT(DISTINCT CASE WHEN cl.client_applied = '[\"bachelor\"]' THEN cl.client_id END) AS countTotalBachelor,
	COUNT(DISTINCT CASE WHEN cl.client_applied = '[\"master\"]' THEN cl.client_id END) AS countTotalMaster,
	COUNT(DISTINCT CASE WHEN cl.client_applied = '[\"mbbs\"]' THEN cl.client_id END) AS countTotalMBBS,
	COUNT(DISTINCT CASE WHEN icp.italy_direct_pre IN ('1','2') THEN cl.client_id END) AS countTotalPre,
	COUNT(DISTINCT CASE WHEN icp.italy_dream_id = '1' THEN cl.client_id END) AS countTotalDream,
	COUNT(DISTINCT CASE WHEN icp.italy_direct_apply = '1' THEN cl.client_id END) AS countTotalDirect,
	COUNT(DISTINCT CASE WHEN icp.italy_tolc_status = '1' THEN cl.client_id END) AS countTotalbeforeTolc,
	COUNT(DISTINCT CASE WHEN icp.italy_tolc_status = '2' THEN cl.client_id END) AS countTotalAfterTolc,
	COUNT(DISTINCT CASE WHEN icp.italy_cimea_status = '1' THEN cl.client_id END) AS countTotalCimea

	FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id=icp.italy_clients_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND icp.italy_program_assign='".$_SESSION['user_id']."' ";
$select1_ex = mysqli_query($con, $select1);
$data1 = mysqli_fetch_assoc($select1_ex);

$select2 = "SELECT 
	COUNT(DISTINCT CASE WHEN icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalAssign,
	COUNT(DISTINCT CASE WHEN (icp.italy_applied_screenshot!='' OR icp.italy_direct_applied_screenshot!='' OR icp.italy_pre_applied_screenshot!='')  THEN icp.italy_client_pro_id END) AS countTotalApplied,
	COUNT(DISTINCT CASE WHEN icp.italy_program_status='0' AND icp.italy_pre_applied_status='0' AND icp.italy_applied_status='0' AND icp.italy_direct_applied_status='0' AND icp.italy_cimea_applied_status='0' AND icp.italy_tolc_applied_status='0' THEN icp.italy_client_pro_id END) AS countTotalNewAssignNotApplied,
	COUNT(DISTINCT CASE WHEN icp.italy_program_status='0' AND icp.italy_applied_status='0' AND icp.italy_direct_applied_status='0' AND icp.italy_tolc_pass_screenshot!='' THEN icp.italy_client_pro_id END) AS countTotalTOLCPassNotApplied,
	COUNT(DISTINCT CASE WHEN ((icp.italy_info_client_status='0' AND icp.italy_applied_status='5') OR (icp.italy_direct_info_client_status='0' AND icp.italy_direct_applied_status='5')) AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalinformToClient,
	COUNT(DISTINCT CASE WHEN ((icp.italy_info_client_status='1' AND icp.italy_applied_status='5') OR (icp.italy_direct_info_client_status='1' AND icp.italy_direct_applied_status='5')) AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalinformedToClient,
	COUNT(DISTINCT CASE WHEN ((icp.italy_info_client_status='2' AND icp.italy_applied_status='5') OR (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='5')) AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalChangeRequired,
	COUNT(DISTINCT CASE WHEN ((icp.italy_info_client_status='2' AND icp.italy_applied_status='6') OR (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='6')) AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalChangeUpdated,
	COUNT(DISTINCT CASE WHEN ((icp.italy_info_client_status='3' AND icp.italy_applied_status IN ('5','6')) OR (icp.italy_direct_info_client_status='3' AND icp.italy_direct_applied_status IN ('5','6'))) AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalApproved,
	COUNT(DISTINCT CASE WHEN ((icp.italy_info_client_status='4' AND icp.italy_applied_status IN ('5','6')) OR (icp.italy_direct_info_client_status='4' AND icp.italy_direct_applied_status IN ('5','6'))) AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalInformPayfee,
	COUNT(DISTINCT CASE WHEN ((icp.italy_info_client_status='5' AND icp.italy_applied_status IN ('5','6')) OR (icp.italy_direct_info_client_status='5' AND icp.italy_direct_applied_status IN ('5','6'))) AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalFeePaid,
	COUNT(DISTINCT CASE WHEN ((icp.italy_info_client_status='5' AND icp.italy_applied_status='7') OR (icp.italy_direct_info_client_status='5' AND icp.italy_direct_applied_status='7')) AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalApplicationSubmited,
	COUNT(DISTINCT CASE WHEN (icp.italy_proof_screenshot1!='' OR icp.italy_direct_proof_screenshot!='') AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalClientsProof,
	COUNT(DISTINCT CASE WHEN icp.italy_info_client_status='10' AND icp.italy_applied_status='10' AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalInformTeamBergamoFee,
	COUNT(DISTINCT CASE WHEN icp.italy_info_client_status='11' AND icp.italy_applied_status='11' AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalBergamoFee,
	COUNT(DISTINCT CASE WHEN ((icp.italy_info_client_status='6' AND icp.italy_applied_status='7') OR (icp.italy_direct_info_client_status='6' AND icp.italy_direct_applied_status='7')) AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalWaiting,
	COUNT(DISTINCT CASE WHEN (icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance' OR icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance') AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalAcceptance,
	COUNT(DISTINCT CASE WHEN (icp.italy_dream_program1_status='Rejection' OR icp.italy_dream_program2_status='Rejection' OR icp.italy_direct_program1_status='Rejection' OR icp.italy_direct_program2_status='Rejection') AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalRejection,
	COUNT(DISTINCT CASE WHEN icp.italy_program_status='1' AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalProgramPending,
	COUNT(DISTINCT CASE WHEN icp.italy_program_status='2' AND icp.italy_assign_status='1' THEN icp.italy_client_pro_id END) AS countTotalPendingResolves,
	COUNT(DISTINCT CASE WHEN icp.italy_additional_activities_status='1' THEN cl.client_id END) AS countTotalAdditionalActivitiesAssign,
	COUNT(DISTINCT CASE WHEN icp.italy_additional_activities_status='2' THEN cl.client_id END) AS countTotalAdditionalActivitiesComplete

	FROM italy_clients_programs{$_SESSION['dbNo']} icp JOIN clients{$_SESSION['dbNo']} cl ON icp.italy_clients_id=cl.client_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND icp.italy_program_assign='".$_SESSION['user_id']."' "; 
$select2_ex = mysqli_query($con, $select2);
$data2 = mysqli_fetch_assoc($select2_ex);

$select3 = "SELECT 
	SUM(CASE WHEN icp.italy_program_assign='".$_SESSION['user_id']."' AND icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='5' AND icp.italy_pre_assign_to='0' THEN 1 ELSE 0 END) AS countTotalPreinformedToClient,
	SUM(CASE WHEN icp.italy_program_assign='".$_SESSION['user_id']."' AND icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='6' AND icp.italy_pre_assign_to='0' THEN 1 ELSE 0 END) AS countTotalPreApplicationSubmited,
	SUM(CASE WHEN icp.italy_program_assign='".$_SESSION['user_id']."' AND icp.italy_pre_proof_screenshot!='' AND icp.italy_pre_assign_to='0' THEN 1 ELSE 0 END) AS countTotalPreClientsProof,
	SUM(CASE WHEN icp.italy_program_assign='".$_SESSION['user_id']."' AND icp.italy_pre_info_client_status='1' AND icp.italy_pre_applied_status='6' AND icp.italy_pre_assign_to='0' THEN 1 ELSE 0 END) AS countTotalPreWaiting,

	SUM(CASE WHEN icp.italy_program_assign='".$_SESSION['user_id']."' AND (icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_program2_status='Acceptance') AND icp.italy_pre_summary_status='Received' AND icp.italy_pre_assign_to='0' THEN 1 ELSE 0 END) AS countTotalPreAcceptance,

	SUM(CASE WHEN icp.italy_program_assign='".$_SESSION['user_id']."' AND (icp.italy_pre_program1_status='Rejection' OR icp.italy_pre_program2_status='Rejection') AND icp.italy_pre_summary_status='Rejection' AND icp.italy_pre_assign_to='0' THEN 1 ELSE 0 END) AS countTotalPreRejection,

	COUNT(DISTINCT CASE WHEN icp.italy_pre_assign_to='".$_SESSION['user_id']."' AND (icp.italy_send_to_pre_proof!='' OR icp.italy_direct_pre='1') AND icp.italy_pre_applied_status='0' THEN cl.client_id END) AS countTotalPreAssign,

	SUM(CASE WHEN icp.italy_pre_assign_to='".$_SESSION['user_id']."' AND icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='5' AND icp.italy_pre_assign_to!='0' THEN 1 ELSE 0 END) AS countTotalAcceptPreinformedToClient,

	SUM(CASE WHEN icp.italy_pre_assign_to='".$_SESSION['user_id']."' AND icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='6' AND icp.italy_pre_assign_to!='0' THEN 1 ELSE 0 END) AS countTotalAcceptPreApplicationSubmited,

	SUM(CASE WHEN icp.italy_pre_assign_to='".$_SESSION['user_id']."' AND icp.italy_pre_proof_screenshot!='' AND icp.italy_pre_assign_to!='0' THEN 1 ELSE 0 END) AS countTotalAcceptPreClientsProof,

	SUM(CASE WHEN icp.italy_pre_assign_to='".$_SESSION['user_id']."' AND icp.italy_pre_info_client_status='1' AND icp.italy_pre_applied_status='6' AND icp.italy_pre_assign_to!='0' THEN 1 ELSE 0 END) AS countTotalAcceptPreWaiting,

	SUM(CASE WHEN icp.italy_pre_assign_to='".$_SESSION['user_id']."' AND (icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_program2_status='Acceptance') AND icp.italy_pre_summary_status='Received' AND icp.italy_pre_assign_to!='0' THEN 1 ELSE 0 END) AS countTotalAcceptPreAcceptance,

	SUM(CASE WHEN icp.italy_pre_assign_to='".$_SESSION['user_id']."' AND (icp.italy_pre_program1_status='Rejection' OR icp.italy_pre_program2_status='Rejection') AND icp.italy_pre_summary_status='Rejection' AND icp.italy_pre_assign_to!='0' THEN 1 ELSE 0 END) AS countTotalAcceptPreRejection

	FROM italy_clients_programs{$_SESSION['dbNo']} icp JOIN clients{$_SESSION['dbNo']} cl ON icp.italy_clients_id=cl.client_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' "; 
$select3_ex = mysqli_query($con, $select3);
$data3 = mysqli_fetch_assoc($select3_ex);

// Merge both data arrays
$mergedData = array_merge($data1, $data2, $data3);
// Return single JSON
echo json_encode($mergedData);

?>