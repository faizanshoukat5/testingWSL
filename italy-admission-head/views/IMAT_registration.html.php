<?php 
$clientID = $_GET['client-id'];

$select_query="SELECT client_country, client_name, client_email, client_whatapp, client_embassy, client_applied from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."'";
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

		<div class="row">
			<!-- Info About IMAT Registation -->
			<div class="col-md-12">
				<form id="formImatInfo" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: 01 <span class="text-danger">* </span> <span>Inform About IMAT Registration</span>
						</legend>
						<?php
						$imatStatus='';
						$selectCase = "SELECT * FROM italy_clients_imat".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND imat_status='Inform About IMAT Registration' AND imat_client_id='".$clientID."' ";
						$selectIMAT_ex = mysqli_query($con, $selectCase);
						if ($selectIMAT_ex && mysqli_num_rows($selectIMAT_ex) > 0) {
							$dataRow = mysqli_fetch_assoc($selectIMAT_ex);
							$imatStatus = $dataRow['imat_status'];
							$infoStyle = $imatStatus=='Inform About IMAT Registration' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="col-md-12">
								<h4 style="<?php echo $infoStyle;?>">
									<span><b>Inform About IMAT Registration</b></span>
									<button type="button" data-toggle="tooltip" data-placement="top" title="View Inform IMAT" class="btn btn-primary btn-sm float-right" onclick="veiwInformIMAT(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Inform IMAT</button>
								</h4>
								<h5>Link:
									<a href="https://info.wslcms.com/imat-registration" target="_blank">info.wslcms.com/imat-registration</a>
									<input type="hidden" name="" value="https://info.wslcms.com/imat-registration" id="infoIMATLink">
									<div id="linkinfoIMATtoast" class="toast">IMAT Link copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title="Inform IMAT Registration Link" class="btn btn-dark btn-sm ml-1" onclick="copyIMATInfoLink(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
								</h5>
							</div>

							<div class="form-group col-md-12">
								<div class="table-responsive mt-1">
									<table class="table table-striped table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
										<thead>
											<tr>
												<th width="5%">Sr</th>
												<th width="45%">ScreenShot</th>
												<th width="40%">Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$sr=1;
										if(mysqli_num_rows($selectIMAT_ex) > 0){
											foreach ($selectIMAT_ex as $row) {
										?>
											<tr>
												<td><?php echo $sr++;?></td>
												<td>
												<?php 
												$fileMulti = explode(',', $row['imat_screenshot']);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?>
												</td>
												<td><?php echo $row['imat_note'];?></td>
												<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delImat,<?php echo $row['imat_id'];?>);"><i class="mdi mdi-trash-can"></i> </button></td>
											</tr>
										<?php }
										}else{ ?>
											<tr>
												<td colspan="4">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>

							<div class="form-group col-md-6">
								<div class="agreement-container" data-agreement-id="1">
									<label class="form-label">Upload Screenshot <span class="text-danger">* (Select Multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="imatInfoFile[]" required="required" id="uploadedFiles1" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label>Any Note</label>
								<textarea class="form-control" name="imatInfoNote"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" type="button" name="updimatInfo" onclick="saveDataForm('formImatInfo', 'updimatInfo')" id="updimatInfo"><i class="mdi mdi-upload"></i> Update</button>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>

			<div class="col-md-12">
				<form id="formImatReg" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: 02 <span class="text-danger">* </span> <span>IMAT Registration</span>
						</legend>
						<?php
						$caseStatus='';
						$selectCase = "SELECT * FROM italy_clients_imat".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND imat_status='IMAT Registration' AND imat_client_id='".$clientID."' ";
						$selectCase_ex = mysqli_query($con, $selectCase);
						if ($selectCase_ex && mysqli_num_rows($selectCase_ex) > 0) {
							$dataRow = mysqli_fetch_assoc($selectCase_ex);
							$caseStatus = $dataRow['imat_status'];
							$caseStyle = $caseStatus=='IMAT Registration' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="col-md-12">
								<h4 style="<?php echo $caseStyle;?>">
									<span><b>IMAT Registration</b></span>
								</h4>
								<h5>Register Here Link:
									<a href="https://www.universitaly.it/" target="_blank">https://www.universitaly.it/</a>
								</h5>
							</div>

							<div class="form-group col-md-12">
								<div class="table-responsive mt-1">
									<table class="table table-striped table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
										<thead>
											<tr>
												<th width="5%">Sr</th>
												<th width="15%">Register By</th>
												<th width="18%">Test Date</th>
												<th width="15%">UserName</th>
												<th width="15%">Password</th>
												<th width="20%">ScreenShot</th>
												<th width="15%">Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$sr=1;
										if(mysqli_num_rows($selectCase_ex) > 0){
											foreach ($selectCase_ex as $row) {
										?>
											<tr>
												<td><?php echo $sr++;?></td>
												<td><?php echo $row['imat_register_by'];?></td>
												<td><?php echo date("d-m-Y", strtotime($row['imat_test_date']));?></td>
												<td><?php echo $row['imat_username'];?></td>
												<td><?php echo $row['imat_password'];?></td>
												<td>
												<?php 
												$fileMulti = explode(',', $row['imat_screenshot']);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?>
												</td>
												<td><?php echo $row['imat_note'];?></td>
												<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delImat,<?php echo $row['imat_id'];?>);"><i class="mdi mdi-trash-can"></i> </button></td>
											</tr>
										<?php }
										}else{ ?>
											<tr>
												<td colspan="8">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label>Select IMAT Register Status <span class="text-danger">*</span></label>
								<select class="form-control" name="imatRegStatus" required="required">
									<option selected value disabled class="text-center">--- Select IMAT Register Status ---</option>
									<option value="IMAT Register By Client">IMAT Register By Client</option>
									<option value="IMAT Register By Processing Team">IMAT Register By Processing Team</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>IMAT Test Date <span class="text-danger">*</span> </label>
								<input type="date" name="imatTestDate" class="form-control" required="required" autocomplete="off" value="<?php echo date('Y-m-d');?>">
							</div>
							<div class="form-group col-md-4">
								<label>User Name </label>
								<input type="text" name="imatTestUsername" class="form-control" autocomplete="off" >
							</div>
							<div class="form-group col-md-4">
								<label>Password </label>
								<input type="text" name="imatTestPassword" class="form-control" autocomplete="off">
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="2">
									<label class="form-label">Upload Screenshot <span class="text-danger">* (Select Multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="imatRegFile[]" required="required" id="uploadedFiles2" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label>Any Note</label>
								<textarea class="form-control" name="imatRegNote"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" type="button" name="updimatReg" onclick="saveDataForm('formImatReg', 'updimatReg')" id="updimatReg"><i class="mdi mdi-upload"></i> Update</button>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>

			<div class="col-md-12">
				<form id="formImatLast" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: 03 <span class="text-danger">* </span> <span>IMAT Registration</span>
						</legend>
						<?php
						$caseStatus='';
						$selectFinal = "SELECT * FROM italy_clients_imat".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND (imat_status!='IMAT Registration' AND imat_status!='Inform About IMAT Registration') AND imat_client_id='".$clientID."' ";
						$selectFinal_ex = mysqli_query($con, $selectFinal);
						if ($selectFinal_ex && mysqli_num_rows($selectFinal_ex) > 0) {
							$dataRow = mysqli_fetch_assoc($selectFinal_ex);
							$caseStatus = $dataRow['imat_status'];
							$finalStyle = $caseStatus=='IMAT Result Reception' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="col-md-12">
								<h4 style="<?php echo $finalStyle;?>">
									<span><b>IMAT Registration</b></span>
								</h4>
								<h5>Link:
									<a href="https://www.universitaly.it/" target="_blank">https://www.universitaly.it/</a>
								</h5>
							</div>

							<div class="form-group col-md-12">
								<div class="table-responsive mt-1">
									<table class="table table-striped table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
										<thead>
											<tr>
												<th width="5%">Sr</th>
												<th width="18%">IMAT Status</th>
												<th width="20%">ScreenShot</th>
												<th width="20%">Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$sr=1;
										if(mysqli_num_rows($selectFinal_ex) > 0){
										foreach ($selectFinal_ex as $row) {
										?>
											<tr>
												<td><?php echo $sr++;?></td>
												<td><?php echo $row['imat_status'];?></td>
												<td>
												<?php 
												$fileMulti = explode(',', $row['imat_screenshot']);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?>
												</td>
												<td><?php echo $row['imat_note'];?></td>
												<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delImat,<?php echo $row['imat_id'];?>);"><i class="mdi mdi-trash-can"></i> </button></td>
											</tr>
										<?php }
										}else{ ?>
											<tr>
												<td colspan="5">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group col-md-8">
								<label>Select IMAT Status <span class="text-danger">*</span></label>
								<select class="form-control" name="imatStatus" required="required">
									<option selected value disabled class="text-center">--- Select IMAT Status ---</option>
									<option value="IMAT Registration Fee Payment">IMAT Registration Fee Payment</option>
									<option value="IMAT Test Attempt">IMAT Test Attempt</option>
									<option value="IMAT Test Not Attempt">IMAT Test Not Attempt</option>
									<option value="IMAT Test Pass">IMAT Test Pass</option>
									<option value="IMAT Test Fail">IMAT Test Fail</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="3">
									<label class="form-label">Upload Screenshot <span class="text-danger">* (Select Multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="imatStatusFile[]" required="required" id="uploadedFiles3" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label>Any Note</label>
								<textarea class="form-control" name="imatStatusNote"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" type="button" name="updimatStatus" onclick="saveDataForm('formImatLast', 'updimatStatus')" id="updimatStatus"><i class="mdi mdi-upload"></i> Update</button>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal Start -->
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
	// Save Apply Data using AJAX
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
				url: "models/_imatApplyControllersState.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					let res = typeof response === "string" ? JSON.parse(response) : response;
					Swal.fire({
						title: res.title,
						text: res.text,
						icon: res.status
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
	// Intro Message 
	function veiwInformIMAT(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/imatRegistrationState.php",
			data:'checkInfoIMAT='+id,
			success: function(data){
				$(".showTitleModel").text("Inform About IMAT Registration");
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};

	// inform IMAT link copy
	function copyIMATInfoLink(id) {
		var linkCopy = $("#infoIMATLink").val();
		
		navigator.clipboard.writeText(linkCopy).then(function() {
			var linktoast = document.getElementById("linkinfoIMATtoast");
			linktoast.classList.add("show");
			// Hide the linktoast after 3 seconds
			setTimeout(function() {
				linktoast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};

	// Delete steps for case History
	function delImat(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/imatRegistrationState.php",
			data: 'imatID='+id,
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