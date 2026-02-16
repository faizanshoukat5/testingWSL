<button type="button" class="btn <?= $row['italy_document_collection_note']!='' ? 'btn-success' : 'btn-outline-dark'?> btn-sm" data-toggle="tooltip" data-placement="top" title="Note form Document Collection To Admission Head for University Process" onclick="addNoteAdmissionhead(<?php echo $row['italy_client_pro_id'];?>);"><i class="mdi mdi-alpha-d-circle"></i> </button>
<?php
$statusClass = match($row['italy_program_status']) {
	'1' => 'btn-warning',
	'2' => 'btn-success',
	default => 'btn-outline-primary',
};
?>
<button type="button" class="btn <?php echo $statusClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Processing Team Report" onclick="addProgramNote(<?php echo $row['italy_client_pro_id'];?>);"> <i class="mdi mdi-alpha-p-circle"></i> </button>
<?php
$query = "SELECT COUNT(italy_assign_status) AS totalAssign,SUM(CASE WHEN italy_assign_status= '1' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND italy_university_name='".$uniName."' ";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_array($result);
$totalNo = $data['totalAssign'];
$assignedNo = $data['assignedNo'];
if($totalNo == $assignedNo){
?>
<a href="assign-programs?client-id=<?php echo $clientID;?>&url=<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>"><button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i>A. Program</button> </a>
<?php 
}elseif($assignedNo > 0 ){ ?>
<a href="assign-programs?client-id=<?php echo $clientID;?>&url=<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>"><button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span> A. Program</button> </a>
<?php
}else{
?>
<a href="assign-programs?client-id=<?php echo $clientID;?>&url=<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>"><button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A. Program</button> </a>
	
<?php
}
?>
<?php 
if($row['italy_program_assign']!=0){ ?> <br> <?php
$query="SELECT fname, lname FROM wt_users WHERE close='1' AND status='1' AND wt_id='".$row['italy_program_assign']."' ";
$result_ex = mysqli_query($con, $query);
while ($wtRow = mysqli_fetch_assoc($result_ex)) { ?>
	<span class="badge bg-purple pt-1 pb-1 mt-1"><?php echo ucwords($wtRow['fname']." ".$wtRow['lname']);?></span>
<?php
}
}
?>
<br>
<button style="width: 100px;" <?= $sumBalance=='0' ? '' : 'disabled';?> type="button" class="btn <?php echo ($row['country_agent_assign_to']!='') ? 'btn-success' : 'btn-outline-danger'; ?> btn-sm text-truncate mt-2" data-toggle="tooltip" data-placement="top" title="<?php echo ($row['country_agent_assign_to']!='') ? ("WhatsApp Agent"."<br>".ucwords($row['country_agent_assign_to'])."<br>".$row['country_agent_assign_date']) : 'Assign Client To Admission WhatsApp Agent'; ?>" onclick="assignAgentCleints(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-a-circle"></i> <?php echo ($row['country_agent_assign_to']!='') ? ucwords($row['country_agent_assign_to']) : 'Assign'; ?> </button>
<?php
$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='6' || italy_direct_info_client_status='6' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND italy_university_name='".$uniName."' ";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_array($result);
$totalNo = $data['totalAssign'];
$assignedNo = $data['assignedNo'];
if($totalNo == $assignedNo){ ?>
	<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>&application-status=all"><button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> A. Status </button> </a>
<?php
}
else{ ?>
	<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>&application-status=all"><button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> A. Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
<?php
}
?>
<br>
<?php
$query="SELECT italy_applied_status, italy_direct_applied_status, italy_pre_applied_status, italy_tolc_applied_status, italy_cimea_applied_status, italy_program_assign_date FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND italy_university_name='".$uniName."' AND italy_client_degree='bachelor' ";
$result_ex = mysqli_query($con, $query);
foreach ($result_ex as $italPro) {
$assignDate = $italPro['italy_program_assign_date'];

if ($assignDate!='0000-00-00') {
	$date2 = date('Y-m-d');
	$timestamp_assignDate = strtotime($assignDate);
	$timestamp_date2 = strtotime($date2);
	$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
	$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
	// echo $daysAssign_diff;
	if ($daysAssign_diff >= 1 && ($italPro['italy_applied_status']=='0' && $italPro['italy_direct_applied_status']=='0' &&  $italPro['italy_pre_applied_status']=='0' && $italPro['italy_tolc_applied_status']=='0' && $italPro['italy_cimea_applied_status']=='0') ) { ?>
	<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
	<?php }
}
}
?>