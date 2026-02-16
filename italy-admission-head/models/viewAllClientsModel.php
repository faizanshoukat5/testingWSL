<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkconvertStatus'])) {
	$clientStatus = $_POST['checkconvertStatus'];
	$clientCountry = $_POST['checkclientCountry'];
	$clientDegree = $_POST['checkclientDegree'];
	$processStatus = $_POST['checkprocessStatus'];
	$checklistStatus = $_POST['checkchecklistStatus'];
	$sopStatus = $_POST['checksopStatus'];
	$assignPrograms = $_POST['checkassignPrograms'];
	$appliedPrograms = $_POST['checkappliedPrograms'];
	$ieltsStatus = $_POST['checkieltsStatus'];
	$embassyStatus = $_POST['checkembassyStatus'];
	$intakeYear = $_POST['checkintakeYear'];
	$checkApplication = $_POST['checkapplicationStatus'];
	$acceptDate = $_POST['checkacceptDate'];
	$summaryDate = $_POST['checksummaryDate'];
	$visaProcess = $_POST['checkvisaProcess'];
	$preProcess = $_POST['checkpreProcess'];
	$preAcceptProcess = $_POST['checkpreAcceptProcess'];
	$CEnTSProcess = $_POST['checkCEnTSProcess'];
	$universityStatus = $_POST['checkuniversityStatus'];
	$otherStatus = $_POST['checkotherStatus'];
	$assignAgent = $_POST['checkassignAgent'];
	$startDate = $_POST['checkstartDate'];
	$endDate = $_POST['checkendDate'];
	$current_date =  date('Y-m-d');
	$degbachmaster='';
	$degbachMBBS='';
	if ($clientDegree=='master') {
		$degInfo = '["master"]';
		$degbachmaster = '["bachelor","master"]';
	}elseif ($clientDegree=='bachelor') {
		$degInfo = '["bachelor"]';
		$degbachmaster = '["bachelor","master"]';
	}elseif ($clientDegree=='mbbs') {
		$degInfo = '["mbbs"]';
		$degbachmaster = '["master","mbbs"]';
		$degbachMBBS = '["bachelor","mbbs"]';
	}
	elseif ($clientDegree=='phd') {
		$degInfo = '["phd"]';
	}
	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;
		
	$whereCondition = " cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' ";

	if ($clientStatus!="all" ) {
		$whereCondition .= "AND cl.client_convert_status='".$clientStatus."'";
	}
	if ($clientCountry != "all") {
		if($clientCountry=='Pakistan' || $clientCountry=='UAE' || $clientCountry=='Qatar'){
			$whereCondition .= " AND cl.client_countryfrom='".$clientCountry."'";
		}
		if($clientCountry=='Saudi Arabia'){
			$whereCondition .= " AND (cl.client_countryfrom='Saudi Arabia' || cl.client_countryfrom='saudi Arabia' || cl.client_countryfrom='saudi arabia') ";
		}
		if($clientCountry=='Other Country'){
			$whereCondition .= " AND cl.client_countryfrom!='Pakistan' AND cl.client_countryfrom!='UAE' AND cl.client_countryfrom!='Saudi Arabia' AND cl.client_countryfrom!='saudi arabia' AND cl.client_countryfrom!='saudi Arabia' AND cl.client_countryfrom!='Qatar' AND cl.client_countryfrom NOT LIKE '%".$clientCountry."%' ";
		}
		if($clientCountry=='Oman' ){
			$whereCondition .= " AND cl.client_countryfrom LIKE '%".$clientCountry."%' ";
		}
	}

	if ($clientDegree!="all") {
		$whereCondition .= " AND (cl.client_applied='$degInfo' OR cl.client_applied='$degbachMBBS' OR cl.client_applied='$degbachmaster') ";
	}
	if ($processStatus!="all" ) {
		$whereCondition .= " AND cl.client_process_status='".$processStatus."'";
	}
	// Email Checklist
	if ($checklistStatus!="all" ) {
		if ($checklistStatus=='Email & WhatsApp Checklist Sent Clients') {
			$whereCondition .= " AND cl.country_checklist_intro_file!='' AND cl.country_checklist_info_file!='' ";
		}
		if ($checklistStatus=='Email & WhatsApp Checklist Not Sent Clients') {
			$whereCondition .= " AND (cl.country_checklist_intro_file='' || cl.country_checklist_info_file='') ";
		}
	}
	// sop status
	if ($sopStatus!="all") {
		if ($sopStatus=='Sops Assign Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_sops_assign_to!='0' || icp.italy_sops_status='4') ";
		}
		if ($sopStatus == 'SOPs Not Assign Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Direct Visa' AND icp.italy_sops_assign_to='0' AND icp.italy_sops_status !='4' AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_change_program_status='0' AND EXISTS (SELECT 1 FROM italy_add_programs_details{$_SESSION['dbNo']} AS iapd WHERE iapd.status='1' AND iapd.close='1' AND iapd.italy_ad_sop_required='1' AND iapd.italy_ad_uni_name=icp.italy_university_name AND iapd.italy_ad_degree=icp.italy_client_degree AND JSON_CONTAINS(icp.italy_program_name, JSON_QUOTE(iapd.italy_ad_program_name))) ";
		}
		if ($sopStatus=='SOPs Received Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_sops_status='4' ";
		}
	}
	if ($assignPrograms=='All Assign Programs') {
		$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_assign_status='1' ";
	}
	if($assignPrograms=='All Not Assign Programs'){
		$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (cl.client_self_acceptance_file='' AND cl.client_self_acceptance_file2='') AND icp.italy_assign_status='0' ";
	}
	if($assignPrograms=='All Not Assign Clients'){
		$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (cl.client_self_acceptance_file='' AND cl.client_self_acceptance_file2='') AND cl.client_id IN (SELECT italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." GROUP BY italy_clients_id HAVING SUM(CASE WHEN italy_assign_status != '0' OR italy_pre_assign_to!='0' THEN 1 ELSE 0 END)=0 )";
	}
	if ($appliedPrograms!="all" ) {
		if ($appliedPrograms=='All Applied Programs') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_applied_screenshot!='' || icp.italy_direct_applied_screenshot!='' || icp.italy_pre_applied_screenshot!='')";
		}
		if($appliedPrograms=='New Assign But Not Applied Clients'){
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_assign_status='1' AND icp.italy_program_status='0' AND ((icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='0') AND (icp.italy_info_client_status='0' AND icp.italy_applied_status='0') AND (icp.italy_direct_info_client_status='0' AND icp.italy_direct_applied_status='0') AND (icp.italy_cimea_info_client_status='0' AND icp.italy_cimea_applied_status='0') AND (icp.italy_tolc_info_status='0' AND icp.italy_tolc_applied_status='0') )";
		}
		if($appliedPrograms=='My Pending Programs Report'){
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_assign_status='1' AND icp.italy_program_status='1'";
		}
		if($appliedPrograms=='I Have Resolved the Pending Report'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_assign_status='1' AND icp.italy_program_status='2' ";
		}
		if($appliedPrograms=='All University Admission Rejected Clients'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_id IN ( SELECT italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." WHERE italy_assign_status='1' GROUP BY italy_clients_id HAVING 
			-- must have at least one (9,0)
			SUM(CASE WHEN italy_info_client_status='9' AND italy_direct_info_client_status='0' THEN 1 ELSE 0 END) >= 1
			AND
			-- must have at least one (0,9)
			SUM(CASE WHEN italy_info_client_status='0' AND italy_direct_info_client_status='9' THEN 1 ELSE 0 END) >= 1
			AND
			-- must have no rows with other combinations
			SUM(CASE WHEN (italy_info_client_status='9' AND italy_direct_info_client_status='0') OR (italy_info_client_status='0' AND italy_direct_info_client_status = '9') 
			THEN 0 ELSE 1 END
			) = 0 )";
		}
	}
	if ($ieltsStatus!="all" ) {
		$whereCondition .= "AND cl.client_ielts_pte='".$ieltsStatus."' ";
	}
	// embassy 
	if ($embassyStatus != "all") {
		if($embassyStatus=='Islamabad Embassy' || $embassyStatus=='Karachi Embassy' || $embassyStatus=='Abu Dhabi Embassy' || $embassyStatus=='Dubai Embassy' || $embassyStatus=='Riyadh, Saudi Arabia Embassy' || $embassyStatus=='Doha, Qatar Embassy' || $embassyStatus=='Muscat, Oman Embassy'){
			$whereCondition .= " AND client_embassy='".$embassyStatus."'";
		}
		if($embassyStatus=='Other Embassy'){
			$whereCondition .= " AND client_embassy!='Islamabad Embassy' AND client_embassy!='Karachi Embassy' AND client_embassy!='Abu Dhabi Embassy' AND client_embassy!='Dubai Embassy' AND client_embassy!='Riyadh, Saudi Arabia Embassy' AND client_embassy!='Doha, Qatar Embassy' AND client_embassy!='Muscat, Oman Embassy' AND client_embassy!='' ";
		}
	}
	if ($intakeYear!="all" ) {
		$whereCondition .= "AND cl.client_intake_year='".$intakeYear."'";
	}
	if($acceptDate!=""){
		$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_assign_status='1' AND (((icp.italy_dream_program1_status='Acceptance' AND icp.italy_dream_program1_date='".$acceptDate."' ) || (icp.italy_dream_program2_status='Acceptance' AND icp.italy_dream_program2_date='".$acceptDate."' )) || ((icp.italy_direct_program1_status='Acceptance' AND icp.italy_direct_program1_date='".$acceptDate."' ) || (icp.italy_direct_program2_status='Acceptance' AND icp.italy_direct_program2_date='".$acceptDate."' ))) ";
	}
	// Admission Application status
	if ($checkApplication!="all" ) {
		if ($checkApplication=='Advance Remaining Payment Not Clear Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (cl.client_pay_remaining_status='0' || cl.client_pay_remaining_status='2') ";
		}
		if ($checkApplication=='Self Received Acceptance') {
			$whereCondition .= " AND cl.client_self_acceptance_file!='' ";
		}
		if ($checkApplication=='CEnT-S Pass But Not Applied') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_assign_status='1' AND icp.italy_tolc_pass_screenshot!='' AND icp.italy_applied_status='0' AND icp.italy_direct_applied_status='0' ";
		}
		if ($checkApplication=='Inform the Client to Recheck the Application') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_info_client_status='0' AND icp.italy_applied_status='5') || (icp.italy_direct_info_client_status='0' AND icp.italy_direct_applied_status='5') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Applications Sent to the client for Rechecking'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_info_client_status='1' AND icp.italy_applied_status='5') || (icp.italy_direct_info_client_status='1' AND icp.italy_direct_applied_status='5') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Client Requests Changes in the Application'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_info_client_status='2' AND icp.italy_applied_status='5') || (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='5') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Changes Complete By Processing Team'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_info_client_status='2' AND icp.italy_applied_status='6') || (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='6') ) AND icp.italy_assign_status='1' AND icp.italy_deadline_hold_status='0'  ";
		}
		if($checkApplication=='Client Informed, How to Pay the Application Fee'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_info_client_status='4' AND (icp.italy_applied_status='5' || icp.italy_applied_status='6')) || (icp.italy_direct_info_client_status='4' AND (icp.italy_direct_applied_status='6' || icp.italy_direct_applied_status='5')) ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Application Approved And Application Fee Paid by Client'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_info_client_status='5' AND (icp.italy_applied_status='5' || icp.italy_applied_status='6')) || (icp.italy_direct_info_client_status='5' AND (icp.italy_direct_applied_status='6' || icp.italy_direct_applied_status='5'))) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Admission Application Submitted by Processing Team'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_info_client_status='5' AND icp.italy_applied_status='7') || (icp.italy_direct_info_client_status='5' AND icp.italy_direct_applied_status='7') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Sent Admission Applied Proof to Client'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_proof_screenshot1!='' || icp.italy_direct_proof_screenshot!='') AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Inform to Processing Team to Fill Bergamo Enrollment Fee Form'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_info_client_status='10' AND icp.italy_applied_status='10') AND icp.italy_assign_status='1'";
		}
		if($checkApplication=='Bergamo enrollment fee form was filled out by the processing team, but the client has not been informed yet to pay the application fee'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_info_client_status='11' AND icp.italy_applied_status='11') AND icp.italy_assign_status='1'";
		}
		if($checkApplication=='Bergamo University clients who have not yet paid the enrollment fee'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_info_client_status='12' AND icp.italy_applied_status='12') AND icp.italy_assign_status='1'";
		}
		if($checkApplication=='Additional Activities Required by University Clients Assign to Processing Team'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_additional_activities_status='1' ";
		}
		if($checkApplication=='Additional Activities Required by University Task Complete by Processing Team'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_additional_activities_status='2' ";
		}
		if ($checkApplication=='Deadline Hold') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_deadline_hold_status='1' ";
		}
		if ($checkApplication=='Deadline Release') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_deadline_hold_status='2' ";
		}
		if ($checkApplication=='Waiting for Admission decision') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_info_client_status='6' AND icp.italy_applied_status='7') || (icp.italy_direct_info_client_status='6' AND icp.italy_direct_applied_status='7') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Acceptance Letter Received Clients'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance') ||( icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='University Admission Rejected Clients'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_dream_program1_status='Rejection' || icp.italy_dream_program2_status='Rejection') ||( icp.italy_direct_program1_status='Rejection' || icp.italy_direct_program2_status='Rejection')) AND icp.italy_assign_status='1' ";
		}
	}
	// visa processing steps
	if ($visaProcess!="all") {
		if ($visaProcess=='After Admission Dues Clear Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance') OR (icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance') OR (icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_summary_status='Received')) AND (cl.due_after_ad_status='1' || cl.due_after_ad_status='3') ";
		}
		if ($visaProcess=='After Admission Dues Remaining Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND ((icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance') OR (icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance') OR (icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_summary_status='Received')) AND cl.due_after_ad_status='2' ";
		}
		if ($visaProcess=='After Admission Dues Not Clear Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Direct Visa' AND ((icp.italy_dream_program1_status='Acceptance' OR icp.italy_dream_program2_status='Acceptance') OR (icp.italy_direct_program1_status='Acceptance' OR icp.italy_direct_program2_status='Acceptance') OR (icp.italy_pre_program1_status='Acceptance' OR icp.italy_pre_summary_status='Received')) AND cl.due_after_ad_status='0' ";
		}
		if ($visaProcess=='After Admission Dues are Acknowledged by Client, Now Assign Pre-enrollment to Processing Team') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') AND (cl.due_after_ad_status='1' || cl.due_after_ad_status='3') AND EXISTS (SELECT * FROM client_payafter_admission".$_SESSION['dbNo']." WHERE cl.client_id = after_ad_client_id AND client_payafter_admission".$_SESSION['dbNo'].".after_ad_name='acknowlegment') AND NOT EXISTS (SELECT * FROM italy_clients_programs".$_SESSION['dbNo']." p WHERE p.italy_clients_id=cl.client_id AND (p.italy_dream_program1_status='Acceptance' OR  p.italy_dream_program2_status='Acceptance' OR p.italy_direct_program1_status='Acceptance' OR p.italy_direct_program2_status='Acceptance') AND p.italy_send_to_pre_proof!='')";
		}
		if ($visaProcess=='Pre-enrollment Assign to Processing Team Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') AND (cl.due_after_ad_status='1' || cl.due_after_ad_status='3') AND EXISTS ( SELECT * FROM client_payafter_admission".$_SESSION['dbNo']." WHERE cl.client_id = after_ad_client_id AND client_payafter_admission".$_SESSION['dbNo'].".after_ad_name='acknowlegment') AND EXISTS (SELECT 1 FROM italy_clients_programs".$_SESSION['dbNo']." p WHERE p.italy_clients_id=cl.client_id AND (p.italy_dream_program1_status='Acceptance' OR  p.italy_dream_program2_status='Acceptance' OR p.italy_direct_program1_status='Acceptance' OR p.italy_direct_program2_status='Acceptance') AND p.italy_send_to_pre_proof!='')";
		}
		if ($visaProcess=='WhatsApp Checklist Sent Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='DOV Cimea Checklist' || italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Visa Checklist' ) )";
		}
		if ($visaProcess=='WhatsApp Checklist Not Sent Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND NOT EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='DOV Cimea Checklist' || italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Visa Checklist' ) )";
		}
		if ($visaProcess=='Intro Message Not sent to Clients') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND NOT EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Intro Message' ) )";
		}
		if ($visaProcess=='Intro Message sent to Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Intro Message' ) )";
		}
		if ($visaProcess=='Scholarship Details not sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND NOT EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Scholarship Details') )";
		}
		if ($visaProcess=='Scholarship Details sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Scholarship Details') )";
		}
		if ($visaProcess=='Case History not sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND NOT EXISTS (SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_history_status!='') )";
		}
		if ($visaProcess=='Case History sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_history_status!='') )";
		}
		if ($visaProcess=='Case History sent & Received by Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_status='2') )";
		}
		if ($visaProcess=='Case History sent & Not Received by Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_status='1') )";
		}
		if ($visaProcess=='Case History Study has been Completed, and Client has been Guided' ) {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND  italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_history_status='".$visaProcess."') )";	
		}
		if ($visaProcess=='Educational Documents Attestation not sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND NOT EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND  italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Attestation') )";
		}
		if ($visaProcess=='Educational Documents Attestation sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Attestation') )";
		}
		if ($visaProcess=='Educational Documents Attestation by Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Attestation' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_status='Educational Documents Attestation by Client') )";
		}
		if ($visaProcess=='Documents Translate into the Italian Language not sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND NOT EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Translate') )";			
		}
		if ($visaProcess=='Documents Translate into the Italian Language sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Translate') )";
		}
		if ($visaProcess=='Documents Translate into the Italian Language by Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Translate' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_status='Documents Translate into the Italian Language by Client') )";
		}
		if ($visaProcess=='After Admission Dues are Acknowledged by Client, Now send the Italian Lawyers details') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND NOT EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Translate') ) AND EXISTS ( SELECT * FROM client_payafter_admission".$_SESSION['dbNo']." WHERE cl.client_id = after_ad_client_id AND (client_payafter_admission".$_SESSION['dbNo'].".close='1' AND client_payafter_admission".$_SESSION['dbNo'].".after_ad_name='acknowlegment') )";
		}

		if ($visaProcess=='Hotel, Ticket, Travel Insurance Guidelines Not Sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND NOT EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Hotel Booking & Ticket Reservation') )";			
		}
		if ($visaProcess=='Hotel, Ticket, Travel Insurance Guidelines Sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Hotel Booking & Ticket Reservation') )";
		}

		if ($visaProcess=='Book Visa Appointment link not sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND NOT EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status!='') )";
		}
		if ($visaProcess=='Book Visa Appointment link sent Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status!='') )";
		}
		if ($visaProcess=='Book Visa Appointment link sent to Client' || $visaProcess=='Visa Appointment Booked By Client' || $visaProcess=='Visa Submitted By Client' || $visaProcess=='Visa Accepted' || $visaProcess=='Visa Rejected') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status='".$visaProcess."' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".status='1') )";
		}
		if ($visaProcess=='After Visa Due not Clear Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status='Visa Accepted' AND cl.due_after_visa_paid_file='') )";
		}
		if ($visaProcess=='After Visa Due Clear Clients') {
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_process_status!='Only Admission Process' AND EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status='Visa Accepted' AND cl.due_after_visa_paid_file!='') )";
		}
	}
	// Admission Pre Enrollment Status
	if ($preProcess!="all") {
		if($preProcess=='Applications Rechecked by Clients and Submit by Team'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='5') AND icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0'";
		}
		if($preProcess=='Admission Application Submitted by Processing Team'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='6') AND icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0'";
		}
		if($preProcess=='Sent Admission Applied Proof to Client'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_proof_screenshot!='') AND icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0'";
		}
		if ($preProcess=='Waiting for Admission decision') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_info_client_status='1' AND icp.italy_pre_applied_status='6') AND icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0'";
		}
		if($preProcess=='Acceptance and Summary Letter Received Clients'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_program1_status='Acceptance' || icp.italy_pre_summary_status='Received') AND icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0'";
		}
		if($preProcess=='University Admission and Summary Rejected Clients'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_program1_status='Rejection' || icp.italy_pre_summary_status='Rejection') AND icp.italy_assign_status='1' AND icp.italy_pre_assign_to='0'";
		}
	}
	
	// Self and WSL Acceptance Pre Enrollment Status
	if ($preAcceptProcess!="all") {
		if($preAcceptProcess=='New Pre Enrollment Assign to Processing Team Clients'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_pre_assign_to!='0' AND icp.italy_pre_applied_status='0' ";
		}
		if($preAcceptProcess=='Applications Rechecked by Clients and Submit by Team'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='5') AND icp.italy_pre_assign_to!='0' ";
		}
		if($preAcceptProcess=='Admission Application Submitted by Processing Team'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='6') AND icp.italy_pre_assign_to!='0' ";
		}
		if($preAcceptProcess=='Sent Admission Applied Proof to Client'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_proof_screenshot!='') AND icp.italy_pre_assign_to!='0' ";
		}
		if ($preAcceptProcess=='Waiting for Admission decision') {
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_pre_info_client_status='1' AND icp.italy_pre_applied_status='6') AND icp.italy_pre_assign_to!='0' ";
		}
		if($preAcceptProcess=='Summary Letter Received Clients'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_pre_summary_status='Received' AND icp.italy_pre_assign_to!='0' ";
		}
		if($preAcceptProcess=='Summary Letter Rejected Clients'){
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_pre_summary_status='Rejection' AND icp.italy_pre_assign_to!='0' ";
		}
	}

	if($summaryDate!=""){
		$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_pre_assign_to!='0' AND (icp.italy_pre_summary_status='Received' AND icp.italy_pre_summary_date='".$summaryDate."' ) ";
	}

	// CEnT-S test
	if ($CEnTSProcess!="all") {
		if ($CEnTSProcess=='Inform the Client to Recheck the CEnT-S Application' || $CEnTSProcess=='CEnT-S Applications Sent to the client for Rechecking' || $CEnTSProcess=='CEnT-S Test Date Clients' || $CEnTSProcess=='CEnT-S Test Fee Paid Clients' || $CEnTSProcess=='Sent Practice CEnT-S Test Video') {
			if($CEnTSProcess=='Inform the Client to Recheck the CEnT-S Application'){
				$tolcInfo='0';
				$tolcApplied='3';
			}
			if($CEnTSProcess=='CEnT-S Applications Sent to the client for Rechecking'){
				$tolcInfo='1';
				$tolcApplied='3';
			}
			if($CEnTSProcess=='CEnT-S Test Date Clients'){
				$tolcInfo='2';
				$tolcApplied='3';
			}
			if($CEnTSProcess=='CEnT-S Test Fee Paid Clients'){
				$tolcInfo='3';
				$tolcApplied='3';
			}
			if($CEnTSProcess=='Sent Practice CEnT-S Test Video'){
				$tolcInfo='4';
				$tolcApplied='3';
			}
			$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_tolc_info_status='".$tolcInfo."' AND icp.italy_tolc_applied_status='".$tolcApplied."') AND icp.italy_assign_status='1' ";
		}
		if($CEnTSProcess=='CEnT-S Test Pass Clients' || $CEnTSProcess=='CEnT-S Test Fail Clients'){
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_assign_status='1' AND icp.italy_tolc_pass_screenshot!='' ";
		}
		if($CEnTSProcess=='CEnT-S Test Fail Clients'){
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_assign_status='1' AND icp.italy_tolc_fail_screenshot!='' ";
		}
	}
	if ($universityStatus!="all") {
		$whereCondition .= " AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_university_name='".$universityStatus."' ";
	}
	if ($otherStatus!="all" ) {
		if($otherStatus=='Pre Enrollment Clients with more than 1 University'){
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_direct_pre='1' AND italy_clients_id IN ( SELECT italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND italy_direct_pre='1' GROUP BY italy_clients_id HAVING COUNT(*) > 1 )";
		}
		if($otherStatus=='Campania Client with 2 Programs'){
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_university_name='University of Campania (UC)' AND icp.italy_client_degree='bachelor' AND (icp.italy_program_name='1. Data Analytics 2. Nursing' || icp.italy_program_name='1. Data Analysis 2. Nursing')";
		}
		if($otherStatus=='Pre Enrollment Proof Not Upload'){
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.client_id IN (SELECT italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." GROUP BY italy_clients_id HAVING SUM(italy_send_to_pre_proof='')>0 AND SUM(italy_send_to_pre_proof!='')=0) ";
		}
		if($otherStatus=='Acceptance Letter Received but Not Assign Pre Enrollment'){
			$whereCondition .= "AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') AND cl.client_id IN (SELECT italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." GROUP BY italy_clients_id HAVING SUM(italy_send_to_pre_proof='' || italy_pre_assign_to='0')>0 AND SUM(italy_send_to_pre_proof!='' || italy_pre_assign_to!='0')=0) ";
		}
	}
	if ($assignAgent!="all") {
		if($assignAgent=='WhatsApp Agent Not Assign'){
			$whereCondition .= " AND cl.country_agent_assign_to='' ";
		}
		if($assignAgent=='WhatsApp Agent Assign'){
			$whereCondition .= " AND cl.country_agent_assign_to!='' ";
		}
		if($assignAgent!='WhatsApp Agent Not Assign' && $assignAgent!='WhatsApp Agent Assign'){
			$whereCondition .= " AND cl.country_agent_assign_to='".$assignAgent."' ";
		}
	}
	if ($startDate != "" && $endDate != "") {
		$whereCondition .= " AND cl.client_document_date BETWEEN '".$startDate."' AND '".$endDate."'";
	}
	?>
	<?php include ("../components/AllQueries.php"); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info">
				<?php if($clientStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $clientStatus;?></h5>
				<?php }elseif($clientCountry!='all'){ ?>
				<h5>All Clients >> <?php echo $clientCountry;?></h5>
				<?php }elseif($clientDegree!='all'){ ?>
				<h5>All Clients >> <?php echo $clientDegree;?></h5>
				<?php }elseif($assignPrograms!='all'){ ?>
				<h5>All Clients >> <?php echo $assignPrograms;?></h5>
				<?php }elseif($appliedPrograms!='all'){ ?>
				<h5>All Clients >> <?php echo $appliedPrograms;?></h5>
				<?php }elseif($checkApplication!='all'){ ?>
				<h5>All Clients >> <?php echo $checkApplication;?></h5>
				<?php }elseif($checklistStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $checklistStatus;?></h5>
				<?php }elseif($sopStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $sopStatus;?></h5>
				<?php }elseif($visaProcess!='all'){ ?>
				<h5>All Clients >> <?php echo $visaProcess;?></h5>
				<?php }elseif($embassyStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $embassyStatus;?></h5>
				<?php }elseif($intakeYear!='all'){ ?>
				<h5>All Clients >> <?php echo $intakeYear;?></h5>
				<?php }elseif($processStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $processStatus;?></h5>
				<?php }elseif($preProcess!='all'){ ?>
				<h5>All Clients >> <?php echo $preProcess;?></h5>
				<?php }elseif($CEnTSProcess!='all'){ ?>
				<h5>All Clients >> <?php echo $CEnTSProcess;?></h5>
				<?php }elseif($ieltsStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $ieltsStatus;?></h5>
				<?php }elseif($otherStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $otherStatus;?></h5>
				<?php }else{ ?>
				<h5>All Clients</h5>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 20px;">Sr</th>
					<th style="width: 120px;">ID / Date</th>
					<th style="width: 220px;">Client Info</th>
					<th style="width: 100px;">Degree</th>
					<th style="width: 100px;" data-toggle="tooltip" data-placement="top" title="Payment in Advance">PIA</th>
					<th style="width: 220px;">Admission Status</th>
					<th style="width: 150px;">Visa Status</th>
					<th style="width: 100px;">Track</th>
				</tr>
			</thead>
			<tbody>
			<?php
			// $sr = mysqli_num_rows($clientData_ex);
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex)) {
				$clientID = $row['client_id'];
				$changingApplied = $row['client_applied'];
				$appliedChanging = json_decode($changingApplied, true);
				$getUrl = base64_encode($row['client_name']."".$row['client_email']);
				?>
				<?php include ("../components/PIAQueries.php");?>
				<?php 
				if($clientID=='102' || $clientID=='118' || $clientID=='211' || $clientID=='262' || $clientID=='301' || $clientID=='311' || $clientID=='343' || $clientID=='344' || $clientID=='347' || $clientID=='398' || $clientID=='440' || $clientID=='352'){
					$btnStyleTr = 'background-color: #d1d1ff;';
				}else{
					$btnStyleTr = '';
				}
				?>
				<tr id="<?php echo $row['client_id'];?>" style="<?php echo $btnStyleTr;?>">
					<td><?php echo $sr;?></td>
					<td>
						<?php include ("../components/IDDateTd.php");?>
					</td>
					<td class="breakTD">
						<b><?php echo ucwords($row['client_name']);?> </b> <br><a href="https://web.whatsapp.com/send?phone=+<?php echo $row['client_whatapp'];?>" target="_blank"><?php echo $row['client_whatapp']; ?></a> <br><?php echo $row['client_email'];?>
						<br>
						<?php if ($row['client_convert_status']=='New Client') {
							echo "<b class='text-success'>New Client</b>";
						}elseif ($row['client_convert_status']=='Old Client') {
							echo "<b class='text-info'>Old Client</b>";
						}elseif($row['client_convert_status']=='Old Converted Client'){
							echo "<b class='text-warning'>Old Converted Client</b>";
						}elseif ($row['client_convert_status']=='Italy Old Client 2024') {
							echo "<b class='text-info'>Italy Old Client 2024</b>";
						}elseif($row['client_convert_status']=='Austria Converted Client'){
							echo "<b class='text-warning'>Austria Converted Client</b>";
						} ?>
					</td>
					<td class="breakTD">
						<?php include ("../components/DegreeEmbassyTd.php");?>
					</td>
					<input type="hidden" name="" value="<?php echo $appRow;?>" id="appliedDegree">
					<td>
						<?php include ("../components/PIATd.php");?>
					</td>
					<td class="breakTD">
						<?php 
						$query = "SELECT note_admission, head_personal_note FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$row['client_id']."' ";
						$docRow = mysqli_fetch_assoc(mysqli_query($con, $query));
						$buttonAdClass = $docRow['note_admission'] != '' ? 'btn-success' : 'btn-outline-primary';
						$buttonPersonalClass = $docRow['head_personal_note'] != '' ? 'btn-success' : 'btn-outline-dark';
						?>
						<button type="button" class="btn <?php echo $buttonAdClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Document Collection Report" onclick="docAdmissionNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>
						<button type="button" class="btn <?php echo $buttonPersonalClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Your Personal Note" onclick="personalNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-p-box"></i> </button>

						<?php if($checkApplication=='Inform the Client to Recheck the Application' || $checkApplication=='Applications Sent to the client for Rechecking' || $checkApplication=='Client Requests Changes in the Application' || $checkApplication=='Changes Complete By Processing Team' || $checkApplication=='Application Approved by the Client' || $checkApplication=='Client Informed, How to Pay the Application Fee' || $checkApplication=='Application Fee Paid by Client' || $checkApplication=='Admission Application Submitted by Processing Team' || $checkApplication=='Sent Admission Applied Proof to Client' || $checkApplication=='Waiting for Admission decision' || $checkApplication=='Acceptance Letter Received Clients' || $checkApplication=='University Admission Rejected Clients' || $visaProcess=='After Admission Dues Clear Clients' || $visaProcess=='After Admission Dues Not Clear Clients' || $checkApplication=='Additional Activities Required by University Clients Assign to Processing Team' || $checkApplication=='Additional Activities Required by University Task Complete by Processing Team' || $checkApplication=='Deadline Hold' || $checkApplication=='Deadline Release'){ ?>
							<br>
							<button style="width: 100px;" <?= $sumBalance=='0' ? '' : 'disabled';?> type="button" class="btn <?php echo ($row['country_agent_assign_to']!='') ? 'btn-success' : 'btn-outline-danger'; ?> btn-sm text-truncate mt-2" data-toggle="tooltip" data-placement="top" title="<?php echo ($row['country_agent_assign_to']!='') ? ("WhatsApp Agent"."<br>".ucwords($row['country_agent_assign_to'])."<br>".$row['country_agent_assign_date']) : 'Assign Client To Admission WhatsApp Agent'; ?>" onclick="assignAgentCleints(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-a-circle"></i> <?php echo ($row['country_agent_assign_to']!='') ? ucwords($row['country_agent_assign_to']) : 'Assign'; ?> </button>
							<?php
								$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
								$result = mysqli_query($con, $query);
								$data = mysqli_fetch_array($result);
								$totalNo = $data['totalAssign'];
								$assignedNo = $data['assignedNo'];
								if($totalNo == $assignedNo){ ?>
									<a <?= $sumBalance=='0' ? '' : 'disabled';?> href="apply-programs?client-id=<?php echo $clientID;?>&&url=<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> A. Status </button> </a>
								<?php } else{ ?>
									<a href="apply-programs?client-id=<?php echo $clientID;?>&url=<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> A. Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
								<?php } 
							?>
						<?php }else{ ?>

							<?php if ($sumBalance=='0') {
								$query = "SELECT COUNT(italy_assign_status) AS totalAssign,SUM(CASE WHEN italy_assign_status='1' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_clients_id='".$clientID."' ";
								$result = mysqli_query($con, $query);
								$data = mysqli_fetch_array($result);
								$totalNo = $data['totalAssign'];
								$assignedNo = $data['assignedNo'];
								if($totalNo == $assignedNo){
								?>
								<a <?= $sumBalance=='0' ? '' : 'disabled';?> href="assign-programs?client-id=<?php echo $clientID;?>&&url=<?php echo $getUrl;?>&university-name=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> A. Program</button> </a>
								<?php 
								}elseif($assignedNo > 0 ){ ?>
								<a <?= $sumBalance=='0' ? '' : 'disabled';?> href="assign-programs?client-id=<?php echo $clientID;?>&&url=<?php echo $getUrl;?>&university-name=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span> A. Program</button> </a>
								<?php
								}else{
								?>
								<a <?= $sumBalance=='0' ? '' : 'disabled';?> href="assign-programs?client-id=<?php echo $clientID;?>&&url=<?php echo $getUrl;?>&university-name=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A. Program</button> </a>
								<?php
								}
							?>
							<?php }else{ ?>
								<a href="assign-programs?client-id=<?php echo $clientID;?>&&url=<?php echo $getUrl;?>&university-name=all"><button type="button" disabled class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A. Program</button> </a>
							<?php } ?>
							<br>
							<button style="width: 100px;" <?= $sumBalance=='0' ? '' : 'disabled';?> type="button" class="btn <?php echo ($row['country_agent_assign_to']!='') ? 'btn-success' : 'btn-outline-danger'; ?> btn-sm text-truncate mt-2" data-toggle="tooltip" data-placement="top" title="<?php echo ($row['country_agent_assign_to']!='') ? ("WhatsApp Agent"."<br>".ucwords($row['country_agent_assign_to'])."<br>".$row['country_agent_assign_date']) : 'Assign Client To Admission WhatsApp Agent'; ?>" onclick="assignAgentCleints(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-a-circle"></i> <?php echo ($row['country_agent_assign_to']!='') ? ucwords($row['country_agent_assign_to']) : 'Assign'; ?> </button>
							<?php
								$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='6' || italy_direct_info_client_status='6' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
								$result = mysqli_query($con, $query);
								$data = mysqli_fetch_array($result);
								$totalNo = $data['totalAssign'];
								$assignedNo = $data['assignedNo'];
								if($totalNo == $assignedNo){ ?>
									<a href="apply-programs?client-id=<?php echo $clientID;?>&&url=<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> A. Status </button> </a>
								<?php
								}
								else{ ?>
									<a href="apply-programs?client-id=<?php echo $clientID;?>&&url=<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> A. Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
								<?php
								}
							?>
						<?php } ?>
						
						<?php
						$query="SELECT italy_applied_status, italy_direct_applied_status, italy_pre_applied_status, italy_tolc_applied_status, italy_cimea_applied_status, italy_program_assign_date FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
						$result_ex = mysqli_query($con, $query);
						foreach ($result_ex as $italPro) {
							$assignDate = $italPro['italy_program_assign_date'];

							if ($assignDate!='0000-00-00') {
								$date2 = date('Y-m-d');
								$timestamp_assignDate = strtotime($assignDate);
								$timestamp_date2 = strtotime($date2);
								$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
								$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
								// echo $daysAssign_diff;
								if ($daysAssign_diff >= 1 && ($italPro['italy_applied_status']=='0' && $italPro['italy_direct_applied_status']=='0' &&  $italPro['italy_pre_applied_status']=='0' && $italPro['italy_tolc_applied_status']=='0' && $italPro['italy_cimea_applied_status']=='0') ) { ?>
								<br>
								<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
								<?php }
							}
						}
						?>
						<br>
						<?php 
						$btnSelf=$row['client_self_acceptance_file']!='' ? 'btn-success' : 'btn-outline-pink';
						?>
						<button type="button" class="btn <?php echo $btnSelf;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Self Received Acceptance" onclick="selfAcceptance(<?= $row['client_id'];?>);"><i class="mdi mdi-clipboard-text"></i> Self Rece. Acceptance</button>
						<?php if($appRow=='mbbs'){ ?>
						<br>
						<a href="imat-registration?client-id=<?php echo $clientID;?>&&url=<?php echo $getUrl;?>"><button type="button" class="btn btn-outline-info btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="IMAT Registration"><i class="mdi mdi-clipboard-text"></i> IMAT Registration</button> </a>
						<?php } ?>
					</td>
					
					<td>
						<?php include ("../components/VisaStepsTd.php");?>
					</td>
					<td>
						<?php include ("../components/ViewActionTd.php");?>
					</td>
				</tr>
			<?php
			$sr--;
			}?>
			</tbody>
		</table>
		<script type="text/javascript">
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip({ html: true });
				if ($.fn.DataTable.isDataTable("#datatable")) {
					// Destroy the existing DataTable instance
					$('#datatable').DataTable().destroy();
				}
				$("#datatable").DataTable({
					paging: false,
					searching: false,
					info: false,
					lengthChange: false,
					order: [[0, 'desc']],
				});
			});
		</script>
	</div>
	<?php include ('../components/TablePagination.php'); ?>

<?php
}
?>