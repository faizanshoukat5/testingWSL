<?php 
// $Introquery="SELECT * FROM italy_clients_visa_intro_checklist WHERE close='1' AND status='1' AND visa_intro_checklist_client_id='".$clientID."' ";
// $Introquery_ex = mysqli_query($con, $Introquery);
// if ($Introquery_ex && mysqli_num_rows($Introquery_ex) > 0) {
// 	$clrow = mysqli_fetch_assoc($Introquery_ex);
// 	$introName = $clrow['visa_intro_checklist_steps_name'];
// 	if ($introName == 'Intro Message') {
// 		$btnIntro = 'btn-warning';
// 	} else {
// 		$btnIntro = 'btn-outline-purple';
// 	}
// }else {
// 	$btnIntro = 'btn-outline-purple';
// }
$btnIntro = 'btn-outline-purple';
?>

<a href="visa-process?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?><?php echo $row['client_process_status'] == 'Only Admission Process' ? 'disabled' : ''; ?> style="width: 165px;" class="btn <?php echo $btnIntro;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Visa Process Steps"> <i class="mdi mdi-alpha-v-circle-outline"></i> Visa Steps</button> </a>
<br>
<a href="after-visa-process?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status'] == 'Only Admission Process' ? 'disabled' : ''; ?> class="btn btn-outline-secondary btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="After Visa Process Steps"> <i class="mdi mdi-alpha-v-circle-outline"></i> After Visa Steps</button> </a>