<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Track this Client" onclick="ViewClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-eye"></i></button>
<button type="button" class="btn btn-outline-pink btn-sm" data-toggle="tooltip" data-placement="top" title="Change Intake Year" onclick="changeIntakeYear(<?php echo $row['client_id'];?>);"><i class="mdi mdi-arrow-left-right-bold"></i></button>
<br>
<?php 
$btnClass = ($row['due_after_ad_info_file']!='' && ($row['due_after_ad_status']=='0' || $row['due_after_ad_status']=='2')) ? 'btn-warning' : (($row['due_after_ad_info_file']!='' && ($row['due_after_ad_status']=='1' || $row['due_after_ad_status']=='3')) ? 'btn-success' : 'btn-outline-danger');
?>
<button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn <?= $btnClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Add After Acceptance Dues" onclick="dueAfterAcceptance(<?= $row['client_id']; ?>);"> <i class="mdi mdi-alpha-d-box"></i> </button>
<?php 
$btnVisaClass = ($row['due_after_visa_info_file']!='' && $row['due_after_visa_paid_file']=='') ? 'btn-warning' : (($row['due_after_visa_info_file']!='' && $row['due_after_visa_paid_file']!='1') ? 'btn-success' : 'btn-outline-info');
?>
<button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn <?= $btnVisaClass; ?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Add After Visa Dues" onclick="dueAfterVisa(<?= $row['client_id']; ?>);"> <i class="mdi mdi-alpha-v-box"></i> </button>