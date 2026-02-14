<?php 
if(isset($_POST['subSession'])){
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];

	$add_session_term = "INSERT INTO `session_year` (`start_date`, `end_date`, `close`, `status`) VALUES ('".$startDate."', '".$endDate."', '1', '1')";
	$add_session_term_ex = mysqli_query($con,$add_session_term);

	if ($add_session_term_ex) {
		$last_id = $con->insert_id;
		$current_table = $last_id-1;

		$sqlClients = "CREATE TABLE clients".$last_id."(
			client_id int(11) NOT NULL AUTO_INCREMENT,
			subject varchar(255) DEFAULT NULL,
			client_name varchar(255) NOT NULL,
			client_email text NOT NULL,
			client_whatapp varchar(50) NOT NULL,
			client_phone varchar(50) NOT NULL,
			client_cgpa varchar(50) NOT NULL,
			client_cgpa_note text NOT NULL,
			client_countryfrom varchar(255) NOT NULL,
			client_province varchar(255) NOT NULL,
			client_ielts_pte varchar(255) NOT NULL,
			client_score varchar(255) NOT NULL,
			client_process_status varchar(255) NOT NULL,
			client_convert_status varchar(255) NOT NULL,
			client_country varchar(255) NOT NULL,
			client_applied varchar(255) NOT NULL,
			client_embassy varchar(255) NOT NULL,
			client_agg_one text NOT NULL,
			client_agg_two text NOT NULL,
			client_agg_three text NOT NULL,
			packege_shot text NOT NULL,
			whatsapp_screenshot text NOT NULL,
			client_note text NOT NULL,
			client_case_status varchar(255) NOT NULL,
			sale_commission varchar(255) NOT NULL,
			program_status int(2) NOT NULL,
			admin_status int(2) NOT NULL,
			client_personal_note text NOT NULL,
			bank_pay_confirm text NOT NULL,
			bank_pay_confirm2 text NOT NULL,
			bank_pay_confirm3 text NOT NULL,
			bank_pay_status int(2) NOT NULL,
			ack_confirm_client text NOT NULL,
			ack_confirm_client2 text NOT NULL,
			ack_confirm_client3 text NOT NULL,
			ack_confirm_status int(2) NOT NULL,
			client_pro_confirm_status int(2) NOT NULL,
			client_pay_confirm_status int(2) NOT NULL,
			client_pay_remaining_status int(2) NOT NULL,
			client_pay_email_status int(2) NOT NULL,
			client_pay_clear_sale int(2) NOT NULL,
			client_document_status int(2) NOT NULL,
			client_document_date int(2) NOT NULL,
			client_case_name varchar(255) NOT NULL,
			client_case_date date NOT NULL,
			client_case_note text NOT NULL,
			client_case_screenshot text NOT NULL,
			case_status int(2) NOT NULL,
			change_country_date date NOT NULL,
			change_country_note text NOT NULL,
			change_country_screenshot text NOT NULL,
			change_status int(2) NOT NULL,
			due_after_ad_info_file text NOT NULL,
			due_after_ad_info_note text NOT NULL,
			due_after_ad_info_date date NOT NULL,
			due_after_ad_paid_file text NOT NULL,
			due_after_ad_paid_note text NOT NULL,
			due_after_ad_paid_date date NOT NULL,
			due_after_ad_status int(2) NOT NULL,
			due_after_visa_info_file text NOT NULL,
			due_after_visa_info_note text NOT NULL,
			due_after_visa_info_date date NOT NULL,
			due_after_visa_received varchar(255) NOT NULL,
			due_after_visa_pay_method varchar(255) NOT NULL,
			due_after_visa_paid_file text NOT NULL,
			due_after_visa_paid_note text NOT NULL,
			due_after_visa_paid_date date NOT NULL,
			client_self_acceptance_file text NOT NULL,
			client_self_acceptance_note text NOT NULL,
			proceed_pay_status int(2) NOT NULL,
			close int(2) NOT NULL,
			status int(2) NOT NULL,
			entry_by int(11) NOT NULL,
			shared_with int(11) NOT NULL,
			shared_status int(2) NOT NULL,
			submit_status int(2) NOT NULL,
			create_date date NOT NULL,
			entry_date DATETIME DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (client_id)
		)";
		$sqlClients_ex =mysqli_query($con,$sqlClients);

		$sqlClientPay = "CREATE TABLE clients_payments".$last_id."(
			cl_pay_id int(11) NOT NULL AUTO_INCREMENT,
			pay_client_id int(11) DEFAULT NULL,
			pay_date date NOT NULL,
			pay_client_bank varchar(255) NOT NULL,
			pay_acc_title varchar(255) NOT NULL,
			pay_account_no varchar(255) NOT NULL,
			pay_mood varchar(255) NOT NULL,
			pay_method varchar(255) NOT NULL,
			pay_receive_amount float NOT NULL,
			pay_online_amount float NOT NULL,
			pay_bal_amount float NOT NULL,
			pay_after_accept float NOT NULL,
			pay_aftervisa_rp float NOT NULL,
			pay_due_date date NOT NULL,
			pay_note text NOT NULL,
			pay_screenshot text NOT NULL,
			pay_status int(2) NOT NULL,
			pay_remarks text NOT NULL,
			close int(2) NOT NULL,
			status int(2) NOT NULL,
			entry_by int(11) NOT NULL,
			PRIMARY KEY (cl_pay_id)
		)";
		$sqlClientPay_ex =mysqli_query($con,$sqlClientPay);
	}

}

?>