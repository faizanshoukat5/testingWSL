<?php 
	if ($assignAgent!="all") {
		$whereCondition .= " AND cl.country_agent_assign_to='".$assignAgent."' ";
	}
	if ($clientStatus!="all") {
		$whereCondition .= " AND cl.client_convert_status='".$clientStatus."' ";
	}
	if ($clientCountry != "all") {
		if($clientCountry=='Pakistan' || $clientCountry=='UAE'){
			$whereCondition .= " AND cl.client_countryfrom='".$clientCountry."'";
		}
		if($clientCountry=='Other Country'){
			$whereCondition .= " AND cl.client_countryfrom!='Pakistan' AND cl.client_countryfrom!='UAE'";
		}
	}
	if ($intakeYear!="all") {
		$whereCondition .= " AND cl.client_intake_year='".$intakeYear."' ";
	}
	if ($admissionDue!="all") {
		if ($admissionDue=='After Admission Dues Clear Clients') {
			$whereCondition .= " AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') AND (cl.due_after_ad_info_file!='' || cl.due_after_ad_paid_file!='')  ";
		}
		if ($admissionDue=='After Admission Dues Not Clear Clients') {
			$whereCondition .= " AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') AND (cl.due_after_ad_info_file='' || cl.due_after_ad_paid_file='')  ";
		}
		if ($admissionDue=='Advance Remaining Payment Not Clear Clients') {
			$whereCondition .= " AND cl.sale_commission='0' AND (cl.client_pay_remaining_status='0' || cl.client_pay_remaining_status='2') ";
		}
	}

	if ($deadlineStatus!="all") {
		if ($deadlineStatus=='Deadline Hold') {
			$whereCondition .= " AND icp.italy_deadline_hold_status='1'  ";
		}
		if($deadlineStatus=='Deadline Release'){
			$whereCondition .= " AND icp.italy_deadline_hold_status='2'  ";
		}
	}


	if ($startStatus!='all' && $endStatus!='all') {
		$whereCondition .= " AND icp.italy_program_assign_date BETWEEN '".$startStatus."' AND '".$endStatus."' ";
	}
	if ($ieltsStatus!="all") {
		if($ieltsStatus=='IELTS Yes' || $ieltsStatus=='IELTS No' || $ieltsStatus=='PTE'){
			$whereCondition .= " AND cl.client_ielts_pte='".$ieltsStatus."' ";
		}
		if($ieltsStatus=='IELTS Not Selected'){
			$whereCondition .= " AND cl.client_ielts_pte='' ";
		}
	}
	if ($assignDate!="") {
		$whereCondition .= " AND icp.italy_program_assign_date='".$assignDate."' AND icp.italy_assign_status='1' ";
	}
	if ($cvStatus!="all") {
		if($cvStatus=='Europass CV Uploaded Clients'){
			$whereCondition .= " AND EXISTS ( SELECT * FROM client_addmission_doc".$_SESSION['dbNo']." WHERE cl.client_id = admission_client_id AND (client_addmission_doc".$_SESSION['dbNo'].".admission_doc36!='' ) ) ";
		}
		if($cvStatus=='Europass CV Not Uploaded Clients'){
			$whereCondition .= " AND EXISTS ( SELECT * FROM client_addmission_doc".$_SESSION['dbNo']." WHERE cl.client_id = admission_client_id AND (client_addmission_doc".$_SESSION['dbNo'].".admission_doc36='' ) ) ";
		}
	}
	// Admission Application status
	if ($checkApplication!="all" ) {
		if ($checkApplication=='Advance Remaining Payment Not Clear Clients') {
			$whereCondition .= "AND cl.sale_commission='0' AND (cl.client_pay_remaining_status='0' || cl.client_pay_remaining_status='2') ";
		}
		if ($checkApplication=='Self Received Acceptance') {
			$whereCondition .= " AND cl.client_self_acceptance_file!='' ";
		}
		if ($checkApplication=='Inform the Client to Recheck the Application') {
			$whereCondition .= " AND ((icp.italy_info_client_status='0' AND icp.italy_applied_status='5') || (icp.italy_direct_info_client_status='0' AND icp.italy_direct_applied_status='5') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Applications Sent to the client for Rechecking'){
			$whereCondition .= " AND ((icp.italy_info_client_status='1' AND icp.italy_applied_status='5') || (icp.italy_direct_info_client_status='1' AND icp.italy_direct_applied_status='5') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Client Requests Changes in the Application'){
			$whereCondition .= " AND ((icp.italy_info_client_status='2' AND icp.italy_applied_status='5') || (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='5') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Changes Complete By Processing Team'){
			$whereCondition .= " AND ((icp.italy_info_client_status='2' AND icp.italy_applied_status='6') || (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='6') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Client Informed, How to Pay the Application Fee'){
			$whereCondition .= " AND ((icp.italy_info_client_status='4' AND (icp.italy_applied_status='5' || icp.italy_applied_status='6')) || (icp.italy_direct_info_client_status='4' AND (icp.italy_direct_applied_status='6' || icp.italy_direct_applied_status='5')) ) AND icp.italy_assign_status='1' ";
			$clientData_ex = mysqli_query($con,$clientData);
		}
		if($checkApplication=='Application Approved And Application Fee Paid by Client'){
			$whereCondition .= " AND ((icp.italy_info_client_status='5' AND (icp.italy_applied_status='5' || icp.italy_applied_status='6')) || (icp.italy_direct_info_client_status='5' AND (icp.italy_direct_applied_status='6' || icp.italy_direct_applied_status='5'))) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Admission Application Submitted by Processing Team'){
			$whereCondition .= " AND ((icp.italy_info_client_status='5' AND icp.italy_applied_status='7') || (icp.italy_direct_info_client_status='5' AND icp.italy_direct_applied_status='7') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Sent Admission Applied Proof to Client'){
			$whereCondition .= " AND (icp.italy_proof_screenshot1!='' || icp.italy_direct_proof_screenshot!='') AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Inform to Processing Team to Fill Bergamo Enrollment Fee Form'){
			$whereCondition .= " AND (icp.italy_info_client_status='10' AND icp.italy_applied_status='10') AND icp.italy_assign_status='1'";
		}
		if($checkApplication=='Bergamo enrollment fee form was filled out by the processing team, but the client has not been informed yet to pay the application fee'){
			$whereCondition .= " AND (icp.italy_info_client_status='11' AND icp.italy_applied_status='11') AND icp.italy_assign_status='1'";
		}
		if($checkApplication=='Bergamo University clients who have not yet paid the enrollment fee'){
			$whereCondition .= " AND (icp.italy_info_client_status='12' AND icp.italy_applied_status='12') AND icp.italy_assign_status='1'";
		}
		if($checkApplication=='Additional Activities Required by University Clients Assign to Processing Team'){
			$whereCondition .= " AND icp.italy_additional_activities_status='1' ";
		}
		if($checkApplication=='Additional Activities Required by University Task Complete by Processing Team'){
			$whereCondition .= " AND icp.italy_additional_activities_status='2' ";
		}
		if ($checkApplication=='Deadline Hold') {
			$whereCondition .= " AND icp.italy_deadline_hold_status='1' ";
		}
		if ($checkApplication=='Deadline Release') {
			$whereCondition .= " AND icp.italy_deadline_hold_status='2' ";
		}
		if ($checkApplication=='Waiting for Admission decision') {
			$whereCondition .= " AND ((icp.italy_info_client_status='6' AND icp.italy_applied_status='7') || (icp.italy_direct_info_client_status='6' AND icp.italy_direct_applied_status='7') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='Acceptance Letter Received Clients'){
			$whereCondition .= " AND ((icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance') ||( icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') ) AND icp.italy_assign_status='1' ";
		}
		if($checkApplication=='University Admission Rejected Clients'){
			$whereCondition .= " AND ((icp.italy_dream_program1_status='Rejection' || icp.italy_dream_program2_status='Rejection') ||( icp.italy_direct_program1_status='Rejection' || icp.italy_direct_program2_status='Rejection')) AND icp.italy_assign_status='1' ";
		}
	}
	// visa processing steps
	if ($visaProcess!="all") {
		if ($visaProcess=='After Admission Dues Clear Clients') {
			$whereCondition .= " AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance' || icp.italy_pre_program1_status='Acceptance' || icp.italy_pre_program2_status='Acceptance') AND (cl.due_after_ad_status='1' || cl.due_after_ad_status='3') ";
		}
		if ($visaProcess=='After Admission Dues Remaining Clients') {
			$whereCondition .= " AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance' || icp.italy_pre_program1_status='Acceptance' || icp.italy_pre_program2_status='Acceptance') AND cl.due_after_ad_status='2' ";
		}
		if ($visaProcess=='After Admission Dues Not Clear Clients') {
			$whereCondition .= " AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance' || icp.italy_pre_program1_status='Acceptance' || icp.italy_pre_program2_status='Acceptance') AND cl.due_after_ad_status='0' ";
		}
		if ($visaProcess=='After Admission Dues are Acknowledged by Client, Now Assign Pre-enrollment to Processing Team') {
			$whereCondition .= " AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') AND (cl.due_after_ad_status='1' || cl.due_after_ad_status='3') AND icp.italy_send_to_pre_proof='' AND EXISTS ( SELECT * FROM client_payafter_admission".$_SESSION['dbNo']." WHERE cl.client_id = after_ad_client_id AND client_payafter_admission".$_SESSION['dbNo'].".after_ad_name='acknowlegment' )";
		}
		if ($visaProcess=='Pre-enrollment Assign to Processing Team Clients') {
			$whereCondition .= " AND (icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance' || icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') AND (cl.due_after_ad_status='1' || cl.due_after_ad_status='3') AND icp.italy_send_to_pre_proof!='' AND EXISTS ( SELECT * FROM client_payafter_admission".$_SESSION['dbNo']." WHERE cl.client_id = after_ad_client_id AND client_payafter_admission".$_SESSION['dbNo'].".after_ad_name='acknowlegment' )";
		}
		if ($visaProcess=='WhatsApp Checklist Sent Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='DOV Cimea Checklist' || italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Visa Checklist' ) )";
		}
		if ($visaProcess=='WhatsApp Checklist Not Sent Clients') {
			$whereCondition .= " AND NOT EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='DOV Cimea Checklist' || italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Visa Checklist' ) )";
		}
		if ($visaProcess=='Intro Message Not sent to Clients') {
			$whereCondition .= " AND NOT EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Intro Message' ) )";
		}
		if ($visaProcess=='Intro Message sent to Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Intro Message' ) )";
		}
		if ($visaProcess=='Scholarship Details not sent Clients') {
			$whereCondition .= " AND NOT EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Scholarship Details') )";
		}
		if ($visaProcess=='Scholarship Details sent Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE cl.client_id = visa_intro_checklist_client_id AND (italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_intro_checklist".$_SESSION['dbNo'].".visa_intro_checklist_steps_name='Scholarship Details') )";
		}
		if ($visaProcess=='Case History not sent Clients') {
			$whereCondition .= " AND NOT EXISTS ( SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_history_status!='') )";
		}
		if ($visaProcess=='Case History sent Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_history_status!='') )";
		}
		if ($visaProcess=='Case History sent & Received by Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND  italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_status='2') )";
		}
		if ($visaProcess=='Case History sent & Not Received by Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND  italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_status='1') )";
		}
		if ($visaProcess=='Case History Study has been Completed, and Client has been Guided' ) {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE cl.client_id = visa_case_history_client_id AND (italy_clients_visa_case_history".$_SESSION['dbNo'].".close='1' AND  italy_clients_visa_case_history".$_SESSION['dbNo'].".visa_case_history_status='".$visaProcess."') )";	
		}
		if ($visaProcess=='Educational Documents Attestation not sent Clients') {
			$whereCondition .= " AND NOT EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND  italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Attestation') )";
		}
		if ($visaProcess=='Educational Documents Attestation sent Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Attestation') )";
		}
		if ($visaProcess=='Educational Documents Attestation by Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Attestation' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_status='Educational Documents Attestation by Client') )";
		}
		if ($visaProcess=='Documents Translate into the Italian Language not sent Clients') {
			$whereCondition .= " AND NOT EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Translate') )";			
		}
		if ($visaProcess=='Documents Translate into the Italian Language sent Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Translate') )";
		}
		if ($visaProcess=='Documents Translate into the Italian Language by Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Translate' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_status='Documents Translate into the Italian Language by Client') )";
		}
		if ($visaProcess=='After Admission Dues are Acknowledged by Client, Now send the Italian Lawyers details') {
			$whereCondition .= " AND NOT EXISTS ( SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE cl.client_id = visa_attest_trans_client_id AND (italy_clients_visa_attest_trans".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_attest_trans".$_SESSION['dbNo'].".visa_attest_trans_step_name='Documents Translate') ) AND EXISTS ( SELECT * FROM client_payafter_admission WHERE cl.client_id = after_ad_client_id AND (client_payafter_admission.close='1' AND client_payafter_admission.after_ad_name='acknowlegment') )";
		}
		if ($visaProcess=='Book Visa Appointment link not sent Clients') {
			$whereCondition .= " AND NOT EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status!='') )";
		}
		if ($visaProcess=='Book Visa Appointment link sent Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status!='') )";
		}
		if ($visaProcess=='Book Visa Appointment link sent to Client' || $visaProcess=='Visa Appointment Booked By Client' || $visaProcess=='Visa Submitted By Client' || $visaProcess=='Visa Accepted' || $visaProcess=='Visa Rejected') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status='".$visaProcess."' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".status='1') )";
		}
		if ($visaProcess=='After Visa Due not Clear Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status='Visa Accepted' AND cl.due_after_visa_paid_file='') )";
		}
		if ($visaProcess=='After Visa Due Clear Clients') {
			$whereCondition .= " AND EXISTS ( SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE cl.client_id = visa_book_appoint_client_id AND (italy_clients_visa_book_appoint".$_SESSION['dbNo'].".close='1' AND italy_clients_visa_book_appoint".$_SESSION['dbNo'].".visa_book_appoint_status='Visa Accepted' AND cl.due_after_visa_paid_file!='') )";
		}
	}
	// Admission Pre Enrollment Status
	if ($preProcess!="all") {
		if ($preProcess=='Inform the Client to Recheck the Application') {
			$whereCondition .= " AND (icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='5') AND icp.italy_assign_status='1' ";
		}
		if($preProcess=='Applications Sent to the client for Rechecking'){
			$whereCondition .= " AND (icp.italy_pre_info_client_status='1' AND icp.italy_pre_applied_status='5') AND icp.italy_assign_status='1' ";
		}
		if($preProcess=='Client Requests Changes in the Application'){
			$whereCondition .= " AND (icp.italy_pre_info_client_status='2' AND icp.italy_pre_applied_status='5') AND icp.italy_assign_status='1' ";
		}
		if($preProcess=='Changes Complete By Processing Team'){
			$whereCondition .= " AND (icp.italy_pre_info_client_status='2' AND icp.italy_pre_applied_status='6') AND icp.italy_assign_status='1' ";
		}
		if($preProcess=='Application Approved And Application Fee Paid by Client'){
			$whereCondition .= " AND (icp.italy_pre_info_client_status='5' AND (icp.italy_pre_applied_status='5' || icp.italy_pre_applied_status='6') ) AND icp.italy_assign_status='1' ";
		}
		if($preProcess=='Admission Application Submitted by Processing Team'){
			$whereCondition .= " AND (icp.italy_pre_info_client_status='5' AND icp.italy_pre_applied_status='7') AND icp.italy_assign_status='1' ";
		}
		if($preProcess=='Sent Admission Applied Proof to Client'){
			$whereCondition .= " AND ( icp.italy_pre_proof_screenshot!='') AND icp.italy_assign_status='1' ";
		}
		if ($preProcess=='Waiting for Admission decision') {
			$whereCondition .= " AND (icp.italy_pre_info_client_status='6' AND icp.italy_pre_applied_status='7') AND icp.italy_assign_status='1' ";
		}
		if($preProcess=='Acceptance Letter Received Clients'){
			$whereCondition .= " AND ( icp.italy_pre_program1_status='Acceptance' || icp.italy_pre_summary_status='Received') AND icp.italy_assign_status='1' ";
		}
		if($preProcess=='University Admission Rejected Clients'){
			$whereCondition .= " AND (icp.italy_pre_program1_status='Rejection' || icp.italy_pre_summary_status='Rejection') AND icp.italy_assign_status='1' ";
		}
	}
	// CEnT-S test
	if ($CEnTSProcess!="all") {
		if ($CEnTSProcess=='Inform the Client to Recheck the CEnT-S Application' || $CEnTSProcess=='CEnT-S Applications Sent to the client for Rechecking' || $CEnTSProcess=='CEnT-S Test Date Clients' || $CEnTSProcess=='CEnT-S Test Fee Paid Clients' || $CEnTSProcess=='Sent Practice CEnT-S Test Video' || $CEnTSProcess=='CEnT-S Test Pass Clients' || $CEnTSProcess=='CEnT-S Test Fail Clients') {
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
			if($CEnTSProcess=='CEnT-S Test Pass Clients'){
				$tolcInfo='5';
				$tolcApplied='3';
			}
			if($CEnTSProcess=='CEnT-S Test Fail Clients'){
				$tolcInfo='6';
				$tolcApplied='3';
			}
			$whereCondition .= " AND (icp.italy_tolc_info_status='".$tolcInfo."' AND icp.italy_tolc_applied_status='".$tolcApplied."') AND icp.italy_assign_status='1' ";
		}
	}
?>