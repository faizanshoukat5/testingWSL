<?php
$btnLeg = 'btn-outline-primary';
$btnNos = 'btn-outline-purple';
$btnAccept = 'btn-outline-danger';
?>
<a href="super-legalization-process?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?><?php echo $row['client_process_status'] == 'Only Admission Process' ? 'disabled' : ''; ?> style="width: 195px;" class="btn <?php echo $btnLeg;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Super Legalization"> <i class="mdi mdi-alpha-s-circle-outline"></i> Super Legalization</button> </a>
<br>
<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=all&nostrification-status=process"> <button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status'] == 'Only Admission Process' ? 'disabled' : ''; ?> style="width: 195px;" class="btn <?php echo $btnNos;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Nostrification Steps"> <i class="mdi mdi-alpha-n-circle-outline"></i> Nostrification Steps</button> </a>

<br>
<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=all&nostrification-status=process&get-acceptance-letter=process"> <button type="button" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status'] == 'Only Admission Process' ? 'disabled' : ''; ?> style="width: 195px;" class="btn <?php echo $btnAccept;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Get Acceptance Letter From University"> <i class="mdi mdi-alpha-l-circle-outline"></i> Acceptance Letter</button> </a>