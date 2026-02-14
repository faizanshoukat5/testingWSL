<?php 
$query = "SELECT note_documents, note_admission, head_personal_note FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$row['client_id']."' ";
$docRow = mysqli_fetch_assoc(mysqli_query($con, $query));
$buttonClass = $docRow['note_documents'] != '' ? 'btn-success' : 'btn-outline-danger';
$buttonAdClass = $docRow['note_admission'] != '' ? 'btn-success' : 'btn-outline-primary';
$buttonPersonalClass = $docRow['head_personal_note'] != '' ? 'btn-success' : 'btn-outline-dark';
?>
<button type="button" class="btn <?php echo $buttonAdClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Document Collection Report" onclick="docAdmissionNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>

<button type="button" class="btn <?php echo $buttonPersonalClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Your Personal Note" onclick="personalNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-p-box"></i> </button>

<?php if($checkApplication=='Admission Application Form Fill' || $checkApplication=='Admission Application Submitted' || $checkApplication=='Sent Admission Applied Proof to Client' || $checkApplication=='Inform to Client to Pay Application Fee' || $checkApplication=='Application Fee Paid By Client' || $checkApplication=='Waiting for Admission decision' || $checkApplication=='Acceptance Letter Received Clients' || $checkApplication=='University Admission Rejected Clients' || $checkApplication=='Additional Activities Required by University' || $checkApplication=='Additional Activities Required by University Task Completed' || $checkApplication=='Deadline Hold' || $checkApplication=='Deadline Release'){ ?>
	<br>
	<?php 
	$btnClass = ($row['due_after_ad_info_file']!='' && ($row['due_after_ad_status']=='0' || $row['due_after_ad_status']=='2')) ? 'btn-warning' : (($row['due_after_ad_info_file']!='' && ($row['due_after_ad_status']=='1' || $row['due_after_ad_status']=='3')) ? 'btn-success' : 'btn-outline-danger');
	?>
	<button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn <?= $btnClass;?> btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Add After Verification Dues" onclick="dueAfterAcceptance(<?= $row['client_id']; ?>);"> <i class="mdi mdi-alpha-d-box"></i> </button>
	<?php 
	$btnVisaClass = ($row['due_after_visa_info_file']!='' && $row['due_after_visa_paid_file']=='') ? 'btn-warning' : (($row['due_after_visa_info_file']!='' && $row['due_after_visa_paid_file']!='1') ? 'btn-success' : 'btn-outline-info');
	?>
	<button type="button" class="btn <?= $btnVisaClass; ?> btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Add After Visa Dues" onclick="dueAfterVisa(<?= $row['client_id']; ?>);"> <i class="mdi mdi-alpha-v-box"></i> </button>
		<?php
		$query="SELECT COUNT(aus_direct_proof_screenshot) AS totalAssign, SUM(CASE WHEN aus_direct_proof_screenshot!='' THEN 1 ELSE 0 END) AS assignedNo FROM austria_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND aus_change_program_status='0' AND aus_clients_id='".$clientID."' ";
		$result = mysqli_query($con, $query);
		$data = mysqli_fetch_array($result);
		$totalNo = $data['totalAssign'];
		$assignedNo = $data['assignedNo'];
		if($totalNo == $assignedNo){ ?>
		<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>&nostrification-status=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> A. Status </button> </a>
		<?php } else{ ?>
		<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>&nostrification-status=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> A. Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
		<?php } ?>
<?php }else{ ?>
		<?php
		$query = "SELECT COUNT(aus_assign_status) AS totalAssign,SUM(CASE WHEN aus_assign_status='1' THEN 1 ELSE 0 END) AS assignedNo FROM austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_clients_id='".$clientID."' ";
		$result = mysqli_query($con, $query);
		$data = mysqli_fetch_array($result);
		$totalNo = $data['totalAssign'];
		$assignedNo = $data['assignedNo'];
		if($totalNo == $assignedNo){
		?>
		<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> <?= $sumBalance == '0' ? '' : 'disabled'; ?> class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> A. Progr .</button> </a>
		<?php }elseif($assignedNo > 0 ){ ?>
		<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> <?= $sumBalance == '0' ? '' : 'disabled'; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span> A. Progr .</button> </a>
		<?php }else{ ?>
		<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> <?= $sumBalance == '0' ? '' : 'disabled'; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A. Progr .</button> </a>
		<?php } ?>
	<br>
	<?php 
	$btnClass = ($row['due_after_ad_info_file']!='' && ($row['due_after_ad_status']=='0' || $row['due_after_ad_status']=='2')) ? 'btn-warning' : (($row['due_after_ad_info_file']!='' && ($row['due_after_ad_status']=='1' || $row['due_after_ad_status']=='3')) ? 'btn-success' : 'btn-outline-danger');
	?>
	<button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn <?= $btnClass; ?> btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Add After Verification Dues" onclick="dueAfterAcceptance(<?= $row['client_id']; ?>);"> <i class="mdi mdi-alpha-d-box"></i> </button>
	<?php 
	$btnVisaClass = ($row['due_after_visa_info_file']!='' && $row['due_after_visa_paid_file']=='') ? 'btn-warning' : (($row['due_after_visa_info_file']!='' && $row['due_after_visa_paid_file']!='1') ? 'btn-success' : 'btn-outline-info');
	?>
	<button type="button" class="btn <?= $btnVisaClass; ?> btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Add After Visa Dues" onclick="dueAfterVisa(<?= $row['client_id']; ?>);"> <i class="mdi mdi-alpha-v-box"></i> </button>
	<?php
		$query="SELECT COUNT(aus_direct_applied_status) AS totalAssign, SUM(CASE WHEN aus_direct_applied_status!='' THEN 1 ELSE 0 END) AS assignedNo FROM austria_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND aus_change_program_status='0' AND aus_clients_id='".$clientID."' ";
		$result = mysqli_query($con, $query);
		$data = mysqli_fetch_array($result);
		$totalNo = $data['totalAssign'];
		$assignedNo = $data['assignedNo'];
		if($totalNo == $assignedNo){ ?>
			<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>&nostrification-status=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> A. Status </button> </a>
		<?php
		}
		else{ ?>
			<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>&nostrification-status=all"><button type="button" class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> A. Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
			<?php
		}
	} 

	$query="SELECT `aus_direct_applied_status`, `aus_program_assign_date` FROM austria_clients_programs".$_SESSION['dbNo']." WHERE `close`='1' AND `status`='1' AND `aus_change_program_status`='0' AND `aus_clients_id`='".$clientID."' LIMIT 1";
	$result_ex = mysqli_query($con, $query);
	foreach ($result_ex as $italPro) {
		$assignDate = $italPro['aus_program_assign_date'];
		if ($assignDate!='0000-00-00') {
			$date2 = date('Y-m-d');
			$timestamp_assignDate = strtotime($assignDate);
			$timestamp_date2 = strtotime($date2);
			$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
			$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
			// echo $daysAssign_diff;
			if ($daysAssign_diff >= 1 && ($italPro['aus_direct_applied_status']=='0') ) { ?>
			<br>
			<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
			<?php }
		}
	}
	?>
	<br>
	<?php 
	$btnSelf=$row['client_self_acceptance_file']!='' ? 'btn-success' : 'btn-outline-pink';
	?>
	<button type="button" class="btn <?php echo $btnSelf;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Self Received Acceptance" onclick="selfAcceptance(<?= $row['client_id'];?>);"><i class="mdi mdi-clipboard-text"></i> Self R. Acceptance</button>