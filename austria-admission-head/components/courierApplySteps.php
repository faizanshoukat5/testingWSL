<?php 
$admissionCourierStatus = "";

if($rowPro['aus_courier_applied_status']=='1'){
	$admissionCourierStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 04 Fill out the Application Form" class="badge bg-success pt-1 pb-1">Application Form</span> ';
}
if($rowPro['aus_courier_applied_status']=='2'){
	$admissionCourierStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform to client for Submitted of Application form" class="badge bg-success pt-1 pb-1" id="blink">Application form Submitted</span> ';
}

if($rowPro['aus_courier_applied_status']=='9'){
	$admissionCourierStatus .= '<span data-toggle="tooltip" data-placement="top" title="waiting for the admission decision" class="badge bg-success pt-1 pb-1">waiting for admission</span> ';
}
if($rowPro['aus_courier_applied_status']=='10'){
	$admissionCourierStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Accepted" class="badge bg-success pt-1 pb-1">Application Accepted</span> ';
}
if($rowPro['aus_courier_applied_status']=='11'){
	$admissionCourierStatus .= '<span data-toggle="tooltip" data-placement="top" title="Application Rejected" class="badge bg-danger pt-1 pb-1">Application Rejected</span> ';
}
?>

<?php 
$admissionCourierDate = "";
if ($rowPro['aus_courier_applied_date']=='0000-00-00') {
	$admissionCourierDate .= '';
}else{
	$admissionCourierDate .= date("d-m-Y", strtotime($rowPro['aus_courier_applied_date']));
}
?>