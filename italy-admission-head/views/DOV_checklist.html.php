<?php 
$checklistStatus = $_GET['check-status'];
?>
<div class="card">
	<div class="card-body">

		<!-- Track client -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="viewModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">Track Client</h4>
					</div>
					<div class="modal-body viewModalClient">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="table-responsive mt-1">
			<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
				<thead>
					<tr>
						<th style="width: 20px;">Sr</th>
						<th style="width: 120px;">ID / Date</th>
						<th style="width: 220px;">Client Info</th>
						<th style="width: 100px;">Degree</th>
						<th style="width: 120px;" data-toggle="tooltip" data-placement="top" title="Payment in Advance">PIA</th>
						<th style="width: 180px;">Checklist</th>
						<th style="width: 50px;">Track</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sr=1;
				$clientData = "SELECT * from clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id=icp.italy_clients_id WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_embassy='Islamabad Embassy' GROUP BY cl.client_id ORDER BY cl.client_id DESC ";
				$clientData_ex = mysqli_query($con,$clientData);
				// $sr = mysqli_num_rows($clientData_ex);
				foreach ($clientData_ex as $row) {
					$clientID = $row['client_id'];
					$changingApplied = $row['client_applied'];
					$appliedChanging = json_decode($changingApplied, true);
					// SUM of adv payment from the client payments
					$payClient = "SELECT SUM(pay_receive_amount) FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id = '$clientID'";
					$payClient_ex = mysqli_query($con, $payClient);
					$payrow = mysqli_fetch_assoc($payClient_ex);
					$sumReceived = $payrow['SUM(pay_receive_amount)'];

					// fetch last balance amount and date from the clients payments
					$balClient = "SELECT pay_bal_amount, pay_due_date FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND cl_pay_id IN (SELECT MAX(cl_pay_id) FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' GROUP BY pay_client_id) AND pay_client_id='$clientID' GROUP BY pay_client_id";
					$balClient_ex = mysqli_query($con, $balClient);
					$balrow = mysqli_fetch_assoc($balClient_ex); 
					$sumBalance = $balrow['pay_bal_amount'];
					$pay_due_date = $balrow['pay_due_date'];

					// query get first row of accept and visa rp
					$select_query = "SELECT pay_after_accept, pay_aftervisa_rp FROM clients_payments".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND pay_client_id='$clientID' LIMIT 1";
					$select_query_ex = mysqli_query($con, $select_query);
					$pay1Row = mysqli_fetch_assoc($select_query_ex);
					$payAfterAccept = $pay1Row['pay_after_accept'];
					$payAfterVisaRp = $pay1Row['pay_aftervisa_rp'];

					$numItaly = 0;
					if ($row['client_country']=='italy') {
						$result = mysqli_query($con, "SELECT COUNT(italy_checklist_name) AS NumberOfLists FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status = '1' AND italy_checklist_name='DOV' AND italy_client_check_id='".$clientID."' AND entry_by='".$_SESSION['user_id']."' ");
						$data = mysqli_fetch_assoc($result);
						$numItaly = $data['NumberOfLists'];
					}
					$getUrl = base64_encode($row['client_name']."".$row['client_email']);
					if ($numItaly>='1' && $checklistStatus=='1') {
					?>
					
					<tr id="<?php echo $row['client_id']; ?>">
						<?php 
						echo "<td>".$sr."</td><td>ID-".$row['client_id']."<br><b>".date("d-m-Y", strtotime($row['create_date']))."</b><br>";
						if ($row['client_process_status']=='OverAll Process') {
							echo "<b class='text-purple'>OverAll Process <br> (Admission + Visa)</b>";
						}elseif ($row['client_process_status']=='Only Admission Process') {
							echo "<b class='text-info'>Only Admission <br> Process</b>";
						}else{
							echo "<b class='text-danger'>Have Accepted <br> Letter (Only Visa)</b>";
						}
						echo "</td>";
						?>
						<td class="breakTD">
							<b><?php echo ucwords($row['client_name']);?> </b> <br><a href="https://web.whatsapp.com/send?phone=+<?php echo $row['client_whatapp'];?>" target="_blank"><?php echo $row['client_whatapp']; ?></a> <br><?php echo $row['client_email'];?>
							<br>
							<?php if ($row['client_convert_status']=='New Client') {
								echo "<b class='text-success'>New Client</b>";
							}elseif ($row['client_convert_status']=='Old Client') {
								echo "<b class='text-info'>Old Client</b>";
							}elseif($row['client_convert_status']=='Old Converted Client'){
								echo "<b class='text-warning'>Old Converted Client</b>";
							}elseif ($row['client_convert_status']=='Italy Old Client 2024') {
								echo "<b class='text-info'>Italy Old Client 2024</b>";
							}elseif($row['client_convert_status']=='Austria Converted Client'){
								echo "<b class='text-warning'>Austria Converted Client</b>";
							} ?>
						</td>
						<td class="breakTD">
						<?php
							echo ucwords($row['client_country'])." <br>";
							foreach ($appliedChanging as $appRow){
								echo "<b>".ucwords($appRow)."</b> ";
							}?>
							<br>
							<span data-toggle="tooltip" data-placement="top" title="Country"><?php echo ucwords($row['client_countryfrom']);?></span>
							<br>
							<?php
							$embassyTooltips = [
								'Islamabad Embassy' => 'Islamabad Embassy (Punjab, KPK, and northern areas)',
								'Karachi Embassy' => 'Karachi Embassy (Sindh and Balochistan)',
								'Dubai Embassy' => 'Dubai Embassy (Except for Sharjah and Abu Dhabi, students from all other states of the UAE will select the Dubai embassy.)',
								'Abu Dhabi Embassy' => 'Abu Dhabi Embassy (Abu Dhabi, Sharjah)'
							];
							?>
							<span data-toggle="tooltip" data-placement="top" title="<?php echo $embassyTooltips[$row['client_embassy']];?>"> <i><?php echo ucwords($row['client_embassy']); ?></i> </span>
						</td>
						<td>
						<?php 
						$currency = ($row['client_countryfrom']=='Saudi Arabia' || $row['client_countryfrom']=='Qatar' || $row['client_countryfrom']=='UAE' ) ? 'AED' : 'PKR';
						$addVerifi = ($row['client_country'] == 'austria') ? 'Payable on getting Verification Appointment' : (($row['client_country'] == 'italy') ? 'Payable After Admission Confirmation' : '');

						$rpVisa = ($row['client_country'] == 'austria') ? 'Payable on RP Approval' : (($row['client_country'] == 'italy') ? 'Payable on Visa Approval' : '');

						echo "<span class='text-success' data-toggle='tooltip' data-placement='top' title='Payment In Advance'>".number_format($sumReceived)." </span> / <b>$currency</b>"; 
						?><br> 
						<?php 
						echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='Remaining Balance'>".number_format($sumBalance) ." </span> / <b>$currency</b>"; 
						?>
						<?php
						$dateString = $pay_due_date;
						if ($sumReceived > 0 && $dateString != null && $dateString != '0000-00-00') {
							$date = new DateTime($dateString);
							$dueDate = $date->format('d-m-Y');
							$currentDate = date('d-m-Y');
							?>
							<br>
							<div style="float:right;color:red;">
							<?php
								if ($dueDate == $currentDate) {
									echo " / <span id='blink'>" . $dueDate . "</span>";
								} else {
									echo " / " . $dueDate;
								}
							?>
							</div>
						<?php } ?>
						<br> 
						<?php 
						echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$addVerifi'>".number_format($payAfterAccept) ." </span> / <b>$currency</b>"; 
						?>
						<br> 
						<?php 
						echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$rpVisa'>".number_format($payAfterVisaRp) ." </span> / <b>$currency</b>"; 
						?>
						</td>
						<td>
						<?php
							$result = mysqli_query($con, "SELECT COUNT(italy_checklist_name) AS NumberOfLists FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_client_check_id='".$clientID."' AND (italy_checklist_name='DOV' || italy_checklist_name='Visa') AND entry_by='".$_SESSION['user_id']."' ");
							$data = mysqli_fetch_assoc($result);
							$num = $data['NumberOfLists'];
							// $isItaly = $num == 2 && $row['client_country'] == 'italy';
						?>
						<?php if ($sumBalance=='0' && $row['case_status']=='0') { ?>
							<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num >= 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List"> <i class="mdi mdi-check-outline"></i> C.L </button> </a>
						<?php }elseif($row['case_status']!='0'){ ?>
							<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num >= 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> C.L </button></a>
						<?php }else{ ?> 
							<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num >= 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> C.L </button></a>
						<?php } ?>
						</td>
						<td>
							<?php include ("components/ViewActionTd.php");?>
						</td>
					</tr>
					<?php	
					$sr++; 
					}elseif ($numItaly=='0' && $checklistStatus=='0'){
					?>
					<tr id="<?php echo $row['client_id']; ?>">
						<?php 
						echo "<td>".$sr."</td><td>ID-".$row['client_id']."<br><b>".date("d-m-Y", strtotime($row['create_date']))."</b><br>";
						if ($row['client_process_status']=='OverAll Process') {
							echo "<b class='text-purple'>OverAll Process <br> (Admission + Visa)</b>";
						}elseif ($row['client_process_status']=='Only Admission Process') {
							echo "<b class='text-info'>Only Admission <br> Process</b>";
						}else{
							echo "<b class='text-danger'>Have Accepted <br> Letter (Only Visa)</b>";
						}
						echo "</td>";
						?>
						<td class="breakTD">
							<b><?php echo ucwords($row['client_name']);?> </b> <br><a href="https://web.whatsapp.com/send?phone=+<?php echo $row['client_whatapp'];?>" target="_blank"><?php echo $row['client_whatapp']; ?></a> <br><?php echo $row['client_email'];?>
							<br>
							<?php if ($row['client_convert_status']=='New Client') {
								echo "<b class='text-success'>New Client</b>";
							}else{
								echo "<b class='text-warning'>Old Converted Client</b>";
							} ?>
						</td>
						<td class="breakTD">
						<?php
							echo ucwords($row['client_country'])." <br>";
							foreach ($appliedChanging as $appRow){
								echo "<b>".ucwords($appRow)."</b> ";
							}?>
							<br>
							<span data-toggle="tooltip" data-placement="top" title="Country"><?php echo ucwords($row['client_countryfrom']);?></span>
							<br>
							<?php
							$embassyTooltips = [
								'Islamabad Embassy' => 'Islamabad Embassy (Punjab, KPK, and northern areas)',
								'Karachi Embassy' => 'Karachi Embassy (Sindh and Balochistan)',
								'Dubai Embassy' => 'Dubai Embassy (Except for Sharjah and Abu Dhabi, students from all other states of the UAE will select the Dubai embassy.)',
								'Abu Dhabi Embassy' => 'Abu Dhabi Embassy (Abu Dhabi, Sharjah)'
							];
							?>
							<span data-toggle="tooltip" data-placement="top" title="<?php echo $embassyTooltips[$row['client_embassy']];?>"> <i><?php echo ucwords($row['client_embassy']); ?></i> </span>
						</td>
						<td>
						<?php 
						$currency = ($row['client_countryfrom']=='Saudi Arabia' || $row['client_countryfrom']=='Qatar' || $row['client_countryfrom']=='UAE' ) ? 'AED' : 'PKR';
						$addVerifi = ($row['client_country'] == 'austria') ? 'Payable on getting Verification Appointment' : (($row['client_country'] == 'italy') ? 'Payable After Admission Confirmation' : '');

						$rpVisa = ($row['client_country'] == 'austria') ? 'Payable on RP Approval' : (($row['client_country'] == 'italy') ? 'Payable on Visa Approval' : '');

						echo "<span class='text-success' data-toggle='tooltip' data-placement='top' title='Payment In Advance'>".number_format($sumReceived)." </span> / <b>$currency</b>"; 
						?><br> 
						<?php 
						echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='Remaining Balance'>".number_format($sumBalance) ." </span> / <b>$currency</b>"; 
						?>
						<?php
						$dateString = $pay_due_date;
						if ($sumReceived > 0 && $dateString != null && $dateString != '0000-00-00') {
							$date = new DateTime($dateString);
							$dueDate = $date->format('d-m-Y');
							$currentDate = date('d-m-Y');
							?>
							<br>
							<div style="float:right;color:red;">
							<?php
								if ($dueDate == $currentDate) {
									echo " / <span id='blink'>" . $dueDate . "</span>";
								} else {
									echo " / " . $dueDate;
								}
							?>
							</div>
						<?php } ?>
						<br> 
						<?php 
						echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$addVerifi'>".number_format($payAfterAccept) ." </span> / <b>$currency</b>"; 
						?>
						<br> 
						<?php 
						echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$rpVisa'>".number_format($payAfterVisaRp) ." </span> / <b>$currency</b>"; 
						?>
						</td>
						<td>
						<?php
							$result = mysqli_query($con, "SELECT COUNT(italy_checklist_name) AS NumberOfLists FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_client_check_id='".$clientID."' AND (italy_checklist_name='DOV' || italy_checklist_name='Visa') AND entry_by='".$_SESSION['user_id']."' ");
							$data = mysqli_fetch_assoc($result);
							$num = $data['NumberOfLists'];
							// $isItaly = $num == 2 && $row['client_country'] == 'italy';
						?>
						<?php if ($sumBalance=='0' && $row['case_status']=='0') { ?>
							<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num >= 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List"> <i class="mdi mdi-check-outline"></i> C.L </button> </a>
						<?php }elseif($row['case_status']!='0'){ ?>
							<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num >= 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> C.L </button></a>
						<?php }else{ ?> 
							<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num >= 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> C.L </button></a>
						<?php } ?>
						</td>
						<td>
							<?php include ("components/ViewActionTd.php");?>
						</td>
					</tr>
					<?php
					$sr++;}
					?>
					
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>