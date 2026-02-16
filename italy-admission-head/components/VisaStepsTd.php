<?php 
$Introquery="SELECT visa_intro_checklist_steps_name FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_intro_checklist_client_id='".$clientID."' AND visa_intro_checklist_steps_name='Intro Message' ";
$Introquery_ex = mysqli_query($con, $Introquery);
if ($Introquery_ex && mysqli_num_rows($Introquery_ex) > 0) {
	$clrow = mysqli_fetch_assoc($Introquery_ex);
	$introName = $clrow['visa_intro_checklist_steps_name'];
	if ($introName == 'Intro Message') {
		$btnIntro = 'btn-warning';
	} else {
		$btnIntro = 'btn-outline-purple';
	}
}else {
	$btnIntro = 'btn-outline-purple';
}
$Introquery="SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_book_appoint_client_id='".$clientID."' AND visa_book_appoint_status='Visa Accepted' ";
$Introquery_ex = mysqli_query($con, $Introquery);
if ($Introquery_ex && mysqli_num_rows($Introquery_ex) > 0) {
	$viRow = mysqli_fetch_assoc($Introquery_ex);
	$visaMessage = $viRow['visa_book_appoint_status'];
	if ($visaMessage == 'Visa Accepted') {
		$btnIntro = 'btn-success';
	}
}
?>

<a href="visa-process?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?><?php echo $row['client_process_status'] == 'Only Admission Process' ? 'disabled' : ''; ?> style="width: 165px;" class="btn <?php echo $btnIntro;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Visa Process Steps"> <i class="mdi mdi-alpha-v-circle-outline"></i> Visa Steps</button> </a>
<br>
<?php
// $result = mysqli_query($con, "SELECT COUNT(italy_checklist_name) AS NumberOfLists FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_client_check_id='".$clientID."' AND (italy_checklist_name='DOV' || italy_checklist_name='Visa' || italy_checklist_name='Cimea') AND entry_by='".$_SESSION['user_id']."' ");
// $data = mysqli_fetch_assoc($result);
// $num = $data['NumberOfLists'];
// $isItaly = $num == 2 && $row['client_country'] == 'italy';

$checklistBtn = 'outline-primary';
if ($row['country_checklist_intro_file']!= '' && $row['country_checklist_info_file']== '') {
    $checklistBtn = 'warning';
} elseif ($row['country_checklist_intro_file']!= '' && $row['country_checklist_info_file']!= '') {
    $checklistBtn = 'success';
}
?>
<?php if ($sumBalance=='0' && $row['case_status']=='0') { ?>
<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" style="width: 165px;" class="btn btn-<?php echo $checklistBtn;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Send Checklist using Email And WhatsApp"> <i class="mdi mdi-check-outline"></i> Email Checklist </button> </a>
<?php }elseif($row['case_status']!='0'){ ?>
<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" style="width: 165px;" class="btn btn-<?php echo $checklistBtn;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Send Checklist using Email And WhatsApp" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> Email Checklist </button></a>
<?php }else{ ?> 
<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" style="width: 165px;" class="btn btn-<?php echo $checklistBtn;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Send Checklist using Email And WhatsApp" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> Email Checklist </button></a>
<?php } ?>
<br>
<a href="after-visa-process?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status'] == 'Only Admission Process' ? 'disabled' : ''; ?> class="btn btn-outline-secondary btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="After Visa Process Steps"> <i class="mdi mdi-alpha-v-circle-outline"></i> After Visa Steps</button> </a>