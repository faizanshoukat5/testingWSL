<?php 
	if ($countryName != "all") {
		$whereCondition .= " AND client_country='".$countryName."'";
	}
	if ($convertStatus != "all") {
		$whereCondition .= " AND client_convert_status='".$convertStatus."'";
	}
	if ($clientCountry != "all") {
		$whereCondition .= " AND client_countryfrom='".$clientCountry."'";
	}
	if ($clientCase != "all") {
		$whereCondition .= " AND client_case_status='".$clientCase."'";
	}
	if ($clientDegree != "all") {
		$whereCondition .= " AND (client_applied='$degInfo' OR client_applied='$degbachMBBS')";
	}
	if ($startDate != "" && $endDate != "") {
		$whereCondition .= " AND create_date BETWEEN '".$startDate."' AND '".$endDate."'";
	}
	// Handle Process Task filters
	if ($clientStatus!= "all") {
		if ($clientStatus == 'New') {
			$whereCondition .= " AND ack_confirm_status='0' AND client_pro_confirm_status='0' AND client_pay_confirm_status='0' AND client_document_status='0' ";
		} 
		if ($clientStatus == 'Process') {
			$whereCondition .= " AND ((ack_confirm_status='1' OR client_pro_confirm_status='1' OR client_pay_confirm_status='1') AND client_document_status='0')";
		} 
		if ($clientStatus == 'Forwarded') {
			$whereCondition .= " AND ack_confirm_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND client_document_status='1'";
		}
	}
	if ($processStatus!="all" ) {
		$whereCondition .= " AND client_process_status='".$processStatus."'";
	}
	if ($intakeYear!="all" ) {
		$whereCondition .= " AND client_intake_year='".$intakeYear."'";
	}
	
	if ($clientDetails != "") {
		$whereCondition .= " AND (client_id='".$clientDetails."' OR CONCAT('ID-', client_id) LIKE '%".$clientDetails."%' OR client_name LIKE '%".$clientDetails."%' OR subject LIKE '%".$clientDetails."%' OR client_email LIKE '%".$clientDetails."%' OR client_whatapp LIKE '%".$clientDetails."%' OR client_country LIKE '%".$clientDetails."%' OR client_applied LIKE '%".$clientDetails."%' OR client_embassy LIKE '%".$clientDetails."%')";
	}
	// Count total records
	$countQuery = "SELECT COUNT(*) as total FROM clients".$_SESSION['dbNo']." WHERE $whereCondition";
	$countResult = mysqli_query($con, $countQuery);
	$totalRecords = mysqli_fetch_assoc($countResult)['total'];
	$totalPages = ceil($totalRecords / $limit);
	// Fetch client data with pagination
	$clientData = "SELECT * FROM clients".$_SESSION['dbNo']." WHERE $whereCondition ORDER BY client_id DESC LIMIT $limit OFFSET $offset";
	$clientData_ex = mysqli_query($con, $clientData);
?>