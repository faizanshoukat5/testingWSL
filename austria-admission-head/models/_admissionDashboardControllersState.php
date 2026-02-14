<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');


$query = " SELECT
	SUM(CASE WHEN client_country='austria' THEN 1 ELSE 0 END) AS countOverallczech,
	SUM(CASE WHEN client_country='austria' AND client_countryfrom='Pakistan' AND (client_document_status='0' OR client_pro_confirm_status='0') THEN 1 ELSE 0 END) AS countTotalNotProgramDocPakczech,
	SUM(CASE WHEN client_country='austria' AND client_countryfrom='UAE' AND (client_document_status='0' OR client_pro_confirm_status='0') THEN 1 ELSE 0 END) AS countTotalNotProgramDocUAEczech,
	SUM(CASE WHEN client_country='austria' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalczech,
	SUM(CASE WHEN client_country='austria' AND client_countryfrom='Pakistan' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalPakczech,
	SUM(CASE WHEN client_country='austria' AND client_countryfrom='UAE' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalUAEczech,
	SUM(CASE WHEN client_country='austria' AND client_applied='[\"bachelor\"]' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalBachelor,
	SUM(CASE WHEN client_country='austria' AND client_applied='[\"master\"]' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalMaster FROM clients".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND case_status='0' AND change_status='0' AND admin_status='1' ";

$result = mysqli_query($con, $query);
$data1 = mysqli_fetch_assoc($result);

$select = "SELECT 
	COUNT(CASE WHEN acp.aus_assign_status='1' THEN 1 END) AS countTotalAssign,
	COUNT(CASE WHEN acp.aus_assign_status='0' THEN 1 END) AS countTotalNotAssign,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_program_status='0' THEN 1 END) AS countTotalAssignNotApplied,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_direct_applied_screenshot!='' THEN 1 END) AS countTotalApplied,

	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_direct_applied_status='4' THEN 1 END) AS countTotalApplicationFilled,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_direct_applied_status='5' THEN 1 END) AS countTotalApplicationSubmitted,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_direct_applied_status='6' THEN 1 END) AS countTotalClientsProof,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND  acp.aus_direct_applied_status='7' THEN 1 END) AS countTotalInformPayfee,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_direct_applied_status='8' THEN 1 END) AS countTotalFeePaidByClient,
	
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_direct_applied_status='9' THEN 1 END) AS countTotalWaiting,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND (acp.aus_direct_program1_status='Acceptance' OR acp.aus_direct_program2_status='Acceptance') THEN 1 END) AS countTotalAcceptance,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND (acp.aus_direct_program1_status='Rejection' OR acp.aus_direct_program2_status='Rejection') THEN 1 END) AS countTotalRejection,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_program_status='1' THEN 1 END) AS countTotalProgramPending,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_program_status='2' THEN 1 END) AS countTotalProgramResolved,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_deadline_hold_status='1' THEN 1 END) AS countDeadlineHold,
	COUNT(CASE WHEN acp.aus_assign_status='1' AND acp.aus_deadline_hold_status='2' THEN 1 END) AS countDeadlineRelease

	FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id = cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria'";

$select_ex = mysqli_query($con, $select);
$data2 = mysqli_fetch_assoc($select_ex);



$selectClients = "SELECT 
	COUNT(DISTINCT CASE WHEN cl.country_checklist_info_file!='' THEN cl.client_id END) AS countTotalSupChecklistSent,
	COUNT(DISTINCT CASE WHEN cl.country_checklist_info_file='' THEN cl.client_id END) AS countTotalSupChecklistNotSent,
	COUNT(DISTINCT CASE WHEN acp.aus_additional_activities_status='1' THEN cl.client_id END) AS countTotalAdditionalActivitiesAssign,
	COUNT(DISTINCT CASE WHEN acp.aus_additional_activities_status='2' THEN cl.client_id END) AS countTotalAdditionalActivitiesComplete,
	COUNT(DISTINCT CASE WHEN cl.client_self_acceptance_file!= '' THEN cl.client_id END) AS countTotalSelfReceived,
	COUNT(DISTINCT CASE WHEN (cl.client_pay_remaining_status='0' OR cl.client_pay_remaining_status='2') THEN cl.client_id END) AS countTotaladvPayNotClear,
	COUNT(DISTINCT CASE WHEN (acp.aus_direct_program1_status='Acceptance' OR acp.aus_direct_program2_status='Acceptance') AND cl.due_after_ad_status='0' THEN cl.client_id END) AS countTotalDueNotClear,
	COUNT(DISTINCT CASE WHEN (acp.aus_direct_program1_status='Acceptance' OR acp.aus_direct_program2_status='Acceptance') AND cl.due_after_ad_status='2' THEN cl.client_id END) AS countTotalDueRemaining,
    COUNT(DISTINCT CASE WHEN (acp.aus_direct_program1_status='Acceptance' OR acp.aus_direct_program2_status='Acceptance') AND (cl.due_after_ad_status='1' OR cl.due_after_ad_status='3') THEN cl.client_id END) AS countTotalDueClear
    FROM clients{$_SESSION['dbNo']} cl JOIN austria_clients_programs{$_SESSION['dbNo']} acp ON cl.client_id=acp.aus_clients_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' ";
$selectClients_ex = mysqli_query($con, $selectClients);
$data3 = mysqli_fetch_assoc($selectClients_ex);


// Assign SOP's programs
$select = "SELECT client_id FROM austria_clients_programs{$_SESSION['dbNo']} acp JOIN clients{$_SESSION['dbNo']} cl ON acp.aus_clients_id = cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND (acp.aus_sops_assign_to!='0' || acp.aus_sops_status='4') GROUP BY cl.client_id "; 
$select_ex = mysqli_query($con, $select);
$countTotalSOPAssign = mysqli_num_rows($select_ex);

$select = " SELECT COUNT(DISTINCT cl.client_id) AS totalClients FROM clients{$_SESSION['dbNo']} cl JOIN austria_clients_programs{$_SESSION['dbNo']} acp ON cl.client_id = acp.aus_clients_id JOIN austria_add_programs_details{$_SESSION['dbNo']} aapd ON aapd.aus_ad_uni_name=acp.aus_university_name AND aapd.aus_ad_degree=acp.aus_client_degree AND JSON_CONTAINS(acp.aus_program_name, JSON_QUOTE(aapd.aus_ad_program_name)) WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND cl.client_process_status!='Direct Visa' AND acp.aus_sops_assign_to='0' AND acp.aus_sops_status!='4' AND aapd.status='1' AND aapd.close='1' AND aapd.aus_ad_sop_required='1'";
$select_ex = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($select_ex);
$countTotalSOPNotAssign = $row['totalClients'];

// SOP's Received programs
$select = "SELECT client_id from clients{$_SESSION['dbNo']} cl JOIN austria_clients_programs{$_SESSION['dbNo']} acp ON cl.client_id = acp.aus_clients_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_sops_status='4' GROUP BY cl.client_id "; 
$select_ex = mysqli_query($con, $select);
$countTotalSOPReceived = mysqli_num_rows($select_ex);


// Merge both data arrays
$mergedData = array_merge($data1, $data2, $data3);
// Add SOP counts
$mergedData['countTotalSOPAssign'] = $countTotalSOPAssign;
$mergedData['countTotalSOPNotAssign'] = $countTotalSOPNotAssign;
$mergedData['countTotalSOPReceived'] = $countTotalSOPReceived;

// Return single JSON
echo json_encode($mergedData);

?>