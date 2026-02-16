<?php 
$admissionDirectStatus = "";

if($rowPro['italy_direct_info_client_status']=='0' && $rowPro['italy_direct_applied_status']=='1'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 01 Log in to the clients Gmail account" class="badge bg-success pt-1 pb-1">Client Gmail Login</span>';
}
if($rowPro['italy_direct_info_client_status']=='0' && $rowPro['italy_direct_applied_status']=='2'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 02 Create a one-time account " class="badge bg-success pt-1 pb-1">one-time account</span> ';
}
if($rowPro['italy_direct_info_client_status']=='0' && $rowPro['italy_direct_applied_status']=='3'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 03 Save the Updated password" class="badge bg-success pt-1 pb-1">Updated Password</span> ';
}
if($rowPro['italy_direct_info_client_status']=='0' && $rowPro['italy_direct_applied_status']=='4'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 04 Fill out the Application Form" class="badge bg-success pt-1 pb-1">Application Form</span> ';
}
if($rowPro['italy_direct_info_client_status']=='0' && $rowPro['italy_direct_applied_status']=='5'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform the Client to check Application Form" class="badge bg-success pt-1 pb-1" id="blink">Inform the Client</span> ';
}
if($rowPro['italy_direct_info_client_status']=='1' && $rowPro['italy_direct_applied_status']=='5'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application form Sent to client for checking" class="badge bg-success pt-1 pb-1">Sent to Client</span> ';
}
if($rowPro['italy_direct_info_client_status']=='2' && $rowPro['italy_direct_applied_status']=='5'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Client wants some changes in Application Form" class="badge bg-success pt-1 pb-1" id="blink">Client wants Changes</span> ';
}
if($rowPro['italy_direct_info_client_status']=='2' && $rowPro['italy_direct_applied_status']=='6'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Changes Updated in Application Form" class="badge bg-success pt-1 pb-1" id="blink">Changes Updated</span> ';
}
if($rowPro['italy_direct_info_client_status']=='3' && ($rowPro['italy_direct_applied_status']=='5' || $rowPro['italy_direct_applied_status']== '6')){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Form checked by Client" class="badge bg-success pt-1 pb-1" id="blink">Client Checked</span> ';
}
if($rowPro['italy_direct_info_client_status']=='4' && ($rowPro['italy_direct_applied_status']=='5' || $rowPro['italy_direct_applied_status']== '6')){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform to pay Application Fee" class="badge bg-success pt-1 pb-1">Info to Pay Fee</span> ';
}
if($rowPro['italy_direct_info_client_status']=='5' && ($rowPro['italy_direct_applied_status']=='5' || $rowPro['italy_direct_applied_status']== '6')){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Fee Paid By Client" class="badge bg-success pt-1 pb-1" id="blink">Fee Paid</span> ';
}

if($rowPro['italy_direct_info_client_status']=='5' && $rowPro['italy_direct_applied_status']=='7'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform to client for Submitted of Application form" class="badge bg-success pt-1 pb-1" id="blink">Application form Submitted</span> ';
}
if($rowPro['italy_direct_info_client_status']=='6' && $rowPro['italy_direct_applied_status']=='7'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="waiting for the admission decision" class="badge bg-success pt-1 pb-1">waiting for admission</span> ';
}
if($rowPro['italy_direct_program1_status']=='Acceptance' || $rowPro['italy_direct_program2_status']=='Acceptance'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Accepted" class="badge bg-success pt-1 pb-1">Application Accepted</span> ';
}
if($rowPro['italy_direct_program1_status']=='Rejection' || $rowPro['italy_direct_program2_status']=='Rejection'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Rejected" class="badge bg-success pt-1 pb-1">Application Rejected</span> ';
}
?>

<?php 
$admissionDirectDate = "";
if ($rowPro['italy_direct_applied_date']=='0000-00-00') {
	$admissionDirectDate .= '';
}else{
	$admissionDirectDate .= date("d-m-Y", strtotime($rowPro['italy_direct_applied_date']));
}
?>