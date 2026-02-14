<?php 
$admissionDirectStatus = "";

if($rowPro['aus_direct_applied_status']=='1'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 01 Log in to the clients Gmail account" class="badge bg-success pt-1 pb-1">Client Gmail Login</span>';
}
if($rowPro['aus_direct_applied_status']=='2'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 02 Create a one-time account " class="badge bg-success pt-1 pb-1">one-time account</span> ';
}
if($rowPro['aus_direct_applied_status']=='3'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 03 Save the Updated password" class="badge bg-success pt-1 pb-1">Updated Password</span> ';
}
if($rowPro['aus_direct_applied_status']=='4'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 04 Fill out the Application Form" class="badge bg-success pt-1 pb-1">Application Form</span> ';
}
if($rowPro['aus_direct_applied_status']=='5'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform to client for Submitted of Application form" class="badge bg-success pt-1 pb-1" id="blink">Application form Submitted</span> ';
}
if($rowPro['aus_direct_applied_status']== '6'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Informed for Application Submitted" class="badge bg-success pt-1 pb-1" id="blink">Client Proof</span> ';
}
if($rowPro['aus_direct_applied_status']=='7'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform to Client for fee Pay" class="badge bg-success pt-1 pb-1" id="blink">Inform Fee</span> ';
}
if($rowPro['aus_direct_applied_status']=='8'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Fee Paid By Client" class="badge bg-success pt-1 pb-1" id="blink">Fee Paid</span> ';
}

if($rowPro['aus_direct_applied_status']=='9'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="waiting for the admission decision" class="badge bg-success pt-1 pb-1">waiting for admission</span> ';
}
if($rowPro['aus_direct_applied_status']=='10'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Accepted" class="badge bg-success pt-1 pb-1">Application Accepted</span> ';
}
if($rowPro['aus_direct_applied_status']=='11'){
	$admissionDirectStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Rejected" class="badge bg-danger pt-1 pb-1">Application Rejected</span> ';
}
?>

<?php 
$admissionDirectDate = "";
if ($rowPro['aus_direct_applied_date']=='0000-00-00') {
	$admissionDirectDate .= '';
}else{
	$admissionDirectDate .= date("d-m-Y", strtotime($rowPro['aus_direct_applied_date']));
}
?>