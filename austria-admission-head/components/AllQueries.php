<?php
if($clientDetails=='' || $clientDetails!=''){
	$whereCondition .= " AND (cl.client_id='".$clientDetails."' OR CONCAT('ID-', cl.client_id) LIKE '%".$clientDetails."%' OR cl.client_name LIKE '%".$clientDetails."%' OR cl.client_email LIKE '%".$clientDetails."%' OR cl.client_whatapp LIKE '%".$clientDetails."%' OR cl.client_country LIKE '%".$clientDetails."%' OR cl.client_applied LIKE '%".$clientDetails."%' OR cl.client_embassy LIKE '%".$clientDetails."%' OR acp.aus_university_name LIKE '%".$clientDetails."%' OR JSON_CONTAINS(acp.aus_program_name, '\"$clientDetails\"') OR acp.aus_program_name LIKE '%\"".$clientDetails."\"%')";
}

$countQuery = "SELECT COUNT(DISTINCT cl.client_id) as total from clients{$_SESSION['dbNo']} cl JOIN austria_clients_programs{$_SESSION['dbNo']} acp ON cl.client_id = acp.aus_clients_id WHERE $whereCondition ";
$countResult = mysqli_query($con, $countQuery);
$totalRecords = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRecords / $limit);

$clientData = "SELECT * from clients{$_SESSION['dbNo']} cl JOIN austria_clients_programs{$_SESSION['dbNo']} acp ON cl.client_id = acp.aus_clients_id WHERE $whereCondition GROUP BY cl.client_id ORDER BY client_id DESC LIMIT $limit OFFSET $offset ";
$clientData_ex = mysqli_query($con,$clientData);
?>