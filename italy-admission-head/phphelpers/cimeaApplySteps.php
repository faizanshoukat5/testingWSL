<?php 
$admissionCimeaStatus = "";
if($rowPro['italy_cimea_info_client_status']=='0' && $rowPro['italy_cimea_applied_status']=='1'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 01 Log in to the clients Gmail account" class="badge bg-success pt-1 pb-1">Client Gmail Login</span>';
}
if($rowPro['italy_cimea_info_client_status']=='0' && $rowPro['italy_cimea_applied_status']=='2'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 02 Create a one-time account " class="badge bg-success pt-1 pb-1">one-time account</span>';
}
if($rowPro['italy_cimea_info_client_status']=='0' && $rowPro['italy_cimea_applied_status']=='3'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 03 Save the Updated password" class="badge bg-success pt-1 pb-1">Updated Password</span>';
}
if($rowPro['italy_cimea_info_client_status']=='0' && $rowPro['italy_cimea_applied_status']=='4'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 04 Fill out the Application Form" class="badge bg-success pt-1 pb-1">Application Form</span>';
}
if($rowPro['italy_cimea_info_client_status']=='0' && $rowPro['italy_cimea_applied_status']=='5'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform the Client to check Application Form" class="badge bg-success pt-1 pb-1" id="blink">Inform the Client</span>';
}
if($rowPro['italy_cimea_info_client_status']=='1' && $rowPro['italy_cimea_applied_status']=='5'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application form Sent to client for checking" class="badge bg-success pt-1 pb-1">Sent to Client</span>';
}
if($rowPro['italy_cimea_info_client_status']=='2' && $rowPro['italy_cimea_applied_status']=='5'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Client wants some changes in Application Form" class="badge bg-success pt-1 pb-1" id="blink">Client wants Changes</span>';
}
if($rowPro['italy_cimea_info_client_status']=='2' && $rowPro['italy_cimea_applied_status']=='6'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Changes Updated in Application Form" class="badge bg-success pt-1 pb-1" id="blink">Changes Updated</span>';
}
if($rowPro['italy_cimea_info_client_status']=='3' && ($rowPro['italy_cimea_applied_status']=='5' || $rowPro['italy_cimea_applied_status']== '6')){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Form checked by Client" class="badge bg-success pt-1 pb-1" id="blink">Client Checked</span>';
}
if($rowPro['italy_cimea_info_client_status']=='4' && ($rowPro['italy_cimea_applied_status']=='5' || $rowPro['italy_cimea_applied_status']== '6')){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform to pay Application Fee" class="badge bg-success pt-1 pb-1">Info to Pay Fee</span>';
}
if($rowPro['italy_cimea_info_client_status']=='5' && ($rowPro['italy_cimea_applied_status']=='5' || $rowPro['italy_cimea_applied_status']== '6')){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Fee Paid By Client" class="badge bg-success pt-1 pb-1" id="blink">Fee Paid</span>';
}
if($rowPro['italy_cimea_info_client_status']=='5' && $rowPro['italy_cimea_applied_status']=='7'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform to client for Submitted of Application form" class="badge bg-success pt-1 pb-1" id="blink">Application form Submitted</span>';
}
if($rowPro['italy_cimea_info_client_status']=='6' && $rowPro['italy_cimea_applied_status']=='7'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="waiting for the admission decision" class="badge bg-success pt-1 pb-1">waiting for cimea report </span>';
}
if($rowPro['italy_cimea_info_client_status']=='8' || $rowPro['italy_cimea_applied_status']=='8'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Cimea Report Received" class="badge bg-success pt-1 pb-1">Cimea Report Received</span>';
}
if($rowPro['italy_cimea_info_client_status']=='9' || $rowPro['italy_cimea_applied_status']=='9'){
	$admissionCimeaStatus .= '<span data-toggle="tooltip" data-placement="top" title="Cimea Not Approved" class="badge bg-success pt-1 pb-1">Cimea Not Approved</span>';
}
?>

<?php 
$admissionCimeaDate = "";
if ($rowPro['italy_cimea_applied_date']=='0000-00-00') {
	$admissionCimeaDate .= '';
}else{
	$admissionCimeaDate .= date("d-m-Y", strtotime($rowPro['italy_tolc_applied_date']));
}
?>