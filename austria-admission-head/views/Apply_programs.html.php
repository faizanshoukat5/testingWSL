<?php 
$clientID = $_GET['client-id'];
$uniName = $_GET['university-name'] ?? 'all';
?>
<div class="card">
	<div class="card-body">
		<div class="alert alert-primary">
			<h5><?php if($uniName=='all'){echo "All Clients";}else{echo $uniName;}?> >> <b>Apply Programs</b></h5>
		</div>
		<?php 
		$client_query = "SELECT client_name, client_email, client_whatapp, client_applied from clients".$_SESSION['dbNo']." WHERE status = '1' AND close='1' AND client_id='".$clientID."' ";
		$client_query_ex = mysqli_query($con,$client_query);
		foreach ($client_query_ex as $rowCl) {
			$clientName = $rowCl['client_name'];
			$clientEmail = $rowCl['client_email'];
			$clientWhatapp = $rowCl['client_whatapp'];
			$changingApplied = $rowCl['client_applied'];
			$appliedChanging = json_decode($changingApplied, true);
		}
		?>
		<div class="row">
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>WhatsApp: <strong><?php echo $clientWhatapp;?></strong></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>Email: <strong><?php echo $clientEmail;?></strong></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>Degree: <strong><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></strong></p>
				</div>
			</div>
		</div>
		<div class="table-responsive mt-1">
			<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
				<thead>
					<tr>
						<th style="width: 15px;">Sr</th>
						<th style="width: 200px;">University</th>
						<th style="width: 180px;">Program</th>
						<th style="width: 100px;">Intake</th>
						<th style="width: 150px;">Current Status</th>
						<th style="width: 80px;">Apply Date</th>
						<th style="width: 180px;">Action</th>
						<th style="width: 180px;">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sr=1;
					if($uniName!='all'){
						$select_query = "SELECT * from austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_change_program_status='0' AND aus_clients_id='".$clientID."' AND aus_university_name='".$uniName."' ORDER BY aus_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					else{
						$select_query = "SELECT * from austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_change_program_status='0' AND aus_clients_id='".$clientID."' ORDER BY aus_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					foreach ($select_query_ex as $rowPro) {
						$assignDate = $rowPro['aus_program_assign_date'];
						$TDstyle = $rowPro['aus_assign_status']==1 ? 'background: #D7FFF1; color: #000;' : '';
					?>
					<tr id="<?php echo $rowPro['aus_client_pro_id'];?>" style="<?php echo $TDstyle;?>">
						<td><?php echo $sr;?></td>
						<td class="breakTD">
							<?php echo ucwords($rowPro['aus_university_name']); ?>
						</td>
						<td class="breakTD text-left">
							<?php 
							$programName = $rowPro['aus_program_name'];
							$changedProgramName = $rowPro['aus_change_program_name'] ? "<br>" . ucwords($rowPro['aus_change_program_name']) : '';
							if (empty($programName)) {
								echo $changedProgramName;
							} else {
								$decoded = json_decode($programName, true);
								if (is_array($decoded)) {
									$output = '';
									foreach ($decoded as $key => $name) {
										$output .= ($key + 1) . ') ' . ucwords($name) . '<br>';
									}
									echo ($rowPro['close'] == '0' || $rowPro['aus_change_program_status'] == '1') 
									? "<del>$output</del>$changedProgramName" 
									: ($changedProgramName ? "<del>$output</del>$changedProgramName" : $output);
								} else {
									echo ($rowPro['close'] == '0' || $rowPro['aus_change_program_status'] == '1') 
									? "<del>" . ucwords($programName) . "</del>$changedProgramName" 
									: ($changedProgramName ? "<del>" . ucwords($programName) . "</del>$changedProgramName" : ucwords($programName));
								}
							}
							?>
						</td>
						<td><?php echo ucwords($rowPro['aus_intake']);?></td>
						<?php 
						include("components/directApplySteps.php");
						include("components/courierApplySteps.php");
						$uniQuery = "SELECT aus_uni_direct_apply, aus_uni_courier_apply from austria_add_universities".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND aus_uni_name='".$rowPro['aus_university_name']."' AND aus_uni_degree='".$rowPro['aus_client_degree']."' ";
						$uniQuery_ex = mysqli_query($con,$uniQuery);
						$uniApplyRow = mysqli_fetch_assoc($uniQuery_ex);
						?>
						<td style="<?php echo $TDstyle;?>" class="breakTD">
						<?php
						if ($uniApplyRow['aus_uni_direct_apply']=='0' && $uniApplyRow['aus_uni_courier_apply']=='1'){ 
							echo $admissionCourierStatus;
						}
						elseif ($uniApplyRow['aus_uni_direct_apply']=='1' && $uniApplyRow['aus_uni_courier_apply']=='0'){ 
							echo $admissionDirectStatus;
						}
						elseif ($uniApplyRow['aus_uni_direct_apply']=='1' && $uniApplyRow['aus_uni_courier_apply']=='1'){
							echo $admissionDirectStatus;
							echo '<br>';
							echo $admissionCourierStatus;
						} ?>
						</td>
						<td style="<?php echo $TDstyle;?>"> 
						<?php 
						if ($uniApplyRow['aus_uni_direct_apply']=='1' && $uniApplyRow['aus_uni_courier_apply']=='0'){
							echo $admissionDirectDate;
						}
						elseif ($uniApplyRow['aus_uni_direct_apply']=='0' && $uniApplyRow['aus_uni_courier_apply']=='1'){
							echo $admissionCourierDate;
						}
						elseif ($uniApplyRow['aus_uni_direct_apply']=='1' && $uniApplyRow['aus_uni_courier_apply']=='1'){
							echo $admissionDirectDate;
							echo '<br>';
							echo $admissionCourierDate;
						} ?>
						</td>
						<?php
						$getUrl = base64_encode($clientName."".$clientEmail."".$changingApplied);
						?>
						<td>
						<?php $btnCourierClass = $rowPro['aus_courier_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $btnDirectClass = $rowPro['aus_direct_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; 
						if ($uniApplyRow['aus_uni_direct_apply']=='1' && $uniApplyRow['aus_uni_courier_apply']=='0') { ?>
							<a href="direct-apply?program-applied-id=<?php echo $rowPro['aus_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 130px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
						<?php }
						elseif ($uniApplyRow['aus_uni_direct_apply']=='0' && $uniApplyRow['aus_uni_courier_apply']=='1' ) { ?>
							<a href="courier-apply?program-applied-id=<?php echo $rowPro['aus_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 130px;" type="button" class="btn <?php echo $btnCourierClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Courier Apply"><i class="mdi mdi-information"></i> Courier A.</button></a>
						<?php }
						elseif ($uniApplyRow['aus_uni_direct_apply']=='1' && $uniApplyRow['aus_uni_courier_apply']=='1') { ?>
							<a href="direct-apply?program-applied-id=<?php echo $rowPro['aus_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 130px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<br>
							<a href="courier-apply?program-applied-id=<?php echo $rowPro['aus_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 130px;" type="button" class="btn <?php echo $btnCourierClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Courier Apply"><i class="mdi mdi-information"></i> Courier A.</button></a>
						<?php } ?>
						<br>
						<?php
						if ($assignDate!='0000-00-00') {
							$date2 = date('Y-m-d');
							$timestamp_assignDate = strtotime($assignDate);
							$timestamp_date2 = strtotime($date2);
							$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
							$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
							// echo $daysAssign_diff;
							if ($daysAssign_diff >= 1 && $rowPro['aus_direct_applied_status']=='0') { ?>
							<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
							<?php }
						}
						?>
						</td>
						<?php 
						if($rowPro['aus_deadline_hold_status']==1){
							$btnVal = 'btn-danger';
						}elseif($rowPro['aus_deadline_hold_status']==2){
							$btnVal = 'btn-success';
						}elseif($rowPro['aus_deadline_hold_status']==0){
							$btnVal = 'btn-outline-secondary';
						}
						?>
						<td>
							<button type="button" class="btn <?php echo $btnVal;?> btn-sm" data-toggle="tooltip" data-placement="top" title="If the Client wants Hold Application" onclick="holdApplication(<?php echo $rowPro['aus_client_pro_id'];?>);"> <i class="mdi mdi-alpha-d-circle"></i> </button>
							<?php
							$statusClass = match($rowPro['aus_program_status']) {
								'1' => 'btn-warning',
								'2' => 'btn-success',
								default => 'btn-outline-primary',
							};
							?>
							<button type="button" class="btn <?php echo $statusClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Processing Team Report" onclick="addProgramNote(<?php echo $rowPro['aus_client_pro_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>
							<?php 
							$wtName='';
							if($rowPro['aus_assign_status'] == 1) {
							$wtID = $rowPro['aus_program_assign']; 
							$wt_query = "SELECT * from wt_users WHERE status='1' AND close='1' AND wt_id='".$wtID."' ";
							$wt_query_ex = mysqli_query($con,$wt_query);
							foreach ($wt_query_ex as $wtrow) {
								$wtName = $wtrow['fname']." ".$wtrow['lname'];
							}
							?>
							<br>
							<span class="badge bg-purple pt-2 pb-2 mt-1" data-toggle="tooltip" data-placement="top" title="This University is Assign to"><?php echo ucwords($wtName);?></span> 
							<br> University Assigned
							<?php } ?>
						</td>
					</tr>
					<?php $sr++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- View Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showModalTitle" id="myLargeModalLabel"></h4>
			</div>
			<div class="modal-body showModalClient">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	// Application accepted or Rejection
	function saveDataForm(formID, proBtn) {
		let $form = $("#"+formID);
		let $btn = $("#"+proBtn);
		if ($form.parsley().validate()) {
			// CKEditor ka data update karne ka step
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			$btn.prop("disabled", true).text("Submitting...");
			let formData = new FormData($form[0]);
			formData.append(proBtn, 1);
			$.ajax({
				url: "models/_applyProgramsControllersState.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					Swal.fire({
						title: "Uploaded",
						text: 'Record Uploaded successfully',
						icon: "success"
					}).then(() => {
						location.reload();
					});
				},
				error: function (xhr, status, error) {
					Swal.fire({
						title: "Error!",
						text: "Something went wrong: " + error,
						icon: "error"
					});
					$btn.prop("disabled", false).text("Submit");
				}
			});
		} else {
			Swal.fire({
				title: "Validation Error",
				text: "Please fill all required fields before submitting.",
				icon: "warning"
			});
		}
	}
	// Add note to Admission head
	function addProgramNote(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'checkProgramNote='+id,
			success: function(data){
				$(".showModalTitle").html('Add Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
				$('#showModalClient').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});
			}
		});
	};
	function updProReport(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'updProgramNote='+id,
			success: function(data){
				$(".showModalTitle").html('Add Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	}

	function holdApplication(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'updHoldApplication='+id,
			success: function(data){
				$(".showModalTitle").html('Deadline Hold Application Details');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
				$('#showModalClient').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});
			}
		});
	}

	function delRefundApplication(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/applicationNoteState.php",
			data: {
				refundAppDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};

</script>