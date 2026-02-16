<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Acceptance
$select = "SELECT italy_client_pro_id FROM italy_clients_programs{$_SESSION['dbNo']} icp JOIN clients{$_SESSION['dbNo']} cl ON icp.italy_clients_id = cl.client_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND icp.italy_assign_status='1' AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance' || icp.italy_pre_program1_status='Acceptance' || icp.italy_pre_program2_status='Acceptance')  "; 
$select_ex = mysqli_query($con, $select);
$countTotalAcceptance = mysqli_num_rows($select_ex);

// Self Received Acceptance
$select = "SELECT client_id FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id=icp.italy_clients_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_self_acceptance_file!='' GROUP BY cl.client_id"; 
$select_ex = mysqli_query($con, $select);
$countTotalSelfReceived = mysqli_num_rows($select_ex);

$query = "SELECT COUNT(DISTINCT CASE WHEN cl.due_after_ad_status='0' THEN cl.client_id ELSE NULL END) AS countTotalDueNotClear, COUNT(DISTINCT CASE WHEN cl.due_after_ad_status='2' THEN cl.client_id ELSE NULL END) AS countTotalDueRemaining, COUNT(DISTINCT CASE WHEN cl.due_after_ad_status IN ('1', '3') THEN cl.client_id ELSE NULL END) AS countTotalDueClear FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id=icp.italy_clients_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_process_status != 'Direct Visa' AND (icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance' OR icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance' OR icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_summary_status='Received') ";

$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);

$countTotalDueNotClear = $data['countTotalDueNotClear'];
$countTotalDueRemaining = $data['countTotalDueRemaining'];
$countTotalDueClear = $data['countTotalDueClear'];

$query = "SELECT COUNT(DISTINCT CASE WHEN NOT EXISTS (SELECT 1 FROM italy_clients_programs{$_SESSION['dbNo']} p WHERE p.italy_clients_id=cl.client_id AND (p.italy_dream_program1_status='Acceptance' OR p.italy_dream_program2_status='Acceptance' OR p.italy_direct_program1_status='Acceptance' OR p.italy_direct_program2_status='Acceptance') AND p.italy_send_to_pre_proof!='' ) THEN cl.client_id ELSE NULL END) AS countTotalDueAcknowledgementClear, COUNT(DISTINCT CASE WHEN EXISTS (SELECT 1 FROM italy_clients_programs{$_SESSION['dbNo']} p WHERE p.italy_clients_id=cl.client_id AND (p.italy_dream_program1_status='Acceptance' OR p.italy_dream_program2_status='Acceptance' OR p.italy_direct_program1_status='Acceptance' OR p.italy_direct_program2_status='Acceptance') AND p.italy_send_to_pre_proof!='' ) THEN cl.client_id ELSE NULL END) AS countTotalAssignPreEnrollment FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id=icp.italy_clients_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND (icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance' OR icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance') AND (cl.due_after_ad_status='1' OR cl.due_after_ad_status='3') AND EXISTS (SELECT 1 FROM client_payafter_admission{$_SESSION['dbNo']} cpaa WHERE cl.client_id=cpaa.after_ad_client_id  AND cpaa.after_ad_name='acknowlegment')";

$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);
$countTotalDueAcknowledgementClear = $data['countTotalDueAcknowledgementClear'];
$countTotalAssignPreEnrollment = $data['countTotalAssignPreEnrollment'];

// Acceptance
$select = "SELECT cl.client_id FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id WHERE cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.country_checklist_intro_file!='' AND cl.country_checklist_info_file!='' GROUP BY cl.client_id "; 
$select_ex = mysqli_query($con, $select);
$checklistSent = mysqli_num_rows($select_ex);
// Acceptance
$select = "SELECT cl.client_id FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id WHERE cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND (cl.country_checklist_intro_file='' || cl.country_checklist_info_file='') GROUP BY cl.client_id "; 
$select_ex = mysqli_query($con, $select);
$checklistNotSent = mysqli_num_rows($select_ex);


$WhatsAppchecklistSent = 0;
$WhatsAppchecklistNotSent = 0;

$introMessageNotSentCount=0;
$introMessageSentCount=0;

$caseHistoryNotSentCount=0;
$caseHistorySentCount=0;
$caseHistoryReceivedCount=0;
$caseHistoryGuidedCount=0;
$totalCaseHistoryReceived=0;
$caseHistoryNotReceivedCount=0;

$attestationNotSentCount=0;
$attestationSentCount=0;
$attestationByClientCount=0;

$scholarshipNotSentCount=0;
$scholarshipSentCount=0;

$countHotelBookingNotSent=0;
$countHotelBookingSent=0;

$translateSentCount=0;
$translateNotSentCount=0;
$translateByClientCount=0;

$visaBookNotSentCount=0;
$visaBookSentCount=0;
$visaBookedCount=0;
$visaSubmittedCount=0;
$visaAcceptedCount=0;
$visaRejectedCount=0;

$selectAckCount=0;
$tranSentCount=0;

$clientData="SELECT client_id FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id=icp.italy_clients_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_process_status!='Only Admission Process' GROUP BY cl.client_id "; 
$clientData_ex = mysqli_query($con, $clientData);
foreach ($clientData_ex as $row) {
	$clientID = $row['client_id'];
	if ($clientID != '') {

		$query = "SELECT SUM(CASE WHEN visa_intro_checklist_steps_name IN ('DOV Cimea Checklist', 'Visa Checklist') THEN 1 ELSE 0 END) AS WhatsAppChecklistCount, SUM(CASE WHEN visa_intro_checklist_steps_name='Intro Message' THEN 1 ELSE 0 END) AS IntroMessageCount, SUM(CASE WHEN visa_intro_checklist_steps_name='Scholarship Details' THEN 1 ELSE 0 END) AS ScholarshipDetailsCount FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_intro_checklist_client_id='".$clientID."' ";
		$result = mysqli_query($con, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			// WhatsApp Checklist logic
			$WhatsAppChecklistCount = $row['WhatsAppChecklistCount'];
			if ($WhatsAppChecklistCount >= 2) {
				$WhatsAppchecklistSent++;
			}
			if ($WhatsAppChecklistCount == 0) {
				$WhatsAppchecklistNotSent++;
			}
			// Intro Message logic
			$IntroMessageCount = $row['IntroMessageCount'];
			if ($IntroMessageCount == 0) {
				$introMessageNotSentCount++;
			} else {
				$introMessageSentCount++;
			}
			// Scholarship Details logic
			$ScholarshipDetailsCount = $row['ScholarshipDetailsCount'];
			if ($ScholarshipDetailsCount == 0) {
				$scholarshipNotSentCount++;
			} else {
				$scholarshipSentCount++;
			}
		}

		$query = "SELECT COUNT(visa_case_history_id) AS totalCaseHistoryCount, 
		SUM(CASE WHEN visa_case_history_status='Case History sent to Clients' AND visa_case_status='1' THEN 1 ELSE 0 END) AS notReceivedCount, 
		SUM(CASE WHEN visa_case_history_status='Case History Study has been Completed, and Client has been Guided' THEN 1 ELSE 0 END) AS guidedCount, 
		SUM(CASE WHEN visa_case_history_status='Case History sent & Received by Clients' THEN 1 ELSE 0 END) AS receivedCount FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_case_history_client_id='".$clientID."' GROUP BY visa_case_history_client_id";
		$result = mysqli_query($con, $query);
		if ($row = mysqli_fetch_assoc($result)) {
			$totalCaseHistory = $row['totalCaseHistoryCount'];
			$caseHistoryNotReceived = $row['notReceivedCount'];
			$caseHistoryGuided = $row['guidedCount'];
			$caseHistoryReceived = $row['receivedCount'];
			// Case History Sent / Not Sent
			if ($totalCaseHistory == 0) {
				$caseHistoryNotSentCount++;
			} else {
				$caseHistorySentCount++;
			}
			// Count for Not Received
			if ($caseHistoryNotReceived != 0) {
				$caseHistoryNotReceivedCount++;
			}
			// Count for Guided
			if ($caseHistoryGuided != 0) {
				$caseHistoryGuidedCount++;
			}
			// Count for Received
			if ($caseHistoryReceived != 0) {
				$caseHistoryReceivedCount++;
			}
			// Calculate Total Received - Guided
			$totalCaseHistoryReceived = $caseHistoryReceivedCount - $caseHistoryGuidedCount;
		}


		$query = "SELECT 
		SUM(CASE WHEN visa_attest_trans_step_name='Documents Attestation' THEN 1 ELSE 0 END) AS attestationCount, 
		SUM(CASE WHEN visa_attest_trans_step_name='Documents Attestation' AND visa_attest_trans_status='Educational Documents Attestation by Client' THEN 1 ELSE 0 END) AS attestationByClientCount, 
		SUM(CASE WHEN visa_attest_trans_step_name='Documents Translate' THEN 1 ELSE 0 END) AS translateCount, 
		SUM(CASE WHEN visa_attest_trans_step_name='Documents Translate' AND visa_attest_trans_status='Documents Translate into the Italian Language by Client' THEN 1 ELSE 0 END) AS translateByClientCount,
		SUM(CASE WHEN visa_attest_trans_step_name='Hotel Booking & Ticket Reservation' THEN 1 ELSE 0 END) AS hotelByClientCount
		FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_attest_trans_client_id='".$clientID."'";

		$result = mysqli_query($con, $query);
		if ($row = mysqli_fetch_assoc($result)) {
			// Attestation
			$attestationCount = $row['attestationCount'];
			if ($attestationCount == 0) {
				$attestationNotSentCount++;
			} else {
				$attestationSentCount++;
			}

			$attestationByClient = $row['attestationByClientCount'];
			if ($attestationByClient != 0) {
				$attestationByClientCount++;
			}
			// Translation
			$translateCount = $row['translateCount'];
			if ($translateCount == 0) {
				$translateNotSentCount++;
			} else {
				$translateSentCount++;
			}

			$translateByClient = $row['translateByClientCount'];
			if ($translateByClient != 0) {
				$translateByClientCount++;
			}
			// Hotel
			$hotelByClientCount = $row['hotelByClientCount'];
			if ($hotelByClientCount == 0) {
				$countHotelBookingNotSent++;
			} else {
				$countHotelBookingSent++;
			}
		}


		$query = " SELECT COUNT(*) AS totalAppointments, SUM(CASE WHEN visa_book_appoint_status='Visa Appointment Booked By Client' THEN 1 ELSE 0 END) AS bookedCount, SUM(CASE WHEN visa_book_appoint_status='Visa Submitted By Client' THEN 1 ELSE 0 END) AS submittedCount, SUM(CASE WHEN visa_book_appoint_status='Visa Accepted' THEN 1 ELSE 0 END) AS acceptedCount, SUM(CASE WHEN visa_book_appoint_status='Visa Rejected' THEN 1 ELSE 0 END) AS rejectedCount FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_book_appoint_client_id='".$clientID."'";

		$result = mysqli_query($con, $query);
		if ($row = mysqli_fetch_assoc($result)) {
			$totalAppointments = $row['totalAppointments'];

			if ($totalAppointments == 0) {
				$visaBookNotSentCount++;
			} else {
				$visaBookSentCount++;
			}
			// Status counts
			if ($row['bookedCount'] != 0) {
				$visaBookedCount += $row['bookedCount'];
			}
			if ($row['submittedCount'] != 0) {
				$visaSubmittedCount += $row['submittedCount'];
			}
			if ($row['acceptedCount'] != 0) {
				$visaAcceptedCount += $row['acceptedCount'];
			}
			if ($row['rejectedCount'] != 0) {
				$visaRejectedCount += $row['rejectedCount'];
			}
		}
	}
}

// After Admission Dues are Acknowledged by Client, Now send the Italian Lawyers details
$select = "SELECT client_id FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id LEFT JOIN italy_clients_visa_attest_trans{$_SESSION['dbNo']} icvat ON cl.client_id = icvat.visa_attest_trans_client_id AND (icvat.visa_attest_trans_step_name='Documents Translate') LEFT JOIN client_payafter_admission{$_SESSION['dbNo']} cpaa ON cl.client_id=cpaa.after_ad_client_id WHERE cpaa.close='1' AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND icvat.visa_attest_trans_step_name IS NULL AND cpaa.after_ad_name='acknowlegment' GROUP BY cl.client_id "; 
$select_ex = mysqli_query($con, $select);
$totalRemainingLawyerCount = mysqli_num_rows($select_ex);

$query = "SELECT COUNT(DISTINCT CASE WHEN cl.due_after_visa_paid_file='' THEN cl.client_id ELSE NULL END) AS countVisaDueNotClear, COUNT(DISTINCT CASE WHEN cl.due_after_visa_paid_file != '' THEN cl.client_id ELSE NULL END) AS countVisaDueClear FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_visa_book_appoint{$_SESSION['dbNo']} icvba ON cl.client_id=icvba.visa_book_appoint_client_id WHERE cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND icvba.close='1' AND icvba.status='1' AND icvba.visa_book_appoint_status='Visa Accepted' ";

$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);

$countVisaDueNotClear = $data['countVisaDueNotClear'];
$countVisaDueClear = $data['countVisaDueClear'];

$extraData = [
	"countTotalAcceptance" => $countTotalAcceptance,
	"countTotalSelfReceived" => $countTotalSelfReceived,
	
	"countTotalDueNotClear" => $countTotalDueNotClear,
	"countTotalDueRemaining" => $countTotalDueRemaining,
	"countTotalDueClear" => $countTotalDueClear,

	"countTotalDueAcknowledgementClear" => $countTotalDueAcknowledgementClear,
	"countTotalAssignPreEnrollment" => $countTotalAssignPreEnrollment,

	"checklistSent" => $checklistSent,
	"checklistNotSent" => $checklistNotSent,

	"WhatsAppchecklistSent" => $WhatsAppchecklistSent,
	"WhatsAppchecklistNotSent" => $WhatsAppchecklistNotSent,

	"introMessageNotSentCount" => $introMessageNotSentCount,
	"introMessageSentCount" => $introMessageSentCount,

	"caseHistoryNotSentCount" => $caseHistoryNotSentCount,
	"caseHistorySentCount" => $caseHistorySentCount,
	"caseHistoryReceivedCount" => $caseHistoryReceivedCount,
	"caseHistoryGuidedCount" => $caseHistoryGuidedCount,
	"totalCaseHistoryReceived" => $totalCaseHistoryReceived,
	"caseHistoryNotReceivedCount" => $caseHistoryNotReceivedCount,

	"attestationNotSentCount" => $attestationNotSentCount,
	"attestationSentCount" => $attestationSentCount,
	"attestationByClientCount" => $attestationByClientCount,

	"scholarshipNotSentCount" => $scholarshipNotSentCount,
	"scholarshipSentCount" => $scholarshipSentCount,

	"translateSentCount" => $translateSentCount,
	"translateNotSentCount" => $translateNotSentCount,
	"translateByClientCount" => $translateByClientCount,

	"countHotelBookingNotSent" => $countHotelBookingNotSent,
	"countHotelBookingSent" => $countHotelBookingSent,

	"visaBookNotSentCount" => $visaBookNotSentCount,
	"visaBookSentCount" => $visaBookSentCount,
	"visaBookedCount" => $visaBookedCount,
	"visaSubmittedCount" => $visaSubmittedCount,
	"visaAcceptedCount" => $visaAcceptedCount,
	"visaRejectedCount" => $visaRejectedCount,

	"totalRemainingLawyerCount" => $totalRemainingLawyerCount,

	"countVisaDueNotClear" => $countVisaDueNotClear,
	"countVisaDueClear" => $countVisaDueClear
];
echo json_encode($extraData);
?>