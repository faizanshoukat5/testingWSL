<?php 
	if ($clientStatus!="all") {
		$whereCondition .= " AND cl.client_convert_status='".$clientStatus."' ";
	}
	if ($clientCountry != "all") {
		if($clientCountry=='Pakistan' || $clientCountry=='UAE' || $clientCountry=='Qatar'){
			$whereCondition .= " AND cl.client_countryfrom='".$clientCountry."'";
		}
		if($clientCountry=='Saudi Arabia'){
			$whereCondition .= " AND (cl.client_countryfrom='Saudi Arabia' || cl.client_countryfrom='saudi Arabia' || cl.client_countryfrom='saudi arabia') ";
		}
		if($clientCountry=='Other Country'){
			$whereCondition .= " AND cl.client_countryfrom!='Pakistan' AND cl.client_countryfrom!='UAE' AND cl.client_countryfrom!='Saudi Arabia' AND cl.client_countryfrom!='saudi arabia' AND cl.client_countryfrom!='saudi Arabia' AND cl.client_countryfrom!='Qatar'";
		}
	}
	if ($intakeYear!="all") {
		$whereCondition .= " AND cl.client_intake_year='".$intakeYear."' ";
	}
	if ($assignPrograms!="all") {
		if ($assignPrograms=='All Assign Programs') {
			$whereCondition .= " AND acp.aus_assign_status='1' ";
		}
		if ($assignPrograms=='All Not Assign Programs') {
			$whereCondition .= " AND cl.client_process_status!='Direct Visa' AND acp.aus_assign_status='0' ";
		}
		if ($assignPrograms=='Assign But Not Applied') {
			$whereCondition .= " AND acp.aus_direct_proof_screenshot='' AND acp.aus_assign_status='1'";
		}
		if ($assignPrograms=='Assign and Applied') {
			$whereCondition .= " AND acp.aus_direct_proof_screenshot!='' AND acp.aus_assign_status='1'";
		}
		if ($assignPrograms=='Assign but Not Paid Fee') {
			$whereCondition .= " AND acp.aus_direct_fee_paid='' AND acp.aus_assign_status='1'";
		}
		if ($assignPrograms=='Fee Paid but Not Applied') {
			$whereCondition .= " AND aus_direct_fee_paid!='' AND acp.aus_direct_proof_screenshot='' AND acp.aus_assign_status='1' ";
		}
		if ($assignPrograms=='One Time Account Create') {
			$whereCondition .= " AND acp.aus_direct_username!='' AND acp.aus_direct_applied_screenshot='' AND acp.aus_assign_status='1'";
		}
	}

	if ($deadlineStatus!="all") {
		if ($deadlineStatus=='Deadline Hold') {
			$whereCondition .= " AND acp.aus_deadline_hold_status='1'  ";
		}
		if($deadlineStatus=='Deadline Release'){
			$whereCondition .= " AND acp.aus_deadline_hold_status='2'  ";
		}
	}

	// sop status
	if ($sopStatus!="all") {
		if ($sopStatus=='Sops Assign Clients') {
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND (acp.aus_sops_assign_to!='0' || acp.aus_sops_status='4') ";
		}
		if ($sopStatus == 'SOPs Not Assign Clients') {
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.client_process_status!='Direct Visa' AND acp.aus_sops_assign_to='0' AND acp.aus_sops_status !='4' AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_change_program_status='0' AND EXISTS (SELECT 1 FROM austria_add_programs_details{$_SESSION['dbNo']} AS aapd WHERE aapd.status='1' AND aapd.close='1' AND aapd.aus_ad_sop_required='1' AND aapd.aus_ad_uni_name=acp.aus_university_name AND aapd.aus_ad_degree=acp.aus_client_degree AND JSON_CONTAINS(acp.aus_program_name, JSON_QUOTE(aapd.aus_ad_program_name))) ";
		}
		if ($sopStatus=='SOPs Received Clients') {
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_sops_status='4' ";
		}
	}

	if ($startStatus!='all' && $endStatus!='all') {
		$whereCondition .= " AND acp.aus_program_assign_date BETWEEN '".$startStatus."' AND '".$endStatus."' ";
	}
	if ($admissionDue!="all") {
		if ($admissionDue=='After Verification Dues Clear Clients') {
			$whereCondition .= " AND (acp.aus_direct_program1_status='Acceptance' || acp.aus_direct_program2_status='Acceptance') AND (cl.due_after_ad_info_file!='')  ";
		}
		if($admissionDue == "After Verification Dues Remaining Clients"){
			$whereCondition .= " AND (acp.aus_direct_program1_status='Acceptance' OR acp.aus_direct_program2_status='Acceptance') OR cl.due_after_ad_status='2'";
		}
		if ($admissionDue=='After Verification Dues Not Clear Clients') {
			$whereCondition .= " AND (acp.aus_direct_program1_status='Acceptance' || acp.aus_direct_program2_status='Acceptance') AND cl.due_after_ad_info_file='' ";
		}
		if ($admissionDue=='Advance Remaining Payment Not Clear Clients') {
			$whereCondition .= " AND cl.sale_commission='0' AND (cl.client_pay_remaining_status='0' || cl.client_pay_remaining_status='2') ";
		}
	}

	if ($assignDate!="") {
		$whereCondition .= " AND acp.aus_program_assign_date='".$assignDate."' AND acp.aus_assign_status='1' ";
	}
	if ($cvStatus!="all") {
		if($cvStatus=='Europass CV Uploaded Clients'){
			$whereCondition .= " AND EXISTS ( SELECT * FROM client_addmission_doc".$_SESSION['dbNo']." WHERE cl.client_id = admission_client_id AND (client_addmission_doc".$_SESSION['dbNo'].".admission_doc36!='' ) ) ";
		}
		if($cvStatus=='Europass CV Not Uploaded Clients'){
			$whereCondition .= " AND EXISTS ( SELECT * FROM client_addmission_doc".$_SESSION['dbNo']." WHERE cl.client_id = admission_client_id AND (client_addmission_doc".$_SESSION['dbNo'].".admission_doc36='' ) ) ";
		}
	}
	// Check Application status Filter
	if ($checkApplication != "all") {
		if ($checkApplication == "Admission Application Form Fill") {
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status='1' AND acp.aus_direct_applied_status='4' ";
		}
		elseif($checkApplication == "Admission Application Submitted"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status='1' AND acp.aus_direct_applied_status='5' ";
		}
		elseif($checkApplication == "Sent Admission Applied Proof to Client"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status='1' AND acp.aus_direct_applied_status='6' ";
		}
		elseif($checkApplication == "Inform to Client to Pay Application Fee"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status='1' AND acp.aus_direct_applied_status='7' ";
		}
		elseif($checkApplication == "Application Fee Paid By Client"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status='1' AND acp.aus_direct_applied_status='8' ";
		}
		elseif($checkApplication == "Waiting for Admission decision"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status='1' AND acp.aus_direct_applied_status='9' ";
		}
		elseif($checkApplication == "Acceptance Letter Received Clients"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status='1' AND (acp.aus_direct_program1_status='Acceptance' || acp.aus_direct_program2_status='Acceptance') ";
		}
		elseif($checkApplication == "University Admission Rejected Clients"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status='1' AND (acp.aus_direct_program1_status='Rejection' || acp.aus_direct_program2_status='Rejection')";
		}
		elseif($checkApplication == "Additional Activities Required by University"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_additional_activities_status='1' ";
		}
		elseif($checkApplication == "Additional Activities Required Task Completed"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_additional_activities_status='2' ";
		}
		elseif($checkApplication == "Self Received Acceptance"){
			$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.client_self_acceptance_file!='' ";
		}
	}
	if ($assignTo!='all') {
		$whereCondition .= " AND acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_program_assign='".$assignTo."' ";
	}
?>