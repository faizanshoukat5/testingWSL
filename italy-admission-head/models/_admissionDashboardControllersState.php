<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

$query = " SELECT
	SUM(CASE WHEN client_country='italy' THEN 1 ELSE 0 END) AS countOverallItaly,
	SUM(CASE WHEN client_country='italy' AND client_countryfrom='Pakistan' AND (client_document_status='0' OR client_pro_confirm_status='0') THEN 1 ELSE 0 END) AS countTotalNotProgramDocPakItaly,
	SUM(CASE WHEN client_country='italy' AND client_countryfrom='UAE' AND (client_document_status='1' OR client_pro_confirm_status='1') THEN 1 ELSE 0 END) AS countTotalNotProgramDocUAEItaly,
	SUM(CASE WHEN client_country='italy' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalItaly,
	SUM(CASE WHEN client_country='italy' AND client_countryfrom='Pakistan' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalPakItaly,
	SUM(CASE WHEN client_country='italy' AND client_countryfrom='UAE' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalUAEItaly,
	SUM(CASE WHEN client_country='italy' AND client_applied='[\"bachelor\"]' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalBachelor,
	SUM(CASE WHEN client_country='italy' AND client_applied='[\"master\"]' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalMaster,
	SUM(CASE WHEN client_country='italy' AND client_applied='[\"mbbs\"]' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalMBBS
	FROM clients".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND case_status='0' AND change_status='0' AND admin_status='1' ";
$result = mysqli_query($con, $query);
$data1 = mysqli_fetch_assoc($result);

$select = " SELECT
	COUNT(DISTINCT CASE WHEN italy_direct_pre IN ('1', '2') THEN italy_clients_id END) AS countTotalPre,
	COUNT(DISTINCT CASE WHEN italy_dream_id='1' THEN italy_clients_id END) AS countTotalDream,
	COUNT(DISTINCT CASE WHEN italy_direct_apply='1' THEN italy_clients_id END) AS countTotalDirect,
	COUNT(DISTINCT CASE WHEN italy_tolc_status='1' THEN italy_clients_id END) AS countTotalbeforeTolc,
	COUNT(DISTINCT CASE WHEN italy_tolc_status='2' THEN italy_clients_id END) AS countTotalAfterTolc,
	COUNT(DISTINCT CASE WHEN italy_cimea_status='1' THEN italy_clients_id END) AS countTotalCimea
	FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' ";
$select_ex = mysqli_query($con, $select);
$data2 = mysqli_fetch_assoc($select_ex);

$select = "SELECT 
	COUNT(CASE WHEN icp.italy_assign_status='1' THEN 1 END) AS countTotalAssign,
	COUNT(CASE WHEN icp.italy_assign_status='0' THEN 1 END) AS countTotalNotAssign,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND (icp.italy_applied_screenshot!='' OR icp.italy_direct_applied_screenshot!='' OR icp.italy_pre_applied_screenshot!='') THEN 1 END) AS countTotalApplied,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_program_status='0' THEN 1 END) AS countTotalAssignNotApplied,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND ((icp.italy_info_client_status='0' AND icp.italy_applied_status='5') OR (icp.italy_direct_info_client_status='0' AND icp.italy_direct_applied_status='5')) THEN 1 END) AS countTotalinformToClient,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND ((icp.italy_info_client_status='1' AND icp.italy_applied_status='5') OR (icp.italy_direct_info_client_status='1' AND icp.italy_direct_applied_status='5')) THEN 1 END) AS countTotalinformedToClient,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND ((icp.italy_info_client_status='2' AND icp.italy_applied_status='5') OR (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='5')) THEN 1 END) AS countTotalChangeRequired,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_deadline_hold_status='0' AND ((icp.italy_info_client_status='2' AND icp.italy_applied_status='6') OR (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='6')) THEN 1 END) AS countTotalChangeUpdated,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND ((icp.italy_info_client_status='4' AND (icp.italy_applied_status='5' OR icp.italy_applied_status='6')) OR (icp.italy_direct_info_client_status='4' AND (icp.italy_direct_applied_status='6' OR icp.italy_direct_applied_status='5'))) THEN 1 END) AS countTotalInformPayfee,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND ( (icp.italy_info_client_status='5' AND (icp.italy_applied_status='5' OR icp.italy_applied_status='6')) OR (icp.italy_direct_info_client_status='5' AND (icp.italy_direct_applied_status='6' OR icp.italy_direct_applied_status='5')) ) THEN 1 END) AS countTotalFeePaid,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND ((icp.italy_info_client_status='5' AND icp.italy_applied_status='7') OR (icp.italy_direct_info_client_status='5' AND icp.italy_direct_applied_status='7')) THEN 1 END) AS countTotalApplicationSubmited,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND (icp.italy_proof_screenshot1!='' OR icp.italy_direct_proof_screenshot!='') THEN 1 END) AS countTotalClientsProof,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND (icp.italy_info_client_status='10' AND icp.italy_applied_status='10') THEN 1 END) AS countTotalFillBergamoFee,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND (icp.italy_info_client_status='11' AND icp.italy_applied_status='11') THEN 1 END) AS countTotalBergamoFormFilled,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND (icp.italy_info_client_status='12' AND icp.italy_applied_status='12') THEN 1 END) AS countTotalBergamoInformFee,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND (icp.italy_info_client_status='6' AND icp.italy_applied_status='7') OR (icp.italy_direct_info_client_status='6' AND icp.italy_direct_applied_status='7') THEN 1 END) AS countTotalWaiting,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND (icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance' OR icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance') THEN 1 END) AS countTotalAcceptance,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND (icp.italy_dream_program1_status='Rejection' OR icp.italy_dream_program2_status='Rejection' OR icp.italy_direct_program1_status='Rejection' OR icp.italy_direct_program2_status='Rejection') THEN 1 END) AS countTotalRejection,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_program_status='1' THEN 1 END) AS countTotalProgramPending,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_program_status='2' THEN 1 END) AS countTotalProgramResolved,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_deadline_hold_status='1' THEN 1 END) AS countDeadlineHold,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_deadline_hold_status='2' THEN 1 END) AS countDeadlineRelease
	FROM italy_clients_programs{$_SESSION['dbNo']} icp JOIN clients{$_SESSION['dbNo']} cl ON icp.italy_clients_id = cl.client_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' AND (cl.client_self_acceptance_file='' AND cl.client_self_acceptance_file2='')";
$select_ex = mysqli_query($con, $select);
$data3 = mysqli_fetch_assoc($select_ex);

$selectClients = "SELECT 
	COUNT(DISTINCT CASE WHEN icp.italy_additional_activities_status='1' THEN cl.client_id END) AS countTotalAdditionalActivitiesAssign,
	COUNT(DISTINCT CASE WHEN icp.italy_additional_activities_status='2' THEN cl.client_id END) AS countTotalAdditionalActivitiesComplete,
	COUNT(DISTINCT CASE WHEN cl.client_self_acceptance_file!= '' THEN cl.client_id END) AS countTotalSelfReceived,
	COUNT(DISTINCT CASE WHEN (cl.client_pay_remaining_status='0' OR cl.client_pay_remaining_status='2') THEN cl.client_id END) AS countTotalAdvPaymentNotClear,
	COUNT(DISTINCT CASE WHEN cl.client_process_status != 'Direct Visa' AND ((icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance') OR (icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance') OR (icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_summary_status='Received')) AND cl.due_after_ad_status='0' THEN cl.client_id ELSE NULL END) AS countTotalDueNotClear,
	COUNT(DISTINCT CASE WHEN cl.client_process_status != 'Direct Visa' AND ((icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance') OR (icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance') OR (icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_program2_status='Acceptance') OR (icp.italy_pre_summary_status='Received')) AND cl.due_after_ad_status='2' THEN cl.client_id END) AS countTotalDueRemaining,
    COUNT(DISTINCT CASE WHEN cl.client_process_status != 'Direct Visa' AND ((icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance') OR (icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance') OR (icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_program2_status='Acceptance') OR (icp.italy_pre_summary_status='Received')) AND (cl.due_after_ad_status='1' OR cl.due_after_ad_status='3') THEN cl.client_id END) AS countTotalDueClear
    FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id=icp.italy_clients_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' ";
$selectClients_ex = mysqli_query($con, $selectClients);
$data4 = mysqli_fetch_assoc($selectClients_ex);


// Assign SOP's programs
$select = "SELECT client_id FROM italy_clients_programs{$_SESSION['dbNo']} icp JOIN clients{$_SESSION['dbNo']} cl ON icp.italy_clients_id = cl.client_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' AND (icp.italy_sops_assign_to!='0' || icp.italy_sops_status='4') GROUP BY cl.client_id "; 
$select_ex = mysqli_query($con, $select);
$countTotalSOPAssign = mysqli_num_rows($select_ex);


$select = " SELECT COUNT(DISTINCT cl.client_id) AS totalClients FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id JOIN italy_add_programs_details{$_SESSION['dbNo']} iapd ON iapd.italy_ad_uni_name=icp.italy_university_name AND iapd.italy_ad_degree=icp.italy_client_degree AND JSON_CONTAINS(icp.italy_program_name, JSON_QUOTE(iapd.italy_ad_program_name)) WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' AND cl.client_process_status!='Direct Visa' AND icp.italy_sops_assign_to='0' AND icp.italy_sops_status!='4' AND iapd.status='1' AND iapd.close='1' AND iapd.italy_ad_sop_required='1'";
$select_ex = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($select_ex);
$countTotalSOPNotAssign = $row['totalClients'];

// SOP's Received programs
$select = "SELECT client_id from clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' AND icp.italy_sops_status='4' GROUP BY cl.client_id "; 
$select_ex = mysqli_query($con, $select);
$countTotalSOPReceived = mysqli_num_rows($select_ex);

$select = "SELECT 
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_tolc_info_status='0' AND icp.italy_tolc_applied_status='3' THEN 1 END) AS countTotalTolcInform,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_tolc_info_status='1' AND icp.italy_tolc_applied_status='3' THEN 1 END) AS countTotalTolcSenttoClient,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_tolc_info_status='2' AND icp.italy_tolc_applied_status='3' THEN 1 END) AS countTotalTolcDate,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_tolc_info_status='3' AND icp.italy_tolc_applied_status='3' THEN 1 END) AS countTotalTolcFeePaid,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_tolc_info_status='4' AND icp.italy_tolc_applied_status='3' THEN 1 END) AS countTotalTolcSentPractice,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_tolc_pass_screenshot!='' THEN 1 END) AS countTotalTolcPass,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_tolc_fail_screenshot!='' THEN 1 END) AS countTotalTolcFail,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_tolc_pass_screenshot!='' AND icp.italy_applied_status='0' AND icp.italy_direct_applied_status='0' THEN 1 END) AS countTotalTolcPassNotApplied,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0' AND icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='5' THEN 1 END) AS countTotalPreinformedToClient,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0' AND icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='6' THEN 1 END) AS countTotalPreApplicationSubmited,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0' AND icp.italy_pre_proof_screenshot!='' THEN 1 END) AS countTotalPreClientsProof,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0' AND icp.italy_pre_info_client_status='1' AND icp.italy_pre_applied_status='6' THEN 1 END) AS countTotalPreWaiting,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0' AND (icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_program2_status='Acceptance' OR icp.italy_pre_summary_status='Received') THEN 1 END) AS countTotalPreAcceptance,
	COUNT(CASE WHEN icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0' AND (icp.italy_pre_program1_status='Rejection' OR icp.italy_pre_program2_status='Rejection' OR icp.italy_pre_summary_status='Rejection') AND icp.italy_pre_summary_status='Rejection' THEN 1 END) AS countTotalPreRejection,
	COUNT(CASE WHEN icp.italy_pre_assign_to!='0' AND icp.italy_pre_applied_status='0' THEN 1 END) AS countTotalAcceptNewAssign,
	COUNT(CASE WHEN icp.italy_pre_assign_to!='0' AND icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='5' THEN 1 END) AS countTotalAcceptPreinformedToClient,
	COUNT(CASE WHEN icp.italy_pre_assign_to!='0' AND icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='6' THEN 1 END) AS countTotalAcceptPreApplicationSubmited,
	COUNT(CASE WHEN icp.italy_pre_assign_to!='0' AND icp.italy_pre_proof_screenshot!='' THEN 1 END) AS countTotalAcceptPreClientsProof,
	COUNT(CASE WHEN icp.italy_pre_assign_to!='0' AND icp.italy_pre_info_client_status='1' AND icp.italy_pre_applied_status='6' THEN 1 END) AS countTotalAcceptPreWaiting,
	COUNT(CASE WHEN icp.italy_pre_assign_to!='0' AND icp.italy_pre_summary_status='Received' THEN 1 END) AS countTotalAcceptPreAcceptance,
	COUNT(CASE WHEN icp.italy_pre_assign_to!='0' AND icp.italy_pre_summary_status='Rejection' THEN 1 END) AS countTotalAcceptPreRejection
	FROM italy_clients_programs{$_SESSION['dbNo']} icp JOIN clients{$_SESSION['dbNo']} cl ON icp.italy_clients_id = cl.client_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' ";
$select_ex = mysqli_query($con, $select);
$data5 = mysqli_fetch_assoc($select_ex);


// Function to count open and closed programs based on degree type
function countUniversityPrograms($con, $universities, $degreeType) {
	$countTotalOpen = 0;
	$countTotalOpenYet = 0;
	$countTotalClose = 0;
	$countTotalOpenNot = 0;
	foreach ($universities as $university) {
		$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='{$university['name']}' AND italy_degree_name='{$degreeType}' ORDER BY italy_dates_id DESC LIMIT 1";
		$selectQuery_ex = mysqli_query($con, $selectQuery);
		if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
			$dateRow = mysqli_fetch_assoc($selectQuery_ex);
			$dateStatus = $dateRow['italy_date_status'];
			$openingDate = $dateRow['italy_opening_date'];
			$closingDate = $dateRow['italy_closing_date'];
			$currentDate = date('Y-m-d');
			if ($dateStatus=='1' && ($currentDate > $openingDate)) {
				$countTotalOpen++;
			}
			if ($dateStatus=='1' && ($currentDate < $openingDate && $currentDate < $closingDate)) {
				$countTotalOpenYet++;
			}
			if ($dateStatus == '2') {
				$countTotalClose++;
			}
			if (($dateStatus=='1') && $currentDate >= $openingDate && $currentDate <= $closingDate) {
				$select = "SELECT * FROM italy_clients_programs{$_SESSION['dbNo']} icp JOIN clients{$_SESSION['dbNo']} cl ON icp.italy_clients_id = cl.client_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND  cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.client_country='italy' AND icp.italy_assign_status='0' AND icp.italy_university_name='{$university['name']}' AND icp.italy_client_degree='{$degreeType}'  "; 
				$select_ex = mysqli_query($con, $select);
				$countTotalOpenNot += mysqli_num_rows($select_ex);
			}
		}
	}
	return [$countTotalOpen, $countTotalOpenYet, $countTotalClose, $countTotalOpenNot];
}
// University arrays for each degree type
$masterUniversities = [
	['name' => 'CaFoscari University of Venice (FV)'],
	['name' => 'Sapienza University of Rome (SPU)'],
	['name' => 'Universita Politecnica Delle Marche (MR)'],
	['name' => 'University of Bologna (UBN)'],
	['name' => 'University of Campania (UC)'],
	['name' => 'University of Messina (UM)'],
	['name' => 'University of Napoli Fedrico II (UNP)'],
	['name' => 'University of Padua (PDU)'],
	['name' => 'University of Palermo (PLM)'],
	['name' => 'University of Pavia (PV)'],
	['name' => 'University of Perugia (UPG)'],
	['name' => 'University of Siena (US)'],
	['name' => 'University of Trieste (TR)'],
	['name' => 'University of Turin (TU)'],
	['name' => 'University of Cassino (CS)'],
	['name' => 'University of Bergamo (BR)'],
	['name' => 'University of Ferrara (FR)'],
	['name' => 'University of Florence (UF)'],
	['name' => 'University of Foggia (FG)'],
	['name' => 'University of Genova (UG)'],
	['name' => 'University of Pisa (UP)'],
	['name' => 'University of Salerno (SL)'],
	['name' => 'University of Trento (TRN)'],
	['name' => 'University of Verona (VN)'],
	['name' => 'University of Tuscia (TS02)'],
	['name' => 'University of Laquia (LAQ01)'],
	['name' => 'University of Milano Biccoca (MLB)'],
	['name' => 'University of Camerino (UC)'],
	['name' => 'University of Parma (PRM)'],
	['name' => 'Universita Del Piemonte Orientale (UDPO)'],
	['name' => 'Tor Vergata University of Rome (TVR)'],
	['name' => 'University of Salento (UST)'],
	['name' => 'University of Brescia (BRS)']
];
$bachelorUniversities = [
	['name' => 'CaFoscari University of Venice (FV)'],
	['name' => 'Sapienza University of Rome (SPU)'],
	['name' => 'Universita Politecnica Delle Marche (MR)'],
	['name' => 'University of Bologna (UBN)'],
	['name' => 'University of Campania (UC)'],
	['name' => 'University of Messina (UM)'],
	['name' => 'University of Napoli Fedrico II (UNP)'],
	['name' => 'University of Padua (PDU)'],
	['name' => 'University of Palermo (PLM)'],
	['name' => 'University of Pavia (PV)'],
	['name' => 'University of Perugia (UPG)'],
	['name' => 'University of Siena (US)'],
	['name' => 'University of Trieste (TR)'],
	['name' => 'University of Turin (TU)'],
	['name' => 'University of Cassino (CS)'],
	['name' => 'University of Tuscia (TS02)'],
	['name' => 'University of Milano Biccoca (MLB)'],
	['name' => 'Unicamillus University of Health Care Romee (UHCR)'],
	['name' => 'University of Camerino (UC)'],
	['name' => 'University of Parma (PRM)'],
	['name' => 'University of Genova (UG)'],
	['name' => 'Tor Vergata University of Rome (TVR)'],
	['name' => 'University of Salento (UST)'],
	['name' => 'University of Brescia (BRS)']
];
$mbbsUniversities = [
	['name' => 'University of Campania (UC)'],
	['name' => 'University of Messina (UM)'],
	['name' => 'University of Pavia (PV)'],
	['name' => 'University of Turin (TU)'],
	['name' => 'University of Parma (PRM)']
];

// Count open and closed programs for each degree type
list($countTotalOpenMaster, $countTotalOpenYetMaster, $countTotalCloseMaster, $countTotalOpenMasterNot,)=countUniversityPrograms($con, $masterUniversities, 'master');
list($countTotalOpenBachelor, $countTotalOpenYetBachelor, $countTotalCloseBachelor, $countTotalOpenBachelorNot)=countUniversityPrograms($con, $bachelorUniversities, 'bachelor');
list($countTotalOpenMBBS, $countTotalOpenYetMBBS, $countTotalCloseMBBS, $countTotalOpenMBBSNot)=countUniversityPrograms($con, $mbbsUniversities, 'mbbs');
// Total counts
$totalOpening = $countTotalOpenMaster + $countTotalOpenBachelor + $countTotalOpenMBBS;
$totalOpeningYet = $countTotalOpenYetMaster + $countTotalOpenYetBachelor + $countTotalOpenYetMBBS;
$totalClosing = $countTotalCloseMaster + $countTotalCloseBachelor + $countTotalCloseMBBS;
$totalOpeningNot = $countTotalOpenMasterNot + $countTotalOpenBachelorNot + $countTotalOpenMBBSNot;


// Merge both data arrays
$mergedData = array_merge($data1, $data2, $data3, $data4, $data5);
// Add SOP counts
$mergedData['countTotalSOPAssign'] = $countTotalSOPAssign;
$mergedData['countTotalSOPNotAssign'] = $countTotalSOPNotAssign;
$mergedData['countTotalSOPReceived'] = $countTotalSOPReceived;
$mergedData['totalOpening'] = $totalOpening;
$mergedData['totalOpeningYet'] = $totalOpeningYet;
$mergedData['totalClosing'] = $totalClosing;
$mergedData['totalOpeningNot'] = $totalOpeningNot;

// Return single JSON
echo json_encode($mergedData);

?>