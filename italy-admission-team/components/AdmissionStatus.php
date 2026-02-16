<?php 
$query = "SELECT note_admission FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$clientID."' ";
$docRow = mysqli_fetch_assoc(mysqli_query($con, $query));
$buttonAdClass = $docRow['note_admission'] != '' ? 'btn-success' : 'btn-outline-primary';
?>
<button type="button" class="btn <?php echo $buttonAdClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Document Collection Report" onclick="docAdmissionNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>

<?php
$query = "SELECT COUNT(italy_assign_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='6' || italy_direct_info_client_status='6' || italy_pre_info_client_status='6' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_program_assign='".$_SESSION['user_id']."' AND italy_clients_id = '".$clientID."' ";
$result = mysqli_query($con, $query);
if ($result) {
	$data = mysqli_fetch_array($result);
	$totalNo = $data['totalAssign'];
	$assignedNo = $data['assignedNo'];
	if($totalNo == $assignedNo){
		echo '<a href="apply-programs?client-id='.$clientID.'&'.$getUrl.'&preEnroll=allClient "><button type="button" class="btn btn-success btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Check Applied This Client Program"><i class="mdi mdi-check-circle"></i> Applied <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.$assignedNo.' / '.$totalNo.'</span></button> </a>';
	}
	else{
		echo '<a href="apply-programs?client-id='.$clientID.'&'.$getUrl.'&preEnroll=allClient "><button type="button" class="btn btn-outline-primary btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Apply This Client Program"><i class="mdi mdi-clipboard-text-outline"></i> Apply <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.$assignedNo.' / '.$totalNo.'</span></button> </a>';
	}
}
?>
<?php
$query="SELECT italy_applied_status, italy_direct_applied_status, italy_pre_applied_status,  italy_tolc_applied_status, italy_cimea_applied_status FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_program_assign='".$_SESSION['user_id']."' AND italy_clients_id='".$clientID."' ";
$result_ex = mysqli_query($con, $query);
foreach ($result_ex as $italPro) {
	if ( $italPro['italy_applied_status']=='0' && $italPro['italy_direct_applied_status']=='0' &&  $italPro['italy_pre_applied_status']=='0' && $italPro['italy_tolc_applied_status']=='0' && $italPro['italy_cimea_applied_status']=='0' ){ ?>
		<br>
		<span data-toggle="tooltip" data-placement="top" title="New Programs Assign" class="badge bg-dark" id="blink">New</span>
	<?php }
}
?>