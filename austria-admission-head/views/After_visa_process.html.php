<?php 
$clientID = $_GET['client-id'];

$select_query="SELECT client_country, client_name, client_email, client_whatapp, client_embassy, client_applied, due_after_visa_info_file, due_after_visa_info_note, due_after_visa_info_date, due_after_visa_paid_file, due_after_visa_paid_note, due_after_visa_paid_date from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."'";
$select_query_ex = mysqli_query($con,$select_query);
$row = mysqli_fetch_assoc($select_query_ex);

$countryName = $row['client_country'];
$clientName = $row['client_name'];
$clientEmail = $row['client_email'];
$clientWhatApp = $row['client_whatapp'];
$clientEmbassy = $row['client_embassy'];

$changingApplied = $row['client_applied'];
$appliedChanging = json_decode($changingApplied, true);

$getUrl = base64_encode($row['client_name']."".$row['client_whatapp']);

$dueInfoFile = $row['due_after_visa_info_file'];
$dueInfoNote = $row['due_after_visa_info_note'];
$dueInfoDate = $row['due_after_visa_info_date'];
$duePaidFile = $row['due_after_visa_paid_file'];
$duePaidNote = $row['due_after_visa_paid_note'];
$duePaidDate = $row['due_after_visa_paid_date'];

?>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>Email: <b><?php echo $clientEmail;?></b> </p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="alert bg-dark text-warning">
					<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="alert bg-dark text-warning">
					<p>Country: <b><?php echo ucwords($countryName);?></b></p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="alert bg-dark text-warning">
					<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="alert bg-dark text-warning">
					<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
				</div>
			</div>
		</div>
		<input type="hidden" name="" value="<?php echo $clientEmbassy;?>" id="clientEmbassy">
		<input type="hidden" name="" value="<?php echo $countryName;?>" id="countryName">
		<input type="hidden" name="" value="<?php echo $appRow;?>" id="clientApplied">
		<!-- step 1 -->
		<fieldset class="scheduler-border-team">
			<legend class="scheduler-border-team">
				Step: 01 <span class="text-danger">* </span> <span><b> After Visa Due</b></span>
			</legend>
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="#infoPayVisaDue" data-toggle="tab" aria-expanded="true" class="nav-link active">
								<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
								<span class="d-none d-sm-block text-warning">Inform to Client Pay the after Visa Dues</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#paidVisaDues" data-toggle="tab" aria-expanded="true" class="nav-link">
								<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
								<span class="d-none d-sm-block text-warning">After Visa Dues Received by Client </span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane show active" id="infoPayVisaDue">
							<div class="row">
								<div class="form-group col-md-12">
									<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
										<thead>
											<tr>
												<th width="35%">Inform to Client to Pay the After Visa Due</th>
												<th width="40%">Any Note</th>
												<th width="15%">Date</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php if($dueInfoFile!=''){ ?>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $dueInfoFile);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $dueInfoNote;?></td>
												<td><?php echo $dueInfoDate;?></td>
												<td>
													<button class="btn btn-danger btn-sm" type="button" onclick="del(delInfoVisa,<?php echo $clientID;?>);"><i class="mdi mdi-trash-can"></i> </button>
												</td>
											</tr>
											<?php }else {
											?>
											<tr>
												<td colspan="4">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="form-group col-md-12">
									<form id="formInfoVisa" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="1">
													<label class="form-label">Inform to Client to Pay the After Visa Due <span class="text-danger">(Select multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="dueAdInfoFile[]" required="required" id="uploadedFiles1" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
											<div class="form-group col-md-8">
												<label class="form-label">Note</label>
												<textarea class="form-control" name="dueAdInfoNote"><?php echo $dueInfoNote;?> </textarea>
											</div>
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="dueVisaInfo" onclick="saveDataForm('formInfoVisa', 'dueVisaInfo')" id="dueVisaInfo"><i class="mdi mdi-upload"></i> Update </button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="paidVisaDues">
							<div class="row">
								<div class="form-group col-md-12">
									<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
										<thead>
											<tr>
												<th width="15%">Payment Method</th>
												<th width="15%">Received Amount</th>
												<th width="15%">File Screenshot</th>
												<th width="10%">Date</th>
												<th width="15%">Any Note</th>
											</tr>
										</thead>
										<tbody>
										<?php if($duePaidFile!=''){ ?>
											<tr>
												<td><?php echo $duePaidPayMethod;?></td>
												<td><?php echo $duePaidReceived;?></td>
												<td class="breakTD"><?php $fileMulti = explode(',', $duePaidFile);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td><?php echo $duePaidDate;?></td>
												<td><?php echo $duePaidNote;?></td>
											</tr>
											<?php } else {
											?>
											<tr>
												<td colspan="5">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="form-group col-md-12">
									<form id="formPaidVisa" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<label class="form-label">Payment Method <span class="text-danger">*</span></label>
												<select class="form-control" name="duesPaymentMethod" required="required">
													<option selected value disabled class="text-center">--- Select Dues Payment Method ---</option>
													<?php
													$payMethod = select('payment_method', $con);
													foreach ($payMethod as $row) {
													?>
													<option value="<?= $row['paymethod_name']; ?>"><?= ucwords($row['paymethod_name']); ?></option>
													<?php } ?>
												</select>
											</div>
											<div class="form-group col-md-3">
												<label>Received Amount <span class="text-danger">*</span></label>
												<input type="number" name="duesReceived" class="form-control" required="required">
											</div>
											<div class="form-group col-md-5">
												<div class="agreement-container" data-agreement-id="26">
													<label class="form-label">After Visa Dues Received by Client <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="dueAdPaidFile[]" required="required" id="uploadedFiles26" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
											<div class="form-group col-md-12">
												<label class="form-label">Note</label>
												<textarea class="form-control" name="dueAdPaidNote"></textarea>
											</div>
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="dueVisaPaid" onclick="saveDataForm('formPaidVisa', 'dueVisaPaid')" id="dueVisaPaid"><i class="mdi mdi-upload"></i> Update </button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		
	</div>
</div>
<!-- Visa Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showTitleModel" id="myLargeModalLabel"></h4>
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
				url: "models/_allClientsControllersState.php",
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


	// Inform about visa Due
	function delInfoVisa(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/visaAfterProcessState.php",
			data: {
				infoVisaDel:id,
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
	// Paid Due After Visa
	function delPaidVisa(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/visaAfterProcessState.php",
			data: {
				paidVisaDel:id,
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