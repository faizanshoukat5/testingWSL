<?php
$admissionTolcStatus = "";
if($rowPro['italy_tolc_info_status']=='0' && $rowPro['italy_tolc_applied_status']=='1'){
	$admissionTolcStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 01 Log in to the clients Gmail account" class="badge bg-success pt-1 pb-1 mt-1">Client Gmail Login</span>';
}
if($rowPro['italy_tolc_info_status']=='0' && $rowPro['italy_tolc_applied_status']=='2'){
	$admissionTolcStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 02 Create a CISIA account ( TOLC Test Registration ) " class="badge bg-success pt-1 pb-1 mt-1">Create a CISIA account</span>';
}
if($rowPro['italy_tolc_info_status']=='0' && $rowPro['italy_tolc_applied_status']=='3'){
	$admissionTolcStatus .= '<span data-toggle="tooltip" data-placement="top" title="Step: 03 Save the Update Password" class="badge bg-success pt-1 pb-1 mt-1">Updated Password</span>';
}
if($rowPro['italy_tolc_info_status']=='1' && $rowPro['italy_tolc_applied_status']=='3'){
	$admissionTolcStatus .= '<span data-toggle="tooltip" data-placement="top" title="Inform to Client to Book a Tolc Test Date" class="badge bg-success pt-1 pb-1 mt-1">Inform to Client</span>';
}
if($rowPro['italy_tolc_info_status']=='2' && $rowPro['italy_tolc_applied_status']=='3'){
	$admissionTolcStatus .= '<span data-toggle="tooltip" data-placement="top" title="Client sent us a test date" class="badge bg-success pt-1 pb-1 mt-1">Client sent us a test date</span>';
}
if($rowPro['italy_tolc_info_status']=='3' && $rowPro['italy_tolc_applied_status']=='3'){
	$admissionTolcStatus .= '<span data-toggle="tooltip" data-placement="top" title="Client paid the fee proof" class="badge bg-success pt-1 pb-1 mt-1">Client paid the fee proof</span>';
}
if($rowPro['italy_tolc_info_status']=='4' && $rowPro['italy_tolc_applied_status']=='3'){
	$admissionTolcStatus .= '<span data-toggle="tooltip" data-placement="top" title="Sent the practice test video" class="badge bg-success pt-1 pb-1 mt-1">Sent the practice test video</span>';
}
if($rowPro['italy_tolc_info_status']=='5' && $rowPro['italy_tolc_applied_status']=='3'){
	$admissionTolcStatus .= '<span data-toggle="tooltip" data-placement="top" title="Client Pass TOLC Test" class="badge bg-success pt-1 pb-1 mt-1">Client Pass TOLC Test</span>';
}
if($rowPro['italy_tolc_info_status']=='6' && $rowPro['italy_tolc_applied_status']=='3'){
	$admissionTolcStatus .= '<span data-toggle="tooltip" data-placement="top" title="Client fails the TOLC" class="badge bg-danger pt-1 pb-1 mt-1">Client fails the TOLC</span>';
}
?>


<?php 
$admissionTolcDate = "";
if ($rowPro['italy_tolc_applied_date']=='0000-00-00') {
	$admissionTolcDate .= '';
}else{
	$admissionTolcDate .= date("d-m-Y", strtotime($rowPro['italy_tolc_applied_date']));
}
?>