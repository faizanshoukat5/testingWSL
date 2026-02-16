<?php 
$admissionPreStatus = "";

if($rowPro['italy_pre_info_client_status']=='0' && $rowPro['italy_pre_applied_status']=='1'){
	$admissionPreStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 01 Log in to the clients Gmail account" class="badge bg-success pt-1 pb-1">Client Gmail Login</span>';
}
if($rowPro['italy_pre_info_client_status']=='0' && $rowPro['italy_pre_applied_status']=='2'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="Step: 02 Create a one-time account " class="badge bg-success pt-1 pb-1">one-time account</span> ';
}
if($rowPro['italy_pre_info_client_status']=='0' && $rowPro['italy_pre_applied_status']=='3'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="Step: 03 Save the Updated password" class="badge bg-success pt-1 pb-1">Updated Password</span> ';
}
if($rowPro['italy_pre_info_client_status']=='0' && $rowPro['italy_pre_applied_status']=='4'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="Step: 04 Fill out the Application Form" class="badge bg-success pt-1 pb-1">Application Form</span> ';
}
if($rowPro['italy_pre_info_client_status']=='0' && $rowPro['italy_pre_applied_status']=='5'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="Application rechecked by Client" class="badge bg-success pt-1 pb-1" id="blink">Application Rechecked</span> ';
}
if($rowPro['italy_pre_info_client_status']=='0' && $rowPro['italy_pre_applied_status']=='6'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="Inform to client for Submitted of Application form" class="badge bg-success pt-1 pb-1" id="blink">Application form Submitted</span> ';
}
if($rowPro['italy_pre_info_client_status']=='1' && $rowPro['italy_pre_applied_status']=='6'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="waiting for the admission decision" class="badge bg-success pt-1 pb-1">waiting for admission</span> ';
}
if($rowPro['italy_pre_info_client_status']=='8' || $rowPro['italy_pre_applied_status']=='8'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="Application Accepted" class="badge bg-success pt-1 pb-1">Application Accepted</span> ';
}
if($rowPro['italy_pre_info_client_status']=='9' || $rowPro['italy_pre_applied_status']=='9'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="Application Rejected" class="badge bg-success pt-1 pb-1">Application Rejected</span> ';
}
if($rowPro['italy_pre_info_client_status']=='10' || $rowPro['italy_pre_applied_status']=='10'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="Summary Received" class="badge bg-success pt-1 pb-1">Summary Received</span> ';
}
if($rowPro['italy_pre_info_client_status']=='11' || $rowPro['italy_pre_applied_status']=='11'){
	$admissionPreStatus .= ' <span data-toggle="tooltip" data-placement="top" title="Summary Rejected" class="badge bg-success pt-1 pb-1">Summary Rejected</span> ';
}
?>

<?php 
$admissionPreDate = "";
if ($rowPro['italy_pre_applied_date']=='0000-00-00') {
	$admissionPreDate .= '';
}else{
	$admissionPreDate .= date("d-m-Y", strtotime($rowPro['italy_pre_applied_date']));
}
?>